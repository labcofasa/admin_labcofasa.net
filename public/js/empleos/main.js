document.addEventListener("DOMContentLoaded", function () {
    var formulario = document.getElementById('frmVacante');
    var inputs = formulario.querySelectorAll('input, textarea');

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

    const dropZoneElement = document.getElementById("dropzone");
    const inputElement = document.getElementById("imagen");
    const eliminarImagenBtn = document.getElementById("eliminar-imagen");

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
            inputElement.dispatchEvent(new Event('change'));
            updateDropzoneFileList(dropZoneElement, e.dataTransfer.files[0]);
            mostrarEliminarImagenBtn();
        }
    });

    const updateDropzoneFileList = (dropzoneElement, file) => {
        let dropzoneFileMessage = dropzoneElement.querySelector(".message");

        dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
    };

    const mostrarEliminarImagenBtn = () => {
        eliminarImagenBtn.style.display = "inline-block";
    };

    const ocultarEliminarImagenBtn = () => {
        eliminarImagenBtn.style.display = "none";
    };

    const eliminarImagen = () => {
        let dropzoneFileMessage = dropZoneElement.querySelector(".message");
        dropzoneFileMessage.innerHTML = "Ningún archivo seleccionado.";
        inputElement.value = "";
    };

    $('#imagen').change(function () {
        mostrarImagenSeleccionada(this);
    });
});

function mostrarImagenSeleccionada(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagen-seleccionada').attr('src', e.target.result).show();
            $('#archivo').hide();
            $('#caption').hide();
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function ocultarImagenSeleccionada() {
    $('#imagen-seleccionada').attr('src', '').hide();
    $('#archivo').show();
    $('#caption').show();
}


