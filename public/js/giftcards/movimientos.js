var tablaMovimientos, tablaLiquidacion, tablaDevolucion;
$(document).ready(function() {

    $.fn.dataTable.ext.type.order['date-dd-mmyyyy-pre'] = function(data) {
        const dateParts = data.split('-');
        return new Date(dateParts[2], dateParts[1] - 1, dateParts[0]).getTime();
    };

    tablaMovimientos = $('#tablaMovimientos').DataTable({
        lengthChange: false,
        processing: true,
        pageLength: 7,
        responsive: true,
        order: [[3, 'desc'], [0, 'asc']],
        columnDefs: [
            { targets: [0,5], responsivePriority: 0},
        ],
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
            url: '/movimientos/Agrupados/entrega', // Esto se actualizará cuando llames cargarDatos()
            type: 'GET',
            dataSrc: function (json) {
                
                return json.map(function (vendedor) {
                    
                    let  valorTotal = 0
                    if (vendedor.idTipoMovimiento == 3 ) {
                        valorTotal = vendedor.valorMovimiento;
                    }else {
                        valorTotal = vendedor.movimientos.reduce((total, movimiento) => {
                            return total + parseFloat(movimiento.valorMovimiento || 0);
                        }, 0);
                    } 
                    let tipoMovimiento;
                    switch (parseInt(vendedor.idTipoMovimiento)) {
                        case 2:
                            tipoMovimiento = 'entrega';
                            break;
                        case 3:
                            tipoMovimiento = 'liquidacion';
                            break;
                        case 4:
                            tipoMovimiento = 'devolucion';
                            break;
                        default:
                            tipoMovimiento = 'Desconocido';
                    }
    
                    return {
                        idAgrupacion: vendedor.idAgrupacion,
                        idVendedor: vendedor.idVendedor,
                        nombreVendedor: vendedor.nombreVendedor,
                        cargoVendedor: vendedor.cargoVendedor,
                        tipoMovimiento: tipoMovimiento,
                        idTipoMovimiento: vendedor.idTipoMovimiento,
                        fechaMovimiento: vendedor.fechaMovimiento,
                        codigoCliente: vendedor.codigoCliente,
                        nombreCliente: vendedor.nombreCliente,
                        valorTotal: valorTotal.toFixed(2),
                        movimientos: vendedor.movimientos
                    };
                });
            }
        },    
        columns: [
            { data: 'nombreVendedor' },
            { data: 'cargoVendedor' },
            { data: 'tipoMovimiento' },
            { data: 'fechaMovimiento',
                render: function(data, type, row) {
                    const date = new Date(data);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}-${month}-${year}`;
                },
                type: 'date-dd-mmyyyy'
            },
            { data: 'valorTotal',
                render: function(data, type, row) {
                    return '$' + parseFloat(data).toFixed(2);
                },
                className: 'text-right'
             },
             { data: null, orderable: false, render: function(data, type, row) {
                let tipoMovimiento = row.tipoMovimiento || 'desconocido';
                
                // Crear el botón con el tipo de movimiento dinámicamente
                return `<button class="btn btn-primary btn-pdf" data-tipo="${tipoMovimiento}">Generar PDF</button>`;
            }}
        ],
        initComplete: function() {
            var api = this.api();
            setTimeout(function() {
                api.columns.adjust().responsive.recalc();
            }, 500); 
        }
    });
    

    // Función para recargar la tabla según el tipo de movimiento
    function cargarDatos(tipo) {
        var url = '/movimientos/Agrupados/'+ tipo;
        // console.log(url); //debug
        tablaMovimientos.ajax.url(url).load();
    }

    // Manejo del clic en los botones
    $('.btn-group button').on('click', function() {
        var tipo = $(this).data('tipo');
        // console.log(tipo); //debug
        cargarDatos(tipo);
    });

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        var targetTab = $(e.target).attr('href'); 

        if (targetTab === '#ver-vendedores') {
            $('#vendedores-table').closest('.dataTables_wrapper').show();

            if ($.fn.dataTable.isDataTable('#vendedores-table')) {
                var table = $('#vendedores-table').DataTable();
                table.columns.adjust().responsive.recalc();
            } else {
                console.log('DataTable no está inicializado');
            }
        } else {
            $('#vendedores-table').closest('.dataTables_wrapper').hide();
        }
    });

    // Cuando se activa la pestaña "ver-movimientos"
    $('#ver-movimientos-tab').on('shown.bs.tab', function () {
        // Recargar y ajustar las columnas del DataTable
        tablaMovimientos.ajax.reload(); // Recarga los datos si es necesario
        tablaMovimientos.columns.adjust().responsive.recalc(); // Ajusta las columnas de la tabla
    });

    $(document).on('giftCardsAssigned', function() {
        tablaMovimientos.ajax.reload();
    });

    $('#tablaMovimientos').on('click', '.btn-pdf', function() {
        const rowData = $('#tablaMovimientos').DataTable().row($(this).parents('tr')).data();
        const fecha = new Date(rowData.fechaMovimiento);
        const fechaFormateada = `${fecha.getDate().toString().padStart(2, '0')}${(fecha.getMonth() + 1).toString().padStart(2, '0')}${fecha.getFullYear()}`;
        
        // Aquí determinamos el tipo de movimiento y creamos el nombre del archivo
        let nombreArchivo = '';
        let urlPdf = '';
        let dataToSend = {};
        // console.log('idTipoMovimiento:', rowData); //debug
        // Determinamos el tipo de movimiento y configuramos el PDF
        switch (Number(rowData.idTipoMovimiento)) {
            case 2: // Entrega
                nombreArchivo = `Entrega${fechaFormateada}${rowData.idVendedor}${rowData.idAgrupacion}.pdf`;
                urlPdf = '/giftcards/pdf_plantilla_entrega';
                dataToSend = {
                    idAgrupacion: rowData.idAgrupacion,
                    idVendedor: rowData.idVendedor,
                    nombreVendedor: rowData.nombreVendedor,
                    cargoVendedor: rowData.cargoVendedor,
                    idTipoMovimiento: rowData.idTipoMovimiento,
                    fechaMovimiento: rowData.fechaMovimiento,
                    idGift: rowData.idGift,
                    movimientos: rowData.movimientos
                };
                break;
            
            case 3: // Liquidación
                nombreArchivo = `Liquidacion${fechaFormateada}${rowData.codigoVendedor}${(rowData.codigoCliente ? rowData.codigoCliente.trim().replace(/\s+/g, ' ') : '')}.pdf`;
                urlPdf = '/giftcards/pdf_plantilla_liquidacion';
                dataToSend = {
                    idAgrupacion: rowData.idAgrupacion,
                    idVendedor: rowData.idVendedor,
                    codigoCliente: (rowData.codigoCliente ? rowData.codigoCliente.trim().replace(/\s+/g, ' ') : ''),
                    nombreCliente: rowData.nombreCliente,
                    codigoVendedor: rowData.codigoVendedor,
                    nombreVendedor: rowData.nombreVendedor,
                    cargoVendedor: rowData.cargoVendedor,
                    idTipoMovimiento: rowData.idTipoMovimiento,
                    fechaMovimiento: rowData.fechaMovimiento,
                    valorMovimiento: rowData.valorMovimiento,
                    idGift: rowData.idGift,
                    valorUnitario: rowData.valorUnitario,
                    movimientos: rowData.movimientos
                };
                break;
    
            case 4: // Devolución
                nombreArchivo = `Devolucion${fechaFormateada}${rowData.idVendedor}${rowData.idAgrupacion}.pdf`;
                urlPdf = '/giftcards/pdf_plantilla_devolucion'; // Asegúrate de tener una ruta adecuada
                dataToSend = {
                    idAgrupacion: rowData.idAgrupacion,
                    idVendedor: rowData.idVendedor,
                    nombreVendedor: rowData.nombreVendedor,
                    cargoVendedor: rowData.cargoVendedor,
                    idTipoMovimiento: rowData.idTipoMovimiento,
                    fechaMovimiento: rowData.fechaMovimiento,
                    movimientos: rowData.movimientos
                };
                break;
    
            default:
                console.error('Tipo de movimiento desconocido');
                return;
        }
    
        // Realizar la solicitud AJAX para generar el PDF
        $.ajax({
            url: urlPdf,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ data: dataToSend }),
            xhrFields: { responseType: 'blob' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(blob) {
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al generar el PDF:', textStatus, errorThrown);
            }
        });
    });
    
});
