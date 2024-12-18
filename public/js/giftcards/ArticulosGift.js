$(document).ready(function() {
    let timeout = null;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
    
    // Manejo de búsqueda por input
    $('#search').on('input', function() {
        const searchTerm = $(this).val();
        const tbody = $('#articulos-tbody');
        tbody.empty();
        
        clearTimeout(timeout);      
        timeout = setTimeout(function() {
            showLoader();
    
            $.ajax({
                url: productosUrl, 
                method: 'GET',
                data: { search: searchTerm },
                success: function(data) {
                    hideLoader();

                    tbody.empty();
    
                    if (data.error) {
                        tbody.append('<tr><td colspan="3" class="text-center">' + data.error + '</td></tr>');
                        $('#pagination').empty();
                        $('#pagination-text').empty();
                    } else {
                        tbody.append(data.articulos);
                        $('#pagination-text').html(data.paginationText);
                        $('#pagination-links').html(data.pagination);
                        
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    hideLoader();
                }
            });
        }, 500);
    });  
    
    // Manejo de clic en los enlaces de paginación
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        fetchData(url);
    });
    
    function fetchData(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#articulos-tbody').html(response.articulos);
            
                $('#pagination-text').html(response.paginationText);

                $('#pagination-links').html(response.pagination);
                
            },
            error: function (error) {
                console.error('Error en la paginación:', error);
            }
        });
    }
    
    
    $('#productoInput').on('input', function() {
        var query = $(this).val();

        if (query.length >= 3) {
            $.ajax({
                url: "/productos/buscar",
                method: 'GET',
                data: { q: query },
                success: function(response) {
                    var dropdown = $('#dropdown-suggestions');
                    dropdown.empty();
                    var productExists = false;

                    if (response.suggestions.length > 0) {
                        response.suggestions.forEach(function(producto) {

                            if(producto.existe){
                                productExists = true; 
                            }

                            dropdown.append(`
                                <a href="#" class="dropdown-item" 
                                   data-producto-id="${producto.codigo}"
                                   data-producto-nombre="${producto.nombre}">
                                    ${producto.codigo} - ${producto.nombre}
                                </a>
                            `);
                        });

                        dropdown.show();
                    } else {
                        dropdown.hide();
                    }

                    if(productExists){
                        $('#btnAgregarProducto').prop('disabled', true);
                        mostrarToast('Este producto ya existe en los artículos.', 'error');
                    } else {
                        $('#btnAgregarProducto').prop('disabled', false);
                    }
                }
            });
        } else {
            $('#dropdown-suggestions').hide();
        }
    });

    $('#dropdown-suggestions').on('click', '.dropdown-item', function() {
        var productoCodigo = $(this).data('producto-id');
        var productoNombre = $(this).data('producto-nombre');

        $('#ProductoNameLable').text(productoNombre);
        $('#productoInput').val(productoCodigo);
        $('#dropdown-suggestions').hide();

        var hiddenInput = $('#form-agregar-producto').find('input[name="producto_id"]');
        if (hiddenInput.length) {
            hiddenInput.val(productoCodigo); 
        } else {
            $('#form-agregar-producto').append(`<input type="hidden" name="producto_id" value="${productoCodigo}">`);
        }
    });

    $('#btnAgregarProducto').on('click', function() {
        var formData = $('#form-agregar-producto').serialize();

         $.ajax({
            url: '/productos/agregar',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    mostrarToast('Producto agregado con éxito.', 'success');
                }
                $('#btnAgregarProducto').prop('disabled', true);
            },
            error: function(xhr) {
                var response = xhr.responseJSON;
                if (response.status === 'error') {
                    console.log(response.message);
                } else {
                    mostrarToast('Ocurrió un error al agregar el producto.', 'error');
                }
                
            }
        });
    });
    

    function showLoader() {
        document.getElementById('loading-spinner').style.display = 'block';
        document.getElementById('loading-overlay').style.display = 'block';
    }

    function hideLoader() {
        document.getElementById('loading-spinner').style.display = 'none';
        document.getElementById('loading-overlay').style.display = 'none';
    }

});
