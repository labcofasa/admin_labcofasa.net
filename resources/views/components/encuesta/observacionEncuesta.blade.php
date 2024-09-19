{{-- modal observaciones --}}
<div class="modal fade" id="obsModal" tabindex="-1" role="dialog" aria-labelledby="obsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="obsModalLabel">Agregar una observación</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    Si no se tienen observaciones, dejar vacío.
                </div>
                <div class="form-group">
                    <label for="description"><h5>Observaciones</h5></label>
                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="course"><h5>Curso</h5></label>
                    <input type="text" class="form-control" id="course" name="course" placeholder="Ingrese el curso">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btnGuardarObservaciones" name="btnGuardarObservaciones" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


