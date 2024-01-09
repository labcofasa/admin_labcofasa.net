$(document).ready(function () {
    let tabla_entidades = null;

    function tablaEntidades() {
        if (tabla_entidades) {
            tabla_entidades.destroy();
        }

        $("#spinnerEntidad").show();
        $("#tabla-entidades-container").hide();

        tabla_entidades = $("#tabla-entidades").DataTable({
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
                            title: "Entidades registradas - Laboratorios Cofasa",
                            filename:
                                "Entidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Entidades registradas - Laboratorios Cofasa",
                            filename:
                                "Entidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Entidades registradas - Laboratorios Cofasa",
                            filename:
                                "Entidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Entidades registradas - Laboratorios Cofasa",
                            filename:
                                "Entidades registradas - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                entidadPrint();
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
                            title: "Entidades registradas - Laboratorios Cofasa",
                            filename:
                                "Entidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Entidades registradas - Laboratorios Cofasa",
                            filename:
                                "Entidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Entidades registradas - Laboratorios Cofasa",
                            filename:
                                "Entidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Entidades registradas - Laboratorios Cofasa",
                            filename:
                                "Entidades registradas - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                entidadPrint();
                            },
                        },
                    ],
                },
                {
                    text: "Registrar entidad",
                    className: "btn btn-lg btn-store d-none d-lg-block",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearEntidadBtn").click();
                    },
                },
                {
                    text: "Registrar",
                    className: "btn btn-lg btn-store d-lg-none",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearEntidadBtn").click();
                    },
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar entidad",
                emptyTable: "No hay entidades registradas",
            },
            ajax: {
                url: "/tabla-entidades",
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
                { data: "contador", title: "#" },
                { data: "nombre", title: "Nombre" },
                { data: "descripcion", title: "Descripción" },
                { data: "created_at", title: "Fecha de creación" },
                {
                    data: "user_name",
                    title: "Usuario creador",
                    defaultContent: "",
                },
                { data: "updated_at", title: "Fecha de actualización" },
                {
                    data: "user_modified_name",
                    title: "Usuario modificador",
                    defaultContent: "",
                },
                {
                    data: null,
                    title: "Acciones",
                    render: function (data, type, row) {
                        return `
                                <div class="text-center">
                                    <div class="btn-group">
                                        <button class="btn-icon-close dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                            <li>
                                                <button class="dropdown-item editar-entidad" data-id="${row.id}" type="button">
                                                    <span class="link">Editar entidad</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item eliminar-entidad" data-id="${row.id}" type="button">
                                                    <span class="link">Eliminar entidad</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            `;
                    },
                },
            ],
            order: [[3, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputEntidad = $("#tabla-entidades_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputEntidad.attr("id", "buscar-entidad");
                inputEntidad.attr("name", "buscar_entidad");
                inputEntidad.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputEntidad.before(iconSvg);

                inputEntidad.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_entidades.search(inputValue).draw();
                    }, 500);
                });

                inputEntidad.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_entidades.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_entidades.on("draw.dt", function () {
            $("#tabla-entidades_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#spinnerEntidad").hide();
            $("#tabla-entidades-container").show();
        });
    }

    $("#entidadModal").on("shown.bs.modal", function () {
        tablaEntidades();
        tabla_entidades.columns.adjust().responsive.recalc();
    });

    $.fn.DataTable.ext.pager.numbers_length = 4;

    $("#crearEntidadBtn").click(function () {
        $("#crearEntidad").modal("show");
    });

    $("#entidadForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const formData = form.serialize();

        $.ajax({
            url: "/crear-entidad",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_entidades.ajax.reload();

                $("#crearEntidad").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar la entidad. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#crearEntidad").on("hidden.bs.modal", function () {
        $("#entidadForm")[0].reset();
        $("#entidadForm").removeClass("was-validated");
    });

    $("#tabla-entidades").on("click", ".editar-entidad", function () {
        var id = $(this).data("id");

        var row = tabla_entidades.row($(this).parents("tr")).data();
        var nombre = row.nombre;
        var descripcion = row.descripcion;

        $("#entidadEditarForm #btn-editar-entidad").val(id);
        $("#entidadEditarForm #entidad-editar-nombre").val(nombre);
        $("#entidadEditarForm #entidad-editar-descripcion").val(descripcion);

        $("#editarEntidad").modal("show");
    });

    $("#entidadEditarForm").submit(function (e) {
        e.preventDefault();

        if (this.checkValidity() === false) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            url: "/actualizar-entidad/" + $("#btn-editar-entidad").val(),
            method: "PUT",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_entidades.ajax.reload();

                $("#editarEntidad").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al editar la entidad. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#editarEntidad").on("hidden.bs.modal", function () {
        $("#entidadEditarForm")[0].reset();
        $("#entidadEditarForm").removeClass("was-validated");
    });

    $("#tabla-entidades").on("click", ".eliminar-entidad", function () {
        const entityId = $(this).data("id");
        const entidadNombre = $(this)
            .closest("tr")
            .find("td:nth-child(2)")
            .text();

        $("#nombre-entidad").text(entidadNombre);
        $("#btn-eliminar-entidad").data("id", entityId);
        $("#eliminarEntidad").modal("show");
    });

    $("#btn-eliminar-entidad").on("click", function () {
        const entityId = $(this).data("id");
        $.ajax({
            url: "/eliminar-entidad/" + entityId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_entidades.ajax.reload();

                $("#eliminarEntidad").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar la entidad. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });
});
