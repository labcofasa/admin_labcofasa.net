<div class="modal fade" id="modalDevolucionGiftCard" tabindex="-1" aria-labelledby="modalDevolucionGiftCardLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h6 class="modal-title" id="modalDevolucionGiftCardLabel">Devolver Gift Card del Vendedor: </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="p-3">
                <h5 id="nombreVendedorD"></h5>
            </div>
            <div class="modal-body">
                <form id="form-Devolucion-giftcard" method="POST" action="">
                    @csrf
                    <input type="hidden" id="idVendedorD" name="idVendedorD" value="">
                    <input type="hidden" id="cargoD" name="cargo" value="">

                    <div id="giftcard-rows-container-devolucion">
                        <div class="giftcard-row-dev mb-3" data-index="0">
                            <label for="giftcard-select-dev" class="form-label">Seleccione Gift Card</label>
                            <select class="form-control giftcard-select-dev" id="giftcard-select-dev" name="idGiftCarddev" required>
                            </select>
                            <div class="mb-3 mt-2">
                                <label for="cantidad-dev" class="form-label">Cantidad</label>
                                <input type="number" class="form-control cantidad" min="1" name="cantidaddev" required>
                                <span class="cantidad-error text-danger" style="display:none;">No hay suficientes giftcards disponibles</span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnGuardarGiftDev" class="btn btn-success btn-sm">Devolver Gift Cards</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
