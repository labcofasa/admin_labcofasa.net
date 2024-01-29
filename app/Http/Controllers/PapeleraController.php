<?php

namespace App\Http\Controllers;

use App\Models\Aplicacion;
use App\Models\Clasificacion;
use App\Models\Empresa;
use App\Models\RedSocial;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Entidad;
use App\Models\Giro;
use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Publicidad;

class PapeleraController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('papelera', compact('usuario'));
    }

    public function obtenerEliminados(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $models = [
            'Entidades' => ['class' => Entidad::class, 'column' => 'nombre'],
            'Giros' => ['class' => Giro::class, 'column' => 'nombre'],
            'Paises' => ['class' => Pais::class, 'column' => 'nombre'],
            'Departamentos' => ['class' => Departamento::class, 'column' => 'nombre'],
            'Municipios' => ['class' => Municipio::class, 'column' => 'nombre'],
            'Roles' => ['class' => UserRole::class, 'column' => 'name'],
            'Empresas' => ['class' => Empresa::class, 'column' => 'nombre'],
            'Redes sociales' => ['class' => RedSocial::class, 'column' => 'nombre'],
            'Clasificaciones' => ['class' => Clasificacion::class, 'column' => 'nombre'],
            'Usuarios' => ['class' => User::class, 'column' => 'nombre'],
            'Aplicaciones' => ['class' => Aplicacion::class, 'column' => 'nombre_aplicacion'],
            'Publicidades' => ['class' => Publicidad::class, 'column' => 'nombre_publicidad'],
        ];

        $data = [];
        $totalRegistros = 0;

        foreach ($models as $tableName => $modelInfo) {
            $modelClass = $modelInfo['class'];
            $columnName = $modelInfo['column'];

            $model = new $modelClass;
            $query = $model::onlyTrashed()
                ->select([
                    $model->getTable() . '.id',
                    $model->getTable() . '.' . $columnName,
                    $model->getTable() . '.nombre_tabla',
                    $model->getTable() . '.deleted_at',
                    'user_deleted.nombre as user_deleted_name',
                ])
                ->leftJoin('usuarios as user_deleted', $model->getTable() . '.user_deleted_id', '=', 'user_deleted.id');

            if (!empty($search)) {
                $query->where(function ($q) use ($search, $model, $columnName) {
                    foreach ($model->getSearchableColumns() as $column) {
                        $q->orWhere($model->getTable() . '.' . $column, 'like', "%$search%");
                    }
                    $q->orWhere($model->getTable() . '.' . $columnName, 'like', "%$search%");
                    $q->orWhere('user_deleted.nombre', 'like', "%$search%");
                });
            }

            $totalRegistros += $query->count();

            if ($length != -1) {
                $query->skip($start)->take($length);
            }

            $contador = $start + 1;
            foreach ($query->get() as $record) {
                $data[] = [
                    'id' => $record->id,
                    'contador' => $contador++,
                    'nombre' => $record->$columnName,
                    'nombre_tabla' => $record->nombre_tabla,
                    'deleted_at' => $record->deleted_at->format('Y-m-d H:i:s'),
                    'user_deleted_name' => $record->user_deleted_name,
                ];
            }
        }

        $recordsFiltered = $totalRegistros;

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRegistros,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function restoreRecord($table, $id)
    {
        $modelClass = $this->resolveModel($table);

        if ($modelClass) {
            $model = $modelClass::withTrashed()->find($id);

            if ($model) {
                if ($model->trashed()) {
                    $model->restoreRecord();
                    return response()->json(['success' => true, 'message' => 'Registro restaurado correctamente']);
                } else {
                    return response()->json(['success' => false, 'error' => 'El registro ya está restaurado']);
                }
            } else {
                return response()->json(['success' => false, 'error' => 'No se encontró el registro']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Tabla no válida']);
        }
    }

    private function resolveModel($table)
    {
        $modelMap = [
            'Entidades' => Entidad::class,
            'Giros' => Giro::class,
            'Paises' => Pais::class,
            'Departamentos' => Departamento::class,
            'Municipios' => Municipio::class,
            'Roles' => UserRole::class,
            'Empresas' => Empresa::class,
            'Redes sociales' => RedSocial::class,
            'Clasificaciones' => Clasificacion::class,
            'Usuarios' => User::class,
            'Aplicaciones' => Aplicacion::class,
            'Publicidades' => Publicidad::class,
        ];

        return $modelMap[$table] ?? null;
    }
}
