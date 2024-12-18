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
                                `<option value="${giftCard.idGiftCard}" data-cantidad="${giftCard.cantidad}">
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
    
});
