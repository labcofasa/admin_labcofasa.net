<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('roles', compact('usuario'));
    }

    public function obtenerRolesUsuarios()
    {
        $rolesUsuarios = Role::pluck('name', 'id');
        return response()->json($rolesUsuarios);
    }
    public function obtenerRoles(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        $rolesQuery = UserRole::select('roles.*', 'users.name as user_name', 'modified_users.name as user_modified_name')
            ->leftJoin('users', 'roles.user_id', '=', 'users.id')
            ->leftJoin('users as modified_users', 'roles.user_modified_id', '=', 'modified_users.id');

        if (!empty($search)) {
            $rolesQuery->where(function ($q) use ($search) {
                $q->where('roles.name', 'like', "%$search%")
                    ->orWhere('roles.descripcion', 'like', "%$search%")
                    ->orWhere('users.name', 'like', "%$search%")
                    ->orWhere('modified_users.name', 'like', "%$search%")
                    ->orWhere(function ($q) use ($search) {
                        $q->where('roles.created_at', 'like', "%$search%")
                            ->orWhere('roles.updated_at', 'like', "%$search%");
                    });
            });
        }

        $columnNames = ['id', 'name', 'descripcion', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
        $orderColumn = $columnNames[$orderColumnIndex];

        $rolesQuery->orderBy($orderColumn, $orderDirection);

        $totalRoles = $rolesQuery->count();
        $totalRegistros = $totalRoles;

        if ($length != -1) {
            $rolesQuery->skip($start)->take($length);
        }

        $roles = $rolesQuery->get();

        $data = [];
        $contador = $start + 1;

        foreach ($roles as $rol) {
            $data[] = [
                'id' => $rol->id,
                'contador' => $contador++,
                'name' => $rol->name,
                'descripcion' => $rol->descripcion,
                'created_at' => $rol->created_at->format('Y-m-d H:i:s'),
                'user_name' => $rol->user_name,
                'updated_at' => $rol->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $rol->user_modified_name,
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'descripcion' => 'required|string'
        ]);

        try {
            $nombreRol = $request->input('name');
            $descripcion = $request->input('descripcion');

            $existingRol = UserRole::withTrashed()->where('name', $nombreRol)->first();

            if ($existingRol) {
                if ($existingRol->trashed()) {
                    $existingRol->restore();
                    $existingRol->update([
                        'name' => $nombreRol,
                        'descripcion' => $descripcion,
                        'user_modified_id' => auth()->user()->id,
                    ]);
                    return response()->json(['success' => true, 'message' => '¡Rol registrado exitosamente!', 'data' => $existingRol]);
                } else {
                    return response()->json(['success' => false, 'error' => 'Ya existe un rol con el mismo nombre']);
                }
            }

            $rol = UserRole::create([
                'name' => $nombreRol,
                'descripcion' => $descripcion,
                'user_id' => auth()->user()->id
            ]);

            $permisos = Permission::where('name', 'NOT LIKE', 'admin_%')->get();

            $rol->syncPermissions($permisos);

            return response()->json(['success' => true, 'message' => '¡Rol registrado exitosamente!', 'data' => $rol]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo guardar: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        try {
            $rol = UserRole::withTrashed()->where('id', $id)->first();

            if (!$rol) {
                return $this->sendResponse(false, 'El rol no existe');
            }

            $nombreRol = $request->input('name');
            $descripcion = $request->input('descripcion');

            $existingRol = UserRole::onlyTrashed()->where('name', $nombreRol)->first();

            if ($existingRol) {
                $existingRol->restore();
                $rol->forceDelete();
                $existingRol->update([
                    'name' => $nombreRol,
                    'descripcion' => $descripcion,
                    'user_modified_id' => auth()->user()->id,
                ]);

                return $this->sendResponse(true, '¡Rol actualizado con éxito!', $existingRol);
            }

            $rol->name = $nombreRol;
            $rol->descripcion = $descripcion;
            $rol->user_modified_id = auth()->user()->id;

            $rol->save();

            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('optimize:clear');

            return $this->sendResponse(true, '¡Rol actualizado con éxito!', $rol);
        } catch (\Exception $e) {
            return $this->sendResponse(false, '¡Error en la actualización!: ' . $e->getMessage());
        }
    }
    private function sendResponse($success, $message, $data = null)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $rol = UserRole::find($id);

        if (!$rol) {
            return response()->json([
                'success' => false,
                'error' => '¡Rol no encontrado!'
            ]);
        }

        try {
            if ($rol->id === 1) {
                return response()->json(['success' => false, 'error' => 'No eliminar rol administrador']);
            }

            $rol->nombre_tabla = 'Roles';
            $rol->user_deleted_id = auth()->user()->id;
            $rol->save();

            $rol->delete();

            return response()->json(['success' => true, 'message' => '¡Rol eliminado exitosamente!']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Error al eliminar el rol']);
        }
    }
}
