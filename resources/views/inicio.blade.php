@extends('layouts.autenticado')

@section('titulo', 'Inicio')

@section('contenido')
    <div class="container-fluid content">
        <div class="card-container">
            <h1 class="py-3">@yield('titulo')</h1>
        </div>
    </div>
@endsection
