<!-- Modal de entidades registradas -->
<div class="modal" id="entidadModal" tabindex="-1"
    aria-labelledby="entidadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div id="spinnerEntidad" class="text-center spinner">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="entidadModalLabel">Entidades registradas</h4>
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
                <div id="tabla-entidades-container" style="display: none;">
                    <table id="tabla-entidades" class="table table-sm align-middle responsive display" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Siglas</th>
                                <th>Descripción</th>
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
            <span type="hidden" id="crearEntidadBtn"></span>
        </div>
    </div>
</div>

<!-- Modal para crear entidades -->
<div class="modal fade" id="crearEntidad" tabindex="-1" role="dialog" aria-labelledby="crearEntidadLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="crearEntidadLabel">Registrar entidad</h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="entidadForm" class="form needs-validation" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="entidad-nombre-input" class="text-label">Siglas <span class="obligatorio">
                                *</span></label>
                        <input autocomplete="off" type="text" name="nombre" class="form-control"
                            id="entidad-nombre-input" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="entidad-descripcion-textarea" class="text-label">Descripción <span
                                class="obligatorio"> *</span></label>
                        <textarea autocomplete="off" name="descripcion" class="form-control textarea-normal" id="entidad-descripcion-textarea"
                            required maxlength="255"></textarea>
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

<!-- Modal para editar entidades -->
<div class="modal fade" id="editarEntidad" tabindex="-1" role="dialog" aria-labelledby="editarEntidadLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="editarEntidadLabel">Editar entidad</h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="entidadEditarForm" class="form needs-validation" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="btn-editar-entidad" name="entidad_id">
                    <div class="form-group mb-3">
                        <label for="entidad-editar-nombre" class="text-label">Siglas <span class="obligatorio"> *</span></label>
                        <input autocomplete="off" type="text" name="nombre" class="form-control"
                            id="entidad-editar-nombre" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="entidad-editar-descripcion" class="text-label">Descripción <span class="obligatorio"> *</span></label>
                        <textarea autocomplete="off" name="descripcion" class="form-control textarea-normal" id="entidad-editar-descripcion"
                            required maxlength="255"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-actions btn btn-lg btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-actions btn btn-lg btn-success"
                        id="btn-editar-entidad">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para confirmar la eliminación de entidades -->
<div class="modal fade" id="eliminarEntidad" tabindex="-1" role="dialog" aria-labelledby="eliminarEntidadLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="eliminarEntidadLabel">Confirmar eliminación</h1>
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
                <p class="mt-3 text-center">
                    ¿Está seguro de que desea eliminar la entidad: "<span id="nombre-entidad"></span>"?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-actions btn btn-lg btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-actions btn btn-lg btn-danger"
                    id="btn-eliminar-entidad">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/empresa/entidad.js') }}"></script>
