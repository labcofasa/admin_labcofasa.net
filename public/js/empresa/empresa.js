$(document).ready(function () {
    const apiEmpresas = "/tabla-empresas";

    const giroTextoInput = $("#giro-empresa-editar");
    const idGiroHidden = $("#id-giro-empresa-editar");

    const contenedor = document.querySelector("#campos");
    const btnAgregar = document.querySelector("#agregar");
    const btnEliminar = document.querySelector(".btn-danger");

    const contenedorEditar = document.getElementById("camposEditar");
    const btnEliminarEditar = document.getElementById(
        "btn-eliminar-red-social-editar"
    );
    const agregarEditar = document.getElementById("agregarEditar");
    let contadorCamposEditar = 0;

    let contadorCampos = 0;

    let tabla_empresas = null;
    var empresaId, nombreEmpresa;

    tablaEmpresas();

    /* Tabla Empresas */
    function tablaEmpresas() {
        if (tabla_empresas) {
            tabla_empresas.destroy();
        }

        $("#tabla-empresas-container").hide();

        tabla_empresas = $("#tabla-empresas").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-6 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
            serverSide: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [6, 25, 50, -1],
                ["6 filas", "25 filas", "50 filas", "Todas las filas"],
            ],
            buttons: [
                {
                    extend: "pageLength",
                    className: "btn btn-lg btn-group-secondary",
                },
                {
                    extend: "colvis",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-lg-block",
                    postfixButtons: ["colvisRestore"],
                    text: "Editar columnas",
                },
                {
                    extend: "collection",
                    text: "Exportar",
                    className:
                        "btn-border-right btn btn-lg btn-group-secondary d-lg-none",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Empresas registradas - Laboratorios Cofasa",
                            filename:
                                "Empresas registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
                                ],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Empresas registradas - Laboratorios Cofasa",
                            filename:
                                "Empresas registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
                                ],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Empresas registradas - Laboratorios Cofasa",
                            filename:
                                "Empresas registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
                                ],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Empresas registradas - Laboratorios Cofasa",
                            filename:
                                "Empresas registradas - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                empresasPrint();
                            },
                        },
                    ],
                },
                {
                    extend: "collection",
                    text: "Exportar datos",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-lg-block",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Empresas registradas - Laboratorios Cofasa",
                            filename:
                                "Empresas registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
                                ],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Empresas registradas - Laboratorios Cofasa",
                            filename:
                                "Empresas registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
                                ],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Empresas registradas - Laboratorios Cofasa",
                            filename:
                                "Empresas registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
                                ],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Empresas registradas - Laboratorios Cofasa",
                            filename:
                                "Empresas registradas - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                empresasPrint();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay empresas registradas",
            },
            ajax: {
                url: apiEmpresas,
                type: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            },
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-empresas-container").show();
            },
            columnDefs: [
                {
                    targets: [0, 25],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [
                        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                        17, 18, 19, 20, 21, 22, 23, 24,
                    ],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 25 },
            ],
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre", title: "Nombre" },
                { data: "entidad_nombre", title: "Entidad" },
                { data: "clasificacion_nombre", title: "Clasificación" },
                { data: "fundacion", title: "Fecha de fundación" },
                { data: "pais_nombre", title: "País" },
                { data: "departamento_nombre", title: "Departamento" },
                { data: "municipio_nombre", title: "Municipio" },
                { data: "telefono", title: "Teléfono" },
                { data: "email", title: "Correo electrónico" },
                { data: "web", title: "Sitio web" },
                { data: "direccion", title: "Dirección" },
                { data: "registro_nit", title: "Registro NIT" },
                { data: "registro_nrc", title: "Registro NRC" },
                { data: "nombre_dnm", title: "Nombre DNM" },
                { data: "registro_dnm", title: "Registro DNM" },
                {
                    data: "redes_sociales",
                    title: "Redes sociales",
                    render: function (data, type, row) {
                        var redesSociales = data
                            .map(function (redSocial) {
                                return (
                                    redSocial.nombre + " - " + redSocial.enlace
                                );
                            })
                            .join("<br>");

                        return redesSociales;
                    },
                },
                { data: "giro_nombre", title: "Actividad económica" },
                { data: "mision", title: "Misión" },
                { data: "vision", title: "Visión" },
                { data: "calidad", title: "Politíca de calidad" },
                { data: "created_at", title: "Fecha de creación" },
                {
                    data: "user_name",
                    title: "Usuario creador",
                    defaultContent: "",
                },
                { data: "updated_at", title: "Fecha actualización" },
                {
                    data: "user_modified_name",
                    title: "Usuario modificador",
                    defaultContent: "",
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        var userPermissions = JSON.parse(
                            document.getElementById("userPermissions").value
                        );
                        return `
                            <div class="text-center">
                                <div class="btn-group">
                                    <button class="btn-icon-close dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow">
                                        <li>
                                            <a class="btn-logo" href="empresas/${row.id}/logo" target="_blank">
                                                <button class="dropdown-item nav-link" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/></svg>

                                                    <span class="link">Ver logo</span>
                                                </button>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn-logo" href="empresas/${row.id}/leyenda" target="_blank">
                                                <button class="dropdown-item nav-link" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/></svg>

                                                    <span class="link">Leyenda de factura</span>
                                                </button>
                                            </a>
                                        </li>
                                        ${userPermissions.some(
                            (permission) =>
                                permission.name ===
                                "admin_empresas_editar"
                        )
                                ? `
                                            <li>
                                                <button class="dropdown-item editar-empresa nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                                    <span class="link">Editar</span>
                                                </button>
                                            </li>`
                                : ""
                            }
                                        ${userPermissions.some(
                                (permission) =>
                                    permission.name ===
                                    "admin_empresas_eliminar"
                            )
                                ? `
                                            <li>
                                                <button class="dropdown-item eliminar-empresa nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                                                    <span class="link">Eliminar</span>
                                                </button>
                                            </li>`
                                : ""
                            }
                                    </ul>
                                </div>
                            </div>`;
                    },
                },
            ],
            order: [[12, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputEmpresa = $("#tabla-empresas_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputEmpresa.attr("id", "buscar-empresas");
                inputEmpresa.attr("name", "buscar_empresas");
                inputEmpresa.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputEmpresa.before(iconSvg);

                inputEmpresa.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_empresas.search(inputValue).draw();
                    }, 500);
                });

                inputEmpresa.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_empresas.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_empresas.on("draw.dt", function () {
            $("#tabla-empresas_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();

            $("#tabla-empresas-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 4;

    /* Crear empresas */
    $("#imagen-empresa").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".image-empresa-name").text(fileName);

        if (fileName) {
            $(".text-label-image").hide();
        } else {
            $(".text-label-image").show();
        }
    });

    $("#imagen-empresa-leyenda").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".image-empresa-name-leyenda").text(fileName);

        if (fileName) {
            $(".text-label-image-leyenda").hide();
        } else {
            $(".text-label-image-leyenda").show();
        }
    });

    /* Formatear input de NIT */
    var nitInput = $("#nit-empresa-input");
    var nitInputHidden = $("#nit-empresa-input-hidden");

    nitInput.on("input", function () {
        var inputValue = nitInput.val().replace(/\D/g, "");

        var formattedValue = inputValue.replace(
            /(\d{4})(\d{6})(\d{3})(\d{2})/,
            function (match, p1, p2, p3, p4) {
                return p1 + "-" + p2 + "-" + p3 + "-" + p4;
            }
        );

        nitInput.val(formattedValue);

        nitInputHidden.val(inputValue);
    });

    nitInput.on("keypress", function (event) {
        var keyCode = event.which;
        if (keyCode < 48 || keyCode > 57) {
            event.preventDefault();
        }
    });

    $("#empresaForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const giroId = $("#id-giro-empresa-filter").val();
        const entidadId = $("#id-entidad-empresa").val();
        const clasificacionId = $("#id-clasificacion-empresa").val();
        const paisId = $("#id-pais-empresa").val();
        const departamentoId = $("#id-departamento-empresa").val();
        const municipioId = $("#id-municipio-empresa").val();
        const imagenInput = $("#imagen-empresa")[0];
        const imagenLeyendaInput = $("#imagen-empresa-leyenda")[0];

        const nombreRS = document.querySelectorAll('input[name^="social"]');
        const enlaceRS = document.querySelectorAll('input[name^="enlace"]');

        if (!giroId) {
            mostrarToast("Por favor, seleccione un giro válido", "error");
            return;
        }
        if (!clasificacionId) {
            mostrarToast(
                "Por favor, seleccione una clasificación válida",
                "error"
            );
            return;
        }
        if (!entidadId) {
            mostrarToast("Por favor, seleccione una entidad válida", "error");
            return;
        }
        if (!paisId) {
            mostrarToast("Por favor, seleccione un país válido", "error");
            return;
        }
        if (!departamentoId) {
            mostrarToast(
                "Por favor, seleccione un departmento válido",
                "error"
            );
            return;
        }
        if (!municipioId) {
            mostrarToast("Por favor, seleccione un municipio válido", "error");
            return;
        }

        const formData = new FormData(form[0]);

        formData.append("giro_id", giroId);
        formData.append("entidad_id", entidadId);
        formData.append("clasificacion_id", clasificacionId);
        formData.append("pais_id", paisId);
        formData.append("departamento_id", departamentoId);
        formData.append("municipio_id", municipioId);

        nombreRS.forEach((input, index) => {
            formData.append(`social[${index}]`, input.value);
        });

        enlaceRS.forEach((input, index) => {
            formData.append(`enlace[${index}]`, input.value);
        });

        if (imagenInput.files.length > 0) {
            formData.append("imagen", imagenInput.files[0]);
        }

        if (imagenLeyendaInput.files.length > 0) {
            formData.append("imagen_leyenda", imagenLeyendaInput.files[0]);
        }

        $.ajax({
            url: "/crear-empresa",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    mostrarToast(response.message, "success");
                    tabla_empresas.ajax.reload();
                    $("#empresaModal").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar la empresa. Detalles: " +
                    jqXHR.responseText,
                    "error"
                );
            },
        });
    });

    $("#empresaModal").on("shown.bs.modal", function () {
        cargarEntidades(
            "#entidad-empresa-select",
            "#id-entidad-empresa",
            false
        );

        cargarClasificaciones(
            "#clasificacion-empresa-select",
            "#id-clasificacion-empresa",
            false
        );

        cargarPaises(
            "#pais-empresa-select",
            "#id-pais-empresa",
            "#depto-empresa-select",
            "#id-departamento-empresa",
            "#municipio-empresa-select",
            "#id-municipio-empresa"
        );
    });

    $("#empresaModal").on("hidden.bs.modal", function () {
        $("#empresaForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();

        $("#campos").empty();
        $("#agregar").off("click");
        $("#ig-tab").tab("show");
    });

    //* Editar empresas */
    $("#tabla-empresas").on("click", ".editar-empresa", function () {
        empresaId = $(this).data("id");
        var row = tabla_empresas.row($(this).parents("tr")).data();
        nombreEmpresa = row.nombre;
        direccionEmpresa = row.direccion;
        telefonoEmpresa = row.telefono;
        emailEmpresa = row.email;
        webEmpresa = row.web;
        registroNitEmpresa = row.registro_nit;
        registroNrcEmpresa = row.registro_nrc;
        nombreDnmEmpresa = row.nombre_dnm;
        registroDnmEmpresa = row.registro_dnm;
        fundacionEmpresa = row.fundacion;
        misionEmpresa = row.mision;
        visionEmpresa = row.vision;
        calidadEmpresa = row.calidad;

        var giroId = row.giro_id;
        var nombreGiro = row.giro_nombre;

        var entidadId = row.entidad_id;
        var nombreEntidad = row.entidad_nombre;

        var clasificacionId = row.clasificacion_id;
        var nombreClasificacion = row.clasificacion_nombre;

        var paisId = row.pais_id;
        var nombrePais = row.pais_nombre;

        var departamentoId = row.departamento_id;
        var nombreDepartamento = row.departamento_nombre;

        var municipioId = row.municipio_id;
        var nombreMunicipio = row.municipio_nombre;

        const modal = $("#editarEmpresa");

        $("#empresaEditarForm #btn-editar-empresa").val(empresaId);
        $("#empresaEditarForm #nombre-empresa-editar").val(nombreEmpresa);
        $("#empresaEditarForm #direccion-textarea-editar").val(
            direccionEmpresa
        );
        $("#empresaEditarForm #telefono-empresa-editar").val(telefonoEmpresa);
        $("#empresaEditarForm #email-empresa-editar").val(emailEmpresa);
        $("#empresaEditarForm #web-empresa-editar").val(webEmpresa);
        $("#empresaEditarForm #fundacion-empresa-editar").val(fundacionEmpresa);
        $("#empresaEditarForm #nit-empresa-editar").val(registroNitEmpresa);
        $("#empresaEditarForm #registro-nrc-empresa-editar").val(
            registroNrcEmpresa
        );
        $("#empresaEditarForm #mision-textarea-editar").val(misionEmpresa);
        $("#empresaEditarForm #vision-textarea-editar").val(visionEmpresa);
        $("#empresaEditarForm #calidad-textarea-editar").val(calidadEmpresa);
        $("#empresaEditarForm #nombre-dnm-empresa-editar").val(
            nombreDnmEmpresa
        );
        $("#empresaEditarForm #registro-dnm-empresa-editar").val(
            registroDnmEmpresa
        );
        $("#empresaEditarForm #id-giro-empresa-editar").val(giroId);
        $("#empresaEditarForm #giro-empresa-editar").val(nombreGiro);
        $(".image-empresa-name-editar").text(row.imagen);
        $(".image-empresa-name-leyenda-editar").text(row.imagen_leyenda);
        $("#empresaEditarForm #id-entidad-empresa-editar").val(entidadId);
        $("#empresaEditarForm #id-clasificacion-empresa-editar").val(
            clasificacionId
        );
        $("#empresaEditarForm #id-pais-empresa-editar").val(paisId);
        $("#empresaEditarForm #id-departamento-empresa-editar").val(
            departamentoId
        );
        $("#empresaEditarForm #id-municipio-empresa-editar").val(municipioId);

        $("#empresaEditarForm #entidad-empresa-select-editar").append(
            $("<option>", {
                value: entidadId,
                text: nombreEntidad,
                selected: true,
            })
        );

        $("#empresaEditarForm #clasificacion-empresa-select-editar").append(
            $("<option>", {
                value: clasificacionId,
                text: nombreClasificacion,
                selected: true,
            })
        );

        $("#empresaEditarForm #pais-empresa-select-editar").append(
            $("<option>", {
                value: paisId,
                text: nombrePais,
                selected: true,
            })
        );

        $("#empresaEditarForm #depto-empresa-select-editar").append(
            $("<option>", {
                value: departamentoId,
                text: nombreDepartamento,
                selected: true,
            })
        );

        $("#empresaEditarForm #municipio-empresa-select-editar").append(
            $("<option>", {
                value: municipioId,
                text: nombreMunicipio,
                selected: true,
            })
        );

        $("#redes-sociales-list").empty();

        $.each(row.redes_sociales, function (index, redSocial) {
            let contadorCamposEditar = index + 1;
            agregarRedSocialHtml(empresaId, contadorCamposEditar, redSocial);
        });

        cargarClasificaciones(
            "#clasificacion-empresa-select-editar",
            "#id-clasificacion-empresa-editar",
            true,
            clasificacionId
        );

        cargarEntidades(
            "#entidad-empresa-select-editar",
            "#id-entidad-empresa-editar",
            true,
            entidadId
        );

        cargarPaises(
            "#pais-empresa-select-editar",
            "#id-pais-empresa-editar",
            "#depto-empresa-select-editar",
            "#id-departamento-empresa-editar",
            "#municipio-empresa-select-editar",
            "#id-municipio-empresa-editar",
            paisId,
            departamentoId,
            municipioId
        );

        modal.modal("show");
        modal.find(".modal-title").text("Editar empresa: " + nombreEmpresa);
    });

    /* Formatear input de NIT */
    var nitInputEditar = $("#nit-empresa-editar");
    var nitInputHiddenEditar = $("#nit-empresa-editar-hidden");

    nitInputEditar.on("input", function () {
        var inputValueEditar = nitInputEditar.val().replace(/\D/g, "");

        var formattedValueEditar = inputValueEditar.replace(
            /(\d{4})(\d{6})(\d{3})(\d{2})/,
            function (match, p1, p2, p3, p4) {
                return p1 + "-" + p2 + "-" + p3 + "-" + p4;
            }
        );

        nitInputEditar.val(formattedValueEditar);

        nitInputHiddenEditar.val(inputValueEditar);
    });

    nitInputEditar.on("keypress", function (event) {
        var keyCode = event.which;
        if (keyCode < 48 || keyCode > 57) {
            event.preventDefault();
        }
    });

    $("#imagen-empresa-editar").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".image-empresa-name-editar").text(fileName);

        if (fileName) {
            $(".text-label-image-editar").hide();
        } else {
            $(".text-label-image-editar").show();
        }
    });

    $("#imagen-empresa-leyenda-editar").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".image-empresa-name-leyenda-editar").text(fileName);

        if (fileName) {
            $(".text-label-image-leyenda-editar").hide();
        } else {
            $(".text-label-image-leyenda-editar").show();
        }
    });

    giroTextoInput.on("input", function () {
        const giroTexto = $(this).val().trim();

        idGiroHidden.val(giroTexto ? "" : giroTexto);
    });

    $("#empresaEditarForm").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const giroId = $("#id-giro-empresa-editar").val();
        const entidadId = $("#id-entidad-empresa-editar").val();

        if (!giroId || !entidadId) {
            mostrarToast(
                "Por favor, complete todos los campos obligatorios",
                "error"
            );
            return;
        }

        const nombreRS = document.querySelectorAll(
            'input[name^="socialEditar"]'
        );
        const enlaceRS = document.querySelectorAll(
            'input[name^="enlaceEditar"]'
        );

        for (let i = 0; i < nombreRS.length; i++) {
            const nombre = nombreRS[i].value.trim();
            const enlace = enlaceRS[i].value.trim();

            if (!nombre || !enlace) {
                mostrarToast(
                    "Por favor, complete todos los campos de las redes sociales",
                    "error"
                );
                return;
            }

            if (!isValidURL(enlace)) {
                mostrarToast("Por favor, ingrese una URL válida", "error");
                return;
            }
        }

        const formData = new FormData(form[0]);

        formData.append("giro_id", giroId);
        formData.append("entidad_id", entidadId);

        nombreRS.forEach((input, index) => {
            formData.append(`social[${index}]`, input.value);
        });

        enlaceRS.forEach((input, index) => {
            formData.append(`enlace[${index}]`, input.value);
        });

        const imagenInput = $("#imagen-empresa-editar")[0];
        if (imagenInput.files.length > 0) {
            formData.append("imagen", imagenInput.files[0]);
        }

        const imagenLeyendaInput = $("#imagen-empresa-leyenda-editar")[0];
        if (imagenLeyendaInput.files.length > 0) {
            formData.append("imagen_leyenda", imagenLeyendaInput.files[0]);
        }

        $.ajax({
            url: "/actualizar-empresa/" + $("#btn-editar-empresa").val(),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    mostrarToast(response.message, "success");
                    tabla_empresas.ajax.reload();
                    $("#editarEmpresa").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al actualizar la empresa. Por favor, inténtelo de nuevo.",
                    "error"
                );
            },
        });
    });

    function isValidURL(url) {
        try {
            new URL(url);
            return true;
        } catch (error) {
            return false;
        }
    }

    $("#editarEmpresa").on("hidden.bs.modal", function (e) {
        $("#empresaEditarForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();

        $("#camposEditar").empty();
        $("#agregarEditar").off("click");
        $("#ig-tab-editar").tab("show");
    });

    /* Eliminar empresas */
    $("#tabla-empresas").on("click", ".eliminar-empresa", function () {
        const empresaId = $(this).data("id");
        const empresaNombre = $(this)
            .closest("tr")
            .find("td:nth-child(2)")
            .text();

        $("#nombre-empresa").text(empresaNombre);
        $("#btn-eliminar-empresa").data("id", empresaId);
        $("#eliminarEmpresa").modal("show");
    });

    $("#btn-eliminar-empresa").on("click", function () {
        const empresaId = $(this).data("id");
        $.ajax({
            url: "/eliminar-empresa/" + empresaId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    mostrarToast(response.message, "success");
                    tabla_empresas.ajax.reload();
                    $("#eliminarEmpresa").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar la empresa. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    /* Eliminar red social */
    $("#camposEditar").on("click", ".eliminar-red-social", function () {
        var empresaId = $(this).data("empresa");
        var indice = $(this).data("indice");
        var redSocialId = $(this).data("red-social-id");
        var nombreRedSocial = $(this).data("nombre-red-social");

        $("#nombre-red-social").text(nombreRedSocial);

        $("#eliminarRedSocial").data("empresa", empresaId);
        $("#eliminarRedSocial").data("indice", indice);
        $("#eliminarRedSocial").data("red-social-id", redSocialId);
        $("#eliminarRedSocial").modal("show");
    });

    $("#btn-eliminar-red-social").on("click", function () {
        var empresaId = $("#eliminarRedSocial").data("empresa");
        var indice = $("#eliminarRedSocial").data("indice");
        var redSocialId = $("#eliminarRedSocial").data("red-social-id");

        $.ajax({
            url: `/redes-sociales/${redSocialId}?empresaId=${empresaId}`,
            type: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_empresas.ajax.reload();
                $("#nombre-editar-" + empresaId + "-" + indice)
                    .closest(".row")
                    .remove();

                $("#eliminarRedSocial").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (error) {
                console.error("Error al eliminar la red social:", error);
                $("#eliminarRedSocial").modal("hide");
            },
        });
    });

    $("#eliminarRedSocial").on("hidden.bs.modal", function (e) {
        $("#editarEmpresa").modal("show");
    });

    btnAgregar.addEventListener("click", (e) => {
        contadorCampos++;

        let div = document.createElement("div");
        div.className =
            "row pb-3 g-3 align-items-center justify-content-center";
        div.innerHTML = `
            <div class="col-md-5">
                <div class="form-group my-1">
                    <label for="nombre-rs-${contadorCampos}" class="text-label">Nombre</label>
                    <input autocomplete="off" id="nombre-rs-${contadorCampos}" type="text" name="social[]" class="form-control">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group my-1">
                    <label for="enlace-rs-${contadorCampos}" class="text-label">Enlace URL del perfil</label>
                    <input autocomplete="off" id="enlace-rs-${contadorCampos}" type="url" name="enlace[]" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn-redes btn btn-danger btnEliminar">Eliminar</button>
            </div>
        `;

        contenedor.appendChild(div);

        if (btnEliminar) {
            btnEliminar.style.display = "block";
        }
    });

    contenedor.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("btnEliminar")) {
            const divPadre = e.target.parentNode.parentNode;
            contenedor.removeChild(divPadre);
            if (contenedor.children.length === 0 && btnEliminar) {
                btnEliminar.style.display = "none";
            }
        }
    });

    agregarEditar.addEventListener("click", (e) => {
        contadorCamposEditar++;

        let div = document.createElement("div");
        div.className = "row g-3 align-items-center justify-content-center";
        div.innerHTML = `
            <div class="col-md-5">
                <div class="form-group my-1">
                    <label for="nombre-editar-${contadorCamposEditar}" class="text-label">Nombre</label>
                    <input autocomplete="off" id="nombre-editar-${contadorCamposEditar}" type="text" name="socialEditar[]" class="form-control" required>
                    <div class="invalid-feedback">
                        Ingrese un nombre válido
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group my-1">
                    <label for="enlace-editar-${contadorCamposEditar}" class="text-label">Enlace URL del perfil</label>
                    <input autocomplete="off" id="enlace-editar-${contadorCamposEditar}" type="url" name="enlaceEditar[]" class="form-control" required>
                    <div class="invalid-feedback">
                        Ingrese un enlace válido
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn-redes btn btn-danger btnEliminarEditar" data-contador="${contadorCamposEditar}">Eliminar</button>
            </div>
        `;

        contenedorEditar.appendChild(div);

        if (btnEliminarEditar) {
            btnEliminarEditar.style.display = "block";
        }
    });

    contenedorEditar.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("btnEliminarEditar")) {
            const divPadre = e.target.parentNode.parentNode;
            contenedorEditar.removeChild(divPadre);
            if (contenedorEditar.children.length === 0 && btnEliminarEditar) {
                btnEliminarEditar.style.display = "none";
            }
        }
    });
});

