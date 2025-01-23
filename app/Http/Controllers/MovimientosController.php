<?php

namespace App\Http\Controllers;
use App\Models\Adminbd;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use App\Models\Movimientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class MovimientosController extends Controller
{
    public function index()
    {
        $usuario = User::find(auth()->id());
        return view('giftcards.movimiento', compact('usuario'));
    }

    // public function getMovimientosAgrupados(){
    //     $movimientos = DB::connection('DB_CONNECTION_GIFT')
    //         ->table('vMovimientosAgrupados')
    //         ->orderBy('fechaMovimiento','desc')
    //         ->get()
    //         ->groupBy('idAgrupacion');
    //     $resultado = [];
        
    //     foreach ($movimientos as $idAgrupacion  => $movimientosAgrupados) {
    //         $vendedorInfo = $movimientosAgrupados->first();

    //         $vendedorData = [
    //             'idVendedor' => $vendedorInfo->idVendedor,
    //             'idAgrupacion' => $vendedorInfo->idAgrupacion,
    //             'nombreVendedor' => $vendedorInfo->nombreVendedor,
    //             'cargoVendedor' => $vendedorInfo->cargoVendedor,
    //             'idTipoMovimiento' => $vendedorInfo->idTipoMovimiento,
    //             'fechaMovimiento' => $vendedorInfo->fechaMovimiento,
    //             'movimientos' => []
    //         ];

    //         foreach ($movimientosAgrupados as $movimiento) {
    //             $vendedorData['movimientos'][] = [
    //                 'idGiftCard' => $movimiento->idGift,
    //                 'valorUnitario' => $movimiento->valor,
    //                 'Correlativo' => $movimiento->Correlativo,
    //                 'cantidad' => $movimiento->cantidad,
    //                 'idFactura' => $movimiento->idFactura,
    //                 'valorMovimiento' => $movimiento->valorMovimiento,
    //             ];
    //         }

    //         $resultado[] = $vendedorData;
    //     }

    //     return response()->json($resultado);

    // }
    
    
    public function getMovimientos($tipoMovimiento) {
        // Verificar el tipo de movimiento recibido
        $tablaMovimientos = '';
        switch ($tipoMovimiento) {
            case 'liquidacion':
                $tablaMovimientos = 'vMovimientosLiquidacion';  // Tabla de liquidaciones
                break;
            case 'entrega':
                $tablaMovimientos = 'vMovimientosEntrega';  // Tabla de entregas
                break;
            case 'devolucion':
                $tablaMovimientos = 'vMovimientosDevolucion';  // Tabla de devoluciones
                break;
            default:
                return response()->json(['error' => 'Tipo de movimiento no reconocido'], 400);
        }
    
        // Obtener los movimientos de la tabla adecuada
        $movimientos = DB::connection('DB_CONNECTION_GIFT')
            ->table($tablaMovimientos)
            ->orderBy('fechaMovimiento', 'desc')
            ->get()
            ->groupBy('idAgrupacion');
    
        $resultado = [];
    
        // Procesar cada agrupación de movimientos
        foreach ($movimientos as $idAgrupacion => $movimientosAgrupados) {
            $vendedorInfo = $movimientosAgrupados->first();
    
            // Validar datos del vendedor
            $vendedorData = [
                'idVendedor' => $vendedorInfo->idVendedor ?? null,
                'idAgrupacion' => $vendedorInfo->idAgrupacion ?? null,
                'nombreVendedor' => $vendedorInfo->nombreVendedor ?? 'Desconocido',
                'cargoVendedor' => $vendedorInfo->cargoVendedor ?? 'No disponible',
                'codigoCliente' => $vendedorInfo->codigoCliente ?? null,
                'nombreCliente' => $vendedorInfo->nombreCliente ?? 'No disponible',
                'idTipoMovimiento' => $vendedorInfo->idTipoMovimiento ?? null,
                'fechaMovimiento' => $vendedorInfo->fechaMovimiento ?? null,
                'valorMovimiento' => floatval($vendedorInfo->valorMovimiento ?? 0),
                'idGiftCard' => $vendedorInfo->idGift ?? null,
                'valorUnitario' => floatval($vendedorInfo->valor ?? 0),
                'movimientos' => []
            ];
    
            // Recorrer los movimientos agrupados y añadir los detalles
            foreach ($movimientosAgrupados as $movimiento) {
                $vendedorData['movimientos'][] = [
                    'codigoArticulo' => $movimiento->codigoArticulo ?? 'Desconocido',
                    'Articulo' => $movimiento->Articulo ?? 'Sin nombre',
                    'cantidadArticulo' => $movimiento->cantidadArticulo ?? 0,
                    'Correlativo' => $movimiento->Correlativo ?? 'Sin correlativo',
                    'cantidad' => $movimiento->cantidad ?? 1, // Por defecto 1
                    'idFactura' => $movimiento->idFactura ?? null,
                    'valorMovimiento' => floatval($movimiento->valorMovimiento ?? 0),
                    'valorUnitario' => floatval($movimiento->valor ?? 0)
                ];
            }
    
            $resultado[] = $vendedorData;
        }
    
        return response()->json($resultado);
    }    

    public function getArticulos(Request $request)
    {
        try {
            $search = $request->query('search', '');
            
            $articulos = DB::connection('DB_CONNECTION_GIFT')
            ->table('Articulos')
            ->join('Control_GiftCards.dbo.vArticulos as v', 'v.codigo', '=', 'Articulos.codigo')
            ->select('Articulos.idArticulo', 'v.nombre', 'Articulos.codigo') 
            ->when($search, function ($query) use ($search) {
                return $query->where('v.nombre', 'like', '%' . $search . '%')
                            ->orWhere('Articulos.codigo', 'like', '%' . $search . '%');
            })
            ->where('Articulos.eliminado', '!=', 1)
            ->get();


            return response()->json($articulos);
        } catch (Exception $e) {
            Log::error('Error en articulos:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al obtener los artículos'], 500);
        }
    }

    public function getVendedores()
    {
        $vendedores = DB::connection('DB_CONNECTION_GIFT')
                        ->table('vVendedoresFiltrados')
                        ->select('Alias', 'Nombre', 'idVendedor')
                        ->get();
                        
        return response()->json($vendedores);
    }

    public function disponibles()
    {
        $giftcards = DB::connection('DB_CONNECTION_GIFT')
                        ->table('GiftCards as gc')
                        ->join('GiftCard_Factura_Saldo as saldo', 'gc.idGift', '=', 'saldo.idGiftCard')
                        ->where('gc.cantidad', '>', 0)
                        ->where('gc.eliminado', 0)
                        ->where('saldo.cantidadDisponible', '>', 0)
                        ->groupBy('gc.idGift', 'gc.valor')
                        ->select('gc.idGift as id', 'gc.valor', DB::raw('SUM(saldo.cantidadDisponible) as cantidadTotal'))
                        ->get();

        return response()->json(['giftcards' => $giftcards]);
    }

    public function getCorrelativoFactura($idGiftCard, Request $request)
    {
        $cantidadSolicitada = $request->query('cantidadSolicitada');
        $facturas = DB::connection('DB_CONNECTION_GIFT')
                      ->table('GiftCard_Factura_Saldo as saldo')
                      ->join('Factura as f', 'saldo.idFactura', '=', 'f.idFactura')
                      ->where('saldo.idGiftCard', $idGiftCard)
                      ->where('saldo.cantidadDisponible', '>', 0)
                      ->where('f.eliminado', 0)
                      ->orderBy('saldo.fechaRegistro', 'asc')
                      ->select('saldo.idFactura', 'saldo.cantidadDisponible', 'f.Correlativo')
                      ->get();
    
        $facturasSeleccionadas = [];
        $cantidadTotal = 0;
    
        foreach ($facturas as $factura) {
            $facturaRestante = $cantidadSolicitada - $cantidadTotal;
    
            if ($factura->cantidadDisponible >= $facturaRestante) {
                $facturasSeleccionadas[] = [
                    'correlativo' => $factura->Correlativo,
                    'idFactura' => $factura->idFactura,
                    'cantidad' => $facturaRestante
                ];
                $cantidadTotal += $facturaRestante;
                break;
            } else {
                $facturasSeleccionadas[] = [
                    'correlativo' => $factura->Correlativo,
                    'idFactura' => $factura->idFactura,
                    'cantidad' => $factura->cantidadDisponible
                ];
                $cantidadTotal += $factura->cantidadDisponible;
            }
    
            if ($cantidadTotal >= $cantidadSolicitada) {
                break;
            }
        }
    

        if ($cantidadTotal >= $cantidadSolicitada) {
            return response()->json([
                'facturas' => $facturasSeleccionadas
            ]);
        } else {
            return response()->json(['message' => 'No hay suficiente cantidad disponible en las facturas.'], 404);
        }
    }
    
    public function generarPDFEntrega(Request $request)
    {
        // Obtener los datos enviados desde el frontend
        $data = $request->input('data');

        // Log::debug('Data recibida:', $data); //debug

        // Verificar que los datos sean válidos
        if (is_null($data) || !is_array($data)) {
            return response()->json(['error' => 'Invalid data received'], 400);
        }

        // Desestructurar los datos recibidos
        $idVendedor = $data['idVendedor'] ?? 'No ID';
        $nombreVendedor = $data['nombreVendedor'] ?? 'No Name';
        $cargoVendedor = $data['cargoVendedor'] ?? 'No Position';
        $idTipoMovimiento = $data['idTipoMovimiento'] ?? 0;
        $fechaMovimiento = $data['fechaMovimiento'] ?? now();
        $movimientos = $data['movimientos'] ?? [];
        $idAgrupacion = $data['idAgrupacion'] ?? 'NoAgrupacion';

        // Formatear la fecha para el nombre del archivo
        $fechaFormateada = date('dmy', strtotime($fechaMovimiento));

        // Generar el nombre del archivo PDF
        $nombreArchivo = "Recibo_{$fechaFormateada}_{$idVendedor}_{$idAgrupacion}.pdf";

        // Obtener el número de vendedor desde la base de datos (asegurándonos de que el campo 'codigo' existe)
        $numeroVendedor = DB::connection('DB_CONNECTION_GIFT')
            ->table('vVendedoresFiltrados')
            ->where('idVendedor', $idVendedor)
            ->value('codigo'); // Usamos value() para obtener solo el valor de 'codigo'

        $numeroVendedorString = isset($numeroVendedor) ? strval($numeroVendedor) : 'No Código';

        // Cargar la vista para la plantilla del PDF
        $html = view('giftcards.pdf_plantilla_entrega', compact('idVendedor', 'idAgrupacion', 'numeroVendedorString', 'nombreVendedor', 'cargoVendedor', 'idTipoMovimiento', 'fechaMovimiento', 'movimientos'))->render();

        // Crear una instancia de TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('José Ricardo Mejía Gámez');
        $pdf->SetTitle('Recibos PDF');
        $pdf->SetSubject("Recibo {$fechaFormateada} {$idVendedor} {$idAgrupacion}");

        // Configuración de los encabezados y pies de página
        $pdf->SetHeaderData('', 0, 'Compañía Farmaceutica S.A de C.V');
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Agregar una página al PDF
        $pdf->AddPage('P', 'LETTER');     

        $pdf->SetFont('helvetica', '', 12);

        // Escribir el contenido HTML del PDF
        try {
            $pdf->writeHTML($html, true, false, true, false, '');
        } catch (Exception $e) {
            Log::error('TCPDF Error:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al generar PDF'], 500);
        }

        // Devolver el PDF generado como respuesta
        return response($pdf->Output($nombreArchivo, 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $nombreArchivo . '"');
    }

    public function asignarGiftCardsVendedor(Request $request) {
        $idVendedor = $request->input('idVendedor');
        $idAgrupacion = DB::connection('DB_CONNECTION_GIFT')->table('Movimiento')->max('idAgrupacion') + 1;
        foreach ($request->input('movimientos') as $giftcard) {
            $idGiftCard = $giftcard['idGiftCard'];
            $cantidad = $giftcard['cantidad'];
            $idFactura = $giftcard['idFactura'];
            $user = Auth::user();
            $id = $user->name; 
            $usuario = Adminbd::where('codigoEmp', $id)->first();
            $nombreUsuario = $usuario ? $usuario->usuario : null;

            $valorGiftCard = DB::connection('DB_CONNECTION_GIFT')
                ->table('GiftCards')->where('idGift', $idGiftCard)->value('valor');

            $valorMovimiento = $valorGiftCard * $cantidad;

            Movimientos::create([
                'idFactura' => $idFactura,
                'idGift' => $idGiftCard,
                'idTipoMovimiento' => 2, 
                'idVendedor' => $idVendedor,
                'idCliente' => null, 
                'idArticulo' => null, 
                'cantidad' => $cantidad,
                'valorMovimiento' => $valorMovimiento,
                'fechaMovimiento' => now(), 
                'usuarioReg' => $nombreUsuario,
                'fechaReg' => now(),
                'eliminado' => 0,
                'idAgrupacion' => $idAgrupacion,
            ]);
        }

        return response()->json(['message' => 'Gift cards asignadas correctamente']);
    }

    public function getClientes(Request $request){
        $search = $request->input('search');
        $clientes = DB::connection('DB_CONNECTION_GIFT')
                    ->table('vclientes')
                    ->where(function ($query) use ($search) {
                        $query->where('establecimiento', 'like', '%' . $search . '%')
                              ->orWhere('codigo', 'like', '%' . $search . '%');
                    })
                    ->get();
        return response()->json($clientes);
    }

    public function getGiftVendedores(Request $request){
        $idVendedor = $request->input('idVendedor');
        $giftVendedores = DB::connection('DB_CONNECTION_GIFT')
                    ->table('Inventario_Vendedor_GiftCards as ivg')
                    ->join('GiftCards as gc', 'ivg.idGiftCard', '=', 'gc.idGift')
                    ->where('ivg.idVendedor', $idVendedor)
                    ->where('ivg.cantidad', '>', 0)
                    ->select(
                        'ivg.idGiftCard',
                        'gc.valor',
                        DB::raw('SUM(ivg.cantidad) as cantidad'),
                        DB::raw('MIN(ivg.fechaReg) as fechaReg')
                    )
                    ->groupBy('ivg.idGiftCard', 'gc.valor')
                    ->get();
        return response()->json($giftVendedores);
    }
    
    public function LiquidarGift(Request $request){
        try{
            $request->validate([
                'vendedor' => 'required|integer',
                'giftCard' => 'required|integer',
                'productos.*.idArticulo' => 'required|integer',
                'productos.*.cantidad' => 'required|integer|min:1',
            ]);

            $idAgrupacion = DB::connection('DB_CONNECTION_GIFT')->table('Movimiento')->max('idAgrupacion') + 1;

            $user = Auth::user();
            $id = $user->name; 
            $usuario = Adminbd::where('codigoEmp', $id)->first();
            $nombreUsuario = $usuario ? $usuario->usuario : null;

            $valorMovimiento =  DB::connection('DB_CONNECTION_GIFT')
            ->table('GiftCards')
            ->where('idGift', $request->input('giftCard'))
            ->value('valor');

            $entradaMasAntigua = DB::connection('DB_CONNECTION_GIFT')->table('Inventario_Vendedor_GiftCards')
            ->where('idVendedor', $request->input('vendedor'))
            ->where('idGiftCard', $request->input('giftCard'))
            ->where('cantidad', '>', 0) // Asegurar que tenga cantidad disponible
            ->orderBy('fechaReg', 'asc') // Seleccionar la entrada más antigua
            ->first();
    
            if (!$entradaMasAntigua) {
                return response()->json(['error' => 'No hay suficiente inventario para esta Gift Card.'], 400);
            }
    
            $idFactura = $entradaMasAntigua->idFactura; // Obtener el idFactura

            foreach ($request->input('productos') as $producto) {
                $movimiento = Movimientos::create([
                    'idFactura' => $idFactura,
                    'idGift' => $request->input('giftCard'),
                    'idTipoMovimiento' => 3,
                    'idVendedor' => $request->input('vendedor'),
                    'idCliente' => $request->input('cliente', null),
                    'idArticulo' => $producto['idArticulo'],
                    'cantidad' => 1,
                    'valorMovimiento' => $valorMovimiento,
                    'fechaMovimiento' => now(),
                    'usuarioReg' => $nombreUsuario,
                    'fechaReg' => now(),
                    'eliminado' => 0,
                    'idAgrupacion' => $idAgrupacion,
                ]);
                
                $ultimoIdInsertado = DB::connection('DB_CONNECTION_GIFT')->select('SELECT SCOPE_IDENTITY() AS id')[0]->id;
                
                if (!$movimiento || !$movimiento->idMovimiento) {
                    Log::error('Error al crear movimiento', ['producto' => $producto]);
                    return response()->json(['error' => 'Error al crear el movimiento'], 500);
                }
            
                $detalleData = [
                    'idMovimiento' => $ultimoIdInsertado ,
                    'cantidad' => $producto['cantidad'],
                    'eliminado' => 0,
                    'usuarioReg' => $nombreUsuario,
                    'fechaReg' => now(),
                ];
                
            
                // Registrar el detalle de la liquidación
                DB::connection('DB_CONNECTION_GIFT')->table('liquidacion_detalles')->insert($detalleData);
            }
            
            $entradaMasAntigua = DB::connection('DB_CONNECTION_GIFT')->table('Inventario_Vendedor_GiftCards')
            ->where('idVendedor', $request->input('vendedor'))
            ->where('idGiftCard', $request->input('giftCard'))
            ->where('cantidad', '>', 0) // Asegurar que tenga cantidad disponible
            ->orderBy('fechaReg', 'asc') // Seleccionar la entrada más antigua
            ->first();

            if (!$entradaMasAntigua) {
                return response()->json(['error' => 'No hay suficiente inventario para esta Gift Card.'], 400);
            }
            
            // Actualizar la cantidad de la entrada más antigua
            DB::connection('DB_CONNECTION_GIFT')->table('Inventario_Vendedor_GiftCards')
            ->where('idInventario', $entradaMasAntigua->idInventario)
            ->decrement('cantidad', 1, [
                'fechaMod' => now(),
                'usuarioMod' => $nombreUsuario,
            ]);
            
            return response()->json(['message' => 'Gift Cards liquidadas correctamente'], 201);
        }catch(Exception $e){
            Log::error('Error al liquidar gift card:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al procesar la liquidación'], 500);
        }
        
    }
    
    public function generarPDFLiquidacion(Request $request)
    {
        $data = $request->input('data');

        // Verifica si los datos recibidos son válidos
        if (is_null($data) || !is_array($data)) {
            return response()->json(['error' => 'Invalid data received'], 400);
        }

        // Asignación de valores con operador de fusión, usando valores predeterminados si las claves no existen
        $cargoVendedor = $data['cargoVendedor'] ?? 'No Position';
        $codigoCliente = $data['codigoCliente'] ?? 'No Cliente';
        $codigoVendedor = $data['codigoVendedor'] ?? 'No Codigo';
        $fechaMovimiento = $data['fechaMovimiento'] ?? now();
        $idAgrupacion = $data['idAgrupacion'] ?? 'No Agrupacion';
        $idTipoMovimiento = $data['idTipoMovimiento'] ?? 0;
        $idVendedor = $data['idVendedor'] ?? 'No ID';
        $nombreCliente = $data['nombreCliente'] ?? 'No Name';
        $nombreVendedor = $data['nombreVendedor'] ?? 'No Name';
        $valorMovimiento = $data['movimientos'][0]['valorMovimiento'] ?? 0;
        $movimientos = $data['movimientos'] ?? [];
        $fechaFormateada = date('dmy', strtotime($fechaMovimiento)); 
        $totalUnidades = 0;
        // Log::debug('Data recibida:', $data);

        $valorMovimientoFormateado = number_format($valorMovimiento, 2, '.', ',');


        // Nombre del archivo PDF
        $nombreArchivo = "Liquidacion{$fechaFormateada}-{$codigoVendedor}-{$codigoCliente}.pdf";

        // Crear objeto TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('José Ricardo Mejía Gámez');
        $pdf->SetTitle('Liquidacion PDF');
        $pdf->SetHeaderData('', 0, 'Compañía Farmaceutica S.A de C.V');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('P', 'LETTER');
        $pdf->SetFont('helvetica', '', 10);

        // Agregar contenido HTML al PDF
        $html = '
            <br>
            <h2 style="text-align: center; ">Control de paquetes patrocinios</h2>
            <h3 style="text-align: center; margin-top: 10px;"><strong>Gift Card a Liquidar</strong> $' . $valorMovimientoFormateado . '</h3>
            <table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tr>
                    <td width="50%"><strong>Nombre de Cliente:</strong><br> ' . $nombreCliente . '</td>
                    <td width="50%"><strong>Colaborador responsable:</strong> <br>' . $nombreVendedor . '</td>
                </tr>
                <tr>
                    <td width="50%"><strong>Código de cliente:</strong> ' . $codigoCliente . '</td>
                    <td width="50%"><strong>Fecha de Liquidación:</strong> ' . \Carbon\Carbon::parse($fechaMovimiento)->format('d/m/Y') . '</td>
                </tr>
            </table>
            <br>
            <br>
            <table border="1" cellpadding="4" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center; background-color: #f2f2f2; width: 15%;">Código Productos</th>
                        <th style="text-align: center; background-color: #f2f2f2; width: 70%;">Productos</th>
                        <th style="text-align: center; background-color: #f2f2f2; width: 15%;">Cantidad</th>
                    </tr>
                </thead>
                <tbody>';

        // Procesar los movimientos y agregar a la tabla
        foreach ($movimientos as $movimiento) {
            // Usamos el operador ?? para asegurar que todas las claves estén definidas, asignando valores predeterminados si no están presentes
            $codigoArticulo = $movimiento['codigoArticulo'] ?? 'No Código';
            $articulo = $movimiento['Articulo'] ?? 'No Artículo';
            $cantidadArticulo = $movimiento['cantidadArticulo'] ?? 0; // Asegurarse de que cantidadArticulo siempre tenga un valor numérico

            $totalUnidades += $cantidadArticulo;
            $html .= '<tr>';
            $html .= '<td style="text-align: left;  width: 15%">' . $codigoArticulo . '</td>';
            $html .= '<td style="text-align: left;  width: 70%">' . $articulo . '</td>';
            $html .= '<td style="text-align: right;  width: 15%">' . $cantidadArticulo . '</td>';
            $html .= '</tr>';
        }

        $html .= '
                </tbody>
            </table>
            <br>
            <br>
            <table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tr>
                    <td style="text-align: left; margin-top: 10px;"></td>
                    <td style="text-align: right; margin-top: 10px;"><strong>Total de Unidades:</strong> ' . $totalUnidades . '</td>
                </tr>
            </table>
        ';
        
        // Intentar generar el PDF
        try {
            $pdf->writeHTML($html, true, false, true, false, '');
        } catch (Exception $e) {
            Log::error('TCPDF Error:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al generar PDF'], 500);
        }

        // Devolver el PDF generado
        return response($pdf->Output($nombreArchivo, 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$nombreArchivo.'"');
    }

    public function devolucionGift(Request $request) {
        try {
            $request->validate([
                'IdVendedor' => 'required|integer',
                'IdGift' => 'required|integer',
                'Cantidad' => 'required|integer|min:1',
            ]);
    
            $idAgrupacion = DB::connection('DB_CONNECTION_GIFT')->table('Movimiento')->max('idAgrupacion') + 1;
            $cantidadRestante = $request['Cantidad'];
            $idGiftCard = $request['IdGift'];
            $idVendedor = $request['IdVendedor'];
    
            $facturasDisponibles = DB::connection('DB_CONNECTION_GIFT')
                ->table('Inventario_Vendedor_Giftcards')
                ->select('IdInventario', 'cantidad', 'IdFactura') // Asegúrate de incluir las columnas necesarias
                ->where('IdGiftCard', $idGiftCard)
                ->where('IdVendedor', $idVendedor)
                ->where('cantidad', '>', 0) // Cambiar 'Cantidad' a 'cantidad'
                ->orderBy('FechaReg', 'desc')
                ->get();
    
            if ($facturasDisponibles->isEmpty()) {
                return response()->json(['error' => 'No hay facturas disponibles para esta devolución.'], 400);
            }
    
            $user = Auth::user();
            $usuario = Adminbd::where('codigoEmp', $user->name)->first();
            $nombreUsuario = $usuario ? $usuario->usuario : null;
    
            $valorGiftCard = DB::connection('DB_CONNECTION_GIFT')
                ->table('GiftCards')
                ->where('idGift', $idGiftCard)
                ->value('valor');
    
            $movimientos = [];
            foreach ($facturasDisponibles as $factura) {
                Log::info('Procesando factura:', ['factura' => $factura]);
            
                if ($cantidadRestante <= 0) break;
            
                if (!isset($factura->cantidad)) {
                    Log::error('La columna "cantidad" no existe en la factura:', ['factura' => $factura]);
                    throw new Exception('La columna "cantidad" no está disponible en los datos recuperados.');
                }
            
                $cantidadDevolver = min($cantidadRestante, $factura->cantidad);
    
                $movimientos[] = [
                    'idFactura' => $factura->IdFactura,
                    'idGift' => $idGiftCard,
                    'idTipoMovimiento' => 4,
                    'idVendedor' => $idVendedor,
                    'idCliente' => null,
                    'idArticulo' => null,
                    'cantidad' => $cantidadDevolver,
                    'valorMovimiento' => $valorGiftCard * $cantidadDevolver,
                    'fechaMovimiento' => now(),
                    'usuarioReg' => $nombreUsuario,
                    'fechaReg' => now(),
                    'eliminado' => 0,
                    'idAgrupacion' => $idAgrupacion,
                ];
    
                // Actualizar inventario
                DB::connection('DB_CONNECTION_GIFT')
                    ->table('Inventario_Vendedor_Giftcards')
                    ->where('IdInventario', $factura->IdInventario)
                    ->update(['Cantidad' => DB::raw('Cantidad - ' . $cantidadDevolver)]);
    
                // Restar la cantidad devuelta de la cantidad restante
                $cantidadRestante -= $cantidadDevolver;
            }
    
            // Si quedó cantidad restante, no fue posible devolver completamente
            if ($cantidadRestante > 0) {
                return response()->json(['error' => 'No hay suficientes Gift Cards disponibles para la devolución completa.'], 400);
            }
    
            // Insertar los movimientos
            Movimientos::insert($movimientos);
    
            Log::info('Devolución procesada para Gift Card', [
                'movimientos' => $movimientos,
                'usuarioReg' => $nombreUsuario,
            ]);
    
            return response()->json(['message' => 'Gift cards devueltas correctamente']);
        } catch (Exception $e) {
            Log::error('Error al devolver gift card:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al procesar la devolución'], 500);
        }
    }    

    public function generarPDFDevolucion(Request $request)
    {
        // Obtener los datos enviados desde el frontend
        $data = $request->input('data');

        // Log::debug('Data recibida:', $data); //debug

        // Verificar que los datos sean válidos
        if (is_null($data) || !is_array($data)) {
            return response()->json(['error' => 'Invalid data received'], 400);
        }

        // Desestructurar los datos recibidos
        $idVendedor = $data['idVendedor'] ?? 'No ID';
        $nombreVendedor = $data['nombreVendedor'] ?? 'No Name';
        $cargoVendedor = $data['cargoVendedor'] ?? 'No Position';
        $idTipoMovimiento = $data['idTipoMovimiento'] ?? 0;
        $fechaMovimiento = $data['fechaMovimiento'] ?? now();
        $movimientos = $data['movimientos'] ?? [];
        $idAgrupacion = $data['idAgrupacion'] ?? 'NoAgrupacion';

        // Formatear la fecha para el nombre del archivo
        $fechaFormateada = date('dmy', strtotime($fechaMovimiento));

        // Generar el nombre del archivo PDF
        $nombreArchivo = "Recibo_{$fechaFormateada}_{$idVendedor}_{$idAgrupacion}.pdf";

        // Obtener el número de vendedor desde la base de datos (asegurándonos de que el campo 'codigo' existe)
        $numeroVendedor = DB::connection('DB_CONNECTION_GIFT')
            ->table('vVendedoresFiltrados')
            ->where('idVendedor', $idVendedor)
            ->value('codigo'); // Usamos value() para obtener solo el valor de 'codigo'

        $numeroVendedorString = isset($numeroVendedor) ? strval($numeroVendedor) : 'No Código';

        // Cargar la vista para la plantilla del PDF
        $html = view('giftcards.pdf_plantilla_entrega', compact('idVendedor', 'idAgrupacion', 'numeroVendedorString', 'nombreVendedor', 'cargoVendedor', 'idTipoMovimiento', 'fechaMovimiento', 'movimientos'))->render();

        // Crear una instancia de TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('José Ricardo Mejía Gámez');
        $pdf->SetTitle('Devolución PDF');
        $pdf->SetSubject("Devolución {$fechaFormateada} {$idVendedor} {$idAgrupacion}");

        // Configuración de los encabezados y pies de página
        $pdf->SetHeaderData('', 0, 'Compañía Farmaceutica S.A de C.V');
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Agregar una página al PDF
        $pdf->AddPage('P', 'LETTER');     

        $pdf->SetFont('helvetica', '', 12);

        // Escribir el contenido HTML del PDF
        try {
            $pdf->writeHTML($html, true, false, true, false, '');
        } catch (Exception $e) {
            Log::error('TCPDF Error:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al generar PDF'], 500);
        }

        // Devolver el PDF generado como respuesta
        return response($pdf->Output($nombreArchivo, 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $nombreArchivo . '"');
    }
}
