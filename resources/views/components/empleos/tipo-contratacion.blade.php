<div class="offcanvas offcanvas-end offcanvas-full-screen" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title" id="offcanvasRightLabel">Tipos de contratacíon</h1>
        <button type="button" class="btn-icon-close" data-bs-dismiss="offcanvas">
            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                fill="#000000">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
            </svg>
        </button>
    </div>
    <div class="offcanvas-body vacante">
        <!-- Tabla fantasma -->
        <x-skeleton />

        <!-- Tabla usuarios -->
        <div class="offcanvas-tabla">
            <div class="table-responsive pt-2" id="tabla-contratacion-container" style="display: none;">
                <table id="tabla-tipo-contratacion" class="table align-middle responsive display" width="100%">
                    <tbody></tbody>
                </table>
            </div>

            <div class="nuevo py-4">
                <h6 class="mb-3">Crear nuevo tipo de contratacíon</h6>
                <form id="contratacionForm" action="{{ route('crear.contratacion') }}" class="form needs-validation"
                    method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="nombre_tipo" class="form-label">Tipo de contratacíon<span class="obligatorio">
                                *</span></label>
                        <input type="text" class="form-control" id="nombre_tipo" name="nombre_tipo"
                            autocomplete="off" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el tipo de contratacíon.
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" id="guardarTipoBtn" class="btn btn-lg btn-success">Guardar tipo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
