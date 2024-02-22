$(document).ready(function () {
    const apiGiros = "/tabla-giros";
    let tabla_giros = null;

    function setupGiroSearch(inputId, suggestionsId, hiddenInputId) {
        const input = document.getElementById(inputId);
        const suggestionsContainer = document.getElementById(suggestionsId);
        const hiddenInput = document.getElementById(hiddenInputId);
        let currentSuggestions = new Set();
        let noResultsDisplayed = false;
        let timer;

        input.addEventListener("input", async function () {
            const inputValue = input.value.trim();

            currentSuggestions.clear();

            suggestionsContainer.innerHTML = "";
            noResultsDisplayed = false;

            if (inputValue.length === 0) {
                suggestionsContainer.classList.remove("visible");
                return;
            }

            clearTimeout(timer);

            timer = setTimeout(async function () {
                try {
                    const response = await fetch(
                        `/obtener-giros?query=${inputValue}`
                    );
                    const data = await response.json();

                    if (data && data.giros && data.giros.length > 0) {
                        data.giros.forEach((giro) => {
                            if (!currentSuggestions.has(giro.nombre)) {
                                const suggestionItem =
                                    document.createElement("div");
                                suggestionItem.classList.add("sugerencia-item");
                                suggestionItem.textContent = giro.nombre;

                                suggestionItem.addEventListener(
                                    "click",
                                    function () {
                                        hiddenInput.value = giro.id;
                                        input.value = giro.nombre;

                                        suggestionsContainer.innerHTML = "";
                                        suggestionsContainer.classList.remove(
                                            "visible"
                                        );
                                    }
                                );

                                suggestionsContainer.appendChild(
                                    suggestionItem
                                );
                                currentSuggestions.add(giro.nombre);
                            }
                        });

                        suggestionsContainer.classList.add("visible");
                    } else {
                        if (!noResultsDisplayed) {
                            const noResultsItem = document.createElement("div");
                            noResultsItem.classList.add("sin-resultados");
                            noResultsItem.textContent = "No hay resultados";
                            suggestionsContainer.appendChild(noResultsItem);

                            suggestionsContainer.classList.add("visible");
                            noResultsDisplayed = true;
                        }
                    }
                } catch (error) {
                    console.error("Error obteniendo datos:", error);
                }
            }, 500);
        });

        document.addEventListener("click", function (event) {
            const isInputOrSuggestions =
                input.contains(event.target) ||
                suggestionsContainer.contains(event.target);

            if (!isInputOrSuggestions) {
                suggestionsContainer.classList.remove("visible");
            }
        });

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                suggestionsContainer.classList.remove("visible");
            }
        });
    }

    setupGiroSearch(
        "giro-empresa-editar",
        "giro-sugerencia-editar",
        "id-giro-empresa-editar"
    );
    setupGiroSearch(
        "giro-empresa-filter",
        "giro-sugerencia-filter",
        "id-giro-empresa-filter"
    );

    /* Tabla giros */
    function tablaGiros() {
        if (tabla_giros) {
            tabla_giros.destroy();
        }

        $("#spinnerGiro").show();
        $("#tabla-giros-container").hide();
        tabla_giros = $("#tabla-giros").DataTable({
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
                [8, 25, 50, -1],
                ["8 filas", "25 filas", "50 filas", "Todas las filas"],
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
                    className: "btn btn-lg btn-store giro",
                    action: function (e, dt, node, config) {
                        document.getElementById("crearGirosBtn").click();
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
                            title: "Giros registrados - Laboratorios Cofasa",
                            filename: "Giros registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "csv",
                            text: "CSV",
                            title: "Giros registrados - Laboratorios Cofasa",
                            filename: "Giros registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "excel",
                            text: "Excel",
                            title: "Giros registrados - Laboratorios Cofasa",
                            filename: "Giros registrados - Laboratorios Cofasa",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6],
                            },
                        },
                        {
                            extend: "print",
                            text: "Imprimir",
                            title: "Giros registrados - Laboratorios Cofasa",
                            filename: "Giros registrados - Laboratorios Cofasa",
                            action: function (e, dt, node, config) {
                                girosPrint();
                            },
                        },
                    ],
                },
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay giros registrados",
            },
            ajax: {
                url: apiGiros,
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
                    targets: [0, 2, 3, 4, 5, 6, 7],
                    className: "nowrap",
                },
                {
                    targets: [1],
                    className: "wrap",
                },
                {
                    targets: [1, 2, 3, 4, 5, 6],
                    searchable: true,
                    orderable: true,
                },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 7 },
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
                                ${
                                    userPermissions.some(
                                        (permission) =>
                                            permission.name ===
                                                "admin_giros_editar" ||
                                            permission.name ===
                                                "admin_giros_eliminar"
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
                                                    permission.name ===
                                                    "admin_giros_editar"
                                            )
                                                ? `
                                            <li>
                                                <button class="dropdown-item editar-giro nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                                                    <span class="link">Editar</span>
                                                </button>
                                            </li>
                                            `
                                                : ""
                                        }
                                        ${
                                            userPermissions.some(
                                                (permission) =>
                                                    permission.name ===
                                                    "admin_giros_eliminar"
                                            )
                                                ? `
                                            <li>
                                                <button class="dropdown-item eliminar-giro nav-link" data-id="${row.id}" type="button">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                                                    <span class="link">Eliminar</span>
                                                </button>
                                            </li>`
                                                : ""
                                        }
                                        </ul>
                                    </div>
                                    `
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
                const inputGiro = $("#tabla-giros_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                var userPermissions = JSON.parse(
                    document.getElementById("userPermissions").value
                );

                if (
                    !userPermissions.some(
                        (permission) => permission.name === "admin_giros_crear"
                    )
                ) {
                    $(".giro").addClass("d-none");
                }

                btnSecondaryElements.removeClass("btn-secondary");

                inputGiro.attr("id", "buscar-giros");
                inputGiro.attr("name", "buscar_giros");
                inputGiro.attr("autocomplete", "off");

                const iconSvg =
                    '<svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#888"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>';

                inputGiro.before(iconSvg);

                inputGiro.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_giros.search(inputValue).draw();
                    }, 500);
                });

                inputGiro.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_giros.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_giros.on("draw.dt", function () {
            $("#tabla-giros_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();

            $("#spinnerGiro").hide();
            $("#tabla-giros-container").show();
        });
    }

    /* Mostrar giros */
    $("#giroModal").on("shown.bs.modal", function () {
        tablaGiros();
        tabla_giros.columns.adjust().responsive.recalc();
    });

    $.fn.DataTable.ext.pager.numbers_length = 4;

    /* Registrar giros */
    $("#crearGirosBtn").click(function () {
        $("#crearGiro").modal("show");
    });

    $("#giroForm").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const formData = form.serialize();

        $.ajax({
            url: "/crear-giro",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_giros.ajax.reload();

                $("#crearGiro").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al registrar la actividad económica. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    $("#crearGiro").on("hidden.bs.modal", function () {
        $("#giroForm")[0].reset();
        $("#giroForm").removeClass("was-validated");
    });

    /* Editar giros */
    $("#tabla-giros").on("click", ".editar-giro", function () {
        var id = $(this).data("id");
        var row = tabla_giros.row($(this).parents("tr")).data();

        $("#btn-editar-giro").val(id);
        $("#giro-editar-nombre").val(row.nombre);
        $("#giro-editar-codigo-mh").val(row.codigo_mh);

        $("#editarGiro").modal("show");
    });

    $("#giroEditarForm").submit(function (e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            e.stopPropagation();
            $(this).addClass("was-validated");
            return;
        }

        var formData = $(this).serializeArray();

        $.ajax({
            url: "/actualizar-giro/" + $("#btn-editar-giro").val(),
            method: "PUT",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_giros.ajax.reload();
                $("#editarGiro").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al actualizar la actividad económica: " +
                        jqXHR.statusText,
                    "error"
                );
            },
        });
    });

    $("#editarGiro").on("hidden.bs.modal", function () {
        $("#giroEditarForm")[0].reset();
        $("#giroEditarForm").removeClass("was-validated");
    });

    /* Elimianar giros */
    $("#tabla-giros").on("click", ".eliminar-giro", function () {
        const giroId = $(this).data("id");
        const giroNombre = $(this).closest("tr").find("td:nth-child(2)").text();

        $("#nombre-giro").text(giroNombre);
        $("#btn-eliminar-giro").data("id", giroId);
        $("#eliminarGiro").modal("show");
    });

    $("#btn-eliminar-giro").on("click", function () {
        const giroId = $(this).data("id");
        $.ajax({
            url: "/eliminar-giro/" + giroId,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                tabla_giros.ajax.reload();

                $("#eliminarGiro").modal("hide");

                if (response.success) {
                    mostrarToast(response.message, "success");
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al eliminar el giro. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });

    /* Funciones para imprimir registros */
    function girosPrint() {
        const printWindow = window.open("", "_blank");
        printWindow.document.title = "Giros - Laboratorios Cofasa";
        printWindow.document.write(
            "<html><head><title>Giros - Laboratorios Cofasa</title>"
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
            '<h4 style="text-align: center;">Giros - Laboratorios Cofasa</h4>'
        );
        printWindow.document.write("<table>");

        const headers = $("#tabla-giros thead tr").clone();
        headers.find("th:last").remove();
        printWindow.document.write("<thead>" + headers.html() + "</thead>");

        const tbody = $("<tbody></tbody>");
        $("#tabla-giros tbody tr").each(function () {
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
});
