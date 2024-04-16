@extends('layouts.autenticado')

@section('titulo', 'Aplicaciones')

@section('contenido')

    <div class="container-fluid content">
        <h1 class="pb-3">@yield('titulo')</h1>

        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla aplicaciones -->
        <div class="table-responsive" id="tabla-aplicaciones-container" style="display: none;">
            <table id="tabla-aplicaciones" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <!-- Botón que dispara el registro de aplicaciones -->
        <span type="hidden" id="crearAplicacionBtn"></span>

        <!-- Permisos -->
        <x-widgets.roles.permisos />
    </div>

    <!-- Modal -->
    <x-aplicaciones.aplicacion />

    <!-- Scripts -->
    <script async src="{{ asset('js/aplicaciones/aplicaciones.js') }}"></script>

@endsection
