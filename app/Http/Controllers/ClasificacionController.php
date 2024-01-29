<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clasificacion;

class ClasificacionController extends Controller
{
    public function obtenerClasificaciones()
    {
        $clasificaciones = Clasificacion::pluck('nombre', 'id');
        return response()->json($clasificaciones);
    }
    public function tablaClasificaciones(Request $request)
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

        $query = Clasificacion::select('clasificaciones.*', 'usuarios.nombre as user_name', 'modified_users.nombre as user_modified_name')
            ->leftJoin('usuarios', 'clasificaciones.user_id', '=', 'usuarios.id')
            ->leftJoin('usuarios as modified_users', 'clasificaciones.user_modified_id', '=', 'modified_users.id');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('clasificaciones.nombre', 'like', "%$search%")
                    ->orWhere('clasificaciones.codigo', 'like', "%$search%")
                    ->orWhere('clasificaciones.created_at', 'like', "%$search%")
                    ->orWhere('usuarios.nombre', 'like', "%$search%")
                    ->orWhere('clasificaciones.updated_at', 'like', "%$search%")
                    ->orWhere('modified_users.nombre', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'nombre', 'codigo', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $clasificaciones = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($clasificaciones as $clasificacion) {
            $data[] = [
                'id' => $clasificacion->id,
                'contador' => $contador++,
                'nombre' => $clasificacion->nombre,
                'codigo' => $clasificacion->codigo,
                'created_at' => $clasificacion->created_at->format('Y-m-d H:i:s'),
                'user_name' => $clasificacion->user_name,
                'updated_at' => $clasificacion->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $clasificacion->user_modified_name,
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
            'codigo' => 'required|string',
        ]);

        try {
            $nombreClasificacion = $request->input('nombre');
            $codigoClasificacion = $request->input('codigo');

            $clasificacion = new Clasificacion();
            $clasificacion->nombre = $nombreClasificacion;
            $clasificacion->codigo = $codigoClasificacion;
            $clasificacion->user_id = auth()->user()->id;
            $clasificacion->save();

            return response()->json(['success' => true, 'message' => '¡Clasificación registrada con éxito!', 'data' => $clasificacion]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => '¡Guardado fallido!: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo' => 'required|string',
        ]);

        try {
            $clasificacion = Clasificacion::findOrFail($id);

            $clasificacion->nombre = $request->input('nombre');
            $clasificacion->codigo = $request->input('codigo');
            $clasificacion->user_modified_id = auth()->user()->id;

            $clasificacion->save();

            return $this->sendResponse(true, '¡Clasificación actualizada con éxito!', $clasificacion);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendResponse(false, 'La clasificación no existe');
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
        $clasificacion = Clasificacion::find($id);

        if (!$clasificacion) {
            return response()->json([
                'success' => false,
                'error' => '¡Clasificación no encontrada!'
            ]);
        }

        try {
            if ($clasificacion->id === 1) {
                return response()->json(['success' => false, 'error' => 'No eliminar esta clasificación']);
            }

            $clasificacion->nombre_tabla = 'Clasificaciones';
            $clasificacion->user_deleted_id = auth()->user()->id;
            $clasificacion->save();

            $clasificacion->delete();

            return response()->json(['success' => true, 'message' => '¡Clasificación eliminada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar la clasificación']);
        }
    }
}
