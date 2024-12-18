$(document).ready(function() {
    $('#vendedores-table').DataTable({
        lengthChange: false,
        processing: true,
        pageLength: 7,
        order: [[0, 'asc']],
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "select": {
                "rows": {
                    "_": "%d filas seleccionadas",
                    "0": "Ninguna fila seleccionada",
                    "1": "1 fila seleccionada"
                }
            }
        },
        ajax: {
            url: '/vendedores',
            type: 'GET',
            dataSrc: '',
        },
        columns: [
            { data: 'Alias' },
            { data: 'Nombre' }, 
            { data: null, render: function(data, type, row) {
                return `
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item btn-asignar" href="#" data-id="${row.idVendedor}" data-nombre="${row.Alias}" data-cargo="${row.Nombre}">Asignar</a></li>
                        <li><a class="dropdown-item btn-liquidar" href="#" data-id="${row.idVendedor}" data-nombre="${row.Alias}" data-cargo="${row.Nombre}">Liquidar</a></li>
                        <li><a class="dropdown-item btn-devolucion" href="#" data-id="${row.idVendedor}" data-nombre="${row.Alias}" data-cargo="${row.Nombre}">Devolución</a></li>
                    </ul>
                </div>
            `;      
                }
            }
            
        ],
        pagingType: "simple_numbers",
        responsive: true,
        columnDefs: [
            {
                targets: [0, 2], // Indica que se oculta la columna con índice 0 (Alias) en pantallas pequeñas
                responsivePriority: 0 // Opcional: ajusta la prioridad para la columna cuando sea responsive
            },
            {
                targets: [1], // La columna con Nombre puede ser visible siempre
                responsivePriority: 100
            },
        ],
         
    });
    
    let giftcardRowIndex = 0;
    
    $(document).on('click', '.btn-asignar', function() {
        var vendedorId = $(this).data('id');
        var vendedorNombre = $(this).data('nombre');
        var vendedorCargo = $(this).data('cargo');

        $('#idVendedor').val(vendedorId);
        $('#nombreVendedor').text(vendedorNombre);
        $('#cargo').text(vendedorCargo);
        $('#modalAgregarGiftCard').modal('show');
        cargarGiftCards(`#giftcard-select-${giftcardRowIndex}`);
    });
    
    $('#modalAgregarGiftCard').on('hide.bs.modal', function () {
        $('#giftcard-rows-container').empty();
        giftcardRowIndex = 0;
    }); 

    $('#modalAgregarGiftCard').on('show.bs.modal', function () {
        if ($('#giftcard-rows-container').children().length === 0) {
            const initialRow = `
                <div class="giftcard-row mb-3" data-index="${giftcardRowIndex}">
                    <label for="giftcard-select-${giftcardRowIndex}" class="form-label">Seleccione Gift Card</label>
                    <select class="form-control giftcard-select" id="giftcard-select-${giftcardRowIndex}" name="idGiftCard[${giftcardRowIndex}]" required>
                        <option value="">Selecciona la Gift Card a asignar</option>
                    </select>
                    <div class="mb-3">
                        <label for="cantidad-${giftcardRowIndex}" class="form-label">Cantidad</label>
                        <input type="number" class="form-control cantidad" name="cantidad[${giftcardRowIndex}]" required>
                        <span class="cantidad-error text-danger" style="display:none;">No hay suficientes giftcards disponibles</span>
                    </div>
                    <div class="mb-3">
                        <label for="correlativo-factura-${giftcardRowIndex}" class="form-label">Correlativo Factura</label>
                        <span class="correlativo-factura"></span>
                    </div>
                </div>
            `;
    
            $('#giftcard-rows-container').append(initialRow);
            
            cargarGiftCards(`#giftcard-select-${giftcardRowIndex}`);
            
            giftcardRowIndex++;
        }
    });

    $('#btnAgregarRow').on('click', function() {
        // Crear un nuevo bloque de fila para la Gift Card
        const newRow = `
            <div class="giftcard-row mb-3" data-index="${giftcardRowIndex}">
                <label for="giftcard-select-${giftcardRowIndex}" class="form-label">Seleccione Gift Card</label>
                <select class="form-control giftcard-select" id="giftcard-select-${giftcardRowIndex}" name="idGiftCard[${giftcardRowIndex}]" required>
                    <option value="">Selecciona la Gift Card a asignar</option>
                </select>
                <div class="mb-3">
                    <label for="cantidad-${giftcardRowIndex}" class="form-label">Cantidad</label>
                    <input type="number" class="form-control cantidad" name="cantidad[${giftcardRowIndex}]" required>
                    <span class="cantidad-error text-danger" style="display:none;">No hay suficientes giftcards disponibles</span>
                </div>
                <div class="mb-3">
                    <label for="correlativo-factura-${giftcardRowIndex}" class="form-label">Correlativo Factura</label>
                    <span class="correlativo-factura"></span>
                    <input type="hidden" class="idFactura" name="idFactura[${giftcardRowIndex}]">
                </div>
                <button type="button" class="btn btn-danger btn-sm btnEliminarFila" style="margin-top: 10px;">Eliminar</button>
            </div>
        `;
        
        // Agregar la nueva fila al contenedor
        $('#giftcard-rows-container').append(newRow);
        
        // Cargar Gift Cards en el nuevo select
        cargarGiftCards(`#giftcard-select-${giftcardRowIndex}`);
        
        giftcardRowIndex++; // Aumentar el índice para la siguiente fila
    });
    
    // Función para cargar las Gift Cards
    function cargarGiftCards(selectId) {
        $.ajax({
            url: "/giftcards/disponibles",
            method: 'GET',
            success: function(response) {
                const $select = $(selectId);
                $select.empty();
                $select.append($('<option>', {
                    value: '',
                    text: 'Selecciona la Gift Card a asignar'
                }));
    
                $.each(response.giftcards, function(index, giftcard) {
                    $select.append($('<option>', {
                        value: giftcard.id,
                        'data-correlativo': giftcard.correlativo,
                        'data-cantidad-total': giftcard.cantidadTotal,
                        'data-valor': giftcard.valor, 
                        text: `ID: ${giftcard.id} - Valor: ${giftcard.valor} - Cantidad Total: ${giftcard.cantidadTotal}`
                    }));
                });
            },
            error: function() {
                mostrarToast('Error al cargar las gift cards', 'error');
            }
        });
    }

    $('#giftcard-rows-container').on('input', '.cantidad', function () {
        const cantidadInput = $(this);
        let cantidadIngresada = parseInt(cantidadInput.val());
        const cantidadMinima = parseInt(cantidadInput.attr('min'));
        const cantidadMaxima = parseInt(cantidadInput.attr('max'));
    
        if (cantidadIngresada > cantidadMaxima) {
            cantidadIngresada = cantidadMaxima;
            cantidadInput.val(cantidadIngresada);
        } else if (cantidadIngresada < cantidadMinima) {
            cantidadIngresada = cantidadMinima;
            cantidadInput.val(cantidadIngresada);
        }
    
        if (!isNaN(cantidadIngresada) && cantidadIngresada > 0) {
            const giftcardRow = cantidadInput.closest('.giftcard-row');
            const selectedOption = giftcardRow.find('.giftcard-select option:selected');
            const idGiftCard = selectedOption.val();
    
            if (idGiftCard) {
                $.ajax({
                    url: `/facturas/correlativo/${idGiftCard}?cantidadSolicitada=${cantidadIngresada}`,
                    method: 'GET',
                    success: function (response) {
                        let totalCantidadDisponible = 0;
                        let facturasSeleccionadas = [];
    
                        if (response.facturas && response.facturas.length > 0) {
                            $.each(response.facturas, function (index, factura) {
                                const cantidadFactura = parseInt(factura.cantidad);
                                totalCantidadDisponible += cantidadFactura;
                                facturasSeleccionadas.push({
                                    idFactura: factura.idFactura,
                                    cantidad: cantidadFactura,
                                    correlativo: factura.correlativo,
                                });
                            });
    
                            let correlativos = response.facturas.map(factura => `${factura.correlativo} (Cantidad: ${factura.cantidad})`).join('<br>');
                            giftcardRow.find('.correlativo-factura').html(correlativos);
    
                            if (totalCantidadDisponible < cantidadIngresada) {
                                mostrarToast('La cantidad solicitada excede la cantidad disponible en las facturas.', 'error');
                                giftcardRow.find('button').prop('disabled', true);
                            } else {
                                giftcardRow.find('button').prop('disabled', false);
                            }
    
                            giftcardRow.data('facturasSeleccionadas', facturasSeleccionadas);
                        } else {
                            mostrarToast('No se encontraron facturas disponibles.', 'error');
                            giftcardRow.find('button').prop('disabled', true);
                        }
                    },
                    error: function () {
                        mostrarToast('Error al cargar los correlativos de las facturas.', 'error');
                        giftcardRow.find('button').prop('disabled', true);
                    }
                });
            } else {
                mostrarToast('Por favor, selecciona una Gift Card.', 'error');
                giftcardRow.find('button').prop('disabled', true);
            }
        } else {
            cantidadInput.val(''); 
            mostrarToast('La cantidad ingresada no es válida.', 'error');
            const giftcardRow = cantidadInput.closest('.giftcard-row');
            giftcardRow.find('button').prop('disabled', true);
        }
    });    
    
    function validarCantidad(giftcardRow, cantidadDisponible) {
        const cantidadInput = giftcardRow.find('.cantidad').val();
        const errorSpan = giftcardRow.find('.cantidad-error');
    
        if (parseInt(cantidadInput) > cantidadDisponible) {
            $('#btnGuardarGift').prop('disabled', true);
            errorSpan.show();
        } else {
            $('#btnGuardarGift').prop('disabled', false);
            errorSpan.hide();
        }
    }

    $('#giftcard-rows-container').on('click', '.btnEliminarFila', function() {
        $(this).closest('.giftcard-row').remove();
    });

    $('#btnGuardarGift').on('click', function() {
        const idVendedor = $('#idVendedor').val(); 
        const idTipoMovimiento = 2;
        const fechaMovimiento = new Date().toISOString();
        const nombreVendedor = $('#nombreVendedor').text();
        const cargoVendedor = $('#cargo').text();
        const movimientos = [];
        let isValid = true;
    
        $('#giftcard-rows-container .giftcard-row').each(function() {
            const idGiftCard = $(this).find('.giftcard-select').val();
            const valorMovimiento = parseFloat($(this).find('.giftcard-select option:selected').data('valor'));
            const facturasSeleccionadas = $(this).data('facturasSeleccionadas') || [];
    
            if (!idGiftCard || isNaN(valorMovimiento)) {
                mostrarToast('Por favor seleccione una giftcard.', 'error');
                isValid = false;
                return false; 
            }
    
            if (facturasSeleccionadas.length === 0) {
                mostrarToast('Por favor ingrese una cantidad valida.','error');
                isValid = false;
                return false;
            }
    
            // Procesar cada factura seleccionada
            facturasSeleccionadas.forEach(factura => {
                const valorMovimientoTotal = valorMovimiento * factura.cantidad;
                movimientos.push({
                    idGiftCard: parseInt(idGiftCard),
                    Correlativo: factura.correlativo,
                    cantidad: factura.cantidad,
                    idFactura: factura.idFactura,
                    valorMovimiento: valorMovimientoTotal.toFixed(2),
                });
            });
        });
    
        if (!isValid || movimientos.length === 0) {
            mostrarToast("Por favor, asegúrate de que todas las gift cards están seleccionadas correctamente y que tienen facturas asociadas.",'error');
            return;
        }
    
        const dataToSend = {
            idVendedor: idVendedor,
            nombreVendedor: nombreVendedor, 
            cargoVendedor: cargoVendedor,
            idTipoMovimiento: idTipoMovimiento,
            fechaMovimiento: fechaMovimiento,
            movimientos: movimientos,
            _token: $('meta[name="csrf-token"]').attr('content')
        };


        $.ajax({
            url: '/vendedores/asignar', 
            method: 'POST',
            data: JSON.stringify(dataToSend),
            contentType: 'application/json',
            success: function(response) {
                mostrarToast('Gift cards asignadas correctamente', 'success');
                $('#modalAgregarGiftCard').modal('hide');
                $(document).trigger('giftCardsAssigned');
            },
            error: function(error) {
                console.error('Error al asignar gift cards:', error);
                mostrarToast('Hubo un error al asignar las gift cards.', 'error');
            }
        });
    });    

    function validarGiftCardSeleccionada(giftcardRow) {
        const selectedOption = giftcardRow.find('.giftcard-select option:selected');
        const idGiftCard = selectedOption.val();
        const cantidadTotal = selectedOption.data('cantidad-total');
        const valorGiftCard = selectedOption.data('valor');

        if (!idGiftCard) {
            mostrarToast('Debe seleccionar una Gift Card.','error');
            return false;
        }

        if (cantidadTotal <= 0) {
            mostrarToast('No hay suficiente cantidad disponible para esta Gift Card.','error');
            
            giftcardRow.find('.giftcard-select').val(''); 
            return false;
        }

        let giftCardUsada = false;

        $('.giftcard-select').each(function() {
            if ($(this).val() == idGiftCard && $(this).closest('.giftcard-row').index() !== giftcardRow.index()) {
                giftCardUsada = true;
            }
        });

        if (giftCardUsada) {
            mostrarToast('Esta Gift Card ya ha sido seleccionada en otra fila.','error');

            giftcardRow.find('.giftcard-select').val('');
            return false;
        }
        return true;
    }

    $('#giftcard-rows-container').on('change', '.giftcard-select', function () {
        const giftcardRow = $(this).closest('.giftcard-row');
        const cantidadMaxima = $(this).find('option:selected').data('cantidad-total') || 0;
        const cantidadInput = giftcardRow.find('.cantidad');
        cantidadInput.val('');
        cantidadInput.attr('max', cantidadMaxima);
        cantidadInput.attr('min', 1);
        giftcardRow.find('.correlativo-factura').text('');
        const validacionExitosa = validarGiftCardSeleccionada(giftcardRow);
        
    });
    
});
