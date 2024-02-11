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
                "<'row align-items-end'<'col-md-8 col-sm-8 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
            serverSide: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [8, 25, 50, -1],
                ["8 filas", "25 filas", "50 filas", "Todas las filas"],
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
                    className: "btn btn-lg btn-store rol",
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
                                ${
                                    userPermissions.some(
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
                                        ${
                                            userPermissions.some(
                                                (permission) =>
                                                    permission.name ===
                                                    "admin_permisos_ver"
                                            )
                                                ? `
                                            <li>
                                                <button class="dropdown-item ver-permisos nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/></svg>
                                                    <span class="link">Ver permisos</span>
                                                </button>
                                            </li>`
                                                : ""
                                        }
                                    ${
                                        userPermissions.some(
                                            (permission) =>
                                                permission.name ===
                                                "admin_roles_editar"
                                        )
                                            ? `
                                            <li>
                                                <button class="dropdown-item editar-rol nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                                    <span class="link">Editar</span>
                                                </button>
                                            </li>`
                                            : ""
                                    }
                                    ${
                                        userPermissions.some(
                                            (permission) =>
                                                permission.name ===
                                                "admin_roles_eliminar"
                                        )
                                            ? `
                                            <li>
                                                <button class="dropdown-item eliminar-rol nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
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
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

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
                "<'row align-items-end'<'col-lg-8 col-md-12 col-sm-12 col-12'B><'col-lg-4 col-md-12 col-sm-12 col-12 mt-2'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-2'i><'col-md-7'p>>",
            serverSide: true,
            responsive: true,
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
                    className: "btn btn-lg btn-store2 permiso",
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
                    text: "Todo",
                    extend: "selectAll",
                    className:
                        "btn btn-lg btn-group-secondary permiso-eliminar",
                },
                {
                    text: "Deseleccionar",
                    extend: "selectNone",
                    className:
                        "btn btn-lg btn-group-secondary permiso-eliminar",
                },
                {
                    text: "Eliminar",
                    className: "btn btn-lg btn-danger permiso-eliminar",
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
                    className: "btn btn-lg btn-group-secondary",
                    buttons: [
                        {
                            extend: "copy",
                            text: "Copiar",
                            title: "Permisos del rol - Laboratorios Cofasa",
                            filename: "Permisos del rol - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Permisos del rol - Laboratorios Cofasa",
                            filename: "Permisos del rol - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Permisos del rol - Laboratorios Cofasa",
                            filename: "Permisos del rol - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1],
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
                    className: "select-checkbox permiso-eliminar",
                    targets: 0,
                },
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
                                ${
                                    userPermissions.some(
                                        (permission) =>
                                            permission.name ===
                                            "admin_permisos_eliminar"
                                    )
                                        ? `
                                    <button class="btn btn-danger eliminar-permiso" data-rol="${rolId}" data-id="${row.id}" data-toggle="tooltip" title="Eliminar permiso">
                                        <svg class="icon-danger" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                                            <g><path d="M0,0h24v24H0V0z" fill="none"/></g>
                                            <g><path d="M12,2L4,5v6.09c0,5.05,3.41,9.76,8,10.91c4.59-1.15,8-5.86,8-10.91V5L12,2z M18,11.09c0,4-2.55,7.7-6,8.83 c-3.45-1.13-6-4.82-6-8.83v-4.7l6-2.25l6,2.25V11.09z M9.91,8.5L8.5,9.91L10.59,12L8.5,14.09l1.41,1.41L12,13.42l2.09,2.08 l1.41-1.41L13.42,12l2.08-2.09L14.09,8.5L12,10.59L9.91,8.5z"/></g>
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
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

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
                "<'row align-items-end'<'col-lg-8 col-md-12 col-sm-12 col-12'B><'col-lg-4 col-md-12 col-sm-12 col-12 mt-2'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-2'i><'col-md-7'p>>",
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
                    className: "btn btn-lg btn-group-secondary permiso-asignar",
                },
                {
                    text: "Todo",
                    extend: "selectAll",
                    className: "btn btn-lg btn-group-secondary permiso-asignar",
                },
                {
                    text: "Deseleccionar",
                    extend: "selectNone",
                    className: "btn btn-lg btn-group-secondary permiso-asignar",
                },
                {
                    text: "Asignar permisos",
                    className:
                        "btn btn-lg btn-primary permiso-asignar btn-border-right",
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
                        "btn btn-lg btn-group-secondary ordenar btn-border-left",
                },
            ],
            select: {
                style: "multi",
                selector: "td:first-child",
            },
            columns: [
                {
                    className: "select-checkbox d-none d-lg-table-cell",
                    targets: 0,
                },
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
                                    ${
                                        userPermissions.some(
                                            (permission) =>
                                                permission.name ===
                                                "admin_permisos_asignar"
                                        )
                                            ? `
                                        <button class="btn btn-primary asignar-permiso" data-rol="${rolId}" data-id="${row.id}" data-toggle="tooltip" title="Asignar permiso">
                                        <svg class="icon-primary" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm7 10c0 4.52-2.98 8.69-7 9.93-4.02-1.24-7-5.41-7-9.93V6.3l7-3.11 7 3.11V11zm-11.59.59L6 13l4 4 8-8-1.41-1.42L10 14.17z"/></svg>
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
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

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

    $.fn.DataTable.ext.pager.numbers_length = 4;

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
            .find("td:nth-child(2)")
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
            .find("td:nth-child(2)")
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
