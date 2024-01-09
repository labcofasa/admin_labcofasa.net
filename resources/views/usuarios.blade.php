@extends('layouts.autenticado')

@section('titulo', 'Usuarios registrados')

@section('contenido')
    <div class="container-fluid main-container py-3">

        <!-- Contadores con información -->
        <x-usuario.contadores />

        <!-- Título de la página -->
        <h1 class="pb-3">@yield('titulo')</h1>

        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla usuarios -->
        <div class="table-responsive rounded-3" id="tabla-usuarios-container" style="display: none;">
            <table id="tabla-usuarios" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <!-- Botón que dispara el registro de usuarios -->
        <span type="hidden" id="registrarUsuarioBtn"></span>

    </div>

    <!-- Notificaciones -->
    <x-notificaciones />

    <!-- Modal para registrar usuarios -->
    <x-usuario.crear_usuario />

    <!-- Modal para editar usuarios -->
    <x-usuario.editar_usuario />

    <!-- Modal para confirmar la eliminación de usuarios -->
    <x-usuario.eliminar_usuario />

    <script async src="{{ asset('js/usuarios/usuarios.js') }}"></script>
    <script async src="{{ asset('js/roles_permisos/roles.js') }}"></script>
    <script async src="{{ asset('js/empresa/functions/funciones.js') }}"></script>

@endsection
