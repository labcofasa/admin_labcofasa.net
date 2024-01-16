<!-- Modal para editar paises -->
<div class="modal fade" id="editarPais" tabindex="-1" role="dialog" aria-labelledby="editarPaisLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
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
