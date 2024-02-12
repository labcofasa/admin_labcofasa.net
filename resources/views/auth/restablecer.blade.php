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
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960"
                                        width="22">
                                        <path
                                            d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z" />
                                    </svg>
                                </span>
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
