@extends('layouts.autenticado')

@section('titulo', 'Inicio')

@section('contenido')
    <div class="container-fluid main-container py-3">
        <h1 class="py-3">@yield('titulo')</h1>
    </div>
@endsection
