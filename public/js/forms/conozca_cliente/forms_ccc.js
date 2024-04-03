$(document).ready(function () {
    document
        .getElementById("forms_ccc")
        .addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });


    const btnDescargarForm = document.getElementById('btnDescargarForm');

    btnDescargarForm.addEventListener('click', function (event) {
        const formulario = document.querySelector('form');

        if (formulario.checkValidity()) {
            mostrarToast("El formulario está completo. Descargando formulario...", "success");
        } else {
            mostrarToast("Por favor, completa todos los campos requeridos.", "error");
        }
    });

    $("#btnEnviarFormulario").click(function () {
        $("#formulario_firmado").prop("required", true);
    });

    const botonEnviar = document.querySelector('.enviar-form');
    const inputArchivo = document.getElementById('formulario_firmado');

    botonEnviar.disabled = true;

    inputArchivo.addEventListener('change', function () {
        if (this.files && this.files.length > 0) {
            botonEnviar.disabled = false;
        } else {
            botonEnviar.disabled = true;
        }
    });

    $("#btnEnviarFormulario").click(function () {
        var camposVacios = false;
        $("input[required]").each(function () {
            if ($(this).val().trim() === '') {
                camposVacios = true;
                return false;
            }
        });

        if (camposVacios) {
            mostrarToast("Por favor, completa todos los campos requeridos antes de enviar el formulario.", "error");
            return false;
        }

        $("#btnEnviarFormulario").hide();
        $("#btnCarga").show();
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
                    <input type="text" class="form-control" id="nombre_accionista${camposContador}" name="nombre_accionista[]">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nacionalidad_accionista${camposContador}" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidad_accionista${camposContador}" name="nacionalidad_accionista[]">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="numero_identidad_accionista${camposContador}" class="form-label">No. Identidad</label>
                    <input type="text" class="form-control" id="numero_identidad_accionista${camposContador}" name="numero_identidad_accionista[]">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="porcentaje_participacion_accionista${camposContador}" class="form-label">Porcentaje de participación</label>
                    <input type="text" class="form-control" id="porcentaje_participacion_accionista${camposContador}" name="porcentaje_participacion_accionista[]">
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
                    <input type="text" class="form-control" id="nombre_miembro${camposContadorMiembros}" name="nombre_miembro[]">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nacionalidad_miembro${camposContadorMiembros}" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidad_miembro${camposContadorMiembros}" name="nacionalidad_miembro[]">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="numero_identidad_miembro${camposContadorMiembros}" class="form-label">No. Identidad</label>
                    <input type="text" class="form-control" id="numero_identidad_miembro${camposContadorMiembros}" name="numero_identidad_miembro[]">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="cargo_miembro${camposContadorMiembros}" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="cargo_miembro${camposContadorMiembros}" name="cargo_miembro[]">
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
                    <input type="text" class="form-control" id="nombre_pariente${camposContadorParientes}" name="nombre_pariente[]">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="parentesco${camposContadorParientes}" class="form-label">Parentesco</label>
                    <input type="text" class="form-control" id="parentesco${camposContadorParientes}" name="parentesco[]">
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
                    <input type="text" class="form-control" id="nombre_socio${camposContadorSocios}" name="nombre_socio[]">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="porcentaje_participacion_socio${camposContadorSocios}" class="form-label">Porcentaje de participación</label>
                    <input type="text" class="form-control" id="porcentaje_participacion_socio${camposContadorSocios}" name="porcentaje_participacion_socio[]">
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
});

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

