@extends('layouts.publico')

@section('titulo', 'Formulario Conozca a su Cliente y Contraparte')

@section('contenido')
    <div class="container">
        <x-formularios.encabezado />

        <h1 class="titulo">Formulario "Conozca a su Cliente"</h1>

        @if (session('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <p class="mb-4">Compañía Farmacéutica S.A. de C.V. reconoce el firme compromiso con el cumplimiento integral de
            las
            normativas
            legales vigentes. Por ello, se compromete en la aplicación de las buenas prácticas de "Conozca a su Cliente y
            Contraparte", de acuerdo con los Arts. 9-B, 10 literal A, Romano I y II de la Ley Contra el Lavado de Dinero y
            de Activos, y el Art. 4 del Reglamento de la Ley.</p>

        <form id="forms_ccc" class="form needs-validation" novalidate action="{{ route('enviar.formulario.ccc') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <span>A. Información persona natural - representante legal</span>

            <div class="row pt-3">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="tipo_persona" class="form-label">Tipo de persona</label>
                        <select class="form-select" id="tipo_persona" name="tipo_persona" required>
                            <option value="">Seleccione el tipo</option>
                            <option value="Persona natural">Persona natural</option>
                            <option value="Representante legal">Representante legal</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione el tipo de persona.
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" autofocus
                            aria-describedby="ayuda">
                        <div id="ayuda" class="form-text">
                            Nombres según documento de identidad.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" aria-describedby="ayuda">
                        <div id="ayuda" class="form-text">
                            Apellidos según documento de identidad.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="fecha_de_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha_de_nacimiento" name="fecha_de_nacimiento">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="profesion_u_oficio" class="form-label">Profesión u oficio</label>
                        <input type="text" class="form-control" id="profesion_u_oficio" name="profesion_u_oficio">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="pais" class="form-label">País</label>
                        <select class="form-select" id="pais">
                            <option value="">Seleccione el país</option>
                        </select>
                        <input type="hidden" id="id_pais" name="pais_id" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-select" id="departamento">
                            <option value="">Seleccione el departamento</option>
                        </select>
                        <input type="hidden" id="id_departamento" name="departamento_id" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="municipio" class="form-label">Municipio</label>
                        <select class="form-select" id="municipio">
                            <option value="">Seleccione el municipio</option>
                        </select>
                        <input type="hidden" id="id_municipio" name="municipio_id" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="tipo_de_documento" class="form-label">Tipo de documento</label>
                        <select class="form-select" id="tipo_de_documento" name="tipo_de_documento">
                            <option value="">Seleccione el documento</option>
                            <option value="DUI">DUI</option>
                            <option value="NIT">NIT</option>
                            <option value="CARNÉ DE RESIDENTE">CARNÉ DE RESIDENTE</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_de_documento" class="form-label">Número de documento</label>
                        <input type="text" class="form-control" id="numero_de_documento" name="numero_de_documento">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="fecha_de_vencimiento" class="form-label">Fecha de vencimiento</label>
                        <input type="date" class="form-control" id="fecha_de_vencimiento"
                            name="fecha_de_vencimiento">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="registro_iva_nrc" class="form-label">Registro de IVA (NRC)</label>
                        <input type="text" class="form-control" id="registro_iva_nrc" name="registro_iva_nrc">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="email">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="actividad_economica" class="form-label">Actividad económica</label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="actividad_economica"
                                name="actividad_economica" aria-describedby="ayuda">
                            <div id="sugerencia-filter" class="sugerencia"></div>
                            <div id="ayuda" class="form-text">
                                Escriba para buscar y seleccione la actividad económica deseada.
                            </div>
                            <input type="hidden" id="id_actividad_economica" name="giro_id" value="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="fecha_de_nombramiento" class="form-label">Fecha de nombramiento</label>
                        <input type="date" class="form-control" id="fecha_de_nombramiento"
                            name="fecha_de_nombramiento">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea class="form-control" name="direccion" id="direccion" style="height: 100px"></textarea>
                    </div>
                </div>
                <span class="mb-3">B. Información persona jurídica</span>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nombre_comercial_juridico" class="form-label">Nombre comercial</label>
                        <input type="text" class="form-control" id="nombre_comercial_juridico"
                            name="nombre_comercial_juridico">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="clasificacion_juridico_id" class="form-label">Tipo de contribuyente</label>
                        <select class="form-select" id="clasificacion_juridico_id">
                            <option value="">Seleccione el tipo</option>
                        </select>
                        <input type="hidden" id="id_clasificacion_juridico" name="clasificacion_juridico_id"
                            value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nacionalidad_juridico" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad_juridico"
                            name="nacionalidad_juridico">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_de_nit_juridico" class="form-label">Número de NIT</label>
                        <input type="text" class="form-control" id="numero_de_nit_juridico"
                            name="numero_de_nit_juridico">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="fecha_de_constitucion_juridico" class="form-label">Fecha de constitución</label>
                        <input type="date" class="form-control" id="fecha_de_constitucion_juridico"
                            name="fecha_de_constitucion_juridico">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="registro_nrc_juridico" class="form-label">Número de registro IVA (NRC)</label>
                        <input type="text" class="form-control" id="registro_nrc_juridico"
                            name="registro_nrc_juridico">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="giro_juridico" class="form-label">Actividad económica</label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="giro_juridico" name="giro_juridico"
                                aria-describedby="ayuda">
                            <div id="sugerencia_filter_juridico" class="sugerencia"></div>
                            <div id="ayuda" class="form-text">
                                Escriba para buscar y seleccione la actividad económica deseada.
                            </div>
                            <input type="hidden" id="id_giro_juridico" name="giro_juridico_id" value="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="pais_juridico" class="form-label">País</label>
                        <select class="form-select" id="pais_juridico" aria-label="Seleccione el país">
                            <option value="">Seleccione el país</option>
                        </select>
                        <input type="hidden" id="id_pais_juridico" name="pais_juridico_id" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="departamento_juridico" class="form-label">Departamento</label>
                        <select class="form-select" id="departamento_juridico" aria-label="Seleccione el departamento">
                            <option value="">Seleccione el departamento</option>
                        </select>
                        <input type="hidden" id="id_departamento_juridico" name="departamento_juridico_id"
                            value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="municipio_juridico" class="form-label">Municipio</label>
                        <select class="form-select" id="municipio_juridico" aria-label="Seleccione el municipio">
                            <option value="">Seleccione el municipio</option>
                        </select>
                        <input type="hidden" id="id_municipio_juridico" name="municipio_juridico_id" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="telefono_juridico" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_juridico" name="telefono_juridico">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="sitio_web_juridico" class="form-label">Sitio web</label>
                        <input type="url" class="form-control" id="sitio_web_juridico" name="sitio_web_juridico">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_de_fax_juridico" class="form-label">Número de FAX</label>
                        <input type="text" class="form-control" id="numero_de_fax_juridico"
                            name="numero_de_fax_juridico">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="direccion_juridico" class="form-label">Dirección</label>
                        <textarea class="form-control" id="direccion_juridico" name="direccion_juridico" style="height: 100px"></textarea>
                    </div>
                </div>
                <span>C. Información de la administración, sus accionistas o miembros</span>
                <p>I. Detallar al beneficiario final, siendo esta persona natural con control igual o mayor al 10% de
                    participación
                    accionaria en la sociedad.</p>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nombre_accionista" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre_accionista" name="nombre_accionista[]">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nacionalidad_accionista" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad_accionista"
                            name="nacionalidad_accionista[]">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_identidad_accionista" class="form-label">No. Identidad</label>
                        <input type="text" class="form-control" id="numero_identidad_accionista"
                            name="numero_identidad_accionista[]">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="porcentaje_participacion_accionista" class="form-label">Porcentaje de
                            participación</label>
                        <input type="text" class="form-control" placeholder="Ejemplo: 10%"
                            id="porcentaje_participacion_accionista" name="porcentaje_participacion_accionista[]">
                    </div>
                </div>

                <div id="campos_form"></div>

                <div class="col-md-6 mb-3">
                    <button type="button" id="agregar_campos" class="btn btn-secondary">
                        Añadir más campos
                    </button>
                </div>

                <p>II. Detallar a los miembros de la Junta Directiva, administrador único, alta gerencia o máximo órgano
                    de control en la sociedad.</p>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nombre_miembro" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre_miembro" name="nombre_miembro[]">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nacionalidad_miembro" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad_miembro"
                            name="nacionalidad_miembro[]">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_identidad_miembro" class="form-label">No. Identidad</label>
                        <input type="text" class="form-control" id="numero_identidad_miembro"
                            name="numero_identidad_miembro[]">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="cargo_miembro" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargo_miembro" name="cargo_miembro[]">
                    </div>
                </div>

                <div id="campos_miembros"></div>

                <div class="col-md-6 mb-3">
                    <button type="button" id="agregar_campos_miembros" class="btn btn-secondary">
                        Añadir más campos
                    </button>
                </div>

                <span>D. Información de Personas Expuestas Políticamente - PEP's</span>
                <p>¿Usted, o algún socio, accionista, miembro, administrador o director, desempeña o ha desempeñado algún
                    cargo como funcionario público en el país o en el extranjero?.</p>
                <div class="row justify-content-center row-cols-3 row-cols-lg-5 mb-3">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cargoPublico" id="cargoPublicoSI">
                            <label class="form-check-label mx-3" for="cargoPublicoSI">
                                SI
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cargoPublico" id="cargoPublicoNO"
                                checked>
                            <label class="form-check-label mx-3" for="cargoPublicoNO">
                                NO
                            </label>
                        </div>
                    </div>
                </div>

                <p>¿Tiene usted o algún miembro, funcionario o administrador algún familiar, hasta el 2do grado de
                    consanguinidad y afinidad, que desempeñe algún el 10% o más del capital accionario de su empresa?.</p>
                <div class="row justify-content-center row-cols-3 row-cols-lg-5 mb-4">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="capitalAccionario"
                                id="capitalAccionarioSI">
                            <label class="form-check-label mx-3" for="capitalAccionarioSI">
                                SI
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="capitalAccionario"
                                id="capitalAccionarioNO" checked>
                            <label class="form-check-label mx-3" for="capitalAccionarioNO">
                                NO
                            </label>
                        </div>
                    </div>
                </div>

                <span class="mb-2">Declaración jurada de origin de fondos</span>
                <p>a) Todos los fondos, transferencias, depósitos, productos o servicios que entreguemos tendrán un origen
                    lícito, y por ende, no estarán relacionados con los delitos de lavado de dinero y activos,
                    financiamiento al terrorismo, descritos en el artículo 6 de la Ley Contra el Lavado de Dinero y de
                    Activos, y ningún otro tipo de delito o actividad ilícita. Se permitirá cualquier procedimiento de
                    investigación por parte de la COMPAÑÍA FARMACÉUTICA S.A. de C.V. y/o las autoridades correspondientes.
                </p>
                <p>b) Manifiesto que el pago de los productos y servicios tiene origen en la actividad económica a la que me
                    dedico, y el monto proyectado de productos, compras o facturación mensual será el siguiente.</p>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="monto_proyectado" class="form-label">Monto proyectado mensual</label>
                        <input type="text" class="form-control" id="monto_proyectado" name="monto_proyectado">
                    </div>
                </div>
                <p>c) Declaro bajo juramento, por derecho propio, que someto todos los actos que realice a través de
                    cualquier operación que implique recepción, entrega o transferencia de fondos de cualquier tipo de
                    depósito, bajo cualquier modalidad con la COMPAÑÍA FARMACÉUTICA S.A. de C.V., a sus condiciones
                    contractuales y reglamentarias. Me comprometo a que todos los valores que entregue o reciba tendrán un
                    origen y un destino que de ninguna manera estarán relacionados con los delitos generados de lavado de
                    dinero y de activos descritos en la Ley Contra el Lavado de Dinero y de Activos, ni a ningún tipo de
                    actividad ilícita. Asimismo, me declaro en la disposición de permitir cualquier procedimiento de
                    investigación por parte de las autoridades correspondientes y eximo a COMPAÑÍA FARMACÉUTICA S.A. de
                    C.V., de toda responsabilidad que se derive por información errónea, falsa o inexacta que yo hubiere
                    proporcionado en este formulario.</p>

                <span class="mb-2">Documentos anexos a este formulario</span>
                <span class="mb-2 text-center">Persona natural</span>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_identidad" class="form-label">Copia de DUI, Pasaporte o Carnet de
                            Residente</label>
                        <input type="file" class="form-control" id="documento_identidad" name="documento_identidad"
                            accept=".pdf, .docx, .jpg, .png, .jpeg">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_tarjeta_registro" class="form-label">Copia Tarjeta de Registro de
                            Contribuyente (Si aplica)</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_tarjeta_registro"
                                name="documento_tarjeta_registro" accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_domicilio" class="form-label">Copia de comprobante de
                            domicilio</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_domicilio"
                                name="documento_domicilio" accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <span class="mb-2 text-center">Persona juridica</span>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_escritura" class="form-label">Copia de Escritura de Constitución (Para
                            Sociedades)</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_escritura"
                                name="documento_escritura" accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_acuerdo" class="form-label">Acuerdo ejecutivo, Decreto o Acta de
                            Constitución (para asociaciones, cooperativas, ONG's, Otros)</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_acuerdo" name="documento_acuerdo"
                                accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_nit" class="form-label">Copia de NIT y Número de Registro
                            Contribuyente</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_nit" name="documento_nit"
                                accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_credencial" class="form-label">Copia credencial de elección del
                            Representante Legal</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_credencial"
                                name="documento_credencial" accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_identificacion_representante" class="form-label">Copia de DUI, NIT del
                            Representante
                            Legal</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_identificacion_representante"
                                name="documento_identificacion_representante" accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_matricula" class="form-label">Matrícula de Comercio
                            vigente</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_matricula"
                                name="documento_matricula" accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="documento_domicilio_juridico" class="form-label">Copia de comprobante de
                            domicilio</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="documento_domicilio_juridico"
                                name="documento_domicilio_juridico" accept=".pdf, .docx, .jpg, .png, .jpeg">
                        </div>
                    </div>
                </div>
                <span class="mb-2">Por favor, adjunte su carta de responsabilidad, la cual descargó al inicio.</span>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="carta_responsabilidad" class="form-label">Carta de responsabilidad</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="carta_responsabilidad"
                                name="carta_responsabilidad" required accept=".pdf, .docx, .jpg, .png, .jpeg">
                            <div class="invalid-feedback">
                                Por favor, adjunte su carta de responsabilidad.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="campos-adicionales pt-5">
                    <x-formularios.formulario_personas_expuestas />
                </div>
            </div>

            <x-formularios.enviar />
        </form>

        <div class="row text-center">
            <div class="col">
                <button class="btn button" data-bs-toggle="modal" data-bs-target="#enviarFormulario">Enviar
                    formulario</button>
            </div>
        </div>
    </div>

    <x-formularios.modal />

    <script async src="{{ asset('js/empresa/functions/funciones.js') }}"></script>
    <script async src="{{ asset('js/forms/conozca_cliente/forms_ccc.js') }}"></script>

@endsection
