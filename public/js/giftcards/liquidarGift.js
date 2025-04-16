$(document).ready(function() {

    let productCount = 0;

    $(document).on("click", ".btn-liquidar", function() {
        const idVendedor = $(this).data("id");
        const nombreVendedor = $(this).data("nombre");
        const cargoVendedor = $(this).data("cargo");
    
        $("#idVendedorLiquidar").val(idVendedor);
        $("#cargoLiquidar").val(cargoVendedor);
        $("#nombreVendedorLiquidar").text(nombreVendedor);
    
        $("#modalLiquidarGiftCard").modal("show");
    });

    $(document).on("click", ".remove-product-btn", function () {
        $(this).closest('.producto-row').remove();  
    });

    document.getElementById('addProductBtn').addEventListener('click', function () {
        productCount++;
    
        const container = document.getElementById('productos-container');

        const newRowHTML = getProductRowHTML(productCount);
        
        container.insertAdjacentHTML('beforeend', newRowHTML);
    });

    $('#modalLiquidarGiftCard').on('hidden.bs.modal', function () {
        productCount = 0; 
    });

    $('#modalLiquidarGiftCard').on('show.bs.modal', function () {
        $('#productos-container').empty();
        
        productCount = 1;
        const container = document.getElementById('productos-container');

        const newRowHTML = getProductRowHTML(productCount);
        
        container.insertAdjacentHTML('beforeend', newRowHTML);

        $('#cantidadGift').val(1);
        $('#fechaMov').val('');
    });

    function getProductRowHTML(count) {
        return `
            <div class="row producto-row mb-3">
                <div class="col-md-5 mt-1 position-relative">
                    <label for="productoInput${count}" class="form-label">Producto:</label>
                    <input type="text" id="productoInput${count}" class="form-control" placeholder="Buscar producto" autocomplete="off">
                    <input type="hidden" id="idArticuloHidden${count}" name="idArticulo${count}">
                    <div id="dropdown-suggestions-${count}" class="dropdown-menu" style="display: none;"></div>
                    </ul>
                </div>
                <div class="col-md-4 mt-1">
                    <label for="cantidad${count}" class="form-label">Cantidad:</label>
                    <input type="number" id="cantidad${count}" name="cantidad${count}" class="form-control" min="1" placeholder="Cantidad">
                </div>
                <div class="col-md-3 mt-1 d-flex align-items-end">
                    ${count > 1 ? `<button type="button" class="btn btn-danger btn-sm remove-product-btn" data-row-id="producto-row-${count}">Eliminar</button>` : ''}
                </div>
            </div>
        `;
    }

    let productosData = []; // Aquí se almacenarán los productos

    // Evento input para buscar y mostrar sugerencias de productos
    $(document).on('input', '[id^=productoInput]', function() {
        const query = $(this).val().toLowerCase();
        const inputId = $(this).attr('id');
        const productIndex = inputId.match(/\d+/)[0];
        const dropdownId = `#dropdown-suggestions-${productIndex}`;
        const dropdown = $(dropdownId);

        if (query.length >= 2) {
            fetch('/movimientos/articulos?search=' + query)
                .then(response => response.json())
                .then(data => {
                    productosData = data;
                    if (productosData.length > 0) {
                        const suggestions = productosData.map(producto => {
                            return `<a class="dropdown-item" href="#" data-codigo="${producto.codigo}" data-nombre="${producto.nombre}" data-id="${producto.idArticulo}">
                                        ${producto.nombre} (${producto.codigo})
                                    </a>`;
                        }).join('');
                        dropdown.html(suggestions).show();
                    } else {
                        dropdown.html('<span class="dropdown-item text-muted">Sin resultados</span>').show();
                    }
                })
                .catch(error => {
                    console.error('Error al cargar los productos:', error);
                    dropdown.hide();
                });
        } else {
            dropdown.hide();
        }
    });


    $(document).on('click', '.dropdown-item', function(e) {
        if ($('#modalLiquidarGiftCard').hasClass('show')) {
            e.preventDefault();
            
            // Obtener el nombre y el código del producto
            const selectedNombre = $(this).data('nombre');
            const selectedCodigo = $(this).data('id');
            
            // Encontrar el dropdown-menu más cercano
            const dropdown = $(this).closest('.dropdown-menu');
            
            // Obtener el índice del producto basado en el id del dropdown
            const productIndex = dropdown.attr('id').replace('dropdown-suggestions-', '');
            
            // Seleccionar el input correspondiente al producto usando el índice
            $(`#productoInput${productIndex}`).val(selectedNombre);
            
            // Seleccionar el input hidden correspondiente y asignar el código
            $(`#idArticuloHidden${productIndex}`).val(selectedCodigo);
            
            // Ocultar el dropdown después de la selección
            dropdown.hide();
            
            e.stopPropagation();
        }
    });
    

    $(document).on('input', '#clienteInputLiquidar', function() {
        const query = $(this).val().toLowerCase();
        const dropdown = $('#clientesLiquidarDropdown');
    
        if (query.length >= 2) {
            fetch('/movimientos/clientes?search=' + query)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const suggestions = data.map(cliente => {
                            return `<a class="dropdown-item" href="#" data-id="${cliente.idCliente}" data-nombre="${cliente.establecimiento}">
                                        ${cliente.establecimiento} (${cliente.codigo})
                                    </a>`;
                        }).join('');
                        dropdown.html(suggestions).show();
                    } else {
                        dropdown.hide();
                    }
                })
                .catch(error => {
                    console.error('Error al cargar los clientes:', error);
                    dropdown.hide();
                });
        } else {
            dropdown.hide();
        }
    });
    
    $(document).on('click', '#clientesLiquidarDropdown .dropdown-item', function(e) {
        e.preventDefault();
        const selectedNombre = $(this).data('nombre');
        const selectedId = $(this).data('id');
    
        $('#clienteInputLiquidar').val(selectedNombre);
        $('#clienteIdHidden').val(selectedId); // Campo oculto para el ID de cliente.
    
        $('#clientesLiquidarDropdown').hide();
    });
    
    function cargarGiftCards() {
        const idVendedor = $('#idVendedorLiquidar').val();
    
        if (idVendedor) {
            fetch(`/movimientos/giftcards?idVendedor=${idVendedor}`)
                .then(response => response.json())
                .then(data => {
                    const selectGiftCard = $('#giftCardSelectLiquidar');
                    selectGiftCard.empty();
    
                    if (data.length > 0) {
                        selectGiftCard.append('<option selected disabled>Seleccione una Gift Card</option>');
    
                        data.forEach(giftCard => {
                            const optionText = `Valor: ${giftCard.valor} - Cantidad: ${giftCard.cantidad}`;
                            selectGiftCard.append(`<option value="${giftCard.idGiftCard}">${optionText}</option>`);
                        });
                    } else {
                        selectGiftCard.append('<option selected disabled>No hay resultados</option>');
                    }
                })
                .catch(error => {
                    console.error('Error al cargar las Gift Cards:', error);
                });
        } else {
            console.error('No se ha seleccionado un vendedor.');
        }
    }  

    $('#modalLiquidarGiftCard').on('show.bs.modal', function () {
        cargarGiftCards();
    });


    $(document).on('input', 'input[id^="productoInput"], input[id^="cantidad"]', function() {
        let valid = true;
    
        let productos = [];
        $('.producto-row').each(function() {
            const productoId = $(this).find('input[id^="idArticuloHidden"]').val();
            if (productoId && productos.includes(productoId)) {
                valid = false;
                $(this).find('input[id^="productoInput"]').addClass('is-invalid');
            } else {
                $(this).find('input[id^="productoInput"]').removeClass('is-invalid');
            }
            productos.push(productoId);
        });
    
        $('input[id^="cantidad"]').each(function() {
            const cantidad = $(this).val();
            if (!/^\d+$/.test(cantidad) || parseInt(cantidad) < 1) {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
    
        if (valid) {
            $('#btnLiquidarGift').prop('disabled', false);
        } else {
            $('#btnLiquidarGift').prop('disabled', true);
        }
    });

    $(document).on('click', '#btnLiquidarGift', function() {
        let data = {
            cliente: parseInt($('#clienteIdHidden').val(), 10),
            vendedor: parseInt($('#idVendedorLiquidar').val(), 10),
            giftCard: parseInt($('#giftCardSelectLiquidar').val(), 10),
            cantidadGiftcard: parseInt($('#cantidadGift').val(), 10),
            fechaMovimiento: $('#fechaMov').val(),
            productos: []
        };
    
        $('.producto-row').each(function(index) {
            let idArticulo = parseInt($(`#idArticuloHidden${index + 1}`).val(), 10);
            let cantidad = parseInt($(`#cantidad${index + 1}`).val(), 10);


            if (!isNaN(idArticulo) && !isNaN(cantidad) && cantidad > 0) { 
                let producto = {
                    idArticulo: idArticulo,
                    cantidad: cantidad
                };
                data.productos.push(producto);
            }
        });

        $.ajax({
            url: '/movimientos/liquidar',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                mostrarToast('Giftcard liquidada exitosamente.', 'success');
                productCount = 1;
                $('#productos-container').empty();
                const newRowHTML = getProductRowHTML(1); 
                $('#productos-container').append(newRowHTML);
                cargarGiftCards();
                tablaLiquidacion.ajax.reload();
            },
            error: function(xhr) {
                mostrarToast('Hubo un error al liquidar la Giftcard.', 'error');
            }
        });
    });
    
});