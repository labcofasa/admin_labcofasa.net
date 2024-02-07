@extends('layouts.visor')

@section('titulo', 'Logo de la empresa')

@section('contenido')
    @if ($empresa->imagen_leyenda)
        <img src="{{ asset('images/empresas/leyenda/' . $empresa->id . '/' . $empresa->imagen_leyenda) }}" alt="Leyenda de factura">
    @else
        <p>No hay imagen disponible</p>
    @endif
@endsection
