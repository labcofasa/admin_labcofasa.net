@extends('layouts.autenticado')

@section('titulo', 'Mi cuenta')

@section('contenido')
    <div class="container-fluid content">
        <div class="row fila-fija">
            <div class="col-md-4 columna-fija">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="py-3" id="foto">
                                @if ($usuario->perfil->imagen)
                                    <img class="imagen-perfil rounded-circle"
                                        src="{{ asset('images/usuarios/imagen/' . $usuario->perfil->id . '/' . $usuario->perfil->imagen) }}"
                                        alt="Foto de perfil">
                                @else
                                    <img class="imagen-perfil rounded-circle" src="{{ asset('images/defecto.png') }}"
                                        alt="">
                                @endif
                            </div>

                            <h2>{{ $usuario->perfil->nombres }}</h2>
                            <span class="small text-secondary fw-semibold">
                                {{ auth()->user()->getRoleNames()->implode(', ') }}</span>
                        </div>

                        <hr class="mb-0">
                    </div>

                    <div class="menu-bar">
                        <ul id="informacionBasica">
                            <li>
                                <a href="#informacion-basica" class="d-flex align-items-center py-3">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#000000">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2m0-12C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                    <span class="link_name">Información básica</span>
                                </a>
                            </li>

                            <li>
                                <a href="#contraseña" class="d-flex align-items-center py-3">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                        height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <path
                                                d="M21,10h-8.35C11.83,7.67,9.61,6,7,6c-3.31,0-6,2.69-6,6s2.69,6,6,6c2.61,0,4.83-1.67,5.65-4H13l2,2l2-2l2,2l4-4.04L21,10z M7,15c-1.65,0-3-1.35-3-3c0-1.65,1.35-3,3-3s3,1.35,3,3C10,13.65,8.65,15,7,15z" />
                                        </g>
                                    </svg>
                                    <span class="link_name">Cambiar contraseña</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-8 columna-scroll">
                <div class="card" id="informacion-basica">
                    <div class="card-header">
                        <h1 class="py-2">Información básica</h1>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nombre" class="form-label">Código de usuario</label>
                                    <input id="nombre" value="{{ $usuario->name }}" disabled readonly autocomplete="off"
                                        type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nombres" class="form-label">Nombres</label>
                                    <input disabled readonly id="nombres" value="{{ $usuario->perfil->nombres }}"
                                        type="text" aria-label="Nombres" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Apellidos</label>
                                    <input disabled readonly id="apellido"
                                        value="{{ $usuario->perfil->apellidos ?? 'No asignado' }}" type="text"
                                        aria-label="Apellidos" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input disabled id="telefono" value="{{ $usuario->perfil->telefono ?? 'No asignado' }}"
                                        type="tel" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input disabled readonly type="email" value="{{ $usuario->email }}" autocomplete="off"
                                        class="form-control" id="email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="pais" class="form-label">País</label>
                                    <input disabled readonly type="text"
                                        value="{{ $usuario->perfil->pais->nombre ?? 'No asignado' }}" autocomplete="off"
                                        class="form-control" id="pais">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="departamento" class="form-label">Departamento</label>
                                    <input disabled readonly type="text"
                                        value="{{ $usuario->perfil->departamento->nombre ?? 'No asignado' }}"
                                        autocomplete="off" class="form-control" id="departamento">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="municipio" class="form-label">Municipio</label>
                                    <input disabled readonly type="text"
                                        value="{{ $usuario->perfil->municipio->nombre ?? 'No asignado' }}"
                                        autocomplete="off" class="form-control" id="municipio">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="direccion1" class="form-label">Dirección</label>
                                    <textarea disabled autocomplete="off" name="direccion1" class="form-control textarea-normal" id="direccion1"
                                        maxlength="255">{{ $usuario->perfil->direccion ?? 'No asignado' }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="userFormPassword" class="form needs-validation" novalidate method="POST">
                    @csrf
                    @method('POST')
                    <div class="card mt-3" id="contraseña">
                        <div class="card-header">
                            <h1>Contraseña</h1>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="current" class="form-label">Contraseña actual</label>
                                        <input type="text" name="current" autocomplete="off" class="form-control"
                                            id="current" required>
                                        <div class="invalid-feedback">Ingrese su contraseña actual</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="newPassword" class="form-label">Nueva contraseña</label>
                                        <input id="newPassword" name="newPassword" autocomplete="off" type="text"
                                            class="form-control" required>
                                        <div class="invalid-feedback">Ingrese su nueva contraseña</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                                        <input id="confirm_password" name="confirm_password" autocomplete="off"
                                            type="text" class="form-control" required>
                                        <div class="invalid-feedback">Confirme su nueva contraseña</div>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <div class="alert alert-primary" role="alert">
                                        <h5 class="mb-3 h6">Requisitos para crear una nueva contraseña:</h5>
                                        <ul>
                                            <li><span>Longitud mínima de 8 caracteres, cuantos más, mejor.</span></li>
                                            <li><span>Al menos un carácter especial.</span></li>
                                            <li><span>Al menos una letra en mayúscula.</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end my-2">
                                <button type="submit" class="btn btn-lg btn-success">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-notificaciones />

    <script src="{{ asset('js/empresa/functions/funciones.js') }}"></script>
    <script src="{{ asset('js/usuarios/perfil.js') }}"></script>
@endsection
