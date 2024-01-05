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
                "<'row'<'col-md-8 col-sm-6 col-12'B><'col-md-4 col-sm-6 col-12 mt-1'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-2'i><'col-md-7'p>>",
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
                    className: "btn btn-lg btn-group-secondary d-lg-none",
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
                {
                    extend: "collection",
                    text: "Exportar datos",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-lg-block",
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
                {
                    text: "Registrar país",
                    className: "btn btn-lg btn-store d-none d-lg-block",
                    action: function (e, dt, node, config) {
                        document.getElementById("registrarPaisBtn").click();
                    },
                },
                {
                    text: "Registrar",
                    className: "btn btn-lg btn-store d-lg-none",
                    action: function (e, dt, node, config) {
                        document.getElementById("registrarPaisBtn").click();
                    },
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar país",
                emptyTable: "No hay paises registrados",
            },
            ajax: {
                url: apiPais,
                type: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            },
            columnDefs: [
                {
                    targets: [0, 8],
                    searchable: false,
                    orderable: false,
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
                        return `
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary ver-departamentos" data-id="${row.id}" data-toggle="tooltip" title="Ver departamentos">
                                        <svg class="icon-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                    </button>
                                    <button class="btn btn-warning editar-pais" data-id="${row.id}" data-toggle="tooltip" title="Editar país">
                                        <svg class="icon-warning" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                    </button>
                                    <button class="btn btn-danger eliminar-pais" data-id="${row.id}" data-toggle="tooltip" title="Eliminar país">
                                        <svg class="icon-danger" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                                    </button>
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

                btnSecondaryElements.removeClass("btn-secondary");
                inputPais.attr("id", "buscar-pais");
                inputPais.attr("name", "buscar_pais");
                inputPais.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

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
                "<'row'<'col-md-8 col-sm-6 col-12'B><'col-md-4 col-sm-6 col-12 mt-1'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-2'i><'col-md-7'p>>",
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
                    className: "btn btn-lg btn-group-secondary d-lg-none",
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
                {
                    extend: "collection",
                    text: "Exportar datos",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-lg-block",
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
                {
                    text: "Registrar departamento",
                    className: "btn btn-lg btn-store d-none d-lg-block",
                    action: function (e, dt, node, config) {
                        document
                            .getElementById("registrarDepartamentoBtn")
                            .click();
                    },
                },
                {
                    text: "Registrar",
                    className: "btn btn-lg btn-store d-lg-none",
                    action: function (e, dt, node, config) {
                        document
                            .getElementById("registrarDepartamentoBtn")
                            .click();
                    },
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar departamento",
                emptyTable: "No hay departamentos registrados",
            },
            ajax: {
                url: "/departamentos/" + paisId,
                type: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            },
            columnDefs: [
                {
                    targets: [0, 7],
                    searchable: false,
                    orderable: false,
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
                        return `
                                <div class="btn-group" role="group">
                                    <button class="btn btn-primary ver-municipios" data-id="${row.id}" data-toggle="tooltip" title="Ver municipios">
                                        <svg class="icon-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                    </button>
                                    <button class="btn btn-warning editar-departamento" data-id="${row.id}" data-toggle="tooltip" title="Editar departamento">
                                        <svg class="icon-warning" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                    </button>
                                    <button class="btn btn-danger eliminar-departamento" data-id="${row.id}" data-toggle="tooltip" title="Eliminar departamento">
                                        <svg class="icon-danger" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                                    </button>
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

                btnSecondaryElements.removeClass("btn-secondary");
                inputDepartamento.attr("id", "buscar-departamentos");
                inputDepartamento.attr("name", "buscar_departamentos");
                inputDepartamento.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

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
                "<'row'<'col-md-8 col-sm-6 col-12'B><'col-md-4 col-sm-6 col-12 mt-1'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-2'i><'col-md-7'p>>",
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
                    className: "btn btn-lg btn-group-secondary d-lg-none",
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
                {
                    extend: "collection",
                    text: "Exportar datos",
                    className:
                        "btn btn-lg btn-group-secondary d-none d-lg-block",
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
                {
                    text: "Registrar Municipio",
                    className: "btn btn-lg btn-store d-none d-lg-block",
                    action: function (e, dt, node, config) {
                        document
                            .getElementById("registrarMunicipioBtn")
                            .click();
                    },
                },
                {
                    text: "Registrar",
                    className: "btn btn-lg btn-store d-lg-none",
                    action: function (e, dt, node, config) {
                        document
                            .getElementById("registrarMunicipioBtn")
                            .click();
                    },
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
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            },
            columnDefs: [
                {
                    targets: [0, 7],
                    searchable: false,
                    orderable: false,
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
                        return `
                                <div class="btn-group" role="group">
                                    <button class="btn btn-warning editar-municipio" data-id="${row.id}" data-toggle="tooltip" title="Editar municipio">
                                        <svg class="icon-warning" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                    </button>
                                    <button class="btn btn-danger eliminar-municipio" data-id="${row.id}" data-toggle="tooltip" title="Eliminar municipio">
                                        <svg class="icon-danger" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                                    </button>
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

                inputMunicipio.attr("id", "buscar-municipios");
                inputMunicipio.attr("name", "buscar_municipios");
                inputMunicipio.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

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
