@extends('layouts.autenticado')

@section('titulo', 'Publicidad')

@section('contenido')

    <div class="container-fluid content">
        <h1 class="pb-3">@yield('titulo')</h1>

        <x-skeleton />

        <!-- Tabla avisos -->
        <div class="table-responsive" id="tabla-avisos-container" style="display: none;">
            <table id="tabla-avisos" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <!-- Botón que dispara el registro de avisos -->
        <span type="hidden" id="crearAvisoBtn"></span>

        <!-- Permisos -->
        <x-widgets.roles.permisos />
    </div>

    <!-- Modal -->
    <x-aviso.aviso />

    <!-- Scripts -->
    <script async src="{{ asset('js/avisos/avisos.js') }}"></script>

@endsection
