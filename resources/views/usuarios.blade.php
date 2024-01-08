@extends('layouts.autenticado')

@section('titulo', 'Usuarios registrados')

@section('contenido')
    <div class="container-fluid main-container py-3">
        <div class="row g-3 pb-3">
            <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                <div class="card h-100">
                    <div class="card-body rounded-3">
                        <div class="d-flex d-sm-block">
                            <div class="p-2">
                                <p>Usuarios registrados este mes</p>
                                <p class="text-primary fs-1 fw-bold text-center">
                                    {{ $regitrosMes }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-4">
                <div class="card h-100">
                    <div class="card-body rounded-3">
                        <div class="d-flex d-sm-block">
                            <div class="p-2">
                                <p>Total de usuarios registrados</p>
                                <p class="text-primary fs-1 fw-bold text-center">
                                    {{ $usuarios }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="pb-3">@yield('titulo')</h1>

        <x-skeleton />

        <div class="table-responsive rounded-3" id="tabla-usuarios-container" style="display: none;">
            <table id="tabla-usuarios" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <span type="hidden" id="registrarUsuarioBtn"></span>
    </div>

    <x-notificaciones />

    <!-- Modal para registrar usuarios -->
    <div class="modal fade" id="registrarUsuario" tabindex="-1" role="dialog" aria-labelledby="registrarUsuarioLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo" id="registrarUsuariosLabel">Registrar usuario</h1>
                    <button class="btn-icon-close" data-bs-dismiss="modal">
                        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                            width="24px" fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                        </svg>
                    </button>
                </div>
                <form id="usuarioForm" class="form needs-validation" novalidate method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="container-fluid px-0">
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="ia-tab" data-bs-toggle="tab"
                                        data-bs-target="#ia-tab-pane" type="button" role="tab"
                                        aria-controls="ia-tab-pane" aria-selected="true">
                                        <span>
                                            Información de autenticación
                                        </span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ie-tab" data-bs-toggle="tab"
                                        data-bs-target="#ie-tab-pane" type="button" role="tab"
                                        aria-controls="ie-tab-pane" aria-selected="false">
                                        <span>
                                            Información del empleado
                                        </span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ip-tab" data-bs-toggle="tab"
                                        data-bs-target="#ip-tab-pane" type="button" role="tab"
                                        aria-controls="ip-tab-pane" aria-selected="false">
                                        <span>
                                            Información personal
                                        </span>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane active" id="ia-tab-pane" role="tabpanel" aria-labelledby="ia-tab"
                                    tabindex="0">
                                    <div class="row pt-3">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="nombre-usuario" class="text-label">Nombre de usuario
                                                    <span class="obligatorio"> *</span>
                                                </label>
                                                <input autocomplete="new-username" type="text" name="name"
                                                    class="form-control" id="nombre-usuario" required>
                                                <div class="invalid-feedback">
                                                    Ingrese un nombre válido
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="rol-usuario-select" class="text-label">Rol de usuario
                                                    <span class="obligatorio"> *</span>
                                                </label>
                                                <select name="rol" id="rol-usuario-select" class="form-control"
                                                    required>
                                                    <option value="">Seleccione un rol</option>
                                                </select>
                                                <input type="hidden" id="id-rol-usuario" name="id_rol" value="">
                                                <div class="invalid-feedback">
                                                    Seleccione un rol
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="email-usuario" class="text-label">Correo electrónico
                                                    <span class="obligatorio"> *</span></label>
                                                <input autocomplete="off" type="email" name="email"
                                                    class="form-control" id="email-usuario" required>
                                                <div class="invalid-feedback">
                                                    Ingrese un correo válido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="password" class="text-label">Contraseña
                                                    <span class="obligatorio"> *</span>
                                                </label>
                                                <input autocomplete="new-password" type="text" name="password"
                                                    class="form-control" id="password" required>
                                                <div class="invalid-feedback">
                                                    Ingrese una contraseña válida
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="ip-tab-pane" role="tabpanel" aria-labelledby="ip-tab"
                                    tabindex="0">
                                    <div class="row py-3">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="nombre-input" class="text-label">Nombres
                                                    <span class="obligatorio"> *</span></label>
                                                <input autocomplete="off" type="text" name="nombre"
                                                    class="form-control" id="nombre-input" required>
                                                <div class="invalid-feedback">
                                                    Ingrese los nombres
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="telefono-perfil" class="text-label">Teléfono</label>
                                                <input autocomplete="off" type="tel" name="telefono"
                                                    pattern="^(\+\d{1,3}[\s\-]?)?(\d{1,4}[\s\-]?){2}\d{4}$" maxlength="15"
                                                    autofocus class="form-control" id="telefono-perfil">
                                                <div class="invalid-feedback">
                                                    Ingrese un número de teléfono
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="apellido-input" class="text-label">Apellidos
                                                    <span class="obligatorio"> *</span></label>
                                                <input autocomplete="off" type="text" name="apellido"
                                                    class="form-control" id="apellido-input" required>
                                                <div class="invalid-feedback">
                                                    Ingrese los apellidos
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="pais-perfil-select" class="text-label">País
                                                </label>
                                                <select name="pais" id="pais-perfil-select" class="form-control">
                                                    <option value="">Seleccione el país</option>
                                                </select>
                                                <input type="hidden" id="id-pais-perfil-select" name="id_pais"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Seleccione el país
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="departamento-perfil-select" class="text-label">Departamento
                                                </label>
                                                <select name="departamento" id="departamento-perfil-select"
                                                    class="form-control">
                                                    <option value="">Seleccione el departamento</option>
                                                </select>
                                                <input type="hidden" id="id-departamento-perfil-select"
                                                    name="id_departamento" value="">
                                                <div class="invalid-feedback">
                                                    Seleccione el departamento
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="municipio-perfil-select" class="text-label">Municipio
                                                </label>
                                                <select name="municipio" id="municipio-perfil-select"
                                                    class="form-control">
                                                    <option value="">Seleccione el municipio</option>
                                                </select>
                                                <input type="hidden" id="id-municipio-perfil-select" name="id_municipio"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Seleccione el municipio
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="direccion-perfil" class="text-label">Dirección</label>
                                                <textarea autocomplete="off" name="direccion" class="form-control textarea-normal" id="direccion-perfil"
                                                    maxlength="255"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="imagen-perfil" class="text-label">Foto de perfil</label>
                                                <label for="imagen-perfil" class="file-upload-image">
                                                    <span class="text-label-image">Clic para seleccionar la imagen</span>
                                                    <p class="image-perfil-name"></p>
                                                </label>
                                                <input type="file" name="imagen"
                                                    accept=".jpg, .jpeg, .png, .gif, .webp" id="imagen-perfil"
                                                    class="file-upload-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="ie-tab-pane" role="tabpanel" aria-labelledby="ie-tab"
                                    tabindex="0">
                                    <div class="row py-3">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="empresa-usuario-select" class="text-label">Empresa
                                                    <span class="obligatorio"> *</span>
                                                </label>
                                                <select name="empresa" id="empresa-usuario-select" class="form-control"
                                                    required>
                                                    <option value="">Seleccione una empresa</option>
                                                </select>
                                                <input type="hidden" id="id-empresa-usuario" name="id_empresa"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Seleccione una empresa
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-actions btn btn-lg btn-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn-actions btn btn-lg btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar usuarios -->
    <div class="modal fade" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo" id="editarUsuariosLabel">Editar usuario</h1>
                    <button class="btn-icon-close" data-bs-dismiss="modal">
                        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                            width="24px" fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                        </svg>
                    </button>
                </div>
                <form id="editarUsuarioForm" class="form needs-validation" novalidate method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="btn-editar-usuario" name="usuario_id">
                        <div class="container-fluid px-0">
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="ia-tab-editar" data-bs-toggle="tab"
                                        data-bs-target="#ia-tab-pane-editar" type="button" role="tab"
                                        aria-controls="ia-tab-pane-editar" aria-selected="true">
                                        <span>
                                            Información de autenticación
                                        </span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ie-tab-editar" data-bs-toggle="tab"
                                        data-bs-target="#ie-tab-pane-editar" type="button" role="tab"
                                        aria-controls="ie-tab-pane-editar" aria-selected="false">
                                        <span>
                                            Información del empleado
                                        </span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ip-tab-editar" data-bs-toggle="tab"
                                        data-bs-target="#ip-tab-pane-editar" type="button" role="tab"
                                        aria-controls="ip-tab-pane-editar" aria-selected="false">
                                        <span>
                                            Información personal
                                        </span>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane active" id="ia-tab-pane-editar" role="tabpanel"
                                    aria-labelledby="ia-tab-editar" tabindex="0">
                                    <div class="row pt-3">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="nombre-usuario-editar" class="text-label">Nombre de usuario
                                                    <span class="obligatorio"> *</span>
                                                </label>
                                                <input autocomplete="new-username" type="text" name="name"
                                                    class="form-control" id="nombre-usuario-editar" required>
                                                <div class="invalid-feedback">
                                                    Ingrese un nombre válido
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="rol-usuario-select-editar" class="text-label">Rol de usuario
                                                    <span class="obligatorio"> *</span>
                                                </label>
                                                <select name="rol" id="rol-usuario-select-editar"
                                                    class="form-control" required>
                                                </select>
                                                <input type="hidden" id="id-rol-usuario-editar" name="id_rol"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Seleccione un rol
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="email-usuario-editar" class="text-label">Correo electrónico
                                                    <span class="obligatorio"> *</span></label>
                                                <input autocomplete="off" type="email" name="email"
                                                    class="form-control" id="email-usuario-editar" required>
                                                <div class="invalid-feedback">
                                                    Ingrese un correo válido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="new-password-input" class="text-label">Contraseña</label>
                                                <input autocomplete="new-password" type="text" name="password"
                                                    class="form-control" id="new-password-input">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password_confirmation" class="text-label">Confirmar
                                                    Contraseña</label>
                                                <input autocomplete="new-password" type="text"
                                                    name="password_confirmation" class="form-control"
                                                    id="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="ip-tab-pane-editar" role="tabpanel"
                                    aria-labelledby="ip-tab-editar" tabindex="0">
                                    <div class="row py-3">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="nombre-input-editar" class="text-label">Nombres
                                                    <span class="obligatorio"> *</span></label>
                                                <input autocomplete="off" type="text" name="nombre"
                                                    class="form-control" id="nombre-input-editar" required>
                                                <div class="invalid-feedback">
                                                    Ingrese los nombres
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="telefono-perfil-editar" class="text-label">Teléfono</label>
                                                <input autocomplete="off" type="tel" name="telefono"
                                                    pattern="^(\+\d{1,3}[\s\-]?)?(\d{1,4}[\s\-]?){2}\d{4}$" maxlength="15"
                                                    autofocus class="form-control" id="telefono-perfil-editar">
                                                <div class="invalid-feedback">
                                                    Ingrese un número de teléfono
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="apellido-input-editar" class="text-label">Apellidos
                                                    <span class="obligatorio"> *</span></label>
                                                <input autocomplete="off" type="text" name="apellido"
                                                    class="form-control" id="apellido-input-editar">
                                                <div class="invalid-feedback">
                                                    Ingrese los apellidos
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="editar-pais-perfil-select" class="text-label">País
                                                </label>
                                                <select name="pais" id="editar-pais-perfil-select"
                                                    class="form-control">
                                                    <option value="">Seleccione el país</option>
                                                </select>
                                                <input type="hidden" id="id-editar-pais-perfil-select" name="id_pais"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Seleccione el país
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="editar-departamento-perfil-select"
                                                    class="text-label">Departamento
                                                </label>
                                                <select name="departamento" id="editar-departamento-perfil-select"
                                                    class="form-control">
                                                    <option value="">Seleccione el departamento</option>
                                                </select>
                                                <input type="hidden" id="id-editar-departamento-perfil-select"
                                                    name="id_departamento" value="">
                                                <div class="invalid-feedback">
                                                    Seleccione el departamento
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="editar-municipio-perfil-select" class="text-label">Municipio
                                                </label>
                                                <select name="municipio" id="editar-municipio-perfil-select"
                                                    class="form-control">
                                                    <option value="">Seleccione el municipio</option>
                                                </select>
                                                <input type="hidden" id="id-editar-municipio-perfil-select"
                                                    name="id_municipio" value="">
                                                <div class="invalid-feedback">
                                                    Seleccione el municipio
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="direccion-perfil-editar" class="text-label">Dirección</label>
                                                <textarea autocomplete="off" name="direccion" class="form-control textarea-normal" id="direccion-perfil-editar"
                                                    maxlength="255"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="imagen-perfil-editar" class="text-label">Foto de
                                                    perfil</label>
                                                <label for="imagen-perfil-editar" class="file-upload-image">
                                                    <span class="text-label-image">Clic para seleccionar la nueva
                                                        imagen</span>
                                                    <p class="image-perfil-name"></p>
                                                </label>
                                                <input type="file" name="imagen"
                                                    accept=".jpg, .jpeg, .png, .gif, .webp" id="imagen-perfil-editar"
                                                    class="file-upload-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="ie-tab-pane-editar" role="tabpanel"
                                    aria-labelledby="ie-tab-editar" tabindex="0">
                                    <div class="row py-3">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="empresa-usuario-editar" class="text-label">Empresa
                                                    <span class="obligatorio"> *</span>
                                                </label>
                                                <select name="empresa" id="empresa-usuario-editar" class="form-control"
                                                    required>
                                                </select>
                                                <input type="hidden" id="id-empresa-usuario-editar" name="id_empresa"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Seleccione una empresa
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-actions btn btn-lg btn-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn-actions btn btn-lg btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para confirmar la eliminación de usuarios -->
    <div class="modal fade" id="eliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="eliminarUsuarioLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo" id="eliminarUsuarioLabel">Confirmar eliminación</h1>
                    <button class="btn-icon-close" data-bs-dismiss="modal">
                        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                            width="24px" fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <span class="mt-3">
                            ¿Está seguro de que desea eliminar el usuario: "<span class="nombre-usuario"></span>"?
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-actions btn btn-lg btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn-actions btn btn-lg btn-danger"
                        id="btn-eliminar-usuario">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/usuarios/usuarios.js') }}" async></script>
    <script src="{{ asset('js/roles_permisos/roles.js') }}" async></script>
    <script src="{{ asset('js/empresa/functions/funciones.js') }}" async></script>

@endsection
