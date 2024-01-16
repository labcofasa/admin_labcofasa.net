@extends('layouts.autenticado')

@section('titulo', 'Empresas registradas')

@section('contenido')
    <div class="container-fluid content">
        <div class="card-container">

            <x-skeleton />

            <div class="table-responsive rounded-3" id="tabla-empresas-container" style="display: none;">
                <x-widgets.empresas.crear />
                <h1 class="d-xl-none pb-2">@yield('titulo')</h1>
                <table id="tabla-empresas" class="table align-middle responsive display nowrap" width="100%">
                    <tbody></tbody>
                </table>
            </div>

            <x-widgets.roles.permisos />
        </div>
    </div>

    <!-- Modal -->
    <x-empresa.empresa />

    <script src="{{ asset('js/empresa/empresa.js') }}"></script>
@endsection
