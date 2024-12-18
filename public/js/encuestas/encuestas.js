$(document).ready(function() {
    var table;
    var codEvaluarGlobal;
    var relacionGlobal; 
    // Inicializa la tabla y filtros
    function initializeTable() {
        // Verificar si DataTable ya está inicializado
        if ($.fn.DataTable.isDataTable('#encuestas-table')) {
            // Destruir la instancia existente
            $('#encuestas-table').DataTable().destroy();
        }
        const totalColumns = $('#encuestas-table thead th').length;
    
        // Inicializar DataTable de nuevo
        table = $('#encuestas-table').DataTable({
            responsive: {
                details: {
                    type: 'column',
                }
            },
            autoWidth: false, 
            lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
            dom: '<"top"fl>rt<"bottom"ip><"clear">',
            columnDefs: [
                {
                    targets: [1, 5, totalColumns - 1],  // Columnas prioritarias
                    responsivePriority: 1  // Se mantendrán visibles en pantallas grandes
                },
                {
                    targets: [2, 3, 4],  // Columnas de baja prioridad
                    responsivePriority: 100  // Se ocultarán primero en pantallas pequeñas
                }
            ],
            language: {
                lengthMenu: "Mostrar _MENU_ filas",
                search: "Buscar:",
                zeroRecords: "No se encontraron resultados",
                info: "Mostrando _START_ a _END_ de _TOTAL_ filas",
                infoEmpty: "Mostrando 0 a 0 de 0 filas",
                infoFiltered: "(filtrado de _MAX_ filas totales)",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        });

          // Forzar el ajuste de columnas al cargar
        setTimeout(() => {
            table.columns.adjust().responsive.recalc();
        }, 100);

        // Ajustes de tamaño al redimensionar
        $(window).on('resize', function() {
            table.columns.adjust().responsive.recalc();
        });
    
        // Agregar clases adicionales para estilo si es necesario
        $('#encuestas-table_filter input').addClass('form-control form-control-sm');
        $('#encuestas-table_filter label').css('gap', '10px');
        $('#encuestas-table_length').hide();
    }

    $(window).on('resize', function() {
        if ($.fn.DataTable.isDataTable('#encuestas-table')) {
            const table = $('#encuestas-table').DataTable();
            
            const newWidth = $(window).width();
            
            // Ejemplo: Oculta las columnas 2 y 3 en pantallas pequeñas
            if (newWidth < 600) {
                table.columns([2, 3]).visible(false);
            } else {
                table.columns([2, 3]).visible(true);
            }
            
            table.columns.adjust().responsive.recalc();
        }
    });



    //Carga de datos para la tabla encuestas
    function loadData() {
        $.ajax({
            url: '/tabla-encuestas',
            method: 'GET',
            success: function(response) {
                var thead = '<tr>' +
                    '<th>#</th>' +           
                    // '<th>Codigo</th>' +
                    '<th>Nombre</th>' +
                    '<th>Tipo</th>' +
                    '<th>Cargo</th>' +
                    // '<th>Area</th>' +
                    '<th>Evaluada</th>' +
                    '<th>Evaluar</th>' +
                    '</tr>';
    
                var tbody = '';
    
                if (response.data && Array.isArray(response.data)) {
                    $.each(response.data, function(index, item) {
                        // Determina el tipo de relación basado en el valor de `Relacion`
                        var relacion = Number(item.Relacion);
                        var tipo = '';
                        switch (relacion) {
                            case 1:
                                tipo = 'Jefe';
                                break;
                            case 2:
                                tipo = 'Su igual';
                                break;
                            case 3:
                                tipo = 'Sub alterno';
                                break;
                            default:
                                tipo = 'Sub alterno lider';
                                break;
                        }

                        var buttonDisabled = item.Evaluada == 1 ? 'disabled' : '';
    
                        // Construye una fila para cada elemento en los datos
                        tbody += '<tr">' +
                            '<td>' + (index + 1) + '</td>' + 
                            //'<td>' + (item.CodEmpleado || '') + '</td>' + 
                            '<td>' + (item.Nombre || '') + '</td>' + 
                            '<td>' + tipo + '</td>' +
                            '<td>' + (item.Cargo || '') + '</td>' + 
                            //'<td>' + (item.Area || '') + '</td>' + 
                            '<td><input type="checkbox" class="form-check-input custom-checkbox ms-2" disabled ' + (item.Evaluada == 1 ? 'checked' : '') + '></td>' + 
                            '<td>' +
                                '<button class="btn btn-primary hacer-encuesta-btn" type="button" id="hacerEncuestaButton' + index + '" data-nombre="' + item.Nombre + '" data-cod-evaluar="' + item.CodEmpleado + '" data-relacion="' + relacion + '" ' + buttonDisabled + ' >'+
                                //'<button class="btn btn-primary hacer-encuesta-btn" type="button" id="hacerEncuestaButton' + index + '" data-nombre="' + item.Nombre + '" data-cod-evaluar="' + item.CodEmpleado + '" data-relacion="' + relacion + '" >'+
                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24" height="24"color="#000000" fill="none" class="icon">'+
                            '<path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM325.8 139.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-21.4 21.4-71-71 21.4-21.4c15.6-15.6 40.9-15.6 56.6 0zM119.9 289L225.1 183.8l71 71L190.9 359.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"'+
                            'stroke="currentColor" stroke-width="27"/></button>' +
                            '</td>' +
                            '</tr>';
                    });
                    
                    $('#encuestas-table thead').html(thead);
                    $('#encuestas-table tbody').html(tbody);
    
                    if ($.fn.DataTable.isDataTable('#encuestas-table')) {
                        table.clear().rows.add($('#encuestas-table tbody tr')).draw();
                    } else {
                        initializeTable();
                    }
    
                    // Rellena el filtro de cargo con opciones únicas
                    table.column(4).data().unique().sort().each(function(d, j) {
                        $('#cargo-filter').append('<option value="' + d + '">' + d + '</option>');
                    });
                    
                } else {
                    tbody = '<tr><td colspan="8">No se encontraron datos</td></tr>';

                    $('#encuestas-table thead').html(thead);
                    $('#encuestas-table tbody').html(tbody);

                    if ($.fn.DataTable.isDataTable('#encuestas-table')) {
                        table.clear().rows.add($('#encuestas-table tbody tr')).draw();
                    } else {
                        initializeTable();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); 
                mostrarToast("Ocurrió un error al obtener los datos.", "error")
            }
        });
    }
    
    loadData();

    $(document).on('click', '.hacer-encuesta-btn', function(event) {
        event.preventDefault();     
    
        codEvaluarGlobal = $(this).data('cod-evaluar');
        relacionGlobal = $(this).data('relacion');
        var nombreEvaluado = $(this).data('nombre');
    
        var relacion = relacionGlobal; 
        var tipo = (relacion == 1) ? 1 : 2;
    
        // Llamada AJAX para obtener las preguntas filtradas por tipo
        $.ajax({
            url: '/cargar-preguntas',
            method: 'GET',
            data: { tipo: tipo },
            success: function(response) {
                var preguntas = response.data;
                var escalas = response.escalas;
    
                // Agrupar preguntas por su 'Numero'
                var agrupadas = {};
                preguntas.forEach(function(pregunta) {
                    var numero = pregunta.Numero;
                    if (!agrupadas[numero]) {
                        agrupadas[numero] = [];
                    }
                    agrupadas[numero].push(pregunta);
                });
    
                var tabs = '';
                var tabContent = '';
    
                Object.keys(agrupadas).forEach(function(numero, index) {
                    var competenciaNombre = agrupadas[numero][0].Competencia;
                    var activeClass = index === 0 ? 'active' : '';
    
                    // Crea las pestañas
                    tabs += '<li class="nav-item" role="presentation">' +
                        '<a class="nav-link ' + activeClass + '" id="tab-' + numero + '" data-bs-toggle="tab" href="#content-' + numero + '" role="tab" aria-controls="content-' + numero + '" aria-selected="' + (index === 0 ? 'true' : 'false') + '">' + competenciaNombre + '</a>' +
                        '</li>';
                
                    // Crea el contenido de pestañas
                    tabContent += '<div class="tab-pane fade ' + (activeClass ? 'show active' : '') + '" id="content-' + numero + '" role="tabpanel" aria-labelledby="tab-' + numero + '">';
    
                    // Itera sobre las preguntas agrupadas por 'Numero' y genera el contenido
                    agrupadas[numero].sort(function(a, b) {
                        return a.Posicion - b.Posicion;
                    }).forEach(function(pregunta) {
                        tabContent += '<br> <div class="form-check mb-4">' +
                            '<label class="form-label d-block" for="pregunta-' + pregunta.IdComportamiento + '">' + pregunta.Nombre + '</label> <br>'  + 
                            '<div class="radio-button-container">';
    
                        escalas.forEach(function(escala) {
                            tabContent += '<div class="radio-button-wrapper">' + 
                                        '<input class="form-check-input" ' +
                                        'type="radio" ' +
                                        'name="pregunta-' + pregunta.Numero + '-' + pregunta.IdComportamiento + '" ' +
                                        'id="pregunta-' + pregunta.IdComportamiento + '-' + escala.IdEscala + '" ' +
                                        'value="' + escala.IdEscala + '">' +
                                        '<label class="form-check-label" for="pregunta-' + pregunta.IdComportamiento + '-' + escala.IdEscala + '">' + escala.Nombre + '</label>' +
                                        '</div>';
                        });
    
                        tabContent += '</div></div>';
                    });
    
                    tabContent += '</div>';
                });
    
                // Renderiza las pestañas y el contenido
                $('#Seccion').html(tabs);
                $('#ContenidoSeccion').html(tabContent);
                $('#hacerEncuestaModalLabel').next('h4').text(nombreEvaluado);
                var leyendas = escalas.map(function(escala) {
                    return '<p>"' + escala.Nombre + '" = "' + escala.nom + '"</p>';
                }).join('');
    
                // Insertar todas las leyendas en el contenido del modal
                $('#ContenidoSeccion').prepend(leyendas);
    
                $('#hacerEncuestaModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                mostrarToast("Ocurrió un error al cargar las preguntas.", "error");
            }
        });
    });
    

    $(document).on('click', '.hacer-encuesta-btn', function(event) {
        event.preventDefault();
        $('#hacerEncuestaModal').modal('show');
    });

    $(document).on('keydown', function(event) {
        if (event.key === "Escape") {
            $('#hacerEncuestaModal').modal('hide');
        }
    });

    $(document).on('click', function(event) {
        if ($(event.target).hasClass('modal')) {
            $('#hacerEncuestaModal').modal('hide');
        }
    });

    $(document).on('keydown', function(event) {
        if (event.key === "Escape") {
            $('#obsModal').modal('hide');
        }
    });

    $(document).on('click', function(event) {
        if ($(event.target).hasClass('modal')) {
            $('#obsModal').modal('hide');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        fetch('/user-data')
            .then(response => response.json())
            .then(data => {
                user = data.usuario;
                id = data.codigo;
                doSomethingWithUserData();
            })
            .catch(error => console.error('Error:', error));
    });
    
    
    // Guardar encuesta
    $('#btnGuardar').on('click', function() {
        var encuestas = [];
        var date = new Date();

        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); 
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        const milliseconds = String(date.getMilliseconds()).padStart(3, '0');
        
        var fechaRegistro = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}.${milliseconds}`;

        var allAnswered = true;

        if (!codEvaluarGlobal) {
            mostrarToast("Por favor, seleccione un empleado antes de guardar la encuesta.", "error");
            return;
        }

        $('#ContenidoSeccion .tab-pane').each(function() {
            var seccionNumero = $(this).attr('id').replace('content-', '');
    
            $(this).find('.form-check-input[type="radio"]').each(function() {
                var nombre = $(this).attr('name');
                if ($('input[name="' + nombre + '"]:checked').length === 0) {
                    allAnswered = false;
                    return false;
                }
            });
    
            if (!allAnswered) {
                mostrarToast("Por favor, responda todas las preguntas antes de guardar la encuesta.", "error");
                return false; 
            }
        });
    
        if (!allAnswered) {
            return; 
        }

        $.ajax({
            url: '/user-data',
            method: 'GET',
            success: function(userData) {
                var user = userData.usuario;
                var idUser = userData.codigo;
                $('#ContenidoSeccion .tab-pane').each(function() {
                    var seccionNumero = $(this).attr('id').replace('content-', '');
        
                    $(this).find('.form-check-input[type="radio"]:checked').each(function() {
                        var input = $(this);
                        var nombre = input.attr('name');
            
                        if (nombre) {
                            var partes = nombre.split('-');
            
                            if (partes.length >= 3) {
                                var preguntaNumero = partes[1];
                                var preguntaIdComportamiento = partes[2];
                                var escalaId = input.val();
            
                                var idCompetencia = (1 === 1) ? preguntaNumero : Number(preguntaNumero) + Number(seccionNumero);
            
                                var relacion = relacionGlobal;
                                var tipo = relacion === 1 ? 1 : 2;
            
                                encuestas.push({
                                    CodEvaluador: parseInt(idUser, 10),
                                    Tipo: tipo,
                                    Numero: parseInt(seccionNumero, 10),
                                    CodEvaluar: parseInt(codEvaluarGlobal, 10),
                                    IdCompetencia: parseInt (idCompetencia, 10),
                                    IdComportamiento: parseInt(preguntaIdComportamiento, 10),
                                    IdEscala: parseInt(escalaId, 10),
                                    Relacion: parseInt(relacionGlobal, 10),
                                    FechaReg: fechaRegistro,
                                    usuarioReg: user
                                });
            
                            } else {
                                console.log('Error: Nombre del Input no se dividió correctamente:', nombre);
                            }
                        } else {
                            console.log('Error: Nombre del Input es indefinido o vacío');
                        }
                    });
                });
    
                console.log('Encuestas:', encuestas);
    
                if (encuestas.length > 0) {
                    $.ajax({
                        url: '/guardar-encuesta',
                        method: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({ encuestas: encuestas }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            mostrarToast("Encuesta guardada con éxito.", "success");
                            $('#hacerEncuestaModal').modal('hide');
                            $('#obsModal').modal('show');             
                            $('#btnGuardarObservaciones').data('codEvaluador', idUser);
                            $('#btnGuardarObservaciones').data('codEvaluar', codEvaluarGlobal);
                            $('#btnGuardarObservaciones').data('usuarioReg', user);
                            $('#btnGuardarObservaciones').data('fechaReg', fechaRegistro);
                            loadData();        
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            mostrarToast("Ocurrió un error al guardar la encuesta.", "error");
                        }
                    });
                } else {
                    console.log('No se encontraron encuestas para guardar.');
                }
            }
        }); 
    });

    $('#btnGuardarObservaciones').on('click', function() {
        var observaciones = $('#description').val();
        var curso = $('#course').val();

        if (observaciones === '' && curso === '') {
            $('#obsModal').modal('hide');
            return;
        }

        var codEvaluador = parseInt($(this).data('codEvaluador'),10);
        var codEvaluar = parseInt($(this).data('codEvaluar'), 10);
        var usuarioReg = $(this).data('usuarioReg');
        var fechaReg =   $(this).data('fechaReg');

        console.log('Enviando datos:', {
            CodEvaluador: codEvaluador,
            CodEvaluar: codEvaluar,
            Observacion: observaciones,
            NombreCurso: curso,
            usuarioReg: usuarioReg,
            FechaReg: fechaReg
        });

        $.ajax({
            url: '/guardar-observaciones',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                CodEvaluador: codEvaluador,
                CodEvaluar: codEvaluar,
                Observacion: observaciones,
                NombreCurso: curso,
                usuarioReg: usuarioReg,
                FechaReg: fechaReg
            }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#obsModal').modal('hide');
                mostrarToast("Observaciones y curso guardados con éxito.", "success");
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                mostrarToast("Ocurrió un error al guardar las observaciones y el curso.", "error")
            }
        });
    });
    
});
