$(document).ready(function () {
    const apiDatosConozcaCLiente = "/tabla-conozca-cliente";
    let tabla_conozca_cliente = null;
    var fccId;

    tablaConozcaCliente();

    function tablaConozcaCliente() {
        if (tabla_conozca_cliente) {
            tabla_conozca_cliente.destroy();
        }
        $("#tabla-formulario-conozca-cliente-container").hide();

        tabla_conozca_cliente = $("#tabla-conozca-cliente").DataTable({
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
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "Aun no se ha recibido ninguna respuesta",
            },
            ajax: {
                url: apiDatosConozcaCLiente,
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
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 9, 10],
                    orderable: false,
                },
                {
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    className: "nowrap",
                },
                {
                    targets: [],
                    className: "wrap",
                },
                {
                    targets: [2, 3, 4, 5, 6, 7, 8, 9],
                    searchable: true,
                },
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 10 },
            ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-formulario-conozca-cliente-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
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
                { data: "tipo", title: "Tipo" },
                { data: "tipo_persona", title: "Tipo persona" },
                { data: "nombre", title: "Nombre" },
                { data: "apellido", title: "Apellidos" },
                { data: "nombre_juridico", title: "Persona jurídica" },
                { data: "registro_nrc_juridico", title: "Registro NRC" },
                { data: "numero_nit_juridico", title: "Número de NIT" },
                { data: "fecha_creacion", title: "Fecha de creación" },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <div class="text-center">
                                <div class="btn-group">
                                    <button class="btn-icon-close dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow">
                                        <li>
                                            <button class="dropdown-item ver-datos nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                    <path d="M2 8C2 8 6.47715 3 12 3C17.5228 3 22 8 22 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                    <path d="M21.544 13.045C21.848 13.4713 22 13.6845 22 14C22 14.3155 21.848 14.5287 21.544 14.955C20.1779 16.8706 16.6892 21 12 21C7.31078 21 3.8221 16.8706 2.45604 14.955C2.15201 14.5287 2 14.3155 2 14C2 13.6845 2.15201 13.4713 2.45604 13.045C3.8221 11.1294 7.31078 7 12 7C16.6892 7 20.1779 11.1294 21.544 13.045Z" stroke="currentColor" stroke-width="1.8" />
                                                    <path d="M15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17C13.6569 17 15 15.6569 15 14Z" stroke="currentColor" stroke-width="1.8" />
                                                </svg>
                                                <span class="link">Ver datos</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item editar-formulario nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                                    <path d="M16.9459 3.17305C17.5332 2.58578 17.8268 2.29215 18.1521 2.15173C18.6208 1.94942 19.1521 1.94942 19.6208 2.15173C19.946 2.29215 20.2397 2.58578 20.8269 3.17305C21.4142 3.76032 21.7079 4.05395 21.8483 4.37925C22.0506 4.8479 22.0506 5.37924 21.8483 5.84789C21.7079 6.17319 21.4142 6.46682 20.8269 7.05409L15.8054 12.0757C14.5682 13.3129 13.9496 13.9315 13.1748 14.298C12.4 14.6645 11.5294 14.7504 9.78823 14.9222L9 15L9.07778 14.2118C9.24958 12.4706 9.33549 11.6 9.70201 10.8252C10.0685 10.0504 10.6871 9.43183 11.9243 8.19464L16.9459 3.17305Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                                    <path d="M6 15H3.75C2.7835 15 2 15.7835 2 16.75C2 17.7165 2.7835 18.5 3.75 18.5H13.25C14.2165 18.5 15 19.2835 15 20.25C15 21.2165 14.2165 22 13.25 22H11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <span class="link">Editar</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item eliminar-formulario nav-link" data-id="${row.id}" type="button">
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
            order: [[9, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputConozcaCliente = $(
                    "#tabla-conozca-cliente_filter input"
                );
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputConozcaCliente.attr("id", "buscar-conozca-cliente");
                inputConozcaCliente.attr("name", "buscar_conozca_cliente");
                inputConozcaCliente.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputConozcaCliente.before(iconSvg);

                inputConozcaCliente.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_conozca_cliente.search(inputValue).draw();
                    }, 500);
                });

                inputConozcaCliente.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_conozca_cliente.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_conozca_cliente.on("draw.dt", function () {
            $("#tabla-conozca-cliente_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-formulario-conozca-cliente-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 5;

    /* Ver datos por id*/
    $("#tabla-conozca-cliente").on("click", ".ver-datos", function () {
        fccId = $(this).data("id");
        var row = tabla_conozca_cliente.row($(this).parents("tr")).data();

        clienteDocumento = tabla_conozca_cliente
            .row($(this).closest("tr"))
            .data().numero_de_documento;

        clienteTipoDoc = tabla_conozca_cliente
            .row($(this).closest("tr"))
            .data().tipo_de_documento;

        clienteTipoPersona = tabla_conozca_cliente
            .row($(this).closest("tr"))
            .data().tipo_persona;

        const modal = $("#verRespuestaFcc");

        modal
            .find(".modal-title")
            .text(
                clienteTipoPersona +
                " con el documento " +
                clienteTipoDoc +
                ": " +
                clienteDocumento
            );

        var container = $(".container-cards");
        container.empty();

        if (row.formulario_firmado !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.formulario_firmado).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Formulario firmado").appendTo(card);
        }

        if (row.documento_identidad_persona_natural !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_identidad_persona_natural).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Documento de identidad Persona Natural").appendTo(card);
        }

        if (row.documento_tarjeta_iva_persona_natural !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_tarjeta_iva_persona_natural).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Tarjeta de IVA Persona Natural").appendTo(card);
        }

        if (row.documento_nit_persona_natural !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_nit_persona_natural).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Documento NIT Persona Natural").appendTo(card);
        }

        if (row.documento_domicilio_persona_natural !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_domicilio_persona_natural).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Comprobante de Domicilio Persona Natural").appendTo(card);
        }

        if (row.documento_dnm_persona_natural !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_dnm_persona_natural).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Autorización DNM Persona Natural").appendTo(card);
        }

        if (row.documento_identificacion_representante !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_identificacion_representante).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Documento de Indentificación Representante Legal").appendTo(card);
        }

        if (row.documento_nit_representante !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_nit_representante).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Tarjeta NIT Representante Legal").appendTo(card);
        }

        if (row.documento_credencial_representante !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_credencial_representante).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Credencial de Elección Representante Legal").appendTo(card);
        }

        if (row.documento_matricula_juridico !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_matricula_juridico).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Matrícula de Comercio Persona Jurídica").appendTo(card);
        }

        if (row.documento_acuerdo_juridico !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_acuerdo_juridico).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Acuerdo Ejecutivo Persona Jurídica").appendTo(card);
        }

        if (row.documento_nit_juridico !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_nit_juridico).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Tarjeta NIT Persona Jurídica").appendTo(card);
        }

        if (row.documento_iva_juridico !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_iva_juridico).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Tarjeta IVA Persona Jurídica").appendTo(card);
        }

        if (row.documento_domicilio_juridico !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_domicilio_juridico).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Comprobante de Domicilio Persona Jurídica").appendTo(card);
        }

        if (row.documento_dnm_juridico !== null) {
            var link = $("<a>").attr("href", "/docs/fccc/" + fccId + "/" + row.documento_dnm_juridico).attr("target", "_blank").appendTo(container);
            var card = $("<div>").addClass("cards").appendTo(link);
            var svgIcon = $('<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" color="#000000" fill="none">\
                <path d="M3.5 8.23077V5.46154C3.5 3.54978 5.067 2 7 2C8.933 2 10.5 3.54978 10.5 5.46154L10.5 9.26923C10.5 10.2251 9.7165 11 8.75 11C7.7835 11 7 10.2251 7 9.26923L7 5.46154" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />\
                <path d="M12.5 2H12.7727C16.0339 2 17.6645 2 18.7969 2.79784C19.1214 3.02643 19.4094 3.29752 19.6523 3.60289C20.5 4.66867 20.5 6.20336 20.5 9.27273V11.8182C20.5 14.7814 20.5 16.2629 20.0311 17.4462C19.2772 19.3486 17.6829 20.8491 15.6616 21.5586C14.4044 22 12.8302 22 9.68182 22C7.88275 22 6.98322 22 6.26478 21.7478C5.10979 21.3424 4.19875 20.4849 3.76796 19.3979C3.5 18.7217 3.5 17.8751 3.5 16.1818V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
                <path d="M20.5 12C20.5 13.8409 19.0076 15.3333 17.1667 15.3333C16.5009 15.3333 15.716 15.2167 15.0686 15.3901C14.4935 15.5442 14.0442 15.9935 13.8901 16.5686C13.7167 17.216 13.8333 18.0009 13.8333 18.6667C13.8333 20.5076 12.3409 22 10.5 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />\
            </svg>').appendTo(card);
            $("<p>").addClass("name").text("Documento DNM Persona Jurídica").appendTo(card);
        }

        var tipo = row.tipo;
        var tipo_persona = row.tipo_persona;
        var nombre = row.nombre;
        var apellido = row.apellido;
        var fecha_nacimiento = row.fecha_de_nacimiento;
        var nacionalidad = row.nacionalidad;
        var profesion_u_oficio = row.profesion_u_oficio;
        var pais = row.pais;
        var departamento = row.departamento;
        var municipio = row.municipio;
        var profesion_u_oficio = row.profesion_u_oficio;
        var tipo_de_documento = row.tipo_de_documento;
        var numero_de_documento = row.numero_de_documento;
        var fecha_de_vencimiento = row.fecha_de_vencimiento;
        var registro_iva_nrc = row.registro_iva_nrc;
        var correo = row.correo;
        var telefono = row.telefono;
        var fecha_de_nombramiento = row.fecha_de_nombramiento;
        var actividad_economica = row.giro_nombre;
        var direccion = row.direccion;

        var nombre_juridico = row.nombre_juridico;
        var clasificacion = row.clasificacion;
        var nacionalidad_juridico = row.nacionalidad_juridico;
        var numero_nit_juridico = row.numero_nit_juridico;
        var fecha_de_constitucion = row.fecha_de_constitucion;
        var registro_nrc_juridico = row.registro_nrc_juridico;
        var pais_juridico = row.pais_juridico;
        var departamento_juridico = row.departamento_juridico;
        var municipio_juridico = row.municipio_juridico;
        var telefono_juridico = row.telefono_juridico;
        var sitio_web_juridico = row.sitio_web_juridico;
        var numero_de_fax_juridico = row.numero_de_fax_juridico;
        var direccion_juridico = row.direccion_juridico;
        var giro_juridico = row.giro_juridico;
        var monto_proyectado = row.monto_proyectado;
        var cargo_publico = row.cargo_publico;
        var familiar_publico = row.familiar_publico;

        var nombre_politico = row.nombre_politico;
        var nombre_cargo_politico = row.nombre_cargo_politico;
        var fecha_desde_politico = row.fecha_desde_politico;
        var fecha_hasta_politico = row.fecha_hasta_politico;
        var pais_politico = row.pais_politico;
        var departamento_politico = row.departamento_politico;
        var municipio_politico = row.municipio_politico;
        var nombre_cliente_politico = row.nombre_cliente_politico;
        var porcentaje_participacion_politico =
            row.porcentaje_participacion_politico;
        var fuente_ingreso = row.fuente_ingreso;
        var monto_mensual = row.monto_mensual;

        $("#frm_cccid").val(fccId);
        $("#tipo").val(tipo);
        $("#tipo_persona").val(tipo_persona);
        $("#nombre_cliente").val(nombre);
        $("#apellido_cliente").val(apellido);
        $("#fecha_de_nacimiento").val(fecha_nacimiento);
        $("#nacionalidad").val(nacionalidad);
        $("#profesion_u_oficio").val(profesion_u_oficio);
        $("#pais").val(pais);
        $("#departamento").val(departamento);
        $("#municipio").val(municipio);
        $("#tipo_de_documento").val(tipo_de_documento);
        $("#numero_de_documento").val(numero_de_documento);
        $("#fecha_de_vencimiento").val(fecha_de_vencimiento);
        $("#registro_iva_nrc").val(registro_iva_nrc);
        $("#correo").val(correo);
        $("#telefono").val(telefono);
        $("#fecha_de_nombramiento").val(fecha_de_nombramiento);
        $("#actividad_economica").val(actividad_economica);
        $("#direccion").val(direccion);

        $("#nombre_juridico").val(nombre_juridico);
        $("#clasificacion").val(clasificacion);
        $("#nacionalidad_juridico").val(nacionalidad_juridico);
        $("#numero_nit_juridico").val(numero_nit_juridico);
        $("#fecha_de_constitucion").val(fecha_de_constitucion);
        $("#registro_nrc_juridico").val(registro_nrc_juridico);
        $("#pais_juridico").val(pais_juridico);
        $("#departamento_juridico").val(departamento_juridico);
        $("#municipio_juridico").val(municipio_juridico);
        $("#telefono_juridico").val(telefono_juridico);
        $("#sitio_web_juridico").val(sitio_web_juridico);
        $("#numero_de_fax_juridico").val(numero_de_fax_juridico);
        $("#direccion_juridico").val(direccion_juridico);
        $("#giro_juridico").val(giro_juridico);
        $("#monto_proyectado").val(monto_proyectado);
        $("#cargo_publico").val(cargo_publico);
        $("#familiar_publico").val(familiar_publico);

        $("#nombre_politico").val(nombre_politico);
        $("#nombre_cargo_politico").val(nombre_cargo_politico);
        $("#fecha_desde_politico").val(fecha_desde_politico);
        $("#fecha_hasta_politico").val(fecha_hasta_politico);
        $("#pais_politico").val(pais_politico);
        $("#departamento_politico").val(departamento_politico);
        $("#municipio_politico").val(municipio_politico);
        $("#nombre_cliente_politico").val(nombre_cliente_politico);
        $("#porcentaje_participacion_politico").val(
            porcentaje_participacion_politico
        );
        $("#fuente_ingreso").val(fuente_ingreso);
        $("#monto_mensual").val(monto_mensual);

        $.each(row.cliente_accionista, function (index, clienteAccionista) {
            let contadorCampos = index + 1;
            verAccionistas(fccId, contadorCampos, clienteAccionista);
        });

        $.each(row.cliente_miembro, function (index, clienteMiembro) {
            let contadorCamposMiembro = index + 1;
            verMiembros(fccId, contadorCamposMiembro, clienteMiembro);
        });

        $.each(row.cliente_pariente, function (index, clientePariente) {
            let contadorCamposPariente = index + 1;
            verParientes(fccId, contadorCamposPariente, clientePariente);
        });

        $.each(row.cliente_socio, function (index, clienteSocio) {
            let contadorCamposSocio = index + 1;
            verSocios(fccId, contadorCamposSocio, clienteSocio);
        });

        $("#verRespuestaFcc").modal("show");
    });

    $("#verRespuestaFcc").on("hidden.bs.modal", function () {
        $("#camposAccionista").empty();
        $("#camposMiembro").empty();
        $("#camposPariente").empty();
        $("#camposSocio").empty();
    });

    // Editar el estado del formulario
    $("#tabla-conozca-cliente").on("change", ".toggle-switch", function () {
        fccId = $(this).data("id");
        const estado = $(this).prop("checked") ? 1 : 0;

        $.ajax({
            url: "/cambiar-estado-form/" + fccId,
            method: "PUT",
            data: {
                id: fccId,
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
                    "Error al cambiar el estado del formulario. Detalles: " +
                    errorThrown,
                    "error"
                );
            },
        });
    });

    // Editar el formulario
    $("#tabla-conozca-cliente").on("click", ".editar-formulario", function () {
        fcc_editar_id = $(this).data("id");
        var row = tabla_conozca_cliente.row($(this).parents("tr")).data();

        cliente_documento_editar = tabla_conozca_cliente
            .row($(this).closest("tr"))
            .data().numero_de_documento;

        cliente_tipodoc_editar = tabla_conozca_cliente
            .row($(this).closest("tr"))
            .data().tipo_de_documento;

        cliente_tipo_persona_editar = tabla_conozca_cliente
            .row($(this).closest("tr"))
            .data().tipo_persona;

        const modal = $("#editarFormulario");

        modal
            .find(".modal-title")
            .text(
                cliente_tipo_persona_editar +
                " con el documento " +
                cliente_tipodoc_editar +
                ": " +
                cliente_documento_editar
            );

        var tipo_editar = row.tipo;
        var tipo_persona_editar = row.tipo_persona;
        var nombre_editar = row.nombre;
        var apellido_editar = row.apellido;
        var fecha_nacimiento_editar = row.fecha_de_nacimiento;
        var nacionalidad_editar = row.nacionalidad;
        var profesion_u_oficio_editar = row.profesion_u_oficio;

        var pais_editar_id = row.id_pais;
        var pais_editar = row.pais;
        var departamento_editar_id = row.id_departamento;
        var departamento_editar = row.departamento;
        var municipio_editar_id = row.id_municipio;
        var municipio_editar = row.municipio;

        var pais_juridico_editar_id = row.id_pais_juridico;
        var pais_juridico_editar = row.pais_juridico;
        var departamento_juridico_editar_id = row.id_departamento_juridico;
        var departamento_juridico_editar = row.departamento_juridico;
        var municipio_juridico_editar_id = row.id_municipio_juridico;
        var municipio_juridico_editar = row.municipio_juridico;

        var pais_politico_editar_id = row.id_pais_politico;
        var pais_politico_editar = row.pais_politico;
        var departamento_politico_editar_id = row.id_departamento_politico;
        var departamento_politico_editar = row.departamento_politico;
        var municipio_politico_editar_id = row.id_municipio_politico;
        var municipio_politico_editar = row.municipio_politico;

        var tipo_de_documento_editar = row.tipo_de_documento;
        var numero_de_documento_editar = row.numero_de_documento;
        var fecha_de_vencimiento_editar = row.fecha_de_vencimiento;
        var registro_iva_nrc_editar = row.registro_iva_nrc;
        var correo_editar = row.correo;
        var telefono_editar = row.telefono;
        var fecha_de_nombramiento_editar = row.fecha_de_nombramiento;
        var actividad_economica_editar = row.giro_nombre;
        var direccion_editar = row.direccion;

        var nombre_juridico_editar = row.nombre_juridico;
        var clasificacion_editar = row.clasificacion;
        var nacionalidad_juridico_editar = row.nacionalidad_juridico;
        var numero_nit_juridico_editar = row.numero_nit_juridico;
        var fecha_de_constitucion_editar = row.fecha_de_constitucion;
        var registro_nrc_juridico_editar = row.registro_nrc_juridico;
        var telefono_juridico_editar = row.telefono_juridico;
        var sitio_web_juridico_editar = row.sitio_web_juridico;
        var numero_de_fax_juridico_editar = row.numero_de_fax_juridico;
        var direccion_juridico_editar = row.direccion_juridico;
        var giro_juridico_editar = row.giro_juridico;
        var monto_proyectado_editar = row.monto_proyectado;
        var cargo_publico_editar = row.cargo_publico;
        var familiar_publico_editar = row.familiar_publico;

        var nombre_politico_editar = row.nombre_politico;
        var nombre_cargo_politico_editar = row.nombre_cargo_politico;
        var fecha_desde_politico_editar = row.fecha_desde_politico;
        var fecha_hasta_politico_editar = row.fecha_hasta_politico;
        var pais_politico_editar = row.pais_politico;
        var departamento_politico_editar = row.departamento_politico;
        var municipio_politico_editar = row.municipio_politico;
        var nombre_cliente_politico_editar = row.nombre_cliente_politico;
        var porcentaje_participacion_politico_editar =
            row.porcentaje_participacion_politico;
        var fuente_ingreso_editar = row.fuente_ingreso;
        var monto_mensual_editar = row.monto_mensual;

        $("#frm_cccid").val(fcc_editar_id);
        $("#tipo_editar").val(tipo_editar);
        $("#tipo_persona_editar").val(tipo_persona_editar);
        $("#nombre_cliente_editar").val(nombre_editar);
        $("#apellido_cliente_editar").val(apellido_editar);
        $("#fecha_de_nacimiento_editar").val(fecha_nacimiento_editar);
        $("#nacionalidad_editar").val(nacionalidad_editar);
        $("#profesion_u_oficio_editar").val(profesion_u_oficio_editar);

        $("#formularioEditarForm #id_editar_pais").val(pais_editar_id);
        $("#formularioEditarForm #pais_editar").append(
            $("<option>", {
                value: pais_editar_id,
                text: pais_editar,
                selected: true,
            })
        );

        $("#formularioEditarForm #id_departamento_editar").val(departamento_editar_id);
        $("#formularioEditarForm #departamento_editar").append(
            $("<option>", {
                value: departamento_editar_id,
                text: departamento_editar,
                selected: true,
            })
        );

        $("#formularioEditarForm #id_municipio_editar").val(municipio_editar_id);
        $("#formularioEditarForm #municipio_editar").append(
            $("<option>", {
                value: municipio_editar_id,
                text: municipio_editar,
                selected: true,
            })
        );

        $("#formularioEditarForm #id_editar_pais_juridico").val(pais_juridico_editar_id);
        $("#formularioEditarForm #pais_juridico_editar").append(
            $("<option>", {
                value: pais_juridico_editar_id,
                text: pais_juridico_editar,
                selected: true,
            })
        );

        $("#formularioEditarForm #id_departamento_juridico_editar").val(departamento_juridico_editar_id);
        $("#formularioEditarForm #departamento_juridico_editar").append(
            $("<option>", {
                value: departamento_juridico_editar_id,
                text: departamento_juridico_editar,
                selected: true,
            })
        );

        $("#formularioEditarForm #id_municipio_juridico_editar").val(municipio_juridico_editar_id);
        $("#formularioEditarForm #municipio_juridico_editar").append(
            $("<option>", {
                value: municipio_juridico_editar_id,
                text: municipio_juridico_editar,
                selected: true,
            })
        );

        $("#formularioEditarForm #id_editar_pais_politico").val(pais_politico_editar_id);
        $("#formularioEditarForm #pais_politico_editar").append(
            $("<option>", {
                value: pais_politico_editar_id,
                text: pais_politico_editar,
                selected: true,
            })
        );

        $("#formularioEditarForm #id_departamento_politico_editar").val(departamento_politico_editar_id);
        $("#formularioEditarForm #departamento_politico_editar").append(
            $("<option>", {
                value: departamento_politico_editar_id,
                text: departamento_politico_editar,
                selected: true,
            })
        );

        $("#formularioEditarForm #id_municipio_politico_editar").val(municipio_politico_editar_id);
        $("#formularioEditarForm #municipio_politico_editar").append(
            $("<option>", {
                value: municipio_politico_editar_id,
                text: municipio_politico_editar,
                selected: true,
            })
        );

        $("#tipo_de_documento_editar").val(tipo_de_documento_editar);
        $("#numero_de_documento_editar").val(numero_de_documento_editar);
        $("#fecha_de_vencimiento_editar").val(fecha_de_vencimiento_editar);
        $("#registro_iva_nrc_editar").val(registro_iva_nrc_editar);
        $("#correo_editar").val(correo_editar);
        $("#telefono_editar").val(telefono_editar);
        $("#fecha_de_nombramiento_editar").val(fecha_de_nombramiento_editar);
        $("#actividad_economica_editar").val(actividad_economica_editar);
        $("#direccion_editar").val(direccion_editar);

        $("#nombre_juridico_editar").val(nombre_juridico_editar);
        $("#clasificacion_editar").val(clasificacion_editar);
        $("#nacionalidad_juridico_editar").val(nacionalidad_juridico_editar);
        $("#numero_nit_juridico_editar").val(numero_nit_juridico_editar);
        $("#fecha_de_constitucion_editar").val(fecha_de_constitucion_editar);
        $("#registro_nrc_juridico_editar").val(registro_nrc_juridico_editar);
        $("#telefono_juridico_editar").val(telefono_juridico_editar);
        $("#sitio_web_juridico_editar").val(sitio_web_juridico_editar);
        $("#numero_de_fax_juridico_editar").val(numero_de_fax_juridico_editar);
        $("#direccion_juridico_editar").val(direccion_juridico_editar);
        $("#giro_juridico_editar").val(giro_juridico_editar);
        $("#monto_proyectado_editar").val(monto_proyectado_editar);
        $("#cargo_publico_editar").val(cargo_publico_editar);
        $("#familiar_publico_editar").val(familiar_publico_editar);

        $("#nombre_politico_editar").val(nombre_politico_editar);
        $("#nombre_cargo_politico_editar").val(nombre_cargo_politico_editar);
        $("#fecha_desde_politico_editar").val(fecha_desde_politico_editar);
        $("#fecha_hasta_politico_editar").val(fecha_hasta_politico_editar);
        $("#pais_politico_editar").val(pais_politico_editar);
        $("#departamento_politico_editar").val(departamento_politico_editar);
        $("#municipio_politico_editar").val(municipio_politico_editar);
        $("#nombre_cliente_politico_editar").val(nombre_cliente_politico_editar);
        $("#porcentaje_participacion_politico_editar").val(
            porcentaje_participacion_politico_editar
        );
        $("#fuente_ingreso_editar").val(fuente_ingreso_editar);
        $("#monto_mensual_editar").val(monto_mensual_editar);

        $.each(row.cliente_accionista, function (index, clienteAccionista) {
            let contadorCamposEditar = index + 1;
            verAccionistasEditar(fcc_editar_id, contadorCamposEditar, clienteAccionista);
        });

        $.each(row.cliente_miembro, function (index, clienteMiembro) {
            let contadorCamposMiembroEditar = index + 1;
            verMiembrosEditar(fcc_editar_id, contadorCamposMiembroEditar, clienteMiembro);
        });

        $.each(row.cliente_pariente, function (index, clientePariente) {
            let contadorCamposParienteEditar = index + 1;
            verParientesEditar(fcc_editar_id, contadorCamposParienteEditar, clientePariente);
        });

        $.each(row.cliente_socio, function (index, clienteSocio) {
            let contadorCamposSocioEditar = index + 1;
            verSociosEditar(fcc_editar_id, contadorCamposSocioEditar, clienteSocio);
        });

        cargarPaises(
            "#pais_editar",
            "#id_editar_pais",
            "#departamento_editar",
            "#id_departamento_editar",
            "#municipio_editar",
            "#id_municipio_editar",
            pais_editar_id,
            departamento_editar_id,
            municipio_editar_id
        );

        cargarPaises(
            '#pais_juridico_editar',
            '#id_editar_pais_juridico',
            '#departamento_juridico_editar',
            '#id_departamento_juridico_editar',
            '#municipio_juridico_editar',
            '#id_municipio_juridico_editar',
            pais_juridico_editar_id,
            departamento_juridico_editar_id,
            municipio_juridico_editar_id
        );

        cargarPaises(
            '#pais_politico_editar',
            '#id_editar_pais_politico',
            '#departamento_politico_editar',
            '#id_departamento_politico_editar',
            '#municipio_politico_editar',
            '#id_municipio_politico_editar',
            pais_politico_editar_id,
            departamento_politico_editar_id,
            municipio_politico_editar_id
        );

        $("#editarFormulario").modal("show");
    });

    $("#editarFormulario").on("hidden.bs.modal", function () {
        $("#camposAccionistaEditar").empty();
        $("#camposMiembroEditar").empty();
        $("#camposParienteEditar").empty();
        $("#camposSocioEditar").empty();
    });

    // Eliminar formulario
    $("#tabla-conozca-cliente").on("click", ".eliminar-formulario", function () {
        const formularioId = $(this).data("id");
        nombreJuridico = tabla_conozca_cliente.row($(this).closest("tr")).data().nombre_juridico;

        const modal = $("#eliminarFormulario");
        modal.modal("show");

        modal.find(".nombre-juridico").text(nombreJuridico);
        $("#btn-eliminar-formulario").data("id", formularioId);
    });

    $("#btn-eliminar-formulario").on("click", function () {
        const formularioId = $(this).data("id");
        $.ajax({
            url: "/eliminar-formulario/" + formularioId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_conozca_cliente.ajax.reload();

                $("#eliminarFormulario").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el formulario. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });
});

