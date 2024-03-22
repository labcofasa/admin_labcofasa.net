$(document).ready(function () {
    const obtenerArticulos = "/tabla-articulos";
    let tabla_articulos = null;

    tablaArticulos();

    function tablaArticulos() {
        if (tabla_articulos) {
            tabla_articulos.destroy();
        }
        $("#tabla-articulos-container").hide();

        tabla_articulos = $("#tabla-articulos").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-9 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
            serverSide: true,
            responsive: true,
            processing: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [10, 25, 100, -1],
                ["10 filas", "25 filas", "100 filas", "Todas las filas"],
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
                            title: "Articulos registrados - Laboratorios Cofasa",
                            filename:
                                "Articulos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Articulos registrados - Laboratorios Cofasa",
                            filename:
                                "Articulos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Articulos registrados - Laboratorios Cofasa",
                            filename:
                                "Articulos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Articulos registrados - Laboratorios Cofasa",
                            filename:
                                "Articulos registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printArticulos();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay articulos registrados",
            },
            ajax: {
                url: obtenerArticulos,
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
                    targets: [0],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 2, 3, 4, 5, 6, 7, 8],
                    className: "nowrap",
                },
                {
                    targets: [1],
                    className: "wrap",
                },
                {
                    targets: [0, 1, 2, 3, 4, 5, 6, 7],
                    searchable: true,
                    orderable: false,
                },
                // { responsivePriority: 1, targets: 1 },
                // { responsivePriority: 2, targets: 2 },
                // { responsivePriority: 3, targets: 14 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-articulos-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre", title: "Nombre" },
                { data: "descripcion", title: "Descripción" },
                { data: "costo", title: "Costo" },
                { data: "existencia", title: "Existencia" },
                { data: "precio_farmacia", title: "Precio farmacia" },
                { data: "precio_publico", title: "Precio público" },
                { data: "cantidad_presentacion", title: "Cantidad" },
                { data: "fecha_registro", title: "Fecha de registro" },
            ],
            order: [[8, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputArticulos = $("#tabla-articulos_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputArticulos.attr("id", "buscar-articulo");
                inputArticulos.attr("name", "buscar_articulo");
                inputArticulos.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputArticulos.before(iconSvg);

                inputArticulos.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_articulos.search(inputValue).draw();
                    }, 500);
                });

                inputArticulos.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_articulos.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_articulos.on("draw.dt", function () {
            $("#tabla-articulos_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-articulos-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 4;
});