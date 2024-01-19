@extends('layouts.autenticado')

@section('titulo', 'Roles de usuarios')

@section('contenido')
    <div class="container-fluid content">
        <div class="card-container">

            <!-- Tabla fantasma -->
            <x-skeleton />

            <!-- Tabla roles -->
            <div class="table-responsive rounded-3" id="tabla-roles-container">

                <!-- Titulo-->
                <h1 class="pb-2">@yield('titulo')</h1>

                <table id="tabla-roles" class="table align-middle responsive display" width="100%">
                    <tbody></tbody>
                </table>
            </div>

            <span type="hidden" id="registrarRolBtn"></span>

            <!-- Permisos -->
            <x-widgets.roles.permisos />
        </div>
    </div>

    <!-- Modal -->
    <x-roles.rol />

    <script src="{{ asset('js/roles_permisos/roles.js') }}"></script>

@endsection
