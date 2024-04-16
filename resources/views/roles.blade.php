@extends('layouts.autenticado')

@section('titulo', 'Roles')

@section('contenido')
    <div class="container-fluid content">
        <h1 class="pb-3">@yield('titulo')</h1>

        <x-skeleton />

        <!-- Tabla roles -->
        <div class="table-responsive" id="tabla-roles-container">
            <table id="tabla-roles" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <span type="hidden" id="registrarRolBtn"></span>

        <!-- Permisos -->
        <x-widgets.roles.permisos />
    </div>

    <!-- Modal -->
    <x-roles.rol />

    <script src="{{ asset('js/roles_permisos/roles.js') }}"></script>

@endsection
