@extends('layouts.autenticado')

@section('titulo', 'Aplicaciones')

@section('contenido')
    <div class="container-fluid content">
        <div class="card-container">

            <!-- Titulo-->
            <h1 class="pb-3">@yield('titulo')</h1>

            <!-- Botones para aplicaciones registradas -->
            <x-inicio.cartas :aplicaciones="$aplicaciones" />
        </div>
    </div>
@endsection
