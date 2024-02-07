<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EntidadController extends Controller
{
    public function obtenerEntidades()
    {
        $entidades = Entidad::pluck('nombre', 'id');
        return response()->json($entidades);
    }
    public function tablaEntidades(Request $request)
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

        $query = Entidad::select('entidades.*', 'users.name as user_name', 'modified_users.name as user_modified_name')
            ->leftJoin('users', 'entidades.user_id', '=', 'users.id')
            ->leftJoin('users as modified_users', 'entidades.user_modified_id', '=', 'modified_users.id');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('entidades.nombre', 'like', "%$search%")
                    ->orWhere('entidades.descripcion', 'like', "%$search%")
                    ->orWhere('entidades.created_at', 'like', "%$search%")
                    ->orWhere('users.name', 'like', "%$search%")
                    ->orWhere('entidades.updated_at', 'like', "%$search%")
                    ->orWhere('modified_users.name', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'nombre', 'descripcion', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $entidades = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($entidades as $entidad) {
            $data[] = [
                'id' => $entidad->id,
                'contador' => $contador++,
                'nombre' => $entidad->nombre,
                'descripcion' => $entidad->descripcion,
                'created_at' => $entidad->created_at->format('Y-m-d H:i:s'),
                'user_name' => $entidad->user_name,
                'updated_at' => $entidad->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $entidad->user_modified_name,
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
            'descripcion' => 'required|string',
        ]);

        try {
            $nombreEntidad = $request->input('nombre');
            $descripcionEntidad = $request->input('descripcion');

            if (!$descripcionEntidad) {
                return response()->json(['success' => false, 'error' => '¡Descripción requerida!']);
            }

            $entidad = new Entidad();
            $entidad->nombre = $nombreEntidad;
            $entidad->descripcion = $descripcionEntidad;
            $entidad->user_id = auth()->user()->id;
            $entidad->save();

            return response()->json(['success' => true, 'message' => '¡Entidad registrada con éxito!', 'data' => $entidad]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => '¡Guardado fallido!: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        try {
            $entidad = Entidad::findOrFail($id);

            $entidad->nombre = $request->input('nombre');
            $entidad->descripcion = $request->input('descripcion');
            $entidad->user_modified_id = auth()->user()->id;

            $entidad->save();

            return $this->sendResponse(true, '¡Entidad actualizada con éxito!', $entidad);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendResponse(false, 'La entidad no existe');
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
        $entidad = Entidad::find($id);

        if (!$entidad) {
            return response()->json([
                'success' => false,
                'error' => '¡Entidad no encontrada!'
            ]);
        }

        try {
            if ($entidad->id === 1) {
                return response()->json(['success' => false, 'error' => 'No eliminar esta entidad']);
            }

            $entidad->nombre_tabla = 'Entidades';
            $entidad->user_deleted_id = auth()->user()->id;
            $entidad->save();

            $entidad->delete();

            return response()->json(['success' => true, 'message' => '¡Entidad eliminada con éxito!']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Error al eliminar la entidad']);
        }
    }
}
