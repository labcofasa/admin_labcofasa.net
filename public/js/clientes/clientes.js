$(document).ready(function () {
    const obtenerClientes = "/tabla-clientes";
    let tabla_clientes = null;

    tablaClientes();

    function tablaClientes() {
        if (tabla_clientes) {
            tabla_clientes.destroy();
        }
        $("#tabla-clientes-container").hide();

        tabla_clientes = $("#tabla-clientes").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-9 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
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
                    className: "btn btn-lg btn-group-secondary",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Clientes registrados - Laboratorios Cofasa",
                            filename:
                                "Clientes registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Clientes registrados - Laboratorios Cofasa",
                            filename:
                                "Clientes registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Clientes registrados - Laboratorios Cofasa",
                            filename:
                                "Clientes registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Clientes registrados - Laboratorios Cofasa",
                            filename:
                                "Clientes registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printClientes();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay clientes registrados",
            },
            ajax: {
                url: obtenerClientes,
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
                    targets: [0, 1, 2, 3, 4, 5, 6, 7],
                    className: "nowrap",
                },
                {
                    targets: [0, 1, 2, 3, 4, 5, 6, 7],
                    searchable: true,
                    orderable: false,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-clientes-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "codigo", title: "Codigo" },
                { data: "nrc", title: "NRC" },
                { data: "establecimiento", title: "Establecimiento" },
                { data: "propietario", title: "Propietario" },
                { data: "fecha_registro", title: "Fecha de registro" },
                { data: "usuario_registro", title: "Usuario creador" },
                { data: "email", title: "Correo" },
            ],
            order: [[3, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputClientes = $("#tabla-clientes_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputClientes.attr("id", "buscar-cliente");
                inputClientes.attr("name", "buscar_cliente");
                inputClientes.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputClientes.before(iconSvg);

                inputClientes.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_clientes.search(inputValue).draw();
                    }, 500);
                });

                inputClientes.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_clientes.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_clientes.on("draw.dt", function () {
            $("#tabla-clientes_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-clientes-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 4;
});