<!-- Modal de giros para empresas -->
<div class="modal" id="giroModal" tabindex="-1" aria-labelledby="giroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div id="spinnerGiro" class="text-center spinner">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="giroModalLabel">Actividades económicas para empresas</h4>
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
                <div id="tabla-giros-container" style="display: none;">
                    <table id="tabla-giros" class="table align-middle responsive display" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Código MH</th>
                                <th>Fecha creación</th>
                                <th>Usuario creador</th>
                                <th>Fecha actualización</th>
                                <th>Usuario modificador</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <span type="hidden" id="crearGirosBtn"></span>
        </div>
    </div>
</div>

<script src="{{ asset('js/empresa/giros.js') }}"></script>
