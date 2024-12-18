@extends('layouts.autenticado')

@section('titulo', 'Encuestas')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/styles/components/checkbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles/components/tablesc.css') }}">
@endpush

@section('contenido')
    <div class="container-fluid content">
        <!-- tabla usuario encuesta -->
        <div class="encabezado">
            <h1 class="pb-3">@yield('titulo')</h1>
        </div>
        <div class="table-responsive">
            <table id="encuestas-table" class="table align-middle display" style="width:100%">
                <thead>
                    {{-- Aquí irán los encabezados de la tabla --}}
                </thead>
                <tbody>
                    <!-- Aquí irán las filas de la tabla -->
                </tbody>
            </table>
        </div> 
    </div>

    {{-- modal --}}

    <x-encuesta.encuesta />

    <script src="{{asset('js/encuestas/encuestas.js')}}"></script>

@endsection