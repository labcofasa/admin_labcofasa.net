<!-- Modal para agregar un producto -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h3 class="modal-title" id="modalAgregarProductoLabel">Agregar Producto</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar producto -->
                <form id="form-agregar-producto" method="POST" action="">
                    @csrf
                    <div class="row">
                        <!-- Campo para el código de producto -->
                        <div class="mb-3">
                            <label for="productoInput" class="form-label">Código de Producto:</label>
                            <input type="text" id="productoInput" name="codigo_producto" class="form-control" placeholder="Buscar producto" autocomplete="off">
                            <!-- Lista de sugerencias (oculta por defecto) -->
                            <div id="dropdown-suggestions" class="dropdown-menu" style="display: none;"></div>
                        </div>

                        <!-- Nombre del producto seleccionado -->
                        <div class="mb-3">
                            <label for="ProductoNameLable" class="form-label">Producto:</label>
                            <span id="ProductoNameLable"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnAgregarProducto" class="btn btn-success btn-sm">Agregar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
