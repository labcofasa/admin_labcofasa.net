$(document).ready(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    initializeDataTable();
    setTimeout(() => {
        table.columns.adjust().responsive.recalc();
    }, 100);
   
    $(window).on('resize', function() {
        table.columns.adjust().responsive.recalc();

        const newWidth = $(window).width();
        if (newWidth < 600) {
            table.columns([1, 2]).visible(false);
        } else {
            table.columns([1, 2]).visible(true); 
        }
    });
    
});

function initializeDataTable() {
    $table = $('#tabla-proveedores').DataTable({
        "ajax": {
            "url": "/proveedores-tabla",
            "dataSrc": ""
        },
        "columns": [
            { "data": "RegIva" },  
            { "data": "Nombre" }, 
            { "data": "Direccion" }, 
            { "data": "Nit" } 
        ],
        "pageLength": 5,
        "searching": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "responsive": {
            "details": {
                "type": 'column',
            }
        },
        "columnDefs": [
            {
                "targets": 0,
                "responsivePriority": 1,
            },
            {
                "targets": 1, 
                "responsivePriority": 3,
            },
            {
                "targets": 2,
                "responsivePriority": 2,
            },
            {
                "targets": 3, 
                "responsivePriority": 0,
            }
        ],
        "language": {
            "search": "Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": '>>',  
                "previous": '<<',
            }
        },
        "pagingType": "simple_numbers",
        "drawCallback": function () {
                if ($(window).width() < 768) { 
                    const pageInfo = this.api().page.info();
                    const startPage = 1;
                    const endPage = Math.min(3, pageInfo.pages); 
                    const pages = [];
             
                    for (let i = startPage; i <= endPage; i++) {
                        pages.push(`<li class="paginate_button page-item"><a href="#" class="page-link">${i}</a></li>`);
                    }
                    
                    if (pageInfo.pages > 3) {
                        pages.push(`<li class="paginate_button page-item"><a href="#" class="page-link">${pageInfo.pages}</a></li>`);
                    }

                    
                    $('.dataTables_paginate .pagination').html(pages.join(''));
                } else {
                    
                    $('.dataTables_paginate').show();
                }
            }
    });

    $('.dataTables_paginate').css({
        'font-size': '0.8rem', 
        'padding': '0.5rem',
    });

    $('#tabla-proveedores_filter input').addClass('form-control form-control-sm ml-3')
    .attr('placeholder', '')
    .css({
        'border-radius': '25px',
        'padding': '5px 15px',
        'border': '1px solid rgb(204, 204, 204)',
        'width': '150px',
        'max-width': '100%'
    });

    $(window).on('resize', function() {
        if ($(window).width() < 768) {
            $('#tabla-proveedores_filter').css('padding', '0 2rem'); 
            $('.dataTables_paginate').css('font-size', '0.7rem'); 
        } else {
            $('#tabla-proveedores_filter').css('padding', ''); 
            $('.dataTables_paginate').css('font-size', '0.8rem');
        }
    }).resize(); 
}

function loadProveedores() {
    $.ajax({
        url: '/proveedores-tabla',
        method: 'GET',
        success: function(response) {
            const table = $('#tabla-proveedores').DataTable();
            table.clear(); 
            table.rows.add(response);
            table.draw(); 
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar los proveedores:', xhr.responseText);
            mostrarToast("Ocurrió un error al cargar los proveedores.", "error");
        }
    });
}


// function editarProveedor(idProveedor) {
    
//     $.ajax({
//         url: '/proveedor/' + idProveedor + '/editar', 
//         method: 'GET',
//         success: function(response) {
//             $('#formProveedorEdit input[name="idProveedor"]').val(response.idProveedor);
//             $('#formProveedorEdit input[name="nombre"]').val(response.nombre);
//             $('#formProveedorEdit textarea[name="ubicacion"]').val(response.ubicacion);
//             $('#formProveedorEdit input[name="NIT"]').val(response.NIT);
            
//             $('#proveedorEditModal').modal('show');
//         },
//         error: function(xhr) {
//             console.error(xhr.responseText);
//             alert('Error al obtener los datos del proveedor');
//         }
//     });
// }

// $('#btnGuardarProv').on('click', function() {
    
//     let formData = new FormData($('#form-proveedor')[0]);

//     $.ajax({
//         url: '/proveedores',
//         method: 'POST',
//         data: formData,
//         processData: false,
//         contentType: false,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function (response) {
//             mostrarToast(response.message || "Proveedor agregado exitosamente.", "success");
//             $('#modalAgregarProveedor').modal('hide');
//         },
//         error: function (xhr, status, error) {
//             console.error(xhr.responseText);
//             mostrarToast("Ocurrió un error al guardar el proveedor.", "error");
//         }
//     });
// });

// $('#btnGuardarCambios').on('click', function() {
//     const idProveedor = $('input[name="idProveedor"]').val(); // Obtener ID del campo oculto
//     const data = {
//         nombre: $('input[name="nombre"]').val(), // Obtener valor del campo Nombre
//         ubicacion: $('textarea[name="ubicacion"]').val(), // Obtener valor del campo Ubicación
//         NIT: $('input[name="NIT"]').val(), // Obtener valor del campo NIT
//     };

//     $.ajax({
//         url: `/proveedores/${idProveedor}`,
//         method: 'PUT',
//         data: data,
//         success: function(response) {
//             mostrarToast("Proveedor actualizado con éxito.", "success");
//             $('#proveedorEditModal').modal('hide');
//             loadProveedores(); 
//         },
//         error: function(xhr, status, error) {
//             console.error('Error al actualizar el proveedor:', xhr.responseText);
//             console.log(xhr.status);
//             console.log(xhr); 
//             mostrarToast("Ocurrió un error al guardar el proveedor.", "error");
//         }
//     });
// });

// let proveedorIdToDelete = null; // Variable para almacenar el ID del proveedor a eliminar

// function eliminarProveedor(idProveedor) {
//     proveedorIdToDelete = idProveedor; // Guarda el ID del proveedor a eliminar

//     // Actualiza el contenido del modal
//     $('#confirmModalLabel').text('Confirmar Eliminación'); // Título del modal
//     $('#confirmModalBody').text('¿Estás seguro de que deseas eliminar este proveedor?'); // Cuerpo del modal

//     $('#confirmModal').modal('show'); // Muestra el modal de confirmación
// }

// // Agregar un evento al botón de confirmar eliminación
// $('#btnConfirm').on('click', function() {
//     $.ajax({
//         url: `/proveedores/${proveedorIdToDelete}`,
//         method: 'DELETE',
//         success: function(response) {
//             mostrarToast("Proveedor eliminado con éxito.", "success");
//             loadProveedores(); 
//             $('#confirmModal').modal('hide'); 
//         },
//         error: function(xhr, status, error) {
//             console.error('Error al eliminar el proveedor:', xhr.responseText);
//             mostrarToast("Ocurrió un error al eliminar el proveedor.", "error");
//         }
//     });
// });