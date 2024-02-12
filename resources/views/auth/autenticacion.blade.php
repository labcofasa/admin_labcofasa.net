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
                                    <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960"
                                        width="22">
                                        <path
                                            d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="textbox password">
                                <input id="password" name="password" type="password" required />
                                <label for="password">Contraseña</label>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960"
                                        width="22">
                                        <path
                                            d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z" />
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
