<?php

namespace App\Http\Controllers\Empleos;

use App\Http\Controllers\Controller;
use App\Models\Empleos\TipoContratacion;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TipoContratacionController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre_tipo' => 'nullable|string'
        ]);

        try {
            $tipo = new TipoContratacion();

            $tipo->nombre_tipo = $request->nombre_tipo;
            $tipo->fecha_creacion = now();
            $tipo->fecha_modificacion = now();

            $tipo->save();

            return response()->json(['success' => true, 'message' => '¡Tipo de contratación registrada exitosamente!', 'data' => $tipo]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al registrar el tipo de contratación: ' . $e->getMessage()]);
        }
    }

    public function tablaTipoContratacion(Request $request)
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

        $query = TipoContratacion::select('tipo_contratacion.*');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('tipo_contratacion.nombre_tipo', 'like', "%$search%");
                // ->orWhere('modified_users.name', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'nombre_tipo'];
        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $tipo_contratos = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($tipo_contratos as $tipo_contrato) {
            $data[] = [
                'id' => $tipo_contrato->id,
                'contador' => $contador++,
                'nombre_tipo' => $tipo_contrato->nombre_tipo,
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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre_tipo' => 'sometimes|string',
        ]);

        try {
            $tipo = TipoContratacion::findOrFail($id);

            $tipo->nombre_tipo = $request->input('nombre_tipo');
            $tipo->fecha_modificacion = now();

            $tipo->save();

            return response()->json(['success' => true, 'message' => '¡Tipo de contratación actualizada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al actualizar el tipo de contratación.']);
        }
    }

    public function destroy($id)
    {
        $tipo = TipoContratacion::find($id);

        try {
            $tipo->delete();

            return response()->json(['success' => true, 'message' => '¡Tipo de contratación eliminada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar el tipo de contratación.']);
        }
    }
}
