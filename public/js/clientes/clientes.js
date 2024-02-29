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
                    text: "Crear registro",
                    className: "btn btn-lg btn-store cliente",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearClienteBtn").click();
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
                    targets: [0, 8],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 1, 2, 3, 6, 7],
                    className: "nowrap",
                },
                {
                    targets: [4, 5],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4, 5, 6, 7],
                    searchable: true,
                    orderable: false,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 8 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-clientes-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "codigo", title: "Codigo" },
                { data: "conexion", title: "Empresa" },
                { data: "nrc", title: "NRC" },
                { data: "establecimiento", title: "Establecimiento" },
                { data: "propietario", title: "Propietario" },
                { data: "fecha_registro", title: "Fecha de registro" },
                { data: "usuario_registro", title: "Usuario creador" },
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
                                            <button class="dropdown-item editar-cliente nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                                <span class="link">Editar</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item eliminar-cliente nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                                                <span class="link">Eliminar</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        `;
                    },
                },
            ],
            order: [[6, "desc"]],

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

    /* Registrar cliente */
    $("#crearClienteBtn").click(function () {
        $("#crearCliente").modal("show");
    });

    /* Eliminar usuario */
    $("#tabla-clientes").on("click", ".eliminar-cliente", function () {
        const clienteId = $(this).data("id");
        clienteNombre = tabla_clientes.row($(this).closest("tr")).data().establecimiento;

        const modal = $("#eliminarCliente");
        modal.modal("show");

        modal.find(".nombre-cliente").text(clienteNombre);
        $("#btn-eliminar-cliente").data("id", clienteId);
    });
});