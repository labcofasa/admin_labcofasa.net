<?php

namespace App\Http\Controllers\Empleos;

use App\Http\Controllers\Controller;
use App\Models\Empleos\Modalidad;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    public function obtenerModalidad()
    {
        $modalidad = Modalidad::pluck('nombre_modalidad', 'id');
        return response()->json($modalidad);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre_modalidad' => 'required|string'
        ]);

        try {
            $modalidad = new Modalidad();

            $modalidad->nombre_modalidad = $request->nombre_modalidad;
            $modalidad->fecha_creacion = now();
            $modalidad->fecha_modificacion = now();

            $modalidad->save();

            return response()->json(['success' => true, 'message' => '¡Modalidad registrada exitosamente!', 'data' => $modalidad]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al registrar la modalidad: ' . $e->getMessage()]);
        }
    }

    public function tablaModalidades(Request $request)
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

        $query = Modalidad::select('modalidades.*')->orderBy('modalidades.fecha_creacion', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('modalidades.nombre_modalidad', 'like', "%$search%");
            });
        }

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $modalidades = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($modalidades as $modalidad) {
            $data[] = [
                'id' => $modalidad->id,
                'contador' => $contador++,
                'nombre_modalidad' => $modalidad->nombre_modalidad,
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
            'nombre_modalidad' => 'sometimes|string',
        ]);

        try {
            $modalidad = Modalidad::findOrFail($id);

            $modalidad->nombre_modalidad = $request->input('nombre_modalidad');
            $modalidad->fecha_modificacion = now();

            $modalidad->save();

            return response()->json(['success' => true, 'message' => '¡Modalidad actualizada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al actualizar la modalidad.']);
        }
    }

    public function destroy($id)
    {
        $modalidad = Modalidad::find($id);

        try {
            $modalidad->delete();

            return response()->json(['success' => true, 'message' => '¡Modalidad eliminada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar la modalidad.']);
        }
    }
}
