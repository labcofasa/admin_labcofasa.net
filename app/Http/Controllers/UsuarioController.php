<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('usuarios', compact('usuario'));
    }
    public function tablaUsuarios(Request $request)
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

        $query = User::query()
            ->select(
                'users.*',
                'roles.name as rol',
                'perfiles.nombres',
                'perfiles.apellidos',
                'perfiles.telefono',
                'perfiles.imagen',
                'perfiles.direccion',
                'perfiles.empresa_id',
                'perfiles.pais_id',
                'perfiles.departamento_id',
                'perfiles.municipio_id',
                'paises.nombre as nombre_pais',
                'departamentos.nombre as nombre_departamento',
                'municipios.nombre as nombre_municipio',
                'empresas.nombre as nombre_empresa',
                'created_user.name as user_name',
                'modified_user.name as user_modified_name'
            )
            ->leftJoin('roles', 'users.id', '=', 'roles.id')
            ->leftJoin('perfiles', 'users.id', '=', 'perfiles.user_id')
            ->leftJoin('users as created_user', 'users.user_id', '=', 'created_user.id')
            ->leftJoin('users as modified_user', 'users.user_modified_id', '=', 'modified_user.id')
            ->leftJoin('empresas', 'empresas.id', '=', 'perfiles.empresa_id')
            ->leftJoin('paises', 'paises.id', '=', 'perfiles.pais_id')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'perfiles.departamento_id')
            ->leftJoin('municipios', 'municipios.id', '=', 'perfiles.municipio_id')
            ->orderBy('users.created_at', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%')
                    ->orWhere('roles.name', 'like', '%' . $search . '%')
                    ->orWhere('perfiles.nombres', 'like', '%' . $search . '%')
                    ->orWhere('perfiles.apellidos', 'like', '%' . $search . '%')
                    ->orWhere('perfiles.telefono', 'like', '%' . $search . '%')
                    ->orWhere('perfiles.direccion', 'like', '%' . $search . '%')
                    ->orWhere('paises.nombre', 'like', '%' . $search . '%')
                    ->orWhere('departamentos.nombre', 'like', '%' . $search . '%')
                    ->orWhere('municipios.nombre', 'like', '%' . $search . '%')
                    ->orWhere('empresas.nombre', 'like', '%' . $search . '%')
                    ->orWhere('users.created_at', 'like', "%$search%")
                    ->orWhere('users.updated_at', 'like', "%$search%");
            });
        }

        $columnNames = [
            'id',
            'name',
            'rol',
            'estado',
            'nombres',
            'apellidos',
            'telefono',
            'email',
            'nombre_empresa',
            'nombre_pais',
            'nombre_departamento',
            'nombre_municipio',
            'direccion',
            'imagen',
            'created_at',
            'user_name',
            'updated_at',
            'user_modified_name'
        ];

        $orderBy = $columnNames[$orderColumnIndex];

        if ($orderBy === 'rol') {
            $query->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->leftJoin('roles as roles_nombre', 'model_has_roles.role_id', '=', 'roles_nombre.id')
                ->orderBy('roles_nombre.name', $orderDirection);
        } else {
            $query->orderBy($orderBy, $orderDirection);
        }

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $users = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($users as $key => $usuario) {
            $roles = $usuario->roles->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                ];
            });

            $data[] = [
                'id' => $usuario->id,
                'contador' => $contador++,
                'name' => $usuario->name,
                'estado' => $usuario->estado,
                'nombres' => $usuario->perfil->nombres ?? null,
                'apellidos' => $usuario->perfil->apellidos ?? null,
                'telefono' => $usuario->perfil->telefono ?? null,
                'email' => $usuario->email,
                'imagen' => $usuario->perfil->imagen,
                'id_empresa' => $usuario->perfil->empresa_id ?? null,
                'nombre_empresa' => $usuario->perfil->empresa->nombre ?? null,
                'id_pais' => $usuario->perfil->pais_id ?? null,
                'nombre_pais' => $usuario->perfil->pais->nombre ?? null,
                'id_departamento' => $usuario->perfil->departamento_id ?? null,
                'nombre_departamento' => $usuario->perfil->departamento->nombre ?? null,
                'id_municipio' => $usuario->perfil->municipio_id ?? null,
                'nombre_municipio' => $usuario->perfil->municipio->nombre ?? null,
                'direccion' => $usuario->perfil->direccion ?? null,
                'roles' => $roles->toArray(),
                'created_at' => optional($usuario->created_at)->format('Y-m-d H:i:s'),
                'user_name' => $usuario->user_name,
                'updated_at' => optional($usuario->updated_at)->format('Y-m-d H:i:s'),
                'user_modified_name' => $usuario->user_modified_name,
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'nombres' => 'required|string',
            'apellidos' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'telefono' => [
                'nullable',
                'regex:/^(\+\d{1,3}[\s\-]?)?(\d{1,4}[\s\-]?){2}\d{4}$/',
                'max:15',
            ],
            'direccion' => 'nullable|string',
            'rol' => 'required|numeric',
            'empresa_id' => 'required|exists:empresas,id',
            'pais_id' => 'nullable|exists:paises,id',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'municipio_id' => 'nullable|exists:municipios,id',
        ]);

        try {
            $usuario = new User();
            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');
            $usuario->user_id = auth()->user()->id;

            $password = $request->input('password');

            if ($password) {
                $this->validate($request, [
                    'password' => [
                        'required',
                        'string',
                        'min:8',
                        'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}|:<>?~-])[A-Za-z\d!@#$%^&*()_+{}|:<>?~-]{8,}$/',
                    ],
                ], [
                    'password.regex' => 'La contraseña debe contener al menos una letra mayúscula y al menos un carácter especial.',
                ]);

                $usuario->password = bcrypt($password);
            }

            $usuario->save();

            $perfil = new Perfil();
            $perfil->nombres = $request->input('nombres');
            $perfil->apellidos = $request->input('apellidos');
            $perfil->telefono = $request->input('telefono');
            $perfil->direccion = $request->input('direccion');
            $perfil->empresa_id = $request->input('empresa_id');
            $perfil->pais_id = $request->input('pais_id');
            $perfil->departamento_id = $request->input('departamento_id');
            $perfil->municipio_id = $request->input('municipio_id');
            $perfil->user_id = $usuario->id;

            $perfil->save();

            $perfilId = $perfil->id;

            $rutaCarpetaImagen = public_path("images/usuarios/imagen/{$perfilId}");

            if (!file_exists($rutaCarpetaImagen)) {
                mkdir($rutaCarpetaImagen, 0777, true);
            }

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $imagen->move($rutaCarpetaImagen, $imagen->getClientOriginalName());
                $perfil->imagen = $imagen->getClientOriginalName();
            }

            $perfil->save();

            $rolId = $request->input('rol');
            $role = Role::findById($rolId);

            if ($role) {
                $usuario->assignRole($role);
            } else {
                return response()->json(['success' => false, 'error' => 'El rol especificado no existe.'], 422);
            }

            return response()->json(['success' => true, 'message' => '¡Usuario registrado exitosamente!', 'data' => $usuario]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al registrar el usuario: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'nombres' => 'required|string',
            'apellidos' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'telefono' => [
                'nullable',
                'regex:/^(\+\d{1,3}[\s\-]?)?(\d{1,4}[\s\-]?){2}\d{4}$/',
                'max:15',
            ],
            'direccion' => 'nullable|string',
            'rol' => 'required|numeric|exists:roles,id',
            'empresa_id' => 'required|exists:empresas,id',
            'pais_id' => 'nullable|exists:paises,id',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'municipio_id' => 'nullable|exists:municipios,id',
        ]);

        try {
            $usuario = User::findOrFail($id);

            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');
            $usuario->user_modified_id = auth()->user()->id;

            $nuevaClave = $request->input('password');
            if ($nuevaClave) {
                $this->validate($request, [
                    'password' => [
                        'nullable',
                        'string',
                        'min:8',
                        'confirmed',
                        'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}|:<>?~-])[A-Za-z\d!@#$%^&*()_+{}|:<>?~-]{8,}$/',
                    ],
                ], [
                    'password.regex' => 'La contraseña debe contener al menos una letra mayúscula y al menos un carácter especial.',
                ]);

                $usuario->password = bcrypt($nuevaClave);
            }

            $usuario->save();

            $perfil = Perfil::where('user_id', $usuario->id)->first();

            $perfil->nombres = $request->input('nombres');
            $perfil->apellidos = $request->input('apellidos');
            $perfil->telefono = $request->input('telefono');
            $perfil->direccion = $request->input('direccion');
            $perfil->empresa_id = $request->input('empresa_id');
            $perfil->pais_id = $request->input('pais_id');
            $perfil->departamento_id = $request->input('departamento_id');
            $perfil->municipio_id = $request->input('municipio_id');

            $perfil->save();

            $perfilId = $perfil->id;

            $rutaCarpetaImagen = public_path("images/usuarios/imagen/{$perfilId}");

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $rutaCarpetaImagen = public_path("images/usuarios/imagen/{$perfil->id}");

                if ($perfil->imagen && file_exists($rutaCarpetaImagen . '/' . $perfil->imagen)) {
                    unlink($rutaCarpetaImagen . '/' . $perfil->imagen);
                }

                $imagen->move($rutaCarpetaImagen, $imagen->getClientOriginalName());
                $perfil->imagen = $imagen->getClientOriginalName();
            }

            $perfil->save();

            $rolId = $request->input('rol');
            $role = Role::findById($rolId);

            if ($role) {
                $usuario->syncRoles($role);
            } else {
                return response()->json(['success' => false, 'error' => 'El rol especificado no existe.'], 422);
            }

            return response()->json(['success' => true, 'message' => '¡Usuario actualizado exitosamente!', 'data' => $usuario]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al actualizar el usuario: ' . $e->getMessage()]);
        }
    }
    public function cambiarEstadoUsuario(Request $request, $id)
    {
        try {
            $usuario = User::findOrFail($id);

            if ($usuario->id === 1) {
                return response()->json(['success' => false, 'error' => 'No se puede cambiar el estado del administrador.']);
            }

            if ($usuario->id === auth()->user()->id) {
                return response()->json(['success' => false, 'error' => 'No tienes autorización para cambiar tu propio estado.']);
            }

            $estado = $request->input('estado');

            $usuario->update([
                'estado' => (bool) $estado,
                'user_modified_id' => auth()->user()->id,
            ]);

            return response()->json(['success' => true, 'message' => 'Estado del usuario actualizado con éxito.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor.'], 500);
        }
    }
    public function destroy(Request $request, $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'error' => '¡Usuario no encontrado!'
            ]);
        }

        try {
            if ($usuario->id === 1) {
                return response()->json(['success' => false, 'error' => 'No se puede eliminar al usuario administrador.']);
            }

            if ($usuario->id === auth()->user()->id) {
                return response()->json(['success' => false, 'error' => 'No tienes autorización para eliminar tu propio usuario.']);
                auth()->logout();
            }

            $usuario->nombre_tabla = 'users';
            $usuario->user_deleted_id = auth()->user()->id;
            $usuario->save();

            $usuario->delete();

            return response()->json(['success' => true, 'message' => '¡Usuario eliminado con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar el usuario.']);
        }
    }
    public function obtenerEstadisticasUsuarios()
    {
        $usuariosUltimoMes = User::where('created_at', '>=', now()->subMonth())->count();
        $totalUsuarios = User::count();
        $totalRoles = Role::count();
        $totalPermisos = Permission::count();

        return response()->json([
            'usuariosUltimoMes' => $usuariosUltimoMes,
            'totalUsuarios' => $totalUsuarios,
            'totalRoles' => $totalRoles,
            'totalPermisos' => $totalPermisos,
        ]);
    }
}
