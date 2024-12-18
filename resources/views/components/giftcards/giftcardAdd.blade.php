<div class="modal fade" id="modalAgregarGiftCard" tabindex="-1" aria-labelledby="modalAgregarGiftCardLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md"> 
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarGiftCardLabel">Agregar Gift Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-agregar-giftcard" method="POST" action="{{ route('giftcards.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor de la Gift Card</label>
                        <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnGuardarGift" class="btn btn-success btn-sm">Agregar Gift Card</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
