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
                "<'row align-items-end'<'col-md-8 col-sm-8 col-12 p-0'B><'col-md-4 col-sm-12 col-12 p-0'f>>" +
                "<'row py-2'<'col-md-12'tr>>" +
                "<'row'<'col-md-5 pb-3 px-0'i><'col-md-7 px-0'p>>",
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
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 9],
                    orderable: false,
                },
                {
                    targets: [
                        0, 1, 2, 3, 4, 5, 6, 7, 8
                    ],
                    className: "nowrap",
                },
                {
                    targets: [],
                    className: "wrap",
                },
                {
                    targets: [
                        2, 3, 4, 5, 6, 7, 8
                    ],
                    searchable: true,
                },
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 9 },
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
                                    <button class="btn-icon-close ver-datos" data-id="${row.id}">
                                        <svg class="icon-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                                            <path d="M2 8C2 8 6.47715 3 12 3C17.5228 3 22 8 22 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path d="M21.544 13.045C21.848 13.4713 22 13.6845 22 14C22 14.3155 21.848 14.5287 21.544 14.955C20.1779 16.8706 16.6892 21 12 21C7.31078 21 3.8221 16.8706 2.45604 14.955C2.15201 14.5287 2 14.3155 2 14C2 13.6845 2.15201 13.4713 2.45604 13.045C3.8221 11.1294 7.31078 7 12 7C16.6892 7 20.1779 11.1294 21.544 13.045Z" stroke="currentColor" stroke-width="1.8" />
                                            <path d="M15 14C15 12.3431 13.6569 11 12 11C10.3431 11 9 12.3431 9 14C9 15.6569 10.3431 17 12 17C13.6569 17 15 15.6569 15 14Z" stroke="currentColor" stroke-width="1.8" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        `;
                    },
                },
            ],
            order: [[8, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputConozcaCliente = $("#tabla-conozca-cliente_filter input");
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

    $.fn.DataTable.ext.pager.numbers_length = 4;

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

        modal.find(".modal-title").text(clienteTipoPersona + " con el documento " + clienteTipoDoc + ": " + clienteDocumento);

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
        var porcentaje_participacion_politico = row.porcentaje_participacion_politico;
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
        $("#porcentaje_participacion_politico").val(porcentaje_participacion_politico);
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

    /* Editar el estado del formulario */
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

});

/* Cargar cliente accionista */
function verAccionistas(fccId, contadorCampos, clienteAccionista) {
    let nombre_accionista = clienteAccionista.nombre_accionista !== null ? clienteAccionista.nombre_accionista : "";
    let nacionalidad_accionista = clienteAccionista.nacionalidad_accionista !== null ? clienteAccionista.nacionalidad_accionista : "";
    let numero_identidad_accionista = clienteAccionista.numero_identidad_accionista !== null ? clienteAccionista.numero_identidad_accionista : "";
    let porcentaje_participacion_accionista = clienteAccionista.porcentaje_participacion_accionista !== null ? clienteAccionista.porcentaje_participacion_accionista : "";

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
    let nombre_miembro = clienteMiembro.nombre_miembro !== null ? clienteMiembro.nombre_miembro : "";
    let nacionalidad_miembro = clienteMiembro.nacionalidad_miembro !== null ? clienteMiembro.nacionalidad_miembro : "";
    let numero_identidad_miembro = clienteMiembro.numero_identidad_miembro !== null ? clienteMiembro.numero_identidad_miembro : "";
    let cargo_miembro = clienteMiembro.cargo_miembro !== null ? clienteMiembro.cargo_miembro : "";

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

/* Cargar cliente miembro */
function verParientes(fccId, contadorCamposPariente, clientePariente) {
    let nombre_pariente = clientePariente.nombre_pariente !== null ? clientePariente.nombre_pariente : "";
    let parentesco = clientePariente.parentesco !== null ? clientePariente.parentesco : "";

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

/* Cargar cliente miembro */
function verSocios(fccId, contadorCamposSocio, clienteSocio) {
    let nombre_socio = clienteSocio.nombre_socio !== null ? clienteSocio.nombre_socio : "";
    let porcentaje_participacion_socio = clienteSocio.porcentaje_participacion_socio !== null ? clienteSocio.porcentaje_participacion_socio : "";

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




