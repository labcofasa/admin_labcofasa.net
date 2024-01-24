@extends('layouts.autenticado')

@section('titulo', 'Publicidad')

@section('contenido')

    <div class="container-fluid content">
        <div class="card-container">

            <!-- Tabla fantasma -->
            <x-skeleton />

            <!-- Tabla publicidades -->
            <div class="table-responsive" id="tabla-publicidades-container" style="display: none;">

                <!-- Titulo-->
                <h1 class="pb-2">@yield('titulo')</h1>

                <table id="tabla-publicidades" class="table align-middle responsive display" width="100%">
                    <tbody></tbody>
                </table>
            </div>

            <!-- Botón que dispara el registro de publicidades -->
            <span type="hidden" id="crearPublicidadBtn"></span>
            <button type="button" id="crearPublicidadBtn" style="display: none;"></button>


            <!-- Permisos -->
            <x-widgets.roles.permisos />
        </div>

    </div>

    <!-- Modal -->
    <x-publicidad.publicidad />

    <!-- Scripts -->
    <script async src="{{ asset('js/publicidad/publicidad.js') }}"></script>

@endsection
