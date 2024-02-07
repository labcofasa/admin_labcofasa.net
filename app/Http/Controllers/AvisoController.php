<?php

namespace App\Http\Controllers;

use App\Models\Aviso;
use Illuminate\Http\Request;
use App\Models\User;

class AvisoController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('avisos', compact('usuario'));
    }

    public function tablaAvisos(Request $request)
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

        $query = Aviso::select('avisos.*', 'users.name as user_name', 'modified_users.name as user_modified_name')
            ->leftJoin('users', 'avisos.user_id', '=', 'users.id')
            ->leftJoin('users as modified_users', 'avisos.user_modified_id', '=', 'modified_users.id');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('avisos.nombre', 'like', '%' . $search . '%')
                    ->orWhere('avisos.created_at', 'like', '%' . $search . '%')
                    ->orWhere('users.name', 'like', "%$search%")
                    ->orWhere('avisos.updated_at', 'like', '%' . $search . '%')
                    ->orWhere('modified_users.name', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'nombre', 'imagen', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $avisos = $query->get();

        $data = [];
        $contador = $start + 1;
        foreach ($avisos as $aviso) {
            $data[] = [
                'id' => $aviso->id,
                'contador' => $contador++,
                'nombre' => $aviso->nombre,
                'imagen' => $aviso->imagen,
                'created_at' => $aviso->created_at->format('Y-m-d H:i:s'),
                'user_name' => $aviso->user_name,
                'updated_at' => $aviso->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $aviso->user_modified_name,
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
            "nombre" => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        try {
            $nombreAviso = $request->input('nombre');

            $aviso = new Aviso();
            $aviso->nombre = $nombreAviso;
            $aviso->user_id = auth()->user()->id;

            $aviso->save();

            $avisoId = $aviso->id;

            $rutaCarpetaImagen = public_path("images/avisos/imagen/{$avisoId}");

            if (!file_exists($rutaCarpetaImagen)) {
                mkdir($rutaCarpetaImagen, 0777, true);
            }

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = $imagen->getClientOriginalName();
                $imagen->move($rutaCarpetaImagen, $nombreImagen);

                $urlBase = url('/');
                $ubicacionImagen = "{$urlBase}/images/avisos/imagen/{$avisoId}/{$nombreImagen}";

                $aviso->imagen = $nombreImagen;
                $aviso->ubicacion = $ubicacionImagen;
            }

            $aviso->save();

            return response()->json(['success' => true, 'message' => '¡Publicidad registrada con éxito!', 'data' => $aviso]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => '¡Guardado fallido!: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "nombre" => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        try {
            $aviso = Aviso::findOrFail($id);

            $nombreAviso = $request->input('nombre');
            $aviso->nombre = $nombreAviso;
            $aviso->user_modified_id = auth()->user()->id;

            $aviso->save();

            $avisoId = $aviso->id;

            $rutaCarpetaImagen = public_path("images/avisos/imagen/{$avisoId}");

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $rutaCarpetaImagen = public_path("images/avisos/imagen/{$aviso->id}");

                if ($aviso->imagen && file_exists($rutaCarpetaImagen . '/' . $aviso->imagen)) {
                    unlink($rutaCarpetaImagen . '/' . $aviso->imagen);
                }

                $imagen->move($rutaCarpetaImagen, $imagen->getClientOriginalName());
                $aviso->imagen = $imagen->getClientOriginalName();
            }

            $aviso->save();

            return response()->json(['success' => true, 'message' => '¡Publicidad actualizada exitosamente!', 'data' => $aviso]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al actualizar la publicidad: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $aviso = Aviso::find($id);

        if (!$aviso) {
            return response()->json([
                'success' => false,
                'error' => '¡Publicidad no encontrada!'
            ]);
        }

        try {
            $aviso->nombre_tabla = 'Avisos';
            $aviso->user_deleted_id = auth()->user()->id;
            $aviso->save();

            $aviso->delete();

            return response()->json(['success' => true, 'message' => '¡Publicidad eliminada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar la publicidad']);
        }
    }

    public function obtenerAvisos()
    {
        $avisos = Aviso::all();

        return response()->json($avisos)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }
}
