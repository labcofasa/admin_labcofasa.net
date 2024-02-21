<?php

namespace App\Http\Controllers;

use App\Models\ClienteCofasa;
use App\Models\ClienteNemull;
use Illuminate\Support\Facades\DB;
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
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $columnNames = ['codigo', 'regIVA', 'propietario', 'establecimiento', 'fechaReg', 'email', 'usuarioReg'];

        $models = [
            'Cofasa' => ['class' => ClienteCofasa::class],
            'Omega' => ['class' => ClienteOmega::class],
            'Nemull' => ['class' => ClienteNemull::class],
        ];

        $data = [];
        $totalRegistros = 0;

        $query = null;

        foreach ($models as $tableName => $modelInfo) {
            $modelClass = $modelInfo['class'];

            $model = new $modelClass;

            $currentQuery = $model->select([
                $model->getTable() . '.codigo',
                $model->getTable() . '.regIVA',
                $model->getTable() . '.propietario',
                $model->getTable() . '.establecimiento',
                $model->getTable() . '.fechaReg',
                $model->getTable() . '.email',
                $model->getTable() . '.usuarioReg',
            ]);

            if (!empty($search)) {
                $currentQuery->where(function ($query) use ($search) {
                    $query->orWhere('codigo', 'like', '%' . $search . '%')
                        ->orWhere('regIVA', 'like', '%' . $search . '%')
                        ->orWhere('propietario', 'like', '%' . $search . '%')
                        ->orWhere('establecimiento', 'like', '%' . $search . '%')
                        ->orWhere('fechaReg', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('usuarioReg', 'like', '%' . $search . '%');
                });
            }

            $totalRegistros += $currentQuery->count();

            if ($length != -1) {
                $currentQuery->skip($start)->take($length);
            }

            if ($query === null) {
                $query = $currentQuery;
            } else {
                $query->union($currentQuery);
            }
        }

        $query->orderBy($columnNames[$orderColumnIndex], $orderDirection);
        
        $contador = $start + 1;
        $data = [];

        foreach ($query->get() as $cliente) {
            $data[] = [
                'contador' => $contador++,
                'codigo' => $cliente->codigo,
                'nrc' => $cliente->regIVA,
                'propietario' => $cliente->propietario,
                'establecimiento' => $cliente->establecimiento,
                'fecha_registro' => Carbon::parse($cliente->fechaReg)->format('Y-m-d H:i:s'),
                'usuario_registro' => $cliente->usuarioReg,
                'email' => $cliente->email,
            ];
        }

        $recordsFiltered = $totalRegistros;

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRegistros,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }
}