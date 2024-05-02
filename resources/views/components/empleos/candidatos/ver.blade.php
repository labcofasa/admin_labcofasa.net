<div class="offcanvas offcanvas-full offcanvas-top" tabindex="-1" id="offcanvasCandidato"
    aria-labelledby="offcanvasCandidatoLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCandidatoLabel"></h5>
        <button class="btn-icon-close" data-bs-dismiss="offcanvas">
            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                fill="#000000">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
            </svg>
        </button>
    </div>
    <div class="offcanvas-body contenedor">
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="ia-tab-editar" data-bs-toggle="tab"
                    data-bs-target="#ia-tab-pane-editar" type="button" role="tab"
                    aria-controls="ia-tab-pane-editar" aria-selected="true">
                    <span>
                        Información principal
                    </span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ie-tab-editar" data-bs-toggle="tab" data-bs-target="#ie-tab-pane-editar"
                    type="button" role="tab" aria-controls="ie-tab-pane-editar" aria-selected="false">
                    <span>
                        Información del empleado
                    </span>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane active" id="ia-tab-pane-editar" role="tabpanel" aria-labelledby="ia-tab-editar"
                tabindex="0">
                <p>Uno</p>
            </div>
            <div class="tab-pane" id="ie-tab-pane-editar" role="tabpanel" aria-labelledby="ie-tab-editar"
                tabindex="0">
                <p>Dos</p>
            </div>
        </div>
    </div>
</div>
