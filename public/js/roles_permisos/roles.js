$(document).ready(function () {
    const apiRoles = "/obtener-roles";

    let tabla_roles = null;
    let tabla_roles_permisos = null;
    let tabla_asignar_permisos = null;
    var rolId, nombreRol;

    function tablaRoles() {
        if (tabla_roles) {
            tabla_roles.destroy();
        }

        $("#tabla-roles-container").hide();

        tabla_roles = $("#tabla-roles").DataTable({
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
                    text: "Nuevo",
                    className: "btn btn-lg btn-primary rol d-block d-md-none",
                    action: function (e, dt, node, config) {
                        document.getElementById("registrarRolBtn").click();
                    },
                },
                {
                    text: "Crear rol",
                    className: "btn btn-lg btn-primary rol d-none d-md-block",
                    action: function (e, dt, node, config) {
                        document.getElementById("registrarRolBtn").click();
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
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printRoles();
                            },
                        },
                        {
                            extend: "pdf",
                            text: "PDF",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
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
                emptyTable: "No hay roles registrados",
            },
            ajax: {
                url: apiRoles,
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
                $("#tabla-roles-container").show();
            },
            columnDefs: [
                {
                    targets: [0, 7],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 1, 3, 4, 5, 6, 7],
                    className: "nowrap",
                },
                {
                    targets: [2],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4, 5, 6],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 7 },
            ],
            columns: [
                { data: "contador", title: "#" },
                { data: "name", title: "Nombre del rol" },
                { data: "descripcion", title: "Descripción" },
                { data: "created_at", title: "Fecha de creación" },
                {
                    data: "user_name",
                    title: "Usuario creador",
                    defaultContent: "",
                },
                { data: "updated_at", title: "Fecha actualización" },
                {
                    data: "user_modified_name",
                    title: "Usuario modificador",
                    defaultContent: "",
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        var userPermissions = JSON.parse(
                            document.getElementById("userPermissions").value
                        );
                        return `
                                <div class="text-center">
                                ${userPermissions.some(
                            (permission) =>
                                permission.name ===
                                "admin_permisos_ver" ||
                                permission.name ===
                                "admin_roles_editar" ||
                                permission.name ===
                                "admin_roles_eliminar"
                        )
                                ? `
                                    <div class="btn-group">
                                        <button class="btn-icon-close dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                        ${userPermissions.some(
                                    (permission) =>
                                        permission.name ===
                                        "admin_permisos_ver"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item ver-permisos nav-link" data-id="${row.id}" type="button">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M2 8C2 8 6.47715 3 12 3C17.5228 3 22 8 22 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M21.544 13.045C21.848 13.4713 22 13.6845 22 14C22 14.3155 21.848 14.5287 21.544 14.955C20.1779 16.8706 16.6892 21 12 21C7.31078 21 3.8221 16.8706 2.45604 14.955C2.15201 14.5287 2 14.3155 2 14C2 13.6845 2.15201 13.4713 2.45604 13.045C3.8221 11.1294 7.31078 7 12 7C16.6892 7 20.1779 11.1294 21.544 13.045Z" stroke="currentColor" stroke-width="1.8" />
                                                        <path d="M15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17C13.6569 17 15 15.6569 15 14Z" stroke="currentColor" stroke-width="1.8" />
                                                    </svg>
                                                    <span class="link">Ver permisos</span>
                                                </button>
                                            </li>`
                                    : ""
                                }
                                    ${userPermissions.some(
                                    (permission) =>
                                        permission.name ===
                                        "admin_roles_editar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item editar-rol nav-link" data-id="${row.id}" type="button">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M16.9459 3.17305C17.5332 2.58578 17.8268 2.29215 18.1521 2.15173C18.6208 1.94942 19.1521 1.94942 19.6208 2.15173C19.946 2.29215 20.2397 2.58578 20.8269 3.17305C21.4142 3.76032 21.7079 4.05395 21.8483 4.37925C22.0506 4.8479 22.0506 5.37924 21.8483 5.84789C21.7079 6.17319 21.4142 6.46682 20.8269 7.05409L15.8054 12.0757C14.5682 13.3129 13.9496 13.9315 13.1748 14.298C12.4 14.6645 11.5294 14.7504 9.78823 14.9222L9 15L9.07778 14.2118C9.24958 12.4706 9.33549 11.6 9.70201 10.8252C10.0685 10.0504 10.6871 9.43183 11.9243 8.19464L16.9459 3.17305Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                                        <path d="M6 15H3.75C2.7835 15 2 15.7835 2 16.75C2 17.7165 2.7835 18.5 3.75 18.5H13.25C14.2165 18.5 15 19.2835 15 20.25C15 21.2165 14.2165 22 13.25 22H11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="link">Editar</span>
                                                </button>
                                            </li>`
                                    : ""
                                }
                                    ${userPermissions.some(
                                    (permission) =>
                                        permission.name ===
                                        "admin_roles_eliminar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item eliminar-rol nav-link" data-id="${row.id}" type="button">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M19.5 5.5L18.8803 15.5251C18.7219 18.0864 18.6428 19.3671 18.0008 20.2879C17.6833 20.7431 17.2747 21.1273 16.8007 21.416C15.8421 22 14.559 22 11.9927 22C9.42312 22 8.1383 22 7.17905 21.4149C6.7048 21.1257 6.296 20.7408 5.97868 20.2848C5.33688 19.3626 5.25945 18.0801 5.10461 15.5152L4.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M9.5 16.5L9.5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M14.5 16.5L14.5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                    </svg>
                                                    <span class="link">Eliminar</span>
                                                </button>
                                            </li>`
                                    : ""
                                }
                                        </ul>
                                    </div>`
                                : ""
                            }
                                </div>
                            `;
                    },
                },
            ],
            order: [[3, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputRoles = $("#tabla-roles_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) => permission.name === "admin_roles_crear"
                    )
                ) {
                    $(".rol").addClass("d-none");
                }

                inputRoles.attr("id", "buscar-rol");
                inputRoles.attr("name", "buscar_rol");
                inputRoles.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputRoles.before(iconSvg);

                inputRoles.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_roles.search(inputValue).draw();
                    }, 500);
                });

                inputRoles.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_roles.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_roles.on("draw.dt", function () {
            $("#tabla-roles_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#spinnerRoles").hide();
            $("#tabla-roles-container").show();
        });
    }

    function tablaRolesPermisos(rolId, nombreRol) {
        idRol = rolId;
        rolNombre = nombreRol;

        if (tabla_roles_permisos) {
            tabla_roles_permisos.destroy();
        }

        $("#spinnerRolesPermiso").show();
        $("#tabla-roles-permisos-container").hide();

        tabla_roles_permisos = $("#tabla-roles-permisos").DataTable({
            dom:
                "<'botones-filter'<B><f>>" +
                "<tr>" +
                "<'info-pagination'<i><p>>",
            serverSide: true,
            responsive: true,
            processing: true,
            ordering: false,
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
                    text: "Asignar",
                    className: "btn btn-lg btn-primary permiso",
                    action: function (e, dt, node, config) {
                        var rolId = idRol;
                        var nombreRol = rolNombre;

                        $("#asignarPermisoBtn")
                            .data("rol-id", rolId)
                            .data("rol-nombre", nombreRol)
                            .click();
                    },
                },
                {
                    text: "Todos",
                    extend: "selectAll",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-md-block",
                },
                {
                    text: "Ninguno",
                    extend: "selectNone",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-md-block",
                },
                {
                    text: "Eliminar",
                    className:
                        "btn btn-lg btn-danger d-none d-md-block btn-border-right",
                    enabled: false,
                    action: function () {
                        var selectedRowsData = tabla_roles_permisos
                            .rows({ selected: true })
                            .data()
                            .toArray();

                        if (selectedRowsData.length > 0) {
                            var rolId = idRol;

                            var permisos = selectedRowsData.map(function (row) {
                                return {
                                    rolId: rolId,
                                    permisoId: row.id,
                                };
                            });

                            $("#eliminarPermisoMasa")
                                .data("rolId", rolId)
                                .data("permisos", permisos)
                                .modal("show");
                        }
                    },
                },
                {
                    extend: "collection",
                    text: "Exportar",
                    className:
                        "btn btn-lg btn-group-secondary d-block d-md-none btn-border-right",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printRoles();
                            },
                        },
                        {
                            extend: "pdf",
                            text: "PDF",
                            title: "Roles registrados - Laboratorios Cofasa",
                            filename: "Roles registrados - Laboratorios Cofasa",
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
                emptyTable: "No se han asignado permisos",
            },
            ajax: {
                url: "/permisos/" + rolId,
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
                printRoles,
            },
            select: {
                style: "multi",
                selector: "td:first-child",
            },
            columnDefs: [
                {
                    targets: [0, 2],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [],
                    className: "nowrap",
                },
                {
                    targets: [],
                    className: "wrap",
                },
                {
                    targets: [1],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
            ],
            columns: [
                {
                    className: "select-checkbox d-none d-md-table-cell",
                    targets: 0,
                },
                { data: "contador" },
                { data: "nombre_permiso" },
                {
                    data: null,
                    render: function (data, type, row) {
                        var userPermissions = JSON.parse(
                            document.getElementById("userPermissions").value
                        );
                        return `
                            <div class="btn-toolbar">
                                <div class="btn-group" role="group">
                                ${userPermissions.some(
                            (permission) =>
                                permission.name ===
                                "admin_permisos_eliminar"
                        )
                                ? `
                                    <button class="btn btn-danger eliminar-permiso" data-rol="${rolId}" data-id="${row.id}" data-toggle="tooltip" title="Eliminar permiso">
                                        <svg class="icon-danger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                            <path d="M19.5 5.5L18.8803 15.5251C18.7219 18.0864 18.6428 19.3671 18.0008 20.2879C17.6833 20.7431 17.2747 21.1273 16.8007 21.416C15.8421 22 14.559 22 11.9927 22C9.42312 22 8.1383 22 7.17905 21.4149C6.7048 21.1257 6.296 20.7408 5.97868 20.2848C5.33688 19.3626 5.25945 18.0801 5.10461 15.5152L4.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path d="M9.5 16.5L9.5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path d="M14.5 16.5L14.5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                        </svg>
                                    </button>`
                                : ""
                            }
                                </div>
                            </div>
                        `;
                    },
                },
            ],

            initComplete: function () {
                let searchTimeout;
                const inputRolesPermisos = $(
                    "#tabla-roles-permisos_filter input"
                );
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) =>
                            permission.name === "admin_permisos_asignar"
                    )
                ) {
                    $(".permiso").addClass("d-none");
                }

                if (
                    !userPermissions.some(
                        (permission) =>
                            permission.name === "admin_permisos_eliminar"
                    )
                ) {
                    $(".permiso-eliminar").addClass("d-none");
                }

                btnSecondaryElements.removeClass("btn-secondary");

                inputRolesPermisos.attr("id", "buscar-rol-permiso");
                inputRolesPermisos.attr("name", "buscar_rol_permiso");
                inputRolesPermisos.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputRolesPermisos.before(iconSvg);

                inputRolesPermisos.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_roles_permisos.search(inputValue).draw();
                    }, 500);
                });

                inputRolesPermisos.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_roles_permisos.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_roles_permisos.on("draw.dt", function () {
            $("#tabla-roles-permisos_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#spinnerRolesPermiso").hide();
            $("#tabla-roles-permisos-container").show();
        });

        tabla_roles_permisos.on("select deselect", function () {
            var selectedRows = tabla_roles_permisos
                .rows({ selected: true })
                .data()
                .toArray();

            var eliminarPermisosButton = tabla_roles_permisos.button("4");

            eliminarPermisosButton.enable(selectedRows.length > 0);

            $("#eliminarPermisoMasa").removeData("permisoId");

            if (selectedRows.length === 1) {
                var permisoId = selectedRows[0].id;
                $("#eliminarPermisoMasa").data("permisoId", permisoId);
            }
        });
    }

    function tablaAsignarPermisos(rolId) {
        idRol = rolId;

        if (tabla_asignar_permisos) {
            tabla_asignar_permisos.destroy();
        }

        $("#spinnerAsignarPermiso").show();
        $("#tabla-asignar-permisos-container").hide();

        tabla_asignar_permisos = $("#tabla-asignar-permisos").DataTable({
            dom:
                "<'botones-filter'<B><f>>" +
                "<tr>" +
                "<'info-pagination'<i><p>>",
            serverSide: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            ordering: false,
            lengthMenu: [
                [10, 25, 50, -1],
                ["10 filas", "25 filas", "50 filas", "Todas las filas"],
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar permisos",
                emptyTable: "Todos los permisos están asignados",
            },
            ajax: {
                url: "/permisos-asignar/" + rolId,
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
            buttons: [
                {
                    extend: "pageLength",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-md-block",
                },
                {
                    text: "Todos",
                    extend: "selectAll",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-md-block",
                },
                {
                    text: "Ninguno",
                    extend: "selectNone",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-md-block",
                },
                {
                    text: "Asignar permisos",
                    className:
                        "btn btn-lg btn-primary d-none d-md-block btn-border-right",
                    enabled: false,
                    action: function () {
                        var selectedRowsData = tabla_asignar_permisos
                            .rows({ selected: true })
                            .data()
                            .toArray();

                        if (selectedRowsData.length > 0) {
                            var rolId = idRol;

                            var permisos = selectedRowsData.map(function (row) {
                                return {
                                    rolId: rolId,
                                    permisoId: row.id,
                                };
                            });

                            $("#asignarPermisoMasa")
                                .data("rolId", rolId)
                                .data("permisos", permisos)
                                .modal("show");
                        }
                    },
                },
                {
                    extend: "pageLength",
                    className:
                        "btn btn-lg btn-group-secondary d-block d-md-none btn-border-left",
                },
            ],
            select: {
                style: "multi",
                selector: "td:first-child",
            },
            columns: [
                {
                    className: "select-checkbox d-none d-md-table-cell",
                    targets: 0,
                },
                { data: "contador" },
                { data: "name" },
                {
                    data: null,
                    render: function (data, type, row) {
                        var userPermissions = JSON.parse(
                            document.getElementById("userPermissions").value
                        );
                        return `
                                <div class="btn-toolbar">
                                    <div class="btn-group" role="group">
                                    ${userPermissions.some(
                            (permission) =>
                                permission.name ===
                                "admin_permisos_asignar"
                        )
                                ? `
                                        <button class="btn btn-primary asignar-permiso" data-rol="${rolId}" data-id="${row.id}" data-toggle="tooltip" title="Asignar permiso">
                                            <svg class="icon-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                <path d="M11.9982 2C8.99043 2 7.04018 4.01899 4.73371 4.7549C3.79589 5.05413 3.32697 5.20374 3.1372 5.41465C2.94743 5.62556 2.89186 5.93375 2.78072 6.55013C1.59143 13.146 4.1909 19.244 10.3903 21.6175C11.0564 21.8725 11.3894 22 12.0015 22C12.6135 22 12.9466 21.8725 13.6126 21.6175C19.8116 19.2439 22.4086 13.146 21.219 6.55013C21.1078 5.93364 21.0522 5.6254 20.8624 5.41449C20.6726 5.20358 20.2037 5.05405 19.2659 4.75499C16.9585 4.01915 15.0061 2 11.9982 2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M9 13C9 13 10 13 11 15C11 15 14.1765 10 17 9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>`
                                : ""
                            }
                                    </div>
                                </div>
                            `;
                    },
                },
            ],

            initComplete: function () {
                let searchTimeout;
                const inputAsignarPermisos = $(
                    "#tabla-asignar-permisos_filter input"
                );
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) =>
                            permission.name === "admin_permisos_asignar"
                    )
                ) {
                    $(".permiso-asignar").addClass("d-none");
                }

                inputAsignarPermisos.attr("id", "buscar-asignar-permiso");
                inputAsignarPermisos.attr("name", "buscar_asignar_permiso");
                inputAsignarPermisos.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputAsignarPermisos.before(iconSvg);

                inputAsignarPermisos.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_asignar_permisos.search(inputValue).draw();
                    }, 500);
                });

                inputAsignarPermisos.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_asignar_permisos.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_asignar_permisos.on("draw.dt", function () {
            $("#tabla-asignar-permisos_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#spinnerAsignarPermiso").hide();
            $("#tabla-asignar-permisos-container").show();
        });

        tabla_asignar_permisos.on("select deselect", function () {
            var selectedRows = tabla_asignar_permisos
                .rows({ selected: true })
                .data()
                .toArray();

            var asignarPermisosButton = tabla_asignar_permisos.button("3");

            asignarPermisosButton.enable(selectedRows.length > 0);

            $("#asignarPermisoMasa").removeData("permisoId");

            if (selectedRows.length === 1) {
                var permisoId = selectedRows[0].id;
                $("#asignarPermisoMasa").data("permisoId", permisoId);
            }
        });
    }

    tablaRoles();

    $.fn.DataTable.ext.pager.numbers_length = 5;

    /* Mostrar permisos del rol */
    $("#tabla-roles").on("click", ".ver-permisos", function () {
        rolId = $(this).data("id");
        nombreRol = tabla_roles.row($(this).closest("tr")).data().name;
        const modal = $("#permisoModal");

        modal.modal("show");
        modal.find(".modal-title").text("Permisos del rol " + nombreRol);

        tablaRolesPermisos(rolId, nombreRol);
    });

    $("#asignarPermisoBtn").click(function () {
        var asignarPermisoBtn = $(this);
        var rolId = asignarPermisoBtn.data("rol-id");
        var rolNombre = asignarPermisoBtn.data("rol-nombre");

        const modal = $("#asignarPermiso");

        modal.modal("show");
        $("#rolIdModal").val(rolId);
        modal.find(".modal-title").text("Asignar permisos al rol " + rolNombre);

        tablaAsignarPermisos(rolId);

        $("#asignarPermiso").modal("show");
    });

    /* Asignar permisos */
    $("#tabla-asignar-permisos").on("click", ".asignar-permiso", function () {
        var rolId = $(this).attr("data-rol");
        var permisoId = $(this).attr("data-id");

        var permisoNombre = $(this)
            .closest("tr")
            .find("td:nth-child(3)")
            .text();

        $("#nombre-permiso").text(permisoNombre);
        $("#btn-asignar-permiso").data("rol", rolId);
        $("#btn-asignar-permiso").data("id", permisoId);

        $("#asignarPermisoRol").modal("show");
    });

    $("#btn-asignar-permiso").on("click", function () {
        var rolId = $(this).data("rol");
        var permisoId = $(this).data("id");

        $.ajax({
            type: "POST",
            url: "/asignar-permiso/" + rolId + "/" + permisoId,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_asignar_permisos.ajax.reload();

                $("#asignarPermisoRol").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al asignar el permiso. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#asignarPermisoRol").on("hidden.bs.modal", function () {
        tabla_roles_permisos.ajax.reload();
    });

    /* Asignar permisos en masa */
    $("#btn-asignar-permisos").on("click", function () {
        var permisos = $("#asignarPermisoMasa").data("permisos");

        if (permisos && permisos.length > 0) {
            var permisosIds = permisos.map(function (permiso) {
                return {
                    rolId: permiso.rolId,
                    permisoId: permiso.permisoId,
                };
            });

            asignarPermisosMasa(permisosIds);
        } else {
            console.log("No hay permisos seleccionados.");
        }
    });

    function asignarPermisosMasa(permisos) {
        $.ajax({
            type: "POST",
            url: "/asignar-permisos-masa",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { permisos: permisos },
            success: function (response) {
                tabla_asignar_permisos.ajax.reload();
                $("#asignarPermisoMasa").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al asignar los permisos. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    }

    $("#asignarPermisoMasa").on("hidden.bs.modal", function () {
        tabla_roles_permisos.ajax.reload();
    });

    /* Eliminar permisos de los roles */
    $("#tabla-roles-permisos").on("click", ".eliminar-permiso", function () {
        const permisoId = $(this).data("id");

        const permisoNombre = $(this)
            .closest("tr")
            .find("td:nth-child(3)")
            .text();

        const rolId = $(this).data("rol");

        $("#nombre-permiso-rol").text(permisoNombre);
        $("#btn-eliminar-permiso").data("id", permisoId);
        $("#btn-eliminar-permiso").data("rolid", rolId);

        $("#eliminarPermiso").modal("show");
    });

    $("#btn-eliminar-permiso").on("click", function () {
        const permisoId = $(this).data("id");
        const rolId = $(this).data("rolid");

        $.ajax({
            url: `/eliminar-permiso/${rolId}/${permisoId}`,
            type: "POST",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_roles_permisos.ajax.reload();

                $("#eliminarPermiso").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el permiso. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#eliminarPermiso").on("hidden.bs.modal", function () {
        $("#permisoModal").modal("show");
    });

    $("#btn-eliminar-permiso-masa").on("click", function () {
        var permisos = $("#eliminarPermisoMasa").data("permisos");

        if (permisos && permisos.length > 0) {
            var permisosIds = permisos.map(function (permiso) {
                return {
                    rolId: permiso.rolId,
                    permisoId: permiso.permisoId,
                };
            });

            eliminarPermisosMasa(permisosIds);
        } else {
            console.log("No hay permisos seleccionados.");
        }
    });

    function eliminarPermisosMasa(permisos) {
        $.ajax({
            type: "POST",
            url: "/eliminar-permisos-masa",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { permisos: permisos },
            success: function (response) {
                tabla_roles_permisos.ajax.reload();
                $("#eliminarPermisoMasa").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar los permisos. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    }

    /* Registrar rol */
    $("#registrarRolBtn").click(function () {
        $("#registrarRol").modal("show");
    });

    $("#rolForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            mostrarToast("Por favor, completa todos los campos requeridos.", "error");
            return;
        }

        const formData = form.serialize();

        $.ajax({
            url: "/crear-rol",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_roles.ajax.reload();

                $("#registrarRol").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar el rol. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#registrarRol").on("hidden.bs.modal", function () {
        $("#rolForm")[0].reset();
        $("#rolForm").removeClass("was-validated");
    });

    /* Editar rol */
    $("#tabla-roles").on("click", ".editar-rol", function () {
        var id = $(this).data("id");
        var row = tabla_roles.row($(this).parents("tr")).data();
        var nombre = row.name;
        var descripcion = row.descripcion;

        $("#rolEditarForm #btn-editar-rol").val(id);
        $("#rolEditarForm #rol-editar-nombre").val(nombre);
        $("#rolEditarForm #rol-descripcion-textarea").val(descripcion);

        $("#editarRol").modal("show");
    });

    $("#rolEditarForm").submit(function (e) {
        e.preventDefault();

        if (this.checkValidity() === false) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            url: "/actualizar-rol/" + $("#btn-editar-rol").val(),
            method: "PUT",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_roles.ajax.reload();

                $("#editarRol").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al editar el rol. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#editarRol").on("hidden.bs.modal", function () {
        $("#rolEditarForm")[0].reset();
        $("#rolEditarForm").removeClass("was-validated");
    });

    /* Eliminar rol */
    $("#tabla-roles").on("click", ".eliminar-rol", function () {
        const entityId = $(this).data("id");
        const rolNombre = $(this).closest("tr").find("td:nth-child(2)").text();

        $("#nombre-rol").text(rolNombre);
        $("#btn-eliminar-rol").data("id", entityId);
        $("#eliminarRol").modal("show");
    });

    $("#btn-eliminar-rol").on("click", function () {
        const entityId = $(this).data("id");
        $.ajax({
            url: "/eliminar-rol/" + entityId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_roles.ajax.reload();

                $("#eliminarRol").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el rol. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    /* Imprimir roles */
    function printRoles() {
        const printWindow = window.open("", "_blank");
        printWindow.document.title = "Roles - Laboratorios Cofasa";
        printWindow.document.write(
            "<html><head><title>Roles - Laboratorios Cofasa</title>"
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
            '<h4 style="text-align: center;">Roles - Laboratorios Cofasa</h4>'
        );
        printWindow.document.write("<table>");

        const headers = $("#tabla-roles thead tr").clone();
        headers.find("th:last").remove();
        printWindow.document.write("<thead>" + headers.html() + "</thead>");

        const tbody = $("<tbody></tbody>");
        $("#tabla-roles tbody tr").each(function () {
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
