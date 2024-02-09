<!-- Modal para editar aplicaciones -->
<div class="modal fade" id="editarAplicacion" tabindex="-1" role="dialog" aria-labelledby="editarAplicacionLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal modal-fullscreen-md-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="editarAplicacionLabel">Editar aplicación</h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="editarAplicacionForm" class="form needs-validation" novalidate method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="btn-editar-aplicacion" name="aplicacion_id">
                    <div class="form-group mb-3">
                        <label for="nombre-aplicacion-editar" class="text-label">Nombre <span class="obligatorio">
                                *</span></label>
                        <input autocomplete="off" type="text" name="nombre_aplicacion" class="form-control"
                            id="nombre-aplicacion-editar" required>
                        <div class="invalid-feedback">
                            Ingrese un nombre válido
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="enlace-aplicacion-editar" class="text-label">Dirección URL <span
                                class="obligatorio">
                                *</span></label>
                        <input autocomplete="off" type="url" name="enlace_aplicacion" class="form-control"
                            id="enlace-aplicacion-editar" required>
                        <div class="invalid-feedback">
                            Ingrese una dirección URL válida
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="empresa-aplicacion-editar" class="text-label">Empresa
                            <span class="obligatorio"> *</span>
                        </label>
                        <select name="empresa" id="empresa-aplicacion-editar" class="form-control" required>
                            <option value="">Seleccione una empresa</option>
                        </select>
                        <input type="hidden" id="id-empresa-aplicacion-editar" name="id_empresa" value="">
                        <div class="invalid-feedback">
                            Seleccione una empresa
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="roles-editar" class="text-label">Roles de usuario <span class="obligatorio">
                                *</span>
                        </label>
                        <select class="form-control" name="roles" id="roles-editar" required multiple
                            multiselect-select-all="true">
                        </select>
                        <div class="invalid-feedback">
                            Seleccione los roles
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="imagen-aplicacion-editar" class="text-label">
                            Imagen <small>(500x500 píxeles)</small>
                        </label>
                        <label for="imagen-aplicacion-editar" class="file-upload-image">
                            <span class="text-label-imagen-editar">Hacer clic para seleccionar la nueva imagen</span>
                            <p class="imagen-aplicacion-nombre-editar"></p>
                        </label>
                        <input type="file" name="imagen_aplicacion" accept=".jpg, .jpeg, .png, .gif, .webp"
                            id="imagen-aplicacion-editar" class="file-upload-input">
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
