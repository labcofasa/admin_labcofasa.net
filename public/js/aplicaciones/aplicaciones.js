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
                "<'botones-filter'<B><f>>" +
                "<tr>" +
                "<'info-pagination'<i><p>>",
            serverSide: true,
            responsive: true,
            processing: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [10, 25, 50, -1],
                ["10 filas", "25 filas", "50 filas", "Todas las filas"],
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
                    text: "Nueva",
                    className: "btn btn-lg btn-store aplicacion d-block d-md-none",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearAplicacionBtn").click();
                    },
                },
                {
                    text: "Crear aplicación",
                    className: "btn btn-lg btn-store aplicacion d-none d-md-block",
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
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
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
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M2 8C2 8 6.47715 3 12 3C17.5228 3 22 8 22 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M21.544 13.045C21.848 13.4713 22 13.6845 22 14C22 14.3155 21.848 14.5287 21.544 14.955C20.1779 16.8706 16.6892 21 12 21C7.31078 21 3.8221 16.8706 2.45604 14.955C2.15201 14.5287 2 14.3155 2 14C2 13.6845 2.15201 13.4713 2.45604 13.045C3.8221 11.1294 7.31078 7 12 7C16.6892 7 20.1779 11.1294 21.544 13.045Z" stroke="currentColor" stroke-width="1.8" />
                                                        <path d="M15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17C13.6569 17 15 15.6569 15 14Z" stroke="currentColor" stroke-width="1.8" />
                                                    </svg>
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
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M16.9459 3.17305C17.5332 2.58578 17.8268 2.29215 18.1521 2.15173C18.6208 1.94942 19.1521 1.94942 19.6208 2.15173C19.946 2.29215 20.2397 2.58578 20.8269 3.17305C21.4142 3.76032 21.7079 4.05395 21.8483 4.37925C22.0506 4.8479 22.0506 5.37924 21.8483 5.84789C21.7079 6.17319 21.4142 6.46682 20.8269 7.05409L15.8054 12.0757C14.5682 13.3129 13.9496 13.9315 13.1748 14.298C12.4 14.6645 11.5294 14.7504 9.78823 14.9222L9 15L9.07778 14.2118C9.24958 12.4706 9.33549 11.6 9.70201 10.8252C10.0685 10.0504 10.6871 9.43183 11.9243 8.19464L16.9459 3.17305Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                                        <path d="M6 15H3.75C2.7835 15 2 15.7835 2 16.75C2 17.7165 2.7835 18.5 3.75 18.5H13.25C14.2165 18.5 15 19.2835 15 20.25C15 21.2165 14.2165 22 13.25 22H11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
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
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M19.5 5.5L18.8803 15.5251C18.7219 18.0864 18.6428 19.3671 18.0008 20.2879C17.6833 20.7431 17.2747 21.1273 16.8007 21.416C15.8421 22 14.559 22 11.9927 22C9.42312 22 8.1383 22 7.17905 21.4149C6.7048 21.1257 6.296 20.7408 5.97868 20.2848C5.33688 19.3626 5.25945 18.0801 5.10461 15.5152L4.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M9.5 16.5L9.5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M14.5 16.5L14.5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                    </svg>
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
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

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
