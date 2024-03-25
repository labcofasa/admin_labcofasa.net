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
                                @if ($usuario->perfil && $usuario->perfil->imagen)
                                    <img class="imagen-perfil  rounded-circle"
                                        src="{{ asset('images/usuarios/imagen/' . $usuario->perfil->id . '/' . $usuario->perfil->imagen) }}"
                                        alt="Foto de perfil">
                                @else
                                    <img class="imagen-perfil  rounded-circle" src="{{ asset('images/defecto.png') }}"
                                        alt="Foto de perfil">
                                @endif

                            </div>

                            @if ($usuario->perfil)
                                @php
                                    $nombres = explode(' ', $usuario->perfil->nombres);
                                    $apellidos = explode(' ', $usuario->perfil->apellidos);
                                @endphp

                                <h2>{{ $nombres[0] }} {{ $apellidos[0] }}</h2>
                            @else
                                <p>Perfil no disponible</p>
                            @endif


                            <span class="small text-secondary fw-semibold">
                                {{ auth()->user()->getRoleNames()->implode(', ') }}</span>
                        </div>

                        <hr class="mb-0">
                    </div>

                    <div class="menu-bar">
                        <ul id="informacionBasica">
                            <li>
                                <a href="#informacion-basica" class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24" color="#000000" fill="none">
                                        <path
                                            d="M6.57757 15.4816C5.1628 16.324 1.45336 18.0441 3.71266 20.1966C4.81631 21.248 6.04549 22 7.59087 22H16.4091C17.9545 22 19.1837 21.248 20.2873 20.1966C22.5466 18.0441 18.8372 16.324 17.4224 15.4816C14.1048 13.5061 9.89519 13.5061 6.57757 15.4816Z"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16.5 6.5C16.5 8.98528 14.4853 11 12 11C9.51472 11 7.5 8.98528 7.5 6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5Z"
                                            stroke="currentColor" stroke-width="1.8" />
                                    </svg>
                                    <span class="link_name">Información básica</span>
                                </a>
                            </li>

                            <li>
                                <a href="#contraseña" class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24" color="#000000" fill="none">
                                        <path
                                            d="M18 10.997C17.6078 10.1968 16.5481 9.02147 14.3703 9.07148C14.3703 9.07148 12.6431 8.99646 10.6906 8.99646C8.73815 8.99646 7.82408 9.04218 6.25999 9.07148C5.25872 9.04647 3.35629 9.27153 2.48018 11.3471C1.90445 13.0976 1.87941 16.7736 2.22986 18.6241C2.30496 19.5743 2.80559 20.8997 4.35757 21.5999C5.30878 22.1 6.83573 21.9 7.9872 22M5.98465 8.19624C5.93458 5.82059 5.83445 3.94508 8.58796 2.39466C9.51414 2.01956 10.8909 1.69447 12.5931 2.49469C14.3703 3.56998 14.5917 4.70796 14.7458 4.99537C15.1713 6.12068 14.9461 7.72111 14.9961 8.37129"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                        <path
                                            d="M15.5 19.7349C15.5 20.9789 14.4911 21.9653 13.2552 21.9653C12.0194 21.9653 11 20.9789 11 19.7349C11 18.4909 12.0194 17.4912 13.2552 17.4912C14.4911 17.4912 15.5 18.4909 15.5 19.7349Z"
                                            stroke="currentColor" stroke-width="1.8" />
                                        <path
                                            d="M15.225 17.7904L17.2156 15.8477M22 15.8477L20.373 14.3084C19.6 13.5687 18.95 14.2143 18.6264 14.4901L17.2156 15.8477M17.2156 15.8477L18.825 17.393"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
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
                        <h1>Información básica</h1>
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
