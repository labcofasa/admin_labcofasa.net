@extends('layouts.autenticado')

@section('titulo', 'Formulario conozca a su cliente')

@section('contenido')

    <div class="container-fluid content">
        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla aplicaciones -->
        <div class="table-responsive" id="tabla-formulario-conozca-cliente-container" style="display: none;">

            <!-- Titulo-->
            <h1 class="pb-3">@yield('titulo')</h1>

            <table id="tabla-conozca-cliente" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>
    </div>

    <x-formularios.ver />

    <x-notificaciones />

    <!-- Scripts -->
    <script async src="{{ asset('js/forms/conozca_cliente/tabla.js') }}"></script>

@endsection
