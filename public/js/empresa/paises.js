$(document).ready(function () {
    let paisId, nombrePais, departamentoId, nombreDepartamento;

    /* Script paises */
    const apiPais = "/tabla-paises";
    var tabla_paises = null;

    /* Tabla paises */
    function tablaPaises() {
        if (tabla_paises) {
            tabla_paises.destroy();
        }

        $("#spinnerPais").show();
        $("#tabla-paises-container").hide();

        tabla_paises = $("#tabla-paises").DataTable({
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
                    text: "Crear registro",
                    className: "btn btn-lg btn-store pais",
                    action: function (e, dt, node, config) {
                        document.getElementById("registrarPaisBtn").click();
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
                            title: "Departamentos registrados - Laboratorios Cofasa",
                            filename:
                                "Departamentos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Departamentos registrados - Laboratorios Cofasa",
                            filename:
                                "Departamentos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Departamentos registrados - Laboratorios Cofasa",
                            filename:
                                "Departamentos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Departamentos registrados - Laboratorios Cofasa",
                            filename:
                                "Departamentos registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printPaises();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay paises registrados",
            },
            ajax: {
                url: apiPais,
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
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    className: "nowrap",
                },
                {
                    targets: [],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4, 5, 6, 7],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 8 },
            ],
            columns: [
                { data: "contador" },
                { data: "nombre" },
                { data: "codigo_mh" },
                { data: "codigo_iso" },
                { data: "created_at" },
                { data: "user_name", defaultContent: "" },
                { data: "updated_at" },
                { data: "user_modified_name", defaultContent: "" },
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
                                "admin_departamentos_ver" ||
                                permission.name ===
                                "admin_paises_editar" ||
                                permission.name ===
                                "admin_paises_eliminar"
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
                                        "admin_departamentos_ver"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item ver-departamentos nav-link" data-id="${row.id}" type="button">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M2 8C2 8 6.47715 3 12 3C17.5228 3 22 8 22 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M21.544 13.045C21.848 13.4713 22 13.6845 22 14C22 14.3155 21.848 14.5287 21.544 14.955C20.1779 16.8706 16.6892 21 12 21C7.31078 21 3.8221 16.8706 2.45604 14.955C2.15201 14.5287 2 14.3155 2 14C2 13.6845 2.15201 13.4713 2.45604 13.045C3.8221 11.1294 7.31078 7 12 7C16.6892 7 20.1779 11.1294 21.544 13.045Z" stroke="currentColor" stroke-width="1.8" />
                                                        <path d="M15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17C13.6569 17 15 15.6569 15 14Z" stroke="currentColor" stroke-width="1.8" />
                                                    </svg>
                                                    <span class="link">Ver departamentos</span>
                                                </button>
                                            </li>`
                                    : ""
                                }
                                        ${userPermissions.some(
                                    (permission) =>
                                        permission.name ===
                                        "admin_paises_editar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item editar-pais nav-link" data-id="${row.id}" type="button">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M16.9459 3.17305C17.5332 2.58578 17.8268 2.29215 18.1521 2.15173C18.6208 1.94942 19.1521 1.94942 19.6208 2.15173C19.946 2.29215 20.2397 2.58578 20.8269 3.17305C21.4142 3.76032 21.7079 4.05395 21.8483 4.37925C22.0506 4.8479 22.0506 5.37924 21.8483 5.84789C21.7079 6.17319 21.4142 6.46682 20.8269 7.05409L15.8054 12.0757C14.5682 13.3129 13.9496 13.9315 13.1748 14.298C12.4 14.6645 11.5294 14.7504 9.78823 14.9222L9 15L9.07778 14.2118C9.24958 12.4706 9.33549 11.6 9.70201 10.8252C10.0685 10.0504 10.6871 9.43183 11.9243 8.19464L16.9459 3.17305Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                                        <path d="M6 15H3.75C2.7835 15 2 15.7835 2 16.75C2 17.7165 2.7835 18.5 3.75 18.5H13.25C14.2165 18.5 15 19.2835 15 20.25C15 21.2165 14.2165 22 13.25 22H11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="link">Editar</span>
                                                </button>
                                            </li>
                                            `
                                    : ""
                                }
                                        ${userPermissions.some(
                                    (permission) =>
                                        permission.name ===
                                        "admin_paises_eliminar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item eliminar-pais nav-link" data-id="${row.id}" type="button">
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
            order: [[4, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputPais = $("#tabla-paises_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) => permission.name === "admin_paises_crear"
                    )
                ) {
                    $(".pais").addClass("d-none");
                }

                btnSecondaryElements.removeClass("btn-secondary");
                inputPais.attr("id", "buscar-pais");
                inputPais.attr("name", "buscar_pais");
                inputPais.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputPais.before(iconSvg);

                inputPais.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_paises.search(inputValue).draw();
                    }, 500);
                });

                inputPais.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_paises.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_paises.on("draw.dt", function () {
            $("#tabla-paises_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#spinnerPais").hide();
            $("#tabla-paises-container").show();
        });
    }

    /* Inicializar tabla paises al abrir el modal */
    $("#paisModal").on("shown.bs.modal", function () {
        tablaPaises();
        tabla_paises.columns.adjust().responsive.recalc();
    });

    /* Registrar país */
    $("#registrarPaisBtn").click(function () {
        $("#registrarPais").modal("show");
    });

    $("#paisForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            mostrarToast("Por favor, completa todos los campos requeridos.", "error");
            return;
        }

        const formData = form.serialize();

        $.ajax({
            url: "/crear-pais",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_paises.ajax.reload();

                $("#registrarPais").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar el país. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#registrarPais").on("hidden.bs.modal", function () {
        $("#paisForm")[0].reset();
        $("#paisForm").removeClass("was-validated");
    });

    /* Editar país */
    $("#tabla-paises").on("click", ".editar-pais", function () {
        var id = $(this).data("id");

        var row = tabla_paises.row($(this).parents("tr")).data();
        var nombre = row.nombre;
        var codigo_mh = row.codigo_mh;
        var codigo_iso = row.codigo_iso;

        $("#paisEditarForm #btn-editar-pais").val(id);
        $("#paisEditarForm #pais-editar-nombre").val(nombre);
        $("#paisEditarForm #pais-editar-codigo_mh").val(codigo_mh);
        $("#paisEditarForm #pais-editar-codigo_iso").val(codigo_iso);

        $("#editarPais").modal("show");
    });

    $("#paisEditarForm").submit(function (e) {
        e.preventDefault();

        if (this.checkValidity() === false) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            url: "/actualizar-pais/" + $("#btn-editar-pais").val(),
            method: "PUT",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_paises.ajax.reload();

                $("#editarPais").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al actualizar el país. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#editarPais").on("hidden.bs.modal", function () {
        $("#paisEditarForm")[0].reset();
        $("#paisEditarForm").removeClass("was-validated");
    });

    /* Eliminar país */
    $("#tabla-paises").on("click", ".eliminar-pais", function () {
        const paisId = $(this).data("id");
        const paisNombre = $(this).closest("tr").find("td:nth-child(2)").text();

        $("#nombre-pais").text(paisNombre);
        $("#btn-eliminar-pais").data("id", paisId);
        $("#eliminarPais").modal("show");
    });

    $("#btn-eliminar-pais").on("click", function () {
        const paisId = $(this).data("id");
        $.ajax({
            url: "/eliminar-pais/" + paisId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_paises.ajax.reload();

                $("#eliminarPais").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el país. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    /* Script departamentos */
    var tabla_departamentos = null;

    /* Tabla departamentos */
    function tablaDepartamentos(paisId) {
        if (tabla_departamentos) {
            tabla_departamentos.destroy();
        }

        $("#spinnerDepartamento").show();
        $("#tabla-departamentos-container").hide();

        tabla_departamentos = $("#tabla-departamentos").DataTable({
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
                    text: "Crear registro",
                    className: "btn btn-lg btn-store departamento",
                    action: function (e, dt, node, config) {
                        document
                            .getElementById("registrarDepartamentoBtn")
                            .click();
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
                            title: "Departamentos registrados - Laboratorios Cofasa",
                            filename:
                                "Departamentos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Departamentos registrados - Laboratorios Cofasa",
                            filename:
                                "Departamentos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Departamentos registrados - Laboratorios Cofasa",
                            filename:
                                "Departamentos registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Departamentos registrados - Laboratorios Cofasa",
                            filename:
                                "Departamentos registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printDepartamentos();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay departamentos registrados",
            },
            ajax: {
                url: "/departamentos/" + paisId,
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
                    targets: [0, 7],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 1, 2, 3, 4, 5, 6, 7],
                    className: "nowrap",
                },
                {
                    targets: [],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4, 5, 6],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 7 },
            ],
            columns: [
                { data: "contador" },
                { data: "nombre" },
                { data: "codigo_mh" },
                { data: "created_at" },
                { data: "user_name", defaultContent: "" },
                { data: "updated_at" },
                { data: "user_modified_name", defaultContent: "" },
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
                                "admin_municipios_ver" ||
                                permission.name ===
                                "admin_departamentos_editar" ||
                                permission.name ===
                                "admin_departamentos_eliminar"
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
                                        "admin_municipios_ver"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item ver-municipios nav-link" data-id="${row.id}" type="button">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M2 8C2 8 6.47715 3 12 3C17.5228 3 22 8 22 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                        <path d="M21.544 13.045C21.848 13.4713 22 13.6845 22 14C22 14.3155 21.848 14.5287 21.544 14.955C20.1779 16.8706 16.6892 21 12 21C7.31078 21 3.8221 16.8706 2.45604 14.955C2.15201 14.5287 2 14.3155 2 14C2 13.6845 2.15201 13.4713 2.45604 13.045C3.8221 11.1294 7.31078 7 12 7C16.6892 7 20.1779 11.1294 21.544 13.045Z" stroke="currentColor" stroke-width="1.8" />
                                                        <path d="M15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17C13.6569 17 15 15.6569 15 14Z" stroke="currentColor" stroke-width="1.8" />
                                                    </svg>
                                                    <span class="link">Ver municipios</span>
                                                </button>
                                            </li>`
                                    : ""
                                }
                                        ${userPermissions.some(
                                    (permission) =>
                                        permission.name ===
                                        "admin_departamentos_editar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item editar-departamento nav-link" data-id="${row.id}" type="button">
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
                                        "admin_departamentos_eliminar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item eliminar-departamento nav-link" data-id="${row.id}" type="button">
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
                const inputDepartamento = $(
                    "#tabla-departamentos_filter input"
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
                            permission.name === "admin_departamentos_crear"
                    )
                ) {
                    $(".departamento").addClass("d-none");
                }

                btnSecondaryElements.removeClass("btn-secondary");
                inputDepartamento.attr("id", "buscar-departamentos");
                inputDepartamento.attr("name", "buscar_departamentos");
                inputDepartamento.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputDepartamento.before(iconSvg);

                inputDepartamento.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_departamentos.search(inputValue).draw();
                    }, 500);
                });

                inputDepartamento.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_departamentos.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_departamentos.on("draw.dt", function () {
            $("#tabla-departamentos_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();

            $("#spinnerDepartamento").hide();
            $("#tabla-departamentos-container").show();
        });
    }

    /* Mostrar departamentos */
    $("#tabla-paises").on("click", ".ver-departamentos", function () {
        paisId = $(this).data("id");
        nombrePais = tabla_paises.row($(this).closest("tr")).data().nombre;
        const modal = $("#departamentoModal");

        modal.modal("show");
        modal.find(".modal-title").text("Departamentos de " + nombrePais);

        tablaDepartamentos(paisId, nombrePais);
        tabla_departamentos.columns.adjust().responsive.recalc();
    });

    /* Registrar departamentos */
    $("#registrarDepartamentoBtn").click(function () {
        const modal = $("#registrarDepartamento");

        modal.find(".modal-title").text("Departamento de " + nombrePais);

        $("#registrar-departamento").val(paisId);
        $("#registrarDepartamento").modal("show");
    });

    $("#departamentoForm").submit(function (e) {
        e.preventDefault();

        if (this.checkValidity() === false) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            url: "/crear-departamento/" + $("#registrar-departamento").val(),
            method: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_departamentos.ajax.reload();

                $("#registrarDepartamento").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar el departamento. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#registrarDepartamento").on("hidden.bs.modal", function () {
        $("#departamentoForm")[0].reset();
        $("#departamentoForm").removeClass("was-validated");
    });

    /* Editar departamento */
    $("#tabla-departamentos").on("click", ".editar-departamento", function () {
        var id = $(this).data("id");

        var row = tabla_departamentos.row($(this).parents("tr")).data();
        var nombre = row.nombre;
        var codigo_mh = row.codigo_mh;

        $("#departamentoEditarForm #editar-departamento-id").val(id);
        $("#departamentoEditarForm #departamento-editar-nombre").val(nombre);
        $("#departamentoEditarForm #departamento-editar-codigo_mh").val(
            codigo_mh
        );

        $("#editarDepartamento").modal("show");
    });

    $("#departamentoEditarForm").submit(function (e) {
        e.preventDefault();

        if (this.checkValidity() === false) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            url:
                "/actualizar-departamento/" +
                $("#editar-departamento-id").val(),
            method: "PUT",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_departamentos.ajax.reload();

                $("#editarDepartamento").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al actualizar el departamento. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#editarDepartamento").on("hidden.bs.modal", function () {
        $("#departamentoEditarForm")[0].reset();
        $("#departamentoEditarForm").removeClass("was-validated");
    });

    /* Eliminar departamento */
    $("#tabla-departamentos").on(
        "click",
        ".eliminar-departamento",
        function () {
            const departamentoId = $(this).data("id");
            const departamentoNombre = $(this)
                .closest("tr")
                .find("td:nth-child(2)")
                .text();

            $("#nombre-departamento").text(departamentoNombre);
            $("#btn-eliminar-departamento").data("id", departamentoId);
            $("#eliminarDepartamento").modal("show");
        }
    );

    $("#btn-eliminar-departamento").on("click", function () {
        const departmanetoId = $(this).data("id");
        $.ajax({
            url: "/eliminar-departamento/" + departmanetoId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_departamentos.ajax.reload();

                $("#eliminarDepartamento").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el departamento. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    /* Script municipio */
    var tabla_municipios = null;

    /* Tabla municipios */
    function tablaMunicipios(departamentoId) {
        if (tabla_municipios) {
            tabla_municipios.destroy();
        }

        $("#spinnerMunicipio").show();
        $("#tabla-municipios-container").hide();

        tabla_municipios = $("#tabla-municipios").DataTable({
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
                    text: "Crear registro",
                    className: "btn btn-lg btn-store municipio",
                    action: function (e, dt, node, config) {
                        document
                            .getElementById("registrarMunicipioBtn")
                            .click();
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
                            title: "Municipios registrados - Laboratorios Cofasa",
                            filename:
                                "Municipios registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Municipios registrados - Laboratorios Cofasa",
                            filename:
                                "Municipios registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Municipios registrados - Laboratorios Cofasa",
                            filename:
                                "Municipios registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Municipios registrados - Laboratorios Cofasa",
                            filename:
                                "Municipios registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printMunicipios();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar Municipio",
                emptyTable: "No hay municipios registrados",
            },
            ajax: {
                url: "/municipios/" + departamentoId,
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
                    targets: [0, 7],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [0, 1, 2, 3, 4, 5, 6, 7],
                    className: "nowrap",
                },
                {
                    targets: [],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4, 5, 6],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 7 },
            ],
            columns: [
                { data: "contador" },
                { data: "nombre" },
                { data: "codigo_mh" },
                { data: "created_at" },
                { data: "user_name", defaultContent: "" },
                { data: "updated_at" },
                { data: "user_modified_name", defaultContent: "" },
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
                                "admin_municipios_editar" ||
                                permission.name ===
                                "admin_municipios_eliminar"
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
                                        "admin_municipios_editar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item editar-municipio nav-link" data-id="${row.id}" type="button">
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
                                        "admin_municipios_eliminar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item eliminar-municipio nav-link" data-id="${row.id}" type="button">
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
                const inputMunicipio = $("#tabla-municipios_filter input");
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
                            permission.name === "admin_municipios_crear"
                    )
                ) {
                    $(".municipio").addClass("d-none");
                }

                inputMunicipio.attr("id", "buscar-municipios");
                inputMunicipio.attr("name", "buscar_municipios");
                inputMunicipio.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputMunicipio.before(iconSvg);

                inputMunicipio.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_municipios.search(inputValue).draw();
                    }, 500);
                });

                inputMunicipio.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_municipios.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_municipios.on("draw.dt", function () {
            $("#tabla-municipios_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();

            $("#spinnerMunicipio").hide();
            $("#tabla-municipios-container").show();
        });
    }

    /* Mostrar municipios */
    $("#tabla-departamentos").on("click", ".ver-municipios", function () {
        departamentoId = $(this).data("id");
        nombreDepartamento = tabla_departamentos
            .row($(this).closest("tr"))
            .data().nombre;
        const modal = $("#municipioModal");

        modal.modal("show");
        modal.find(".modal-title").text("Municipios de " + nombreDepartamento);

        tablaMunicipios(departamentoId, nombreDepartamento);
        tabla_municipios.columns.adjust().responsive.recalc();
    });

    /* Registrar municipios */
    $("#registrarMunicipioBtn").click(function () {
        const modal = $("#registrarMunicipio");

        modal.find(".modal-title").text("Municipio de " + nombreDepartamento);

        $("#registrar-municipio").val(departamentoId);
        $("#registrarMunicipio").modal("show");
    });

    $("#municipioForm").submit(function (e) {
        e.preventDefault();

        if (this.checkValidity() === false) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            url: "/crear-municipio/" + $("#registrar-municipio").val(),
            method: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_municipios.ajax.reload();

                $("#registrarMunicipio").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar el municipio. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#registrarMunicipio").on("hidden.bs.modal", function () {
        $("#municipioForm")[0].reset();
        $("#municipioForm").removeClass("was-validated");
    });

    /* Editar departamento */
    $("#tabla-municipios").on("click", ".editar-municipio", function () {
        var id = $(this).data("id");

        var row = tabla_municipios.row($(this).parents("tr")).data();
        var nombre = row.nombre;
        var codigo_mh = row.codigo_mh;

        $("#municipioEditarForm #editar-municipio-id").val(id);
        $("#municipioEditarForm #municipio-editar-nombre").val(nombre);
        $("#municipioEditarForm #municipio-editar-codigo_mh").val(codigo_mh);

        $("#editarMunicipio").modal("show");
    });

    $("#municipioEditarForm").submit(function (e) {
        e.preventDefault();

        if (this.checkValidity() === false) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            url: "/actualizar-municipio/" + $("#editar-municipio-id").val(),
            method: "PUT",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_municipios.ajax.reload();

                $("#editarMunicipio").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al actualizar el municipio. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#editarMunicipio").on("hidden.bs.modal", function () {
        $("#municipioEditarForm")[0].reset();
        $("#municipioEditarForm").removeClass("was-validated");
    });

    /* Eliminar municipio */
    $("#tabla-municipios").on("click", ".eliminar-municipio", function () {
        const municipioId = $(this).data("id");
        const municipioNombre = $(this)
            .closest("tr")
            .find("td:nth-child(2)")
            .text();

        $("#nombre-municipio").text(municipioNombre);
        $("#btn-eliminar-municipio").data("id", municipioId);
        $("#eliminarMunicipio").modal("show");
    });

    $("#btn-eliminar-municipio").on("click", function () {
        const municipioId = $(this).data("id");
        $.ajax({
            url: "/eliminar-municipio/" + municipioId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_municipios.ajax.reload();

                $("#eliminarMunicipio").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el municipio. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $.fn.DataTable.ext.pager.numbers_length = 4;
});
