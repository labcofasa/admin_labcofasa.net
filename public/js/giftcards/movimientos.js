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
            url: '/movimientos/Agrupados',
            type: 'GET',
            dataSrc: function(json) {
                return json.map(function(vendedor) {
                    let valorTotal = vendedor.movimientos.reduce((total, movimiento) => {
                        return total + parseFloat(movimiento.valorMovimiento); 
                    }, 0);
                    
                    let tipoMovimiento;
                    switch (parseInt(vendedor.idTipoMovimiento)) {
                        case 2:
                            tipoMovimiento = 'Entrega';
                            break;
                        case 3:
                            tipoMovimiento = 'Liquidación';
                            break;
                        default:
                            tipoMovimiento = 'Devolución';
                    }
                    return {
                        idAgrupacion: vendedor.idAgrupacion,
                        idVendedor: vendedor.idVendedor,
                        nombreVendedor: vendedor.nombreVendedor,
                        cargoVendedor: vendedor.cargoVendedor,
                        tipoMovimiento: tipoMovimiento,
                        fechaMovimiento: vendedor.fechaMovimiento,
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
            { data: 'null', orderable: false, defaultContent: "<button class='btn btn-primary btn-pdf'>Generar PDF</button>" }
        ],
        initComplete: function() {
            var api = this.api();
            setTimeout(function() {
                api.columns.adjust().responsive.recalc();
            }, 500); 
        }
    });

    tablaLiquidacion = $('#tablaLiquidacion').DataTable({
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
            url: '/movimientos/Liquidaciones',
            type: 'GET',
            dataSrc: function(json) {
                return json.map(function(vendedor) {
                    let tipoMovimiento;
                    switch (parseInt(vendedor.idTipoMovimiento)) {
                        case 2:
                            tipoMovimiento = 'Entrega';
                            break;
                        case 3:
                            tipoMovimiento = 'Liquidación';
                            break;
                        default:
                            tipoMovimiento = 'Devolución';
                    }
                    return {
                        idAgrupacion: vendedor.idAgrupacion,
                        idVendedor: vendedor.idVendedor,
                        nombreVendedor: vendedor.nombreVendedor,
                        cargoVendedor: vendedor.cargoVendedor,
                        tipoMovimiento: tipoMovimiento,
                        fechaMovimiento: vendedor.fechaMovimiento,
                        valorTotal: vendedor.valorMovimiento, 
                        movimientos: vendedor.movimientos,
                        codigoCliente: vendedor.codigoCliente,
                        nombreCliente: vendedor.nombreCliente,
                        codigoVendedor: vendedor.codigoVendedor
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
            { data: 'null', orderable: false, defaultContent: "<button class='btn btn-primary btn-pdf'>Generar PDF</button>" }
        ],
        initComplete: function() {
            var api = this.api();
            setTimeout(function() {
                api.columns.adjust().responsive.recalc();
                $('#tablaLiquidacion').show();
            }, 500); 
        }
    });

    tablaDevolucion = $('#tablaDevolucion').DataTable({
        
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


    $('.btn-group button').on('click', function() {
        var targetTable = $(this).data('target');

        $('.dataTables_wrapper').hide();
        $(targetTable).closest('.dataTables_wrapper').show();

        switch (targetTable) {
            case '#tablaMovimientos':
                if ($.fn.DataTable.isDataTable('#tablaMovimientos')) {
                    tablaLiquidacion.columns.adjust().draw(false);
                } else {
                    console.error('tablaMovimientos no está inicializada.');
                }
                break;
            case '#tablaLiquidacion':
                if ($.fn.DataTable.isDataTable('#tablaLiquidacion')) {
                    tablaLiquidacion.columns.adjust().draw(false);
                } else {
                    console.error('tablaLiquidacion no está inicializada.');
                }
                
                break;
            case '#tablaDevolucion':
                tablaDevolucion.columns.adjust().draw(false);
                break;
        }
        $('.btn-group button').removeClass('active');
        $(this).addClass('active');
    });

    $('.btn-group button[data-target="#tablaMovimientos"]').addClass('active');
    $('#tablaDevolucion').closest('.dataTables_wrapper').hide();
    $('#tablaLiquidacion').closest('.dataTables_wrapper').hide();
    $('#tablaMovimientos').closest('.dataTables_wrapper').show();

    $('.btn-group button').on('mousedown', function() {
        $('.btn-group button').removeClass('active');
        $(this).addClass('active');
    });

    $(document).on('giftCardsAssigned', function() {
        dataTableMovimientos.ajax.reload();
    });

    $('#tablaMovimientos').on('click', '.btn-pdf', function() {
        const rowData = $('#tablaMovimientos').DataTable().row($(this).parents('tr')).data();
        const fecha = new Date(rowData.fechaMovimiento);
        const fechaFormateada = `${fecha.getDate().toString().padStart(2, '0')}${(fecha.getMonth() + 1).toString().padStart(2, '0')}${fecha.getFullYear()}`;
        const nombreArchivo = `Recibo${fechaFormateada}${rowData.idVendedor}${rowData.idAgrupacion}.pdf`;

        $.ajax({
            url: '/giftcards/pdf_plantilla_entrega',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                data: {
                    idAgrupacion: rowData.idAgrupacion,
                    idVendedor: rowData.idVendedor,
                    nombreVendedor: rowData.nombreVendedor,
                    cargoVendedor: rowData.cargoVendedor,
                    idTipoMovimiento: rowData.tipoMovimiento,
                    fechaMovimiento: rowData.fechaMovimiento,
                    movimientos: rowData.movimientos
                }
            }),
            xhrFields: {
                responseType: 'blob' 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhrFields: {
                responseType: 'blob'
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

    $('#tablaLiquidacion').on('click', '.btn-pdf', function() {
        const rowData = $('#tablaLiquidacion').DataTable().row($(this).parents('tr')).data();
        const fecha = new Date(rowData.fechaMovimiento);
        const codigoClienteLimpio = rowData.codigoCliente.trim().replace(/\s+/g, ' ');

        const fechaFormateada = `${fecha.getDate().toString().padStart(2, '0')}${(fecha.getMonth() + 1).toString().padStart(2, '0')}${fecha.getFullYear()}`;
        const nombreArchivo = `Liquidacion${fechaFormateada}${rowData.codigoVendedor}${codigoClienteLimpio}.pdf`;

        $.ajax({
            url: '/giftcards/pdf_plantilla_liquidacion',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                data: {
                    idAgrupacion: rowData.idAgrupacion,
                    idVendedor: rowData.idVendedor,
                    codigoCliente: codigoClienteLimpio,
                    nombreCliente: rowData.nombreCliente,
                    codigoVendedor: rowData.codigoVendedor,
                    nombreVendedor: rowData.nombreVendedor,
                    cargoVendedor: rowData.cargoVendedor,
                    idTipoMovimiento: rowData.tipoMovimiento,
                    fechaMovimiento: rowData.fechaMovimiento,
                    valorMovimiento: rowData.valorTotal,
                    idGift: rowData.idGift,
                    valorUnitario: rowData.valorUnitario,
                    movimientos: rowData.movimientos
                }
            }),
            xhrFields: {
                responseType: 'blob' 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhrFields: {
                responseType: 'blob'
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
