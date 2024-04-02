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
                    text: "Nuevo",
                    className: "btn btn-lg btn-store usuario d-block d-md-none",
                    action: function (e, dt, node, config) {
                        document.getElementById("registrarUsuarioBtn").click();
                    },
                },
                {
                    text: "Crear usuario",
                    className: "btn btn-lg btn-store usuario d-none d-md-block",
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
                    targets: [0, 3, 17],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [
                        0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16,
                        17,
                    ],
                    className: "nowrap",
                },
                {
                    targets: [12],
                    className: "wrap",
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
                { data: "name", title: "Usuario" },
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
                                <input class="form-check-input toggle-switch" type="checkbox" id="switch-${row.id
                            }" ${isChecked ? "checked" : ""} data-id="${row.id
                            }">
                                <label class="form-check-label estado-label" for="switch-${row.id
                            }"></label>
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
                                        "admin_usuarios_eliminar"
                                )
                                    ? `
                                            <li>
                                                <button class="dropdown-item eliminar-usuario nav-link" data-id="${row.id}" type="button">
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
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

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
            mostrarToast("Por favor, completa todos los campos requeridos.", "error");
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
        var name = row.name;
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

        const modal = $("#editarUsuario");

        $("#editarUsuarioForm #btn-editar-usuario").val(usuarioId);
        $("#editarUsuarioForm #nombre-usuario-editar").val(name);
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
        modal.find(".modal-title").text("Editar usuario: " + name);

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
        nombreUsuario = tabla_usuarios.row($(this).closest("tr")).data().name;

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
