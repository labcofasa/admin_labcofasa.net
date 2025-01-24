$(document).ready(function() {

    $(document).on('click', '.btn-devolucion', function() {
        var vendedorId = $(this).data('id');
        var vendedorNombre = $(this).data('nombre');
        var vendedorCargo = $(this).data('cargo');

        $('#idVendedorD').val(vendedorId);
        $('#nombreVendedorD').text(vendedorNombre);
        $('#cargoD').text(vendedorCargo);

        $('#giftcard-select-dev').empty();

        cargarGifts();
        $('#modalDevolucionGiftCard').modal('show');
    });

    function cargarGifts(){
        var vendedorId = $('#idVendedorD').val();
        $('#giftcard-select-dev').append('<option value="">Cargando...</option>');

        $.ajax({
            url:'/movimientos/giftcards',
            method: 'GET',
            data: { idVendedor: vendedorId },
            dataType: 'json',
            success: function(response){
                $('#giftcard-select-dev').empty();
                $('#giftcard-select-dev').append('<option value="">Selecciona la Gift Card a devolver</option>');
                if(response && response.length > 0){
                    response.forEach(function(giftCard){
                        if (giftCard.cantidad > 0){
                            $('#giftcard-select-dev').append(
                                `<option value="${giftCard.idGiftCard}" data-cantidad-D="${giftCard.cantidad}">
                                   $${giftCard.valor} - Disponibles: ${giftCard.cantidad}
                                </option>`
                            );
                        }
                    });
                } else {
                    $('#giftcard-select-dev').append('<option value="">No hay giftcards disponibles</option>');
                }
            },
            error: function(xhr, status, error){
                mostrarToast('Hubo un error al cargar los giftcards.', 'error');
                console.log(error);
                $('#giftcard-select-dev').append('<option value="">Error al cargar giftcards</option>');
            }
        });
    }

    $(document).on('change', '#giftcard-select-dev', function() {
        var cantidadMaxima = $(this).find('option:selected').data('cantidad');
        var cantidadInput = $(this).closest('.giftcard-row-dev').find('.cantidad');
        
        cantidadInput.attr('max', cantidadMaxima);
        cantidadInput.val(1);
    });
    
    $(document).on('input', '.cantidad', function() {
        var cantidadMaxima = parseInt($(this).attr('max'));
        var cantidadIngresada = parseInt($(this).val());
    
        if (isNaN(cantidadIngresada) || cantidadIngresada < 0) {
            $(this).val(1);
        } else if (cantidadIngresada > cantidadMaxima) {
            $(this).val(cantidadMaxima);
        }
    });

    $(document).on('click', '#btnGuardarGiftDev', function () {
        const vendedorId = parseInt($('#idVendedorD').val());
        const giftCardId = parseInt($('#giftcard-select-dev').val());
        const cantidad = parseInt($('.cantidad').val());
        const cantidadDisponible = parseInt($('#giftcard-select-dev option:selected').data('cantidad-d'));
    
        // Validaciones
        if (!vendedorId || !giftCardId) {
            alert('Por favor, selecciona un vendedor y una Gift Card válida.');
            return;
        }
    
        if (isNaN(cantidad) || cantidad < 1) {
            // console.log(cantidad); //debug
            alert('Por favor, ingresa una cantidad válida.');
            return;
        }
    
        if (cantidad > cantidadDisponible) {
            alert('La cantidad supera las Gift Cards disponibles.');
            return;
        }
    
        // Crear el JSON a enviar
        const dataToSend = {
            IdVendedor: vendedorId,
            IdGift: giftCardId,
            Cantidad: cantidad
        };
    
        // console.log(dataToSend); //debug
        
        // Enviar datos por AJAX
        $.ajax({
            url: '/vendedores/devolver',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(dataToSend),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                mostrarToast('Gift cards asignadas correctamente', 'success');
                $('#modalDevolucionGiftCard').modal('hide');
            },
            error: function (xhr, status, error) {
                console.error('Error al devolver gift cards:', error);
                console.log('Response:', xhr.responseText); // Esto imprime la respuesta completa del servidor
                console.log('Status:', status); // Esto imprime el estado
                console.log('XHR Object:', xhr); // Muestra toda la información del objeto XHR
                mostrarToast('Hubo un error al devolver las gift cards.', 'error');
            }
        });
    });
    
    
});
