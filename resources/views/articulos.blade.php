@extends('layouts.autenticado')

@section('titulo', 'Artículos')

@section('contenido')
    <div class="container-fluid content">
        <h1 class="pb-3">@yield('titulo')</h1>

        <x-skeleton />

        <!-- Tabla articulos -->
        <div class="table-responsive" id="tabla-articulos-container" style="display: none;">
            <table id="tabla-articulos" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script async src="{{ asset('js/articulos/articulos.js') }}"></script>
@endsection
