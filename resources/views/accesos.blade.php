@extends('layouts.autenticado')

@section('titulo', 'Aplicaciones')

@section('contenido')
    <div class="container-fluid content">
        <!-- Titulo-->
        <h1 class="pb-3">@yield('titulo')</h1>

        <!-- Botones para aplicaciones registradas -->
        <x-dashboard.cartas :aplicaciones="$aplicaciones" />
    </div>

    <x-notificaciones.notificaciones-usuario :usuario="$usuario" />
@endsection
