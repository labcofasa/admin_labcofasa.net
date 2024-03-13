@extends('layouts.autenticado')

@section('titulo', 'Formularios')

@section('contenido')

    <div class="container-fluid content">
        <!-- Titulo-->
        <h1 class="pb-3">@yield('titulo')</h1>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="row g-0 card-form rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative">
                    <div class="col px-3 pt-3 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">Ventas</strong>
                        <h3 class="mb-0">Conozca a su cliente</h3>
                        <small class="mb-1">Vigencia dic 23, Version 1</small>
                        <p class="card-text mb-auto">Descripción del formulario</p>
                        <div class="d-inline-flex gap-2 my-3">
                            <a href="{{ route('pag.formulario') }}"
                                class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill"
                                type="button">
                                Respuestas
                            </a>
                            <a href="{{ route('formulario') }}" target="_blank"
                                class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                                Ver formulario
                            </a>
                        </div>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img src="{{ asset('images/form.png') }}" width="200" height="200" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="chevron-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </symbol>
    </svg>

@endsection
