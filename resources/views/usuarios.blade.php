@extends('layouts.autenticado')

@section('titulo', 'Usuarios')

@section('contenido')
    <div class="container-fluid content">
        <h1 class="pb-3">@yield('titulo')</h1>

        <!-- Contadores con información -->
        <x-widgets.contadores />

        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla usuarios -->
        <div class="table-responsive" id="tabla-usuarios-container" style="display: none;">
            <table id="tabla-usuarios" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <!-- Botón que dispara el registro de usuarios -->
        <span type="hidden" id="registrarUsuarioBtn"></span>

        <!-- Permisos -->
        <x-widgets.roles.permisos />
    </div>

    <!-- Modal -->
    <x-usuario.usuario />

    <script async src="{{ asset('js/usuarios/usuarios.js') }}"></script>
    <script async src="{{ asset('js/roles_permisos/roles.js') }}"></script>
    <script async src="{{ asset('js/empresa/functions/funciones.js') }}"></script>

@endsection
