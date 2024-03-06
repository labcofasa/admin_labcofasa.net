@extends('layouts.publico')

@section('titulo', 'Formulario Conozca a su Cliente y Contraparte')

@section('contenido')
    <div class="container">
        <div class="text-center">
            <img class="logo" src="{{ asset('images/cofasa.svg') }}" alt="logo">
        </div>

        <div class="titulo">Formulario "Conozca a su Cliente - Contraparte"</div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
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
            method="POST">
            @csrf
            @method('POST')
            <span>A. Información persona natural - representante legal</span>

            <div class="row pt-3">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required autofocus
                            aria-describedby="ayuda">
                        <div id="ayuda" class="form-text">
                            Nombres según documento de identidad.
                        </div>
                        <div class="invalid-feedback">
                            Por favor ingrese un nombre válido.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required
                            aria-describedby="ayuda">
                        <div id="ayuda" class="form-text">
                            Apellidos según documento de identidad.
                        </div>
                        <div class="invalid-feedback">
                            Por favor ingrese un apellido válido.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="fecha_de_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha_de_nacimiento" name="fecha_de_nacimiento"
                            required>
                        <div class="invalid-feedback">
                            Por favor ingrese la fecha de nacimiento.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
                        <div class="invalid-feedback">
                            Por favor ingrese la nacionalidad.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="profesion_u_oficicio" class="form-label">Profesión u oficio</label>
                        <input type="text" class="form-control" id="profesion_u_oficicio" name="profesion_u_oficicio"
                            required>
                        <div class="invalid-feedback">
                            Por favor ingrese la profesión u oficio.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="pais-form" class="form-label">País</label>
                        <select class="form-select" id="pais-form" required>
                            <option value="">Seleccione el país</option>
                        </select>
                        <input type="hidden" id="id-pais-form" name="pais_id" value="">
                        <div class="invalid-feedback">
                            Por favor seleccione un país.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="departamento-form" class="form-label">Departamento</label>
                        <select class="form-select" id="departamento-form" required>
                            <option value="">Seleccione el departamento</option>
                        </select>
                        <input type="hidden" id="id-departamento-form" name="departamento_id" value="">
                        <div class="invalid-feedback">
                            Por favor seleccione un país.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="municipio-form" class="form-label">Municipio</label>
                        <select class="form-select" id="municipio-form" required>
                            <option value="">Seleccione el municipio</option>
                        </select>
                        <input type="hidden" id="id-municipio-form" name="municipio_id" value="">
                        <div class="invalid-feedback">
                            Por favor seleccione un departamento.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="tipo_de_documento" class="form-label">Tipo de documento</label>
                        <select class="form-select" id="tipo_de_documento" name="tipo_de_documento" required>
                            <option value="">Seleccione el documento</option>
                            <option value="DUI">DUI</option>
                            <option value="NIT">NIT</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccione un tipo de documento.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_de_documento" class="form-label">Número de documento</label>
                        <input type="text" class="form-control" id="numero_de_documento" name="numero_de_documento"
                            required>
                        <div class="invalid-feedback">
                            Por favor ingrese el número del documento.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="fecha_de_vencimiento" class="form-label">Fecha de vencimiento</label>
                        <input type="date" class="form-control" id="fecha_de_vencimiento" name="fecha_de_vencimiento"
                            required>
                        <div class="invalid-feedback">
                            Por favor ingrese la fecha de vencimiento.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="registro_iva_nrc" class="form-label">Registro de IVA NRC</label>
                        <input type="text" class="form-control" id="registro_iva_nrc" name="registro_iva_nrc"
                            required>
                        <div class="invalid-feedback">
                            Por favor ingrese el NRC.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            autocomplete="email">
                        <div class="invalid-feedback">
                            Por favor ingrese el correo electrónico.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el número de teléfono.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="actividad_economica" class="form-label">Actividad económica</label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="actividad_economica"
                                name="actividad_economica" required aria-describedby="ayuda">
                            <div id="sugerencia-filter" class="sugerencia"></div>
                            <div id="ayuda" class="form-text">
                                Escriba para buscar una actividad económica.
                            </div>
                            <input type="hidden" id="id_actividad_economica" name="giro_id" value="">
                            <div class="invalid-feedback">
                                Por favor seleccione una actividad económica.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="fecha_de_nombramiento" class="form-label">Fecha de nombramiento</label>
                        <input type="date" class="form-control" id="fecha_de_nombramiento"
                            name="fecha_de_nombramiento" required>
                        <div class="invalid-feedback">
                            Por favor ingrese la fecha de nombramiento.
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea class="form-control" name="direccion" id="direccion" style="height: 100px" required></textarea>
                        <div class="invalid-feedback">
                            Por favor ingrese la dirección.
                        </div>
                    </div>
                </div>
                <span class="mb-3">B. Información persona jurídica</span>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nombre_comercial" class="form-label">Nombre comercial</label>
                        <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial"
                            required>
                        <div class="invalid-feedback">
                            Por favor ingrese el nombre comercial.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="tipo_de_contribuyente" class="form-label">Tipo de contribuyente</label>
                        <select class="form-select" id="tipo_de_contribuyente" aria-label="Seleccione el país" required>
                            <option value="">Seleccione el tipo</option>
                        </select>
                        <input type="hidden" id="id-tipo-de-contribuyente" name="clasificacion_id" value="">
                        <div class="invalid-feedback">
                            Por favor seleccione el tipo de contribuyente.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nacionalidad_persona_juridica" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad_persona_juridica"
                            name="nacionalidad_persona_juridica" required>
                        <div class="invalid-feedback">
                            Por favor ingrese la nacionalidad.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_de_nit" class="form-label">Número de NIT</label>
                        <input type="text" class="form-control" id="numero_de_nit" name="numero_de_nit" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el número de NIT.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="fecha_de_constitucion" class="form-label">Fecha de constitución</label>
                        <input type="date" class="form-control" id="fecha_de_constitucion"
                            name="fecha_de_constitucion" required>
                        <div class="invalid-feedback">
                            Por favor ingrese la fecha de constitución.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="registro_nrc_persona_juridica" class="form-label">Número de registro NRC</label>
                        <input type="text" class="form-control" id="registro_nrc_persona_juridica"
                            name="registro_nrc_persona_juridica" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el registro NRC.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="actividad_economica_pj" class="form-label">Actividad económica</label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="actividad_economica_pj"
                                name="actividad_economica_pj" required aria-describedby="ayuda">
                            <div id="sugerencia-filter-pj" class="sugerencia"></div>
                            <div id="ayuda" class="form-text">
                                Escriba para buscar una actividad económica.
                            </div>
                            <input type="hidden" id="id_actividad_economica_pj" name="giro_persona_juridica_id"
                                value="">
                            <div class="invalid-feedback">
                                Por favor seleccione una actividad económica.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="pais_persona_juridica" class="form-label">País</label>
                        <select class="form-select" id="pais_persona_juridica" aria-label="Seleccione el país" required>
                            <option value="">Seleccione el país</option>
                        </select>
                        <input type="hidden" id="id_pais_persona_juridica" name="pais_persona_juridica_id"
                            value="">
                        <div class="invalid-feedback">
                            Por favor seleccione un país.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="departamento_persona_juridica" class="form-label">Departamento</label>
                        <select class="form-select" id="departamento_persona_juridica"
                            aria-label="Seleccione el departamento" required>
                            <option value="">Seleccione el departamento</option>
                        </select>
                        <input type="hidden" id="id_departamento_persona_juridica"
                            name="departamento_persona_juridica_id" value="">
                        <div class="invalid-feedback">
                            Por favor seleccione un país.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="municipio_persona_juridica" class="form-label">Municipio</label>
                        <select class="form-select" id="municipio_persona_juridica" aria-label="Seleccione el municipio"
                            required>
                            <option value="">Seleccione el municipio</option>
                        </select>
                        <input type="hidden" id="id_municipio_persona_juridica" name="municipio_persona_juridica_id"
                            value="">
                        <div class="invalid-feedback">
                            Por favor seleccione un departamento.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="telefono_persona_juridica" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono_persona_juridica"
                            name="telefono_persona_juridica" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el teléfono.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="sitio_web" class="form-label">Sitio web</label>
                        <input type="url" class="form-control" id="sitio_web" name="sitio_web" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el sitio web.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_de_fax" class="form-label">Número de FAX</label>
                        <input type="text" class="form-control" id="numero_de_fax" name="numero_de_fax" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el número de FAX.
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="direccion_persona_juridica" class="form-label">Dirección</label>
                        <textarea class="form-control" id="direccion_persona_juridica" name="direccion_persona_juridica"
                            style="height: 100px" required></textarea>
                        <div class="invalid-feedback">
                            Por favor ingrese la dirección.
                        </div>
                    </div>
                </div>
                <span>C. Información de la administración, sus accionistas o miembros</span>
                <p>I. Detallar al beneficiario final, siendo esta persona natural con control igual o mayor al 10% de
                    participación
                    accionaria en la sociedad.</p>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nombre_a" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre_a" name="nombre_a[]" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el nombre.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="nacionalidad_a" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad_a" name="nacionalidad_a[]" required>
                        <div class="invalid-feedback">
                            Por favor ingrese la nacionalidad.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="numero_identidad" class="form-label">No. Identidad</label>
                        <input type="text" class="form-control" id="numero_identidad" name="numero_identidad[]" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el número de identificación.
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="porcentaje_participacion" class="form-label">Porcentaje de participación</label>
                        <input type="text" class="form-control" id="porcentaje_participacion" name="porcentaje_participacion[]" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el porcentaje.
                        </div>
                    </div>
                </div>

                <div id="campos_form"></div>

                <div class="col-md-6">
                    <button type="button" id="agregar_campos" class="btn btn-success">
                        Añadir más campos
                    </button>
                </div>
            </div>

            <div class="row text-center">
                <div class="col">
                    <button type="submit" class="btn button">Enviar formulario</button>
                </div>
            </div>

        </form>
    </div>

    <script async src="{{ asset('js/empresa/functions/funciones.js') }}"></script>
    <script async src="{{ asset('js/forms/forms_ccc.js') }}"></script>

@endsection
