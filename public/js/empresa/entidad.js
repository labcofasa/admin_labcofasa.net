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
                "<'row align-items-end'<'col-md-8 col-sm-6 col-12'B><'col-md-4 col-sm-6 col-12 mt-1'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-2'i><'col-md-7'p>>",
            serverSide: true,
            responsive: true,
            processing: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [9, 25, 50, -1],
                ["9 filas", "25 filas", "50 filas", "Todas las filas"],
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
                    className: "btn btn-lg btn-store entidad",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearEntidadBtn").click();
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
                                printEntidades();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay entidades registradas",
            },
            ajax: {
                url: "/tabla-entidades",
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
                    render: function (data, type, row) {
                        var userPermissions = JSON.parse(
                            document.getElementById("userPermissions").value
                        );
                        return `
                                <div class="text-center">
                                ${userPermissions.some(
                            (permission) =>
                                permission.name ===
                                "admin_entidades_editar" ||
                                permission.name ===
                                "admin_entidades_eliminar"
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
                                        "admin_entidades_editar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item editar-entidad nav-link" data-id="${row.id}" type="button">
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
                                        "admin_entidades_eliminar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item eliminar-entidad nav-link" data-id="${row.id}" type="button">
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
                const inputEntidad = $("#tabla-entidades_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) =>
                            permission.name === "admin_entidades_crear"
                    )
                ) {
                    $(".entidad").addClass("d-none");
                }

                btnSecondaryElements.removeClass("btn-secondary");

                inputEntidad.attr("id", "buscar-entidad");
                inputEntidad.attr("name", "buscar_entidad");
                inputEntidad.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

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

function printEntidades() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "Entidades - Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>Entidades - Laboratorios Cofasa</title>"
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
        '<h4 style="text-align: center;">Entidades - Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-entidades thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-entidades tbody tr").each(function () {
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
