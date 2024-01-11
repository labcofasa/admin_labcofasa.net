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

        $query = Aplicacion::select('aplicaciones.*', 'users.name as user_name', 'modified_users.name as user_modified_name')
            ->leftJoin('users', 'aplicaciones.user_id', '=', 'users.id')
            ->leftJoin('users as modified_users', 'aplicaciones.user_modified_id', '=', 'modified_users.id');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('aplicaciones.nombre_aplicacion', 'like', '%' . $search . '%')
                    ->orWhere('aplicaciones.enlace_aplicacion', 'like', '%' . $search . '%')
                    ->orWhere('aplicaciones.created_at', 'like', '%' . $search . '%')
                    ->orWhere('users.name', 'like', "%$search%")
                    ->orWhere('aplicaciones.updated_at', 'like', '%' . $search . '%')
                    ->orWhere('modified_users.name', 'like', "%$search%");
            });
        }

        $columnNames = ['id', 'nombre_aplicacion', 'imagen_aplicacion', 'enlace_aplicacion', 'created_at', 'user_name', 'updated_at', 'user_modified_name'];
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
            $data[] = [
                'id' => $aplicacion->id,
                'contador' => $contador++,
                'nombre_aplicacion' => $aplicacion->nombre_aplicacion,
                'imagen_aplicacion' => $aplicacion->imagen_aplicacion,
                'enlace_aplicacion' => $aplicacion->enlace_aplicacion,
                'created_at' => $aplicacion->created_at->format('Y-m-d H:i:s'),
                'user_name' => $aplicacion->user_name,
                'updated_at' => $aplicacion->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $aplicacion->user_modified_name,
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
}
