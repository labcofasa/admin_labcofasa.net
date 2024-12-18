<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Factura;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Adminbd;

class FacturaController extends Controller
{
    public function index()
    {
        $usuario = User::find(auth()->id());
        return view('giftcards.facturas', compact('usuario'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'Correlativo' => 'required|string',
            'Fecha_Compra' => 'required|date',
            'NRC_Proveedor' => 'required|string', // Asegúrate de que esto coincida con tu base de datos
            'subTotal' => 'required|numeric',
            'montoTotal' => 'required|numeric',
            'giftcards' => 'required|array',
            'giftcards.*.idGiftCard' => 'required|integer',
            'giftcards.*.cantidad' => 'required|integer',
            'giftcards.*.descripcion' => 'nullable|string',
        ]);

        $correlativo = $validatedData['Correlativo'];
        $fechaCompra = $validatedData['Fecha_Compra'];
        $nrcProveedor = $validatedData['NRC_Proveedor']; 
        $subTotal = $validatedData['subTotal'];
        $montoTotal = $validatedData['montoTotal'];
        $giftCards = $validatedData['giftcards'];

        $user = Auth::user();
        $id = $user->name; 
        $usuario = Adminbd::where('codigoEmp', $id)->first();
        $nombreUsuario = $usuario ? $usuario->usuario : null;
        $fechaReg = now();
        $eliminado = 0;

        try {
            // Llamar al método de inserción en el modelo
            Factura::insertarFactura($correlativo, $fechaCompra, $nrcProveedor, $subTotal, $montoTotal, $giftCards, $nombreUsuario, $fechaReg, $eliminado);
            
            // Retornar los datos para la consola
            return response()->json([
                'message' => 'Factura guardada exitosamente.',
                'data' => [
                    'Correlativo' => $correlativo,
                    'Fecha_Compra' => $fechaCompra,
                    'NRC_Proveedor' => $nrcProveedor,
                    'SubTotal' => $subTotal,
                    'MontoTotal' => $montoTotal,
                    'GiftCards' => $giftCards,
                    'eliminado' => $eliminado,
                    'usuarioReg' => $nombreUsuario,
                    'fechaReg' => $fechaReg,
                ],
            ]);
            
        } catch (\Exception $e) {
            // Manejar el error y registrar el mensaje de error
            Log::error('Error al guardar la factura: ' . $e->getMessage(), [
                'Correlativo' => $correlativo,
                'Fecha_Compra' => $fechaCompra,
                'NRC_Proveedor' => $nrcProveedor,
                'SubTotal' => $subTotal,
                'MontoTotal' => $montoTotal,
                'GiftCards' => $giftCards,
                'usuarioReg' => $nombreUsuario,
                'fechaReg' => $fechaReg,
                'eliminado' => $eliminado,
                'exception' => $e,
            ]);

            // Retornar un mensaje de error con el código de estado 500
            return response()->json(['message' => 'Error al guardar la factura: ' . $e->getMessage()], 500);
        }
    }     
    
    public function getFacturas()
    {
        $facturas = Factura::with('factura_detalles')
                   ->where('eliminado', 0)
                   ->orderBy('Fecha_Compra', 'desc')
                   ->get();

        return response()->json(['data' => $facturas]);
    }

    public function eliminarFactura($idFactura)
    {
        $factura = Factura::find($idFactura);
    
        if (!$factura) {
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }
    
        $factura->eliminado = 1;
        $factura->save();
    
        foreach ($factura->factura_detalles as $detalle) {
            $detalle->eliminado = 1;
            $detalle->save();
        }
    
        return response()->json(['message' => 'Factura eliminada exitosamente'], 200);
    }     

    public function detalleFactura($idFactura)
    {
        $factura = Factura::with(['factura_detalles.giftCard']) 
            ->where('idFactura', $idFactura)
            ->first();

        if (!$factura) {
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }

        $proveedor  = Proveedor::where('RegIva', $factura->NRC_Proveedor)->first();

        $data = [
            'Correlativo' => $factura->Correlativo,
            'Fecha_Compra' => $factura->Fecha_Compra,
            'NRC_Proveedor' => $factura->NRC_Proveedor,
            'MontoTotal' => $factura->MontoTotal,
            'Nombre_Proveedor' => $proveedor ? $proveedor->Nombre : 'Desconocido',
            'detalles' => $factura->factura_detalles->map(function ($detalle) {
                return [
                    'descripcion' => $detalle->descripcion,
                    'cantidad' => $detalle->cantidad,
                    'valorGiftCard' => $detalle->giftCard->valor,
                ];
            }),
        ];

        return response()->json($data);
    }

}
