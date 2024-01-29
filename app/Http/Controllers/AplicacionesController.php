<?php

namespace App\Http\Controllers;

use App\Models\Aplicacion;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AplicacionesController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('aplicaciones', compact('usuario'));
    }

    public function tablaAplicaciones(Request $request)
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

        $query = Aplicacion::with(['roles' => function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        }])
            ->select('aplicaciones.*', 'usuarios.nombre as user_name', 'modified_users.nombre as user_modified_name', 'empresas.nombre as nombre_empresa')
            ->leftJoin('usuarios', 'aplicaciones.user_id', '=', 'usuarios.id')
            ->leftJoin('usuarios as modified_users', 'aplicaciones.user_modified_id', '=', 'modified_users.id')
            ->leftJoin('aplicacion_role', 'aplicaciones.id', '=', 'aplicacion_role.aplicacion_id')
            ->leftJoin('roles', 'aplicacion_role.role_id', '=', 'roles.id')
            ->leftJoin('empresas', 'empresas.id', '=', 'aplicaciones.empresa_id')
            ->distinct();


        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('aplicaciones.nombre_aplicacion', 'like', '%' . $search . '%')
                    ->orWhere('aplicaciones.enlace_aplicacion', 'like', '%' . $search . '%')
                    ->orWhere('aplicaciones.created_at', 'like', '%' . $search . '%')
                    ->orWhere('usuarios.nombre', 'like', "%$search%")
                    ->orWhere('aplicaciones.updated_at', 'like', '%' . $search . '%')
                    ->orWhere('modified_users.nombre', 'like', "%$search%")
                    ->orWhere('empresas.nombre', 'like', '%' . $search . '%')
                    ->orWhere('roles.name', 'like', "%$search%");
            });
        }


        $columnNames = ['id', 'nombre_aplicacion', 'imagen_aplicacion', 'enlace_aplicacion', 'nombre_empresa', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $aplicaciones = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($aplicaciones as $aplicacion) {
            $rolesData = $aplicacion->roles->map(function ($rol) {
                return [
                    'id' => $rol->id,
                    'name' => $rol->name,
                ];
            });

            $data[] = [
                'id' => $aplicacion->id,
                'contador' => $contador++,
                'nombre_aplicacion' => $aplicacion->nombre_aplicacion,
                'imagen_aplicacion' => $aplicacion->imagen_aplicacion,
                'enlace_aplicacion' => $aplicacion->enlace_aplicacion,
                'id_empresa' => $aplicacion->empresa_id ?? null,
                'nombre_empresa' => $aplicacion->empresa->nombre ?? null,
                'created_at' => $aplicacion->created_at->format('Y-m-d H:i:s'),
                'user_name' => $aplicacion->user_name,
                'updated_at' => $aplicacion->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $aplicacion->user_modified_name,
                'roles' => $rolesData,
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
            "nombre_aplicacion" => 'required|string',
            "enlace_aplicacion" => 'required|string',
            'imagen_aplicacion' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'empresa_id' => 'required|exists:empresas,id',
            'roles' => 'required|array',
        ]);

        try {
            $nombreAplicacion = $request->input('nombre_aplicacion');
            $enlaceAplicacion = $request->input('enlace_aplicacion');
            $nombreEmpresa = $request->input('empresa_id');

            $aplicacion = new Aplicacion();
            $aplicacion->nombre_aplicacion = $nombreAplicacion;
            $aplicacion->enlace_aplicacion = $enlaceAplicacion;
            $aplicacion->empresa_id = $nombreEmpresa;

            $aplicacion->user_id = auth()->user()->id;

            $aplicacion->save();

            $aplicacionId = $aplicacion->id;

            $rutaCarpetaImagen = public_path("images/aplicaciones/imagen/{$aplicacionId}");

            if (!file_exists($rutaCarpetaImagen)) {
                mkdir($rutaCarpetaImagen, 0777, true);
            }

            if ($request->hasFile('imagen_aplicacion')) {
                $imagen_aplicacion = $request->file('imagen_aplicacion');
                $imagen_aplicacion->move($rutaCarpetaImagen, $imagen_aplicacion->getClientOriginalName());
                $aplicacion->imagen_aplicacion = $imagen_aplicacion->getClientOriginalName();
            }

            $aplicacion->save();

            $roles = $request->input('roles');
            $aplicacion->roles()->sync($roles);


            return response()->json(['success' => true, 'message' => '¡Aplicación registrada con éxito!', 'data' => $aplicacion]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => '¡Guardado fallido!: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "nombre_aplicacion" => 'required|string',
            "enlace_aplicacion" => 'required|string',
            'imagen_aplicacion' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'empresa_id' => 'required|exists:empresas,id',
            'roles' => 'required|array',
        ]);

        try {
            $aplicacion = Aplicacion::findOrFail($id);

            $nombreAplicacion = $request->input('nombre_aplicacion');
            $enlaceAplicacion = $request->input('enlace_aplicacion');
            $nombreEmpresa = $request->input('empresa_id');

            $aplicacion->nombre_aplicacion = $nombreAplicacion;
            $aplicacion->enlace_aplicacion = $enlaceAplicacion;
            $aplicacion->empresa_id = $nombreEmpresa;
            $aplicacion->user_modified_id = auth()->user()->id;

            $aplicacion->save();

            $aplicacionId = $aplicacion->id;

            $rutaCarpetaImagen = public_path("images/aplicaciones/imagen/{$aplicacionId}");

            if ($request->hasFile('imagen_aplicacion')) {
                $imagen_aplicacion = $request->file('imagen_aplicacion');
                $rutaCarpetaImagen = public_path("images/aplicaciones/imagen/{$aplicacion->id}");

                if ($aplicacion->imagen_aplicacion && file_exists($rutaCarpetaImagen . '/' . $aplicacion->imagen_aplicacion)) {
                    unlink($rutaCarpetaImagen . '/' . $aplicacion->imagen_aplicacion);
                }

                $imagen_aplicacion->move($rutaCarpetaImagen, $imagen_aplicacion->getClientOriginalName());
                $aplicacion->imagen_aplicacion = $imagen_aplicacion->getClientOriginalName();
            }

            $aplicacion->save();

            $roles = $request->input('roles');
            $aplicacion->roles()->sync($roles);

            return response()->json(['success' => true, 'message' => '¡Aplicación actualizada exitosamente!', 'data' => $aplicacion]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al actualizar la aplicación: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $aplicacion = Aplicacion::find($id);

        if (!$aplicacion) {
            return response()->json([
                'success' => false,
                'error' => '¡Aplicación no encontrada!'
            ]);
        }

        try {
            $aplicacion->nombre_tabla = 'Aplicaciones';
            $aplicacion->user_deleted_id = auth()->user()->id;
            $aplicacion->save();

            $aplicacion->delete();

            return response()->json(['success' => true, 'message' => '¡Aplicación eliminada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar la aplicación']);
        }
    }


    public function cargarRolesApps()
    {
        $rolesApps = Role::pluck('name', 'id');

        return response()->json($rolesApps);
    }
}
