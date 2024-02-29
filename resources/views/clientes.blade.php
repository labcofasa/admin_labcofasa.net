@extends('layouts.autenticado')

@section('titulo', 'Clientes')

@section('contenido')
    <div class="container-fluid content">
        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla clientes -->
        <div class="table-responsive" id="tabla-clientes-container" style="display: none;">

            <!-- Titulo-->
            <h1 class="pb-2">@yield('titulo')</h1>

            <table id="tabla-clientes" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script async src="{{ asset('js/clientes/clientes.js') }}"></script>
@endsection
