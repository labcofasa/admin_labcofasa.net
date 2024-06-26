document.addEventListener("DOMContentLoaded", function () {
    var formulario = document.getElementById('frmVacante');
    var campos = formulario.querySelectorAll('#nombre, #descripcion, #requisitos, #beneficios, #imagen, #fecha_vencimiento, #contrato, #modalidad, #pais_vacante, #departamento_vacante, #municipio_vacante, #empresa_vacante');

    function ocultarFeedbackInvalido() {
        var feedbacks = formulario.querySelectorAll('.invalid-feedback');
        feedbacks.forEach(function (feedback) {
            feedback.style.display = 'none';
        });
    }

    ocultarFeedbackInvalido();

    campos.forEach(function (input) {
        input.addEventListener('input', function () {
            var feedback = input.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                if (input.value.trim() === '') {
                    if (!input.validity.valid) {
                        feedback.style.display = 'block';
                    }
                } else {
                    feedback.style.display = 'none';
                }
            }
        });
    });

    document.getElementById('enviarFormulario').addEventListener('click', function () {
        if (formulario.checkValidity()) {
            formulario.classList.add('was-validated');
            formulario.submit();
        } else {
            formulario.classList.add('was-validated');
            var elementosInvalidos = formulario.querySelectorAll(':invalid');
            elementosInvalidos.forEach(function (elemento) {
                var feedback = elemento.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.style.display = 'block';
                }
            });
        }
    });

    initializeDropzone("dropzone", "imagen", "eliminar-imagen");

    cargarPaises(
        "#pais_vacante",
        "#id_pais",
        "#departamento_vacante",
        "#id_departamento",
        "#municipio_vacante",
        "#id_municipio",
        false
    );

    cargarEmpresas(
        "#empresa_vacante",
        "#id_empresa",
        false
    );

    cargarTipoContratacion(
        "#contrato",
        "#tipo_contratacion_id",
        false
    );

    cargarModalidades(
        "#modalidad",
        "#modalidad_id",
        false
    );
});