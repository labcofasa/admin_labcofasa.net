// Cargar tipos de contribuyente
function cargarClasificaciones(
    clasificacionSelectId,
    idClasificacionInputId,
    editar,
    clasificacionActual
) {
    $.ajax({
        url: "/obtener-clasificaciones",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const clasificacionSelect = $(clasificacionSelectId);
            clasificacionSelect.empty();
            clasificacionSelect.append(
                $("<option>", {
                    value: "",
                    text: "Seleccione una clasificación",
                })
            );

            $.each(data, function (key, value) {
                clasificacionSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (editar && clasificacionActual) {
                clasificacionSelect.val(clasificacionActual);
            }

            $(idClasificacionInputId).val(clasificacionSelect.val());
        },
        error: function (error) {
            console.log("Error al obtener las clasificaciones");
        },
    });

    $(clasificacionSelectId).on("change", function () {
        var selectClasificacionId = $(this).val();
        $(idClasificacionInputId).val(selectClasificacionId);
    });
}

// Cargar empresas
function cargarEmpresas(
    empresaSelectId,
    idEmpresaInputId,
    editar,
    empresaActual
) {
    $.ajax({
        url: "/obtener-empresas",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const empresaSelect = $(empresaSelectId);
            empresaSelect.empty();
            empresaSelect.append(
                $("<option>", {
                    value: "",
                    text: "Selecciona una empresa",
                })
            );

            $.each(data, function (key, value) {
                empresaSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (editar && empresaActual) {
                empresaSelect.val(empresaActual);
            }

            $(idEmpresaInputId).val(empresaSelect.val());
        },
        error: function (error) {
            console.log("Error al obtener las empresas");
        },
    });

    $(empresaSelectId).on("change", function () {
        var selectEmpresaId = $(this).val();
        $(idEmpresaInputId).val(selectEmpresaId);
    });
}

/* Cargar paises */
function cargarPaises(
    paisSelectId,
    idPaisInputId,
    deptoSelectId,
    idDeptoInputId,
    municipioSelectId,
    idMunicipioInputId,
    paisActual,
    deptoActual,
    municipioActual
) {
    $.ajax({
        url: "/obtener-paises",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const paisSelect = $(paisSelectId);
            paisSelect.empty();
            paisSelect.append(
                $("<option>", {
                    value: "",
                    text: "Seleccione el país",
                })
            );

            $.each(data, function (key, value) {
                paisSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (paisActual) {
                paisSelect.val(paisActual);
            }

            $(idPaisInputId).val(paisSelect.val());

            if (paisSelect.val()) {
                cargarDepartamentos(
                    deptoSelectId,
                    idDeptoInputId,
                    municipioSelectId,
                    idMunicipioInputId,
                    paisSelect.val(),
                    deptoActual,
                    municipioActual
                );
            } else {
                $(deptoSelectId).empty();
                $(municipioSelectId).empty();
                $(deptoSelectId).append(
                    '<option value="">Seleccione el departamento</option>'
                );
                $(municipioSelectId).append(
                    '<option value="">Seleccione el municipio</option>'
                );
            }
        },
    });

    $(paisSelectId).on("change", function () {
        var selectedPaisId = $(this).val();
        $(idPaisInputId).val(selectedPaisId);

        cargarDepartamentos(
            deptoSelectId,
            idDeptoInputId,
            municipioSelectId,
            idMunicipioInputId,
            selectedPaisId,
            null,
            null
        );
    });

    $(deptoSelectId).on("change", function () {
        var selectedDeptoId = $(this).val();
        $(idDeptoInputId).val(selectedDeptoId);

        cargarMunicipios(
            municipioSelectId,
            idMunicipioInputId,
            selectedDeptoId,
            null
        );
    });

    $(municipioSelectId).on("change", function () {
        var selectedMunicipioId = $(this).val();
        $(idMunicipioInputId).val(selectedMunicipioId);
    });
}

// Cargar actividades económicas
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

/* Cargar departamentos */
function cargarDepartamentos(
    deptoSelectId,
    idDeptoInputId,
    municipioSelectId,
    idMunicipioInputId,
    paisId,
    deptoActual,
    municipioActual
) {
    if (paisId) {
        $.ajax({
            url: "/obtener-departamentos/" + paisId,
            type: "GET",
            dataType: "json",
            success: function (data) {
                const deptoSelect = $(deptoSelectId);
                deptoSelect.empty();
                deptoSelect.append(
                    $("<option>", {
                        value: "",
                        text: "Seleccione el departamento",
                    })
                );

                $.each(data, function (key, value) {
                    deptoSelect.append(
                        '<option value="' + key + '">' + value + "</option>"
                    );
                });

                if (deptoActual) {
                    deptoSelect.val(deptoActual);
                }

                $(idDeptoInputId).val(deptoSelect.val());

                if (deptoSelect.val()) {
                    cargarMunicipios(
                        municipioSelectId,
                        idMunicipioInputId,
                        deptoSelect.val(),
                        municipioActual
                    );
                } else {
                    $(municipioSelectId).empty();
                    $(municipioSelectId).append(
                        '<option value="">Seleccione el municipio</option>'
                    );
                }
            },
        });
    } else {
        $(deptoSelectId).empty();
        $(municipioSelectId).empty();
        $(deptoSelectId).append(
            '<option value="">Seleccione el departamento</option>'
        );
        $(municipioSelectId).append(
            '<option value="">Seleccione el municipio</option>'
        );
    }
}

/* Cargar municipios */
function cargarMunicipios(
    municipioSelectId,
    idMunicipioInputId,
    deptoId,
    municipioActual
) {
    if (deptoId) {
        $.ajax({
            url: "/obtener-municipios/" + deptoId,
            type: "GET",
            dataType: "json",
            success: function (data) {
                const municipioSelect = $(municipioSelectId);
                municipioSelect.empty();
                municipioSelect.append(
                    $("<option>", {
                        value: "",
                        text: "Seleccione el municipio",
                    })
                );

                $.each(data, function (key, value) {
                    municipioSelect.append(
                        '<option value="' + key + '">' + value + "</option>"
                    );
                });

                if (municipioActual) {
                    municipioSelect.val(municipioActual);
                }

                $(idMunicipioInputId).val(municipioSelect.val());
            },
        });
    } else {
        $(municipioSelectId).empty();
        $(municipioSelectId).append(
            '<option value="">Seleccione el municipio</option>'
        );
    }
}

/* Funciones para imprimir paises */
function printPaises() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "Paises - Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>Paises - Laboratorios Cofasa</title>"
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
        '<h4 style="text-align: center;">Paises - Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-paises thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-paises tbody tr").each(function () {
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

/* Función para imprimir departamentos */
function printDepartamentos() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "Departamentos - Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>Departamentos - Laboratorios Cofasa</title>"
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
        '<h4 style="text-align: center;">Departamentos - Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-departamentos thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-departamentos tbody tr").each(function () {
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

/* Función para imprimir municipios */
function printMunicipios() {
    const printWindow = window.open("", "_blank");
    printWindow.document.title = "Municipios - Laboratorios Cofasa";
    printWindow.document.write(
        "<html><head><title>Municipios - Laboratorios Cofasa</title>"
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
        '<h4 style="text-align: center;">Municipios - Laboratorios Cofasa</h4>'
    );
    printWindow.document.write("<table>");

    const headers = $("#tabla-municipios thead tr").clone();
    headers.find("th:last").remove();
    printWindow.document.write("<thead>" + headers.html() + "</thead>");

    const tbody = $("<tbody></tbody>");
    $("#tabla-municipios tbody tr").each(function () {
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
