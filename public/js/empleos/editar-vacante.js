document.addEventListener("DOMContentLoaded", function () {

    var formulario = document.getElementById('frmEditarVacante');
    var inputs = formulario.querySelectorAll('#nombre, #descripcion, #fecha_vencimiento, #imagen');

    function ocultarFeedbackInvalido() {
        var feedbacks = formulario.querySelectorAll('.invalid-feedback');
        feedbacks.forEach(function (feedback) {
            feedback.style.display = 'none';
        });
    }

    ocultarFeedbackInvalido();

    inputs.forEach(function (input) {
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

    document.getElementById('actualizarVacante').addEventListener('click', function () {
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

    var empresaId = $('#id_empresa_seleccionada').val();
    var tipoContratoId = $('#tipo_contratacion_seleccionada').val();
    var modalidadId = $('#modalidad_seleccionada').val();

    cargarEmpresas('#empresa_vacante_editar', '#id_empresa_editar', true, empresaId);
    cargarTipoContratacion("#contrato_editar", "#id_tipo_contratacion_editar", true, tipoContratoId);
    cargarModalidades("#modalidad_editar", "#id_modalidad_editar", true, modalidadId);
});