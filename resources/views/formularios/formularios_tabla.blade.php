@extends('layouts.autenticado')

@section('titulo', 'Formularios')

@section('contenido')

    <div class="container-fluid content">
        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla aplicaciones -->
        <div class="table-responsive" id="tabla-formulario-conozca-cliente-container" style="display: none;">

            <!-- Titulo-->
            <h1 class="pb-2">@yield('titulo')</h1>

            <table id="tabla-conozca-cliente" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script async src="{{ asset('js/forms/tabla.js') }}"></script>

@endsection
