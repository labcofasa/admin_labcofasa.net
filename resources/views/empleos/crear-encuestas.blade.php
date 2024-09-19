@extends('layouts.autenticado')

@section('titulo', 'Crear encuesta')

@section('contenido')
    <div class="container-fluid content">
        <div class="encabezado">
            <a href="{{ route('pag.encuesta') }}" class="d-flex gap-3 text-decoration-none align-items-center">
                <svg class="text-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    color="#000000" fill="none">
                    <path d="M4 12L20 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M8.99996 17C8.99996 17 4.00001 13.3176 4 12C3.99999 10.6824 9 7 9 7" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
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
                    <span>Publicar encuesta</span>
                </div>
            </button>
        </div>
        <form action="{{ route('creando.encuesta')}}" method="POST">
            @csrf
            <!-- Formulario de creación de encuestas -->
            <div class="mb-3">
                <label for="nombre_encuesta" class="form-label">Nombre de la encuesta<span class="obligatorio">
                        *</span></label>
                <input type="text" class="form-control" id="nombre_encuesta" name="nombre_encuesta" required>
            </div>
            <div class="mb-3">
                <label for="descripcion_encuesta" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion_encuesta" name="descripcion_encuesta" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="link_encuesta" class="form-label">Enlace de la encuesta</label>
                <input type="url" class="form-control" id="link_encuesta" name="link_encuesta" placeholder="Pegar el enlace de Google Forms aquí" required>
            </div>
            <div class="mb-3">
                <a href="https://forms.google.com" target="_blank" class="btn btn-primary">Crear Encuesta</a>
            </div>
        </form>
    </div>
    
    <x-notificaciones.notificaciones-ia :usuario="$usuario" />

    <x-notificaciones />

@endsection