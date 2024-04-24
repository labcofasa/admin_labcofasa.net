document.addEventListener("DOMContentLoaded", function () {
    const apiTipoContratacion = "/tabla-tipo-contratacion";
    let tabla_tipo_contratacion = null;

    var formulario = document.getElementById('frmVacante');
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

    tablaTipoContratacion();


    function tablaTipoContratacion() {
        if (tabla_tipo_contratacion) {
            tabla_tipo_contratacion.destroy();
        }
        $("#tabla-contratacion-container").hide();

        tabla_tipo_contratacion = $("#tabla-tipo-contratacion").DataTable({
            dom:
                "<'botones-filter'<f>>" +
                "<tr>" +
                "<'info-pagination'<i><p>>",
            serverSide: true,
            processing: true,
            responsive: true,
            pagingType: "simple_numbers",
            fixedHeader: true,
            lengthMenu: [
                [10, 25, 50, -1],
                ["10 filas", "25 filas", "50 filas", "Todas las filas"],
            ],
            language: {
                url: "/json/es.json",
                searchPlaceholder: "Buscar",
                emptyTable: "No hay tipos de contratación registrados",
            },
            ajax: {
                url: apiTipoContratacion,
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
            // columnDefs: [
            //     {
            //         targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 14, 15, 16, 17],
            //         searchable: false,
            //         orderable: false,
            //     },
            //     {
            //         targets: [
            //             0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16,
            //             17,
            //         ],
            //         className: "nowrap",
            //     },
            //     {
            //         targets: [12],
            //         className: "wrap",
            //     },
            //     {
            //         targets: [
            //             1, 2, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
            //         ],
            //         searchable: true,
            //     },
            //     {
            //         targets: [13],
            //         orderable: true,
            //     },
            //     { responsivePriority: 1, targets: 1 },
            //     { responsivePriority: 2, targets: 2 },
            //     { responsivePriority: 3, targets: 17 },
            // ],
            drawCallback: function (settings) {
                $("#placeholder").hide();
                $("#tabla-contratacion-container").show();
            },
            columns: [
                { data: "contador", title: "#" },
                { data: "nombre_tipo", title: "Tipo de contratación" },
            ],
            // order: [[13, "desc"]],

            initComplete: function () {
                let searchTimeout;
                const inputTipoContratacion = $("#tabla-tipo-contratacion_filter input");
                const btnSecondaryElements = $(
                    ".dt-buttons .btn.btn-secondary"
                );

                btnSecondaryElements.removeClass("btn-secondary");

                inputTipoContratacion.attr("id", "buscar-tipo-contratacion");
                inputTipoContratacion.attr("name", "buscar_tipo_contratacion");
                inputTipoContratacion.attr("autocomplete", "off");

                const iconSvg =
                    "<svg class='search-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' color='#000000' fill='none'>" +
                    "<path d='M17.5 17.5L22 22' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />" +
                    "<path d='M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z' stroke='currentColor' stroke-width='2' stroke-linejoin='round' />" +
                    "</svg>";

                inputTipoContratacion.before(iconSvg);

                inputTipoContratacion.off().on("input", function (e) {
                    clearTimeout(searchTimeout);
                    const inputValue = this.value;
                    searchTimeout = setTimeout(function () {
                        tabla_tipo_contratacion.search(inputValue).draw();
                    }, 500);
                });

                inputTipoContratacion.on("keydown", function (e) {
                    if (e.key === "Escape") {
                        this.value = "";
                        tabla_tipo_contratacion.search("").draw();
                        e.preventDefault();
                    }
                });
            },
        });

        tabla_tipo_contratacion.on("draw.dt", function () {
            $("#tabla-tipo-contratacion_filter label")
                .addClass("label-search")
                .contents()
                .filter(function () {
                    return this.nodeType === 3;
                })
                .remove();
            $("#tabla-contratacion-container").show();
        });
    }

    $.fn.DataTable.ext.pager.numbers_length = 5;

    $('#guardarTipoBtn').click(function (e) {
        e.preventDefault();

        var formData = $('#contratacionForm').serialize();

        $.ajax({
            type: 'POST',
            url: $('#contratacionForm').attr('action'),
            data: formData,
            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});