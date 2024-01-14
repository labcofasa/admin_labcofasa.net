@extends('layouts.autenticado')

@section('titulo', 'Aplicaciones registradas')

@section('contenido')

    <div class="container-fluid content">
        <div class="card-container">

            <!-- Tabla fantasma -->
            <x-skeleton />

            <!-- Tabla aplicaciones -->
            <div class="table-responsive rounded-3" id="tabla-aplicaciones-container" style="display: none;">
                <h1 class="pb-2">@yield('titulo')</h1>
                <table id="tabla-aplicaciones" class="table align-middle responsive display nowrap" width="100%">
                    <tbody></tbody>
                </table>
            </div>

            <!-- Botón que dispara el registro de aplicaciones -->
            <span type="hidden" id="crearAplicacionBtn"></span>
        </div>

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

@endsection
