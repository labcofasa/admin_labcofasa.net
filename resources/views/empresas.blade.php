@extends('layouts.autenticado')

@section('titulo', 'Empresas')

@section('contenido')
    <div class="container-fluid content">
        <h1 class="d-xl-none pb-3">@yield('titulo')</h1>
        <x-widgets.empresas.crear />

        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla empresas -->
        <div class="table-responsive" id="tabla-empresas-container" style="display: none;">
            <table id="tabla-empresas" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <!-- Permisos -->
        <x-widgets.roles.permisos />
    </div>

    <!-- Modal -->
    <x-empresa.empresa />

    <script src="{{ asset('js/empresa/empresa.js') }}"></script>
@endsection
