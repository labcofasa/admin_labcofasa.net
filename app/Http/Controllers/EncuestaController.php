<?php

namespace App\Http\Controllers;

use App\Models\EncuestaObs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Encuesta;
use App\Models\viewEmpleadoEncuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;
use App\Models\Adminbd;
use Symfony\Component\Console\Input\Input;

class EncuestaController extends Controller
{
    public function index()
    {
        $usuario = User::find(auth()->id());
        return view('empleos/encuestas', compact('usuario'));
    }

    public function create()
    {
        $usuario = User::find(auth()->id());
        return view('empleos/crear-encuestas', compact('usuario'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
    

    public function tablaEncuestas(Request $request)
    {
        $codigoEvaluador = intval(Auth::user()->name);
        //Toma la vista vEmpleadosActivosT y los ordena por relacion
        $query = viewEmpleadoEncuesta::where('CodEvaluador', $codigoEvaluador)->orderBy('relacion', 'asc')->get();       
        return response()->json([
            'data' => $query,  
        ]);
    }

    public function cargarPreguntas(Request $request)
    {

        $tipo = $request->input('tipo');

        $preguntas = DB::connection('DB_CONNECTION_ENCUESTAS')->select("
            SELECT 
                0 as IdEncuesta,
                Competencia.Tipo,
                Comportamiento.IdCompetencia,
                Competencia.Numero,
                IdComportamiento,
                Posicion,
                Competencia.Nombre as Competencia,
                Comportamiento.Nombre
            FROM Comportamiento 
            INNER JOIN Competencia ON Comportamiento.IdCompetencia = Competencia.IdCompetencia 
            WHERE (Comportamiento.eliminado IS NULL OR Comportamiento.eliminado = 0) AND Competencia.Tipo = :tipo
            ORDER BY Comportamiento.IdCompetencia, Posicion
        ", ['tipo' => $tipo]);

        $escalas = DB::connection('DB_CONNECTION_ENCUESTAS')->select("SELECT IdEscala, Alias as Nombre, Nombre as nom,  Valor FROM Escala");

        return response()->json([
            'data' => $preguntas,
            'escalas' => $escalas,
        ]);
    }

    public function guardarEncuesta(Request $request)
    {
        try {
            $encuestas = $request->input('encuestas');

            foreach ($encuestas as $encuesta) {
                // Convertir datos a enteros
                $CodEvaluador = (int) $encuesta['CodEvaluador'];
                $Tipo = (int) $encuesta['Tipo'];
                $Numero = (int) $encuesta['Numero'];
                $CodEvaluar = (int) $encuesta['CodEvaluar'];
                $IdCompetencia = (int) $encuesta['IdCompetencia'];
                $IdComportamiento = (int) $encuesta['IdComportamiento'];
                $IdEscala = (int) $encuesta['IdEscala'];
                $Relacion = (int) $encuesta['Relacion'];
                $FechaReg = $encuesta['FechaReg']; // Asumimos que este campo está en el formato datetime adecuado
                $usuarioReg = $encuesta['usuarioReg'];

                Encuesta::create([
                    'CodEvaluador' => $CodEvaluador,
                    'Tipo' => $Tipo,
                    'Numero' => $Numero,
                    'CodEvaluar' => $CodEvaluar,
                    'IdCompetencia' => $IdCompetencia,
                    'IdComportamiento' => $IdComportamiento,
                    'IdEscala' => $IdEscala,
                    'Relacion' => $Relacion,
                    'FechaReg' => $FechaReg,
                    'UsuarioReg' => $usuarioReg
                ]);
            }

            return response()->json(['message' => 'Encuesta guardada con éxito.'], 200);
        } catch (\Exception $e) {
            // Registrar el error en los logs
            Log::error('Error al guardar la encuesta: ' . $e->getMessage());

            // Devolver una respuesta de error
            return response()->json(['message' => 'Ocurrió un error al guardar la encuesta.'], 500);
        }
       
    }

    public function getUserData()
    {
        // Obtener el codigo de usuario actual
        $user = Auth::user();
        $id = $user->name; 

        $usuario = Adminbd::where('codigoEmp', $id)->first();
        $nombreUsuario = $usuario ? $usuario->usuario : null;

        // Devolver los datos como JSON
        return response()->json([
            'codigo' => $id,
            'usuario'=> $nombreUsuario,
        ]);
    }

    public function guardarObs(Request $request)
    {
        $request->validate([
            'CodEvaluador' => 'nullable|integer',
            'CodEvaluar' => 'nullable|integer',
            'observaciones' => 'nullable|string|max:1000',
            'curso'=> 'nullable|string|max:100',
            'usuarioReg' => 'nullable|string',
            'FechaReg' => 'nullable|string',
        ]);   

        $codEvaluador = $request->input('CodEvaluador');
        $codEvaluar = $request->input('CodEvaluar');
        $observacion = $request->input('Observacion');
        $nombreCurso = $request->input('NombreCurso');
        $usuarioReg = $request->input('usuarioReg');
        $fechaReg = $request->input('FechaReg');
    
        if (empty($observacion) && empty($nombreCurso)) {
            return response()->json(['message' => 'No se guardaron observaciones ni curso, ambos campos están vacíos.'], 400);
        }
        
        $registro = new EncuestaObs();
        $registro->CodEvaluador = $codEvaluador;
        $registro->CodEvaluar = $codEvaluar;
        $registro->Observacion = $observacion;
        $registro->NombreCurso = $nombreCurso;
        $registro->usuarioReg = $usuarioReg;
        $registro->FechaReg = $fechaReg;
        $registro->save();
    
        return response()->json(['message' => 'Observaciones y curso guardados con éxito.']);
    }
} 
