document.addEventListener("DOMContentLoaded", function () {
    const apiTipoContratacion = "/tabla-tipo-contratacion";
    let tabla_tipo_contratacion = null;

    tablaTipoContratacion();

    function tablaTipoContratacion() {
        if (tabla_tipo_contratacion) {
            tabla_tipo_contratacion.destroy();
        }
        $("#tabla-contratacion-container").hide();

        tabla_tipo_contratacion = $("#tabla-tipo-contratacion").DataTable({
            dom:
                "<'botones-filter'<f>>" +
                "<tr>" +
                "<'info-pagination'<p>>",
            serverSide: true,
            processing: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [5],
                ["5 filas"],
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay tipos de contratación registrados",
            },
            ajax: {
                url: apiTipoContratacion,
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
                    targets: [0, 2],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [1],
                    searchable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-contratacion-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre_tipo", title: "Tipo de contratación" },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                                <div class="text-center">
                                    <div class="btn-group side">
                                        <button class="btn-icon-close dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                            <li>
                                                <button class="dropdown-item editar-tipo-contratacion nav-link" data-id="${row.id}" type="button">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                        <path d="M16.9459 3.17305C17.5332 2.58578 17.8268 2.29215 18.1521 2.15173C18.6208 1.94942 19.1521 1.94942 19.6208 2.15173C19.946 2.29215 20.2397 2.58578 20.8269 3.17305C21.4142 3.76032 21.7079 4.05395 21.8483 4.37925C22.0506 4.8479 22.0506 5.37924 21.8483 5.84789C21.7079 6.17319 21.4142 6.46682 20.8269 7.05409L15.8054 12.0757C14.5682 13.3129 13.9496 13.9315 13.1748 14.298C12.4 14.6645 11.5294 14.7504 9.78823 14.9222L9 15L9.07778 14.2118C9.24958 12.4706 9.33549 11.6 9.70201 10.8252C10.0685 10.0504 10.6871 9.43183 11.9243 8.19464L16.9459 3.17305Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                                        <path d="M6 15H3.75C2.7835 15 2 15.7835 2 16.75C2 17.7165 2.7835 18.5 3.75 18.5H13.25C14.2165 18.5 15 19.2835 15 20.25C15 21.2165 14.2165 22 13.25 22H11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="link">Editar</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item eliminar-tipo-contratacion nav-link" data-id="${row.id}" type="button">
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

            order: [[1, "asc"]],

            initComplete: function () {
                let searchTimeout;
                const inputTipoContratacion = $("#tabla-tipo-contratacion_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputTipoContratacion.attr("id", "buscar-tipo-contratacion");
                inputTipoContratacion.attr("name", "buscar_tipo_contratacion");
                inputTipoContratacion.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputTipoContratacion.before(iconSvg);

                inputTipoContratacion.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_tipo_contratacion.search(inputValue).draw();
                    }, 500);
                });

                inputTipoContratacion.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_tipo_contratacion.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_tipo_contratacion.on("draw.dt", function () {
            $("#tabla-tipo-contratacion_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-contratacion-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 5;

    $('#guardarTipoBtn').click(function (e) {
        e.preventDefault();

        if ($('#contratacionForm')[0].checkValidity() === false) {
            $('#contratacionForm').addClass('was-validated');
            return;
        }

        var formData = $('#contratacionForm').serialize();

        $.ajax({
            url: "/creando-tipo-contratacion",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_tipo_contratacion.ajax.reload();

                cargarTipoContratacion(
                    "#contrato",
                    "#tipo_contratacion_id",
                    false
                );

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $('#nombre_tipo').val('');
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar el tipo de contratación. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#tabla-tipo-contratacion").on("click", ".editar-tipo-contratacion", function () {
        var contratacionId = $(this).data("id");
        var row = tabla_tipo_contratacion.row($(this).parents("tr")).data();
        var nombre_tipo = row.nombre_tipo;

        $("#contratacionEditarForm #editar_contratacion").val(contratacionId);
        $("#contratacionEditarForm #contratacion_editar").val(nombre_tipo);
        $("#editarContratacion").modal("show");
    });

    $("#contratacionEditarForm").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const formData = new FormData(form[0]);

        $.ajax({
            url: "/actualizar-tipo-contratacion/" + $("#editar_contratacion").val(),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_tipo_contratacion.ajax.reload();

                cargarTipoContratacion(
                    "#contrato",
                    "#tipo_contratacion_id",
                    false
                );

                if (response.success) {
                    mostrarToast(response.message, "success");
                    $("#editarContratacion").modal("hide");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al editar el tipo de contratación. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#editarContratacion").on("hidden.bs.modal", function () {
        $("#contratacionEditarForm")
            .removeClass("was-validated")
            .find(":input")
            .removeClass("is-invalid")
            .end()[0]
            .reset();
    });

    $("#tabla-tipo-contratacion").on("click", ".eliminar-tipo-contratacion", function () {
        const tipoContratacionId = $(this).data("id");
        nombreTipo = tabla_tipo_contratacion.row($(this).closest("tr")).data().nombre_tipo;

        const modal = $("#eliminarContratacion");
        modal.modal("show");

        modal.find(".nombre-contratacion").text(nombreTipo);
        $("#btn-eliminar-contratacion").data("id", tipoContratacionId);
    });

    $("#btn-eliminar-contratacion").on("click", function () {
        const contratacionId = $(this).data("id");
        $.ajax({
            url: "/eliminar-tipo-contratacion/" + contratacionId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_tipo_contratacion.ajax.reload();

                cargarTipoContratacion(
                    "#contrato",
                    "#tipo_contratacion_id",
                    false
                );

                $("#eliminarContratacion").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el tipo de contratación. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });
});