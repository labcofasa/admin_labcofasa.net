document.addEventListener("DOMContentLoaded", function () {
    const body = document.querySelector("body");
    const darkIcon = document.querySelector(".dropdown-icon.dark");
    const lightIcon = document.querySelector(".dropdown-icon.light");
    const toggleSwitchNav2 = document.getElementById("toggle-switch-nav2");
    const arrows = document.querySelectorAll(".arrow");
    const modeTextToggle = toggleSwitchNav2.querySelector(".mode-text");
    const storedMode = localStorage.getItem("mode");

    function toggleMode() {
        const isDarkMode = !body.classList.contains("dark");
        body.classList.toggle("dark", isDarkMode);

        darkIcon.style.display = isDarkMode ? "block" : "none";
        lightIcon.style.display = isDarkMode ? "none" : "block";

        localStorage.setItem("mode", isDarkMode ? "dark" : "light");
    }

    toggleSwitchNav2.addEventListener("click", toggleMode);

    body.classList.toggle("dark", storedMode === "dark");

    darkIcon.style.display = storedMode === "dark" ? "block" : "none";
    lightIcon.style.display = storedMode === "dark" ? "none" : "block";

    body.style.display = "block";

    arrows.forEach((arrow) => {
        arrow.addEventListener("click", (e) => {
            const liParent = e.target.closest("li");

            if (liParent) {
                liParent.classList.toggle("showMenu");
            }
        });
    });

    habilitarTooltips();

    const toastLiveExample = document.getElementById("notificacionToast");
    if (toastLiveExample) {
        const toastBootstrap = new bootstrap.Toast(toastLiveExample);
        toastBootstrap.show();
    }
});

