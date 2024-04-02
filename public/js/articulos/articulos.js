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
                "<'botones-filter'<B><f>>" +
                "<tr>" +
                "<'info-pagination'<i><p>>",
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
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

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

    $.fn.DataTable.ext.pager.numbers_length = 5;
});
