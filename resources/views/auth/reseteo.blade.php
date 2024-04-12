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
                        <h5 class="titulo-aut">Recupere su contraseña</h5>
                        <form action="{{ route('actualizar.clave') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="textbox email">
                                <input id="email" name="email" type="email"
                                    class="@error('email') is-invalid @enderror" autocomplete="off" autofocus
                                    value="{{ old('email') }}" required />
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
                            <div class="textbox email">
                                <input id="password" name="password" type="password" required />
                                <label for="password">Contraseña</label>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960"
                                        width="22">
                                        <path
                                            d="M280-400q-33 0-56.5-23.5T200-480q0-33 23.5-56.5T280-560q33 0 56.5 23.5T360-480q0 33-23.5 56.5T280-400Zm0 160q-100 0-170-70T40-480q0-100 70-170t170-70q67 0 121.5 33t86.5 87h352l120 120-180 180-80-60-80 60-85-60h-47q-32 54-86.5 87T280-240Zm0-80q56 0 98.5-34t56.5-86h125l58 41 82-61 71 55 75-75-40-40H435q-14-52-56.5-86T280-640q-66 0-113 47t-47 113q0 66 47 113t113 47Z" />
                                    </svg>
                                </span>
                                <button type="button" onclick="verClaveRest()">
                                    <span>
                                        <img id="eye-icon" src="{{ asset('images/cerrado.svg') }}" />
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
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960"
                                        width="22">
                                        <path
                                            d="M280-400q-33 0-56.5-23.5T200-480q0-33 23.5-56.5T280-560q33 0 56.5 23.5T360-480q0 33-23.5 56.5T280-400Zm0 160q-100 0-170-70T40-480q0-100 70-170t170-70q67 0 121.5 33t86.5 87h352l120 120-180 180-80-60-80 60-85-60h-47q-32 54-86.5 87T280-240Zm0-80q56 0 98.5-34t56.5-86h125l58 41 82-61 71 55 75-75-40-40H435q-14-52-56.5-86T280-640q-66 0-113 47t-47 113q0 66 47 113t113 47Z" />
                                    </svg>
                                </span>
                                <button type="button" onclick="verClaveRestConfirm()">
                                    <span>
                                        <img id="eye-icon-confirm" src="{{ asset('images/cerrado.svg') }}" />
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