/* Cargar cliente accionista */
function verAccionistas(fccId, contadorCampos, clienteAccionista) {
    let nombre_accionista =
        clienteAccionista.nombre_accionista !== null
            ? clienteAccionista.nombre_accionista
            : "";
    let nacionalidad_accionista =
        clienteAccionista.nacionalidad_accionista !== null
            ? clienteAccionista.nacionalidad_accionista
            : "";
    let numero_identidad_accionista =
        clienteAccionista.numero_identidad_accionista !== null
            ? clienteAccionista.numero_identidad_accionista
            : "";
    let porcentaje_participacion_accionista =
        clienteAccionista.porcentaje_participacion_accionista !== null
            ? clienteAccionista.porcentaje_participacion_accionista
            : "";

    let clienteAccionistaHtml = `
    <div class="row">
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="nombre_accionista${fccId}-${contadorCampos}" class="form-label">Nombre completo</label>
                <input disabled type="text" class="form-control" id="nombre_accionista${fccId}-${contadorCampos}" name="nombre_accionista[]" value="${nombre_accionista}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="nacionalidad_accionista${fccId}-${contadorCampos}" class="form-label">Nacionalidad</label>
                <input disabled type="text" class="form-control" id="nacionalidad_accionista${fccId}-${contadorCampos}" name="nacionalidad_accionista[]" value="${nacionalidad_accionista}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="numero_identidad_accionista${fccId}-${contadorCampos}" class="form-label">No. Identidad</label>
                <input disabled type="text" class="form-control" id="numero_identidad_accionista${fccId}-${contadorCampos}" name="numero_identidad_accionista[]" value="${numero_identidad_accionista}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="porcentaje_participacion_accionista${fccId}-${contadorCampos}" class="form-label">Porcentaje de participación</label>
                <input disabled type="text" class="form-control" id="porcentaje_participacion_accionista${fccId}-${contadorCampos}" name="porcentaje_participacion_accionista[]" value="${porcentaje_participacion_accionista}">
            </div>
        </div>
    </div>
    `;

    $("#camposAccionista").append(clienteAccionistaHtml);
}

