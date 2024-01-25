<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use Illuminate\Http\Request;
use App\Models\User;

class PublicidadController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('publicidades', compact('usuario'));
    }

    public function tablaPublicidades(Request $request)
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

        $query = Publicidad::select('publicidades.*', 'users.name as user_name', 'modified_users.name as user_modified_name')
            ->leftJoin('users', 'publicidades.user_id', '=', 'users.id')
            ->leftJoin('users as modified_users', 'publicidades.user_modified_id', '=', 'modified_users.id');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('publicidades.nombre_publicidad', 'like', '%' . $search . '%')
                    ->orWhere('publicidades.created_at', 'like', '%' . $search . '%')
                    ->orWhere('users.name', 'like', "%$search%")
                    ->orWhere('publicidades.updated_at', 'like', '%' . $search . '%')
                    ->orWhere('modified_users.name', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'nombre_publicidad', 'imagen_publicidad', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $publicidades = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($publicidades as $publicidad) {
            $data[] = [
                'id' => $publicidad->id,
                'contador' => $contador++,
                'nombre_publicidad' => $publicidad->nombre_publicidad,
                'imagen_publicidad' => $publicidad->imagen_publicidad,
                'created_at' => $publicidad->created_at->format('Y-m-d H:i:s'),
                'user_name' => $publicidad->user_name,
                'updated_at' => $publicidad->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $publicidad->user_modified_name,
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
            "nombre_publicidad" => 'required|string',
            'imagen_publicidad' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        try {
            $nombrePublicidad = $request->input('nombre_publicidad');

            $publicidad = new Publicidad();
            $publicidad->nombre_publicidad = $nombrePublicidad;
            $publicidad->user_id = auth()->user()->id;

            $publicidad->save();

            $publicidadId = $publicidad->id;

            $rutaCarpetaImagen = public_path("images/publicidades/imagen/{$publicidadId}");

            if (!file_exists($rutaCarpetaImagen)) {
                mkdir($rutaCarpetaImagen, 0777, true);
            }

            if ($request->hasFile('imagen_publicidad')) {
                $imagen_publicidad = $request->file('imagen_publicidad');
                $nombreImagen = $imagen_publicidad->getClientOriginalName();
                $imagen_publicidad->move($rutaCarpetaImagen, $nombreImagen);

                $urlBase = url('/');
                $ubicacionImagen = "{$urlBase}/images/publicidades/imagen/{$publicidadId}/{$nombreImagen}";

                $publicidad->imagen_publicidad = $nombreImagen;
                $publicidad->ubicacion_imagen = $ubicacionImagen;
            }

            $publicidad->save();

            return response()->json(['success' => true, 'message' => '¡Publicidad registrada con éxito!', 'data' => $publicidad]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => '¡Guardado fallido!: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "nombre_publicidad" => 'required|string',
            'imagen_publicidad' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        try {
            $publicidad = Publicidad::findOrFail($id);

            $nombrepublicidad = $request->input('nombre_publicidad');
            $publicidad->nombre_publicidad = $nombrepublicidad;
            $publicidad->user_modified_id = auth()->user()->id;

            $publicidad->save();

            $publicidadId = $publicidad->id;

            $rutaCarpetaImagen = public_path("images/publicidades/imagen/{$publicidadId}");

            if ($request->hasFile('imagen_publicidad')) {
                $imagen_publicidad = $request->file('imagen_publicidad');
                $rutaCarpetaImagen = public_path("images/publicidades/imagen/{$publicidad->id}");

                if ($publicidad->imagen_publicidad && file_exists($rutaCarpetaImagen . '/' . $publicidad->imagen_publicidad)) {
                    unlink($rutaCarpetaImagen . '/' . $publicidad->imagen_publicidad);
                }

                $imagen_publicidad->move($rutaCarpetaImagen, $imagen_publicidad->getClientOriginalName());
                $publicidad->imagen_publicidad = $imagen_publicidad->getClientOriginalName();
            }

            $publicidad->save();

            return response()->json(['success' => true, 'message' => '¡Publicidad actualizada exitosamente!', 'data' => $publicidad]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al actualizar la Publicidad: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $publicidad = Publicidad::find($id);

        if (!$publicidad) {
            return response()->json([
                'success' => false,
                'error' => '¡Publicidad no encontrada!'
            ]);
        }

        try {
            $publicidad->nombre_tabla = 'Publicidades';
            $publicidad->user_deleted_id = auth()->user()->id;
            $publicidad->save();

            $publicidad->delete();

            return response()->json(['success' => true, 'message' => '¡Publicidad eliminada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar la Publicidad']);
        }
    }

    public function obtenerPublicidades(Request $request)
    {
        $publicidades = Publicidad::all();

        return response()->json($publicidades)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }
}
