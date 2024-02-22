<?php

namespace App\Http\Controllers;

use App\Models\ClienteCofasa;
use App\Models\ClienteNemull;
use App\Models\ClienteOmega;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('cliente', compact('usuario'));
    }
    public function verClientes()
    {
        $clientes = ClienteOmega::select('codigo', 'propietario', 'establecimiento')->paginate(5);

        return response()->json($clientes)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
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
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $columnNames = ['idCliente', 'codigo', 'regIVA', 'propietario', 'establecimiento', 'fecha', 'usuarioReg'];

        $models = [
            'Cofasa' => ['class' => ClienteCofasa::class],
            'Omega' => ['class' => ClienteOmega::class],
            'Nemull' => ['class' => ClienteNemull::class],
        ];

        $data = [];
        $totalRegistros = 0;

        foreach ($models as $tableName => $modelInfo) {
            $modelClass = $modelInfo['class'];
            $model = new $modelClass;

            $query = $this->buildQuery($model, $request->input('search.value'));

            $totalRegistros += $query->count();

            $paginatedData = $query->skip($request->input('start'))->take($request->input('length'))->get()->toArray();

            $data[$tableName] = $this->sortData($paginatedData, $columnNames[$orderColumnIndex], $orderDirection);
        }

        $combinedData = [];
        foreach ($data as $tableName => $modelData) {
            $combinedData = array_merge($combinedData, $modelData);
        }

        $combinedData = array_slice($combinedData, 0, $request->input('length'));

        $transformedData = $this->transformData($combinedData, $request->input('start'));

        $recordsFiltered = $totalRegistros;

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRegistros,
            'recordsFiltered' => $recordsFiltered,
            'data' => $transformedData,
        ]);
    }

    private function buildQuery($modelClass, $search)
    {
        $model = new $modelClass;

        $query = $model->select([
            $model->getTable() . '.idCliente',
            $model->getTable() . '.codigo',
            $model->getTable() . '.regIVA',
            $model->getTable() . '.propietario',
            $model->getTable() . '.establecimiento',
            $model->getTable() . '.fecha',
            $model->getTable() . '.usuarioReg',
        ]);

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                foreach (['codigo', 'regIVA', 'propietario', 'establecimiento', 'fecha', 'usuarioReg'] as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        return $query;
    }

    private function sortData($data, $column, $direction)
    {
        usort($data, function ($a, $b) use ($column, $direction) {
            return ($direction == 'asc') ? strnatcmp($a[$column], $b[$column]) : strnatcmp($b[$column], $a[$column]);
        });

        return $data;
    }

    private function transformData($data, $start)
    {
        $contador = $start + 1;
        $transformedData = [];

        foreach ($data as $cliente) {
            $transformedData[] = [
                'id' => $cliente['idCliente'],
                'contador' => $contador++,
                'codigo' => $cliente['codigo'],
                'nrc' => $cliente['regIVA'],
                'propietario' => $cliente['propietario'],
                'establecimiento' => $cliente['establecimiento'],
                'fecha_registro' => Carbon::parse($cliente['fecha'])->format('Y-m-d'),
                'usuario_registro' => $cliente['usuarioReg'],
            ];
        }

        return $transformedData;
    }

}