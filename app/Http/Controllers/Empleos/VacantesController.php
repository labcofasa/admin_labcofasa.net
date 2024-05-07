<?php

namespace App\Http\Controllers\Empleos;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Empleos\Vacante;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class VacantesController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());
        $vacantes = Vacante::with('pais', 'departamento', 'municipio', 'candidatos')->get();

        $nombreUsuario = $usuario->name;

        $vacantes->transform(function ($vacante) {
            $vacante->fecha_vencimiento = Carbon::parse($vacante->fecha_vencimiento)->format('d-m-Y');
            return $vacante;
        });

        return view('empleos.vacantes', compact('usuario', 'nombreUsuario', 'vacantes'));
    }

    public function obtenerVacantes()
    {
        $vacantes = Vacante::with('pais', 'departamento', 'municipio', 'candidatos')->get();

        $vacantes->transform(function ($vacante) {
            $vacante->fecha_vencimiento = Carbon::parse($vacante->fecha_vencimiento)->format('d-m-Y');
            $vacante->imagen = 'https://app.labcofasa.net/images/empleos/imagenes/' . $vacante->id . '/' . $vacante->imagen;

            return $vacante;
        });

        return response()->json($vacantes);
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
            'requisitos' => 'required|string',
            'beneficios' => 'required|string',
            'fecha_vencimiento' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg',
            'id_empresa' => 'nullable|exists:empresas,id',
            'id_tipo_contratacion' => 'nullable|exists:tipo_contratacion,id',
            'id_modalidad' => 'nullable|exists:modalidades,id',
            'id_pais' => 'nullable|exists:paises,id',
            'id_departamento' => 'nullable|exists:departamentos,id',
            'id_municipio' => 'nullable|exists:municipios,id',
        ]);

        try {
            $vacante = new Vacante();

            $vacante->nombre = $request->input('nombre');
            $vacante->descripcion = $request->input('descripcion');
            $vacante->requisitos = $request->input('requisitos');
            $vacante->beneficios = $request->input('beneficios');
            $vacante->fecha_vencimiento = $request->input('fecha_vencimiento');
            $vacante->id_empresa = $request->input('id_empresa');
            $vacante->id_tipo_contratacion = $request->input('id_tipo_contratacion');
            $vacante->id_modalidad = $request->input('id_modalidad');
            $vacante->id_pais = $request->input('id_pais');
            $vacante->id_departamento = $request->input('id_departamento');
            $vacante->id_municipio = $request->input('id_municipio');
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

            return redirect()->route('pag.vacantes')->with('success', 'Vacante registrada');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear la vacante');
        }
    }

    public function edit($id)
    {
        $usuario = User::with('perfil')->find(auth()->id());
        $vacante = Vacante::with('empresa', 'tipoContratacion', 'modalidad', 'pais', 'departamento', 'municipio')->find($id);

        return view('empleos.editar-vacante', compact('usuario', 'vacante'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'requisitos' => 'required|string',
            'beneficios' => 'required|string',
            'fecha_vencimiento' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg',
            'id_empresa' => 'nullable|exists:empresas,id',
            'id_tipo_contratacion' => 'nullable|exists:tipo_contratacion,id',
            'id_modalidad' => 'nullable|exists:modalidades,id',
        ]);

        try {
            $vacante = Vacante::findOrFail($id);

            $vacante->nombre = $request->input('nombre');
            $vacante->descripcion = $request->input('descripcion');
            $vacante->requisitos = $request->input('requisitos');
            $vacante->beneficios = $request->input('beneficios');
            $vacante->fecha_vencimiento = $request->input('fecha_vencimiento');
            $vacante->id_empresa = $request->input('id_empresa');
            $vacante->id_tipo_contratacion = $request->input('id_tipo_contratacion');
            $vacante->id_modalidad = $request->input('id_modalidad');
            $vacante->fecha_modificacion = now();

            if ($request->hasFile('imagen')) {
                if ($vacante->imagen) {
                    $rutaImagenAnterior = public_path("images/empleos/imagenes/{$id}/{$vacante->imagen}");
                    if (file_exists($rutaImagenAnterior)) {
                        unlink($rutaImagenAnterior);
                    }
                }

                $rutaCarpetaImagen = public_path("images/empleos/imagenes/{$id}");
                if (!file_exists($rutaCarpetaImagen)) {
                    mkdir($rutaCarpetaImagen, 0777, true);
                }

                $imagen = $request->file('imagen');
                $nombreImagen = $imagen->getClientOriginalName();
                $imagen->move($rutaCarpetaImagen, $nombreImagen);
                $vacante->imagen = $nombreImagen;
            }

            $vacante->save();

            return redirect()->route('pag.vacantes')->with('success', 'Vacante actualizada');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Hubo un error al actualizar la vacante');
        }
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

            return redirect()->route('pag.vacantes')->with('success', 'Vacante eliminada');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Hubo un error al eliminar la vacante');
        }
    }
}