/* Cargar cliente miembro */
function verMiembros(fccId, contadorCamposMiembro, clienteMiembro) {
    let nombre_miembro =
        clienteMiembro.nombre_miembro !== null
            ? clienteMiembro.nombre_miembro
            : "";
    let nacionalidad_miembro =
        clienteMiembro.nacionalidad_miembro !== null
            ? clienteMiembro.nacionalidad_miembro
            : "";
    let numero_identidad_miembro =
        clienteMiembro.numero_identidad_miembro !== null
            ? clienteMiembro.numero_identidad_miembro
            : "";
    let cargo_miembro =
        clienteMiembro.cargo_miembro !== null
            ? clienteMiembro.cargo_miembro
            : "";

    let clienteMiembroHtml = `
    <div class="row">
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="nombre_miembro${fccId}-${contadorCamposMiembro}" class="form-label">Nombre completo</label>
                <input disabled type="text" class="form-control" id="nombre_miembro${fccId}-${contadorCamposMiembro}" name="nombre_miembro[]" value="${nombre_miembro}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="nacionalidad_miembro${fccId}-${contadorCamposMiembro}" class="form-label">Nacionalidad</label>
                <input disabled type="text" class="form-control" id="nacionalidad_miembro${fccId}-${contadorCamposMiembro}" name="nacionalidad_miembro[]" value="${nacionalidad_miembro}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="numero_identidad_miembro${fccId}-${contadorCamposMiembro}" class="form-label">No. Identidad</label>
                <input disabled type="text" class="form-control" id="numero_identidad_miembro${fccId}-${contadorCamposMiembro}" name="numero_identidad_miembro[]" value="${numero_identidad_miembro}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="cargo_miembro${fccId}-${contadorCamposMiembro}" class="form-label">Cargo</label>
                <input disabled type="text" class="form-control" id="cargo_miembro${fccId}-${contadorCamposMiembro}" name="cargo_miembro[]" value="${cargo_miembro}">
            </div>
        </div>
    </div>
    `;

    $("#camposMiembro").append(clienteMiembroHtml);
}

