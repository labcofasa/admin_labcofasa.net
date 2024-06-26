@extends('layouts.autenticado')

@section('titulo', 'Permisos')

@section('contenido')

    <div class="container-fluid content">
        <h1 class="pb-3">@yield('titulo')</h1>

        <x-skeleton />

        <!-- Tabla permisos -->
        <div class="table-responsive" id="tabla-permisos-container" style="display: none;">
            <table id="tabla-permisos" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('js/roles_permisos/permisos.js') }}"></script>

@endsection
