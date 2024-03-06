<?php

namespace App\Http\Controllers;

use App\Models\FormConozcaCliente;
use App\Models\FormConozcaClienteAccionitas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FormsConozcaClienteController extends Controller
{
    public function index()
    {
        return view('formularios.formulario');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'fecha_de_nacimiento' => 'required|date',
            'nacionalidad' => 'required|string',
            'profesion_u_oficicio' => 'required|string',
            'pais_id' => 'required|exists:paises,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'tipo_de_documento' => 'required|string',
            'numero_de_documento' => 'required|string',
            'fecha_de_vencimiento' => 'required|date',
            'registro_iva_nrc' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'giro_id' => 'required|exists:giros,id',
            'fecha_de_nombramiento' => 'required|date',
            'direccion' => 'required|string',
            'nombre_comercial' => 'required|string',
            'clasificacion_id' => 'required|exists:clasificaciones,id',
            'nacionalidad_persona_juridica' => 'required|string',
            'numero_de_nit' => 'required|string',
            'fecha_de_constitucion' => 'required|date',
            'registro_nrc_persona_juridica' => 'required|string',
            'giro_persona_juridica_id' => 'required|exists:giros,id',
            'pais_persona_juridica_id' => 'required|exists:paises,id',
            'departamento_persona_juridica_id' => 'required|exists:departamentos,id',
            'municipio_persona_juridica_id' => 'required|exists:municipios,id',
            'telefono_persona_juridica' => 'required|string',
            'sitio_web' => 'required|url',
            'numero_de_fax' => 'required|string',
            'direccion_persona_juridica' => 'required|string',
            'nombre_a.*' => 'required|string',
            'nacionalidad_a.*' => 'required|string',
            'numero_identidad.*' => 'required|string',
            'porcentaje_participacion.*' => 'required|string',
        ]);

        try {
            $formsccc = new FormConozcaCliente();
            $formsccc->nombre = $request->input('nombre');
            $formsccc->apellido = $request->input('apellido');
            $formsccc->fecha_de_nacimiento = Carbon::parse($request->input('fecha_de_nacimiento'));
            $formsccc->nacionalidad = $request->input('nacionalidad');
            $formsccc->profesion_u_oficicio = $request->input('profesion_u_oficicio');
            $formsccc->pais_id = $request->input('pais_id');
            $formsccc->departamento_id = $request->input('departamento_id');
            $formsccc->municipio_id = $request->input('municipio_id');
            $formsccc->tipo_de_documento = $request->input('tipo_de_documento');
            $formsccc->numero_de_documento = str_replace('-', '', $request->input('numero_de_documento'));
            $formsccc->fecha_de_vencimiento = Carbon::parse($request->input('fecha_de_vencimiento'));
            $formsccc->registro_iva_nrc = str_replace('-', '', $request->input('registro_iva_nrc'));
            $formsccc->email = $request->input('email');
            $formsccc->telefono = str_replace(['+', '-'], '', $request->input('telefono'));
            $formsccc->giro_id = $request->input('giro_id');
            $formsccc->fecha_de_nombramiento = Carbon::parse($request->input('fecha_de_nombramiento'));
            $formsccc->direccion = $request->input('direccion');
            $formsccc->nombre_comercial = $request->input('nombre_comercial');
            $formsccc->clasificacion_id = $request->input('clasificacion_id');
            $formsccc->nacionalidad_persona_juridica = $request->input('nacionalidad_persona_juridica');
            $formsccc->numero_de_nit = str_replace('-', '', $request->input('numero_de_nit'));
            $formsccc->fecha_de_constitucion = Carbon::parse($request->input('fecha_de_constitucion'));
            $formsccc->registro_nrc_persona_juridica = str_replace('-', '', $request->input('registro_nrc_persona_juridica'));
            $formsccc->giro_persona_juridica_id = $request->input('giro_persona_juridica_id');
            $formsccc->pais_persona_juridica_id = $request->input('pais_persona_juridica_id');
            $formsccc->departamento_persona_juridica_id = $request->input('departamento_persona_juridica_id');
            $formsccc->municipio_persona_juridica_id = $request->input('municipio_persona_juridica_id');
            $formsccc->telefono_persona_juridica = str_replace(['+', '-'], '', $request->input('telefono_persona_juridica'));
            $formsccc->sitio_web = $request->input('sitio_web');
            $formsccc->numero_de_fax = str_replace(['+', '-'], '', $request->input('numero_de_fax'));
            $formsccc->direccion_persona_juridica = $request->input('direccion_persona_juridica');
            $formsccc->fecha_de_creacion = now();
            $formsccc->fecha_de_modificacion = now();

            $formsccc->save();

            $accionistas = [];

            foreach ($request->input('nombre_a', []) as $key => $nombreAccionista) {
                $nacionalidadAccionista = $request->input('nacionalidad_a.' . $key);
                $noIdentificacion = str_replace('-', '', $request->input('numero_identidad.' . $key));
                $porcentajeParticipacion = $request->input('porcentaje_participacion.' . $key);

                if ($nombreAccionista !== null && $nacionalidadAccionista !== null && $noIdentificacion !== null && $porcentajeParticipacion !== null) {
                    $accionista = new FormConozcaClienteAccionitas();
                    $accionista->nombre = $nombreAccionista;
                    $accionista->nacionalidad = $nacionalidadAccionista;
                    $accionista->numero_identidad = $noIdentificacion;
                    $accionista->porcentaje_participacion = $porcentajeParticipacion;
                    $accionistas[] = $accionista;
                }
            }

            $formsccc->conozcaClienteAccionistas()->saveMany($accionistas);

            return redirect()->back()->with('success', 'Tu formulario ha sido enviado con éxito.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Hubo un error al procesar tu formulario');
        }
    }

}
