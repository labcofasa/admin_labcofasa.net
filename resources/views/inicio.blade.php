@extends('layouts.autenticado')

@section('titulo', 'Aplicaciones')

@section('contenido')
    <div class="container-fluid content">
        <div class="card-container">
            <h1 class="pb-3">@yield('titulo')</h1>

            <x-inicio.cartas :aplicaciones="$aplicaciones" />

        </div>
    </div>
@endsection
