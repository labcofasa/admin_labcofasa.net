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

    public function getMovimientosAgrupados(){
        $movimientos = DB::connection('DB_CONNECTION_GIFT')
            ->table('vMovimientosAgrupados')
            ->orderBy('fechaMovimiento','desc')
            ->get()
            ->groupBy('idAgrupacion');
        $resultado = [];
        
        foreach ($movimientos as $idAgrupacion  => $movimientosAgrupados) {
            $vendedorInfo = $movimientosAgrupados->first();

            $vendedorData = [
                'idVendedor' => $vendedorInfo->idVendedor,
                'idAgrupacion' => $vendedorInfo->idAgrupacion,
                'nombreVendedor' => $vendedorInfo->nombreVendedor,
                'cargoVendedor' => $vendedorInfo->cargoVendedor,
                'idTipoMovimiento' => $vendedorInfo->idTipoMovimiento,
                'fechaMovimiento' => $vendedorInfo->fechaMovimiento,
                'movimientos' => []
            ];

            foreach ($movimientosAgrupados as $movimiento) {
                $vendedorData['movimientos'][] = [
                    'idGiftCard' => $movimiento->idGift,
                    'valorUnitario' => $movimiento->valor,
                    'Correlativo' => $movimiento->Correlativo,
                    'cantidad' => $movimiento->cantidad,
                    'idFactura' => $movimiento->idFactura,
                    'valorMovimiento' => $movimiento->valorMovimiento,
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

        $data = $request->input('data');

        if (is_null($data) || !is_array($data)) {
            return response()->json(['error' => 'Invalid data received'], 400);
        }

        $idVendedor = $data['idVendedor'] ?? 'No ID';
        $nombreVendedor = $data['nombreVendedor'] ?? 'No Name';
        $cargoVendedor = $data['cargoVendedor'] ?? 'No Position';
        $idTipoMovimiento = $data['idTipoMovimiento'] ?? 0;
        $fechaMovimiento = $data['fechaMovimiento'] ?? now();
        $movimientos = $data['movimientos'] ?? [];
        $idAgrupacion = $data['idAgrupacion'] ?? 'NoAgrupacion';
        $fechaFormateada = date('dmy', strtotime($fechaMovimiento));
        $nombreArchivo = "Recibo{$fechaFormateada}{$idVendedor}{$idAgrupacion}.pdf";
        $numeroVendedor = DB::connection('DB_CONNECTION_GIFT')
        ->table('vVendedoresFiltrados')->select('codigo')
        ->select('codigo')
        ->where('idVendedor', $idVendedor)
        ->first();
        $numeroVendedorString = isset($numeroVendedor->codigo) ? strval($numeroVendedor->codigo) : '';

        $html = view('giftcards.pdf_plantilla_entrega', compact('idVendedor', 'idAgrupacion', 'numeroVendedorString' ,'nombreVendedor', 'cargoVendedor' ,'idTipoMovimiento', 'fechaMovimiento', 'movimientos'))->render();

        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('José Ricardo Mejía Gámez');
        $pdf->SetTitle('Recibos PDF');
        $pdf->SetSubject('Recibo'.$fechaFormateada.$idVendedor.$idAgrupacion); 

        $pdf->SetHeaderData('', 0, 'Compañía Farmaceutica S.A de C.V');
    
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
        $pdf->SetMargins(10,  10, 10);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
    
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
        $pdf->AddPage('P', 'LETTER');
    
        $pdf->SetFont('helvetica', '', 12);

        try {
            $pdf->writeHTML($html, true, false, true, false, '');
        } catch (Exception $e) {
            Log::error('TCPDF Error:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al generar PDF'], 500);
        }
        return response($pdf->Output($nombreArchivo, 'S'))
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="'.$nombreArchivo.'"');
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
                    ->select('ivg.idInventario', 'ivg.idVendedor', 'gc.valor', 'ivg.idGiftCard' ,'ivg.cantidad')
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
            $valorMovimiento =  DB::connection('DB_CONNECTION_GIFT')->table('GiftCards')->where('idGift', $request->input('giftCard'))
            ->value('valor');
    
            foreach ($request->input('productos') as $producto) {
                $movimiento = Movimientos::create([
                    'idFactura' => null,
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
            DB::connection('DB_CONNECTION_GIFT')->table('Inventario_Vendedor_GiftCards')
            ->where('idVendedor', $request->input('vendedor'))
            ->where('idGiftCard', $request->input('giftCard'))
            ->update([
                'cantidad' => DB::raw('cantidad - 1'),
                'fechaMod' => now(),
                'usuarioMod' => $nombreUsuario
            ]);
            return response()->json(['message' => 'Gift Cards liquidadas correctamente'], 201);
        }catch(Exception $e){
            Log::error('Error al liquidar gift card:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al procesar la liquidación'], 500);
        }
        
    }

    public function getLiquidaciones(){
        $movimientos = DB::connection('DB_CONNECTION_GIFT')
            ->table('vMovimientosLiquidacion')
            ->orderBy('fechaMovimiento','desc')
            ->get()
            ->groupBy('idAgrupacion');
                        
            $resultado = [];
        
            foreach ($movimientos as $idAgrupacion  => $movimientosLAgrupados) {
                $vendedorInfo = $movimientosLAgrupados->first();
    
                $vendedorData = [
                    'idVendedor' => $vendedorInfo->idVendedor,
                    'idAgrupacion' => $vendedorInfo->idAgrupacion,
                    'nombreVendedor' => $vendedorInfo->nombreVendedor,
                    'cargoVendedor' => $vendedorInfo->cargoVendedor,
                    'codigoCliente' => $vendedorInfo->codigoCliente,
                    'codigoVendedor' => $vendedorInfo->codigoVendedor,
                    'nombreCliente' => $vendedorInfo->nombreCliente,
                    'idTipoMovimiento' => $vendedorInfo->idTipoMovimiento,
                    'fechaMovimiento' => $vendedorInfo->fechaMovimiento,
                    'valorMovimiento' => $vendedorInfo->valorMovimiento,
                    'idGiftCard' => $vendedorInfo->idGift,
                    'valorUnitario' => $vendedorInfo->valor,
                    'movimientos' => []
                ];
    
                foreach ($movimientosLAgrupados as $movimiento) {
                    $vendedorData['movimientos'][] = [
                        'codigoArticulo' => $movimiento->codigoArticulo,
                        'Articulo' => $movimiento->Articulo,
                        'cantidadArticulo' => $movimiento->cantidadArticulo, 
                    ];
                }
    
                $resultado[] = $vendedorData;
            }
    
            return response()->json($resultado);
    }
    
    public function generarPDFLiquidacion(Request $request)
    {
        $data = $request->input('data');

        if (is_null($data) || !is_array($data)) {
            return response()->json(['error' => 'Invalid data received'], 400);
        }

        $cargoVendedor = $data['cargoVendedor'] ?? 'No Position';
        $codigoCliente = $data['codigoCliente'] ?? 'No Cliente';
        $codigoVendedor = $data['codigoVendedor'] ?? 'No Codigo';
        $fechaMovimiento = $data['fechaMovimiento'] ?? now();
        $idAgrupacion = $data['idAgrupacion'] ?? 'No Agrupacion';
        $idTipoMovimiento = $data['idTipoMovimiento'] ?? 0;
        $idVendedor = $data['idVendedor'] ?? 'No ID';
        $nombreCliente = $data['nombreCliente'] ?? 'No Name';
        $nombreVendedor = $data['nombreVendedor'] ?? 'No Name';
        $valorMovimiento = $data['valorMovimiento'] ?? 'No valorMovimiento';
        $movimientos = $data['movimientos'] ?? [];
        $fechaFormateada = date('dmy', strtotime($fechaMovimiento)); 
        $totalUnidades = 0;

        $nombreArchivo = "Liquidacion{$fechaFormateada}-{$codigoVendedor}-{$codigoCliente}.pdf";

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('José Ricardo Mejía Gámez');
        $pdf->SetTitle('Liquidacion PDF');

        $pdf->SetHeaderData('', 0, 'Compañía Farmaceutica S.A de C.V');
    
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
        $pdf->SetMargins(10,  10, 10);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
    
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
        $pdf->AddPage('P', 'LETTER');
    
        $pdf->SetFont('helvetica', '', 10);
        
        //$html = view('giftcards.pdf_plantilla_liquidacion', compact('data'))->render();
        $html = '
            <br>
            <h2 style="text-align: center; ">Control de paquetes patrocinios</h2>
            <h3 style="text-align: center; margin-top: 10px;"><strong>Gift Card a Liquidar</strong> $' . $data['valorMovimiento'] . '</h3>
            <table border="0" cellpadding="4" cellspacing="0" width="100%">
                <tr>
                    <td width="50%"><strong>Nombre de Cliente:</strong><br> ' . $data['nombreCliente'] . '</td>
                    <td width="50%"><strong>Colaborador responsable:</strong> <br>' . $data['nombreVendedor'] . '</td>
                </tr>
                <tr>
                    <td width="50%"><strong>Código de cliente:</strong> ' . $data['codigoCliente'] . '</td>
                    <td width="50%"><strong>Fecha de Liquidación:</strong> ' . \Carbon\Carbon::parse($data['fechaMovimiento'])->format('d/m/Y') . '</td>
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

        foreach ($data['movimientos'] as $movimiento) {
            $totalUnidades += $movimiento['cantidadArticulo'];
            $html .= '<tr>';
            $html .= '<td style="text-align: left;  width: 15%">' . $movimiento['codigoArticulo'] . '</td>';
            $html .= '<td style="text-align: left;  width: 70%">' . $movimiento['Articulo'] . '</td>';
            $html .= '<td style="text-align: right;  width: 15%">' . $movimiento['cantidadArticulo'] . '</td>';
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
        

       
        
        try {
            $pdf->writeHTML($html, true, false, true, false, '');
        } catch (Exception $e) {
            Log::error('TCPDF Error:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Error al generar PDF'], 500);
        }

        return response($pdf->Output($nombreArchivo, 'S'))
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="'.$nombreArchivo.'"');
    }

    public function devolucionGift(Request $request){

    }
}
