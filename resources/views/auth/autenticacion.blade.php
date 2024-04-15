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
                            <div class="textbox password">
                                <input id="password" name="password" type="password" required />
                                <label for="password">Contraseña</label>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22"
                                        height="22" color="#595959" fill="none">
                                        <path d="M14.491 15.5H14.5M9.5 15.5H9.50897" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M4.26781 18.8447C4.49269 20.515 5.87613 21.8235 7.55966 21.9009C8.97627 21.966 10.4153 22 12 22C13.5847 22 15.0237 21.966 16.4403 21.9009C18.1239 21.8235 19.5073 20.515 19.7322 18.8447C19.879 17.7547 20 16.6376 20 15.5C20 14.3624 19.879 13.2453 19.7322 12.1553C19.5073 10.485 18.1239 9.17649 16.4403 9.09909C15.0237 9.03397 13.5847 9 12 9C10.4153 9 8.97627 9.03397 7.55966 9.09909C5.87613 9.17649 4.49269 10.485 4.26781 12.1553C4.12105 13.2453 4 14.3624 4 15.5C4 16.6376 4.12105 17.7547 4.26781 18.8447Z"
                                            stroke="currentColor" stroke-width="2" />
                                        <path d="M7.5 9V6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5V9"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <button type="button" onclick="verClave()">
                                    <span>
                                        <img id="eye-icon" src="{{ asset('images/cerrado.svg') }}" />
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
