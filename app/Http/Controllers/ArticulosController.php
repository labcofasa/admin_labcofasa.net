<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Adminbd;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArticulosController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->get('search', '');
        
        $articulosQuery = DB::connection('DB_CONNECTION_GIFT')
            ->table('Articulos')
            ->join('Control_GiftCards.dbo.vArticulos as v', 'v.codigo', '=', 'Articulos.codigo')
            ->select('Articulos.codigo', 'v.nombre')
            ->where('Articulos.eliminado', '!=', 1);

        if ($searchTerm) {
            $articulosQuery->where(function ($query) use ($searchTerm) {
                $query->where('Articulos.codigo', 'like', '%' . $searchTerm . '%')
                    ->orWhere('v.nombre', 'like', '%' . $searchTerm . '%');
            });
        }

        $articulos = $articulosQuery->paginate(7);

        if ($articulos->isEmpty()) {
            return response()->json([
                'error' => 'No se encontraron resultados para la búsqueda',
                'articulos' => [],
                'pagination' => '',
                'paginationText' => ''
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'articulos' => view('partials.articulos-tabla', ['articulos' => $articulos])->render(),
                'pagination' => (string) $articulos->links('pagination::bootstrap-5'),
                'paginationText' => 'Mostrando ' . $articulos->firstItem() . ' a ' . $articulos->lastItem() . ' de ' . $articulos->total() . ' resultados',
            ]);
        }
    

        $usuario = User::find(auth()->id());
        return view('giftcards.articulos', compact('usuario', 'articulos', 'searchTerm'));
    }

    public function store(Request $request){
        $request->validate([
            'producto_id' => 'required|string',
        ]);

        $productoId = $request->input('producto_id');
        $user = Auth::user();
        $id = $user->name; 
 
        $usuario = Adminbd::where('codigoEmp', $id)->first();
        $nombreUsuario = $usuario ? $usuario->usuario : null;
        $existeProducto = DB::connection('DB_CONNECTION_GIFT')->table('dbo.Articulos')
        ->where('codigo', $productoId)
        ->where('eliminado', '!=', 1)->exists();
        if ($existeProducto){
            return response()->json([
                'status' => 'error',
                'message' => 'El producto ya existe en la base de datos.'
            ], 400); 
        }
        DB::connection('DB_CONNECTION_GIFT')->table('dbo.Articulos')->insert([
            'codigo' => $productoId,
            'eliminado' => 0,
            'usuarioReg' => $nombreUsuario,
            'fechaReg' => now(),
        ]);

        return response()->json([
        'status' => 'success',
        'message' => 'Producto agregado exitosamente.'
        ], 200);
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:3',
        ]);

        $searchTerm = $request->get('q');

        $productos = DB::connection('DB_CONNECTION_GIFT')
            ->table('vArticulos')
            ->where('codigo', 'LIKE', "%{$searchTerm}%") 
            ->orWhere('nombre', 'LIKE', "%{$searchTerm}%") 
            ->take(5)
            ->get(['codigo', 'nombre']); 

        $suggestions = $productos->map(function ($producto){
            $existe = DB::connection('DB_CONNECTION_GIFT')
                    ->table('Articulos')
                    ->where('codigo', $producto->codigo)
                    ->where('eliminado', '!=', 1)->exists();

                    return [
                        'codigo' => $producto->codigo,
                        'nombre' => $producto->nombre,
                        'existe' => $existe,
                    ];
        });

        return response()->json([
            'suggestions' => $suggestions
        ]);
    }

    public function eliminar($codigo)
    {
        $articulo = DB::connection('DB_CONNECTION_GIFT')
            ->table('Articulos')
            ->where('codigo', $codigo)
            ->first();

        if (!$articulo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado.'
            ], 404);
        }

        DB::connection('DB_CONNECTION_GIFT')
            ->table('Articulos')
            ->where('codigo', $codigo)
            ->update(['eliminado' => 1]);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto marcado como eliminado exitosamente.'
        ]);
    }

}

