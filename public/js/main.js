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
});

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

// Cargar empresas */
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
