<!-- Modal para editar las respuestas del formulario conozca a su cliente -->
<div class="modal fade" id="editarFormulario" tabindex="-1" role="dialog" aria-labelledby="editarFormularioLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo" id="editarFormularioLabel">Cliente NRC: <span id="cliente"></span>
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
            <form id="formularioEditarForm" class="form needs-validation" novalidate method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="btn-editar-formulario" name="frm_conozca_cliente_id">
                    <span>Información Persona Natural - Representante Legal</span>
                    <div class="form pt-3">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="codigo_cliente_editar" class="form-label">Código de cliente</label>
                                    <input type="text" id="codigo_cliente_editar" name="codigo_cliente"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="tipo_editar" class="form-label">Tipo</label>
                                    <select class="form-select" id="tipo_editar" name="tipo_editar">
                                        <option value="">Seleccione el tipo</option>
                                        <option value="Cliente">Cliente</option>
                                        <option value="Proveedor">Proveedor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="tipo_persona_editar" class="form-label">Tipo de persona</label>
                                    <select class="form-select" id="tipo_persona_editar" name="tipo_persona_editar">
                                        <option value="">Seleccione el tipo</option>
                                        <option value="Persona Natural">Persona Natural</option>
                                        <option value="Persona Jurídica">Persona Jurídica</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="nombre_cliente_editar" class="form-label">Nombres</label>
                                    <input type="text" id="nombre_cliente_editar" name="nombre_cliente_editar"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="apellido_cliente_editar" class="form-label">Apellidos</label>
                                    <input type="text" id="apellido_cliente_editar" name="apellido_cliente_editar"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="fecha_de_nacimiento_editar" class="form-label">Fecha de
                                        nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_de_nacimiento_editar"
                                        name="fecha_de_nacimiento_editar">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="nacionalidad_editar" class="form-label">Nacionalidad</label>
                                    <input type="text" id="nacionalidad_editar" name="nacionalidad_editar"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="profesion_u_oficio_editar" class="form-label">Profesión u oficio</label>
                                    <input type="text" id="profesion_u_oficio_editar"
                                        name="profesion_u_oficio_editar" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="pais_editar" class="form-label">País</label>
                                    <select name="pais_editar" id="pais_editar" class="form-control">
                                        <option value="">Seleccione el país</option>
                                    </select>
                                    <input type="hidden" id="id_editar_pais" name="pais_editar_id" value="">
                                    <div class="invalid-feedback">
                                        Seleccione el país
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="departamento_editar" class="form-label">Departamento</label>
                                    <select name="departamento_editar" id="departamento_editar" class="form-control">
                                        <option value="">Seleccione el departamento</option>
                                    </select>
                                    <input type="hidden" id="id_departamento_editar" name="departamento_editar_id"
                                        value="">
                                    <div class="invalid-feedback">
                                        Seleccione un departamento
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="municipio_editar" class="form-label">Municipio</label>
                                    <select name="municipio_editar" id="municipio_editar" class="form-control">
                                        <option value="">Seleccione el municipio</option>
                                    </select>
                                    <input type="hidden" id="id_municipio_editar" name="municipio_editar_id"
                                        value="">
                                    <div class="invalid-feedback">
                                        Seleccione un municipio
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="tipo_de_documento_editar" class="form-label">Tipo de documento</label>
                                    <select class="form-select" id="tipo_de_documento_editar"
                                        name="tipo_de_documento_editar">
                                        <option value="">Seleccione el documento</option>
                                        <option value="DUI">DUI</option>
                                        <option value="NIT">NIT</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                        <option value="Tarjeta de Residente">Tarjeta de Residente</option>
                                        <option value="Documento Diplomático">Documento Diplomático</option>
                                        <option value="Carnet de Minoridad">Carnet de Minoridad</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="numero_de_documento_editar" class="form-label">Número de
                                        documento</label>
                                    <input type="text" id="numero_de_documento_editar"
                                        name="numero_de_documento_editar" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="fecha_de_vencimiento_editar" class="form-label">Fecha de
                                        vencimiento</label>
                                    <input type="date" class="form-control" id="fecha_de_vencimiento_editar"
                                        name="fecha_de_vencimiento_editar">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="registro_iva_nrc_editar" class="form-label">Registro IVA (NRC)</label>
                                    <input type="text" id="registro_iva_nrc_editar" name="registro_iva_nrc_editar"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="correo_editar" class="form-label">Correo electrónico</label>
                                    <input type="text" id="correo_editar" name="correo_editar"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="telefono_editar" class="form-label">Teléfono</label>
                                    <input type="text" id="telefono_editar" name="telefono_editar"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="fecha_de_nombramiento_editar" class="form-label">Fecha de
                                        nombramiento</label>
                                    <input type="date" class="form-control" id="fecha_de_nombramiento_editar"
                                        name="fecha_de_nombramiento_editar">
                                    <div class="valid-feedback">
                                        Campo opcional.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="giro-formulario-editar" class="form-label">Actividad Económica</label>
                                    <div class="input-container">
                                        <input type="text" id="giro-formulario-editar" class="form-control"
                                            placeholder="Escriba para buscar actividades económicas"
                                            autocomplete="off">
                                        <div id="giro-sugerencia-formulario-editar" class="sugerencia"></div>
                                        <input type="hidden" id="id-giro-formulario-editar" name="giro_id"
                                            value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="direccion_editar" class="form-label">Dirección</label>
                                    <textarea type="text" id="direccion_editar" name="direccion_editar" class="form-control"></textarea>
                                </div>
                            </div>
                            {{-- <span class="mb-3">Información Persona Jurídica</span>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="nombre_juridico_editar" class="form-label">Nombre comercial o Razón
                                        social</label>
                                    <input type="text" id="nombre_juridico_editar" name="nombre_juridico_editar"
                                        class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="clasificacion_editar" class="form-label">Tipo de contribuyente</label>
                                    <input type="text" id="clasificacion_editar" name="clasificacion_editar"
                                        class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="nacionalidad_juridico_editar" class="form-label">Nacionalidad</label>
                                    <input type="text" id="nacionalidad_juridico_editar"
                                        name="nacionalidad_juridico_editar" class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="numero_nit_juridico_editar" class="form-label">Número de NIT</label>
                                    <input type="text" id="numero_nit_juridico_editar"
                                        name="numero_nit_juridico_editar" class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="fecha_de_constitucion_editar" class="form-label">Fecha de
                                        constitución</label>
                                    <input type="text" id="fecha_de_constitucion_editar"
                                        name="fecha_de_constitucion_editar" class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="registro_nrc_juridico_editar" class="form-label">Número de registro
                                        IVA
                                        (NRC)</label>
                                    <input type="text" id="registro_nrc_juridico_editar"
                                        name="registro_nrc_juridico_editar" class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="pais_juridico_editar" class="form-label">País</label>
                                    <select name="pais_juridico_editar" id="pais_juridico_editar"
                                        class="form-control" required>
                                        <option value="">Seleccione el país</option>
                                    </select>
                                    <input type="hidden" id="id_editar_pais_juridico" name="pais_juridico_id"
                                        value="">
                                    <div class="invalid-feedback">
                                        Seleccione el país
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="departamento_juridico_editar" class="form-label">Departamento</label>
                                    <select name="departamento_juridico_editar" id="departamento_juridico_editar"
                                        class="form-control" required>
                                        <option value="">Seleccione el departamento</option>
                                    </select>
                                    <input type="hidden" id="id_departamento_juridico_editar"
                                        name="departamento_juridico_id" value="">
                                    <div class="invalid-feedback">
                                        Seleccione un departamento
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="municipio_juridico_editar" class="form-label">Municipio</label>
                                    <select name="municipio_editar" id="municipio_juridico_editar"
                                        class="form-control" required>
                                        <option value="">Seleccione el municipio</option>
                                    </select>
                                    <input type="hidden" id="id_municipio_juridico_editar"
                                        name="municipio_juridico_id" value="">
                                    <div class="invalid-feedback">
                                        Seleccione un municipio
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="telefono_juridico_editar" class="form-label">Teléfono</label>
                                    <input type="text" id="telefono_juridico_editar"
                                        name="telefono_juridico_editar" class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="sitio_web_juridico_editar" class="form-label">Sitio Web</label>
                                    <input type="text" id="sitio_web_juridico_editar"
                                        name="sitio_web_juridico_editar" class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="numero_de_fax_juridico_editar" class="form-label">Número de
                                        FAX</label>
                                    <input type="text" id="numero_de_fax_juridico_editar"
                                        name="numero_de_fax_juridico_editar" class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="giro_juridico_editar" class="form-label">Actividad económica</label>
                                    <textarea type="text" id="giro_juridico_editar" name="giro_juridico_editar" class="form-control"></textarea>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="direccion_juridico_editar" class="form-label">Dirección</label>
                                    <textarea type="text" id="direccion_juridico_editar" name="direccion_juridico_editar" class="form-control"></textarea>
                                </div>
                            </div> --}}
                            {{-- <span class="mb-3">Información de la Administración, sus Accionistas o Miembros</span>
                            <div id="camposAccionistaEditar"></div>
                            <span class="mb-3">Miembros de la Junta Directiva, Administrador Único, Alta Gerencia o
                                máximo órgano de Control en la Sociedad.</span>
                            <div id="camposMiembroEditar"></div>
                            <span class="mb-3">Declaración jurada de origin de fondos</span>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="monto_proyectado_editar" class="form-label">Monto proyectado
                                        mensual</label>
                                    <input type="text" class="form-control" id="monto_proyectado_editar"
                                        name="monto_proyectado_editar">
                                </div>
                            </div> --}}
                            {{-- <span class="mb-3">Formulario de Identificación de Personas Expuestas
                                Políticamente</span>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="cargo_publico_editar" class="form-label">Es persona políticamente
                                        expuestas</label>
                                    <input type="text" id="cargo_publico_editar" name="cargo_publico_editar"
                                        class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="familiar_publico_editar" class="form-label">Tiene algún familiar en
                                        cargos
                                        públicos</label>
                                    <input type="text" id="familiar_publico_editar" name="familiar_publico_editar"
                                        class="form-control">
                                </div>
                            </div>
                            <span class="mb-3">Identificación General del Titular</span> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="nombre_politico_editar" class="form-label">Nombre</label>
                                    <input type="text" id="nombre_politico_editar" name="nombre_politico_editar"
                                        class="form-control">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="nombre_cargo_politico_editar" class="form-label">Nombre del
                                        cargo</label>
                                    <input type="text" class="form-control" id="nombre_cargo_politico_editar"
                                        name="nombre_cargo_politico_editar">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="fecha_desde_politico_editar" class="form-label">Fecha de
                                        nombramiento</label>
                                    <input type="text" class="form-control" id="fecha_desde_politico_editar"
                                        name="fecha_desde_politico_editar">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="fecha_hasta_politico_editar" class="form-label">Período de
                                        nombramiento</label>
                                    <input type="text" class="form-control" id="fecha_hasta_politico_editar"
                                        name="fecha_hasta_politico_editar">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="pais_politico_editar" class="form-label">País donde ejerce/ejerció el
                                        cargo</label>
                                    <select name="pais_politico_editar" id="pais_politico_editar"
                                        class="form-control" required>
                                        <option value="">Seleccione el país</option>
                                    </select>
                                    <input type="hidden" id="id_editar_pais_politico" name="pais_politico_id"
                                        value="">
                                    <div class="invalid-feedback">
                                        Seleccione el país
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="departamento_politico_editar" class="form-label">Departamento</label>
                                    <select name="departamento_politico_editar" id="departamento_politico_editar"
                                        class="form-control" required>
                                        <option value="">Seleccione el departamento</option>
                                    </select>
                                    <input type="hidden" id="id_departamento_politico_editar"
                                        name="departamento_politico_id" value="">
                                    <div class="invalid-feedback">
                                        Seleccione un departamento
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="municipio_politico_editar" class="form-label">Municipio</label>
                                    <select name="municipio_politico_editar" id="municipio_politico_editar"
                                        class="form-control" required>
                                        <option value="">Seleccione el municipio</option>
                                    </select>
                                    <input type="hidden" id="id_municipio_politico_editar"
                                        name="municipio_politico_id" value="">
                                    <div class="invalid-feedback">
                                        Seleccione un municipio
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="nombre_cliente_politico_editar" class="form-label">Nombre del
                                        cliente</label>
                                    <input type="text" class="form-control" id="nombre_cliente_politico_editar"
                                        name="nombre_cliente_politico_editar">
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="porcentaje_participacion_politico_editar"
                                        class="form-label">Porcentaje de
                                        participación</label>
                                    <input type="text" class="form-control"
                                        id="porcentaje_participacion_politico_editar"
                                        name="porcentaje_participacion_politico_editar">
                                </div>
                            </div> --}}
                            {{-- <span class="mb-3">Información de Parientes y Asociados Comerciales o de Negocios</span>
                            <span class="mb-3">Parientes en Primer y Segundo grado de Consanguinidad.</span>
                            <div id="camposParienteEditar"></div>
                            <span class="mb-3">Asociados Comerciales o de Negocios (Sociedades en las que posee 25% o
                                más
                                del Patrimonio)</span>
                            <div id="camposSocioEditar"></div>
                            <span class="mb-3">Fuentes de ingresos.</span> --}}
                            {{-- <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="fuente_ingreso_editar" class="form-label">Principales fuentes de
                                        ingresos</label>
                                    <textarea class="form-control" id="fuente_ingreso_editar" name="fuente_ingreso_editar"></textarea>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="monto_mensual_editar" class="form-label">Monto aproximado de ingresos
                                        mensuales</label>
                                    <input type="text" class="form-control" id="monto_mensual_editar"
                                        name="monto_mensual_editar">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-actions btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-actions btn btn-lg btn-success"
                        id="btn-editar-formulario">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
