<?php

namespace App\Http\Controllers;

use App\Models\ArticuloCofasa;
use App\Models\ArticuloNemull;
use App\Models\ArticuloOmega;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class ArticuloController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('articulos', compact('usuario'));
    }

    protected $models = [
        'Cofasa' => ['class' => ArticuloCofasa::class],
        'Omega' => ['class' => ArticuloOmega::class],
        'Nemull' => ['class' => ArticuloNemull::class],
    ];

    public function tablaArticulos(Request $request)
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

        $models = [
            'Cofasa' => ['class' => ArticuloCofasa::class],
            'Omega' => ['class' => ArticuloOmega::class],
            'Nemull' => ['class' => ArticuloNemull::class],
        ];

        $combinedData = [];
        $totalRegistros = 0;

        foreach ($models as $tableName => $modelInfo) {
            $modelClass = $modelInfo['class'];
            $model = new $modelClass;

            $query = $this->buildQuery($model, $request->input('search.value'));

            $totalRegistros += $query->count();

            $data = $query->orderBy('fechaReg', 'desc')
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
            $model->getTable() . '.nombre',
            $model->getTable() . '.descripcionPres',
            $model->getTable() . '.costo',
            $model->getTable() . '.existencia',
            $model->getTable() . '.precioFar',
            $model->getTable() . '.precioPub',
            $model->getTable() . '.cantidadPres',
            $model->getTable() . '.fechaReg',
        ]);

        if (!empty ($search)) {
            $query->where(function ($query) use ($search) {
                foreach (['nombre', 'fechaReg'] as $column) {
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

        foreach ($data as $articulo) {
            $costo = ($articulo['costo'] == 0) ? 0 : $articulo['costo'];
            $existencia = ($articulo['existencia'] == 0) ? 0 : $articulo['existencia'];
            $precio_farmacia = ($articulo['precioFar'] == 0) ? 0 : $articulo['precioFar'];
            $precio_publico = ($articulo['precioPub'] == 0) ? 0 : $articulo['precioPub'];

            $transformedData[] = [
                'contador' => $contador++,
                'nombre' => $articulo['nombre'],
                'descripcion' => $articulo['descripcionPres'],
                'costo' => $costo,
                'existencia' => $existencia,
                'precio_farmacia' => $precio_farmacia,
                'precio_publico' => $precio_publico,
                'cantidad_presentacion' => $articulo['cantidadPres'],
                'fecha_registro' => Carbon::parse($articulo['fechaReg'])->format('Y-m-d'),
            ];
        }

        return $transformedData;
    }
}
