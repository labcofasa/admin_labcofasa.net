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
                    targets: [0, 14],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 1, 2, 3, 6, 7, 8, 9, 10, 11, 12, 13],
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
                { responsivePriority: 3, targets: 14 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-clientes-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "codigo", title: "Codigo" },
                { data: "empresa", title: "Empresa" },
                { data: "nrc", title: "NRC" },
                { data: "nit", title: "NIT" },
                { data: "dui", title: "DUI" },
                { data: "establecimiento", title: "Establecimiento" },
                { data: "fecha_registro", title: "Fecha de registro" },
                { data: "propietario", title: "Propietario" },
                { data: "giro", title: "Actividad económica" },
                { data: "telefono", title: "Teléfono" },
                { data: "correo", title: "Correo electrónico" },
                { data: "direccion", title: "Dirección" },
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
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                    <path d="M16.9459 3.17305C17.5332 2.58578 17.8268 2.29215 18.1521 2.15173C18.6208 1.94942 19.1521 1.94942 19.6208 2.15173C19.946 2.29215 20.2397 2.58578 20.8269 3.17305C21.4142 3.76032 21.7079 4.05395 21.8483 4.37925C22.0506 4.8479 22.0506 5.37924 21.8483 5.84789C21.7079 6.17319 21.4142 6.46682 20.8269 7.05409L15.8054 12.0757C14.5682 13.3129 13.9496 13.9315 13.1748 14.298C12.4 14.6645 11.5294 14.7504 9.78823 14.9222L9 15L9.07778 14.2118C9.24958 12.4706 9.33549 11.6 9.70201 10.8252C10.0685 10.0504 10.6871 9.43183 11.9243 8.19464L16.9459 3.17305Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                                    <path d="M6 15H3.75C2.7835 15 2 15.7835 2 16.75C2 17.7165 2.7835 18.5 3.75 18.5H13.25C14.2165 18.5 15 19.2835 15 20.25C15 21.2165 14.2165 22 13.25 22H11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>                                                
                                                <span class="link">Editar</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item eliminar-cliente nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                    <path d="M19.5 5.5L18.8803 15.5251C18.7219 18.0864 18.6428 19.3671 18.0008 20.2879C17.6833 20.7431 17.2747 21.1273 16.8007 21.416C15.8421 22 14.559 22 11.9927 22C9.42312 22 8.1383 22 7.17905 21.4149C6.7048 21.1257 6.296 20.7408 5.97868 20.2848C5.33688 19.3626 5.25945 18.0801 5.10461 15.5152L4.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                    <path d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                    <path d="M9.5 16.5L9.5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                    <path d="M14.5 16.5L14.5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                </svg>                                                
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
            order: [[7, "desc"]],

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
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

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