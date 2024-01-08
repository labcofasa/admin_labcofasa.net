<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermisoController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('permisos', compact('usuario'));
    }

    public function obtenerPermisos(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $permisosQuery = Permission::select('permissions.*');

        if (!empty($search)) {
            $permisosQuery->where(function ($q) use ($search) {
                $q->where('permissions.name', 'like', "%$search%")
                    ->orWhere('permissions.descripcion', 'like', "%$search%")
                    ->orWhere('permissions.created_at', 'like', "%$search%")
                    ->orWhere('permissions.updated_at', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'name', 'descripcion', 'created_at', 'updated_at'];
        $orderColumn = $columnNames[$orderColumnIndex];

        $permisosQuery->orderBy($orderColumn, $orderDirection);

        $totalPermisos = $permisosQuery->count();
        $totalRegistros = $totalPermisos;

        if ($length != -1) {
            $permisosQuery->skip($start)->take($length);
        }

        $permisos = $permisosQuery->get();

        $data = [];
        $contador = $start + 1;

        foreach ($permisos as $permiso) {
            $data[] = [
                'id' => $permiso->id,
                'contador' => $contador++,
                'name' => $permiso->name,
                'descripcion' => $permiso->descripcion,
                'created_at' => $permiso->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $permiso->updated_at->format('Y-m-d H:i:s'),
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
    public function permisosRol(Request $request, $rolId)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');

        $role = Role::findOrFail($rolId);
        $query = $role->permissions();

        $query->select([
            'permissions.id',
            'permissions.descripcion as name',
        ]);

        if (!empty($search)) {
            $query->where('permissions.descripcion', 'like', "%$search%");
        }

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $roles_permisos = $query->get();

        $data = [];
        foreach ($roles_permisos as $rolesPermiso) {
            $data[] = [
                null,
                'id' => $rolesPermiso->id,
                'name' => $rolesPermiso->name,
            ];
        }

        $registrosFiltrados = $filteredQuery->count();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRegistros,
            'recordsFiltered' => $registrosFiltrados,
            'data' => $data,
        ]);
    }
    public function eliminarPermiso(Request $request, $rolId, $permisoId)
    {
        try {
            $role = Role::findOrFail($rolId);
            $permission = Permission::findOrFail($permisoId);

            $role->revokePermissionTo($permission);

            return response()->json(['success' => true, 'message' => 'El permiso se ha eliminado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'error' => 'El rol o permiso no existen'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'No se pudo eliminar el permiso'], 500);
        }
    }
    public function eliminarPermisosMasa(Request $request)
    {
        try {
            $permisos = $request->input('permisos');

            foreach ($permisos as $permiso) {
                $role = Role::findOrFail($permiso['rolId']);
                $permission = Permission::findOrFail($permiso['permisoId']);
                $role->revokePermissionTo($permission);
            }

            return response()->json(['success' => true, 'message' => 'Los permisos se han eliminado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'error' => 'El rol o permiso no existen'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'No se pudieron eliminar los permisos'], 500);
        }
    }
    public function permisosAsignar(Request $request, $rolId)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');

        $role = Role::findOrFail($rolId);

        $permisosAsignados = $role->permissions()->pluck('permissions.id');

        $query = Permission::select([
            'permissions.id',
            'permissions.descripcion as name',
        ])->whereNotIn('permissions.id', $permisosAsignados);

        if (!empty($search)) {
            $query->where('permissions.descripcion', 'like', "%$search%");
        }

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $permisosDisponibles = $query->get();

        $data = [];
        foreach ($permisosDisponibles as $permiso) {
            $data[] = [
                null,
                'id' => $permiso->id,
                'name' => $permiso->name,
            ];
        }

        $registrosFiltrados = $filteredQuery->count();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRegistros,
            'recordsFiltered' => $registrosFiltrados,
            'data' => $data,
        ]);
    }
    public function asignarPermisoARol(Request $request, $rolId, $permisoId)
    {
        try {
            $role = Role::findOrFail($rolId);
            $permission = Permission::findOrFail($permisoId);

            $role->givePermissionTo($permission);

            return response()->json(['success' => true, 'message' => 'El permiso se ha asignado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'error' => 'El rol o permiso no existen'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'No se pudo asignar el permiso'], 500);
        }
    }
    public function asignarPermisosMasa(Request $request)
    {
        try {
            $permisos = $request->input('permisos');

            foreach ($permisos as $permiso) {
                $role = Role::findOrFail($permiso['rolId']);
                $permission = Permission::findOrFail($permiso['permisoId']);
                $role->givePermissionTo($permission);
            }

            return response()->json(['success' => true, 'message' => 'Los permisos se han asignado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'error' => 'El rol o permiso no existen'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'No se pudieron asignar los permisos'], 500);
        }
    }
}
