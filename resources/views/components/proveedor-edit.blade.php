<div class="modal fade" id="proveedorEditModal" tabindex="-1" role="dialog" aria-labelledby="proveedorEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title" id="proveedorEditModalLabel">Editar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="formProveedorEdit">
                    <input type="hidden" name="idProveedor"> <!-- Campo oculto para el ID -->
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                    <div class="form-group mb-3">
                        <label for="ubicacion">Ubicación</label>
                        <textarea class="form-control" name="ubicacion" rows="3" ></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="NIT">NIT</label>
                        <input type="text" class="form-control" name="NIT" >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarCambios" >Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<style>
    .close span {
        font-size: 2rem; /* Cambia el tamaño a tu gusto */
    }
</style>
