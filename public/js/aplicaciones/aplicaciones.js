$(document).ready(function () {
    const obtenerAplicaciones = "/tabla-aplicaciones";
    let tabla_aplicaciones = null;

    tablaAplicaciones();

    function tablaAplicaciones() {
        if (tabla_aplicaciones) {
            tabla_aplicaciones.destroy();
        }
        $("#tabla-aplicaciones-container").hide();

        tabla_aplicaciones = $("#tabla-aplicaciones").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-9 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 mb-4 px-0'p>>",
            serverSide: true,
            responsive: true,
            processing: true,
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
                    text: "Crear registro",
                    className: "btn btn-lg btn-store aplicacion",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearAplicacionBtn").click();
                    },
                },
                {
                    extend: "collection",
                    text: "Exportar",
                    className: "btn btn-lg btn-group-secondary",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Aplicaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Aplicaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Aplicaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Aplicaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Aplicaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Aplicaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Aplicaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Aplicaciones registradas - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printAplicaciones();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay aplicaciones registradas",
            },
            ajax: {
                url: obtenerAplicaciones,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 401) {
                        window.location.href = "/";
                    } else {
                        console.error("Error en la solicitud Ajax:", error);
                    }
                },
            },
            columnDefs: [
                {
                    targets: [0, 10],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 1, 2, 5, 6, 7, 8, 9, 10],
                    className: "nowrap",
                },
                {
                    targets: [3, 4],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4, 5, 6, 7, 8, 9],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 10 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-aplicaciones-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre_aplicacion", title: "Nombre" },
                {
                    data: "roles",
                    title: "Roles permitidos",
                    render: function (data, type, row) {
                        var roles = data
                            .map(function (rol) {
                                return rol.name;
                            })
                            .join("<br>");

                        return roles;
                    },
                },
                { data: "imagen_aplicacion", title: "Imagen" },
                { data: "enlace_aplicacion", title: "Url" },
                { data: "nombre_empresa", title: "Empresa" },
                { data: "created_at", title: "Fecha creación" },
                {
                    data: "user_name",
                    title: "Usuario creador",
                    defaultContent: "",
                },
                { data: "updated_at", title: "Fecha modificación" },
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
                                ${
                                    userPermissions.some(
                                        (permission) =>
                                            permission.name ===
                                                "admin_aplicaciones_ver" ||
                                            permission.name ===
                                                "admin_aplicaciones_editar" ||
                                            permission.name ===
                                                "admin_aplicaciones_eliminar"
                                    )
                                        ? `
                                    <div class="btn-group">
                                        <button class="btn-icon-close dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                        ${
                                            userPermissions.some(
                                                (permission) =>
                                                    permission.name ===
                                                    "admin_aplicaciones_ver"
                                            )
                                                ? `
                                            <li>
                                                <button class="dropdown-item ver-aplicacion nav-link" data-url="${row.enlace_aplicacion}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/></svg>
                                                    <span class="link">Ver aplicación</span>
                                                </button>
                                            </li>`
                                                : ""
                                        }
                                    ${
                                        userPermissions.some(
                                            (permission) =>
                                                permission.name ===
                                                "admin_aplicaciones_editar"
                                        )
                                            ? `
                                            <li>
                                                <button class="dropdown-item editar-aplicacion nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                                    <span class="link">Editar</span>
                                                </button>
                                            </li>`
                                            : ""
                                    }
                                    ${
                                        userPermissions.some(
                                            (permission) =>
                                                permission.name ===
                                                "admin_aplicaciones_eliminar"
                                        )
                                            ? `
                                            <li>
                                                <button class="dropdown-item eliminar-aplicacion nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                                                    <span class="link">Eliminar</span>
                                                </button>
                                            </li>`
                                            : ""
                                    }
                                        </ul>
                                    </div>`
                                        : ""
                                }
                                </div>
                            `;
                    },
                },
            ],
            order: [[4, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputAplicaciones = $("#tabla-aplicaciones_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) =>
                            permission.name === "admin_aplicaciones_crear"
                    )
                ) {
                    $(".aplicacion").addClass("d-none");
                }

                btnSecondaryElements.removeClass("btn-secondary");

                inputAplicaciones.attr("id", "buscar-aplicacion");
                inputAplicaciones.attr("name", "buscar_aplicacion");
                inputAplicaciones.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputAplicaciones.before(iconSvg);

                inputAplicaciones.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_aplicaciones.search(inputValue).draw();
                    }, 500);
                });

                inputAplicaciones.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_aplicaciones.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_aplicaciones.on("draw.dt", function () {
            $("#tabla-aplicaciones_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-aplicaciones-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 4;

    $("#tabla-aplicaciones").on("click", ".ver-aplicacion", function () {
        const url = $(this).data("url");
        window.open(url, "_blank");
    });

    $("#crearAplicacionBtn").click(function () {
        $("#roles-editar").empty();
        obtenesRoles();
        cargarEmpresas(
            "#empresa-aplicacion-select",
            "#id-empresa-aplicacion",
            false
        );
        window.MultiselectDropdown();
        $("#crearAplicacion").modal("show");
    });

    $("#aplicacion-imagen").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".nombre-aplicacion").text(fileName);

        if (fileName) {
            $(".text-label-image").hide();
        } else {
            $(".text-label-image").show();
        }
    });

    $("#aplicacionForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const imagenInput = $("#aplicacion-imagen")[0];
        const formData = new FormData(form[0]);

        if (imagenInput.files.length > 0) {
            formData.append("imagen_aplicacion", imagenInput.files[0]);
        }

        const empresaId = $("#id-empresa-aplicacion").val();
        if (!empresaId) {
            mostrarToast("Por favor, seleccione una empresa válida", "error");
            return;
        }

        formData.append("empresa_id", empresaId);

        const selectedRoles = $("#roles").val();

        if (selectedRoles && selectedRoles.length > 0) {
            selectedRoles.forEach((roleId) => {
                formData.append("roles[]", roleId);
            });
        }

        $.ajax({
            url: "/crear-aplicaciones",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_aplicaciones.ajax.reload();

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $("#crearAplicacion").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al crear la aplicación. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#crearAplicacion").on("hidden.bs.modal", function () {
        $("#aplicacionForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();

        $(".multiselect-dropdown").remove();
    });

    /* Editar aplicación */
    $("#tabla-aplicaciones").on("click", ".editar-aplicacion", function () {
        var aplicacionId = $(this).data("id");
        var row = tabla_aplicaciones.row($(this).parents("tr")).data();

        var nombre_aplicacion = row.nombre_aplicacion;
        var enlace_aplicacion = row.enlace_aplicacion;
        var empresaId = row.id_empresa;
        var nombreEmpresa = row.nombre_empresa;

        $("#roles-editar").empty();
        $("#editarAplicacionForm #empresa-aplicacion-editar").empty();

        $("#editarAplicacionForm #empresa-aplicacion-editar").append(
            $("<option>", {
                value: empresaId,
                text: nombreEmpresa,
                selected: true,
            })
        );

        $.ajax({
            type: "GET",
            url: "/obtener-roles-apps",
            success: function (response) {
                if (typeof response === "object" && response !== null) {
                    var rolesCompletos = Object.entries(response).map(
                        ([id, name]) => ({ id, name })
                    );

                    if (rolesCompletos.length > 0) {
                        rolesCompletos.forEach(function (rol) {
                            var selected =
                                row.roles &&
                                row.roles.some(function (appRole) {
                                    return appRole.id == rol.id;
                                });

                            var option = $("<option>", {
                                value: rol.id,
                                text: rol.name,
                                selected: selected,
                            });

                            $("#roles-editar").append(option);
                        });
                    } else {
                        console.error(
                            "La respuesta no contiene roles válidos."
                        );
                    }
                } else {
                    console.error("La respuesta no es un objeto válido.");
                }

                $("#editarAplicacionForm #btn-editar-aplicacion").val(
                    aplicacionId
                );
                $("#editarAplicacionForm #nombre-aplicacion-editar").val(
                    nombre_aplicacion
                );
                $("#editarAplicacionForm #enlace-aplicacion-editar").val(
                    enlace_aplicacion
                );
                $(".imagen-aplicacion-nombre-editar").text(
                    row.imagen_aplicacion
                );

                window.MultiselectDropdown();

                cargarEmpresas(
                    "#empresa-aplicacion-editar",
                    "#id-empresa-aplicacion-editar",
                    true,
                    empresaId
                );

                $("#editarAplicacion").modal("show");
            },
            error: function (error) {
                console.error("Error al obtener roles:", error);
            },
        });
    });

    $("#imagen-aplicacion-editar").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".imagen-aplicacion-nombre-editar").text(fileName);

        if (fileName) {
            $(".text-label-imagen-editar").hide();
        } else {
            $(".text-label-imagen-editar").show();
        }
    });

    $("#editarAplicacionForm").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const formData = new FormData(form[0]);

        const imagenInput = $("#imagen-aplicacion-editar")[0];
        if (imagenInput.files.length > 0) {
            formData.append("imagen_aplicacion", imagenInput.files[0]);
        }

        const empresaId = $("#id-empresa-aplicacion-editar").val();
        formData.append("empresa_id", empresaId);

        const selectedRoles = $("#roles-editar").val();
        if (selectedRoles && selectedRoles.length > 0) {
            selectedRoles.forEach((roleId) => {
                formData.append("roles[]", roleId);
            });
        }

        $.ajax({
            url: "/actualizar-aplicacion/" + $("#btn-editar-aplicacion").val(),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_aplicaciones.ajax.reload();

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $("#editarAplicacion").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al editar la aplicación. Detalles: " + errorThrown,
                    "error"
                );
            },
        });
    });

    $("#editarAplicacion").on("hidden.bs.modal", function () {
        $("#editarAplicacionForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();

        $(".multiselect-dropdown").remove();
    });

    /* Eliminar aplicación */
    $("#tabla-aplicaciones").on("click", ".eliminar-aplicacion", function () {
        const aplicacionId = $(this).data("id");
        const aplicacionNombre = $(this)
            .closest("tr")
            .find("td:nth-child(2)")
            .text();

        $("#nombre-aplicacion").text(aplicacionNombre);
        $("#btn-eliminar-aplicacion").data("id", aplicacionId);
        $("#eliminarAplicacion").modal("show");
    });

    $("#btn-eliminar-aplicacion").on("click", function () {
        const aplicacionId = $(this).data("id");
        $.ajax({
            url: "/eliminar-aplicacion/" + aplicacionId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_aplicaciones.ajax.reload();

                $("#eliminarAplicacion").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar la aplicación. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });
});

// Cargar empresas */
function cargarEmpresas(
    empresaSelectId,
    idEmpresaInputId,
    editar,
    empresaActual
) {
    $.ajax({
        url: "/obtener-empresas",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const empresaSelect = $(empresaSelectId);
            empresaSelect.empty();
            empresaSelect.append(
                $("<option>", {
                    value: "",
                    text: "Selecciona una empresa",
                })
            );

            $.each(data, function (key, value) {
                empresaSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (editar && empresaActual) {
                empresaSelect.val(empresaActual);
            }

            $(idEmpresaInputId).val(empresaSelect.val());
        },
        error: function (error) {
            console.log("Error al obtener las empresas");
        },
    });

    $(empresaSelectId).on("change", function () {
        var selectEmpresaId = $(this).val();
        $(idEmpresaInputId).val(selectEmpresaId);
    });
}

var rolesData = {};

function obtenesRoles() {
    $.ajax({
        url: "/obtener-roles-apps",
        type: "GET",
        dataType: "json",
        success: function (data) {
            var select = $("#roles");

            select.empty();
            rolesData = {};

            for (var roleId in data) {
                if (data.hasOwnProperty(roleId)) {
                    rolesData[roleId] = data[roleId];
                    select.append(
                        $("<option>", {
                            value: roleId,
                            text: data[roleId],
                        })
                    );
                }
            }

            if (select[0].loadOptions) {
                select[0].loadOptions();
            }
        },
        error: function (error) {
            console.error("Error al obtener datos desde el servidor:", error);
        },
    });
}

/* Imprimir aplicacion */
function printAplicaciones() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "Aplicaciones - Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>Aplicaciones - Laboratorios Cofasa</title>"
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
        '<h4 style="text-align: center;">Aplicaciones - Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-aplicaciones thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-aplicaciones tbody tr").each(function () {
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
