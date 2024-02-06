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
                <div class="col">
                    <div class="input-box">
                        <header>Recupere su contraseña</header>
                        <form action="{{ route('actualizar.clave') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="input-field">
                                <input type="email" id="email" name="email"
                                    class="input @error('email') is-invalid @enderror" required autocomplete="off" autofocus
                                    value="{{ old('email') }}" />
                                <label for="email">{{ __('Correo electrónico institucional') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <input type="password" name="password" class="input @error('password') is-invalid @enderror"
                                    id="pass" required autocomplete="off" />
                                <label for="pass">{{ __('Nueva contraseña') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field">
                                <input type="password" name="password_confirmation"
                                    class="input @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation passwordInput" required autocomplete="off" />
                                <label for="password_confirmation passwordInput">{{ __('Repetir contraseña') }}</label>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <button class="btn-animado" type="submit">
                                    <i class="animation"></i>
                                    Cambiar contraseña
                                    <i class="animation"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
