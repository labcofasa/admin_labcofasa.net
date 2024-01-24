@extends('layouts.autenticado')

@section('titulo', 'Usuarios')

@section('contenido')
    <div class="container-fluid content">
        <div class="card-container">

            <!-- Contadores con información -->
            <x-widgets.contadores />

            <!-- Tabla fantasma -->
            <x-skeleton />

            <!-- Tabla usuarios -->
            <div class="table-responsive" id="tabla-usuarios-container" style="display: none;">
                <h1 class="pb-2">@yield('titulo')</h1>
                <table id="tabla-usuarios" class="table align-middle responsive display" width="100%">
                    <tbody></tbody>
                </table>
            </div>

            <!-- Botón que dispara el registro de usuarios -->
            <span type="hidden" id="registrarUsuarioBtn"></span>

            <!-- Permisos -->
            <x-widgets.roles.permisos />
        </div>
    </div>

    <!-- Modal -->
    <x-usuario.usuario />

    <script async src="{{ asset('js/usuarios/usuarios.js') }}"></script>
    <script async src="{{ asset('js/roles_permisos/roles.js') }}"></script>
    <script async src="{{ asset('js/empresa/functions/funciones.js') }}"></script>

@endsection
