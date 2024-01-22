@extends('layouts.invitado')

@section('titulo', 'Restablecer contraseña')

@section('contenido')
    <div class="container px-3">
        <x-fondo-animado />
        <div class="login">
            <div class="row form">
                <div class="col d-none d-lg-block px-0">
                    <x-carrusel />
                </div>
                <div class="col form-group">
                    <div class="input-box">
                        <header>¿Tiene problemas para iniciar sesión en su cuenta?</header>
                        <p class="header-restablecer">Proporcione su correo electrónico institucional para recibir un enlace
                            y recuperar el acceso a su cuenta.</p>
                        <form action="{{ route('enviar.enlace') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="input-field">
                                <input type="email" id="email" name="email"
                                    class="input @error('email') is-invalid @enderror" required autocomplete="off"
                                    autofocus />
                                <label for="email">{{ __('Correo electrónico institucional') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <input type="submit" class="submit" value="Solicitar enlace" />
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
