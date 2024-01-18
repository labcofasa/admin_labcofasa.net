$(document).ready(function () {
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
