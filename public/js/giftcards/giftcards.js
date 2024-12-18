$(document).ready(function() {

    loadGiftCards();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


});

function loadGiftCards(filterValue = '') {
    // Inicializa o destruye si ya existe una instancia de DataTable
    if ($.fn.DataTable.isDataTable('#tabla-Gift')) {
        $('#tabla-Gift').DataTable().destroy();
    }

    // Inicializar la tabla usando DataTables
    $('#tabla-Gift').DataTable({
        "ajax": {
            "url": "/giftcards-tabla", // Ruta para cargar las Gift Cards
            "type": "GET",
            "dataSrc": function (json) {
                // Filtrar los datos en base al valor si se proporciona un filtro
                return json.filter(giftCard => {
                    return giftCard.valor.toString().includes(filterValue);
                });
            },
            "error": function(xhr) {
                console.error(xhr.responseText); // Manejar errores
                mostrarToast("Ocurrió un error al cargar las Gift Cards.", "error");
            }
        },
        "columns": [
            { "data": "valor", "render": function(data) { return '$' + data; } }, // Valor con formato
            { "data": "cantidad" }, // Cantidad
            { "data": "saldo" },     // Saldo
            {
                data: null, // Usamos null para obtener el objeto completo
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-danger btn-sm" onclick="eliminarGiftCard(${row.idGift})">Eliminar</button>
                    `;
                }
            }
        ],
        "pageLength": 5, // Número de filas por página
        "lengthChange": false, // Desactivar el cambio de cantidad de filas
        "searching": false, // Desactivar búsqueda propia de DataTables (para usar filtro propio)
        "autoWidth": false, // Desactivar el ajuste automático del ancho
        "responsive": true, // Habilitar responsive para pantallas pequeñas
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
        }
    });
}

let giftCardIdGlobal;

function eliminarGiftCard(idGift) {
    giftCardIdGlobal = idGift;

    $('#confirmModalLabel').text('Confirmar Eliminación');
    $('#confirmModalBody').text('¿Estás seguro de que deseas eliminar esta GiftCard?');

    $('#confirmModal').modal('show');
}

// Lógica para el botón de confirmar
$('#btnConfirm').click(function() {
    $.ajax({
        url: '/giftcards/' + giftCardIdGlobal + '/eliminar',
        type: 'PUT',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response) {
            mostrarToast("GiftCard eliminada correctamente.", "success");
            loadGiftCards();
            $('#confirmModal').modal('hide');
        },
        error: function(response) {
            mostrarToast("Ocurrió un error al intentar eliminar la GiftCard.", "error");
            $('#confirmModal').modal('hide');
        }
    });
});


$('#filter').on('input', function() {
    var filterValue = $(this).val().toLowerCase();
    loadGiftCards(filterValue); // Llama a la función para recargar con el filtro
});



$('#btnGuardarGift').on('click', function() {

    let valor = $('#valor').val();

    $.ajax({
        url: '/giftcards-add',
        method: 'POST',
        data: {
            valor: valor
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $('#form-agregar-giftcard')[0].reset();
            $('#modalAgregarGiftCard').modal('hide');
            loadGiftCards();
            mostrarToast(response.message || "Gift Card agregada exitosamente.", "success");
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            mostrarToast(response.message || "Hubo un error al agregar la Gift Card.", "error");
        }
    });
});