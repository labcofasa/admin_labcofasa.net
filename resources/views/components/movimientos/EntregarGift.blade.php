<div class="modal fade" id="modalAgregarGiftCard" tabindex="-1" aria-labelledby="modalAgregarGiftCardLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h6 class="modal-title" id="modalAgregarGiftCardLabel">Asignar Gift Card al Vendedor: </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="p-3">
                <h5 id="nombreVendedor"></h5>
            </div>
            <div class="modal-body">
                <form id="form-agregar-giftcard" method="POST" action="">
                    @csrf
                    <input type="hidden" id="idVendedor" name="idVendedor" value="">
                    <input type="hidden" id="cargo" name="cargo" value="">

                    <div id="giftcard-rows-container">

                    </div>

                    <button type="button" id="btnAgregarRow" class="btn btn-secondary">Agregar Gift Card</button>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnGuardarGift" class="btn btn-success btn-sm">Asignar Gift Card</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
