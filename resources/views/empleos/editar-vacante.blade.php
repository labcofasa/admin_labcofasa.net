@extends('layouts.autenticado')

@section('titulo', 'Editar vacante')

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
                <h1>@yield('titulo') {{ $vacante->nombre }}</h1>
            </a>
            <button id="actualizarVacante" class="btn btn-lg btn-success d-none d-xl-block accion" type="button">
                <div class="accion">
                    <svg class="icon-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24" color="#000000" fill="none">
                        <path
                            d="M12.5 22H9.5C6.20017 22 4.55025 22 3.52513 20.9209C2.5 19.8418 2.5 18.1051 2.5 14.6316V9.36842C2.5 5.89491 2.5 4.15816 3.52513 3.07908C4.55025 2 6.20017 2 9.5 2H12.5C15.7998 2 17.4497 2 18.4749 3.07908C19.5 4.15816 19.5 5.89491 19.5 9.36842V11"
                            stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18 15L18 22M21.5 18.5L14.5 18.5" stroke="currentColor" stroke-width="1"
                            stroke-linecap="round" />
                        <path
                            d="M7 2L7.0822 2.4932C7.28174 3.69044 7.38151 4.28906 7.80113 4.64453C8.22075 5 8.82762 5 10.0414 5H11.9586C13.1724 5 13.7793 5 14.1989 4.64453C14.6185 4.28906 14.7183 3.69044 14.9178 2.4932L15 2"
                            stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 16H11M7 11H15" stroke="currentColor" stroke-width="1" stroke-linecap="round" />
                    </svg>
                    <span>Guardar cambios</span>
                </div>
            </button>
        </div>
        <form id="frmEditarVacante" action="{{ route('actualizar.vacante', ['id' => $vacante->id]) }}"
            class="form needs-validation" novalidate method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        @if ($vacante->imagen)
                            <img class="img-fluid"
                                src="{{ asset('images/empleos/imagenes/' . $vacante->id . '/' . $vacante->imagen) }}">
                        @else
                            <img class="img-fluid" src="{{ asset('images/empleo-defecto.png') }}">
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Imagen principal</div>
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
                                <img src="#" class="img-thumbnail mb-2 imagen-seleccionada" style="display: none;">
                            </span>
                            <small class="fw-bold pt-3 caption">Arrastra y suelta tu imagen aquí o haz clic para seleccionar
                                una.</small>
                            <small class="message">Ningún archivo seleccionado.</small>
                        </label>
                        <input class="input-file" name="imagen" accept=".jpg, .jpeg, .png" id="imagen" type="file" />
                        <div class="invalid-feedback">
                            Por favor, seleccione la imagen.
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger mb-3" id="eliminar-imagen" style="display: none;">Eliminar
                        imagen</button>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Titúlo de la vacante</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ $vacante->nombre }}" required autocomplete="off">
                        <div class="invalid-feedback">
                            Por favor, ingrese el titúlo de la vacante.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción de la vacante</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" required>{{ $vacante->descripcion }}</textarea>
                        <div class="invalid-feedback">
                            Por favor, ingrese la descripción de la vacante.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de
                            vencimiento</label>
                        <input type="date" required class="form-control" id="fecha_vencimiento"
                            value="{{ $vacante->fecha_vencimiento }}" name="fecha_vencimiento">
                        <div class="invalid-feedback">
                            Por favor, ingrese la fecha de vencimiento.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Departamento<span class="obligatorio">
                                *</span></label>
                        <select class="form-select" id="tipo" name="tipo">
                            <option value="">Seleccione el departamento</option>
                            <option value="Cliente">Informatica</option>
                            <option value="Proveedor">Mantenimiento</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione el departamento.
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/empleos/editar-vacante.js') }}"></script>
@endsection
