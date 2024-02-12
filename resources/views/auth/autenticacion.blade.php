@extends('layouts.invitado')

@section('titulo', 'Inicio de sesión')

@section('contenido')
    <div class="container">
        <x-fondo-animado />
        <div class="login">
            <div class="row form">
                <div class="col d-none d-lg-block px-0">
                    <x-carrusel :avisos="$avisos" />
                </div>
                <div class="col form-group">
                    <div class="input-box">
                        <div class="logo">
                            <img src="{{ asset('images/cofasa.svg') }}" alt="logo">
                        </div>
                        <h5 class="titulo-aut">Bienvenido al Sistema de Laboratorios Cofasa</h5>
                        @error('username')
                            <span class="invalid-feedback message" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                        @if (session('success'))
                            <span class="success-feedback" role="alert">
                                {{ session('success') }}
                            </span>
                        @endif
                        @if (session('error'))
                            <span class="invalid-feedback" role="alert">
                                {{ session('error') }}
                            </span>
                        @endif
                        <form action="{{ route('autenticar.usuario') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="textbox email">
                                <input id="username" name="username" type="text"
                                    class="@error('username') is-invalid @enderror" autocomplete="off" autofocus
                                    value="{{ old('username') }}" required />
                                <label for="username">Correo electrónico</label>
                                <span class="material-symbols-outlined"> mail </span>
                            </div>
                            <div class="textbox password">
                                <input id="password" name="password" type="password" required />
                                <label for="password">Contraseña</label>
                                <span class="material-symbols-outlined"> lock </span>
                                <button type="button" onclick="verClave()">
                                    <span id="passwordIcon" class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </button>
                            </div>
                            <div class="input-field">
                                <button class="btn-animado" type="submit">
                                    <i class="animation"></i>
                                    Ingresar al sistema
                                    <i class="animation"></i>
                                </button>
                            </div>
                            <div class="recuperar pt-3">
                                <span>¿Olvidó su contraseña? <a href="{{ route('form.restablecer') }}">Recuperar</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
