$(document).ready(function () {
    const obtenerAvisos = "/tabla-avisos";
    let tabla_avisos = null;

    tablaAvisos();

    function tablaAvisos() {
        if (tabla_avisos) {
            tabla_avisos.destroy();
        }
        $("#tabla-avisos-container").hide();

        tabla_avisos = $("#tabla-avisos").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-9 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 mb-4 px-0'p>>",
            serverSide: true,
            processing: true,
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
                    text: "Crear registro",
                    className: "btn btn-lg btn-store aviso",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearAvisoBtn").click();
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
                            title: "Avisos registrados - Laboratorios Cofasa",
                            filename:
                                "Avisos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Avisos registrados - Laboratorios Cofasa",
                            filename:
                                "Avisos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Avisos registrados - Laboratorios Cofasa",
                            filename:
                                "Avisos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Avisos registrados - Laboratorios Cofasa",
                            filename:
                                "Avisos registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printAvisos();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay avisos registrados",
            },
            ajax: {
                url: obtenerAvisos,
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
                    targets: [0, 7],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 2, 3, 4, 5, 6, 7],
                    className: "nowrap",
                },
                {
                    targets: [1],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4, 5, 6],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 7 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-avisos-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre", title: "Nombre" },
                { data: "imagen", title: "Imagen" },
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
                    targets: [7],
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
                                                "admin_avisos_editar" ||
                                            permission.name ===
                                                "admin_avisos_eliminar"
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
                                                            "admin_avisos_editar"
                                                    )
                                                        ? `
                                                        <li>
                                                            <button class="dropdown-item editar-aviso nav-link" data-id="${row.id}" type="button">
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
                                                            "admin_avisos_eliminar"
                                                    )
                                                        ? `
                                                        <li>
                                                            <button class="dropdown-item eliminar-aviso nav-link" data-id="${row.id}" type="button">
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
            order: [[3, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputAvisos = $("#tabla-avisos_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) => permission.name === "admin_avisos_crear"
                    )
                ) {
                    $(".aviso").addClass("d-none");
                }

                btnSecondaryElements.removeClass("btn-secondary");

                inputAvisos.attr("id", "buscar-aviso");
                inputAvisos.attr("name", "buscar_aviso");
                inputAvisos.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputAvisos.before(iconSvg);

                inputAvisos.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_avisos.search(inputValue).draw();
                    }, 500);
                });

                inputAvisos.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_avisos.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_avisos.on("draw.dt", function () {
            $("#tabla-avisos_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-avisos-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 4;

    $("#crearAvisoBtn").click(function () {
        $("#crearAviso").modal("show");
    });

    $("#aviso-imagen").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".nombre-aviso").text(fileName);

        if (fileName) {
            $(".text-label-image").hide();
        } else {
            $(".text-label-image").show();
        }
    });

    $("#avisoForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const imagenInput = $("#aviso-imagen")[0];
        const formData = new FormData(form[0]);

        if (imagenInput.files.length > 0) {
            formData.append("imagen", imagenInput.files[0]);
        }

        $.ajax({
            url: "/crear-avisos",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_avisos.ajax.reload();

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $("#crearAviso").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al crear el aviso. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#crearAviso").on("hidden.bs.modal", function () {
        $("#avisoForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();
    });

    $("#tabla-avisos").on("click", ".editar-aviso", function () {
        var avisoId = $(this).data("id");
        var row = tabla_avisos.row($(this).parents("tr")).data();
        var nombre = row.nombre;

        $("#editarAvisoForm #btn-editar-aviso").val(avisoId);
        $("#editarAvisoForm #nombre-aviso-editar").val(nombre);
        $(".imagen-aviso-nombre-editar").text(row.imagen);
        $("#editarAviso").modal("show");
    });

    $("#imagen-aviso-editar").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".imagen-aviso-nombre-editar").text(fileName);

        if (fileName) {
            $(".text-label-imagen-editar").hide();
        } else {
            $(".text-label-imagen-editar").show();
        }
    });

    $("#editarAvisoForm").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const formData = new FormData(form[0]);

        const imagenInput = $("#imagen-aviso-editar")[0];
        if (imagenInput.files.length > 0) {
            formData.append("imagen", imagenInput.files[0]);
        }

        $.ajax({
            url: "/actualizar-aviso/" + $("#btn-editar-aviso").val(),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_avisos.ajax.reload();

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $("#editarAviso").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al editar el aviso. Detalles: " + errorThrown,
                    "error"
                );
            },
        });
    });

    $("#editarAviso").on("hidden.bs.modal", function () {
        $("#editarAvisoForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();
    });

    /* Eliminar aviso */
    $("#tabla-avisos").on("click", ".eliminar-aviso", function () {
        const avisoId = $(this).data("id");
        const avisoNombre = $(this)
            .closest("tr")
            .find("td:nth-child(2)")
            .text();

        $("#nombre-aviso").text(avisoNombre);
        $("#btn-eliminar-aviso").data("id", avisoId);
        $("#eliminarAviso").modal("show");
    });

    $("#btn-eliminar-aviso").on("click", function () {
        const avisoId = $(this).data("id");
        $.ajax({
            url: "/eliminar-aviso/" + avisoId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_avisos.ajax.reload();

                $("#eliminarAviso").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el aviso. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });
});

/* Imprimir aviso */
function printAvisos() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "Avisos- Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>Avisos- Laboratorios Cofasa</title>"
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
        '<h4 style="text-align: center;">Avisos- Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-avisos thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-avisos tbody tr").each(function () {
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
