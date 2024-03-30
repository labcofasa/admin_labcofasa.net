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
                "<'botones-filter'<B><f>>" +
                "<tr>" +
                "<'info-pagination'<i><p>>",
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
                searchPlaceholder: "Buscar",
                emptyTable: "No hay registros eliminados",
            },
            ajax: {
                url: apiPapelera,
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
                $("#tabla-papelera-container").show();
            },
            columnDefs: [
                {
                    targets: [0, 5],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 2, 3, 4, 5],
                    className: "nowrap",
                },
                {
                    targets: [1],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 2 },
                { responsivePriority: 2, targets: 5 },
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
                                            <svg class="icon-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                <path d="M20.25 5.5L19.75 11.5M5.25 5.5L5.85461 15.5368C6.00945 18.1073 6.08688 19.3925 6.72868 20.3167C7.046 20.7737 7.4548 21.1594 7.92905 21.4493C8.51127 21.8051 9.21343 21.945 10.25 22" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                <path d="M11.75 15.5L12.8863 16.9657C13.458 14.8319 15.6514 13.5655 17.7852 14.1373C18.8775 14.43 19.7425 15.1475 20.25 16.0646M21.75 20.5L20.6137 19.0363C20.0419 21.1701 17.8486 22.4365 15.7147 21.8647C14.6478 21.5788 13.7977 20.8875 13.2859 20.001" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M3.75 5.5H21.75M16.8057 5.5L16.1231 4.09173C15.6696 3.15626 15.4428 2.68852 15.0517 2.39681C14.965 2.3321 14.8731 2.27454 14.777 2.2247C14.3439 2 13.8241 2 12.7845 2C11.7188 2 11.186 2 10.7457 2.23412C10.6481 2.28601 10.555 2.3459 10.4673 2.41317C10.0716 2.7167 9.85063 3.20155 9.40861 4.17126L8.80292 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            </svg>
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
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

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
