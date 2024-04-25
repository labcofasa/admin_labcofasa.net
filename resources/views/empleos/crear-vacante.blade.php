@extends('layouts.autenticado')

@section('titulo', 'Crear vacante')

@section('contenido')
    <div class="container-fluid content">
        <div class="encabezado">
            <a href="{{ route('pag.vacantes') }}" class="d-flex gap-3 text-decoration-none align-items-center">
                <svg class="text-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    color="#000000" fill="none">
                    <path d="M4 12L20 12" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M8.99996 17C8.99996 17 4.00001 13.3176 4 12C3.99999 10.6824 9 7 9 7" stroke="currentColor"
                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <h1>@yield('titulo')</h1>
            </a>
            <button id="enviarFormulario" class="btn btn-lg btn-success d-none d-xl-block accion" type="button">
                <div class="accion">
                    <svg class="icon-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24" color="#000000" fill="none">
                        <path
                            d="M12.5 22H9.5C6.20017 22 4.55025 22 3.52513 20.9209C2.5 19.8418 2.5 18.1051 2.5 14.6316V9.36842C2.5 5.89491 2.5 4.15816 3.52513 3.07908C4.55025 2 6.20017 2 9.5 2H12.5C15.7998 2 17.4497 2 18.4749 3.07908C19.5 4.15816 19.5 5.89491 19.5 9.36842V11"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18 15L18 22M21.5 18.5L14.5 18.5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                        <path
                            d="M7 2L7.0822 2.4932C7.28174 3.69044 7.38151 4.28906 7.80113 4.64453C8.22075 5 8.82762 5 10.0414 5H11.9586C13.1724 5 13.7793 5 14.1989 4.64453C14.6185 4.28906 14.7183 3.69044 14.9178 2.4932L15 2"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 16H11M7 11H15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                    <span>Publicar vacante</span>
                </div>
            </button>
        </div>
        <form id="frmVacante" action="{{ route('creando.vacante') }}" class="form needs-validation" novalidate
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row add-vacante">
                <div class="col-12 col-xl-4">
                    <h6 class="mb-3">Información principal</h6>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Título del puesto<span class="obligatorio">
                                *</span></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required
                            autocomplete="off">
                        <div class="invalid-feedback">
                            Por favor, ingrese el titúlo.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción del trabajo<span class="obligatorio">
                                *</span></label>
                        <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>
                        <div class="invalid-feedback">
                            Por favor, ingrese la descripción.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="requisitos" class="form-label">Requisitos de calificación<span class="obligatorio">
                                *</span></label>
                        <textarea class="form-control" name="requisitos" id="requisitos" required></textarea>
                        <div class="invalid-feedback">
                            Por favor, ingrese los requerimientos.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="beneficios" class="form-label">Beneficios<span class="obligatorio">
                                *</span></label>
                        <textarea class="form-control" name="beneficios" id="beneficios" required></textarea>
                        <div class="invalid-feedback">
                            Por favor, ingrese los beneficios.
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Imagen principal<span class="obligatorio">
                                *</span></div>
                        <label for="imagen" class="subir-imagen dropzone-area" id="dropzone">
                            <span>
                                <svg class="archivo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50"
                                    height="50" color="#000000" fill="none">
                                    <path
                                        d="M13 3.00231C12.5299 3 12.0307 3 11.5 3C7.02166 3 4.78249 3 3.39124 4.39124C2 5.78249 2 8.02166 2 12.5C2 16.9783 2 19.2175 3.39124 20.6088C4.78249 22 7.02166 22 11.5 22C15.9783 22 18.2175 22 19.6088 20.6088C20.9472 19.2703 20.998 17.147 20.9999 13"
                                        stroke="currentColor" stroke-width="1" stroke-linecap="round" />
                                    <path
                                        d="M2 14.1354C2.61902 14.0455 3.24484 14.0011 3.87171 14.0027C6.52365 13.9466 9.11064 14.7729 11.1711 16.3342C13.082 17.7821 14.4247 19.7749 15 22"
                                        stroke="currentColor" stroke-width="1" stroke-linejoin="round" />
                                    <path
                                        d="M21 16.8962C19.8246 16.3009 18.6088 15.9988 17.3862 16.0001C15.5345 15.9928 13.7015 16.6733 12 18"
                                        stroke="currentColor" stroke-width="1" stroke-linejoin="round" />
                                    <path
                                        d="M17 4.5C17.4915 3.9943 18.7998 2 19.5 2M22 4.5C21.5085 3.9943 20.2002 2 19.5 2M19.5 2V10"
                                        stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <img src="#" class="img-thumbnail mb-2 imagen-seleccionada"
                                    style="display: none;">
                            </span>
                            <small class="fw-bold pt-3 caption">Arrastra y suelta tu imagen aquí o haz clic para
                                seleccionar
                                una.</small>
                            <small class="message">Ningún archivo seleccionado.</small>
                        </label>
                        <input class="input-file" name="imagen" accept=".jpg, .jpeg, .png" id="imagen"
                            type="file" required />
                        <div class="invalid-feedback">
                            Por favor, seleccione la imagen.
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger" id="eliminar-imagen" style="display: none;">Eliminar
                        imagen</button>
                </div>
                <div class="col-12 col-xl-4">
                    <h6 class="mb-3">Información adicional</h6>
                    <div class="mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha límite de solicitud<span
                                class="obligatorio">
                                *</span></label>
                        <input type="date" required class="form-control" id="fecha_vencimiento"
                            name="fecha_vencimiento">
                        <div class="invalid-feedback">
                            Por favor, ingrese la fecha límite de solicitud.
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="encabezado mb-0">
                            <label for="contrato" class="form-label">Tipo de contrato<span class="obligatorio">
                                    *</span></label>
                            <button type="button" class="link_name" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasTipoContratacion" aria-controls="offcanvasTipoContratacion">
                                <small class="fw-bold">Agregar nuevo</small>
                            </button>
                        </div>
                        <select class="form-select" id="contrato" name="contrato" required>
                            <option value="">Seleccione el tipo</option>
                        </select>
                        <input type="hidden" id="tipo_contratacion_id" name="id_tipo_contratacion" value="">
                        <div class="invalid-feedback">
                            Por favor, seleccione el tipo de contrato.
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="encabezado mb-0">
                            <label for="modalidad" class="form-label">Modalidad del puesto<span class="obligatorio">
                                    *</span></label>
                            <button type="button" class="link_name" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasModalidad" aria-controls="offcanvasRight">
                                <small class="fw-bold">Agregar nuevo</small>
                            </button>
                        </div>
                        <select class="form-select" id="modalidad" name="modalidad" required>
                            <option value="">Seleccione la modalidad</option>
                        </select>
                        <input type="hidden" id="modalidad_id" name="id_modalidad" value="">
                        <div class="invalid-feedback">
                            Por favor, seleccione la modalidad.
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                        <h6 class="mb-3">Ubicación</h6>
                        <div class="mb-3">
                            <div class="encabezado mb-0">
                                <div for="pais_vacante" class="form-label">País<span class="obligatorio">
                                        *</span></div>
                                <a href="{{ route('pag.empresas') }}" class="link_name" type="button"><small
                                        class="fw-bold">Agregar
                                        nuevo</small></a>
                            </div>
                            <select class="form-select" id="pais_vacante" required>
                                <option value="">Seleccione el país</option>
                            </select>
                            <input type="hidden" id="id_pais" name="pais_id" value="">
                            <div class="invalid-feedback">
                                Por favor, seleccione el país.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="departamento_vacante" class="form-label">Departamento<span class="obligatorio">
                                    *</span></label>
                            <select class="form-select" id="departamento_vacante" required>
                                <option value="">Seleccione el departamento</option>
                            </select>
                            <input type="hidden" id="id_departamento" name="departamento_id" value="">
                            <div class="invalid-feedback">
                                Por favor, seleccione el departamento.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="municipio_vacante" class="form-label">Municipio<span class="obligatorio">
                                    *</span></label>
                            <select class="form-select" id="municipio_vacante" required>
                                <option value="">Seleccione el municipio</option>
                            </select>
                            <input type="hidden" id="id_municipio" name="municipio_id" value="">
                            <div class="invalid-feedback">
                                Por favor, seleccione el municipio.
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-12 col-xl-4">
                    <h6 class="mb-3">Información empresarial</h6>
                    {{-- <div class="mb-3">
                        <div class="encabezado mb-0">
                            <label for="empresa_vacante" class="form-label">Empresa<span class="obligatorio">
                                    *</span></label>
                            <a href="{{ route('pag.empresas') }}" class="link_name"><small class="fw-bold">Agregar
                                    nuevo</small></a>
                        </div>
                        <select id="empresa_vacante" class="form-control" required>
                            <option value="">Seleccione una empresa</option>
                        </select>
                        <input type="hidden" id="id_empresa" name="empresa_id" value="">
                        <div class="invalid-feedback">
                            Seleccione una empresa
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="encabezado mb-0">
                            <label for="division" class="form-label">Divisiones<span class="obligatorio">
                                    *</span></label>
                            <a href="{{ route('pag.empresas') }}" class="link_name"><small class="fw-bold">Agregar
                                    nuevo</small></a>
                        </div>
                        <select class="form-select" id="division" name="division" required>
                            <option value="">Seleccione la división</option>
                            <option value="">Contabilidad</option>
                            <option value="">Informatica</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione la división.
                        </div>
                    </div> --}}
                </div>
            </div>
        </form>
        <x-empleos.contratacion.tipo-contratacion />
        <x-empleos.modalidad.modalidad />
    </div>

    <x-notificaciones.notificaciones-ia :usuario="$usuario" />

    <x-notificaciones />

    <script src="{{ asset('js/empleos/crear-vacante.js') }}"></script>
    <script src="{{ asset('js/empleos/contrataciones/contratacion.js') }}"></script>
    <script src="{{ asset('js/empleos/modalidades/modalidad.js') }}"></script>
    <script src="{{ asset('js/empresa/functions/funciones.js') }}"></script>
@endsection
