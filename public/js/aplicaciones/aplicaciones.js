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
                "<'row'<'col-lg-8 col-md-8 col-sm-6 col-12 px-0'B><'col-lg-4 col-md-4 col-sm-6 col-12 px-0 mt-1'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
            serverSide: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            /*             colReorder: true, */
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
                    text: "Exportar datos",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-lg-block",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Aplicaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Aplicaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7,
                                ],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Aplicaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Aplicaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7,
                                ],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Aplicaciones registradas - Laboratorios Cofasa",
                            filename:
                                "Aplicaciones registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7,
                                ],
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
                {
                    text: "Registrar aplicación",
                    className: "btn btn-lg btn-store d-none d-lg-block",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearAplicacionBtn").click();
                    },
                },
                {
                    text: "Registrar",
                    className: "btn btn-lg btn-store d-lg-none",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearAplicacionBtn").click();
                    },
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar aplicaciones",
                emptyTable: "No hay aplicaciones registradas",
            },
            ajax: {
                url: obtenerAplicaciones,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
            },
            columnDefs: [
                {
                    targets: [0, 8],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [
                        1, 2, 3, 4, 5, 6, 7,
                    ],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 8 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-aplicaciones-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre_aplicacion", title: "Nombre" },
                { data: "imagen_aplicacion", title: "Imagen" },
                { data: "enlace_aplicacion", title: "Url" },
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
                        return `
                                <div class="text-center">
                                    <div class="btn-group">
                                        <button class="btn-icon-close dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                            <li>
                                                <button class="dropdown-item editar-aplicacion" data-id="${row.id}" type="button">
                                                    <span class="link">Editar aplicación</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item eliminar-aplicacion" data-id="${row.id}" type="button">
                                                    <span class="link">Eliminar aplicación</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
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

                btnSecondaryElements.removeClass("btn-secondary");

                inputAplicaciones.attr("id", "buscar-aplicacion");
                inputAplicaciones.attr("name", "buscar_aplicacion");
                inputAplicaciones.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

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

    $("#crearAplicacionBtn").click(function () {
        $("#crearAplicacion").modal("show");
    });
});