/* Cargar entidades */
function cargarEntidades(
    entidadSelectId,
    idEntidadInputId,
    editar,
    entidadActual
) {
    $.ajax({
        url: "/obtener-entidades",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const entidadSelect = $(entidadSelectId);
            entidadSelect.empty();
            entidadSelect.append(
                $("<option>", {
                    value: "",
                    text: "Seleccione una entidad",
                })
            );

            $.each(data, function (key, value) {
                entidadSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (editar && entidadActual) {
                entidadSelect.val(entidadActual);
            }

            $(idEntidadInputId).val(entidadSelect.val());
        },
        error: function (error) {
            console.log("Error al obtener las entidades");
        },
    });

    $(entidadSelectId).on("change", function () {
        var selectEntidadId = $(this).val();
        $(idEntidadInputId).val(selectEntidadId);
    });
}

/* Cargar clasificaciones */
function cargarClasificaciones(
    clasificacionSelectId,
    idClasificacionInputId,
    editar,
    clasificacionActual
) {
    $.ajax({
        url: "/obtener-clasificaciones",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const clasificacionSelect = $(clasificacionSelectId);
            clasificacionSelect.empty();
            clasificacionSelect.append(
                $("<option>", {
                    value: "",
                    text: "Seleccione una clasificación",
                })
            );

            $.each(data, function (key, value) {
                clasificacionSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (editar && clasificacionActual) {
                clasificacionSelect.val(clasificacionActual);
            }

            $(idClasificacionInputId).val(clasificacionSelect.val());
        },
        error: function (error) {
            console.log("Error al obtener las clasificaciones");
        },
    });

    $(clasificacionSelectId).on("change", function () {
        var selectClasificacionId = $(this).val();
        $(idClasificacionInputId).val(selectClasificacionId);
    });
}

/* Cargar redes sociales */
function agregarRedSocialHtml(empresaId, contadorCamposEditar, redSocial) {
    let redSocialHtml = `
        <div class="row g-3 pt-1 align-items-center justify-content-center">
            <div class="col-md-5">
                <div class="form-group text-center">
                    <label for="nombre-editar-${empresaId}-${contadorCamposEditar}" class="text-label">Nombre</label>
                    <input autocomplete="off" id="nombre-editar-${empresaId}-${contadorCamposEditar}" type="text" name="socialEditar[]" class="form-control" value="${redSocial.nombre}" required>
                    <div class="invalid-feedback">
                        Ingrese un nombre válido
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group text-center">
                    <label for="enlace-editar-${empresaId}-${contadorCamposEditar}" class="text-label">Enlace URL del perfil</label>
                    <input autocomplete="off" id="enlace-editar-${empresaId}-${contadorCamposEditar}" type="url" name="enlaceEditar[]" class="form-control" value="${redSocial.enlace}" required>
                    <div class="invalid-feedback">
                        Ingrese un enlace válido
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group btn-redes">
                    <button type="button" class="btn btn-danger eliminar-red-social" data-empresa="${empresaId}" data-indice="${contadorCamposEditar}" data-red-social-id="${redSocial.id}" data-nombre-red-social="${redSocial.nombre}">Eliminar</button>
                </div>
            </div>
        </div>
    `;

    $("#camposEditar").append(redSocialHtml);
}

/* Funciones para imprimir registros */
function empresasPrint() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "Empresas - Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>Empresas - Laboratorios Cofasa</title>"
    );
    printWindow.document.write(
        "<style>" +
        "body { font-family: Arial, sans-serif; }" +
        "table { border-collapse: collapse; width: 100%; margin-top: 20px; }" +
        "th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }" +
        "th { background-color: #f2f2f2; color: #333; font-size: 14px; font-weight: bold; }" +
        "tr:nth-child(even) { background-color: #f9f9f9; }" +
        "tr:hover { background-color: #f5f5f5; }" +
        "</style>"
    );
    printWindow.document.write("</head><body>");
    printWindow.document.write(
        '<h4 style="text-align: center;">Empresas - Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-empresas thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-empresas tbody tr").each(function () {
        const row = $(this).clone();
        row.find("td:last").remove();
        tbody.append(row);
    });
    printWindow.document.write(tbody.html());

    printWindow.document.write("</table>");
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
}