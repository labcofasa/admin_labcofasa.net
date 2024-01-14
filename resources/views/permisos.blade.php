@extends('layouts.autenticado')

@section('titulo', 'Permisos para usuarios')

@section('contenido')

    <div class="container-fluid content">
        <div class="card-container">

            <x-skeleton />

            <div class="table-responsive rounded-3" id="tabla-permisos-container" style="display: none;">
                <h1 class="pb-2">@yield('titulo')</h1>
                <table id="tabla-permisos" class="table align-middle responsive display nowrap" width="100%">
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <x-notificaciones />

    <script src="{{ asset('js/roles_permisos/permisos.js') }}"></script>

@endsection
