<?php

namespace App\Http\Controllers;

use App\Models\FrmConozcaCliente;
use Illuminate\Http\Request;
use DateTime;
use App\Models\User;

class FormulariosController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());
        return view('formularios.formularios', compact('usuario'));
    }

    public function show()
    {
        $usuario = User::with('perfil')->find(auth()->id());
        return view('formularios.formularios_tabla', compact('usuario'));
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
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $query = FrmConozcaCliente::with(
            'conozcaClienteMiembros',
            'conozcaClienteAccionistas',
            'conozcaClientePoliticos',
            'conozcaClienteParientes',
            'conozcaClienteSocios'
        )
            ->select(
                'frm_conozca_cliente.*',
                'paises.nombre as nombre_pais',
                'departamentos.nombre as departamento_nombre',
                'municipios.nombre as municipio_nombre',
                'giros.nombre as giro_nombre',
                'frm_conozca_cliente_juridico.*',
                'clasificaciones.nombre as clasificacion_nombre',
                'paises_juridico.nombre as pais_juridico',
                'departamentos_juridico.nombre as departamento_juridico',
                'municipios_juridico.nombre as municipio_juridico',
                'giros_juridico.nombre as giro_juridico',
                'frm_conozca_cliente_politico.*',
                'paises_politico.nombre as pais_politico',
                'departamento_politico.nombre as departamento_politico',
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
            ->orderBy('frm_conozca_cliente.fecha_de_creacion', 'desc');

        if (!empty ($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('frm_conozca_cliente.nombre', 'like', '%' . $search . '%')
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

            $data[] = [
                'id' => $form->id,
                'contador' => $contador++,
                'estado' => $form->estado,
                'nombre' => $form->nombre,
                'apellido' => $form->apellido,
                'fecha_de_nacimiento' => $form->fecha_de_nacimiento,
                'nacionalidad' => $form->nacionalidad,
                'profesion_u_oficio' => $form->profesion_u_oficio,
                'pais' => $form->nombre_pais,
                'departamento' => $form->departamento_nombre,
                'municipio' => $form->municipio_nombre,
                'tipo_de_documento' => $form->tipo_de_documento,
                'numero_de_documento' => $form->numero_de_documento,
                'fecha_de_vencimiento' => $form->fecha_de_vencimiento,
                'registro_iva_nrc' => $form->registro_iva_nrc,
                'correo' => $form->email,
                'telefono' => $form->telefono,
                'fecha_de_nombramiento' => $form->fecha_de_nombramiento,
                'giro_nombre' => $form->giro_nombre,
                'direccion' => $form->direccion,
                'clasificacion' => $form->clasificacion_nombre,
                'giro_juridico' => $form->giro_juridico,

                'nombre_juridico' => $form->nombre_comercial_juridico,
                'nacionalidad_juridico' => $form->nacionalidad_juridico,
                'numero_nit_juridico' => $form->numero_de_nit_juridico,
                'fecha_de_constitucion' => $form->fecha_de_constitucion_juridico,
                'registro_nrc_juridico' => $form->registro_nrc_juridico,
                'pais_juridico' => $form->pais_juridico,
                'departamento_juridico' => $form->departamento_juridico,
                'municipio_juridico' => $form->municipio_juridico,
                'telefono_juridico' => $form->telefono_juridico,
                'sitio_web_juridico' => $form->sitio_web_juridico,
                'numero_de_fax_juridico' => $form->numero_de_fax_juridico,
                'direccion_juridico' => $form->direccion_juridico,
                'monto_proyectado' => $form->monto_proyectado,

                'nombre_politico' => $form->nombre_politico,
                'nombre_cargo_politico' => $form->nombre_cargo_politico,
                'fecha_desde_politico' => $form->fecha_desde_politico,
                'fecha_hasta_politico' => $form->fecha_hasta_politico,
                'pais_politico' => $form->pais_politico,
                'departamento_politico' => $form->departamento_politico,
                'municipio_politico' => $form->municipio_politico,
                'nombre_cliente_politico' => $form->nombre_cliente_politico,
                'porcentaje_participacion_politico' => $form->porcentaje_participacion_politico,
                'fuente_ingreso' => $form->fuente_ingreso,
                'monto_mensual' => $form->monto_mensual,


                'cliente_accionista' => $clienteAccionistaData,
                'cliente_miembro' => $clienteMiembroData,
                'cliente_pariente' => $clienteParienteData,
                'cliente_socio' => $clienteSociosData,
                'fecha_creacion' => (new DateTime($form->fecha_de_creacion))->format('Y-m-d H:i:s'),
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
}
