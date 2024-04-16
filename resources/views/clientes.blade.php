@extends('layouts.autenticado')

@section('titulo', 'Clientes')

@section('contenido')
    <div class="container-fluid content">
        <h1 class="pb-3">@yield('titulo')</h1>

        <x-skeleton />

        <!-- Tabla clientes -->
        <div class="table-responsive" id="tabla-clientes-container" style="display: none;">
            <table id="tabla-clientes" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script async src="{{ asset('js/clientes/clientes.js') }}"></script>
@endsection
