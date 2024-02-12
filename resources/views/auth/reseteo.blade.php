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
                        <h6 class="titulo-rest py-3">Recupere su contraseña</h6>
                        <form action="{{ route('actualizar.clave') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="textbox email">
                                <input id="email" name="email" type="email"
                                    class="@error('email') is-invalid @enderror" autocomplete="off" autofocus
                                    value="{{ old('email') }}" required />
                                <label for="email">Correo electrónico</label>
                                <span class="material-symbols-outlined"> mail </span>
                            </div>
                            @error('email')
                                <span class="invalid-feedback py-2" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="textbox email">
                                <input id="password" name="password" type="password" required />
                                <label for="password">Contraseña</label>
                                <span class="material-symbols-outlined"> key </span>
                                <button type="button" onclick="verClaveRest()">
                                    <span id="passwordIconRest" class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback py-2" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="textbox confirm">
                                <input id="password_confirmation" name="password_confirmation" type="password" required />
                                <label for="password_confirmation">Confirme la nueva contraseña</label>
                                <span class="material-symbols-outlined"> key </span>
                                <button type="button" onclick="verClaveRestConfirm()">
                                    <span id="passwordIconRestConfirm" class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="input-field pt-3">
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
