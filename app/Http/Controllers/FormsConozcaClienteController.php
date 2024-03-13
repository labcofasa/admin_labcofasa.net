<?php

namespace App\Http\Controllers;


use App\Models\FrmConocaClienteAccionista;
use App\Models\FrmConozcaCliente;
use App\Models\FrmConozcaClienteJuridico;
use App\Models\FrmConozcaClienteMiembro;
use App\Models\FrmConozcaClientePariente;
use App\Models\FrmConozcaClientePolitico;
use App\Models\FrmConozcaClienteSocio;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class FormsConozcaClienteController extends Controller
{
    public function index()
    {
        return view('formularios.formulario_conozca_cliente');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'nullable|string',
            'apellido' => 'nullable|string',
            'fecha_de_nacimiento' => 'nullable|date',
            'nacionalidad' => 'nullable|string',
            'profesion_u_oficicio' => 'nullable|string',
            'pais_id' => 'nullable|exists:paises,id',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'municipio_id' => 'nullable|exists:municipios,id',
            'tipo_de_documento' => 'nullable|string',
            'numero_de_documento' => 'nullable|string',
            'fecha_de_vencimiento' => 'nullable|date',
            'registro_iva_nrc' => 'nullable|string',
            'email' => 'nullable|email',
            'telefono' => 'nullable|string',
            'giro_id' => 'nullable|exists:giros,id',
            'fecha_de_nombramiento' => 'nullable|date',
            'direccion' => 'nullable|string',
            'nombre_comercial_juridico' => 'nullable|string',
            'clasificacion_juridico_id' => 'nullable|exists:clasificaciones,id',
            'nacionalidad_juridico' => 'nullable|string',
            'numero_de_nit_juridico' => 'nullable|string',
            'fecha_de_constitucion_juridico' => 'nullable|date',
            'registro_nrc_juridico' => 'nullable|string',
            'giro_juridico_id' => 'nullable|exists:giros,id',
            'pais_juridico_id' => 'nullable|exists:paises,id',
            'departamento_juridico_id' => 'nullable|exists:departamentos,id',
            'municipio_juridico_id' => 'nullable|exists:municipios,id',
            'telefono_juridico' => 'nullable|string',
            'sitio_web_juridico' => 'nullable|url',
            'numero_de_fax_juridico' => 'nullable|string',
            'direccion_juridico' => 'nullable|string',
            'monto_proyectado' => 'nullable|string',
            'nombre_accionista.*' => 'nullable|string',
            'nacionalidad_accionista.*' => 'nullable|string',
            'numero_identidad_accionista.*' => 'nullable|string',
            'porcentaje_participacion_accionista.*' => 'nullable|string',
            'nombre_miembro.*' => 'nullable|string',
            'nacionalidad_miembro.*' => 'nullable|string',
            'numero_identidad_miembro.*' => 'nullable|string',
            'cargo_miembro.*' => 'nullable|string',
            'nombre_politico' => 'nullable|string',
            'nombre_cargo_politico' => 'nullable|string',
            'fecha_desde_politico' => 'nullable|date',
            'fecha_hasta_politico' => 'nullable|date',
            'pais_politico_id' => 'nullable|exists:paises,id',
            'departamento_politico_id' => 'nullable|exists:departamentos,id',
            'municipio_politico_id' => 'nullable|exists:municipios,id',
            'nombre_cliente_politico' => 'nullable|string',
            'porcentaje_participacion_politico' => 'nullable|string',
            'nombre_pariente.*' => 'nullable|string',
            'parentesco.*' => 'nullable|string',
            'nombre_socio.*' => 'nullable|string',
            'porcentaje_participacion_socio.*' => 'nullable|string',
            'fuente_ingreso' => 'nullable|string',
            'monto_mensual' => 'nullable|string',
            'documento_identidad' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_tarjeta_registro' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_domicilio' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_escritura' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_acuerdo' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_nit' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_credencial' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_identificacion_representante' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_matricula' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
            'documento_domicilio_juridico' => 'nullable|file|mimes:pdf,docx,jpg,png,jpeg',
        ]);

        $direccionIp = $request->ip();

        if (FrmConozcaCliente::where('direccion_ip', $direccionIp)->exists()) {
            return redirect()->back()->with('error', 'Ya has enviado el formulario anteriormente.');
        }

        try {
            $formsccc = new FrmConozcaCliente();

            $formsccc->nombre = $request->input('nombre');
            $formsccc->apellido = $request->input('apellido');
            $formsccc->fecha_de_nacimiento = $request->input('fecha_de_nacimiento');
            $formsccc->nacionalidad = $request->input('nacionalidad');
            $formsccc->profesion_u_oficicio = $request->input('profesion_u_oficicio');
            $formsccc->pais_id = $request->input('pais_id');
            $formsccc->departamento_id = $request->input('departamento_id');
            $formsccc->municipio_id = $request->input('municipio_id');
            $formsccc->tipo_de_documento = $request->input('tipo_de_documento');
            $formsccc->numero_de_documento = str_replace('-', '', $request->input('numero_de_documento'));
            $formsccc->fecha_de_vencimiento = $request->input('fecha_de_vencimiento');
            $formsccc->registro_iva_nrc = str_replace('-', '', $request->input('registro_iva_nrc'));
            $formsccc->email = $request->input('email');
            $formsccc->telefono = str_replace(['+', '-'], '', $request->input('telefono'));
            $formsccc->giro_id = $request->input('giro_id');
            $formsccc->fecha_de_nombramiento = $request->input('fecha_de_nombramiento');
            $formsccc->direccion = $request->input('direccion');
            $formsccc->direccion_ip = $direccionIp;
            $formsccc->fecha_de_creacion = now();
            $formsccc->fecha_de_modificacion = now();

            $formsccc->save();

            $formscccId = $formsccc->id;

            $rutaCarpeta = public_path("documentos/formularios/ccc/{$formscccId}");

            if (!file_exists($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true);
            }

            if ($request->hasFile('documento_identidad')) {
                $documento = $request->file('documento_identidad');

                if ($documento->isValid()) {
                    $nombreArchivo = time() . '_' . $documento->getClientOriginalName();

                    $documento->move($rutaCarpeta, $nombreArchivo);

                    $formsccc->documento_identidad = $nombreArchivo;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_tarjeta_registro')) {
                $tarjetaRegistro = $request->file('documento_tarjeta_registro');

                if ($tarjetaRegistro->isValid()) {
                    $nombreArchivoTarjetaRegistro = time() . '_' . $tarjetaRegistro->getClientOriginalName();

                    $tarjetaRegistro->move($rutaCarpeta, $nombreArchivoTarjetaRegistro);

                    $formsccc->documento_tarjeta_registro = $nombreArchivoTarjetaRegistro;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_domicilio')) {
                $documentoDomicilio = $request->file('documento_domicilio');

                if ($documentoDomicilio->isValid()) {
                    $nombreDocumentoDomicilio = time() . '_' . $documentoDomicilio->getClientOriginalName();

                    $documentoDomicilio->move($rutaCarpeta, $nombreDocumentoDomicilio);

                    $formsccc->documento_domicilio = $nombreDocumentoDomicilio;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            $formsccc->save();

            $formsccj = new FrmConozcaClienteJuridico();

            $formsccj->nombre_comercial_juridico = $request->input('nombre_comercial_juridico');
            $formsccj->frm_conozca_cliente_id = $formsccc->id;
            $formsccj->clasificacion_id = $request->input('clasificacion_juridico_id');
            $formsccj->nacionalidad_juridico = $request->input('nacionalidad_juridico');
            $formsccj->numero_de_nit_juridico = str_replace('-', '', $request->input('numero_de_nit_juridico'));
            $formsccj->fecha_de_constitucion_juridico = $request->input('fecha_de_constitucion_juridico');
            $formsccj->registro_nrc_juridico = str_replace('-', '', $request->input('registro_nrc_juridico'));
            $formsccj->pais_id = $request->input('pais_juridico_id');
            $formsccj->departamento_id = $request->input('departamento_juridico_id');
            $formsccj->municipio_id = $request->input('municipio_juridico_id');
            $formsccj->giro_id = $request->input('giro_juridico_id');
            $formsccj->telefono_juridico = str_replace(['+', '-'], '', $request->input('telefono_juridico'));
            $formsccj->sitio_web_juridico = $request->input('sitio_web_juridico');
            $formsccj->numero_de_fax_juridico = str_replace(['+', '-'], '', $request->input('numero_de_fax_juridico'));
            $formsccj->direccion_juridico = $request->input('direccion_juridico');
            $formsccj->monto_proyectado = $request->input('monto_proyectado');
            $formsccj->fecha_de_creacion = now();
            $formsccj->fecha_de_modificacion = now();

            $formsccj->save();

            $formsccjId = $formsccj->id;

            $rutaCarpetaJuridico = public_path("documentos/formularios/ccc/ccj/{$formsccjId}");

            if (!file_exists($rutaCarpetaJuridico)) {
                mkdir($rutaCarpetaJuridico, 0777, true);
            }

            if ($request->hasFile('documento_escritura')) {
                $documentoEscritura = $request->file('documento_escritura');

                if ($documentoEscritura->isValid()) {
                    $nombreDocumentoEscritura = time() . '_' . $documentoEscritura->getClientOriginalName();

                    $documentoEscritura->move($rutaCarpetaJuridico, $nombreDocumentoEscritura);

                    $formsccj->documento_escritura = $nombreDocumentoEscritura;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_acuerdo')) {
                $documentoAcuerdo = $request->file('documento_acuerdo');

                if ($documentoAcuerdo->isValid()) {
                    $nombreDocumentoAcuerdo = time() . '_' . $documentoAcuerdo->getClientOriginalName();

                    $documentoAcuerdo->move($rutaCarpetaJuridico, $nombreDocumentoAcuerdo);

                    $formsccj->documento_acuerdo = $nombreDocumentoAcuerdo;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_nit')) {
                $documentoNit = $request->file('documento_nit');

                if ($documentoNit->isValid()) {
                    $nombreDocumentoNit = time() . '_' . $documentoNit->getClientOriginalName();

                    $documentoNit->move($rutaCarpetaJuridico, $nombreDocumentoNit);

                    $formsccj->documento_nit = $nombreDocumentoNit;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_credencial')) {
                $documentoCredencial = $request->file('documento_credencial');

                if ($documentoCredencial->isValid()) {
                    $nombreDocumentoCredencial = time() . '_' . $documentoCredencial->getClientOriginalName();

                    $documentoCredencial->move($rutaCarpetaJuridico, $nombreDocumentoCredencial);

                    $formsccj->documento_credencial = $nombreDocumentoCredencial;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_identificacion_representante')) {
                $documentoIdentificacionRepresentante = $request->file('documento_identificacion_representante');

                if ($documentoIdentificacionRepresentante->isValid()) {
                    $nombreDocumentoIdentificacionRepresentante = time() . '_' . $documentoIdentificacionRepresentante->getClientOriginalName();

                    $documentoIdentificacionRepresentante->move($rutaCarpetaJuridico, $nombreDocumentoIdentificacionRepresentante);

                    $formsccj->documento_identificacion_representante = $nombreDocumentoIdentificacionRepresentante;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_matricula')) {
                $documentoMatricula = $request->file('documento_matricula');

                if ($documentoMatricula->isValid()) {
                    $nombreDocumentoMatricula = time() . '_' . $documentoMatricula->getClientOriginalName();

                    $documentoMatricula->move($rutaCarpetaJuridico, $nombreDocumentoMatricula);

                    $formsccj->documento_matricula = $nombreDocumentoMatricula;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_domicilio_juridico')) {
                $documentoDomicilioJuridico = $request->file('documento_domicilio_juridico');

                if ($documentoDomicilioJuridico->isValid()) {
                    $nombreDocumentoDomicilioJuridico = time() . '_' . $documentoDomicilioJuridico->getClientOriginalName();

                    $documentoDomicilioJuridico->move($rutaCarpetaJuridico, $nombreDocumentoDomicilioJuridico);

                    $formsccj->documento_domicilio_juridico = $nombreDocumentoDomicilioJuridico;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            $formsccj->save();

            $accionistas = [];

            foreach ($request->input('nombre_accionista', []) as $key => $nombreAccionista) {
                $nacionalidadAccionista = $request->input('nacionalidad_accionista.' . $key);
                $noIdentificacion = str_replace('-', '', $request->input('numero_identidad_accionista.' . $key));
                $porcentajeParticipacion = $request->input('porcentaje_participacion_accionista.' . $key);

                if ($nombreAccionista !== null && $nacionalidadAccionista !== null && $noIdentificacion !== null && $porcentajeParticipacion !== null) {
                    $accionista = new FrmConocaClienteAccionista();
                    $accionista->nombre_accionista = $nombreAccionista;
                    $accionista->nacionalidad_accionista = $nacionalidadAccionista;
                    $accionista->numero_identidad_accionista = $noIdentificacion;
                    $accionista->porcentaje_participacion_accionista = $porcentajeParticipacion;
                    $accionista->fecha_de_creacion = now();
                    $accionista->fecha_de_modificacion = now();
                    $accionistas[] = $accionista;
                }
            }

            $formsccc->conozcaClienteAccionistas()->saveMany($accionistas);

            $miembros = [];

            foreach ($request->input('nombre_miembro', []) as $key => $nombreMiembro) {
                $nacionalidadMiembro = $request->input('nacionalidad_miembro.' . $key);
                $noIdentificacionMiembro = str_replace('-', '', $request->input('numero_identidad_miembro.' . $key));
                $cargoMiembro = $request->input('cargo_miembro.' . $key);

                if ($nombreMiembro !== null && $nacionalidadMiembro !== null && $noIdentificacionMiembro !== null && $cargoMiembro !== null) {
                    $miembro = new FrmConozcaClienteMiembro();
                    $miembro->nombre_miembro = $nombreMiembro;
                    $miembro->nacionalidad_miembro = $nacionalidadMiembro;
                    $miembro->numero_identidad_miembro = $noIdentificacionMiembro;
                    $miembro->cargo_miembro = $cargoMiembro;
                    $miembro->fecha_de_creacion = now();
                    $miembro->fecha_de_modificacion = now();
                    $miembros[] = $miembro;
                }
            }

            $formsccc->conozcaClienteMiembros()->saveMany($miembros);



            $formsccp = new FrmConozcaClientePolitico();

            if ($request->filled(['nombre_politico', 'nombre_cargo_politico', 'fecha_desde_politico', 'fecha_hasta_politico', 'pais_politico_id', 'departamento_politico_id', 'municipio_politico_id', 'nombre_cliente_politico', 'porcentaje_participacion_politico', 'fuente_ingreso', 'monto_mensual'])) {
                $formsccp->nombre_politico = $request->input('nombre_politico');
                $formsccp->nombre_cargo_politico = $request->input('nombre_cargo_politico');
                $formsccp->fecha_desde_politico = $request->input('fecha_desde_politico');
                $formsccp->fecha_hasta_politico = $request->input('fecha_hasta_politico');
                $formsccp->pais_id = $request->input('pais_politico_id');
                $formsccp->departamento_id = $request->input('departamento_politico_id');
                $formsccp->municipio_id = $request->input('municipio_politico_id');
                $formsccp->nombre_cliente_politico = $request->input('nombre_cliente_politico');
                $formsccp->porcentaje_participacion_politico = $request->input('porcentaje_participacion_politico');
                $formsccp->fuente_ingreso = $request->input('fuente_ingreso');
                $formsccp->monto_mensual = $request->input('monto_mensual');
                $formsccp->frm_conozca_cliente_id = $formsccc->id;
                $formsccp->fecha_de_creacion = now();
                $formsccp->fecha_de_modificacion = now();

                $formsccp->save();
            }

            $parientes = [];

            foreach ($request->input('nombre_pariente', []) as $key => $nombrePariente) {
                $parentesco = $request->input('parentesco.' . $key);

                if ($nombrePariente !== null && $parentesco !== null) {
                    $pariente = new FrmConozcaClientePariente();
                    $pariente->nombre_pariente = $nombrePariente;
                    $pariente->parentesco = $parentesco;
                    $pariente->fecha_de_creacion = now();
                    $pariente->fecha_de_modificacion = now();
                    $parientes[] = $pariente;
                }
            }

            $formsccc->conozcaClienteParientes()->saveMany($parientes);

            $socios = [];

            foreach ($request->input('nombre_socio', []) as $key => $nombreSocio) {
                $porcentajeSocio = $request->input('porcentaje_participacion_socio.' . $key);

                if ($nombreSocio !== null && $porcentajeSocio !== null) {
                    $socio = new FrmConozcaClienteSocio();
                    $socio->nombre_socio = $nombreSocio;
                    $socio->porcentaje_participacion_socio = $porcentajeSocio;
                    $socio->fecha_de_creacion = now();
                    $socio->fecha_de_modificacion = now();
                    $socios[] = $socio;
                }
            }

            $formsccc->conozcaClienteSocios()->saveMany($socios);

            return redirect()->back()->with('success', 'Hemos recibido exitosamente su formulario.');
        } catch (QueryException $e) {
            dd($e);
            return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
        }
    }
}
