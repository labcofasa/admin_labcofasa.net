<!-- Modal -->
<div class="modal fade" id="modalAgregarProveedor" tabindex="-1" aria-labelledby="modalAgregarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarProveedorLabel">Agregar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-proveedor" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <textarea class="form-control" id="ubicacion" name="ubicacion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="NIT" class="form-label">NIT</label>
                        <input type="text" class="form-control" id="NIT" name="NIT" required>
                    </div>
                    <div class="text-end">
                        <button type="button" id="btnGuardarProv" name="btnGuardarProv" class="btn btn-success">Agregar Proveedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
