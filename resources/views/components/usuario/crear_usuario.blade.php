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
