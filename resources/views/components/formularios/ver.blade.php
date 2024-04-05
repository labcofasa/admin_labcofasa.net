<!-- Modal para ver datos por id de las respuestas del formulario conozca a su cliente -->
<div class="modal fade" id="verRespuestaFcc" tabindex="-1" role="dialog" aria-labelledby="verRespuestaFccLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="verRespuestaFccLabel">Cliente NRC: <span id="cliente"></span>
                </h1>
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
                <span>Información Persona Natural - Representante Legal</span>
                <div class="form pt-3">
                    <div class="row">
                        <input type="hidden" id="frm_cccid" name="frm_conozca_cliente_id">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <input type="text" id="tipo" name="tipo" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="tipo_persona" class="form-label">Tipo de cliente</label>
                                <input type="text" id="tipo_persona" name="tipo_persona" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="nombre_cliente" class="form-label">Nombres</label>
                                <input type="text" id="nombre_cliente" name="nombre_cliente" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="apellido_cliente" class="form-label">Apellidos</label>
                                <input type="text" id="apellido_cliente" name="apellido_cliente" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="fecha_de_nacimiento" class="form-label">Fecha de nacimiento</label>
                                <input type="text" id="fecha_de_nacimiento" name="fecha_de_nacimiento"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <input type="text" id="nacionalidad" name="nacionalidad" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="profesion_u_oficio" class="form-label">Profesión u oficio</label>
                                <input type="text" id="profesion_u_oficio" name="profesion_u_oficio"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="pais" class="form-label">País</label>
                                <input type="text" id="pais" name="pais" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="departamento" class="form-label">Departamento</label>
                                <input type="text" id="departamento" name="departamento" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="municipio" class="form-label">Municipio</label>
                                <input type="text" id="municipio" name="municipio" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="tipo_de_documento" class="form-label">Tipo de documento</label>
                                <input type="text" id="tipo_de_documento" name="tipo_de_documento"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="numero_de_documento" class="form-label">Número de documento</label>
                                <input type="text" id="numero_de_documento" name="numero_de_documento"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="fecha_de_vencimiento" class="form-label">Fecha de vencimiento</label>
                                <input type="text" id="fecha_de_vencimiento" name="fecha_de_vencimiento"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="registro_iva_nrc" class="form-label">Registro IVA (NRC)</label>
                                <input type="text" id="registro_iva_nrc" name="registro_iva_nrc"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="text" id="correo" name="correo" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="fecha_de_nombramiento" class="form-label">Fecha de nombramiento</label>
                                <input type="text" id="fecha_de_nombramiento" name="fecha_de_nombramiento"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="actividad_economica" class="form-label">Actividad económica</label>
                                <textarea type="text" id="actividad_economica" name="actividad_economica" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <textarea type="text" id="direccion" name="direccion" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <span class="mb-3">Información Persona Jurídica</span>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="nombre_juridico" class="form-label">Nombre comercial o Razón
                                    social</label>
                                <input type="text" id="nombre_juridico" name="nombre_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="clasificacion" class="form-label">Tipo de contribuyente</label>
                                <input type="text" id="clasificacion" name="clasificacion" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="nacionalidad_juridico" class="form-label">Nacionalidad</label>
                                <input type="text" id="nacionalidad_juridico" name="nacionalidad_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="numero_nit_juridico" class="form-label">Número de NIT</label>
                                <input type="text" id="numero_nit_juridico" name="numero_nit_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="fecha_de_constitucion" class="form-label">Fecha de constitución</label>
                                <input type="text" id="fecha_de_constitucion" name="fecha_de_constitucion"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="registro_nrc_juridico" class="form-label">Número de Registro IVA
                                    (NRC)</label>
                                <input type="text" id="registro_nrc_juridico" name="registro_nrc_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="pais_juridico" class="form-label">País</label>
                                <input type="text" id="pais_juridico" name="pais_juridico" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="departamento_juridico" class="form-label">Departamento</label>
                                <input type="text" id="departamento_juridico" name="departamento_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="municipio_juridico" class="form-label">Municipio</label>
                                <input type="text" id="municipio_juridico" name="municipio_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="telefono_juridico" class="form-label">Teléfono</label>
                                <input type="text" id="telefono_juridico" name="telefono_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="sitio_web_juridico" class="form-label">Sitio Web</label>
                                <input type="text" id="sitio_web_juridico" name="sitio_web_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="numero_de_fax_juridico" class="form-label">Número de FAX</label>
                                <input type="text" id="numero_de_fax_juridico" name="numero_de_fax_juridico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="giro_juridico" class="form-label">Actividad económica</label>
                                <textarea type="text" id="giro_juridico" name="giro_juridico" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="direccion_juridico" class="form-label">Dirección</label>
                                <textarea type="text" id="direccion_juridico" name="direccion_juridico" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <span class="mb-3">Información de la Administración, sus Accionistas o Miembros</span>
                        <div id="camposAccionista"></div>
                        <span class="mb-3">Miembros de la Junta Directiva, Administrador Único, Alta Gerencia o
                            máximo órgano de Control en la Sociedad.</span>
                        <div id="camposMiembro"></div>
                        <span class="mb-3">Declaración jurada de origin de fondos</span>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="monto_proyectado" class="form-label">Monto proyectado mensual</label>
                                <input type="text" class="form-control" id="monto_proyectado"
                                    name="monto_proyectado" disabled>
                            </div>
                        </div>
                        <span class="mb-3">Formulario de Identificación de Personas Expuestas Políticamente</span>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="cargo_publico" class="form-label">Es persona políticamente
                                    expuestas</label>
                                <input type="text" id="cargo_publico" name="cargo_publico" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="familiar_publico" class="form-label">Tiene algún familiar en cargos
                                    públicos</label>
                                <input type="text" id="familiar_publico" name="familiar_publico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <span class="mb-3">Identificación general del titular</span>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="nombre_politico" class="form-label">Nombre</label>
                                <input type="text" id="nombre_politico" name="nombre_politico"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="nombre_cargo_politico" class="form-label">Nombre del cargo</label>
                                <input type="text" class="form-control" id="nombre_cargo_politico"
                                    name="nombre_cargo_politico" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="fecha_desde_politico" class="form-label">Fecha de nombramiento</label>
                                <input type="text" class="form-control" id="fecha_desde_politico"
                                    name="fecha_desde_politico" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="fecha_hasta_politico" class="form-label">Período de nombramiento</label>
                                <input type="text" class="form-control" id="fecha_hasta_politico"
                                    name="fecha_hasta_politico" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="pais_politico" class="form-label">País donde ejerce/ejerció el
                                    cargo</label>
                                <input type="text" class="form-control" id="pais_politico" name="pais_politico"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="departamento_politico" class="form-label">Departamento</label>
                                <input type="text" class="form-control" id="departamento_politico"
                                    name="departamento_politico" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="municipio_politico" class="form-label">Municipio</label>
                                <input type="text" class="form-control" id="municipio_politico"
                                    name="municipio_politico" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="nombre_cliente_politico" class="form-label">Nombre del cliente</label>
                                <input type="text" class="form-control" id="nombre_cliente_politico"
                                    name="nombre_cliente_politico" disabled>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="porcentaje_participacion_politico" class="form-label">Porcentaje de
                                    participación</label>
                                <input type="text" class="form-control" id="porcentaje_participacion_politico"
                                    name="porcentaje_participacion_politico" disabled>
                            </div>
                        </div>
                        <span class="mb-3">Información de Parientes y Asociados Comerciales o de Negocios</span>
                        <span class="mb-3">Parientes en Primer y Segundo Grado de Consanguinidad.</span>
                        <div id="camposPariente"></div>
                        <span class="mb-3">Asociados Comerciales o de Negocios (Sociedades en las que posee 25% o más
                            del Patrimonio)</span>
                        <div id="camposSocio"></div>
                        <span class="mb-3">Fuentes de ingresos.</span>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="fuente_ingreso" class="form-label">Principales fuentes de
                                    ingresos</label>
                                <textarea class="form-control" id="fuente_ingreso" name="fuente_ingreso" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="monto_mensual" class="form-label">Monto aproximado de ingresos
                                    mensuales</label>
                                <input type="text" class="form-control" id="monto_mensual" name="monto_mensual"
                                    disabled>
                            </div>
                        </div>
                        <span class="mb-3">Archivos adjuntos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