/* Cargar cliente parientes */
function verParientes(fccId, contadorCamposPariente, clientePariente) {
    let nombre_pariente =
        clientePariente.nombre_pariente !== null
            ? clientePariente.nombre_pariente
            : "";
    let parentesco =
        clientePariente.parentesco !== null ? clientePariente.parentesco : "";

    let clienteParienteHtml = `
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="nombre_pariente${fccId}-${contadorCamposPariente}" class="form-label">Nombre completo</label>
                <input disabled type="text" class="form-control" id="nombre_pariente${fccId}-${contadorCamposPariente}" name="nombre_pariente[]" value="${nombre_pariente}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="parentesco${fccId}-${contadorCamposPariente}" class="form-label">Parentesco</label>
                <input disabled type="text" class="form-control" id="parentesco${fccId}-${contadorCamposPariente}" name="parentesco[]" value="${parentesco}">
            </div>
        </div>
    </div>
    `;

    $("#camposPariente").append(clienteParienteHtml);
}

/* Cargar cliente socios */
function verSocios(fccId, contadorCamposSocio, clienteSocio) {
    let nombre_socio =
        clienteSocio.nombre_socio !== null ? clienteSocio.nombre_socio : "";
    let porcentaje_participacion_socio =
        clienteSocio.porcentaje_participacion_socio !== null
            ? clienteSocio.porcentaje_participacion_socio
            : "";

    let clienteSocioHtml = `
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="nombre_socio${fccId}-${contadorCamposSocio}" class="form-label">Nombre completo</label>
                <input disabled type="text" class="form-control" id="nombre_socio${fccId}-${contadorCamposSocio}" name="nombre_socio[]" value="${nombre_socio}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="porcentaje_participacion_socio${fccId}-${contadorCamposSocio}" class="form-label">Porcentaje de participación</label>
                <input disabled type="text" class="form-control" id="porcentaje_participacion_socio${fccId}-${contadorCamposSocio}" name="porcentaje_participacion_socio[]" value="${porcentaje_participacion_socio}">
            </div>
        </div>
    </div>
    `;

    $("#camposSocio").append(clienteSocioHtml);
}

