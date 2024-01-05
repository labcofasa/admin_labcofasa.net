<!-- Modal de departamentos por pais -->
<div class="modal" id="departamentoModal" tabindex="-1" aria-labelledby="departamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div id="spinnerDepartamento" class="text-center spinner">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="departamentoModalLabel"></h4>
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
                <div id="tabla-departamentos-container" style="display: none;">
                    <table id="tabla-departamentos" class="table table-sm align-middle responsive display"
                        width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Código MH</th>
                                <th>Fecha creación</th>
                                <th>Usuario creador</th>
                                <th>Fecha actualización</th>
                                <th>Usuario modificador</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <span type="hidden" id="registrarDepartamentoBtn"></span>
        </div>
    </div>
</div>

<!-- Modal para registrar departamentos -->
<div class="modal fade" id="registrarDepartamento" tabindex="-1" role="dialog"
    aria-labelledby="registrarDepartamentoLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="registrarDepartamentoLabel"></h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="departamentoForm" class="form needs-validation" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <input type="hidden" id="registrar-departamento" name="paises_id">
                    <div class="form-group mb-3">
                        <label for="departamento-nombre-input" class="text-label">Nombre <span class="obligatorio">
                                *</span></label>
                        <input autocomplete="off" type="text" name="nombre" class="form-control"
                            id="departamento-nombre-input" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="departamento-codigo_mh-input" class="text-label">Código MH <span
                                class="obligatorio"> *</span></label>
                        <input autocomplete="off" type="text" name="codigo_mh" class="form-control"
                            id="departamento-codigo_mh-input" required>
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

<!-- Modal para editar departamentos -->
<div class="modal fade" id="editarDepartamento" tabindex="-1" role="dialog" aria-labelledby="editarDepartamentoLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="editarPaisLabel">Editar departamento</h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="departamentoEditarForm" class="form needs-validation" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editar-departamento-id" name="departamentos_id">
                    <div class="form-group mb-3">
                        <label for="departamento-editar-nombre" class="text-label">Nombre <span class="obligatorio">
                                *</span></label>
                        <input autocomplete="off" type="text" name="nombre" class="form-control"
                            id="departamento-editar-nombre" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="departamento-editar-codigo_mh" class="text-label">Código MH <span
                                class="obligatorio"> *</span></label>
                        <input autocomplete="off" type="text" name="codigo_mh" class="form-control"
                            id="departamento-editar-codigo_mh" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-actions btn btn-lg btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-actions btn btn-lg btn-success"
                        id="btn-editar-departamento">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para confirmar la eliminación de los departamentos -->
<div class="modal fade" id="eliminarDepartamento" tabindex="-1" role="dialog"
    aria-labelledby="eliminarDepartamentoLabel" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="eliminarPaisLabel">Confirmar eliminación</h1>
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
                <p class="text-center mt-3">
                    Si elimina el departamento "<span id="nombre-departamento"></span>" también se eliminarán sus
                    municipios
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-actions btn btn-lg btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-actions btn btn-lg btn-danger"
                    id="btn-eliminar-departamento">Eliminar</button>
            </div>
        </div>
    </div>
</div>
