<!-- Modal editar empresas -->
<div class="modal fade" id="editarEmpresa" tabindex="-1" aria-labelledby="editarEmpresaLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo"></h1>
                <button class="btn-icon-close" data-bs-dismiss="modal">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <form id="empresaEditarForm" class="form needs-validation" novalidate method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <ul class="nav nav-tabs" id="myTabsEditar" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="ig-tab-editar" data-bs-toggle="tab"
                                    data-bs-target="#ig-tab-pane-editar" type="button" role="tab"
                                    aria-controls="ig-tab-pane-editar" aria-selected="true">
                                    <span>
                                        Información General
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="dc-tab-editar" data-bs-toggle="tab"
                                    data-bs-target="#dc-tab-pane-editar" type="button" role="tab"
                                    aria-controls="dc-tab-pane-editar" aria-selected="false">
                                    <span>
                                        Detalles de Contacto
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="al-tab-editar" data-bs-toggle="tab"
                                    data-bs-target="#al-tab-pane-editar" type="button" role="tab"
                                    aria-controls="al-tab-pane-editar" aria-selected="false">
                                    <span>
                                        Aspectos Legales
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="d-tab-editar" data-bs-toggle="tab"
                                    data-bs-target="#dl-tab-pane-editar" type="button" role="tab"
                                    aria-controls="dl-tab-pane-editar" aria-selected="false">
                                    <span>
                                        Declaración
                                    </span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContentEditar">
                            <div class="tab-pane active" id="ig-tab-pane-editar" role="tabpanel"
                                aria-labelledby="ig-tab-editar" tabindex="0">
                                <div class="row pt-3">
                                    <div class="col-md-4">
                                        <input type="hidden" id="btn-editar-giro" name="giro_id">
                                        <div class="form-group mb-3">
                                            <label for="nombre-empresa-editar" class="form-label">Nombre de la empresa
                                                <span class="obligatorio"> *</span></label>
                                            <input autocomplete="off" type="text" name="nombre" autofocus
                                                class="form-control" id="nombre-empresa-editar" required>
                                            <div class="invalid-feedback">
                                                Ingrese un nombre válido
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top" data-bs-title="Actividad Económica"
                                                for="giro-empresa-editar" class="form-label">Giro <span
                                                    class="obligatorio"> *</span>
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <div class="input-container">
                                                <input type="text" id="giro-empresa-editar" class="form-control"
                                                    placeholder="Escriba para buscar giros" autocomplete="off"
                                                    required>
                                                <div id="giro-sugerencia-editar" class="sugerencia"></div>
                                                <input type="hidden" id="id-giro-empresa-editar" name="id_giro"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Seleccione un giro
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="entidad-empresa-select-editar" class="form-label">Tipo de
                                                entidad
                                                <span class="obligatorio"> *</span>
                                            </label>
                                            <select name="entidad" id="entidad-empresa-select-editar"
                                                class="form-control select-entidad" required>
                                            </select>
                                            <input type="hidden" id="id-entidad-empresa-editar" name="entidad_id"
                                                value="">
                                            <div class="invalid-feedback">
                                                Seleccione una entidad
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pais-empresa-select-editar" class="form-label">País <span
                                                    class="obligatorio"> *</span></label>
                                            <select name="pais" id="pais-empresa-select-editar"
                                                class="form-control" required>
                                                <option value="">Seleccione el país</option>
                                            </select>
                                            <input type="hidden" id="id-pais-empresa-editar" name="pais_id"
                                                value="">
                                            <div class="invalid-feedback">
                                                Seleccione un país
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="depto-empresa-select-editar" class="form-label">Departamento
                                                <span class="obligatorio"> *</span></label>
                                            <select name="dpto" id="depto-empresa-select-editar"
                                                class="form-control" required>
                                                <option value="">Seleccione el departamento</option>
                                            </select>
                                            <input type="hidden" id="id-departamento-empresa-editar"
                                                name="departamento_id" value="">
                                            <div class="invalid-feedback">
                                                Seleccione un departamento
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="municipio-empresa-select-editar" class="form-label">Municipio
                                                <span class="obligatorio"> *</span></label>
                                            <select name="municipio" id="municipio-empresa-select-editar"
                                                class="form-control" required>
                                                <option value="">Seleccione el municipio</option>
                                            </select>
                                            <input type="hidden" id="id-municipio-empresa-editar"
                                                name="municipio_id" value="">
                                            <div class="invalid-feedback">
                                                Seleccione un municipio
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="direccion-textarea-editar" class="form-label">Dirección de la
                                                empresa <span class="obligatorio"> *</span></label>
                                            <textarea autocomplete="off" name="direccion" class="form-control" id="direccion-textarea-editar"
                                                required maxlength="255"></textarea>
                                            <div class="invalid-feedback">
                                                Ingrese una dirección válida
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="imagen-empresa-editar" class="form-label">Logo de la
                                                empresa</label>
                                            <label for="imagen-empresa-editar" class="file-upload-image">
                                                <span class="text-label-image-editar">Clic para seleccionar la nueva
                                                    imagen</span>
                                                <p class="image-empresa-name-editar"></p>
                                            </label>
                                            <input type="file" name="imagen"
                                                accept=".jpg, .jpeg, .png, .gif, .webp" id="imagen-empresa-editar"
                                                class="file-upload-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="dc-tab-pane-editar" role="tabpanel"
                                aria-labelledby="dc-tab-editar" tabindex="0">
                                <div class="row py-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="telefono-empresa-editar" class="form-label">Teléfono</label>
                                            <input autocomplete="off" type="tel" name="telefono"
                                                pattern="^(\+\d{1,3}[\s\-]?)?(\d{1,4}[\s\-]?){2}\d{4}$" maxlength="15"
                                                autofocus class="form-control" id="telefono-empresa-editar">
                                            <div class="invalid-feedback">
                                                Ingrese un número de teléfono
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="email-empresa-editar" class="form-label">Correo
                                                electrónico</label>
                                            <input autocomplete="off" type="email" name="email"
                                                class="form-control" id="email-empresa-editar">
                                            <div class="invalid-feedback">
                                                Ingrese una dirección de correo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="web-empresa-editar" class="form-label">Enlace URL del sitio
                                                web</label>
                                            <input autocomplete="off" type="url" name="web"
                                                class="form-control" id="web-empresa-editar">
                                            <div class="invalid-feedback">
                                                Ingrese un enlace válido
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="fs-5 titulo">Redes sociales</h1>
                                    <div id="camposEditar"></div>
                                    <div id="redes-sociales-list"></div>
                                    <div class="col-md-6 pt-2">
                                        <button type="button" id="agregarEditar" class="btn btn-success">
                                            Añadir redes sociales
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="al-tab-pane-editar" role="tabpanel"
                                aria-labelledby="al-tab-editar" tabindex="0">
                                <div class="row py-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Número de Identificación Tributaria"
                                                for="nit-empresa-editar" class="form-label">Registro NIT
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <input autocomplete="off" type="text"
                                                name="registro_nit_guiones_editar" class="form-control"
                                                id="nit-empresa-editar">
                                            <input type="hidden" name="registro_nit" id="nit-empresa-editar-hidden">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top" data-bs-title="Número de Registro de Contribuyente"
                                                for="registro-nrc-empresa-editar" class="form-label">Registro NRC
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <input autocomplete="off" type="text" name="registro_nrc"
                                                class="form-control" id="registro-nrc-empresa-editar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Dirección Nacional de Medicamentos"
                                                for="nombre-dnm-empresa-editar" class="form-label">Nombre DNM
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <input autocomplete="off" type="text" name="nombre_dnm"
                                                class="form-control" id="nombre-dnm-empresa-editar">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="fundacion-empresa-editar" class="form-label">Fecha de inicio
                                                de
                                                operaciones</label>
                                            <input type="date" autocomplete="off" id="fundacion-empresa-editar"
                                                name="fundacion" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Dirección Nacional de Medicamentos"
                                                for="registro-dnm-empresa-editar" class="form-label">Registro DNM
                                                <svg class="icon-btn-info" xmlns="http://www.w3.org/2000/svg"
                                                    height="24px" viewBox="0 0 24 24" width="24px"
                                                    fill="#000000">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                </svg>
                                            </label>
                                            <input autocomplete="off" type="text" name="registro_dnm"
                                                class="form-control" id="registro-dnm-empresa-editar">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="clasificacion-empresa-select-editar"
                                                class="form-label">Clasificación <span class="obligatorio">
                                                    *</span></label>
                                            <select name="clasificacion" id="clasificacion-empresa-select-editar"
                                                class="form-control select-clasificacion" required>
                                            </select>
                                            <input type="hidden" id="id-clasificacion-empresa-editar"
                                                name="clasificacion_id" value="">
                                            <div class="invalid-feedback">
                                                Seleccione una clasificación
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="imagen-empresa-leyenda-editar" class="form-label">Leyenda de
                                                la
                                                factura electrónica</label>
                                            <label for="imagen-empresa-leyenda-editar" class="file-upload-image">
                                                <span class="text-label-image-leyenda-editar">Clic para seleccionar la nueva
                                                    imagen</span>
                                                <p class="image-empresa-name-leyenda-editar"></p>
                                            </label>
                                            <input type="file" name="imagen_leyenda"
                                                accept=".jpg, .jpeg, .png, .gif, .webp"
                                                id="imagen-empresa-leyenda-editar" class="file-upload-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="dl-tab-pane-editar" role="tabpanel"
                                aria-labelledby="dl-tab-editar" tabindex="0">
                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="mision-textarea-editar" class="form-label">Mision de la
                                                empresa</label>
                                            <textarea autocomplete="off" name="mision" class="form-control" id="mision-textarea-editar" autofocus></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="vision-textarea-editar" class="form-label">Vision de la
                                                empresa</label>
                                            <textarea autocomplete="off" name="vision" class="form-control" id="vision-textarea-editar"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="calidad-textarea-editar" class="form-label">Política de
                                                calidad</label>
                                            <textarea autocomplete="off" name="calidad" class="form-control" id="calidad-textarea-editar"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-actions btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-actions btn btn-lg btn-success"
                        id="btn-editar-empresa">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
