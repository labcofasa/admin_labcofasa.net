<!-- Modal registrar empresas -->
<div class="modal fade" id="empresaModal" tabindex="-1" aria-labelledby="empresaModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="empresaModalLabel">Registro de empresa</h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="empresaForm" class="form needs-validation" novalidate method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="ig-tab" data-bs-toggle="tab"
                                    data-bs-target="#ig-tab-pane" type="button" role="tab"
                                    aria-controls="ig-tab-pane" aria-selected="true">
                                    <span>
                                        Información General
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="dc-tab" data-bs-toggle="tab"
                                    data-bs-target="#dc-tab-pane" type="button" role="tab"
                                    aria-controls="dc-tab-pane" aria-selected="false">
                                    <span>
                                        Detalles de Contacto
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="al-tab" data-bs-toggle="tab"
                                    data-bs-target="#al-tab-pane" type="button" role="tab"
                                    aria-controls="al-tab-pane" aria-selected="false">
                                    <span>
                                        Aspectos Legales
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="d-tab" data-bs-toggle="tab"
                                    data-bs-target="#dl-tab-pane" type="button" role="tab"
                                    aria-controls="dl-tab-pane" aria-selected="false">
                                    <span>
                                        Declaración
                                    </span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active" id="ig-tab-pane" role="tabpanel" aria-labelledby="ig-tab"
                                tabindex="0">
                                <div class="row pt-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="nombre-empresa-input" class="text-label">Nombre de la empresa
                                                <span class="obligatorio"> *</span></label>
                                            <input autocomplete="off" type="text" name="nombre" autofocus
                                                class="form-control" id="nombre-empresa-input" required>
                                            <div class="invalid-feedback">
                                                Ingrese un nombre válido
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="giro-empresa-filter" class="text-label">Actividad económica<span
                                                    class="obligatorio"> *</span>
                                            </label>
                                            <div class="input-container">
                                                <input type="text" id="giro-empresa-filter" class="form-control"
                                                    placeholder="Escriba para buscar" autocomplete="off" required>
                                                <div id="giro-sugerencia-filter" class="sugerencia"></div>
                                                <input type="hidden" id="id-giro-empresa-filter" name="id_giro"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Seleccione una actividad
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="entidad-empresa-select" class="text-label">Tipo de entidad
                                                <span class="obligatorio"> *</span>
                                            </label>
                                            <select name="entidad" id="entidad-empresa-select"
                                                class="form-control select-entidad" required>
                                                <option value="">Seleccione una entidad</option>
                                            </select>
                                            <input type="hidden" id="id-entidad-empresa" name="id_entidad"
                                                value="">
                                            <div class="invalid-feedback">
                                                Seleccione una entidad
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pais-empresa-select" class="text-label">País <span
                                                    class="obligatorio"> *</span></label>
                                            <select name="pais" id="pais-empresa-select" class="form-control"
                                                required>
                                                <option value="">Seleccione el país</option>
                                            </select>
                                            <input type="hidden" id="id-pais-empresa" name="id_pais"
                                                value="">
                                            <div class="invalid-feedback">
                                                Seleccione un país
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="depto-empresa-select" class="text-label">Departamento <span
                                                    class="obligatorio"> *</span></label>
                                            <select name="dpto" id="depto-empresa-select" class="form-control"
                                                required>
                                                <option value="">Seleccione el departamento</option>
                                            </select>
                                            <input type="hidden" id="id-departamento-empresa" name="id_departamento"
                                                value="">
                                            <div class="invalid-feedback">
                                                Seleccione un departamento
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="municipio-empresa-select" class="text-label">Municipio <span
                                                    class="obligatorio"> *</span></label>
                                            <select name="municipio" id="municipio-empresa-select"
                                                class="form-control" required>
                                                <option value="">Seleccione el municipio</option>
                                            </select>
                                            <input type="hidden" id="id-municipio-empresa" name="id_municipio"
                                                value="">
                                            <div class="invalid-feedback">
                                                Seleccione un municipio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="direccion-textarea" class="text-label">Dirección de la
                                                empresa <span class="obligatorio"> *</span></label>
                                            <textarea autocomplete="off" name="direccion" class="form-control textarea-normal" id="direccion-textarea" required
                                                maxlength="255"></textarea>
                                            <div class="invalid-feedback">
                                                Ingrese una dirección válida
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="imagen-empresa" class="text-label">Logo de la
                                                empresa</label>
                                            <label for="imagen-empresa" class="file-upload-image">
                                                <span class="text-label-image">Clic para seleccionar la imagen</span>
                                                <p class="image-empresa-name"></p>
                                            </label>
                                            <input type="file" name="imagen"
                                                accept=".jpg, .jpeg, .png, .gif, .webp" id="imagen-empresa"
                                                class="file-upload-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="dc-tab-pane" role="tabpanel" aria-labelledby="dc-tab"
                                tabindex="0">
                                <div class="row py-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="telefono-empresa" class="text-label">Teléfono</label>
                                            <input autocomplete="off" type="tel" name="telefono"
                                                pattern="^(\+\d{1,3}[\s\-]?)?(\d{1,4}[\s\-]?){2}\d{4}$" maxlength="15"
                                                autofocus class="form-control" id="telefono-empresa">
                                            <div class="invalid-feedback">
                                                Ingrese un número de teléfono
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="email-empresa" class="text-label">Correo
                                                electrónico</label>
                                            <input autocomplete="off" type="email" name="email"
                                                class="form-control" id="email-empresa">
                                            <div class="invalid-feedback">
                                                Ingrese una dirección de correo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="web-empresa" class="text-label">Enlace URL del sitio
                                                web</label>
                                            <input autocomplete="off" type="url" name="web"
                                                class="form-control" id="web-empresa">
                                            <div class="invalid-feedback">
                                                Ingrese un enlace válido
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="fs-5 titulo pb-1">Redes sociales</h1>
                                    <div class="col-md-6 pb-2">
                                        <div class="form-group mb-3">
                                            <label for="nombre-rs-empresa" class="text-label">Nombre</label>
                                            <input autocomplete="off" type="text" name="social[]"
                                                class="form-control" id="nombre-rs-empresa">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="enlace-rs-empresa" class="text-label">Enlace URL del
                                                perfil</label>
                                            <input autocomplete="off" type="url" name="enlace[]"
                                                class="form-control" id="enlace-rs-empresa">
                                            <div class="invalid-feedback">
                                                Ingrese un enlace válido
                                            </div>
                                        </div>
                                    </div>
                                    <div id="campos"></div>
                                    <div class="col-md-6">
                                        <button type="button" id="agregar" class="btn btn-success">
                                            Añadir redes sociales
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="al-tab-pane" role="tabpanel" aria-labelledby="al-tab"
                                tabindex="0">
                                <div class="row py-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Número de Identificación Tributaria"
                                                for="nit-empresa-input" class="text-label">Registro NIT
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <input autocomplete="off" type="text" name="registro_nit_guiones"
                                                class="form-control" id="nit-empresa-input">
                                            <input type="hidden" name="registro_nit" id="nit-empresa-input-hidden">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top" data-bs-title="Impuesto al Valor Agregado"
                                                for="registro-iva-empresa-input" class="text-label">Registro IVA
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <input autocomplete="off" type="text" name="registro_iva"
                                                class="form-control" id="registro-iva-empresa-input">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Dirección Nacional de Medicamentos"
                                                for="nombre-dnm-empresa-input" class="text-label">Nombre DNM
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <input autocomplete="off" type="text" name="nombre_dnm"
                                                class="form-control" id="nombre-dnm-empresa-input">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="fundacion-empresa-input" class="text-label">Fecha de inicio de
                                                operaciones</label>
                                            <input type="date" autocomplete="off" id="fundacion-empresa-input"
                                                name="fundacion" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Dirección Nacional de Medicamentos"
                                                for="registro-dnm-empresa-input" class="text-label">Registro DNM
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <input autocomplete="off" type="text" name="registro_dnm"
                                                class="form-control" id="registro-dnm-empresa-input">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="clasificacion-empresa-select" class="text-label">Clasificación
                                                <span class="obligatorio"> *</span></label>
                                            <select name="clasificacion" id="clasificacion-empresa-select"
                                                class="form-control select-clasificacion" required>
                                                <option value="">Seleccione una clasificación</option>
                                            </select>
                                            <input type="hidden" id="id-clasificacion-empresa"
                                                name="id_clasificacion" value="">
                                            <div class="invalid-feedback">
                                                Seleccione una clasificación
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="imagen-empresa-leyenda" class="text-label">Leyenda de la
                                                factura electrónica</label>
                                            <label for="imagen-empresa-leyenda" class="file-upload-image">
                                                <span class="text-label-image-leyenda">Clic para seleccionar la
                                                    imagen</span>
                                                <p class="image-empresa-name-leyenda"></p>
                                            </label>
                                            <input type="file" name="imagen_leyenda"
                                                accept=".jpg, .jpeg, .png, .gif, .webp" id="imagen-empresa-leyenda"
                                                class="file-upload-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="dl-tab-pane" role="tabpanel" aria-labelledby="dl-tab"
                                tabindex="0">
                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="mision-textarea" class="text-label">Mision de la
                                                empresa</label>
                                            <textarea autocomplete="off" name="mision" class="form-control textarea-normal" id="mision-textarea"
                                                maxlength="512" autofocus></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="vision-textarea" class="text-label">Vision de la
                                                empresa</label>
                                            <textarea autocomplete="off" name="vision" class="form-control textarea-normal" id="vision-textarea"
                                                maxlength="512"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="calidad-textarea" class="text-label">Política de
                                                calidad</label>
                                            <textarea autocomplete="off" name="calidad" class="form-control textarea-normal" id="calidad-textarea"
                                                maxlength="512"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-actions btn-secondary" id="btnCancelar"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-actions btn-lg btn-success"
                        id="btnRegistrarEmpresa">Registrar empresa</button>
                </div>
            </form>
        </div>
    </div>
</div>
