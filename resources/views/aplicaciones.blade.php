@extends('layouts.autenticado')

@section('titulo', 'Aplicaciones registradas')

@section('contenido')

    <div class="container-fluid main-container py-3">

        <!-- Título de la página -->
        <h1 class="py-3">@yield('titulo')</h1>

        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla aplicaciones -->
        <div class="table-responsive rounded-3" id="tabla-aplicaciones-container" style="display: none;">
            <table id="tabla-aplicaciones" class="table align-middle responsive display nowrap" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <!-- Botón que dispara el registro de aplicaciones -->
        <span type="hidden" id="crearAplicacionBtn"></span>

    </div>

    <!-- Notificaciones -->
    <x-notificaciones />

    <!-- Modal para registrar aplicaciones -->
    <x-aplicaciones.crear_aplicacion />

    <!-- Modal para editar aplicaciones -->
    <x-aplicaciones.editar_aplicacion />

    <!-- Modal para eliminar aplicaciones -->
    <x-aplicaciones.eliminar_aplicacion />

    <!-- Scripts -->
    <script async src="{{ asset('js/aplicaciones/aplicaciones.js') }}"></script>
    <script src="{{ asset('js/multiselect/multiselect.js') }}"></script>

@endsection
