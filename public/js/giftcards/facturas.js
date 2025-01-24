$(document).ready(function() {
    $.fn.dataTable.ext.type.order['date-dd-mmyyyy-pre'] = function(data) {
        const dateParts = data.split('-');
        return new Date(dateParts[2], dateParts[1] - 1, dateParts[0]).getTime();
    };
    $('#facturas-table').DataTable({
        lengthChange: false, 
        processing: true, 
        pageLength: 7,
        order: [[1, 'desc']],
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
        serverSide: false, 
        ajax: {
            url: '/facturas-tabla', 
            type: 'GET',
            dataSrc: 'data' ,
        },
        columns: [
            { data: 'Correlativo' }, 
            { data: 'Fecha_Compra',
                render: function(data, type, row) {
                    // Convertir la fecha a objeto Date
                    const date = new Date(data);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Mes empieza desde 0
                    const year = date.getFullYear();
                    
                    return `${day}-${month}-${year}`; // Formato "DD-MM-YYYY"
                },
                type: 'date-dd-mmyyyy'
            },
            { data: 'NRC_Proveedor' },
            { data: 'MontoTotal',
                render: function(data, type, row) {
                    return '$' + parseFloat(data).toFixed(2);
                },
                className: 'text-right'
            },
            {
                data: 'idFactura', 
                render: function(data, type, row) {
                    return `
                        <a onclick="verDetalleFactura(${data})" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver" class="btn btn-primary btn-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" color="#000000" class="icon">
                        <path fill="#1a7cc7" d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-288 0c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                        stroke-width="27"/>
                        </svg>
                        </a>
                        <button title="Eliminar" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-danger btn-md" onclick="eliminarFactura(${data})">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" color="#000000" fill="#f42525" class="icon">
                        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"
                        stroke-width="27" />
                        </svg>
                        </button>
                    `;
                }
            }
        ]
    });
});

var facturaIdGlobal;

    function eliminarFactura(idFactura) {
        facturaIdGlobal = idFactura;

        $('#confirmModalLabel').text('Confirmar Eliminación');
        $('#confirmModalBody').text('¿Estás seguro de que deseas eliminar esta factura?');

        $('#confirmModal').modal('show');
    }

    $(document).on('click', '#btnConfirm', function() {
        if (facturaIdGlobal) {
            $.ajax({
                url: '/facturas/' + facturaIdGlobal + '/eliminar',
                type: 'POST', 
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response) {
                    $('#confirmModal').modal('hide');
                    mostrarToast("Factura eliminada correctamente.", "success");
                    location.reload(); 
                },
                error: function(response) {
                    $('#confirmModal').modal('hide');
                    mostrarToast("Ocurrió un error al intentar eliminar la factura.", "error");
                }
            });
        }
    });

    function formatDate(dateString) {
        const date = new Date(dateString);  // Convierte la cadena en un objeto Date
        const day = ("0" + date.getDate()).slice(-2);  // Obtén el día y añade el 0 si es menor de 10
        const month = ("0" + (date.getMonth() + 1)).slice(-2);  // Obtén el mes (es necesario sumar 1)
        const year = date.getFullYear();  // Obtén el año
    
        return `${day}/${month}/${year}`;  // Retorna la fecha en formato dd/mm/yyyy
    }

    function verDetalleFactura(idFactura) {
        $.ajax({
            url: '/facturas/' + idFactura + '/detalle',
            type: 'GET',
            success: function(response) {
                // Configuración específica para facturas
                $('#detalleFacturaModalLabel').text('Detalles de la Factura');
                $('#ComprobanteLabel').html('<strong>Comprobante:</strong>');
                $('#FechaLabel').html('<strong>Fecha de Compra:</strong>');
                $('#modalNRCProveedor').closest('p').show(); // Muestra el NRC
                $('#modalNombreProveedor').closest('p').show(); // Muestra el proveedor
                $('#modalMontoTotal').closest('p').show(); // Muestra el monto total
    
                // Rellenar los datos del modal
                $('#modalCorrelativo').text(response.Correlativo);
                $('#modalFechaCompra').text(formatDate(response.Fecha_Compra));
                $('#modalNRCProveedor').text(response.NRC_Proveedor);
                $('#modalNombreProveedor').text(response.Nombre_Proveedor);
                $('#modalMontoTotal').text(response.MontoTotal);
                $('#modalDetalles').empty();
    
                response.detalles.forEach(function(detalle) {
                    $('#modalDetalles').append(`
                        <tr>
                            <td>${detalle.descripcion}</td>
                            <td>${detalle.cantidad}</td>
                            <td>$${detalle.valorGiftCard}</td>
                        </tr>
                    `);
                });
    
                // Mostrar el modal
                $('#detalleFacturaModal').modal('show');
            },
            error: function() {
                alert('Error al obtener los detalles de la factura.');
            }
        });
    }
    