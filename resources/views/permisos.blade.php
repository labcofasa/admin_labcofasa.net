@extends('layouts.autenticado')

@section('titulo', 'Permisos para usuarios')

@section('contenido')

    <div class="container-fluid content">
        <div class="card-container">

            <!-- Tabla fantasma -->
            <x-skeleton />

            <!-- Tabla permisos -->
            <div class="table-responsive" id="tabla-permisos-container" style="display: none;">

                <!-- Titulo -->
                <h1 class="pb-2">@yield('titulo')</h1>

                <table id="tabla-permisos" class="table align-middle responsive display" width="100%">
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/roles_permisos/permisos.js') }}"></script>

@endsection
