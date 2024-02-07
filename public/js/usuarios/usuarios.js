$(document).ready(function () {
    const apiUsuarios = "/tabla-usuarios";
    let tabla_usuarios = null,
        nombreUsuario;

    tablaUsuarios();
    estadisticaUsuario();

    function tablaUsuarios() {
        if (tabla_usuarios) {
            tabla_usuarios.destroy();
        }
        $("#tabla-usuarios-container").hide();

        tabla_usuarios = $("#tabla-usuarios").DataTable({
            dom:
                "<'row align-items-end'<'col-md-8 col-sm-8 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
            serverSide: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [5, 50, 100 - 1],
                ["5 filas", "50 filas", "100 filas", "Todas las filas"],
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
                    className: "btn btn-lg btn-store usuario",
                    action: function (e, dt, node, config) {
                        document.getElementById("registrarUsuarioBtn").click();
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
                            title: "Usuarios registrados - Laboratorios Cofasa",
                            filename:
                                "Usuarios registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15,
                                ],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Usuarios registrados - Laboratorios Cofasa",
                            filename:
                                "Usuarios registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15,
                                ],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Usuarios registrados - Laboratorios Cofasa",
                            filename:
                                "Usuarios registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [
                                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                                    14, 15,
                                ],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Usuarios registrados - Laboratorios Cofasa",
                            filename:
                                "Usuarios registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                printUsuarios();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay usuarios registrados",
            },
            ajax: {
                url: apiUsuarios,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
            },
            columnDefs: [
                {
                    targets: [0, 3, 17],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [
                        1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
                    ],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 17 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-usuarios-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre", title: "Usuario" },
                {
                    data: "roles",
                    title: "Rol",
                    render: function (data, type, row) {
                        return data.map((role) => role.name).join(", ");
                    },
                },
                {
                    data: "estado",
                    title: "Estado",
                    render: function (data, type, row) {
                        const isChecked = row.estado == 1;
                        return `
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-switch" type="checkbox" id="switch-${row.id}" ${isChecked ? "checked" : ""} data-id="${row.id}">
                                <label class="form-check-label estado-label" for="switch-${row.id}"></label>
                            </div>
                        `;
                    },

                },
                { data: "nombres", title: "Nombres" },
                { data: "apellidos", title: "Apellidos" },
                { data: "telefono", title: "Teléfono" },
                { data: "email", title: "Correo electrónico" },
                { data: "nombre_empresa", title: "Empresa" },
                { data: "nombre_pais", title: "País" },
                { data: "nombre_departamento", title: "Departamento" },
                { data: "nombre_municipio", title: "Municipio" },
                { data: "direccion", title: "Dirección" },
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
                        var userPermissions = JSON.parse(
                            document.getElementById("userPermissions").value
                        );
                        return `
                                <div class="text-center">
                                ${userPermissions.some(
                            (permission) =>
                                permission.name ===
                                "admin_usuarios_editar" ||
                                permission.name ===
                                "admin_usuarios_eliminar"
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
                                        "admin_usuarios_editar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item editar-usuario nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                                    <span class="link">Editar</span>
                                                </button>
                                            </li>`
                                    : ""
                                }
                                    ${userPermissions.some(
                                    (permission) =>
                                        permission.name ===
                                        "admin_usuarios_eliminar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item eliminar-usuario nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                                                    <span class="link">Eliminar</span>
                                                </button>
                                            </li>`
                                    : ""
                                }
                                        </ul>`
                                : ""
                            }
                                    </div>
                                </div>
                            `;
                    },
                },
            ],
            order: [[12, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputUsuarios = $("#tabla-usuarios_filter input");
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
                            permission.name === "admin_usuarios_crear"
                    )
                ) {
                    $(".usuario").addClass("d-none");
                }

                inputUsuarios.attr("id", "buscar-usuario");
                inputUsuarios.attr("name", "buscar_usuario");
                inputUsuarios.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputUsuarios.before(iconSvg);

                inputUsuarios.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_usuarios.search(inputValue).draw();
                    }, 500);
                });

                inputUsuarios.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_usuarios.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_usuarios.on("draw.dt", function () {
            $("#tabla-usuarios_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-usuarios-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 4;

    /* Registrar usuario */
    $("#registrarUsuarioBtn").click(function () {
        $("#registrarUsuario").modal("show");
        cargarRoles("#rol-usuario-select", "#id-rol-usuario", false);
        cargarEmpresas("#empresa-usuario-select", "#id-empresa-usuario", false);
        cargarPaises(
            "#pais-perfil-select",
            "#id-pais-perfil-select",
            "#departamento-perfil-select",
            "#id-departamento-perfil-select",
            "#municipio-perfil-select",
            "#id-municipio-perfil-select",
            false
        );
    });

    $("#imagen-perfil").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".image-perfil-name").text(fileName);

        if (fileName) {
            $(".text-label-image").hide();
        } else {
            $(".text-label-image").show();
        }
    });

    $("#usuarioForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const empresaId = $("#id-empresa-usuario").val();
        const paisId = $("#id-pais-perfil-select").val();
        const departamentoId = $("#id-departamento-perfil-select").val();
        const municipioId = $("#id-municipio-perfil-select").val();
        const imagenInput = $("#imagen-perfil")[0];

        if (!empresaId) {
            mostrarToast("Por favor, seleccione una empresa válida", "error");
            return;
        }

        const formData = new FormData(form[0]);

        formData.append("empresa_id", empresaId);
        formData.append("pais_id", paisId);
        formData.append("departamento_id", departamentoId);
        formData.append("municipio_id", municipioId);

        if (imagenInput.files.length > 0) {
            formData.append("imagen", imagenInput.files[0]);
        }

        $.ajax({
            url: "/crear-usuario",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_usuarios.ajax.reload();
                estadisticaUsuario();

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $("#registrarUsuario").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar el usuario. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#registrarUsuario").on("hidden.bs.modal", function () {
        $("#usuarioForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();

        $("#ia-tab").tab("show");
    });

    /* Editar el estado del usuario */
    $("#tabla-usuarios").on("change", ".toggle-switch", function () {
        const usuarioId = $(this).data("id");
        const estado = $(this).prop("checked") ? 1 : 0;
        $.ajax({
            url: "/cambiar-estado/" + usuarioId,
            method: "PUT",
            data: {
                id: usuarioId,
                estado: estado,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al cambiar el estado del usuario. Detalles: " +
                    errorThrown,
                    "error"
                );
            },
        });
    });

    /* Editar usuario */
    $("#tabla-usuarios").on("click", ".editar-usuario", function () {
        var usuarioId = $(this).data("id");
        var row = tabla_usuarios.row($(this).parents("tr")).data();
        var nombre = row.nombre;
        var email = row.email;
        var nombres = row.nombres;
        var apellidos = row.apellidos;
        var telefono = row.telefono;
        var direccion = row.direccion;
        var roles = row.roles;
        var empresaId = row.id_empresa;
        var nombreEmpresa = row.nombre_empresa;
        var paisId = row.id_pais;
        var nombrePais = row.nombre_pais;
        var departamentoId = row.id_departamento;
        var nombreDepartamento = row.nombre_departamento;
        var municipioId = row.id_municipio;
        var nombreMunicipio = row.nombre_municipio;

        $("#editarUsuarioForm #btn-editar-usuario").val(usuarioId);
        $("#editarUsuarioForm #nombre-usuario-editar").val(nombre);
        $("#editarUsuarioForm #email-usuario-editar").val(email);
        $("#editarUsuarioForm #nombre-input-editar").val(nombres);
        $("#editarUsuarioForm #apellido-input-editar").val(apellidos);
        $(".image-perfil-name-editar").text(row.imagen);
        $("#editarUsuarioForm #telefono-perfil-editar").val(telefono);
        $("#editarUsuarioForm #direccion-perfil-editar").val(direccion);

        $("#editarUsuarioForm #empresa-usuario-editar").empty();

        $("#editarUsuarioForm #empresa-usuario-editar").append(
            $("<option>", {
                value: empresaId,
                text: nombreEmpresa,
                selected: true,
            })
        );

        $("#editarUsuarioForm #editar-pais-perfil-select").empty();

        $("#editarUsuarioForm #editar-pais-perfil-select").append(
            $("<option>", {
                value: paisId,
                text: nombrePais,
                selected: true,
            })
        );

        $("#editarUsuarioForm #editar-departamento-perfil-select").empty();

        $("#editarUsuarioForm #editar-departamento-perfil-select").append(
            $("<option>", {
                value: departamentoId,
                text: nombreDepartamento,
                selected: true,
            })
        );

        $("#editarUsuarioForm #editar-municipio-perfil-select").empty();

        $("#editarUsuarioForm #editar-municipio-perfil-select").append(
            $("<option>", {
                value: municipioId,
                text: nombreMunicipio,
                selected: true,
            })
        );

        $("#editarUsuarioForm #rol-usuario-select-editar").empty();

        roles.forEach(function (rol) {
            $("#editarUsuarioForm #rol-usuario-select-editar").append(
                $("<option>", {
                    value: rol.id,
                    text: rol.name,
                    selected: true,
                })
            );
        });

        cargarEmpresas(
            "#empresa-usuario-editar",
            "#id-empresa-usuario-editar",
            true,
            empresaId
        );

        cargarRoles(
            "#rol-usuario-select-editar",
            "#id-rol-usuario-editar",
            true,
            roles.length > 0 ? roles[0].id : null
        );

        cargarPaises(
            "#editar-pais-perfil-select",
            "#id-editar-pais-perfil-select",
            "#editar-departamento-perfil-select",
            "#id-editar-departamento-perfil-select",
            "#editar-municipio-perfil-select",
            "#id-editar-municipio-perfil-select",
            paisId,
            departamentoId,
            municipioId
        );

        $("#editarUsuario").modal("show");
    });

    $("#imagen-perfil-editar").change(function () {
        const fileName = $(this).val().split("\\").pop();

        $(".image-perfil-name-editar").text(fileName);

        if (fileName) {
            $(".text-label-image-editar").hide();
        } else {
            $(".text-label-image-editar").show();
        }
    });

    $("#editarUsuarioForm").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const rolId = $("#id-rol-usuario-editar").val();
        const empresaId = $("#id-empresa-usuario-editar").val();
        const paisId = $("#id-editar-pais-perfil-select").val();
        const departamentoId = $("#id-editar-departamento-perfil-select").val();
        const municipioId = $("#id-editar-municipio-perfil-select").val();
        const imagenInput = $("#imagen-perfil-editar")[0];

        if (!rolId || !empresaId) {
            mostrarToast(
                "Por favor, complete todos los campos obligatorios",
                "error"
            );
            return;
        }

        const formData = new FormData(form[0]);

        formData.append("rol_id", rolId);
        formData.append("empresa_id", empresaId);
        formData.append("pais_id", paisId);
        formData.append("departamento_id", departamentoId);
        formData.append("municipio_id", municipioId);

        if (imagenInput.files.length > 0) {
            formData.append("imagen", imagenInput.files[0]);
        }

        $.ajax({
            url: "/actualizar-usuario/" + $("#btn-editar-usuario").val(),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_usuarios.ajax.reload();
                estadisticaUsuario();

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $("#editarUsuario").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al editar el usuario. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#editarUsuario").on("hidden.bs.modal", function () {
        $("#editarUsuarioForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();

        $("#ia-tab-editar").tab("show");
    });

    /* Eliminar usuario */
    $("#tabla-usuarios").on("click", ".eliminar-usuario", function () {
        const usuarioId = $(this).data("id");
        nombreUsuario = tabla_usuarios.row($(this).closest("tr")).data().nombre;

        const modal = $("#eliminarUsuario");
        modal.modal("show");

        modal.find(".nombre-usuario").text(nombreUsuario);
        $("#btn-eliminar-usuario").data("id", usuarioId);
    });

    $("#btn-eliminar-usuario").on("click", function () {
        const usuarioId = $(this).data("id");
        $.ajax({
            url: "/eliminar-usuario/" + usuarioId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_usuarios.ajax.reload();
                estadisticaUsuario();

                $("#eliminarUsuario").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el usuario. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });
});

// Cargar roles
function cargarRoles(rolSelectId, idRolInputId, editar, rolActual) {
    $.ajax({
        url: "/obtener-roles-usuario",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const rolSelect = $(rolSelectId);
            rolSelect.empty();
            rolSelect.append(
                $("<option>", {
                    value: "",
                    text: "Seleccione un rol",
                })
            );

            $.each(data, function (key, value) {
                rolSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (editar && rolActual) {
                rolSelect.val(rolActual);
            }

            $(idRolInputId).val(rolSelect.val());
        },
        error: function (error) {
            console.log("Error al obtener los roles");
        },
    });

    $(rolSelectId).on("change", function () {
        var selectedRolId = $(this).val();
        $(idRolInputId).val(selectedRolId);
    });
}

// Cargar estadisticas
function estadisticaUsuario() {
    $.ajax({
        url: "/obtener-estadisticas-usuarios",
        type: "GET",
        dataType: "json",
        success: function (data) {
            $("#usuarioMes").text(data.usuariosUltimoMes);
            $("#totalUsuarios").text(data.totalUsuarios);
            $("#totalRoles").text(data.totalRoles);
            $("#totalPermisos").text(data.totalPermisos);
        },
        error: function (error) {
            console.log(
                "Error al obtener las estadísticas de usuarios: " + error
            );
        },
    });
}

/* Imprimir usuarios */
function printUsuarios() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "Usuarios - Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>Usuarios - Laboratorios Cofasa</title>"
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
        '<h4 style="text-align: center;">Usuarios - Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-usuarios thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-usuarios tbody tr").each(function () {
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