/* Cargar cliente accionista editar */
function verAccionistasEditar(fcc_editar_id, contadorCamposEditar, clienteAccionista) {
    let nombre_accionista_editar =
        clienteAccionista.nombre_accionista !== null
            ? clienteAccionista.nombre_accionista
            : "";
    let nacionalidad_accionista_editar =
        clienteAccionista.nacionalidad_accionista !== null
            ? clienteAccionista.nacionalidad_accionista
            : "";
    let numero_identidad_accionista_editar =
        clienteAccionista.numero_identidad_accionista !== null
            ? clienteAccionista.numero_identidad_accionista
            : "";
    let porcentaje_participacion_accionista_editar =
        clienteAccionista.porcentaje_participacion_accionista !== null
            ? clienteAccionista.porcentaje_participacion_accionista
            : "";

    let clienteAccionistaEditarHtml = `
    <div class="row">
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="nombre_accionista_editar${fcc_editar_id}-${contadorCamposEditar}" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre_accionista_editar${fcc_editar_id}-${contadorCamposEditar}" name="nombre_accionista_editar[]" value="${nombre_accionista_editar}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="nacionalidad_accionista_editar${fcc_editar_id}-${contadorCamposEditar}" class="form-label">Nacionalidad</label>
                <input type="text" class="form-control" id="nacionalidad_accionista_editar${fcc_editar_id}-${contadorCamposEditar}" name="nacionalidad_accionista_editar[]" value="${nacionalidad_accionista_editar}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="numero_identidad_accionista_editar${fcc_editar_id}-${contadorCamposEditar}" class="form-label">No. Identidad</label>
                <input type="text" class="form-control" id="numero_identidad_accionista_editar${fcc_editar_id}-${contadorCamposEditar}" name="numero_identidad_accionista_editar[]" value="${numero_identidad_accionista_editar}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="porcentaje_participacion_accionista_editar${fcc_editar_id}-${contadorCamposEditar}" class="form-label">Porcentaje de participación</label>
                <input type="text" class="form-control" id="porcentaje_participacion_accionista_editar${fcc_editar_id}-${contadorCamposEditar}" name="porcentaje_participacion_accionista_editar[]" value="${porcentaje_participacion_accionista_editar}">
            </div>
        </div>
    </div>
    `;

    $("#camposAccionistaEditar").append(clienteAccionistaEditarHtml);
}

