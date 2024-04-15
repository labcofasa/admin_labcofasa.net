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
                        <h5 class="titulo-aut">¿Tiene problemas para iniciar sesión en su cuenta?</h5>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22"
                                        height="22" color="#595959" fill="none">
                                        <path d="M2 6L8.91302 9.91697C11.4616 11.361 12.5384 11.361 15.087 9.91697L22 6"
                                            stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                        <path
                                            d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z"
                                            stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
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
