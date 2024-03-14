<?php

namespace App\Http\Controllers;

use App\Models\FrmConozcaCliente;
use Illuminate\Http\Request;
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
        // $search = $request->input('search.value');
        // $orderColumnIndex = $request->input('order.0.column');
        // $orderDirection = $request->input('order.0.dir');

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
                'frm_conozca_cliente_juridico.*'
            )
            ->leftJoin('paises', 'frm_conozca_cliente.pais_id', '=', 'paises.id')
            ->leftJoin('departamentos', 'frm_conozca_cliente.departamento_id', '=', 'departamentos.id')
            ->leftJoin('municipios', 'frm_conozca_cliente.municipio_id', '=', 'municipios.id')
            ->leftJoin('frm_conozca_cliente_juridico', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_id');

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $formccc = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($formccc as $form) {
            $clienteMiembroData = $form->conozcaClienteMiembros->map(function ($clienteMiembro) {
                return [
                    'id' => $clienteMiembro->id,
                    'nombre_miembro' => $clienteMiembro->nombre_miembro,
                ];
            });

            $clienteAccionistaData = $form->conozcaClienteAccionistas->map(function ($clienteAccionista) {
                return [
                    'id' => $clienteAccionista->id,
                    'nombre_accionista' => $clienteAccionista->nombre_accionista,
                ];
            });

            $clientePoliticoData = $form->conozcaClientePoliticos->map(function ($clientePolitico) {
                return [
                    'id' => $clientePolitico->id,
                    'nombre_politico' => $clientePolitico->nombre_politico,
                ];
            });

            $clienteParienteData = $form->conozcaClienteParientes->map(function ($clientePariente) {
                return [
                    'id' => $clientePariente->id,
                    'nombre_pariente' => $clientePariente->nombre_pariente,
                ];
            });

            $clienteSociosData = $form->conozcaClienteSocios->map(function ($clienteSocio) {
                return [
                    'id' => $clienteSocio->id,
                    'nombre_socio' => $clienteSocio->nombre_socio,
                ];
            });

            $data[] = [
                'id' => $form->id,
                'contador' => $contador++,
                'nombre' => $form->nombre,
                'pais' => $form->nombre_pais,
                'departamento' => $form->departamento_nombre,
                'municipio' => $form->municipio_nombre,
                'nombre_juridico' => $form->nombre_comercial_juridico,
                'cliente_miembro' => $clienteMiembroData,
                'cliente_accionista' => $clienteAccionistaData,
                'cliente_politico' => $clientePoliticoData,
                'cliente_pariente' => $clienteParienteData,
                'cliente_socio' => $clienteSociosData,
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
}