/* Cargar cliente miembro editar */
function verMiembrosEditar(fcc_editar_id, contadorCamposMiembroEditar, clienteMiembro) {
    let nombre_miembro_editar =
        clienteMiembro.nombre_miembro !== null
            ? clienteMiembro.nombre_miembro
            : "";
    let nacionalidad_miembro_editar =
        clienteMiembro.nacionalidad_miembro !== null
            ? clienteMiembro.nacionalidad_miembro
            : "";
    let numero_identidad_miembro_editar =
        clienteMiembro.numero_identidad_miembro !== null
            ? clienteMiembro.numero_identidad_miembro
            : "";
    let cargo_miembro_editar =
        clienteMiembro.cargo_miembro !== null
            ? clienteMiembro.cargo_miembro
            : "";

    let clienteMiembroEditarHtml = `
    <div class="row">
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="nombre_miembro_editar${fcc_editar_id}-${contadorCamposMiembroEditar}" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre_miembro_editar${fcc_editar_id}-${contadorCamposMiembroEditar}" name="nombre_miembro_editar[]" value="${nombre_miembro_editar}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="nacionalidad_miembro_editar${fcc_editar_id}-${contadorCamposMiembroEditar}" class="form-label">Nacionalidad</label>
                <input type="text" class="form-control" id="nacionalidad_miembro_editar${fcc_editar_id}-${contadorCamposMiembroEditar}" name="nacionalidad_miembro_editar[]" value="${nacionalidad_miembro_editar}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="numero_identidad_miembro_editar${fcc_editar_id}-${contadorCamposMiembroEditar}" class="form-label">No. Identidad</label>
                <input type="text" class="form-control" id="numero_identidad_miembro_editar${fcc_editar_id}-${contadorCamposMiembroEditar}" name="numero_identidad_miembro_editar[]" value="${numero_identidad_miembro_editar}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="cargo_miembro_editar${fcc_editar_id}-${contadorCamposMiembroEditar}" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo_miembro_editar${fcc_editar_id}-${contadorCamposMiembroEditar}" name="cargo_miembro_editar[]" value="${cargo_miembro_editar}">
            </div>
        </div>
    </div>
    `;

    $("#camposMiembroEditar").append(clienteMiembroEditarHtml);
}

