$(document).ready(function () {
    const body = document.querySelector("body");

    const contenedorcampos = document.querySelector("#campos_form");
    const btnAgregarCampos = document.querySelector("#agregar_campos");
    const botonEliminar = document.querySelector(".btn-danger");

    const contenedorCamposMiembros = document.querySelector("#campos_miembros");
    const btnAgregarCamposMiembros = document.querySelector("#agregar_campos_miembros");
    const botonEliminarMiembros = document.querySelector(".btn-danger");

    let camposContador = 0;
    let camposContadorMiembros = 0;

    btnAgregarCampos.addEventListener("click", (e) => {
        camposContador++;

        let div = document.createElement("div");
        div.className =
            "row pb-3 align-items-center";
        div.innerHTML = `
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nombre_a${camposContador}" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre_a${camposContador}" name="nombre_a[]" required>
                    <div class="invalid-feedback">
                        Por favor ingrese el nombre.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nacionalidad_a${camposContador}" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidad_a${camposContador}" name="nacionalidad_a[]" required>
                    <div class="invalid-feedback">
                        Por favor ingrese la nacionalidad.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="numero_identidad${camposContador}" class="form-label">No. Identidad</label>
                    <input type="text" class="form-control" id="numero_identidad${camposContador}" name="numero_identidad[]" required>
                    <div class="invalid-feedback">
                        Por favor ingrese el número de identificación.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="porcentaje_participacion${camposContador}" class="form-label">Porcentaje de participación</label>
                    <input type="text" class="form-control" id="porcentaje_participacion${camposContador}" name="porcentaje_participacion[]" required>
                    <div class="invalid-feedback">
                        Por favor ingrese el porcentaje.
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

    (() => {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()

    cargarPaises(
        "#pais-form",
        "#id-pais-form",
        "#departamento-form",
        "#id-departamento-form",
        "#municipio-form",
        "#id-municipio-form",
        false
    );

    setupGiroSearch(
        "actividad_economica",
        "sugerencia-filter",
        "id_actividad_economica",
    );

    cargarClasificaciones(
        "#tipo_de_contribuyente",
        "#id-tipo-de-contribuyente",
        false
    );

    setupGiroSearch(
        "actividad_economica_pj",
        "sugerencia-filter-pj",
        "id_actividad_economica_pj",
    );

    cargarPaises(
        "#pais_persona_juridica",
        "#id_pais_persona_juridica",
        "#departamento_persona_juridica",
        "#id_departamento_persona_juridica",
        "#municipio_persona_juridica",
        "#id_municipio_persona_juridica",
        false
    );

    btnAgregarCamposMiembros.addEventListener("click", (e) => {
        camposContadorMiembros++;

        let div = document.createElement("div");
        div.className =
            "row pb-3 align-items-center";
        div.innerHTML = `
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nombre_miembro${camposContadorMiembros}" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre_miembro${camposContadorMiembros}" name="nombre_miembro[]" required>
                    <div class="invalid-feedback">
                        Por favor ingrese el nombre.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="nacionalidad_miembro${camposContadorMiembros}" class="form-label">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidad_miembro${camposContadorMiembros}" name="nacionalidad_miembro[]" required>
                    <div class="invalid-feedback">
                        Por favor ingrese la nacionalidad.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="numero_identidad_miembro${camposContadorMiembros}" class="form-label">No. Identidad</label>
                    <input type="text" class="form-control" id="numero_identidad_miembro${camposContadorMiembros}" name="numero_identidad_miembro[]" required>
                    <div class="invalid-feedback">
                        Por favor ingrese el número de identificación.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="cargo_miembro${camposContadorMiembros}" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="cargo_miembro${camposContadorMiembros}" name="cargo_miembro[]" required>
                    <div class="invalid-feedback">
                        Por favor ingrese el cargo.
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
            if (contenedorCamposMiembros.children.length === 0 && botonEliminarMiembros) {
                botonEliminarMiembros.style.display = "none";
            }
        }
    });

    document.getElementById('forms_ccc').addEventListener('submit', function (event) {
        var valorActividadEconomica = document.getElementById('id_actividad_economica').value;
        var valorActividadEconomica = document.getElementById('id_actividad_economica_pj').value;

        if (valorActividadEconomica === '') {
            event.preventDefault();
            document.getElementById('id_actividad_economica').classList.add('is-invalid');
            document.getElementById('id_actividad_economica_pj').classList.add('is-invalid');
        } else {
            document.getElementById('id_actividad_economica').classList.remove('is-invalid');
            document.getElementById('id_actividad_economica_pj').classList.remove('is-invalid');
        }
    });

    body.style.display = "flex";
});