function initializeDropzone(
    dropZoneElementId,
    inputElementId,
    eliminarImagenBtnId
) {
    const dropZoneElement = document.getElementById(dropZoneElementId);
    const inputElement = document.getElementById(inputElementId);
    const eliminarImagenBtn = document.getElementById(eliminarImagenBtnId);

    inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
            updateDropzoneFileList(dropZoneElement, inputElement.files[0]);
            mostrarEliminarImagenBtn();
        }
    });

    eliminarImagenBtn.addEventListener("click", () => {
        eliminarImagen();
        ocultarEliminarImagenBtn();
        ocultarImagenSeleccionada();
    });

    dropZoneElement.addEventListener("dragenter", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("dropzone--over");
    });

    dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("dropzone--over");
    });

    dropZoneElement.addEventListener("dragleave", (e) => {
        e.preventDefault();
        dropZoneElement.classList.remove("dropzone--over");
    });

    dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();

        dropZoneElement.classList.remove("dropzone--over");

        if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            inputElement.dispatchEvent(new Event("change"));
            updateDropzoneFileList(dropZoneElement, e.dataTransfer.files[0]);
            mostrarEliminarImagenBtn();
        }
    });

    function updateDropzoneFileList(dropzoneElement, file) {
        let dropzoneFileMessage = dropzoneElement.querySelector(".message");

        dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
        `;
    }

    function mostrarEliminarImagenBtn() {
        eliminarImagenBtn.style.display = "inline-block";
    }

    function ocultarEliminarImagenBtn() {
        eliminarImagenBtn.style.display = "none";
    }

    function eliminarImagen() {
        let dropzoneFileMessage = dropZoneElement.querySelector(".message");
        dropzoneFileMessage.innerHTML = "Ningún archivo seleccionado.";
        inputElement.value = "";
    }

    inputElement.addEventListener("change", function () {
        mostrarImagenSeleccionada(this);
    });
}

function mostrarImagenSeleccionada(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(".imagen-seleccionada").attr("src", e.target.result).show();
            $(".archivo").hide();
            $(".caption").hide();
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function ocultarImagenSeleccionada() {
    $(".imagen-seleccionada").attr("src", "").hide();
    $(".archivo").show();
    $(".caption").show();
}

function habilitarTooltips() {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = Array.from(tooltipTriggerList).map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
}

function mostrarToast(mensaje, tipo) {
    const toast = document.getElementById("notificacion");

    toast.querySelector(".toast-body").textContent = mensaje;

    toast.classList.remove("toast-success", "toast-error", "bg-danger");

    if (tipo === "success") {
        toast.classList.add("toast-success");
    } else if (tipo === "error") {
        toast.classList.add("toast-error", "bg-danger");
    }

    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
}

var style = document.createElement("style");
style.setAttribute("id", "multiselect_dropdown_styles");
document.head.appendChild(style);

function MultiselectDropdown(options) {
    var config = {
        search: true,
        height: "15rem",
        placeholder: "Haz clic para seleccionar",
        txtSelected: "Seleccionados",
        txtAll: "Seleccionar todos",
        txtRemove: "Eliminar",
        txtSearch: "Buscar",
        ...options,
    };

    function newEl(tag, attrs) {
        var e = document.createElement(tag);
        if (attrs !== undefined)
            Object.keys(attrs).forEach((k) => {
                if (k === "class") {
                    Array.isArray(attrs[k])
                        ? attrs[k].forEach((o) =>
                            o !== "" ? e.classList.add(o) : 0
                        )
                        : attrs[k] !== ""
                            ? e.classList.add(attrs[k])
                            : 0;
                } else if (k === "style") {
                    Object.keys(attrs[k]).forEach((ks) => {
                        e.style[ks] = attrs[k][ks];
                    });
                } else if (k === "text") {
                    attrs[k] === ""
                        ? (e.innerHTML = "&nbsp;")
                        : (e.innerText = attrs[k]);
                } else e[k] = attrs[k];
            });
        return e;
    }

    document.querySelectorAll("select[multiple]").forEach((el, k) => {
        if (!el.parentNode.querySelector(".multiselect-dropdown")) {
            var div = newEl("div", {
                class: "multiselect-dropdown",
                style: {
                    width: config.style?.width ?? el.clientWidth + "px",
                    padding: config.style?.padding ?? "",
                },
            });
            el.style.display = "none";
            el.parentNode.insertBefore(div, el.nextSibling);
            var listWrap = newEl("div", {
                class: "multiselect-dropdown-list-wrapper",
            });
            var list = newEl("div", {
                class: "multiselect-dropdown-list",
                style: { height: config.height },
            });
            var search = newEl("input", {
                class: ["multiselect-dropdown-search"].concat([
                    config.searchInput?.class ?? "form-control",
                ]),
                style: {
                    width: "100%",
                    display:
                        el.attributes["multiselect-search"]?.value === "true"
                            ? "block"
                            : "none",
                },
                placeholder: config.txtSearch,
            });
            listWrap.appendChild(search);
            div.appendChild(listWrap);
            listWrap.appendChild(list);

            el.loadOptions = () => {
                list.innerHTML = "";

                if (el.attributes["multiselect-select-all"]?.value == "true") {
                    var op = newEl("div", {
                        class: "multiselect-dropdown-all-selector",
                    });
                    var ic = newEl("input", { type: "checkbox" });
                    op.appendChild(ic);
                    op.appendChild(newEl("label", { text: config.txtAll }));

                    op.addEventListener("click", () => {
                        op.classList.toggle("checked");
                        op.querySelector("input").checked =
                            !op.querySelector("input").checked;

                        var ch = op.querySelector("input").checked;
                        list.querySelectorAll(
                            ":scope > div:not(.multiselect-dropdown-all-selector)"
                        ).forEach((i) => {
                            if (i.style.display !== "none") {
                                i.querySelector("input").checked = ch;
                                i.optEl.selected = ch;
                            }
                        });

                        el.dispatchEvent(new Event("change"));
                    });
                    ic.addEventListener("click", (ev) => {
                        ic.checked = !ic.checked;
                    });
                    el.addEventListener("change", (ev) => {
                        let itms = Array.from(
                            list.querySelectorAll(
                                ":scope > div:not(.multiselect-dropdown-all-selector)"
                            )
                        ).filter((e) => e.style.display !== "none");
                        let existsNotSelected = itms.find(
                            (i) => !i.querySelector("input").checked
                        );
                        if (ic.checked && existsNotSelected) ic.checked = false;
                        else if (
                            ic.checked == false &&
                            existsNotSelected === undefined
                        )
                            ic.checked = true;
                    });

                    list.appendChild(op);
                }

                Array.from(el.options).map((o) => {
                    var op = newEl("div", {
                        class: o.selected ? "checked" : "",
                        optEl: o,
                    });
                    var ic = newEl("input", {
                        type: "checkbox",
                        checked: o.selected,
                    });
                    op.appendChild(ic);
                    op.appendChild(newEl("label", { text: o.text }));

                    op.addEventListener("click", () => {
                        op.classList.toggle("checked");
                        op.querySelector("input").checked =
                            !op.querySelector("input").checked;
                        op.optEl.selected = !!!op.optEl.selected;
                        el.dispatchEvent(new Event("change"));
                    });
                    ic.addEventListener("click", (ev) => {
                        ic.checked = !ic.checked;
                    });
                    o.listitemEl = op;
                    list.appendChild(op);
                });
                div.listEl = listWrap;

                div.refresh = () => {
                    div.querySelectorAll(
                        "span.optext, span.placeholder"
                    ).forEach((t) => div.removeChild(t));
                    var sels = Array.from(el.selectedOptions);
                    if (
                        sels.length >
                        (el.attributes["multiselect-max-items"]?.value ?? 5)
                    ) {
                        div.appendChild(
                            newEl("span", {
                                class: ["optext", "maxselected"],
                                text: sels.length + " " + config.txtSelected,
                            })
                        );
                    } else {
                        sels.map((x) => {
                            var c = newEl("span", {
                                class: "optext",
                                text: x.text,
                                srcOption: x,
                            });
                            if (
                                el.attributes["multiselect-hide-x"]?.value !==
                                "true"
                            )
                                c.appendChild(
                                    newEl("span", {
                                        class: "optdel",
                                        text: "🗙",
                                        title: config.txtRemove,
                                        onclick: (ev) => {
                                            c.srcOption.listitemEl.dispatchEvent(
                                                new Event("click")
                                            );
                                            div.refresh();
                                            ev.stopPropagation();
                                        },
                                    })
                                );

                            div.appendChild(c);
                        });
                    }
                    if (0 == el.selectedOptions.length)
                        div.appendChild(
                            newEl("span", {
                                class: "placeholder",
                                text:
                                    el.attributes["placeholder"]?.value ??
                                    config.placeholder,
                            })
                        );
                };
                div.refresh();
            };
            el.loadOptions();

            search.addEventListener("input", () => {
                list.querySelectorAll(
                    ":scope div:not(.multiselect-dropdown-all-selector)"
                ).forEach((d) => {
                    var txt = d.querySelector("label").innerText.toUpperCase();
                    d.style.display = txt.includes(search.value.toUpperCase())
                        ? "block"
                        : "none";
                });
            });

            div.addEventListener("click", () => {
                div.listEl.style.display = "block";
                search.focus();
                search.select();
            });

            document.addEventListener("click", function (event) {
                if (!div.contains(event.target)) {
                    listWrap.style.display = "none";
                    div.refresh();
                }
            });
        }
    });
}

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

                            suggestionsContainer.appendChild(suggestionItem);
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

function cargarTipoContratacion(
    tipoContratacionSelectId,
    idTipoContratacionInputId,
    editar,
    tipoContratacionActual
) {
    $.ajax({
        url: "/obtener-tipo-contratacion",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const tipoContratacionSelect = $(tipoContratacionSelectId);
            tipoContratacionSelect.empty();
            tipoContratacionSelect.append(
                $("<option>", {
                    value: "",
                    text: "Seleccione el tipo",
                })
            );

            $.each(data, function (key, value) {
                tipoContratacionSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (editar && tipoContratacionActual) {
                tipoContratacionSelect.val(tipoContratacionActual);
            }

            $(idTipoContratacionInputId).val(tipoContratacionSelect.val());
        },
        error: function (error) {
            console.log("Error al obtener los tipos de contratación");
        },
    });

    $(tipoContratacionSelectId).on("change", function () {
        var selectTipoContratacionId = $(this).val();
        $(idTipoContratacionInputId).val(selectTipoContratacionId);
    });
}

function cargarModalidades(
    modalidadSelectId,
    idModalidadInputId,
    editar,
    modalidadActual
) {
    $.ajax({
        url: "/obtener-modalidad",
        type: "GET",
        dataType: "json",
        success: function (data) {
            const modalidadSelect = $(modalidadSelectId);
            modalidadSelect.empty();
            modalidadSelect.append(
                $("<option>", {
                    value: "",
                    text: "Seleccione la modalidad",
                })
            );

            $.each(data, function (key, value) {
                modalidadSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });

            if (editar && modalidadActual) {
                modalidadSelect.val(modalidadActual);
            }

            $(idModalidadInputId).val(modalidadSelect.val());
        },
        error: function (error) {
            console.log("Error al obtener las modalidades");
        },
    });

    $(modalidadSelectId).on("change", function () {
        var selectModalidadId = $(this).val();
        $(idModalidadInputId).val(selectModalidadId);
    });
}

// Funciones para imprimir

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
