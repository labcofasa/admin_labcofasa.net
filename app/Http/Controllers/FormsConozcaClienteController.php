<?php

namespace App\Http\Controllers;


use App\Models\Clasificacion;
use App\Models\Departamento;
use App\Models\FrmConocaClienteAccionista;
use App\Models\FrmConozcaCliente;
use App\Models\FrmConozcaClienteArchivos;
use App\Models\FrmConozcaClienteJuridico;
use App\Models\FrmConozcaClienteMiembro;
use App\Models\FrmConozcaClientePariente;
use App\Models\FrmConozcaClientePolitico;
use App\Models\FrmConozcaClienteSocio;
use App\Models\Giro;
use App\Models\Municipio;
use App\Models\Pais;
use App\Helpers\CustomPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use TCPDF;
use DateTime;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class FormsConozcaClienteController extends Controller
{
    public function index()
    {
        return view('formularios.formulario_conozca_cliente');
    }

    public function procesarFormulario(Request $request)
    {
        $accion = $request->input('accion');

        if ($accion === 'generar_pdf') {
            return $this->generarPDF($request);
        }

        if ($accion === 'guardar_formulario') {
            return $this->store($request);
        }
    }

    public function generarPDF(Request $request)
    {

        $fecha_generacion = Carbon::now()->format('d-m-Y H:i:s');

        $pais_id = $request->input('pais_id');
        $pais = $pais_id ? Pais::find($pais_id)->nombre : '—————';

        $pais_juridico_id = $request->input('pais_juridico_id');
        $pais_juridico = $pais_juridico_id ? Pais::find($pais_juridico_id)->nombre : '—————';

        $pais_politico_id = $request->input('pais_politico_id');
        $pais_politico = $pais_politico_id ? Pais::find($pais_politico_id)->nombre : '—————';

        $departamento_id = $request->input('departamento_id');
        $departamento = $departamento_id ? Departamento::find($departamento_id)->nombre : '—————';

        $departamento_juridico_id = $request->input('departamento_juridico_id');
        $departamento_juridico = $departamento_juridico_id ? Departamento::find($departamento_juridico_id)->nombre : '—————';

        $departamento_politico_id = $request->input('departamento_politico_id');
        $departamento_politico = $departamento_politico_id ? Departamento::find($departamento_politico_id)->nombre : '—————';

        $municipio_id = $request->input('municipio_id');
        $municipio = $municipio_id ? Municipio::find($municipio_id)->nombre : '—————';

        $municipio_juridico_id = $request->input('municipio_juridico_id');
        $municipio_juridico = $municipio_juridico_id ? Municipio::find($municipio_juridico_id)->nombre : '—————';

        $municipio_politico_id = $request->input('municipio_politico_id');
        $municipio_politico = $municipio_politico_id ? Municipio::find($municipio_politico_id)->nombre : '—————';

        $giro_id = $request->input('giro_id');
        $giro = $giro_id ? Giro::find($giro_id)->nombre : '—————';

        $giro_juridico_id = $request->input('giro_juridico_id');
        $giro_juridico = $giro_juridico_id ? Giro::find($giro_juridico_id)->nombre : '—————';

        $clasificacion_juridico_id = $request->input('clasificacion_juridico_id');
        $clasificacion = $clasificacion_juridico_id ? Clasificacion::find($clasificacion_juridico_id)->nombre : '—————';

        $tipo = $request->input('tipo') ?: '—————';
        $tipo_persona = $request->input('tipo_persona') ?: '—————';
        $nombre = $request->input('nombre') ?: '—————';
        $apellido = $request->input('apellido') ?: '—————';

        $fecha_de_nacimiento = $request->input('fecha_de_nacimiento') ? Carbon::createFromFormat('Y-m-d', $request->input('fecha_de_nacimiento'))->format('d-m-Y') : '—————';
        $nacionalidad = $request->input('nacionalidad') ?: '—————';
        $profesion_u_oficio = $request->input('profesion_u_oficio') ?: '—————';
        $tipo_de_documento = $request->input('tipo_de_documento') ?: '—————';
        $numero_de_documento = $request->input('numero_de_documento') ?: '—————';
        $fecha_de_vencimiento = $request->input('fecha_de_vencimiento') ? Carbon::createFromFormat('Y-m-d', $request->input('fecha_de_vencimiento'))->format('d-m-Y') : '—————';
        $registro_iva_nrc = $request->input('registro_iva_nrc') ?: '—————';
        $email = $request->input('email') ?: '—————';
        $telefono = $request->input('telefono') ?: '—————';
        $fecha_de_nombramiento = $request->input('fecha_de_nombramiento') ? Carbon::createFromFormat('Y-m-d', $request->input('fecha_de_nombramiento'))->format('d-m-Y') : '—————';
        $direccion = $request->input('direccion') ?: '—————';
        $nombre_comercial_juridico = $request->input('nombre_comercial_juridico') ?: '—————';
        $nacionalidad_juridico = $request->input('nacionalidad_juridico') ?: '—————';
        $numero_de_nit_juridico = $request->input('numero_de_nit_juridico') ?: '—————';
        $fecha_de_constitucion_juridico = $request->input('fecha_de_constitucion_juridico') ? Carbon::createFromFormat('Y-m-d', $request->input('fecha_de_constitucion_juridico'))->format('d-m-Y') : '—————';
        $registro_nrc_juridico = $request->input('registro_nrc_juridico') ?: '—————';
        $sitio_web_juridico = $request->input('sitio_web_juridico') ?: '—————';
        $numero_de_fax_juridico = $request->input('numero_de_fax_juridico') ?: '—————';
        $telefono_juridico = $request->input('telefono_juridico') ?: '—————';
        $direccion_juridico = $request->input('direccion_juridico') ?: '—————';
        $monto_proyectado = $request->input('monto_proyectado') ?: '—————';
        $cargo_publico = $request->input('cargo_publico') ?: '—————';
        $familiar_publico = $request->input('familiar_publico') ?: '—————';
        $nombre_politico = $request->input('nombre_politico') ?: '—————';
        $nombre_cargo_politico = $request->input('nombre_cargo_politico') ?: '—————';
        $fecha_desde_politico = $request->input('fecha_desde_politico') ? Carbon::createFromFormat('Y-m-d', $request->input('fecha_desde_politico'))->format('d-m-Y') : '—————';
        $fecha_hasta_politico = $request->input('fecha_hasta_politico') ? Carbon::createFromFormat('Y-m-d', $request->input('fecha_hasta_politico'))->format('d-m-Y') : '—————';
        $nombre_cliente_politico = $request->input('nombre_cliente_politico') ?: '—————';
        $porcentaje_participacion_politico = $request->input('porcentaje_participacion_politico') ?: '—————';
        $fuente_ingreso = $request->input('fuente_ingreso') ?: '—————';
        $monto_mensual = $request->input('monto_mensual') ?: '—————';

        $accionistas = [];
        foreach ($request->input('nombre_accionista', []) as $key => $nombreAccionista) {
            $nacionalidadAccionista = $request->input('nacionalidad_accionista.' . $key) ?: '—————';
            $noIdentificacion = str_replace('-', '', $request->input('numero_identidad_accionista.' . $key)) ?: '—————';
            $porcentajeParticipacion = $request->input('porcentaje_participacion_accionista.' . $key) ?: '—————';

            $accionistas[] = [
                'nombre_accionista' => $nombreAccionista ?: '—————',
                'nacionalidad_accionista' => $nacionalidadAccionista,
                'numero_identidad_accionista' => $noIdentificacion,
                'porcentaje_participacion_accionista' => $porcentajeParticipacion,
            ];
        }

        $miembros = [];
        foreach ($request->input('nombre_miembro', []) as $key => $nombreMiembro) {
            $nacionalidadMiembro = $request->input('nacionalidad_miembro.' . $key) ?: '—————';
            $noIdentificacionMiembro = str_replace('-', '', $request->input('numero_identidad_miembro.' . $key)) ?: '—————';
            $cargoMiembro = $request->input('cargo_miembro.' . $key) ?: '—————';

            $miembros[] = [
                'nombre_miembro' => $nombreMiembro ?: '—————',
                'nacionalidad_miembro' => $nacionalidadMiembro,
                'numero_identidad_miembro' => $noIdentificacionMiembro,
                'cargo_miembro' => $cargoMiembro,
            ];
        }

        $parientes = [];
        foreach ($request->input('nombre_pariente', []) as $key => $nombrePariente) {
            $parentesco = $request->input('parentesco.' . $key) ?: '—————';

            $parientes[] = [
                'nombre_pariente' => $nombrePariente ?: '—————',
                'parentesco' => $parentesco,
            ];
        }

        $socios = [];
        foreach ($request->input('nombre_socio', []) as $key => $nombreSocio) {
            $porcentajeParticipacionSocio = $request->input('porcentaje_participacion_socio.' . $key) ?: '—————';

            $socios[] = [
                'nombre_socio' => $nombreSocio ?: '—————',
                'porcentaje_participacion_socio' => $porcentajeParticipacionSocio,
            ];
        }

        $html = view(
            'formularios.pdf_plantilla',
            compact(
                'fecha_generacion',
                'tipo',
                'tipo_persona',
                'nombre',
                'apellido',
                'fecha_de_nacimiento',
                'nacionalidad',
                'profesion_u_oficio',
                'tipo_de_documento',
                'numero_de_documento',
                'fecha_de_vencimiento',
                'registro_iva_nrc',
                'email',
                'telefono',
                'fecha_de_nombramiento',
                'pais',
                'departamento',
                'municipio',
                'giro',
                'direccion',
                'nombre_comercial_juridico',
                'clasificacion',
                'nacionalidad_juridico',
                'numero_de_nit_juridico',
                'fecha_de_constitucion_juridico',
                'registro_nrc_juridico',
                'giro_juridico',
                'pais_juridico',
                'departamento_juridico',
                'municipio_juridico',
                'sitio_web_juridico',
                'numero_de_fax_juridico',
                'telefono_juridico',
                'direccion_juridico',
                'monto_proyectado',
                'cargo_publico',
                'familiar_publico',
                'nombre_politico',
                'nombre_cargo_politico',
                'fecha_desde_politico',
                'fecha_hasta_politico',
                'pais_politico',
                'departamento_politico',
                'municipio_politico',
                'nombre_cliente_politico',
                'porcentaje_participacion_politico',
                'accionistas',
                'miembros',
                'parientes',
                'socios',
                'fuente_ingreso',
                'monto_mensual',
            )
        )->render();
        // $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);
        // $pdf->SetHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
        // $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // $pdf->SetMargins(15, 10, 15);
        // $pdf = new CustomPDF();
        // $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // $pdf->SetFooterMargin(10);
        // $pdf->AddPage();
        // $pdf->writeHTML($html, true, false, true, false, '');
        // $pdf->Output('formulario.pdf', 'D');

        // Crear una instancia de CustomPDF si es que usas configuración personalizada
        $pdf = new custompdf('P', 'mm', 'LETTER', true, 'UTF-8', false);

        // Configuración del encabezado
        $pdf->SetHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        // Configuración de márgenes
        $pdf->SetMargins(15, 10, 15);

        // Configuración del pie de página
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetFooterMargin(10);

        // Añadir una página
        $pdf->AddPage();

        // Añadir contenido HTML al PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar el PDF y forzar descarga
        $pdf->Output('formulario.pdf', 'D');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'tipo' => 'nullable|string',
            'tipo_persona' => 'nullable|string',
            'nombre' => 'nullable|string',
            'apellido' => 'nullable|string',
            'fecha_de_nacimiento' => 'nullable|date',
            'nacionalidad' => 'nullable|string',
            'profesion_u_oficio' => 'nullable|string',
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
            'monto_proyectado' => 'nullable|string',
            'cargo_publico' => 'nullable|in:SI,NO',
            'familiar_publico' => 'nullable|in:SI,NO',
            'nombre_comercial_juridico' => 'nullable|string',
            // 'clasificacion_juridico_id' => 'nullable|exists:clasificaciones,id',
            // 'nacionalidad_juridico' => 'nullable|string',
            // 'numero_de_nit_juridico' => 'nullable|string',
            // 'fecha_de_constitucion_juridico' => 'nullable|date',
            // 'registro_nrc_juridico' => 'nullable|string',
            // 'giro_juridico_id' => 'nullable|exists:giros,id',
            // 'pais_juridico_id' => 'nullable|exists:paises,id',
            // 'departamento_juridico_id' => 'nullable|exists:departamentos,id',
            // 'municipio_juridico_id' => 'nullable|exists:municipios,id',
            // 'telefono_juridico' => 'nullable|string',
            // 'sitio_web_juridico' => 'nullable|url',
            // 'numero_de_fax_juridico' => 'nullable|string',
            // 'direccion_juridico' => 'nullable|string',
            // 'nombre_accionista.*' => 'nullable|string',
            // 'nacionalidad_accionista.*' => 'nullable|string',
            // 'numero_identidad_accionista.*' => 'nullable|string',
            // 'porcentaje_participacion_accionista.*' => 'nullable|string',
            // 'nombre_miembro.*' => 'nullable|string',
            // 'nacionalidad_miembro.*' => 'nullable|string',
            // 'numero_identidad_miembro.*' => 'nullable|string',
            // 'cargo_miembro.*' => 'nullable|string',
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
            'formulario_firmado' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_identidad_persona_natural' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_nit_persona_natural' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_tarjeta_iva_persona_natural' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_domicilio_persona_natural' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_dnm_persona_natural' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_escritura_juridico.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_matricula_juridico' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_acuerdo_juridico' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_nit_juridico' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_iva_juridico' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_domicilio_juridico' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_credencial_representante' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'documento_dnm_juridico' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
        ]);

        // $direccionIp = $request->ip();

        // $numRegistros = FrmConozcaCliente::where('direccion_ip', $direccionIp)->count();

        // if ($numRegistros >= 10) {
        //     return redirect()->back()->with('error', 'Has excedido el límite de intentos.');
        // }

        try {
            $formsccc = new FrmConozcaCliente();

            $formsccc->tipo = $request->input('tipo');
            $formsccc->tipo_persona = $request->input('tipo_persona');
            $formsccc->nombre = $request->input('nombre');
            $formsccc->apellido = $request->input('apellido');
            $formsccc->fecha_de_nacimiento = $request->input('fecha_de_nacimiento');
            $formsccc->nacionalidad = $request->input('nacionalidad');
            $formsccc->profesion_u_oficio = $request->input('profesion_u_oficio');
            $formsccc->pais_id = $request->input('pais_id');
            $formsccc->departamento_id = $request->input('departamento_id');
            $formsccc->municipio_id = $request->input('municipio_id');
            $formsccc->tipo_de_documento = $request->input('tipo_de_documento');
            $formsccc->numero_de_documento = str_replace('-', '', $request->input('numero_de_documento'));
            $formsccc->fecha_de_vencimiento = $request->input('fecha_de_vencimiento');
            $registro_iva_nrc = $request->input('registro_iva_nrc');
            $formsccc->registro_iva_nrc = empty($registro_iva_nrc) ? null : str_replace('-', '', $registro_iva_nrc);
            $formsccc->email = $request->input('email');
            $formsccc->telefono = str_replace(['+', '-'], '', $request->input('telefono'));
            $formsccc->giro_id = $request->input('giro_id');
            $formsccc->fecha_de_nombramiento = $request->input('fecha_de_nombramiento');
            $formsccc->direccion = $request->input('direccion');
            $formsccc->cargo_publico = $request->input('cargo_publico');
            $formsccc->familiar_publico = $request->input('familiar_publico');
            // $formsccc->direccion_ip = $direccionIp;
            $formsccc->fecha_de_creacion = now();
            $formsccc->fecha_de_modificacion = now();

            $formsccc->save();

            $formscccId = $formsccc->id;

            $rutaCarpeta = public_path("docs/fccc/{$formscccId}");

            if (!file_exists($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true);
            }

            if ($request->hasFile('formulario_firmado')) {
                $documentoFirmado = $request->file('formulario_firmado');

                if ($documentoFirmado->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreDocumentoFirmado = $numeroAleatorio . '_' . $documentoFirmado->getClientOriginalName();

                    $documentoFirmado->move($rutaCarpeta, $nombreDocumentoFirmado);

                    $formsccc->formulario_firmado = $nombreDocumentoFirmado;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_identidad_persona_natural')) {
                $documento = $request->file('documento_identidad_persona_natural');

                if ($documento->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreArchivo = $numeroAleatorio . '_' . $documento->getClientOriginalName();

                    $documento->move($rutaCarpeta, $nombreArchivo);

                    $formsccc->documento_identidad_persona_natural = $nombreArchivo;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_nit_persona_natural')) {
                $documentoNitPersonaNatural = $request->file('documento_nit_persona_natural');

                if ($documentoNitPersonaNatural->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreDocumentoNitPersonaNatural = $numeroAleatorio . '_' . $documentoNitPersonaNatural->getClientOriginalName();

                    $documentoNitPersonaNatural->move($rutaCarpeta, $nombreDocumentoNitPersonaNatural);

                    $formsccc->documento_nit_persona_natural = $nombreDocumentoNitPersonaNatural;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_tarjeta_iva_persona_natural')) {
                $tarjetaRegistro = $request->file('documento_tarjeta_iva_persona_natural');

                if ($tarjetaRegistro->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreArchivoTarjetaRegistro = $numeroAleatorio . '_' . $tarjetaRegistro->getClientOriginalName();

                    $tarjetaRegistro->move($rutaCarpeta, $nombreArchivoTarjetaRegistro);

                    $formsccc->documento_tarjeta_iva_persona_natural = $nombreArchivoTarjetaRegistro;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_domicilio_persona_natural')) {
                $documentoDomicilioPersonaNatural = $request->file('documento_domicilio_persona_natural');

                if ($documentoDomicilioPersonaNatural->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreDocumentoDomicilioPersonaNatural = $numeroAleatorio . '_' . $documentoDomicilioPersonaNatural->getClientOriginalName();

                    $documentoDomicilioPersonaNatural->move($rutaCarpeta, $nombreDocumentoDomicilioPersonaNatural);

                    $formsccc->documento_domicilio_persona_natural = $nombreDocumentoDomicilioPersonaNatural;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_dnm_persona_natural')) {
                $documentoDnmPersonaNatural = $request->file('documento_dnm_persona_natural');

                if ($documentoDnmPersonaNatural->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreDocumentoDnmPersonaNatural = $numeroAleatorio . '_' . $documentoDnmPersonaNatural->getClientOriginalName();

                    $documentoDnmPersonaNatural->move($rutaCarpeta, $nombreDocumentoDnmPersonaNatural);

                    $formsccc->documento_dnm_persona_natural = $nombreDocumentoDnmPersonaNatural;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_escritura_juridico')) {
                $documentosEscritura = $request->file('documento_escritura_juridico');
                foreach ($documentosEscritura as $documento) {
                    if ($documento->isValid()) {
                        $numeroAleatorio = mt_rand(100000, 999999);
                        $nombreArchivoEscritura = $numeroAleatorio . '_' . $documento->getClientOriginalName();
                        $documento->move($rutaCarpeta, $nombreArchivoEscritura);

                        $documentoEscrituraJuridico = new FrmConozcaClienteArchivos();
                        $documentoEscrituraJuridico->nombre_archivo = $nombreArchivoEscritura;

                        $formsccc->conozcaClienteArchivos()->save($documentoEscrituraJuridico);
                    } else {
                        return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                    }
                }
            }

            if ($request->hasFile('documento_matricula_juridico')) {
                $documentoMatriculaJuridico = $request->file('documento_matricula_juridico');

                if ($documentoMatriculaJuridico->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreMatriculaJuridico = $numeroAleatorio . '_' . $documentoMatriculaJuridico->getClientOriginalName();

                    $documentoMatriculaJuridico->move($rutaCarpeta, $nombreMatriculaJuridico);

                    $formsccc->documento_matricula_juridico = $nombreMatriculaJuridico;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_acuerdo_juridico')) {
                $documentoAcuerdoJuridico = $request->file('documento_acuerdo_juridico');

                if ($documentoAcuerdoJuridico->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreAcuerdoJuridico = $numeroAleatorio . '_' . $documentoAcuerdoJuridico->getClientOriginalName();

                    $documentoAcuerdoJuridico->move($rutaCarpeta, $nombreAcuerdoJuridico);

                    $formsccc->documento_acuerdo_juridico = $nombreAcuerdoJuridico;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_nit_juridico')) {
                $documentoNitJuridico = $request->file('documento_nit_juridico');

                if ($documentoNitJuridico->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreNitJuridico = $numeroAleatorio . '_' . $documentoNitJuridico->getClientOriginalName();

                    $documentoNitJuridico->move($rutaCarpeta, $nombreNitJuridico);

                    $formsccc->documento_nit_juridico = $nombreNitJuridico;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_iva_juridico')) {
                $documentoIvaJuridico = $request->file('documento_iva_juridico');

                if ($documentoIvaJuridico->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreIvaJuridico = $numeroAleatorio . '_' . $documentoIvaJuridico->getClientOriginalName();

                    $documentoIvaJuridico->move($rutaCarpeta, $nombreIvaJuridico);

                    $formsccc->documento_iva_juridico = $nombreIvaJuridico;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_domicilio_juridico')) {
                $documentoDomicilioJuridico = $request->file('documento_domicilio_juridico');

                if ($documentoDomicilioJuridico->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreDomicilioJuridico = $numeroAleatorio . '_' . $documentoDomicilioJuridico->getClientOriginalName();

                    $documentoDomicilioJuridico->move($rutaCarpeta, $nombreDomicilioJuridico);

                    $formsccc->documento_domicilio_juridico = $nombreDomicilioJuridico;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_credencial_representante')) {
                $documentoCredencialRepresentante = $request->file('documento_credencial_representante');

                if ($documentoCredencialRepresentante->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreCredencialRepresentante = $numeroAleatorio . '_' . $documentoCredencialRepresentante->getClientOriginalName();

                    $documentoCredencialRepresentante->move($rutaCarpeta, $nombreCredencialRepresentante);

                    $formsccc->documento_credencial_representante = $nombreCredencialRepresentante;
                } else {
                    return redirect()->back()->with('error', 'Hubo un error al procesar su formulario');
                }
            }

            if ($request->hasFile('documento_dnm_juridico')) {
                $documentoDnmJuridico = $request->file('documento_dnm_juridico');

                if ($documentoDnmJuridico->isValid()) {
                    $numeroAleatorio = mt_rand(100000, 999999);
                    $nombreDnmJuridico = $numeroAleatorio . '_' . $documentoDnmJuridico->getClientOriginalName();

                    $documentoDnmJuridico->move($rutaCarpeta, $nombreDnmJuridico);

                    $formsccc->documento_dnm_juridico = $nombreDnmJuridico;
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
            $numero_de_nit_juridico = $request->input('numero_de_nit_juridico');
            $formsccj->numero_de_nit_juridico = empty($numero_de_nit_juridico) ? null : str_replace('-', '', $numero_de_nit_juridico);
            $formsccj->fecha_de_constitucion_juridico = $request->input('fecha_de_constitucion_juridico');
            $registro_nrc_juridico = $request->input('registro_nrc_juridico');
            $formsccj->registro_nrc_juridico = empty($registro_nrc_juridico) ? null : str_replace('-', '', $registro_nrc_juridico);
            $formsccj->pais_id = $request->input('pais_juridico_id');
            $formsccj->departamento_id = $request->input('departamento_juridico_id');
            $formsccj->municipio_id = $request->input('municipio_juridico_id');
            $formsccj->giro_id = $request->input('giro_juridico_id');
            $telefono_juridico = $request->input('telefono_juridico');
            $formsccj->telefono_juridico = empty($telefono_juridico) ? null : str_replace(['+', '-'], '', $telefono_juridico);
            $formsccj->sitio_web_juridico = $request->input('sitio_web_juridico');
            $numero_de_fax_juridico = $request->input('numero_de_fax_juridico');
            $formsccj->numero_de_fax_juridico = empty($numero_de_fax_juridico) ? null : str_replace(['+', '-'], '', $numero_de_fax_juridico);
            $formsccj->direccion_juridico = $request->input('direccion_juridico');
            $formsccj->monto_proyectado = $request->input('monto_proyectado');
            $formsccj->fecha_de_creacion = now();
            $formsccj->fecha_de_modificacion = now();

            $formsccj->save();

            $accionistas = [];

            foreach ($request->input('nombre_accionista', []) as $key => $nombreAccionista) {
                $nacionalidadAccionista = $request->input('nacionalidad_accionista.' . $key);
                $noIdentificacion = $request->input('numero_identidad_accionista.' . $key);
                $noIdentificacion = str_replace('-', '', $noIdentificacion);
                $noIdentificacion = empty($noIdentificacion) ? null : $noIdentificacion;
                $porcentajeParticipacion = $request->input('porcentaje_participacion_accionista.' . $key);

                $accionista = new FrmConocaClienteAccionista();
                $accionista->nombre_accionista = $nombreAccionista;
                $accionista->nacionalidad_accionista = $nacionalidadAccionista;
                $accionista->numero_identidad_accionista = $noIdentificacion;
                $accionista->porcentaje_participacion_accionista = $porcentajeParticipacion;
                $accionista->fecha_de_creacion = now();
                $accionista->fecha_de_modificacion = now();
                $accionistas[] = $accionista;
            }

            $formsccc->conozcaClienteAccionistas()->saveMany($accionistas);

            $miembros = [];

            foreach ($request->input('nombre_miembro', []) as $key => $nombreMiembro) {
                $nacionalidadMiembro = $request->input('nacionalidad_miembro.' . $key);
                $noIdentificacionMiembro = $request->input('numero_identidad_miembro.' . $key);
                $noIdentificacionMiembro = str_replace('-', '', $noIdentificacionMiembro);
                $noIdentificacionMiembro = empty($noIdentificacionMiembro) ? null : $noIdentificacionMiembro;
                $cargoMiembro = $request->input('cargo_miembro.' . $key);

                $miembro = new FrmConozcaClienteMiembro();
                $miembro->nombre_miembro = $nombreMiembro;
                $miembro->nacionalidad_miembro = $nacionalidadMiembro;
                $miembro->numero_identidad_miembro = $noIdentificacionMiembro;
                $miembro->cargo_miembro = $cargoMiembro;
                $miembro->fecha_de_creacion = now();
                $miembro->fecha_de_modificacion = now();
                $miembros[] = $miembro;
            }

            $formsccc->conozcaClienteMiembros()->saveMany($miembros);

            $formsccp = new FrmConozcaClientePolitico();

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

            $parientes = [];

            foreach ($request->input('nombre_pariente', []) as $key => $nombrePariente) {
                $parentesco = $request->input('parentesco.' . $key);

                $pariente = new FrmConozcaClientePariente();
                $pariente->nombre_pariente = $nombrePariente;
                $pariente->parentesco = $parentesco;
                $pariente->fecha_de_creacion = now();
                $pariente->fecha_de_modificacion = now();
                $parientes[] = $pariente;
            }

            $formsccc->conozcaClienteParientes()->saveMany($parientes);

            $socios = [];

            foreach ($request->input('nombre_socio', []) as $key => $nombreSocio) {
                $porcentajeSocio = $request->input('porcentaje_participacion_socio.' . $key);

                $socio = new FrmConozcaClienteSocio();
                $socio->nombre_socio = $nombreSocio;
                $socio->porcentaje_participacion_socio = $porcentajeSocio;
                $socio->fecha_de_creacion = now();
                $socio->fecha_de_modificacion = now();
                $socios[] = $socio;
            }

            $formsccc->conozcaClienteSocios()->saveMany($socios);

            return redirect()->back()->with('success', 'Hemos recibido exitosamente su formulario.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Hubo un error al procesar su formulario' . $e->getMessage());
        }
    }

    public function tablaConozcaCliente(Request $request)
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

        $query = FrmConozcaCliente::with(
            'conozcaClienteMiembros',
            'conozcaClienteAccionistas',
            'conozcaClientePoliticos',
            'conozcaClienteParientes',
            'conozcaClienteSocios',
            'conozcaClienteArchivos'
        )
            ->select(
                'frm_conozca_cliente.*',
                'frm_conozca_cliente.documento_domicilio_juridico as domicilio_juridico',
                'paises.id as id_pais',
                'paises.nombre as nombre_pais',
                'departamentos.id as id_departamento',
                'departamentos.nombre as departamento_nombre',
                'municipios.id as id_municipio',
                'municipios.nombre as municipio_nombre',
                'giros.id as id_giro',
                'giros.nombre as giro_nombre',
                'frm_conozca_cliente_juridico.*',
                'clasificaciones.nombre as clasificacion_nombre',
                'paises_juridico.id as id_pais_juridico',
                'paises_juridico.nombre as pais_juridico',
                'departamentos_juridico.id as id_departamento_juridico',
                'departamentos_juridico.nombre as departamento_juridico',
                'municipios_juridico.id as id_municipio_juridico',
                'municipios_juridico.nombre as municipio_juridico',
                'giros_juridico.nombre as giro_juridico',
                'frm_conozca_cliente_politico.*',
                'paises_politico.id as id_pais_politico',
                'paises_politico.nombre as pais_politico',
                'departamento_politico.id as id_departamento_politico',
                'departamento_politico.nombre as departamento_politico',
                'municipio_politico.id as id_municipio_politico',
                'municipio_politico.nombre as municipio_politico'
            )
            ->leftJoin('paises', 'frm_conozca_cliente.pais_id', '=', 'paises.id')
            ->leftJoin('departamentos', 'frm_conozca_cliente.departamento_id', '=', 'departamentos.id')
            ->leftJoin('municipios', 'frm_conozca_cliente.municipio_id', '=', 'municipios.id')
            ->leftJoin('giros', 'frm_conozca_cliente.giro_id', '=', 'giros.id')
            ->leftJoin('frm_conozca_cliente_juridico', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_juridico.frm_conozca_cliente_id')
            ->leftJoin('clasificaciones', 'frm_conozca_cliente_juridico.clasificacion_id', '=', 'clasificaciones.id')
            ->leftJoin('paises as paises_juridico', 'frm_conozca_cliente_juridico.pais_id', '=', 'paises_juridico.id')
            ->leftJoin('departamentos as departamentos_juridico', 'frm_conozca_cliente_juridico.departamento_id', '=', 'departamentos_juridico.id')
            ->leftJoin('municipios as municipios_juridico', 'frm_conozca_cliente_juridico.municipio_id', '=', 'municipios_juridico.id')
            ->leftJoin('giros as giros_juridico', 'frm_conozca_cliente_juridico.giro_id', '=', 'giros_juridico.id')
            ->leftJoin('frm_conozca_cliente_politico', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_politico.frm_conozca_cliente_id')
            ->leftJoin('paises as paises_politico', 'frm_conozca_cliente_politico.pais_id', '=', 'paises_politico.id')
            ->leftJoin('departamentos as departamento_politico', 'frm_conozca_cliente_politico.departamento_id', '=', 'departamento_politico.id')
            ->leftJoin('municipios as municipio_politico', 'frm_conozca_cliente_politico.municipio_id', '=', 'municipio_politico.id')
            ->where('tipo', '=', 'Cliente')
            ->orderBy('frm_conozca_cliente.fecha_de_creacion', 'desc');


        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('frm_conozca_cliente.nombre', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.codigo_cliente', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.tipo', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.tipo_persona', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.apellido', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.registro_iva_nrc', 'like', '%' . $search . '%')

                    ->orWhere('frm_conozca_cliente_juridico.nombre_comercial_juridico', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente_juridico.numero_de_nit_juridico', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente_juridico.registro_nrc_juridico', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente_juridico.monto_proyectado', 'like', '%' . $search . '%')

                    ->orWhere('frm_conozca_cliente.tipo_de_documento', 'like', '%' . $search . '%');
            });
        }

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $formccc = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($formccc as $form) {
            $clienteAccionistaData = $form->conozcaClienteAccionistas->map(function ($clienteAccionista) {
                return [
                    'id' => $clienteAccionista->id,
                    'nombre_accionista' => $clienteAccionista->nombre_accionista,
                    'nacionalidad_accionista' => $clienteAccionista->nacionalidad_accionista,
                    'numero_identidad_accionista' => $clienteAccionista->numero_identidad_accionista,
                    'porcentaje_participacion_accionista' => $clienteAccionista->porcentaje_participacion_accionista
                ];
            });

            $clienteMiembroData = $form->conozcaClienteMiembros->map(function ($clienteMiembro) {
                return [
                    'id' => $clienteMiembro->id,
                    'nombre_miembro' => $clienteMiembro->nombre_miembro,
                    'nacionalidad_miembro' => $clienteMiembro->nacionalidad_miembro,
                    'numero_identidad_miembro' => $clienteMiembro->numero_identidad_miembro,
                    'cargo_miembro' => $clienteMiembro->cargo_miembro
                ];
            });

            $clienteParienteData = $form->conozcaClienteParientes->map(function ($clientePariente) {
                return [
                    'id' => $clientePariente->id,
                    'nombre_pariente' => $clientePariente->nombre_pariente,
                    'parentesco' => $clientePariente->parentesco
                ];
            });

            $clienteSociosData = $form->conozcaClienteSocios->map(function ($clienteSocio) {
                return [
                    'id' => $clienteSocio->id,
                    'nombre_socio' => $clienteSocio->nombre_socio,
                    'porcentaje_participacion_socio' => $clienteSocio->porcentaje_participacion_socio
                ];
            });

            $clienteArchivosData = $form->conozcaClienteArchivos->map(function ($clienteArchivo) {
                return [
                    'id' => $clienteArchivo->id,
                    'nombre_archivo' => $clienteArchivo->nombre_archivo
                ];
            });

            $data[] = [
                'id' => $form->id,
                'contador' => $contador++,
                'codigo_cliente' => $form->codigo_cliente,
                'tipo' => $form->tipo,
                'tipo_persona' => $form->tipo_persona,
                'estado' => $form->estado,
                'nombre' => $form->nombre,
                'apellido' => $form->apellido,
                'fecha_de_nacimiento' => $form->fecha_de_nacimiento,
                'nacionalidad' => $form->nacionalidad,
                'profesion_u_oficio' => $form->profesion_u_oficio,
                'id_pais' => $form->id_pais,
                'pais' => $form->nombre_pais,
                'id_departamento' => $form->id_departamento,
                'departamento' => $form->departamento_nombre,
                'id_municipio' => $form->id_municipio,
                'municipio' => $form->municipio_nombre,
                'tipo_de_documento' => $form->tipo_de_documento,
                'numero_de_documento' => $form->numero_de_documento,
                'fecha_de_vencimiento' => $form->fecha_de_vencimiento,
                'registro_iva_nrc' => $form->registro_iva_nrc,
                'correo' => $form->email,
                'telefono' => $form->telefono,
                'fecha_de_nombramiento' => $form->fecha_de_nombramiento,
                'id_giro' => $form->id_giro,
                'giro_nombre' => $form->giro_nombre,
                'direccion' => $form->direccion,
                'clasificacion' => $form->clasificacion_nombre,
                'giro_juridico' => $form->giro_juridico,

                'nombre_juridico' => $form->nombre_comercial_juridico,
                'nacionalidad_juridico' => $form->nacionalidad_juridico,
                'numero_nit_juridico' => $form->numero_de_nit_juridico,
                'fecha_de_constitucion' => $form->fecha_de_constitucion_juridico,
                'registro_nrc_juridico' => $form->registro_nrc_juridico,
                'id_pais_juridico' => $form->id_pais_juridico,
                'pais_juridico' => $form->pais_juridico,
                'id_departamento_juridico' => $form->id_departamento_juridico,
                'departamento_juridico' => $form->departamento_juridico,
                'id_municipio_juridico' => $form->id_municipio_juridico,
                'municipio_juridico' => $form->municipio_juridico,
                'telefono_juridico' => $form->telefono_juridico,
                'sitio_web_juridico' => $form->sitio_web_juridico,
                'numero_de_fax_juridico' => $form->numero_de_fax_juridico,
                'direccion_juridico' => $form->direccion_juridico,
                'monto_proyectado' => $form->monto_proyectado,
                'cargo_publico' => $form->cargo_publico,
                'familiar_publico' => $form->familiar_publico,

                'nombre_politico' => $form->nombre_politico,
                'nombre_cargo_politico' => $form->nombre_cargo_politico,
                'fecha_desde_politico' => $form->fecha_desde_politico,
                'fecha_hasta_politico' => $form->fecha_hasta_politico,
                'id_pais_politico' => $form->id_pais_politico,
                'pais_politico' => $form->pais_politico,
                'id_departamento_politico' => $form->id_departamento_politico,
                'departamento_politico' => $form->departamento_politico,
                'id_municipio_politico' => $form->id_municipio_politico,
                'municipio_politico' => $form->municipio_politico,
                'nombre_cliente_politico' => $form->nombre_cliente_politico,
                'porcentaje_participacion_politico' => $form->porcentaje_participacion_politico,
                'fuente_ingreso' => $form->fuente_ingreso,
                'monto_mensual' => $form->monto_mensual,

                'formulario_firmado' => $form->formulario_firmado,
                'documento_identidad_persona_natural' => $form->documento_identidad_persona_natural,
                'documento_tarjeta_iva_persona_natural' => $form->documento_tarjeta_iva_persona_natural,
                'documento_nit_persona_natural' => $form->documento_nit_persona_natural,
                'documento_domicilio_persona_natural' => $form->documento_domicilio_persona_natural,
                'documento_dnm_persona_natural' => $form->documento_dnm_persona_natural,
                'documento_identificacion_representante' => $form->documento_identificacion_representante,
                'documento_nit_representante' => $form->documento_nit_representante,
                'documento_credencial_representante' => $form->documento_credencial_representante,
                'documento_matricula_juridico' => $form->documento_matricula_juridico,
                'documento_acuerdo_juridico' => $form->documento_acuerdo_juridico,
                'documento_nit_juridico' => $form->documento_nit_juridico,
                'documento_iva_juridico' => $form->documento_iva_juridico,
                'documento_domicilio_juridico' => $form->domicilio_juridico,
                'documento_dnm_juridico' => $form->documento_dnm_juridico,

                'cliente_accionista' => $clienteAccionistaData,
                'cliente_miembro' => $clienteMiembroData,
                'cliente_pariente' => $clienteParienteData,
                'cliente_socio' => $clienteSociosData,
                'cliente_archivo' => $clienteArchivosData,

                $fecha_creacion = new DateTime($form->fecha_de_creacion),
                'fecha_creacion' => $fecha_creacion->format('d-m-Y H:i:s'),
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

    public function tablaConozcaProveedor(Request $request)
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

        $query = FrmConozcaCliente::with(
            'conozcaClienteMiembros',
            'conozcaClienteAccionistas',
            'conozcaClientePoliticos',
            'conozcaClienteParientes',
            'conozcaClienteSocios',
            'conozcaClienteArchivos'
        )
            ->select(
                'frm_conozca_cliente.*',
                'frm_conozca_cliente.documento_domicilio_juridico as domicilio_juridico',
                'paises.id as id_pais',
                'paises.nombre as nombre_pais',
                'departamentos.id as id_departamento',
                'departamentos.nombre as departamento_nombre',
                'municipios.id as id_municipio',
                'municipios.nombre as municipio_nombre',
                'giros.id as id_giro',
                'giros.nombre as giro_nombre',
                'frm_conozca_cliente_juridico.*',
                'clasificaciones.nombre as clasificacion_nombre',
                'paises_juridico.id as id_pais_juridico',
                'paises_juridico.nombre as pais_juridico',
                'departamentos_juridico.id as id_departamento_juridico',
                'departamentos_juridico.nombre as departamento_juridico',
                'municipios_juridico.id as id_municipio_juridico',
                'municipios_juridico.nombre as municipio_juridico',
                'giros_juridico.nombre as giro_juridico',
                'frm_conozca_cliente_politico.*',
                'paises_politico.id as id_pais_politico',
                'paises_politico.nombre as pais_politico',
                'departamento_politico.id as id_departamento_politico',
                'departamento_politico.nombre as departamento_politico',
                'municipio_politico.id as id_municipio_politico',
                'municipio_politico.nombre as municipio_politico'
            )
            ->leftJoin('paises', 'frm_conozca_cliente.pais_id', '=', 'paises.id')
            ->leftJoin('departamentos', 'frm_conozca_cliente.departamento_id', '=', 'departamentos.id')
            ->leftJoin('municipios', 'frm_conozca_cliente.municipio_id', '=', 'municipios.id')
            ->leftJoin('giros', 'frm_conozca_cliente.giro_id', '=', 'giros.id')
            ->leftJoin('frm_conozca_cliente_juridico', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_juridico.frm_conozca_cliente_id')
            ->leftJoin('clasificaciones', 'frm_conozca_cliente_juridico.clasificacion_id', '=', 'clasificaciones.id')
            ->leftJoin('paises as paises_juridico', 'frm_conozca_cliente_juridico.pais_id', '=', 'paises_juridico.id')
            ->leftJoin('departamentos as departamentos_juridico', 'frm_conozca_cliente_juridico.departamento_id', '=', 'departamentos_juridico.id')
            ->leftJoin('municipios as municipios_juridico', 'frm_conozca_cliente_juridico.municipio_id', '=', 'municipios_juridico.id')
            ->leftJoin('giros as giros_juridico', 'frm_conozca_cliente_juridico.giro_id', '=', 'giros_juridico.id')
            ->leftJoin('frm_conozca_cliente_politico', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_politico.frm_conozca_cliente_id')
            ->leftJoin('paises as paises_politico', 'frm_conozca_cliente_politico.pais_id', '=', 'paises_politico.id')
            ->leftJoin('departamentos as departamento_politico', 'frm_conozca_cliente_politico.departamento_id', '=', 'departamento_politico.id')
            ->leftJoin('municipios as municipio_politico', 'frm_conozca_cliente_politico.municipio_id', '=', 'municipio_politico.id')
            ->where('tipo', '=', 'Proveedor')
            ->orderBy('frm_conozca_cliente.fecha_de_creacion', 'desc');


        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('frm_conozca_cliente.nombre', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.codigo_cliente', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.tipo', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.tipo_persona', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.apellido', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente.registro_iva_nrc', 'like', '%' . $search . '%')

                    ->orWhere('frm_conozca_cliente_juridico.nombre_comercial_juridico', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente_juridico.numero_de_nit_juridico', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente_juridico.registro_nrc_juridico', 'like', '%' . $search . '%')
                    ->orWhere('frm_conozca_cliente_juridico.monto_proyectado', 'like', '%' . $search . '%')

                    ->orWhere('frm_conozca_cliente.tipo_de_documento', 'like', '%' . $search . '%');
            });
        }

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $formccc = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($formccc as $form) {
            $clienteAccionistaData = $form->conozcaClienteAccionistas->map(function ($clienteAccionista) {
                return [
                    'id' => $clienteAccionista->id,
                    'nombre_accionista' => $clienteAccionista->nombre_accionista,
                    'nacionalidad_accionista' => $clienteAccionista->nacionalidad_accionista,
                    'numero_identidad_accionista' => $clienteAccionista->numero_identidad_accionista,
                    'porcentaje_participacion_accionista' => $clienteAccionista->porcentaje_participacion_accionista
                ];
            });

            $clienteMiembroData = $form->conozcaClienteMiembros->map(function ($clienteMiembro) {
                return [
                    'id' => $clienteMiembro->id,
                    'nombre_miembro' => $clienteMiembro->nombre_miembro,
                    'nacionalidad_miembro' => $clienteMiembro->nacionalidad_miembro,
                    'numero_identidad_miembro' => $clienteMiembro->numero_identidad_miembro,
                    'cargo_miembro' => $clienteMiembro->cargo_miembro
                ];
            });

            $clienteParienteData = $form->conozcaClienteParientes->map(function ($clientePariente) {
                return [
                    'id' => $clientePariente->id,
                    'nombre_pariente' => $clientePariente->nombre_pariente,
                    'parentesco' => $clientePariente->parentesco
                ];
            });

            $clienteSociosData = $form->conozcaClienteSocios->map(function ($clienteSocio) {
                return [
                    'id' => $clienteSocio->id,
                    'nombre_socio' => $clienteSocio->nombre_socio,
                    'porcentaje_participacion_socio' => $clienteSocio->porcentaje_participacion_socio
                ];
            });

            $clienteArchivosData = $form->conozcaClienteArchivos->map(function ($clienteArchivo) {
                return [
                    'id' => $clienteArchivo->id,
                    'nombre_archivo' => $clienteArchivo->nombre_archivo
                ];
            });

            $data[] = [
                'id' => $form->id,
                'contador' => $contador++,
                'codigo_cliente' => $form->codigo_cliente,
                'tipo' => $form->tipo,
                'tipo_persona' => $form->tipo_persona,
                'estado' => $form->estado,
                'nombre' => $form->nombre,
                'apellido' => $form->apellido,
                'fecha_de_nacimiento' => $form->fecha_de_nacimiento,
                'nacionalidad' => $form->nacionalidad,
                'profesion_u_oficio' => $form->profesion_u_oficio,
                'id_pais' => $form->id_pais,
                'pais' => $form->nombre_pais,
                'id_departamento' => $form->id_departamento,
                'departamento' => $form->departamento_nombre,
                'id_municipio' => $form->id_municipio,
                'municipio' => $form->municipio_nombre,
                'tipo_de_documento' => $form->tipo_de_documento,
                'numero_de_documento' => $form->numero_de_documento,
                'fecha_de_vencimiento' => $form->fecha_de_vencimiento,
                'registro_iva_nrc' => $form->registro_iva_nrc,
                'correo' => $form->email,
                'telefono' => $form->telefono,
                'fecha_de_nombramiento' => $form->fecha_de_nombramiento,
                'id_giro' => $form->id_giro,
                'giro_nombre' => $form->giro_nombre,
                'direccion' => $form->direccion,
                'clasificacion' => $form->clasificacion_nombre,
                'giro_juridico' => $form->giro_juridico,

                'nombre_juridico' => $form->nombre_comercial_juridico,
                'nacionalidad_juridico' => $form->nacionalidad_juridico,
                'numero_nit_juridico' => $form->numero_de_nit_juridico,
                'fecha_de_constitucion' => $form->fecha_de_constitucion_juridico,
                'registro_nrc_juridico' => $form->registro_nrc_juridico,
                'id_pais_juridico' => $form->id_pais_juridico,
                'pais_juridico' => $form->pais_juridico,
                'id_departamento_juridico' => $form->id_departamento_juridico,
                'departamento_juridico' => $form->departamento_juridico,
                'id_municipio_juridico' => $form->id_municipio_juridico,
                'municipio_juridico' => $form->municipio_juridico,
                'telefono_juridico' => $form->telefono_juridico,
                'sitio_web_juridico' => $form->sitio_web_juridico,
                'numero_de_fax_juridico' => $form->numero_de_fax_juridico,
                'direccion_juridico' => $form->direccion_juridico,
                'monto_proyectado' => $form->monto_proyectado,
                'cargo_publico' => $form->cargo_publico,
                'familiar_publico' => $form->familiar_publico,

                'nombre_politico' => $form->nombre_politico,
                'nombre_cargo_politico' => $form->nombre_cargo_politico,
                'fecha_desde_politico' => $form->fecha_desde_politico,
                'fecha_hasta_politico' => $form->fecha_hasta_politico,
                'id_pais_politico' => $form->id_pais_politico,
                'pais_politico' => $form->pais_politico,
                'id_departamento_politico' => $form->id_departamento_politico,
                'departamento_politico' => $form->departamento_politico,
                'id_municipio_politico' => $form->id_municipio_politico,
                'municipio_politico' => $form->municipio_politico,
                'nombre_cliente_politico' => $form->nombre_cliente_politico,
                'porcentaje_participacion_politico' => $form->porcentaje_participacion_politico,
                'fuente_ingreso' => $form->fuente_ingreso,
                'monto_mensual' => $form->monto_mensual,

                'formulario_firmado' => $form->formulario_firmado,
                'documento_identidad_persona_natural' => $form->documento_identidad_persona_natural,
                'documento_tarjeta_iva_persona_natural' => $form->documento_tarjeta_iva_persona_natural,
                'documento_nit_persona_natural' => $form->documento_nit_persona_natural,
                'documento_domicilio_persona_natural' => $form->documento_domicilio_persona_natural,
                'documento_dnm_persona_natural' => $form->documento_dnm_persona_natural,
                'documento_identificacion_representante' => $form->documento_identificacion_representante,
                'documento_nit_representante' => $form->documento_nit_representante,
                'documento_credencial_representante' => $form->documento_credencial_representante,
                'documento_matricula_juridico' => $form->documento_matricula_juridico,
                'documento_acuerdo_juridico' => $form->documento_acuerdo_juridico,
                'documento_nit_juridico' => $form->documento_nit_juridico,
                'documento_iva_juridico' => $form->documento_iva_juridico,
                'documento_domicilio_juridico' => $form->domicilio_juridico,
                'documento_dnm_juridico' => $form->documento_dnm_juridico,

                'cliente_accionista' => $clienteAccionistaData,
                'cliente_miembro' => $clienteMiembroData,
                'cliente_pariente' => $clienteParienteData,
                'cliente_socio' => $clienteSociosData,
                'cliente_archivo' => $clienteArchivosData,

                $fecha_creacion = new DateTime($form->fecha_de_creacion),
                'fecha_creacion' => $fecha_creacion->format('d-m-Y H:i:s'),
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

    public function cambiarEstadoFormulario(Request $request, $id)
    {
        try {
            $form = FrmConozcaCliente::findOrFail($id);

            $estado = $request->input('estado');

            $form->update([
                'estado' => (bool) $estado,
            ]);

            return response()->json(['success' => true, 'message' => 'Se ha cambiado el estado del formulario.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Formulario no encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'codigo_cliente' => 'nullable|string',
            'tipo' => 'nullable|string',
            'tipo_persona' => 'nullable|string',
            'nombre' => 'nullable|string',
            'apellido' => 'nullable|string',
            'fecha_de_nacimiento' => 'nullable|date',
            'nacionalidad' => 'nullable|string',
            'profesion_u_oficio' => 'nullable|string',
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
        ]);

        try {
            $formulario = FrmConozcaCliente::findOrFail($id);

            $formulario->codigo_cliente = $request->input('codigo_cliente');
            $formulario->tipo = $request->input('tipo_editar');
            $formulario->tipo_persona = $request->input('tipo_persona_editar');
            $formulario->nombre = $request->input('nombre_cliente_editar');
            $formulario->apellido = $request->input('apellido_cliente_editar');
            $formulario->fecha_de_nacimiento = $request->input('fecha_de_nacimiento_editar');
            $formulario->nacionalidad = $request->input('nacionalidad_editar');
            $formulario->profesion_u_oficio = $request->input('profesion_u_oficio_editar');
            $formulario->usuario_modificador_id = auth()->user()->id;
            $formulario->fecha_de_modificacion = now();
            $formulario->pais_id = $request->input('pais_editar_id');
            $formulario->departamento_id = $request->input('departamento_editar_id');
            $formulario->municipio_id = $request->input('municipio_editar_id');
            $formulario->tipo_de_documento = $request->input('tipo_de_documento_editar');
            $formulario->numero_de_documento = str_replace('-', '', $request->input('numero_de_documento_editar'));
            $formulario->fecha_de_vencimiento = $request->input('fecha_de_vencimiento_editar');
            $formulario->registro_iva_nrc = str_replace('-', '', $request->input('registro_iva_nrc_editar'));
            $formulario->email = $request->input('correo_editar');
            $formulario->telefono = str_replace(['+', '-'], '', $request->input('telefono_editar'));

            $formulario->giro_id = $request->input('giro_id');
            $formulario->fecha_de_nombramiento = $request->input('fecha_de_nombramiento_editar');
            $formulario->direccion = $request->input('direccion_editar');

            $formulario->save();

            return response()->json(['success' => true, 'message' => 'Formulario actualizado con éxito!', 'data' => $formulario]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => '¡Actualización fallida!: ' . $e->getMessage()]);
        }
    }
    
    public function destroy($id)
    {
        $formulario = FrmConozcaCliente::find($id);

        if (!$formulario) {
            return response()->json([
                'success' => false,
                'error' => '¡Formulario no encontrado!'
            ]);
        }

        try {
            $rutaCarpeta = public_path("docs/fccc/{$formulario->id}");

            if (File::exists($rutaCarpeta)) {
                File::deleteDirectory($rutaCarpeta);
            }

            $formulario->delete();

            return response()->json(['success' => true, 'message' => '¡Formulario eliminado con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar el formulario.']);
        }
    }
}
