<!-- Modal de permisos por rol -->
<div class="modal" id="permisoModal" tabindex="-1" aria-labelledby="permisoModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="permisoModalLabel"></h4>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div id="spinnerRolesPermiso" class="text-center spinner-table">
                    <div class="spinner-border-table" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div id="tabla-roles-permisos-container" style="display: none;">
                    <table id="tabla-roles-permisos" class="table table-sm align-middle responsive display"
                        width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th data-priority="1">Nombre del permiso</th>
                                <th data-priority="2">Eliminar permiso</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <span type="hidden" id="asignarPermisoBtn"></span>
        </div>
    </div>
</div>
