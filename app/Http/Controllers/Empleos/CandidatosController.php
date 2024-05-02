<?php

namespace App\Http\Controllers\Empleos;

use App\Http\Controllers\Controller;
use App\Models\Empleos\Candidato;
use App\Models\Empleos\Vacante;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class CandidatosController extends Controller
{
    public function index($id_vacante)
    {
        $usuario = User::with('perfil')->find(auth()->id());
        $vacante = Vacante::with('empresa', 'tipoContratacion', 'modalidad', 'pais', 'departamento', 'municipio')->find($id_vacante);

        return view('empleos.candidatos', compact('usuario', 'vacante'));
    }

    public function tablaCandidatos(Request $request, $id_vacante)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');

        $query = Candidato::select('candidatos.*')
            ->where('id_vacante', $id_vacante)
            ->orderByDesc('fecha_creacion');

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $candidatos = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($candidatos as $candidato) {
            $data[] = [
                'id' => $candidato->id,
                'contador' => $contador++,
                'nombre' => $candidato->nombre_candidato,
                $fecha_creacion = new DateTime($candidato->fecha_de_creacion),
                'fecha_creacion' => $fecha_creacion->format('d-m-Y H:i:s'),
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

    public function destroy($id)
    {
        $candidato = Candidato::find($id);

        if (!$candidato) {
            return response()->json([
                'success' => false,
                'error' => '¡Candidato no encontrado!'
            ]);
        }

        try {
            $candidato->delete();

            return response()->json(['success' => true, 'message' => '¡Candidato eliminado con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar el candidato']);
        }
    }
}
