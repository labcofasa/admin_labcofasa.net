<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\RedSocial;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmpresaController extends Controller
{
    public function index()
    {
        return view('empresas');
    }
    public function obtenerEmpresas()
    {
        $empresas = Empresa::pluck('nombre', 'id');
        return response()->json($empresas);
    }

    public function tablaEmpresas(Request $request)
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

        $query = Empresa::with('redesSociales')
            ->select('empresas.*', 'municipios.nombre as municipio_nombre', 'departamentos.nombre as departamento_nombre', 'paises.nombre as pais_nombre', 'clasificaciones.nombre as clasificacion_nombre', 'entidades.nombre as entidad_nombre', 'giros.nombre as giro_nombre', 'users.name as user_name', 'modified_users.name as user_modified_name')
            ->leftJoin('users', 'empresas.user_id', '=', 'users.id')
            ->leftJoin('users as modified_users', 'empresas.user_modified_id', '=', 'modified_users.id')
            ->leftJoin('giros', 'empresas.giro_id', '=', 'giros.id')
            ->leftJoin('entidades', 'empresas.entidad_id', '=', 'entidades.id')
            ->leftJoin('clasificaciones', 'empresas.clasificacion_id', '=', 'clasificaciones.id')
            ->leftJoin('paises', 'empresas.pais_id', '=', 'paises.id')
            ->leftJoin('departamentos', 'empresas.departamento_id', '=', 'departamentos.id')
            ->leftJoin('municipios', 'empresas.municipio_id', '=', 'municipios.id');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('empresas.nombre', 'like', "%$search%")
                    ->orWhere('empresas.direccion', 'like', "%$search%")
                    ->orWhere('empresas.telefono', 'like', "%$search%")
                    ->orWhere('empresas.email', 'like', "%$search%")
                    ->orWhere('empresas.web', 'like', "%$search%")
                    ->orWhere('empresas.mision', 'like', "%$search%")
                    ->orWhere('empresas.vision', 'like', "%$search%")
                    ->orWhere('empresas.calidad', 'like', "%$search%")
                    ->orWhere('empresas.fundacion', 'like', "%$search%")
                    ->orWhere('empresas.registro_nit', 'like', "%$search%")
                    ->orWhere('empresas.registro_iva', 'like', "%$search%")
                    ->orWhere('empresas.nombre_dnm', 'like', "%$search%")
                    ->orWhere('empresas.registro_dnm', 'like', "%$search%")
                    ->orWhere('giros.nombre', 'like', "%$search%")
                    ->orWhere('entidades.nombre', 'like', "%$search%")
                    ->orWhere('clasificaciones.nombre', 'like', "%$search%")
                    ->orWhere('paises.nombre', 'like', "%$search%")
                    ->orWhere('departamentos.nombre', 'like', "%$search%")
                    ->orWhere('municipios.nombre', 'like', "%$search%")
                    ->orWhere('empresas.created_at', 'like', "%$search%")
                    ->orWhere('users.name', 'like', "%$search%")
                    ->orWhere('empresas.updated_at', 'like', "%$search%")
                    ->orWhere('modified_users.name', 'like', "%$search%");
            });
        }

        $columnNames = [
            'id',
            'nombre',
            'direccion',
            'telefono',
            'email',
            'web',
            'mision',
            'vision',
            'calidad',
            'fundacion',
            'registro_nit',
            'registro_iva',
            'nombre_dnm',
            'registro_dnm',
            'imagen',
            'giro_nombre',
            'entidad_nombre',
            'clasificacion_nombre',
            'pais_nombre',
            'departamento_nombre',
            'municipio_nombre',
            'created_at',
            'user_name',
            'updated_at',
            'user_modified_name'
        ];

        $orderColumn = $columnNames[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDirection);

        $filteredQuery = clone $query;

        $totalRegistros = $query->count();

        if ($length != -1) {
            $query->skip($start)->take($length);
        }

        $empresas = $query->get();

        function formatNIT($nit)
        {
            $nit = str_replace(['-', ' '], '', $nit);

            return substr($nit, 0, 4) . '-' . substr($nit, 4, 6) . '-' . substr($nit, 10, 3) . '-' . substr($nit, 13, 2);
        }

        $data = [];
        $contador = $start + 1;
        foreach ($empresas as $empresa) {
            $redesSocialesData = $empresa->redesSociales->map(function ($redSocial) {
                return [
                    'id' => $redSocial->id,
                    'nombre' => $redSocial->nombre,
                    'enlace' => $redSocial->enlace,
                ];
            });

            $data[] = [
                'id' => $empresa->id,
                'contador' => $contador++,
                'nombre' => $empresa->nombre,
                'direccion' => $empresa->direccion,
                'telefono' => $empresa->telefono,
                'email' => $empresa->email,
                'web' => $empresa->web,
                'mision' => $empresa->mision,
                'vision' => $empresa->vision,
                'calidad' => $empresa->calidad,
                'fundacion' => $empresa->fundacion,
                'registro_nit' => formatNIT($empresa->registro_nit),
                'registro_iva' => $empresa->registro_iva,
                'nombre_dnm' => $empresa->nombre_dnm,
                'registro_dnm' => $empresa->registro_dnm,
                'imagen' => $empresa->imagen,
                'giro_id' => $empresa->giro_id,
                'giro_nombre' => $empresa->giro_nombre,
                'entidad_id' => $empresa->entidad_id,
                'entidad_nombre' => $empresa->entidad_nombre,
                'clasificacion_id' => $empresa->clasificacion_id,
                'clasificacion_nombre' => $empresa->clasificacion_nombre,
                'pais_id' => $empresa->pais_id,
                'pais_nombre' => $empresa->pais_nombre,
                'departamento_id' => $empresa->departamento_id,
                'departamento_nombre' => $empresa->departamento_nombre,
                'municipio_id' => $empresa->municipio_id,
                'municipio_nombre' => $empresa->municipio_nombre,
                'created_at' => $empresa->created_at->format('Y-m-d H:i:s'),
                'user_name' => $empresa->user_name,
                'updated_at' => $empresa->updated_at->format('Y-m-d H:i:s'),
                'user_modified_name' => $empresa->user_modified_name,
                'redes_sociales' => $redesSocialesData,
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
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'telefono' => [
                'nullable',
                'regex:/^(\+\d{1,3}[\s\-]?)?(\d{1,4}[\s\-]?){2}\d{4}$/',
                'max:15',
            ],
            'email' => 'nullable|email',
            'web' => 'nullable|url',
            'fundacion' => 'nullable|date_format:Y-m-d',
            'mision' => 'nullable|string',
            'vision' => 'nullable|string',
            'calidad' => 'nullable|string',
            'registro_nit' => 'nullable|string',
            'registro_iva' => 'nullable|string',
            'nombre_dnm' => 'nullable|string',
            'registro_dnm' => 'nullable|string',
            'giro_id' => 'required|exists:giros,id',
            'entidad_id' => 'required|exists:entidades,id',
            'clasificacion_id' => 'required|exists:clasificaciones,id',
            'pais_id' => 'required|exists:paises,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'social.*' => 'nullable|string',
            'enlace.*' => 'nullable|url',
        ]);

        try {
            $nombreEmpresa = $request->input('nombre');
            $direccionEmpresa = $request->input('direccion');
            $giroId = $request->input('giro_id');
            $entidadId = $request->input('entidad_id');
            $clasificacionId = $request->input('clasificacion_id');
            $paisId = $request->input('pais_id');
            $departamentoId = $request->input('departamento_id');
            $municipioId = $request->input('municipio_id');
            $telefonoEmpresa = $request->input('telefono');
            $emailEmpresa = $request->input('email');
            $webEmpresa = $request->input('web');
            $fundacionEmpresa = $request->input('fundacion');
            $registroNitEmpresa = $request->input('registro_nit');
            $registroIvaEmpresa = $request->input('registro_iva');
            $nombreDnmEmpresa = $request->input('nombre_dnm');
            $registroDnmEmpresa = $request->input('registro_dnm');
            $misionEmpresa = $request->input('mision');
            $visionEmpresa = $request->input('vision');
            $calidadEmpresa = $request->input('calidad');

            $empresa = new Empresa();
            $empresa->nombre = $nombreEmpresa;
            $empresa->direccion = $direccionEmpresa;
            $empresa->telefono = $telefonoEmpresa;
            $empresa->email = $emailEmpresa;
            $empresa->web = $webEmpresa;
            $empresa->mision = $misionEmpresa;
            $empresa->vision = $visionEmpresa;
            $empresa->calidad = $calidadEmpresa;
            $empresa->fundacion = $fundacionEmpresa;
            $empresa->registro_nit = $registroNitEmpresa;
            $empresa->registro_iva = $registroIvaEmpresa;
            $empresa->nombre_dnm = $nombreDnmEmpresa;
            $empresa->registro_dnm = $registroDnmEmpresa;
            $empresa->user_id = auth()->user()->id;
            $empresa->giro_id = $giroId;
            $empresa->entidad_id = $entidadId;
            $empresa->clasificacion_id = $clasificacionId;
            $empresa->pais_id = $paisId;
            $empresa->departamento_id = $departamentoId;
            $empresa->municipio_id = $municipioId;

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $empresa->imagen = $imagen->getClientOriginalName();
            } else {
                $empresa->imagen = null;
            }

            $empresa->save();

            $imagen->move(public_path('images/empresas/' . $empresa->id), $imagen->getClientOriginalName());

            $redesSociales = [];
            foreach ($request->input('social', []) as $key => $nombreRedSocial) {
                $enlaceRedSocial = $request->input('enlace.' . $key);

                if ($nombreRedSocial !== null && $enlaceRedSocial !== null) {
                    $redSocial = new RedSocial();
                    $redSocial->nombre = $nombreRedSocial;
                    $redSocial->enlace = $enlaceRedSocial;
                    $redSocial->user_id = auth()->user()->id;
                    $redesSociales[] = $redSocial;
                }
            }

            $empresa->redesSociales()->saveMany($redesSociales);


            return response()->json(['success' => true, 'message' => 'Empresa registrada con éxito!', 'data' => $empresa]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => '¡Guardado fallido!: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nombre' => 'required|string',
                'direccion' => 'required|string',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
                'telefono' => [
                    'nullable',
                    'regex:/^(\+\d{1,3}[\s\-]?)?(\d{1,4}[\s\-]?){2}\d{4}$/',
                    'max:15',
                ],
                'email' => 'nullable|email',
                'web' => 'nullable|url',
                'fundacion' => 'nullable|date_format:Y-m-d',
                'mision' => 'nullable|string',
                'vision' => 'nullable|string',
                'calidad' => 'nullable|string',
                'registro_nit' => 'nullable|string',
                'registro_iva' => 'nullable|string',
                'nombre_dnm' => 'nullable|string',
                'registro_dnm' => 'nullable|string',
                'giro_id' => 'required|exists:giros,id',
                'entidad_id' => 'required|exists:entidades,id',
                'clasificacion_id' => 'required|exists:clasificaciones,id',
                'pais_id' => 'required|exists:paises,id',
                'departamento_id' => 'required|exists:departamentos,id',
                'municipio_id' => 'required|exists:municipios,id',
                'social.*' => 'nullable|string',
                'enlace.*' => 'nullable|url',
            ]);

            $nombreEmpresa = $request->input('nombre');
            $direccionEmpresa = $request->input('direccion');
            $giroId = $request->input('giro_id');
            $entidadId = $request->input('entidad_id');
            $clasificacionId = $request->input('clasificacion_id');
            $paisId = $request->input('pais_id');
            $departamentoId = $request->input('departamento_id');
            $municipioId = $request->input('municipio_id');
            $telefonoEmpresa = $request->input('telefono');
            $emailEmpresa = $request->input('email');
            $webEmpresa = $request->input('web');
            $misionEmpresa = $request->input('mision');
            $visionEmpresa = $request->input('vision');
            $calidadEmpresa = $request->input('calidad');
            $fundacionEmpresa = $request->input('fundacion');
            $registroNitEmpresa = $request->input('registro_nit');
            $registroIvaEmpresa = $request->input('registro_iva');
            $nombreDnmEmpresa = $request->input('nombre_dnm');
            $registroDnmEmpresa = $request->input('registro_dnm');

            $empresa = Empresa::findOrFail($id);
            $empresa->nombre = $nombreEmpresa;
            $empresa->direccion = $direccionEmpresa;
            $empresa->telefono = $telefonoEmpresa;
            $empresa->email = $emailEmpresa;
            $empresa->web = $webEmpresa;
            $empresa->mision = $misionEmpresa;
            $empresa->vision = $visionEmpresa;
            $empresa->calidad = $calidadEmpresa;
            $empresa->fundacion = $fundacionEmpresa;
            $empresa->registro_nit = $registroNitEmpresa;
            $empresa->registro_iva = $registroIvaEmpresa;
            $empresa->nombre_dnm = $nombreDnmEmpresa;
            $empresa->registro_dnm = $registroDnmEmpresa;
            $empresa->giro_id = $giroId;
            $empresa->entidad_id = $entidadId;
            $empresa->clasificacion_id = $clasificacionId;
            $empresa->pais_id = $paisId;
            $empresa->departamento_id = $departamentoId;
            $empresa->municipio_id = $municipioId;
            $empresa->user_modified_id = auth()->user()->id;

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = $empresa->id . '_' . time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('images/empresas'), $nombreImagen);

                if ($empresa->imagen) {
                    unlink(public_path('images/empresas/' . $empresa->imagen));
                }

                $empresa->imagen = $nombreImagen;
            }

            $empresa->save();

            $redesSociales = $empresa->redesSociales;

            $sociales = $request->input('social') ?? [];
            $enlaces = $request->input('enlace') ?? [];

            foreach ($sociales as $key => $nombreRedSocial) {
                $enlaceRedSocial = $enlaces[$key] ?? null;

                if ($key < count($redesSociales)) {
                    $redSocial = $redesSociales[$key];
                    $redSocial->nombre = $nombreRedSocial;
                    $redSocial->enlace = $enlaceRedSocial;
                    $redSocial->user_modified_id = auth()->user()->id;
                    $redSocial->save();
                } else {
                    $redSocial = new RedSocial();
                    $redSocial->nombre = $nombreRedSocial;
                    $redSocial->enlace = $enlaceRedSocial;
                    $redSocial->user_id = auth()->user()->id;
                    $empresa->redesSociales()->save($redSocial);
                }
            }

            return response()->json(['success' => true, 'message' => 'Empresa actualizada con éxito!', 'data' => $empresa]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => '¡Actualización fallida!: ' . $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json([
                'success' => false,
                'error' => 'Empresa no encontrada!'
            ]);
        }

        try {
            $empresa->nombre_tabla = 'Empresas';
            $empresa->user_deleted_id = auth()->user()->id;
            $empresa->save();

            $empresa->delete();

            return response()->json(['success' => true, 'message' => '¡Empresa eliminada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar la empresa']);
        }
    }

    public function mostrarLogo($id)
    {
        $empresa = Empresa::find($id);

        return view('logo', compact('empresa'));
    }
}
