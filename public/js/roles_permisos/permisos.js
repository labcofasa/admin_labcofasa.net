$(document).ready(function () {
    const apiPermisos = "/obtener-permisos";
    let tabla_permisos = null;

    function tablaPermisos() {
        if (tabla_permisos) {
            tabla_permisos.destroy();
        }

        $("#tabla-permisos-container").hide();

        tabla_permisos = $("#tabla-permisos").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-6 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
            serverSide: true,
            processing: true,
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
                    className:
                        "btn-border-right btn btn-lg btn-group-secondary d-lg-none",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printPermisos();
                            },
                        },
                        {
                            extend: "pdf",
                            text: "PDF",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
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
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printPermisos();
                            },
                        },
                        {
                            extend: "pdf",
                            text: "PDF",
                            title: "Permisos - Laboratorios Cofasa",
                            filename: "Permisos - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay permisos registrados",
            },
            ajax: {
                url: apiPermisos,
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
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-permisos-container").show();
            },
            columnDefs: [
                {
                    targets: [0],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 3, 4],
                    className: "nowrap",
                },
                {
                    targets: [1, 2],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4],
                    searchable: true,
                    orderable: true,
                },
            ],
            columns: [
                { data: "contador", title: "#" },
                { data: "name", title: "Nombre del permiso" },
                { data: "descripcion", title: "Descrición" },
                { data: "created_at", title: "Fecha de creación" },
                { data: "updated_at", title: "Fecha de actualización" },
            ],

            order: [[3, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputPermisos = $("#tabla-permisos_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputPermisos.attr("id", "buscar-permiso");
                inputPermisos.attr("name", "buscar_permiso");
                inputPermisos.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputPermisos.before(iconSvg);

                inputPermisos.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_permisos.search(inputValue).draw();
                    }, 500);
                });

                inputPermisos.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_permisos.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_permisos.on("draw.dt", function () {
            $("#tabla-permisos_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-permisos-container").show();
        });
    }

    tablaPermisos();

    $.fn.DataTable.ext.pager.numbers_length = 4;

    /* Imprimir permisos */
    function printPermisos() {
        const printWindow = window.open("", "_blank");
        printWindow.document.title = "Permisos - Laboratorios Cofasa";
        printWindow.document.write(
            "<html><head><title>Permisos - Laboratorios Cofasa</title>"
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
            '<h4 style="text-align: center;">Permisos - Laboratorios Cofasa</h4>'
        );
        printWindow.document.write("<table>");

        const headers = $("#tabla-permisos thead tr").clone();
        printWindow.document.write("<thead>" + headers.html() + "</thead>");

        const tbody = $("<tbody></tbody>");
        $("#tabla-permisos tbody tr").each(function () {
            const row = $(this).clone();
            tbody.append(row);
        });
        printWindow.document.write(tbody.html());

        printWindow.document.write("</table>");
        printWindow.document.write("</body></html>");
        printWindow.document.close();
        printWindow.print();
    }
});
