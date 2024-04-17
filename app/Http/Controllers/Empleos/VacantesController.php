<?php

namespace App\Http\Controllers\Empleos;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Empleos\Vacante;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class VacantesController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());
        $vacantes = Vacante::all();

        return view('empleos.vacantes', compact('usuario', 'vacantes'));
    }

    public function create()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('empleos.crear-vacante', compact('usuario'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_vencimiento' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        try {
            $vacante = new Vacante();

            $vacante->nombre = $request->input('nombre');
            $vacante->descripcion = $request->input('descripcion');
            $vacante->fecha_vencimiento = $request->input('fecha_vencimiento');
            $vacante->fecha_creacion = now();
            $vacante->fecha_modificacion = now();

            $vacante->save();

            $vacanteId = $vacante->id;

            $rutaCarpetaImagen = public_path("images/empleos/imagenes/{$vacanteId}");

            if (!file_exists($rutaCarpetaImagen)) {
                mkdir($rutaCarpetaImagen, 0777, true);
            }

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $imagen->move($rutaCarpetaImagen, $imagen->getClientOriginalName());
                $vacante->imagen = $imagen->getClientOriginalName();
            }

            $vacante->save();

            return redirect()->route('pag.vacantes')->with('success', 'Vacante regitrada exitosamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear la vacante');
        }
    }

    public function edit($id)
    {
        $usuario = User::with('perfil')->find(auth()->id());
        $vacante = Vacante::find($id);

        return view('empleos.editar-vacante', compact('usuario', 'vacante'));
    }

    public function destroy($id)
    {
        $vacante = Vacante::find($id);

        try {
            $rutaCarpeta = public_path("images/empleos/imagenes/{$vacante->id}");

            if (File::exists($rutaCarpeta)) {
                File::deleteDirectory($rutaCarpeta);
            }

            $vacante->delete();

            return redirect()->route('pag.vacantes')->with('success', 'Vacante eliminada exitosamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Hubo un error al eliminar la vacante');
        }
    }
}
