$(document).ready(function () {
    obtenerUsuario();

    $("#foto").addClass("placeholder-glow");
    $("#imagen-perfil").addClass("placeholder bg-light");

    $("#dropdown-perfil").addClass("placeholder-glow");
    $("#icono-perfil").addClass("placeholder bg-light");

    $("#icono-perfil").on("load", function () {
        $("#dropdown-perfil").removeClass("placeholder-glow");
        $("#icono-perfil").removeClass("placeholder bg-light");
    });

    $("#imagen-perfil").on("load", function () {
        $("#foto").removeClass("placeholder-glow");
        $("#imagen-perfil").removeClass("placeholder bg-light");
    });

    $("#userFormPassword").submit(function (event) {
        event.preventDefault();

        const form = $(this);
        form.addClass("was-validated");

        if (!form[0].checkValidity()) {
            return;
        }

        const formData = new FormData(form[0]);

        $.ajax({
            url: "/actualizar-clave",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    mostrarToast(response.message, "success");
                    form.removeClass("was-validated")
                        .find(":input")
                        .removeClass("is-invalid")
                        .end()[0]
                        .reset();
                } else {
                    mostrarToast(response.error, "error");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                mostrarToast(
                    "Error al actualizar su contraseña. Por favor, intente de nuevo.",
                    "error"
                );
            },
        });
    });
});

function obtenerUsuario() {
    $.ajax({
        url: "/obtener-usuario",
        type: "GET",
        success: function (data) {
            llenarInputs(data);
        },
        error: function (error) {
            console.error("Error al obtener los datos del usuario:", error);
        },
    });
}

function llenarInputs(data) {
    $("#name").val(data.user.name);
    $("#email").val(data.user.email);

    if (data.perfil) {
        $("#nombre").val(data.perfil.nombre);
        $("#apellido").val(data.perfil.apellido);
        $("#telefono").val(data.perfil.telefono);
        $("#direccion1").val(data.perfil.direccion);

        if (data.imagenUrl) {
            $("#imagen-perfil").attr("src", data.imagenUrl);
        } else {
            $("#imagen-perfil").attr("src", "/images/defecto.png");
        }

        if (data.imagenUrl) {
            $("#icono-perfil").attr("src", data.imagenUrl);
        } else {
            $("#icono-perfil").attr("src", "/images/defecto.png");
        }

        if (data.perfil.pais) {
            $("#pais-perfil").empty();
            $("#pais-perfil").append(
                $("<option>", {
                    value: data.perfil.pais.id,
                    text: data.perfil.pais.nombre,
                    selected: true,
                })
            );
            $("#id-pais-perfil").val(data.perfil.pais.id);
        }

        $("#pais-perfil").on("change", function () {
            var selectedCountryId = $(this).val();
            $("#id-pais-perfil").val(selectedCountryId);
        });

        if (data.perfil.departamento) {
            $("#departamento-perfil").empty();
            $("#departamento-perfil").append(
                $("<option>", {
                    value: data.perfil.departamento.id,
                    text: data.perfil.departamento.nombre,
                    selected: true,
                })
            );
            $("#id-departamento-perfil").val(data.perfil.departamento.id);
        }

        $("#departamento-perfil").on("change", function () {
            var selectedDepartmentId = $(this).val();
            $("#id-departamento-perfil").val(selectedDepartmentId);
        });

        if (data.perfil.municipio) {
            $("#municipio").empty();
            $("#municipio").append(
                $("<option>", {
                    value: data.perfil.municipio.id,
                    text: data.perfil.municipio.nombre,
                    selected: true,
                })
            );
            $("#id-municipio-perfil").val(data.perfil.municipio.id);
        }

        $("#municipio-perfil").on("change", function () {
            var selectedMunicipioId = $(this).val();
            $("#id-municipio-perfil").val(selectedMunicipioId);
        });
    }
}
