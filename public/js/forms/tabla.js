$(document).ready(function () {
    const apiDatosConozcaCLiente = "/tabla-conozca-cliente";
    let tabla_conozca_cliente = null;

    tablaConozcaCliente();

    function tablaConozcaCliente() {
        if (tabla_conozca_cliente) {
            tabla_conozca_cliente.destroy();
        }
        $("#tabla-formulario-conozca-cliente-container").hide();

        tabla_conozca_cliente = $("#tabla-conozca-cliente").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-8 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
            serverSide: true,
            processing: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [5, 25, 50, -1],
                ["5 filas", "25 filas", "50 filas", "Todas las filas"],
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
                // {
                //     extend: "collection",
                //     text: "Exportar",
                //     className: "btn btn-lg btn-group-secondary",
                //     buttons: [
                //         {
                //             extend: "copy",
                //             text: "Copiar",
                //             title: "Usuarios registrados - Laboratorios Cofasa",
                //             filename:
                //                 "Usuarios registrados - Laboratorios Cofasa",
                //             exportOptions: {
                //                 columns: [
                //                     1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                //                     14, 15,
                //                 ],
                //             },
                //         },
                //         {
                //             extend: "csv",
                //             text: "CSV",
                //             title: "Usuarios registrados - Laboratorios Cofasa",
                //             filename:
                //                 "Usuarios registrados - Laboratorios Cofasa",
                //             exportOptions: {
                //                 columns: [
                //                     1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                //                     14, 15,
                //                 ],
                //             },
                //         },
                //         {
                //             extend: "excel",
                //             text: "Excel",
                //             title: "Usuarios registrados - Laboratorios Cofasa",
                //             filename:
                //                 "Usuarios registrados - Laboratorios Cofasa",
                //             exportOptions: {
                //                 columns: [
                //                     1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                //                     14, 15,
                //                 ],
                //             },
                //         },
                //         {
                //             extend: "print",
                //             text: "Imprimir",
                //             title: "Usuarios registrados - Laboratorios Cofasa",
                //             filename:
                //                 "Usuarios registrados - Laboratorios Cofasa",
                //             action: function (e, dt, node, config) {
                //                 printUsuarios();
                //             },
                //         },
                //     ],
                // },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "Aun no se ha recibido ninguna respuesta",
            },
            ajax: {
                url: apiDatosConozcaCLiente,
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
            // columnDefs: [
            //     {
            //         targets: [0, 3, 17],
            //         searchable: false,
            //         orderable: false,
            //     },
            //     {
            //         targets: [
            //             0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16,
            //             17,
            //         ],
            //         className: "nowrap",
            //     },
            //     {
            //         targets: [12],
            //         className: "wrap",
            //     },
            //     {
            //         targets: [
            //             1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
            //         ],
            //         searchable: true,
            //         orderable: true,
            //     },
            //     { responsivePriority: 1, targets: 1 },
            //     { responsivePriority: 2, targets: 2 },
            //     { responsivePriority: 3, targets: 17 },
            // ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-formulario-conozca-cliente-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre", title: "Persona natural o representante legal" },
                { data: "nombre_juridico", title: "Persona jurídica" },
                { data: "pais", title: "Pais" },
            ],
            // order: [[12, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputConozcaCliente = $("#tabla-conozca-cliente_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputConozcaCliente.attr("id", "buscar-conozca-cliente");
                inputConozcaCliente.attr("name", "buscar_conozca_cliente");
                inputConozcaCliente.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputConozcaCliente.before(iconSvg);

                inputConozcaCliente.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_conozca_cliente.search(inputValue).draw();
                    }, 500);
                });

                inputConozcaCliente.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_conozca_cliente.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_conozca_cliente.on("draw.dt", function () {
            $("#tabla-conozca-cliente_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-formulario-conozca-cliente-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 4;
});


