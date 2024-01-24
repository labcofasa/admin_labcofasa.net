$(document).ready(function () {
    const obtenerPublicidades = "/tabla-publicidades";
    let tabla_publicidades = null;

    tablaPublicidades();

    function tablaPublicidades() {
        if (tabla_publicidades) {
            tabla_publicidades.destroy();
        }
        $("#tabla-publicidades-container").hide();

        tabla_publicidades = $("#tabla-publicidades").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-9 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
            serverSide: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            /*             colReorder: true, */
            lengthMenu: [
                [6, 25, 50, -1],
                ["6 filas", "25 filas", "50 filas", "Todas las filas"],
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
                    className: "btn btn-lg btn-store publicidad",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearPublicidadBtn").click();
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
                            title: "publicidades registradas - Laboratorios Cofasa",
                            filename:
                                "publicidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "publicidades registradas - Laboratorios Cofasa",
                            filename:
                                "publicidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "publicidades registradas - Laboratorios Cofasa",
                            filename:
                                "publicidades registradas - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "publicidades registradas - Laboratorios Cofasa",
                            filename:
                                "publicidades registradas - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printpublicidades();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay publicidades registradas",
            },
            ajax: {
                url: obtenerPublicidades,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
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
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-publicidades-container").show();
            },
            columns: [
                { targets: [0], data: "contador", title: "#" },
                { targets: [1], data: "nombre_publicidad", title: "Nombre" },
                { targets: [2], data: "imagen_publicidad", title: "Imagen" },
                { targets: [3], data: "created_at", title: "Fecha creación" },
                { targets: [4], data: "user_name", title: "Usuario creador", defaultContent: "" },
                { targets: [5], data: "updated_at", title: "Fecha modificación", defaultContent: "" },
                { targets: [6], data: "user_modified_name", title: "Usuario modificador", defaultContent: "" },
                {
                    targets: [7],
                    data: null,
                    render: function (data, type, row) {
                        var userPermissions = JSON.parse(
                            document.getElementById("userPermissions").value
                        );
                        if (!userPermissions || !userPermissions.length) {
                            return "";  // No hay permisos, no mostrar nada
                        }
                        return `
                            <div class="text-center">
                                ${
                                    userPermissions.some(
                                        (permission) =>
                                            permission.name === "admin_publicidades_editar" ||
                                            permission.name === "admin_publicidades_eliminar"
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
                                                            permission.name === "admin_publicidades_editar"
                                                    )
                                                        ? `
                                                        <li>
                                                            <button class="dropdown-item editar-publicidad" data-id="${row.id}" type="button">
                                                                <span class="link">Editar</span>
                                                            </button>
                                                        </li>`
                                                        : ""
                                                }
                                                ${
                                                    userPermissions.some(
                                                        (permission) =>
                                                            permission.name === "admin_publicidades_eliminar"
                                                    )
                                                        ? `
                                                        <li>
                                                            <button class="dropdown-item eliminar-publicidad" data-id="${row.id}" type="button">
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
                const inputpublicidades = $("#tabla-publicidades_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) =>
                            permission.name === "admin_publicidades_crear"
                    )
                ) {
                    $(".publicidad").addClass("d-none");
                }

                btnSecondaryElements.removeClass("btn-secondary");

                inputpublicidades.attr("id", "buscar-publicidad");
                inputpublicidades.attr("name", "buscar_publicidad");
                inputpublicidades.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputpublicidades.before(iconSvg);

                inputpublicidades.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_publicidades.search(inputValue).draw();
                    }, 500);
                });

                inputpublicidades.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_publicidades.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_publicidades.on("draw.dt", function () {
            $("#tabla-publicidades_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-publicidades-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 4;

    $("#tabla-publicidades").on("click", ".ver-publicidad", function () {
        const url = $(this).data("url");
        window.open(url, "_blank");
    });

    $("#crearPublicidadBtn").click(function () {


        window.MultiselectDropdown();
        $("#crearPublicidad").modal("show");
    });

    $("#publicidad-imagen").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".nombre-publicidad").text(fileName);

        if (fileName) {
            $(".text-label-image").hide();
        } else {
            $(".text-label-image").show();
        }
    });

    $("#publicidadForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const imagenInput = $("#publicidad-imagen")[0];
        const formData = new FormData(form[0]);

        if (imagenInput.files.length > 0) {
            formData.append("imagen_publicidad", imagenInput.files[0]);
        }



        $.ajax({
            url: "/crear-publicidades",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_publicidades.ajax.reload();

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $("#crearPublicidad").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al crear la publicidad. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#crearPublicidad").on("hidden.bs.modal", function () {
        $("#publicidadForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();

        $(".multiselect-dropdown").remove();
    });

    /* Editar publicidad */
  /*   $("#tabla-publicidades").on("click", ".editar-publicidad", function () {
        var publicidadId = $(this).data("id");
        var row = tabla_publicidades.row($(this).parents("tr")).data();

        var nombre_publicidad = row.nombre_publicidad;

    });

    $("#imagen-publicidad-editar").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".imagen-publicidad-nombre-editar").text(fileName);

        if (fileName) {
            $(".text-label-imagen-editar").hide();
        } else {
            $(".text-label-imagen-editar").show();
        }
    }); */
        /* Editar aplicación */
        
        $(document).ready(function () {
            $("#tabla-publicidades").on("click", ".editar-publicidad", function () {
                var publicidadId = $(this).data("id");
                var row = tabla_publicidades.row($(this).parents("tr")).data();       
                var nombre_publicidad = row.nombre_publicidad;
        
                $("#editarPublicidadForm #btn-editar-publicidad").val(publicidadId);
                $("#editarPublicidadForm #nombre-publicidad-editar").val(nombre_publicidad);
                $(".imagen-publicidad-nombre-editar").text(row.imagen_publicidad);
                $("#editarPublicidad").modal("show");
            });
        });
        
        $("#imagen-publicidad-editar").change(function () {
            const fileName = $(this).val().split("\\").pop();
    
            $(".imagen-publicidad-nombre-editar").text(fileName);
    
            if (fileName) {
                $(".text-label-imagen-editar").hide();
            } else {
                $(".text-label-imagen-editar").show();
            }
        });
    
        $("#editarPublicidadForm").submit(function (e) {
            e.preventDefault();
    
            const form = $(this);
            form.addClass("was-validated");
    
            if (!form[0].checkValidity()) {
                return;
            }
    
            const formData = new FormData(form[0]);
    
            const imagenInput = $("#imagen-publicidad-editar")[0];
            if (imagenInput.files.length > 0) {
                formData.append("imagen_publicidad", imagenInput.files[0]);
            }
    
    
            $.ajax({
                url: "/actualizar-publicidad/" + $("#btn-editar-publicidad").val(),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    tabla_publicidades.ajax.reload();
    
                    if (response.success) {
                        mostrarToast(response.message, "success");
                        $("#editarPublicidad").modal("hide");
                    } else {
                        mostrarToast(response.error, "error");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mostrarToast(
                        "Error al editar la aplicación. Detalles: " + errorThrown,
                        "error"
                    );
                },
            });
        });
    
        $("#editarPublicidad").on("hidden.bs.modal", function () {
            $("#editarPublicidadnForm")
                .removeClass("was-validated")
                .find(":input")
                .removeClass("is-invalid")
                .end()[0]
                .reset();
    
            $(".multiselect-dropdown").remove();
        });

    $("#editarPublicidadForm").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const formData = new FormData(form[0]);

        const imagenInput = $("#imagen-publicidad-editar")[0];
        if (imagenInput.files.length > 0) {
            formData.append("imagen_publicidad", imagenInput.files[0]);
        }


    });

    $("#editarPublicidad").on("hidden.bs.modal", function () {
        $("#editarPublicidadForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();

        $(".multiselect-dropdown").remove();
    });

    /* Eliminar publicidad */
    $("#tabla-publicidades").on("click", ".eliminar-publicidad", function () {
        const publicidadId = $(this).data("id");
        const publicidadNombre = $(this)
            .closest("tr")
            .find("td:nth-child(2)")
            .text();

        $("#nombre-publicidad").text(publicidadNombre);
        $("#btn-eliminar-publicidad").data("id", publicidadId);
        $("#eliminarPublicidad").modal("show");
    });

    $("#btn-eliminar-publicidad").on("click", function () {
        const publicidadId = $(this).data("id");
        $.ajax({
            url: "/eliminar-publicidad/" + publicidadId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_publicidades.ajax.reload();

                $("#eliminarPublicidad").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar la publicidad. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });
});



/* Imprimir publicidad */
function printpublicidades() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "publicidades - Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>publicidades - Laboratorios Cofasa</title>"
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
        '<h4 style="text-align: center;">publicidades - Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-publicidades thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-publicidades tbody tr").each(function () {
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
