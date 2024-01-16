@extends('layouts.autenticado')

@section('titulo', 'Papelera')

@section('contenido')

    <div class="container-fluid content">
        <div class="card-container">

            <x-skeleton />

            <div class="table-responsive rounded-3" id="tabla-papelera-container" style="display: none;">
                <h1 class="pb-2">@yield('titulo')</h1>
                <table id="tabla-papelera" class="table align-middle responsive display nowrap" width="100%">
                    <tbody></tbody>
                </table>
            </div>

            <x-widgets.roles.permisos />
        </div>
    </div>

    <!-- Modal para confirmar la restauración de registros -->
    <x-papelera.restaurar />

    <x-notificaciones />

    <script src="{{ asset('js/papelera/papelera.js') }}"></script>
@endsection
