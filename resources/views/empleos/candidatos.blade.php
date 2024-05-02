@extends('layouts.autenticado')

@section('titulo', 'Candidatos')

@section('contenido')
    <div class="container-fluid content">
        <a href="{{ route('pag.vacantes') }}" class="d-flex gap-3 text-decoration-none align-items-center mb-4">
            <svg class="text-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                color="#000000" fill="none">
                <path d="M4 12L20 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M8.99996 17C8.99996 17 4.00001 13.3176 4 12C3.99999 10.6824 9 7 9 7" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <h1>@yield('titulo') de la vacante: {{ $vacante->nombre }}</h1>
        </a>
        <div class="">
            <!-- Tabla fantasma -->
            <x-skeleton />

            <input type="hidden" id="vacanteId" value="{{ $vacante->id }}">

            <!-- Tabla usuarios -->
            <div class="table-responsive" id="tabla-candidatos-container" style="display: none;">
                <table id="tabla-candidatos" class="table align-middle responsive display" width="100%">
                    <tbody></tbody>
                </table>
            </div>

            <!-- Permisos -->
            <x-widgets.roles.permisos />
        </div>
    </div>

    <x-empleos.candidatos.candidatos />

    <script src="{{ asset('js/empleos/candidatos/candidatos.js') }}"></script>
@endsection
