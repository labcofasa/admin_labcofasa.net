$(document).ready(function () {
    const apiTablaClasificaciones = "/tabla-clasificaciones";
    let tabla_clasificaciones = null;

    function tablaClasificaciones() {
        if (tabla_clasificaciones) {
            tabla_clasificaciones.destroy();
        }

        $("#spinnerClasificacion").show();
        $("#tabla-clasificaciones-container").hide();

        tabla_clasificaciones = $("#tabla-clasificaciones").DataTable({
            dom:
                "<'row'<'col-md-8 col-sm-6 col-12'B><'col-md-4 col-sm-6 col-12 mt-1'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-2'i><'col-md-7'p>>",
            serverSide: true,
            responsive: true,
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
                    extend: "collection",
                    text: "Exportar",
                    className: "btn btn-lg btn-group-secondary d-lg-none",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Clasificaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Clasificaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Clasificaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Clasificaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Clasificaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Clasificaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Clasificaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Clasificaciones registradas - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                clasificacionPrint();
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
                            title: "Clasificaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Clasificaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Clasificaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Clasificaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Clasificaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Clasificaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Clasificaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Clasificaciones registradas - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                clasificacionPrint();
                            },
                        },
                    ],
                },
                {
                    text: "Registrar clasificación",
                    className: "btn btn-lg btn-store d-none d-lg-block",
                    action: function (e, dt, node, config) {
                        document
                            .getElementById("crearClasificacionBtn")
                            .click();
                    },
                },
                {
                    text: "Registrar",
                    className: "btn btn-lg btn-store d-lg-none",
                    action: function (e, dt, node, config) {
                        document
                            .getElementById("crearClasificacionBtn")
                            .click();
                    },
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar clasificaciones",
                emptyTable: "No hay clasificaciones registradas",
            },
            ajax: {
                url: apiTablaClasificaciones,
                type: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            },
            columnDefs: [
                {
                    targets: [0, 7],
                    searchable: false,
                    orderable: false,
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
            columns: [
                { data: "contador" },
                { data: "nombre" },
                { data: "codigo" },
                { data: "created_at" },
                { data: "user_name", defaultContent: "" },
                { data: "updated_at" },
                { data: "user_modified_name", defaultContent: "" },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                                <div class="text-center">
                                    <div class="btn-group">
                                        <button class="btn-icon-close dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                            <li>
                                                <button class="dropdown-item editar-clasificacion" data-id="${row.id}" type="button">
                                                    <span class="link">Editar clasificación</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item eliminar-clasificacion" data-id="${row.id}" type="button">
                                                    <span class="link">Eliminar clasificación</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            `;
                    },
                },
            ],
            order: [[3, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputClasificacion = $(
                    "#tabla-clasificaciones_filter input"
                );
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputClasificacion.attr("id", "buscar-clasificacion");
                inputClasificacion.attr("name", "buscar_clasificacion");
                inputClasificacion.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputClasificacion.before(iconSvg);

                inputClasificacion.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_clasificaciones.search(inputValue).draw();
                    }, 500);
                });

                inputClasificacion.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_clasificaciones.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_clasificaciones.on("draw.dt", function () {
            $("#tabla-clasificaciones_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#spinnerClasificacion").hide();
            $("#tabla-clasificaciones-container").show();
        });
    }

    $("#clasificacionModal").on("shown.bs.modal", function () {
        tablaClasificaciones();
        tabla_clasificaciones.columns.adjust().responsive.recalc();
    });

    $.fn.DataTable.ext.pager.numbers_length = 4;

    $("#crearClasificacionBtn").click(function () {
        $("#crearClasificacion").modal("show");
    });

    $("#clasificacionForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const formData = form.serialize();

        $.ajax({
            url: "/crear-clasificacion",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_clasificaciones.ajax.reload();

                $("#crearClasificacion").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar la clasificación. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#crearClasificacion").on("hidden.bs.modal", function () {
        $("#clasificacionForm")[0].reset();
        $("#clasificacionForm").removeClass("was-validated");
    });

    $("#tabla-clasificaciones").on(
        "click",
        ".editar-clasificacion",
        function () {
            var id = $(this).data("id");
            var row = tabla_clasificaciones.row($(this).parents("tr")).data();

            $("#btn-editar-clasificacion").val(id);
            $("#clasificacion-editar-nombre").val(row.nombre);
            $("#clasificacion-editar-codigo").val(row.codigo);

            $("#editarClasificacion").modal("show");
        }
    );

    $("#clasificacionEditarForm").submit(function (e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serializeArray();

        $.ajax({
            url:
                "/actualizar-clasificacion/" +
                $("#btn-editar-clasificacion").val(),
            method: "PUT",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_clasificaciones.ajax.reload();
                $("#editarClasificacion").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al actualizar la clasificación: " + jqXHR.statusText,
                    "error"
                );
            },
        });
    });

    $("#editarClasificacion").on("hidden.bs.modal", function () {
        $("#clasificacionEditarForm")[0].reset();
        $("#clasificacionEditarForm").removeClass("was-validated");
    });

    $("#tabla-clasificaciones").on(
        "click",
        ".eliminar-clasificacion",
        function () {
            const clasificacionId = $(this).data("id");
            const clasificacionNombre = $(this)
                .closest("tr")
                .find("td:nth-child(2)")
                .text();

            $("#nombre-clasificacion").text(clasificacionNombre);
            $("#btn-eliminar-clasificacion").data("id", clasificacionId);
            $("#eliminarClasificacion").modal("show");
        }
    );

    $("#btn-eliminar-clasificacion").on("click", function () {
        const clasificacionId = $(this).data("id");
        $.ajax({
            url: "/eliminar-clasificacion/" + clasificacionId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_clasificaciones.ajax.reload();

                $("#eliminarClasificacion").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar la clasificación. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    /* Funciones para imprimir registros */
    function clasificacionPrint() {
        const printWindow = window.open("", "_blank");
        printWindow.document.title = "Clasificaciones - Laboratorios Cofasa";
        printWindow.document.write(
            "<html><head><title>Clasificaciones - Laboratorios Cofasa</title>"
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
            '<h4 style="text-align: center;">Clasificaciones - Laboratorios Cofasa</h4>'
        );
        printWindow.document.write("<table>");

        const headers = $("#tabla-clasificaciones thead tr").clone();
        headers.find("th:last").remove();
        printWindow.document.write("<thead>" + headers.html() + "</thead>");

        const tbody = $("<tbody></tbody>");
        $("#tabla-clasificaciones tbody tr").each(function () {
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
});
