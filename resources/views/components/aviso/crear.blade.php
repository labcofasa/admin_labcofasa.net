<!-- Modal para registrar avisos -->
<div class="modal fade" id="crearAviso" tabindex="-1" role="dialog" aria-labelledby="crearAvisoLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="crearAvisoLabel">Registrar publicidad</h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="avisoForm" class="form needs-validation" novalidate method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nombre" class="text-label">Nombre <span class="obligatorio">
                                *</span></label>
                        <input autocomplete="off" type="text" name="nombre" class="form-control"
                            id="nombre" required>
                        <div class="invalid-feedback">
                            Ingrese un nombre válido
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="aviso-imagen" class="text-label">
                            Imagen<span class="obligatorio">
                                * </span><small>(960x1200 píxeles)</small>
                        </label>
                        <label for="aviso-imagen" class="file-upload-image">
                            <span class="text-label-image">Hacer clic para seleccionar la imagen</span>
                            <p class="nombre-aviso"></p>
                        </label>
                        <input type="file" name="imagen" required accept=".jpg, .jpeg, .png, .gif, .webp"
                            id="aviso-imagen" class="file-upload-input">
                        <div class="invalid-feedback">
                            Seleccione una imagen
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
