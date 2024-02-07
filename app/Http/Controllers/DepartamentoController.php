<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartamentoController extends Controller
{
    public function index($pais_id)
    {
        $departamentos = Departamento::where('pais_id', $pais_id)->pluck('nombre', 'id');
        return response()->json($departamentos);
    }
    public function tablaDepartamentos(Request $request, $paisId)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $query = Departamento::select('departamentos.*', 'users.name as user_name', 'modified_users.name as user_modified_name')
            ->leftJoin('users', 'departamentos.user_id', '=', 'users.id')
            ->leftJoin('users as modified_users', 'departamentos.user_modified_id', '=', 'modified_users.id')
            ->where('pais_id', $paisId);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('departamentos.nombre', 'like', "%$search%")
                    ->orWhere('departamentos.codigo_mh', 'like', "%$search%")
                    ->orWhere('departamentos.created_at', 'like', "%$search%")
                    ->orWhere('users.name', 'like', "%$search%")
                    ->orWhere('departamentos.updated_at', 'like', "%$search%")
                    ->orWhere('modified_users.name', 'like', "%$search%");
            });
        }

        if (!empty($orderColumnIndex)) {
            $columns = ['nombre', 'codigo_mh', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
            $orderColumn = $columns[$orderColumnIndex];
            $query->orderBy($orderColumn, $orderDirection);
        }

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();


        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $departamentos = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($departamentos as $departamento) {
            $data[] = [
                'id' => $departamento->id,
                'contador' => $contador++,
                'nombre' => $departamento->nombre,
                'codigo_mh' => $departamento->codigo_mh,
                'created_at' => $departamento->created_at->format('Y-m-d H:i:s'),
                'user_name' => $departamento->user_name,
                'updated_at' => $departamento->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $departamento->user_modified_name,
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
    public function store(Request $request, $paisId)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo_mh' => 'required|string'
        ]);

        try {
            $nombreDepartamento = $request->input('nombre');
            $codigoMhDepartamento = $request->input('codigo_mh');

            if (!$codigoMhDepartamento) {
                return response()->json(['success' => false, 'error' => '¡Código MH requerido!']);
            }

            $departamento = new Departamento();
            $departamento->nombre = $nombreDepartamento;
            $departamento->codigo_mh = $codigoMhDepartamento;
            $departamento->pais_id = $paisId;
            $departamento->user_id = auth()->user()->id;
            $departamento->save();

            return response()->json(['success' => true, 'message' => '¡Departamento registrado con éxito!', 'data' => $departamento]);
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
            $departamento = Departamento::findOrFail($id);

            $departamento->nombre = $request->input('nombre');
            $departamento->codigo_mh = $request->input('codigo_mh');
            $departamento->user_modified_id = auth()->user()->id;

            $departamento->save();

            return $this->sendResponse(true, '¡Departamento actualizado con éxito!', $departamento);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendResponse(false, 'El departamento no existe');
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
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json([
                'success' => false,
                'error' => '¡Departamento no encontrado!'
            ]);
        }

        try {
            $departamento->nombre_tabla = 'Departamentos';
            $departamento->user_deleted_id = auth()->user()->id;
            $departamento->save();

            $departamento->delete();

            return response()->json(['success' => true, 'message' => '¡Departamento eliminado con éxito!']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Error al eliminar el deparamento.']);
        }
    }

}
