$(document).ready(function () {
    habilitarTooltips();
    document
        .getElementById("forms_ccc")
        .addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });

    const btnDescargarForm = document.getElementById("btnDescargarForm");

    const documentoIdentidadPersonaNatural = document.getElementById(
        "documento_identidad_persona_natural"
    );
    const documentoNitPersonaNatural = document.getElementById(
        "documento_nit_persona_natural"
    );
    const documentoDomicilioPersonaNatural = document.getElementById(
        "documento_domicilio_persona_natural"
    );

    const documentoEscrituraJuridico = document.getElementById(
        "documento_escritura_juridico"
    );
    const documentoMatriculaJuridico = document.getElementById(
        "documento_matricula_juridico"
    );
    const documentoAcuerdoJuridico = document.getElementById(
        "documento_acuerdo_juridico"
    );
    const documentoNitJuridico = document.getElementById(
        "documento_nit_juridico"
    );
    const documentoIvaJuridico = document.getElementById(
        "documento_iva_juridico"
    );
    const documentoDomicilioJuridico = document.getElementById(
        "documento_domicilio_juridico"
    );
    const documentoCredencialPersonaNatural = document.getElementById(
        "documento_credencial_representante"
    );

    btnDescargarForm.addEventListener("click", function (event) {
        const formulario = document.querySelector("form");

        if (formulario.checkValidity()) {
            mostrarToast(
                "El formulario está completo. Descargando formulario...",
                "success"
            );
        } else {
            mostrarToast(
                "Por favor, completa todos los campos requeridos.",
                "error"
            );
        }
    });

    const botonEnviar = document.querySelector(".enviar-form");
    const inputArchivo = document.getElementById("formulario_firmado");

    botonEnviar.disabled = true;

    inputArchivo.addEventListener("change", function () {
        if (this.files && this.files.length > 0) {
            botonEnviar.disabled = false;
        } else {
            botonEnviar.disabled = true;
        }
    });

    $("#btnEnviarFormulario").click(function () {
        var formulario = document.querySelector("#forms_ccc");

        if (formulario.checkValidity()) {
            $("#btnEnviarFormulario").hide();
            $("#btnCarga").show();
            $("#forms_ccc").submit();
        } else {
            mostrarToast(
                "Por favor, complete todos los campos requeridos antes de enviar el formulario.",
                "error"
            );

            $("#enviarFormulario").modal("hide");
        }
    });

    const forms = document.querySelectorAll(".needs-validation");

    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });

    const body = document.querySelector("body");
    body.style.display = "flex";

    cargarPaises(
        "#pais",
        "#id_pais",
        "#departamento",
        "#id_departamento",
        "#municipio",
        "#id_municipio",
        false
    );

    setupGiroSearch(
        "actividad_economica",
        "sugerencia-filter",
        "id_actividad_economica"
    );

    cargarClasificaciones(
        "#clasificacion_juridico_id",
        "#id_clasificacion_juridico",
        false
    );

    setupGiroSearch(
        "giro_juridico",
        "sugerencia_filter_juridico",
        "id_giro_juridico"
    );

    cargarPaises(
        "#pais_juridico",
        "#id_pais_juridico",
        "#departamento_juridico",
        "#id_departamento_juridico",
        "#municipio_juridico",
        "#id_municipio_juridico",
        false
    );

    cargarPaises(
        "#pais_politico",
        "#id_pais_politico",
        "#departamento_politico",
        "#id_departamento_politico",
        "#municipio_politico",
        "#id_municipio_politico",
        false
    );

    const contenedorcampos = document.querySelector("#campos_form");
    const btnAgregarCampos = document.querySelector("#agregar_campos");
    const botonEliminar = document.querySelector(".btn-danger");

    let camposContador = 0;

    btnAgregarCampos.addEventListener("click", (e) => {
        camposContador++;

        let div = document.createElement("div");
        div.className = "row pb-3 align-items-center";
        div.innerHTML = `
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nombre_accionista${camposContador}" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre_accionista${camposContador}" name="nombre_accionista[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nacionalidad_accionista${camposContador}" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidad_accionista${camposContador}" name="nacionalidad_accionista[]" required>
                    <div class="invalid-feedback">
                            Por favor, ingrese la nacionalidad.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="numero_identidad_accionista${camposContador}" class="form-label">No. Identidad</label>
                    <input type="text" class="form-control" id="numero_identidad_accionista${camposContador}" name="numero_identidad_accionista[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el número de identidad.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="porcentaje_participacion_accionista${camposContador}" class="form-label">Porcentaje de participación</label>
                    <input type="text" class="form-control" id="porcentaje_participacion_accionista${camposContador}" name="porcentaje_participacion_accionista[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el porcentaje de participación.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn-redes btn btn-danger botonEliminar">Eliminar</button>
            </div>
        `;

        contenedorcampos.appendChild(div);

        if (botonEliminar) {
            botonEliminar.style.display = "block";
        }
    });

    contenedorcampos.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("botonEliminar")) {
            const divPadre = e.target.parentNode.parentNode;
            contenedorcampos.removeChild(divPadre);
            if (contenedorcampos.children.length === 0 && botonEliminar) {
                botonEliminar.style.display = "none";
            }
        }
    });

    const contenedorCamposMiembros = document.querySelector("#campos_miembros");
    const btnAgregarCamposMiembros = document.querySelector(
        "#agregar_campos_miembros"
    );
    const botonEliminarMiembros = document.querySelector(".btn-danger");

    let camposContadorMiembros = 0;

    btnAgregarCamposMiembros.addEventListener("click", (e) => {
        camposContadorMiembros++;

        let div = document.createElement("div");
        div.className = "row pb-3 align-items-center";
        div.innerHTML = `
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nombre_miembro${camposContadorMiembros}" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre_miembro${camposContadorMiembros}" name="nombre_miembro[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nacionalidad_miembro${camposContadorMiembros}" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidad_miembro${camposContadorMiembros}" name="nacionalidad_miembro[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la nacionalidad.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="numero_identidad_miembro${camposContadorMiembros}" class="form-label">No. Identidad</label>
                    <input type="text" class="form-control" id="numero_identidad_miembro${camposContadorMiembros}" name="numero_identidad_miembro[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el número de identidad.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="cargo_miembro${camposContadorMiembros}" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="cargo_miembro${camposContadorMiembros}" name="cargo_miembro[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el cargo.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn-redes btn btn-danger botonEliminarMiembros">Eliminar</button>
            </div>
        `;

        contenedorCamposMiembros.appendChild(div);

        if (botonEliminarMiembros) {
            botonEliminarMiembros.style.display = "block";
        }
    });

    contenedorCamposMiembros.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("botonEliminarMiembros")) {
            const divPadre = e.target.parentNode.parentNode;
            contenedorCamposMiembros.removeChild(divPadre);
            if (
                contenedorCamposMiembros.children.length === 0 &&
                botonEliminarMiembros
            ) {
                botonEliminarMiembros.style.display = "none";
            }
        }
    });

    const contenedorParientes = document.querySelector("#campos_parientes");
    const btnAgregarParientes = document.querySelector(
        "#agregar_campos_parientes"
    );
    const botonEliminarParientes = document.querySelector(".btn-danger");

    let camposContadorParientes = 0;

    btnAgregarParientes.addEventListener("click", (e) => {
        camposContadorParientes++;

        let div = document.createElement("div");
        div.className = "row pb-3 align-items-center";
        div.innerHTML = `
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nombre_pariente${camposContadorParientes}" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre_pariente${camposContadorParientes}" name="nombre_pariente[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="parentesco${camposContadorParientes}" class="form-label">Parentesco</label>
                    <input type="text" class="form-control" id="parentesco${camposContadorParientes}" name="parentesco[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el parentesco.
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <button type="button" class="btn-redes btn btn-danger botonEliminar">Eliminar</button>
            </div>
        `;

        contenedorParientes.appendChild(div);

        if (botonEliminarParientes) {
            botonEliminarParientes.style.display = "block";
        }
    });

    contenedorParientes.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("botonEliminar")) {
            const divPadre = e.target.parentNode.parentNode;
            contenedorParientes.removeChild(divPadre);
            if (
                contenedorParientes.children.length === 0 &&
                botonEliminarParientes
            ) {
                botonEliminarParientes.style.display = "none";
            }
        }
    });

    const contenedorSocios = document.querySelector("#campos_socios");
    const btnAgregarSocios = document.querySelector("#agregar_campos_socios");
    const botonEliminarSocios = document.querySelector(".btn-danger");

    let camposContadorSocios = 0;

    btnAgregarSocios.addEventListener("click", (e) => {
        camposContadorSocios++;

        let div = document.createElement("div");
        div.className = "row pb-3 align-items-center";
        div.innerHTML = `
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nombre_socio${camposContadorSocios}" class="form-label">Nombre de la entidad</label>
                    <input type="text" class="form-control" id="nombre_socio${camposContadorSocios}" name="nombre_socio[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="porcentaje_participacion_socio${camposContadorSocios}" class="form-label">Porcentaje de participación</label>
                    <input type="text" class="form-control" id="porcentaje_participacion_socio${camposContadorSocios}" name="porcentaje_participacion_socio[]" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el porcentaje.
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <button type="button" class="btn-redes btn btn-danger botonEliminar">Eliminar</button>
            </div>
        `;

        contenedorSocios.appendChild(div);

        if (botonEliminarSocios) {
            botonEliminarSocios.style.display = "block";
        }
    });

    contenedorSocios.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("botonEliminar")) {
            const divPadre = e.target.parentNode.parentNode;
            contenedorSocios.removeChild(divPadre);
            if (contenedorSocios.children.length === 0 && botonEliminarSocios) {
                botonEliminarSocios.style.display = "none";
            }
        }
    });

    var cargoPublicoSi = document.getElementById("cargoPublicoSI");
    var cargoPublicoNo = document.getElementById("cargoPublicoNO");
    var capitalAccionarioSi = document.getElementById("capitalAccionarioSI");
    var capitalAccionarioNO = document.getElementById("capitalAccionarioNO");
    var camposAdicionales = document.querySelectorAll(".campos-adicionales");

    cargoPublicoSi.addEventListener("change", function () {
        if (cargoPublicoSi.checked || capitalAccionarioSi.checked) {
            camposAdicionales.forEach(function (campo) {
                campo.style.display = "block";
            });
        }
    });

    cargoPublicoNo.addEventListener("change", function () {
        if (cargoPublicoNo.checked && capitalAccionarioNO.checked) {
            camposAdicionales.forEach(function (campo) {
                campo.style.display = "";
            });
        }
    });

    capitalAccionarioSi.addEventListener("change", function () {
        if (cargoPublicoSi.checked || capitalAccionarioSi.checked) {
            camposAdicionales.forEach(function (campo) {
                campo.style.display = "block";
            });
        }
    });

    capitalAccionarioNO.addEventListener("change", function () {
        if (cargoPublicoNo.checked && capitalAccionarioNO.checked) {
            camposAdicionales.forEach(function (campo) {
                campo.style.display = "";
            });
        }
    });

    const tipoPersonaSelect = document.getElementById("tipo_persona");
    const camposPersonaJuridica = document.querySelector(
        ".campos-persona-juridica"
    );

    const nombreComercialJuridicoInput = document.getElementById(
        "nombre_comercial_juridico"
    );
    const clasificacionJuridicaId = document.getElementById(
        "clasificacion_juridico_id"
    );
    const nacionalidadJuridico = document.getElementById(
        "nacionalidad_juridico"
    );
    const numeroNitJuridico = document.getElementById("numero_de_nit_juridico");
    const fechaConstitucionJuridico = document.getElementById(
        "fecha_de_constitucion_juridico"
    );
    const registroNrcJuridico = document.getElementById(
        "registro_nrc_juridico"
    );
    const giroJuridico = document.getElementById("giro_juridico");
    const paisJuridico = document.getElementById("pais_juridico");
    const departamentoJuridico = document.getElementById(
        "departamento_juridico"
    );
    const municipioJuridico = document.getElementById("municipio_juridico");
    const telefonoJuridico = document.getElementById("telefono_juridico");
    const sitioWebJuridico = document.getElementById("sitio_web_juridico");
    const numeroFaxJuridico = document.getElementById("numero_de_fax_juridico");
    const direccionJuridico = document.getElementById("direccion_juridico");

    const nombreAccionista = document.getElementById("nombre_accionista");
    const nacionalidadAccionista = document.getElementById(
        "nacionalidad_accionista"
    );
    const numeroIdentidadAccionista = document.getElementById(
        "numero_identidad_accionista"
    );
    const porcentajeParticipacionAccionista = document.getElementById(
        "porcentaje_participacion_accionista"
    );

    const nombreMiembro = document.getElementById("nombre_miembro");
    const nacionalidadMiembro = document.getElementById("nacionalidad_miembro");
    const numeroIdentidadMiembro = document.getElementById(
        "numero_identidad_miembro"
    );
    const cargoMiembro = document.getElementById("cargo_miembro");

    camposPersonaJuridica.style.display = "none";

    tipoPersonaSelect.addEventListener("change", function () {
        if (tipoPersonaSelect.value === "Persona Natural") {
            camposPersonaJuridica.style.display = "none";
            nombreComercialJuridicoInput.removeAttribute("required");
            clasificacionJuridicaId.removeAttribute("required");
            nacionalidadJuridico.removeAttribute("required");
            numeroNitJuridico.removeAttribute("required");
            fechaConstitucionJuridico.removeAttribute("required");
            registroNrcJuridico.removeAttribute("required");
            giroJuridico.removeAttribute("required");
            paisJuridico.removeAttribute("required");
            departamentoJuridico.removeAttribute("required");
            municipioJuridico.removeAttribute("required");
            telefonoJuridico.removeAttribute("required");
            direccionJuridico.removeAttribute("required");
            nombreAccionista.removeAttribute("required");
            nacionalidadAccionista.removeAttribute("required");
            numeroIdentidadAccionista.removeAttribute("required");
            porcentajeParticipacionAccionista.removeAttribute("required");
            nombreMiembro.removeAttribute("required");
            nacionalidadMiembro.removeAttribute("required");
            numeroIdentidadMiembro.removeAttribute("required");
            cargoMiembro.removeAttribute("required");

            documentoEscrituraJuridico.removeAttribute("required");
            documentoEscrituraJuridico.value = "";
            documentoMatriculaJuridico.removeAttribute("required");
            documentoMatriculaJuridico.value = "";
            documentoAcuerdoJuridico.removeAttribute("required");
            documentoAcuerdoJuridico.value = "";
            documentoNitJuridico.removeAttribute("required");
            documentoNitJuridico.value = "";
            documentoIvaJuridico.removeAttribute("required");
            documentoIvaJuridico.value = "";
            documentoDomicilioJuridico.removeAttribute("required");
            documentoDomicilioJuridico.value = "";
            documentoCredencialPersonaNatural.removeAttribute("required");
            documentoCredencialPersonaNatural.value = "";

            nombreComercialJuridicoInput.value = "";
            clasificacionJuridicaId.value = "";
            document.getElementById("id_clasificacion_juridico").value = "";
            nacionalidadJuridico.value = "";
            numeroNitJuridico.value = "";
            fechaConstitucionJuridico.value = "";
            registroNrcJuridico.value = "";
            giroJuridico.value = "";
            document.getElementById("id_giro_juridico").value = "";
            paisJuridico.value = "";
            departamentoJuridico.value = "";
            municipioJuridico.value = "";
            document.getElementById("id_pais_juridico").value = "";
            document.getElementById("id_departamento_juridico").value = "";
            document.getElementById("id_municipio_juridico").value = "";
            telefonoJuridico.value = "";
            sitioWebJuridico.value = "";
            numeroFaxJuridico.value = "";
            direccionJuridico.value = "";
            nombreAccionista.value = "";
            nacionalidadAccionista.value = "";
            numeroIdentidadAccionista.value = "";
            porcentajeParticipacionAccionista.value = "";
            nombreMiembro.value = "";
            nacionalidadMiembro.value = "";
            numeroIdentidadMiembro.value = "";
            cargoMiembro.value = "";
        } else {
            camposPersonaJuridica.style.display = "flex";
            nombreComercialJuridicoInput.setAttribute("required", "required");
            clasificacionJuridicaId.setAttribute("required", "required");
            nacionalidadJuridico.setAttribute("required", "required");
            numeroNitJuridico.setAttribute("required", "required");
            fechaConstitucionJuridico.setAttribute("required", "required");
            registroNrcJuridico.setAttribute("required", "required");
            giroJuridico.setAttribute("required", "required");
            paisJuridico.setAttribute("required", "required");
            departamentoJuridico.setAttribute("required", "required");
            municipioJuridico.setAttribute("required", "required");
            telefonoJuridico.setAttribute("required", "required");
            direccionJuridico.setAttribute("required", "required");
            nombreAccionista.setAttribute("required", "required");
            nacionalidadAccionista.setAttribute("required", "required");
            numeroIdentidadAccionista.setAttribute("required", "required");
            porcentajeParticipacionAccionista.setAttribute(
                "required",
                "required"
            );
            nombreMiembro.setAttribute("required", "required");
            nacionalidadMiembro.setAttribute("required", "required");
            numeroIdentidadMiembro.setAttribute("required", "required");
            cargoMiembro.setAttribute("required", "required");

            documentoIdentidadPersonaNatural.removeAttribute("required");
            documentoIdentidadPersonaNatural.value = "";
            documentoNitPersonaNatural.removeAttribute("required");
            documentoNitPersonaNatural.value = "";
            documentoDomicilioPersonaNatural.removeAttribute("required");
            documentoDomicilioPersonaNatural.value = "";
        }
    });

    const radioSI = document.getElementById("cargoPublicoSI");
    const radioNO = document.getElementById("cargoPublicoNO");
    const radio1SI = document.getElementById("capitalAccionarioSI");
    const radio2NO = document.getElementById("capitalAccionarioNO");

    const campoNombrePolitico = document.getElementById("nombre_politico");
    const nombreCargoPolitico = document.getElementById(
        "nombre_cargo_politico"
    );
    const fechaDesdePolitico = document.getElementById("fecha_desde_politico");
    const fechaHastaPolitico = document.getElementById("fecha_hasta_politico");
    const paisPolitico = document.getElementById("pais_politico");
    const departamentoPolitico = document.getElementById(
        "departamento_politico"
    );
    const municipioPolitico = document.getElementById("municipio_politico");
    const nombreClientePolitico = document.getElementById(
        "nombre_cliente_politico"
    );
    const porcentajeParticipacionPolitico = document.getElementById(
        "porcentaje_participacion_politico"
    );
    const nombrePariente = document.getElementById("nombre_pariente");
    const parentesco = document.getElementById("parentesco");
    const nombreSocio = document.getElementById("nombre_socio");
    const porcentajeParticipacionSocio = document.getElementById(
        "porcentaje_participacion_socio"
    );
    const fuenteIngreso = document.getElementById("fuente_ingreso");
    const montoMensual = document.getElementById("monto_mensual");

    function verificarCampoRequerido() {
        if (radioSI.checked || radio1SI.checked) {
            campoNombrePolitico.setAttribute("required", "required");
            nombreCargoPolitico.setAttribute("required", "required");
            fechaDesdePolitico.setAttribute("required", "required");
            fechaHastaPolitico.setAttribute("required", "required");
            paisPolitico.setAttribute("required", "required");
            departamentoPolitico.setAttribute("required", "required");
            municipioPolitico.setAttribute("required", "required");
            nombreClientePolitico.setAttribute("required", "required");
            porcentajeParticipacionPolitico.setAttribute(
                "required",
                "required"
            );
            nombrePariente.setAttribute("required", "required");
            parentesco.setAttribute("required", "required");
            nombreSocio.setAttribute("required", "required");
            porcentajeParticipacionSocio.setAttribute("required", "required");
            fuenteIngreso.setAttribute("required", "required");
            montoMensual.setAttribute("required", "required");
        }
    }

    radioSI.addEventListener("change", verificarCampoRequerido);
    radio1SI.addEventListener("change", verificarCampoRequerido);

    function verificarCampoOpcional() {
        if (radioNO.checked && radio2NO.checked) {
            campoNombrePolitico.removeAttribute("required");
            nombreCargoPolitico.removeAttribute("required");
            fechaDesdePolitico.removeAttribute("required");
            fechaHastaPolitico.removeAttribute("required");
            paisPolitico.removeAttribute("required");
            departamentoPolitico.removeAttribute("required");
            municipioPolitico.removeAttribute("required");
            nombreClientePolitico.removeAttribute("required");
            porcentajeParticipacionPolitico.removeAttribute("required");
            nombrePariente.removeAttribute("required");
            parentesco.removeAttribute("required");
            nombreSocio.removeAttribute("required");
            porcentajeParticipacionSocio.removeAttribute("required");
            fuenteIngreso.removeAttribute("required");
            montoMensual.removeAttribute("required");
            campoNombrePolitico.value = "";
            nombreCargoPolitico.value = "";
            fechaDesdePolitico.value = "";
            fechaHastaPolitico.value = "";
            paisPolitico.value = "";
            document.getElementById("id_pais_politico").value = "";
            departamentoPolitico.value = "";
            document.getElementById("id_departamento_politico").value = "";
            municipioPolitico.value = "";
            document.getElementById("id_municipio_politico").value = "";
            nombreClientePolitico.value = "";
            porcentajeParticipacionPolitico.value = "";
            nombrePariente.value = "";
            parentesco.value = "";
            nombreSocio.value = "";
            porcentajeParticipacionSocio.value = "";
            fuenteIngreso.value = "";
            montoMensual.value = "";
        }
    }

    radioNO.addEventListener("change", verificarCampoOpcional);
    radio2NO.addEventListener("change", verificarCampoOpcional);
});

function habilitarTooltips() {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = Array.from(tooltipTriggerList).map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
}

function mostrarToast(mensaje, tipo) {
    const toast = document.getElementById("notificacion");

    toast.querySelector(".toast-body").textContent = mensaje;

    toast.classList.remove("toast-success", "toast-error", "bg-danger");

    if (tipo === "success") {
        toast.classList.add("toast-success");
    } else if (tipo === "error") {
        toast.classList.add("toast-error", "bg-danger");
    }

    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
}
