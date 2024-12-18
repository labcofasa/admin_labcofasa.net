<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="confirmModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn {{ $buttonColor ?? 'btn-primary' }}" id="btnConfirm">Confirmar</button>
            </div>
        </div>
    </div>
</div>

{{-- uso de la notificacion
se importa el componente con el color del botón que se desea
<x-notificaciones.confirmacion buttonColor="btn-danger" />

en el js se aplica el título y el cuerpo de la notificacion, luego se muestra

$('#confirmModalLabel').text('Confirmar Eliminación'); 
    $('#confirmModalBody').text('¿Estás seguro de que deseas eliminar este proveedor?');

    $('#confirmModal').modal('show');

--}}
