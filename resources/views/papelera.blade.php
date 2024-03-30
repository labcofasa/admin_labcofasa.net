@extends('layouts.autenticado')

@section('titulo', 'Papelera')

@section('contenido')

    <div class="container-fluid content">
        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla papelera -->
        <div class="table-responsive" id="tabla-papelera-container" style="display: none;">

            <!-- Titulo-->
            <h1 class="pb-3">@yield('titulo')</h1>

            <table id="tabla-papelera" class="table align-middle responsive display nowrap" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <!-- Permisos -->
        <x-widgets.roles.permisos />
    </div>

    <!-- Modal -->
    <x-papelera.papelera />

    <script src="{{ asset('js/papelera/papelera.js') }}"></script>
@endsection
