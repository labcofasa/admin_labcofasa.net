@extends('layouts.invitado')

@section('titulo', 'Restablecer contraseña')

@section('contenido')
    <div class="container px-3">
        <x-fondo-animado />
        <div class="login">
            <div class="row form">
                <div class="col d-none d-lg-block px-0">
                    <x-carrusel :avisos="$avisos" />
                </div>
                <div class="col form-group">
                    <div class="input-box">
                        <h6 class="titulo-rest py-3">¿Tiene problemas para iniciar sesión en su cuenta?</h6>
                        <small>Proporcione su correo electrónico institucional para recibir un enlace
                            y recuperar el acceso a su cuenta.</small>
                        <form action="{{ route('enviar.enlace') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="textbox email">
                                <input id="email" name="email" type="email"
                                    class="@error('email') is-invalid @enderror" autocomplete="off" autofocus
                                    value="{{ old('username') }}" required />
                                <label for="email">Correo electrónico</label>
                                <span class="material-symbols-outlined"> mail </span>
                            </div>
                            @error('email')
                                <span class="invalid-feedback py-2" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="input-field py-4">
                                <button class="btn-animado" type="submit">
                                    <i class="animation"></i>
                                    Solicitar enlace
                                    <i class="animation"></i>
                                </button>
                            </div>
                            <div class="recuperar">
                                <span>Volver a <a href="{{ route('autenticarme') }}">Inicio de sesión</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