/* Cargar cliente parientes editar */
function verParientesEditar(fccId, contadorCamposParienteEditar, clientePariente) {
    let nombre_pariente_editar =
        clientePariente.nombre_pariente !== null
            ? clientePariente.nombre_pariente
            : "";
    let parentesco_editar =
        clientePariente.parentesco !== null ? clientePariente.parentesco : "";

    let clienteParienteEditarHtml = `
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="nombre_pariente_editar${fccId}-${contadorCamposParienteEditar}" class="form-label">Nombre completo</label>
                <input disabled type="text" class="form-control" id="nombre_pariente_editar${fccId}-${contadorCamposParienteEditar}" name="nombre_pariente_editar[]" value="${nombre_pariente_editar}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="parentesco_editar${fccId}-${contadorCamposParienteEditar}" class="form-label">Parentesco</label>
                <input disabled type="text" class="form-control" id="parentesco_editar${fccId}-${contadorCamposParienteEditar}" name="parentesco_editar[]" value="${parentesco_editar}">
            </div>
        </div>
    </div>
    `;

    $("#camposParienteEditar").append(clienteParienteEditarHtml);
}

/* Cargar cliente socios editar */
function verSociosEditar(fccId, contadorCamposSocioEditar, clienteSocio) {
    let nombre_socio_editar =
        clienteSocio.nombre_socio !== null ? clienteSocio.nombre_socio : "";
    let porcentaje_participacion_socio_editar =
        clienteSocio.porcentaje_participacion_socio !== null
            ? clienteSocio.porcentaje_participacion_socio
            : "";

    let clienteSocioEditarHtml = `
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="nombre_socio_editar${fccId}-${contadorCamposSocioEditar}" class="form-label">Nombre completo</label>
                <input disabled type="text" class="form-control" id="nombre_socio_editar${fccId}-${contadorCamposSocioEditar}" name="nombre_socio_editar[]" value="${nombre_socio_editar}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <label for="porcentaje_participacion_socio_editar${fccId}-${contadorCamposSocioEditar}" class="form-label">Porcentaje de participación</label>
                <input disabled type="text" class="form-control" id="porcentaje_participacion_socio_editar${fccId}-${contadorCamposSocioEditar}" name="porcentaje_participacion_socio_editar[]" value="${porcentaje_participacion_socio_editar}">
            </div>
        </div>
    </div>
    `;

    $("#camposSocioEditar").append(clienteSocioEditarHtml);
}