<div class="modal fade" id="modalLiquidarGiftCard" tabindex="-1" aria-labelledby="modalLiquidarGiftCardLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h3 class="modal-title" id="modalLiquidarGiftCardLabel">Liquidar Gift Card</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-liquidar-giftcard" method="POST" action="">
                    @csrf
                    <div class="row">
                        <!-- Primera fila -->
                        <div class="col-md-6">
                            <!-- Cliente input box combined with select -->
                            <div class="mb-3 position-relative">
                                <label for="clienteInputLiquidar" class="form-label">Cliente:</label>
                                <input type="text" id="clienteInputLiquidar" class="form-control" placeholder="Escriba el nombre del establecimiento o código" autocomplete="off">
                                <input type="hidden" id="clienteIdHidden" name="cliente_id">
                                <div id="clientesLiquidarDropdown" class="dropdown-menu" style="display: none; position: absolute; width: 100%;"></div>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <!-- Vendedor -->
                            <div class="mb-3">
                                <label for="nombreVendedorLiquidar" class="form-label">Vendedor:</label>
                                <h6 id="nombreVendedorLiquidar"></h6>
                                <input type="hidden" id="idVendedorLiquidar" name="idVendedorLiquidar">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Segunda fila -->
                        <div class="col-md-4">
                            <!-- Gift Card select -->
                            <div class="mb-3">
                                <label for="giftCardSelectLiquidar" class="form-label">Gift Card:</label>
                                <select id="giftCardSelectLiquidar" name="giftCardSelectLiquidar" class="form-select">
                                    <option selected disabled>Seleccione una Gift Card</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <!-- Cantidad de Giftcards a liquidar -->
                            <div class="mb-3">
                                <label for="cantidadGift" class="form-label">Cantidad de Giftcards a liquidar:</label>
                                <input type="number" id="cantidadGift" name="cantidadGift" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- fecha del Movimiento -->
                            <div class="mb-3">
                                <label for="fechaMov" class="form-label">Fecha del Movimiento</label>
                                <input type="date" id="fechaMov" name="fechaMov" class="form-control">
                            </div>
                        </div>
                    </div>
                    

                    <!-- Producto y Cantidad group -->
                    <div id="productos-container">

                    </div>

                    <button type="button" id="addProductBtn" class="btn btn-sm btn-primary mb-3">Agregar Producto</button>

                    <!-- Modal footer with actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnLiquidarGift" class="btn btn-success btn-sm">Liquidar Gift Card</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<datalist id="productosLiquidar"></datalist>