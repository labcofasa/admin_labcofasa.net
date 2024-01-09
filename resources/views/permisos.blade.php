@extends('layouts.autenticado')

@section('titulo', 'Permisos para usuarios')

@section('contenido')
    <div class="container-fluid main-container py-3">

        <h1 class="py-3">@yield('titulo')</h1>

        <x-skeleton />

        <div class="table-responsive rounded-3" id="tabla-permisos-container" style="display: none;">
            <table id="tabla-permisos" class="table align-middle responsive display nowrap" width="100%">
                <tbody></tbody>
            </table>
        </div>
    </div>

    <x-notificaciones />

    <script src="{{ asset('js/roles_permisos/permisos.js') }}"></script>

@endsection
