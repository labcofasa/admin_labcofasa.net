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

        $query = FrmConozcaCliente::select(
            'frm_conozca_cliente.*',
            'paises.nombre as nombre_pais',
            'departamentos.nombre as departamento_nombre',
            'municipios.nombre as municipio_nombre'
        )
            ->leftJoin('paises', 'frm_conozca_cliente.pais_id', '=', 'paises.id')
            ->leftJoin('departamentos', 'frm_conozca_cliente.departamento_id', '=', 'departamentos.id')
            ->leftJoin('municipios', 'frm_conozca_cliente.municipio_id', '=', 'municipios.id');


        // ->with(['conozcaClienteJuridico', 'conozcaClienteAccionistas', 'conozcaClienteMiembros', 'conozcaClientePoliticos', 'conozcaClienteParientes', 'conozcaClienteSocios'])
        // ->leftJoin('frm_conozca_cliente_juridico', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_juridico.frm_conozca_cliente_id')
        // ->leftJoin('frm_conozca_cliente_accionista', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_accionista.frm_conozca_cliente_id')
        // ->leftJoin('frm_conozca_cliente_politico', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_politico.frm_conozca_cliente_id')
        // ->leftJoin('frm_conozca_cliente_pariente as fccp2', 'frm_conozca_cliente.id', '=', 'fccp2.frm_conozca_cliente_id')
        // ->leftJoin('frm_conozca_cliente_pariente as fccp3', 'frm_conozca_cliente.id', '=', 'fccp3.frm_conozca_cliente_id')
        // ->leftJoin('frm_conozca_cliente_socio', 'frm_conozca_cliente.id', '=', 'frm_conozca_cliente_socio.frm_conozca_cliente_id')

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $formccc = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($formccc as $form) {
            $data[] = [
                'id' => $form->id,
                'contador' => $contador++,
                'nombre' => $form->nombre,
                'pais' => $form->nombre_pais,
                'departamento' => $form->departamento_nombre,
                'municipio' => $form->municipio_nombre,
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
