<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaisController extends Controller
{
    public function index()
    {
        $paises = Pais::pluck('nombre', 'id');
        return response()->json($paises);
    }
    public function tablaPaises(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $query = Pais::select('paises.*', 'usuarios.nombre as user_name', 'modified_users.nombre as user_modified_name')
            ->leftJoin('usuarios', 'paises.user_id', '=', 'usuarios.id')
            ->leftJoin('usuarios as modified_users', 'paises.user_modified_id', '=', 'modified_users.id');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('paises.nombre', 'like', "%$search%")
                    ->orWhere('paises.codigo_mh', 'like', "%$search%")
                    ->orWhere('paises.codigo_iso', 'like', "%$search%")
                    ->orWhere('paises.created_at', 'like', "%$search%")
                    ->orWhere('usuarios.nombre', 'like', "%$search%")
                    ->orWhere('paises.updated_at', 'like', "%$search%")
                    ->orWhere('modified_users.nombre', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'nombre', 'codigo_mh', 'codigo_iso', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $paises = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($paises as $pais) {
            $data[] = [
                'id' => $pais->id,
                'contador' => $contador++,
                'nombre' => $pais->nombre,
                'codigo_mh' => $pais->codigo_mh,
                'codigo_iso' => $pais->codigo_iso,
                'created_at' => $pais->created_at->format('Y-m-d H:i:s'),
                'user_name' => $pais->user_name,
                'updated_at' => $pais->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $pais->user_modified_name,
            ];
        }

        $registrosFiltrados = $filteredQuery->count();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRegistros,
            'recordsFiltered' => $registrosFiltrados,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo_mh' => 'required|string',
            'codigo_iso' => 'required|string'
        ]);

        try {
            $nombrePais = $request->input('nombre');
            $codigoMhPais = $request->input('codigo_mh');
            $codigoIsoPais = $request->input('codigo_iso');

            if (!$codigoMhPais) {
                return response()->json(['success' => false, 'error' => '¡Código MH requerido!']);
            }

            if (!$codigoIsoPais) {
                return response()->json(['success' => false, 'error' => '¡Código ISO requerido!']);
            }

            $pais = new Pais();
            $pais->nombre = $nombrePais;
            $pais->codigo_mh = $codigoMhPais;
            $pais->codigo_iso = $codigoIsoPais;
            $pais->user_id = auth()->user()->id;
            $pais->save();

            return response()->json(['success' => true, 'message' => '¡País registrado con éxito!', 'data' => $pais]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => '¡Guardado fallido!: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo_mh' => 'required|string',
            'codigo_iso' => 'required|string',
        ]);

        try {
            $pais = Pais::findOrFail($id);

            $pais->nombre = $request->input('nombre');
            $pais->codigo_mh = $request->input('codigo_mh');
            $pais->codigo_iso = $request->input('codigo_iso');
            $pais->user_modified_id = auth()->user()->id;

            $pais->save();

            return $this->sendResponse(true, '¡País actualizado con éxito!', $pais);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendResponse(false, 'El país no existe');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendResponse(false, '¡Actualización fallida!: ' . $e->getMessage());
        }
    }
    private function sendResponse($success, $message, $data = null)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $pais = Pais::find($id);

        if (!$pais) {
            return response()->json([
                'success' => false,
                'error' => '¡País no encontrado!'
            ]);
        }

        try {
            $pais->nombre_tabla = 'Paises';
            $pais->user_deleted_id = auth()->user()->id;
            $pais->save();

            $pais->delete();

            return response()->json(['success' => true, 'message' => '¡País eliminado con éxito!']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Error al eliminar el país.']);
        }
    }
}
