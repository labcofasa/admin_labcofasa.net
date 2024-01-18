$(document).ready(function () {
    const apiPapelera = "/obtener-eliminados";
    let tabla_papelera = null;

    function tablaPapelera() {
        if (tabla_papelera) {
            tabla_papelera.destroy();
        }

        $("#tabla-papelera-container").hide();

        tabla_papelera = $("#tabla-papelera").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-6 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
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
                    className:
                        "btn btn-lg btn-group-secondary btn-border-right d-lg-none",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printPapelera();
                            },
                        },
                        {
                            extend: "pdf",
                            text: "PDF",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
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
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printPapelera();
                            },
                        },
                        {
                            extend: "pdf",
                            text: "PDF",
                            title: "Registro eliminados - Laboratorios Cofasa",
                            filename:
                                "Registro eliminados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar eliminados",
                emptyTable: "No hay registros eliminados",
            },
            ajax: {
                url: apiPapelera,
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
                $("#tabla-papelera-container").show();
            },
            columnDefs: [
                {
                    targets: [0, 5],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [1, 2, 3, 4],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: -1 },
                { responsivePriority: 2, targets: -2 },
            ],
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre", title: "Nombre del registro" },
                { data: "nombre_tabla", title: "Tabla eliminado" },
                { data: "deleted_at", title: "Fecha de eliminación" },
                {
                    data: "user_deleted_name",
                    title: "Usuario eliminador",
                    defaultContent: "",
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        var userPermissions = JSON.parse(
                            document.getElementById("userPermissions").value
                        );

                        return `
                                <div class="btn-toolbar">
                                    <div class="btn-group" role="group">
                                    ${
                                        userPermissions.some(
                                            (permission) =>
                                                permission.name ===
                                                "admin_papelera_recuperar"
                                        )
                                            ? `
                                        <button class="btn btn-success restaurar-registro" data-table="${row.nombre_tabla}" data-id="${row.id}">
                                            <svg class="icon-success" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 3c-4.97 0-9 4.03-9 9H1l4 3.99L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.25 2.52.77-1.28-3.52-2.09V8z"/></svg>
                                        </button>
                                        `
                                            : ""
                                    }
                                    </div>
                                </div>
                            `;
                    },
                },
            ],
            order: [[3, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputPapelera = $("#tabla-papelera_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputPapelera.attr("id", "buscar-papelera");
                inputPapelera.attr("name", "buscar_papelera");
                inputPapelera.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputPapelera.before(iconSvg);

                inputPapelera.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_papelera.search(inputValue).draw();
                    }, 500);
                });

                inputPapelera.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_papelera.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_papelera.on("draw.dt", function () {
            $("#tabla-papelera_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-papelera-container").show();
        });
    }

    tablaPapelera();

    $("#tabla-papelera").on("click", ".restaurar-registro", function () {
        const id = $(this).data("id");
        const table = $(this).data("table");
        const registroNombre = $(this)
            .closest("tr")
            .find("td:nth-child(2)")
            .text();

        $("#nombre-registro").text(registroNombre);
        $("#btn-restaurar-registro").data("id", id);
        $("#btn-restaurar-registro").data("table", table);
        $("#restaurarRegistro").modal("show");
    });

    $("#btn-restaurar-registro").on("click", function () {
        const table = $(this).data("table");
        const id = $(this).data("id");

        $.ajax({
            type: "GET",
            url: `/restore/${table}/${id}`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_papelera.ajax.reload();

                $("#restaurarRegistro").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al restaurar el registro. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    /* Notificaciones */
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

    /* Imprimir registros eliminados */
    function printPapelera() {
        const printWindow = window.open("", "_blank");
        printWindow.document.title =
            "Registros eliminados - Laboratorios Cofasa";
        printWindow.document.write(
            "<html><head><title>Registros eliminados - Laboratorios Cofasa</title>"
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
            '<h4 style="text-align: center;">Registros eliminados - Laboratorios Cofasa</h4>'
        );
        printWindow.document.write("<table>");

        const headers = $("#tabla-papelera thead tr").clone();
        headers.find("th:last").remove();
        printWindow.document.write("<thead>" + headers.html() + "</thead>");

        const tbody = $("<tbody></tbody>");
        $("#tabla-papelera tbody tr").each(function () {
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
