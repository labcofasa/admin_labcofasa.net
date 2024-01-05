<!-- Modal de paises registrados -->
<div class="modal" id="paisModal" tabindex="-1" aria-labelledby="paisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div id="spinnerPais" class="text-center spinner">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="paisModalLabel">Paises registrados</h4>
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
                <div id="tabla-paises-container" style="display: none;">
                    <table id="tabla-paises" class="table table-sm align-middle responsive display" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Código MH</th>
                                <th>Código ISO</th>
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
            <span type="hidden" id="registrarPaisBtn"></span>
        </div>
    </div>
</div>

<!-- Modal para registrar paises -->
<div class="modal fade" id="registrarPais" tabindex="-1" role="dialog" aria-labelledby="registrarPaisLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="registrarPaisLabel">Registrar país</h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="paisForm" class="form needs-validation" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="pais-nombre-input" class="text-label">Nombre <span class="obligatorio">
                                *</span></label>
                        <input autocomplete="off" type="text" name="nombre" class="form-control"
                            id="pais-nombre-input" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="pais-codigo_mh-input" class="text-label">Código MH <span
                                        class="obligatorio"> *</span></label>
                                <input autocomplete="off" type="text" name="codigo_mh" class="form-control"
                                    id="pais-codigo_mh-input" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="pais-codigo_iso-input" class="text-label">Código ISO <span
                                        class="obligatorio"> *</span></label>
                                <input autocomplete="off" type="text" name="codigo_iso" class="form-control"
                                    id="pais-codigo_iso-input" required>
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

<!-- Modal para editar paises -->
<div class="modal fade" id="editarPais" tabindex="-1" role="dialog" aria-labelledby="editarPaisLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="editarPaisLabel">Editar país</h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="paisEditarForm" class="form needs-validation" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="btn-editar-pais" name="pais_id">
                    <div class="form-group mb-3">
                        <label for="pais-editar-nombre" class="text-label">Nombre <span class="obligatorio">
                                *</span></label>
                        <input autocomplete="off" type="text" name="nombre" class="form-control"
                            id="pais-editar-nombre" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="pais-editar-codigo_mh" class="text-label">Código MH <span
                                        class="obligatorio"> *</span></label>
                                <input autocomplete="off" type="text" name="codigo_mh" class="form-control"
                                    id="pais-editar-codigo_mh" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="pais-editar-codigo_iso" class="text-label">Código ISO <span
                                        class="obligatorio"> *</span></label>
                                <input autocomplete="off" type="text" name="codigo_iso" class="form-control"
                                    id="pais-editar-codigo_iso" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-actions btn btn-lg btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-actions btn btn-lg btn-success"
                        id="btn-editar-pais">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para confirmar la eliminación de los paises -->
<div class="modal fade" id="eliminarPais" tabindex="-1" role="dialog" aria-labelledby="eliminarPaisLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
                    Si elimina el país "<span id="nombre-pais"></span>" también se eliminarán sus departamentos y
                    municipios
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-actions btn btn-lg btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-actions btn btn-lg btn-danger"
                    id="btn-eliminar-pais">Eliminar</button>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/empresa/paises.js') }}"></script>
<script src="{{ asset('js/empresa/functions/funciones.js') }}"></script>
