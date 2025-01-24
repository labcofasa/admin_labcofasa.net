<!-- Modal para Ver Detalle de Factura -->
<div class="modal fade" id="detalleFacturaModal" tabindex="-1" role="dialog" aria-labelledby="detalleFacturaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleFacturaModalLabel">Detalles de la Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="ComprobanteLabel"><strong>Comprobante:</strong> </p>
                <span id="modalCorrelativo"></span>
                <p class="mt-2" id="FechaLabel"><strong>Fecha de Compra:</strong> </p>
                <span id="modalFechaCompra"></span>
                <p class="mt-2"><strong>NRC del Proveedor:</strong> <span id="modalNRCProveedor"></span></p>
                <p class="mt-2"><strong>Proveedor:</strong> <span id="modalNombreProveedor"></span></p>

                <h5 class="mt-3">Detalles de la Factura:</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Valor GiftCard</th>
                        </tr>
                    </thead>
                    <tbody id="modalDetalles"></tbody>
                </table>

                <p><strong>Monto Total:</strong> <span id="modalMontoTotal"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
