<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use Illuminate\Support\Facades\Log;

class MunicipioController extends Controller
{
    public function index($departamento_id)
    {
        $municipios = Municipio::where('departamento_id', $departamento_id)->pluck('nombre', 'id');
        return response()->json($municipios);
    }
    public function tablaMunicipios(Request $request, $departamentoId)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $query = Municipio::select('municipios.*', 'usuarios.nombre as user_name', 'modified_users.nombre as user_modified_name')
            ->leftJoin('usuarios', 'municipios.user_id', '=', 'usuarios.id')
            ->leftJoin('usuarios as modified_users', 'municipios.user_modified_id', '=', 'modified_users.id')
            ->where('departamento_id', $departamentoId);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('municipios.nombre', 'like', "%$search%")
                    ->orWhere('municipios.codigo_mh', 'like', "%$search%")
                    ->orWhere('municipios.created_at', 'like', "%$search%")
                    ->orWhere('usuarios.nombre', 'like', "%$search%")
                    ->orWhere('municipios.updated_at', 'like', "%$search%")
                    ->orWhere('modified_users.nombre', 'like', "%$search%");
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

        $municipios = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($municipios as $municipio) {
            $data[] = [
                'id' => $municipio->id,
                'contador' => $contador++,
                'nombre' => $municipio->nombre,
                'codigo_mh' => $municipio->codigo_mh,
                'created_at' => $municipio->created_at->format('Y-m-d H:i:s'),
                'user_name' => $municipio->user_name,
                'updated_at' => $municipio->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $municipio->user_modified_name,
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
    public function store(Request $request, $departamentoId)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'codigo_mh' => 'required|string'
        ]);

        try {
            $nombreMunicipio = $request->input('nombre');
            $codigoMhMunicipio = $request->input('codigo_mh');

            if (!$codigoMhMunicipio) {
                return response()->json(['success' => false, 'error' => '¡Código MH requerido!']);
            }

            $municipio = new Municipio();
            $municipio->nombre = $nombreMunicipio;
            $municipio->codigo_mh = $codigoMhMunicipio;
            $municipio->departamento_id = $departamentoId;
            $municipio->user_id = auth()->user()->id;
            $municipio->save();

            return response()->json(['success' => true, 'message' => '¡Municipio registrado con éxito!', 'data' => $municipio]);
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
            $municipio = Municipio::findOrFail($id);

            $municipio->nombre = $request->input('nombre');
            $municipio->codigo_mh = $request->input('codigo_mh');
            $municipio->user_modified_id = auth()->user()->id;

            $municipio->save();

            return $this->sendResponse(true, '¡Municipio actualizado con éxito!', $municipio);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendResponse(false, 'El municipio no existe');
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
        $municipio = Municipio::find($id);

        if (!$municipio) {
            return response()->json([
                'success' => false,
                'error' => '¡Municipio no encontrado!'
            ]);
        }

        try {
            $municipio->nombre_tabla = 'Municipios';
            $municipio->user_deleted_id = auth()->user()->id;
            $municipio->save();

            $municipio->delete();

            return response()->json(['success' => true, 'message' => '¡Municipio eliminado con éxito!']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Error al eliminar el municipio.']);
        }
    }
}
