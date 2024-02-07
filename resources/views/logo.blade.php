@extends('layouts.visor')

@section('titulo', 'Logo de la empresa')

@section('contenido')
    @if ($empresa->imagen)
        <img src="{{ asset('images/empresas/logo/' . $empresa->id . '/' . $empresa->imagen) }}" alt="Logo de la empresa">
    @else
        <p>No hay imagen disponible</p>
    @endif
@endsection
