<?php

namespace App\Http\Controllers;

use App\Models\ClienteCofasa;
use App\Models\ClienteNemull;
use App\Models\ClienteOmega;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ClienteController extends Controller
{
    protected $models = [
        'Cofasa' => ['class' => ClienteCofasa::class],
        'Omega' => ['class' => ClienteOmega::class],
        'Nemull' => ['class' => ClienteNemull::class],
    ];

    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('clientes', compact('usuario'));
    }

    public function tablaClientes(Request $request)
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
        // $orderColumnIndex = $request->input('order.0.column');
        // $orderDirection = $request->input('order.0.dir');

        // $columnNames = ['idCliente', 'codigo', 'regIVA', 'propietario', 'establecimiento', 'fecha', 'usuarioReg'];

        $models = [
            'Cofasa' => ['class' => ClienteCofasa::class],
            'Omega' => ['class' => ClienteOmega::class],
            'Nemull' => ['class' => ClienteNemull::class],
        ];

        $combinedData = [];
        $totalRegistros = 0;

        foreach ($models as $tableName => $modelInfo) {
            $modelClass = $modelInfo['class'];
            $model = new $modelClass;

            $query = $this->buildQuery($model, $request->input('search.value'));

            $totalRegistros += $query->count();

            $data = $query->orderBy('fecha', 'desc')
                ->get()
                ->toArray();

            foreach ($data as $row) {
                $row['conexion'] = $tableName;
                $combinedData[] = $row;
            }
        }

        $combinedData = array_slice($combinedData, $request->input('start'), $request->input('length'));

        $transformedData = $this->transformData($combinedData, $request->input('start'));

        $recordsFiltered = $totalRegistros;

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRegistros,
            'recordsFiltered' => $recordsFiltered,
            'data' => $transformedData,
        ]);
    }

    private function buildQuery($model, $search)
    {
        $query = $model->select([
            $model->getTable() . '.idCliente',
            $model->getTable() . '.codigo',
            $model->getTable() . '.regIVA',
            $model->getTable() . '.propietario',
            $model->getTable() . '.establecimiento',
            $model->getTable() . '.nit',
            $model->getTable() . '.dui',
            $model->getTable() . '.giroIVA',
            $model->getTable() . '.telefono',
            $model->getTable() . '.email',
            $model->getTable() . '.direccion',
            $model->getTable() . '.fecha',
            $model->getTable() . '.usuarioReg',
        ]);

        if (!empty ($search)) {
            $query->where(function ($query) use ($search) {
                foreach (['codigo', 'regIVA', 'propietario', 'nit', 'dui', 'giroIVA', 'telefono', 'email', 'direccion', 'establecimiento', 'fecha', 'usuarioReg'] as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        return $query;
    }

    private function transformData($data, $start)
    {
        $contador = $start + 1;
        $transformedData = [];

        foreach ($data as $cliente) {
            $transformedData[] = [
                'id' => intval($cliente['idCliente']),
                'contador' => $contador++,
                'empresa' => $cliente['conexion'],
                'codigo' => trim($cliente['codigo']),
                'nrc' => str_replace('-', '', trim($cliente['regIVA'])),
                'propietario' => $cliente['propietario'],
                'establecimiento' => $cliente['establecimiento'],
                'giro' => $cliente['giroIVA'],
                'nit' => str_replace('-', '', trim($cliente['nit'])),
                'dui' => str_replace('-', '', trim($cliente['dui'])),
                'correo' => $cliente['email'],
                'telefono' => str_replace('-', '', trim($cliente['telefono'])),
                'direccion' => $cliente['direccion'],
                'fecha_registro' => Carbon::parse($cliente['fecha'])->format('Y-m-d'),
                'usuario_registro' => $cliente['usuarioReg'],
            ];
        }

        return $transformedData;
    }

    public function verClientes(Request $request)
    {
        $perPage = 10;
        $page = $request->input('page', 1);
        $allClients = $this->obtenerClientes($page, $perPage);

        return response()->json($allClients);
    }

    private function obtenerClientes($page, $perPage)
    {
        $combinedData = [];
        $totalRegistros = 0;

        foreach ($this->models as $tableName => $modelInfo) {
            $modelClass = $modelInfo['class'];
            $model = new $modelClass;

            $query = $this->buildQuery($model, '');

            $totalRegistros += $query->count();

            $data = $query->orderBy('fecha', 'desc')->get();

            foreach ($data as $row) {
                $row['conexion'] = $tableName;
                $combinedData[] = $row;
            }
        }

        $start = ($page - 1) * $perPage;
        $paginatedData = array_slice($combinedData, $start, $perPage);

        return [
            'data' => $this->transformData($paginatedData, $start),
            'pagina_actual' => $page,
            'por_pagina' => $perPage,
            'total' => $totalRegistros,
            'url_siguiente' => $this->obtenerSiguienteUrl($combinedData, $page, $perPage),
            'url_anterior' => $this->obtenerAnteriorUrl($page),
        ];
    }

    private function obtenerSiguienteUrl($data, $currentPage, $perPage)
    {
        $start = $currentPage * $perPage;
        $nextPage = array_slice($data, $start, $perPage);

        return count($nextPage) > 0 ? url()->current() . '?page=' . ($currentPage + 1) : null;
    }

    private function obtenerAnteriorUrl($currentPage)
    {
        return $currentPage > 1 ? url()->current() . '?page=' . ($currentPage - 1) : null;
    }

    public function buscarClientePorId($idCliente)
    {
        $clienteEncontrado = $this->buscarClienteEnConexiones($idCliente);

        if ($clienteEncontrado) {
            return response()->json([
                'data' => $clienteEncontrado,
            ]);
        } else {
            return response()->json([
                'message' => 'Cliente no encontrado',
            ], 404);
        }
    }

    private function buscarClienteEnConexiones($idCliente)
    {
        foreach ($this->models as $tableName => $modelInfo) {
            $modelClass = $modelInfo['class'];
            $model = new $modelClass;

            $clienteEncontrado = $model->where('idCliente', $idCliente)->first();

            if ($clienteEncontrado) {
                $clienteEncontrado['empresa'] = $tableName;
                return $clienteEncontrado;
            }
        }

        return null;
    }
}