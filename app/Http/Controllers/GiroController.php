<?php

namespace App\Http\Controllers;

use App\Models\Giro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GiroController extends Controller
{
    public function obtenerGiros(Request $request)
    {
        $query = $request->input('query');

        $resultados = Giro::where('nombre', 'like', "%{$query}%")
            ->orWhere('codigo_mh', 'like', "%{$query}%")
            ->distinct()
            ->get(['id', 'nombre', 'codigo_mh']);

        return response()->json(['giros' => $resultados]);
    }

    public function tablaGiros(Request $request)
    {
        $this->validate($request, [
            'draw' => 'required',
            'start' => 'required|numeric',
            'length' => 'required|numeric',
            'search.value' => 'nullable|string',
            'order.0.column' => 'required|numeric',
            'order.0.dir' => 'required|in:asc,desc',
        ]);

        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $query = Giro::select('giros.*', 'usuarios.nombre as user_name', 'modified_users.nombre as user_modified_name')
            ->leftJoin('usuarios', 'giros.user_id', '=', 'usuarios.id')
            ->leftJoin('usuarios as modified_users', 'giros.user_modified_id', '=', 'modified_users.id');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('giros.nombre', 'like', "%$search%")
                    ->orWhere('giros.codigo_mh', 'like', "%$search%")
                    ->orWhere('giros.created_at', 'like', "%$search%")
                    ->orWhere('usuarios.nombre', 'like', "%$search%")
                    ->orWhere('giros.updated_at', 'like', "%$search%")
                    ->orWhere('modified_users.nombre', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'nombre', 'codigo_mh', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $giros = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($giros as $giro) {
            $data[] = [
                'id' => $giro->id,
                'contador' => $contador++,
                'nombre' => $giro->nombre,
                'codigo_mh' => $giro->codigo_mh,
                'created_at' => $giro->created_at->format('Y-m-d H:i:s'),
                'user_name' => $giro->user_name,
                'updated_at' => $giro->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $giro->user_modified_name,
            ];
        }

        $recordsFiltered = $filteredQuery->count();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRegistros,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo_mh' => 'required|string',
        ]);

        try {
            $nombreGiro = $request->input('nombre');
            $codigoMhGiro = $request->input('codigo_mh');

            if (!$codigoMhGiro) {
                return response()->json(['success' => false, 'error' => '¡Código MH requerida!']);
            }

            $giro = new Giro();
            $giro->nombre = $nombreGiro;
            $giro->codigo_mh = $codigoMhGiro;
            $giro->user_id = auth()->user()->id;
            $giro->save();

            return response()->json(['success' => true, 'message' => '¡Actividad económica registrada con éxito!', 'data' => $giro]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => '¡Guardado fallido!: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo_mh' => 'required|string',
        ]);

        try {
            $giro = Giro::findOrFail($id);

            $giro->nombre = $request->input('nombre');
            $giro->codigo_mh = $request->input('codigo_mh');
            $giro->user_modified_id = auth()->user()->id;

            $giro->save();

            return $this->sendResponse(true, 'Actividad económica actualizada con éxito!', $giro);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendResponse(false, 'La actividad económica no existe');
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
        $giro = Giro::find($id);

        if (!$giro) {
            return response()->json([
                'success' => false,
                'error' => '¡Giro no encontrada!'
            ]);
        }

        try {
            if ($giro->id === 1) {
                return response()->json(['success' => false, 'error' => 'No eliminar esta actividad económica']);
            }

            $giro->nombre_tabla = 'Giros';
            $giro->user_deleted_id = auth()->user()->id;
            $giro->save();

            $giro->delete();

            return response()->json(['success' => true, 'message' => '¡Actividad económica eliminada con éxito!']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Error al eliminar la actividad económica']);
        }

    }
}
