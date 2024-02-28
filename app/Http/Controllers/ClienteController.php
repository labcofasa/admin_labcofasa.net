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

        return view('clientes', compact('usuario'));
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

        $combinedData = [];
        $totalRegistros = 0;

        foreach ($models as $tableName => $modelInfo) {
            $modelClass = $modelInfo['class'];
            $model = new $modelClass;

            $query = $this->buildQuery($model, $request->input('search.value'));

            $totalRegistros += $query->count();

            $data = $query->orderBy($columnNames[$orderColumnIndex], $orderDirection)
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

    private function transformData($data, $start)
    {
        $contador = $start + 1;
        $transformedData = [];

        foreach ($data as $cliente) {
            $transformedData[] = [
                'id' => $cliente['idCliente'],
                'contador' => $contador++,
                'conexion' => $cliente['conexion'],
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