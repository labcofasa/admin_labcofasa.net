@extends('layouts.publico')

@section('titulo', 'Formulario Conozca a su Cliente y Contraparte')

@section('contenido')
    <div class="container">
        <div class="text-center">
            <img class="logo" src="http://127.0.0.1:8000/images/cofasa.svg" alt="logo">
        </div>

        <div class="titulo">Formulario Conozca a su Cliente y Contraparte</div>
        <p class="mb-3">Compañía Farmacéutica S.A. de C.V. reconoce el firme compromiso con el cumplimiento integral de las
            normativas
            legales vigentes. Por ello, se compromete en la aplicación de las buenas prácticas de "Conozca a su Cliente y
            Contraparte", de acuerdo con los Arts. 9-B, 10 literal A, Romano I y II de la Ley Contra el Lavado de Dinero y
            de Activos, y el Art. IV del Reglamento de la Ley.</p>
        <form action="#">
            <span>A. Información persona natural - representante legal</span>
            <div class="row py-2">
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres">
                        <label for="nombre">Nombres según DUI</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos">
                        <label for="apellido">Apellidos según DUI</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                            placeholder="Fecha de nacimiento">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad"
                            placeholder="nacionalidad">
                        <label for="nacionalidad">Nacionalidad</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="profesion_u_oficicio" name="profesion_u_oficicio"
                            placeholder="Profesión u oficio">
                        <label for="profesion_u_oficicio">Profesión u oficio</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="pais" aria-label="Seleccione el país">
                            <option selected>Seleccione el país</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="pais">País</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="departamento" aria-label="Seleccione el departamento">
                            <option selected>Seleccione el departamento</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="departamento">Departamento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="municipio" aria-label="Seleccione el municipio">
                            <option selected>Seleccione el municipio</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="municipio">Municipio</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="tipo_de_documento" aria-label="Seleccione el tipo de documento">
                            <option selected>Seleccione el documento</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="tipo_de_documento">Tipo de documento</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="numero_de_documento" name="numero_de_documento"
                            placeholder="Número de documento">
                        <label for="numero_de_documento">Número de documento</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="fecha_de_vencimiento" name="fecha_de_vencimiento"
                            placeholder="Fecha de vencimiento">
                        <label for="fecha_de_vencimiento">Fecha de vencimiento</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="registro_iva_nrc" name="registro_iva_nrc"
                            placeholder="Registro de IVA NRC">
                        <label for="registro_iva_nrc">Registro de IVA NRC</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" autocomplete="off" id="email" name="email"
                            placeholder="Correo electrónico">
                        <label for="email">Correo electrónico</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="telefono" name="telefono"
                            placeholder="Teléfono">
                        <label for="telefono">Teléfono</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="actividad_economica" aria-label="Actividad económica">
                            <option selected>Escriba para buscar</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="actividad_economica">Actividad económica</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="fecha_de_nombramiento"
                            name="fecha_de_nombramiento" placeholder="Fecha de nombramiento">
                        <label for="fecha_de_nombramiento">Fecha de nombramiento</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Dirección" id="direccion" style="height: 100px"></textarea>
                        <label for="direccion">Dirección</label>
                    </div>
                </div>
            </div>
            <span>B. Información persona jurídica</span>
            <div class="row py-2">
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="razon_social" name="razon_social"
                            placeholder="Razón social - Nombre comercial">
                        <label for="razon_social">Razón social - Nombre comercial</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="tipo_de_contribuyente" aria-label="Tipo de contribuyente">
                            <option selected>Seleccione el tipo</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="tipo_de_contribuyente">Tipo de contribuyente</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nacionalidad_persona_juridica"
                            name="nacionalidad_persona_juridica" placeholder="Nacionalidad">
                        <label for="nacionalidad_persona_juridica">Nacionalidad</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="numero_de_nit" name="numero_de_nit"
                            placeholder="Número de NIT">
                        <label for="numero_de_nit">Número de NIT</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="fecha_de_constitucion"
                            name="fecha_de_constitucion" placeholder="Fecha de constitución">
                        <label for="fecha_de_constitucion">Fecha de constitución</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="numero_de_registro_iva_nrc_p"
                            name="numero_de_registro_iva_nrc_p" placeholder="Número de registro IVA NRC">
                        <label for="numero_de_registro_iva_nrc_p">Número de registro IVA NRC</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="actividad_economica_p" aria-label="Actividad económica">
                            <option selected>Escriba para buscar</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="actividad_economica_p">Actividad económica</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="pais_p" aria-label="Seleccione el país">
                            <option selected>Seleccione el país</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="pais_p">País</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="departamento_p" aria-label="Seleccione el departamento">
                            <option selected>Seleccione el departamento</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="departamento_p">Departamento</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="municipio_p" aria-label="Seleccione el municipio">
                            <option selected>Seleccione el municipio</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="municipio_p">Municipio</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="telefono_p" name="telefono_p"
                            placeholder="Teléfono">
                        <label for="telefono_p">Teléfono</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sitio_web" name="sitio_web"
                            placeholder="Sitio web">
                        <label for="sitio_web">Sitio web</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="numero_de_fax" name="numero_de_fax"
                            placeholder="Número de FAX">
                        <label for="numero_de_fax">Número de FAX</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Dirección" id="direccion_p" style="height: 100px"></textarea>
                        <label for="direccion_p">Dirección</label>
                    </div>
                </div>
            </div>
            <span>C. Información de la administración, sus accionistas o miembros</span>
            <p>I. Detallar al beneficiario final, siendo esta persona natural con control igual o mayor al 10% de
                participación
                accionaria en la sociedad.</p>
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre_a" name="nombre_a"
                            placeholder="Nombre completo">
                        <label for="nombre_a">Nombre completo</label>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nacionalidad_a" name="nacionalidad_a"
                            placeholder="Nacionalidad">
                        <label for="nacionalidad_a">Nacionalidad</label>
                    </div>
                </div>
                <div class="col-sm-2 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="n_identidad" name="n_identidad"
                            placeholder="No. Identidad">
                        <label for="n_identidad">No. Identidad</label>
                    </div>
                </div>
                <div class="col-sm-2 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="porcentaje" name="porcentaje"
                            placeholder="Porcentaje">
                        <label for="porcentaje">Porcentaje</label>
                    </div>
                </div>
            </div>
            <p>II. Detallar los miembros de Juntas Directivas, administrador único, Alta Gerencia o máximo órgano de control
                en la sociedad.</p>
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre_jd" name="nombre_jd"
                            placeholder="Nombre completo">
                        <label for="nombre_jd">Nombre completo</label>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nacionalidad_jd" name="nacionalidad_jd"
                            placeholder="Nacionalidad">
                        <label for="nacionalidad_jd">Nacionalidad</label>
                    </div>
                </div>
                <div class="col-sm-2 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="n_identidad_jd" name="n_identidad_jd"
                            placeholder="No. Identidad">
                        <label for="n_identidad_jd">No. Identidad</label>
                    </div>
                </div>
                <div class="col-sm-2 mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo">
                        <label for="cargo">Cargo</label>
                    </div>
                </div>
            </div>
        </form>
        <div class="button">
            <input type="button" value="Enviar formulario">
        </div>
    </div>
@endsection
