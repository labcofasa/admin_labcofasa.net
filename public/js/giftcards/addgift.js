document.addEventListener('DOMContentLoaded', function () {
    let giftcardIndex = 1;

    // Función para manejar la entrada en el campo RegIva y mostrar sugerencias basadas en el filtro
    $('#RegIva').on('input', function() {
        const query = $(this).val().toLowerCase(); 
        if (query.length >= 1) {
            const filteredData = proveedoresData.filter(proveedor => {
                return proveedor.Nombre.toLowerCase().includes(query) || proveedor.RegIva.toLowerCase().includes(query);
            });
            const limitedData = filteredData.slice(0, 5);
            if (limitedData.length > 0) {
                const suggestions = limitedData.map(proveedor => {
                    return `<a class="dropdown-item" href="#" data-regiva="${proveedor.RegIva}">${proveedor.Nombre}</a>`;
                }).join('');
                $('#dropdown-suggestions').html(suggestions).show();
            } else {
                $('#dropdown-suggestions').hide(); 
            }
        } else {
            $('#dropdown-suggestions').hide(); 
        }
    });
    
    // Función para calcular el subtotal y monto total de las gift cards
    function calculateTotals() {
        let subtotal = 0;
        document.querySelectorAll('.giftcard-group').forEach(group => {
            const cantidad = parseFloat(group.querySelector('.giftcard-cantidad').value) || 0;
            const precio = parseFloat(group.querySelector('.giftcard-select').selectedOptions[0]?.textContent.replace('$', '')) || 0;
            subtotal += cantidad * precio;
        });

        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('montoTotal').value = subtotal.toFixed(2);
    }

    // Evento que llama a calculateTotals al cambiar la cantidad o selección de gift cards
    document.getElementById('giftcards-container').addEventListener('input', function (event) {
        if (event.target.classList.contains('giftcard-cantidad') || event.target.classList.contains('giftcard-select')) {
            calculateTotals();
        }
    });
    
    // Maneja la selección de una sugerencia de proveedor
    $(document).on('click', '.dropdown-item', function() {
        const regIva = $(this).data('regiva');
        const nombre = $(this).text();
        $('#RegIva').val(nombre); 
        $('#RegIva').data('regiva', regIva); 
        $('#dropdown-suggestions').hide(); 
    });
    
    // Oculta las sugerencias si se hace clic fuera del campo RegIva
    $(document).click(function(event) {
        if (!$(event.target).closest('#RegIva').length) {
            $('#dropdown-suggestions').hide();
        }
    });


    // Función para cargar proveedores desde el servidor
    function loadProveedores() {
        fetch('/proveedores-tabla')
            .then(response => response.json())
            .then(data => {
                proveedoresData = data; 
                const proveedorSelect = document.getElementById('RegIva');
                proveedorSelect.innerHTML = '<option value="">Seleccione un proveedor</option>'; 
                data.forEach(proveedor => {
                    proveedorSelect.innerHTML += `<option value="${proveedor.RegIva}">${proveedor.Nombre}</option>`;
                });
            })
            .catch(error => mostratToast('Ocurrió un error al cargar los proveedores.', 'error'));
    }

    // Función para cargar las gift cards desde el servidor
    function loadGiftCards(selectElement) {
        fetch('/giftcards-tabla')
            .then(response => response.json())
            .then(data => {
                selectElement.innerHTML = '<option value="">Seleccione una gift card</option>';
                data.forEach(giftCard => {
                    selectElement.innerHTML += `<option value="${giftCard.idGift}">$${giftCard.valor}</option>`;
                });
            })
            .catch(error => mostratToast('Ocurrió un error al cargar las gift cards.', 'error'));
    }
    
    loadProveedores();
    loadGiftCards(document.querySelector('.giftcard-select'));

    // Función para agregar un nuevo grupo de gift cards
    document.getElementById('add-giftcard').addEventListener('click', function () {
        const container = document.getElementById('giftcards-container');

        const newGiftcardGroup = document.createElement('div');
        newGiftcardGroup.classList.add('giftcard-group', 'col-md-6', 'mb-3');

        newGiftcardGroup.innerHTML = `
            <label for="giftcard" class="form-label">Gift Card</label>
            <select class="form-control giftcard-select" name="giftcards[${giftcardIndex}][idGiftCard]" required>
                <option value="">Cargando gift cards...</option>
            </select>

            <label for="Cantidad" class="form-label">Cantidad</label>
            <input type="number" step="1" min="1" class="form-control giftcard-cantidad" id="Cantidad" name="giftcards[${giftcardIndex}][Cantidad]" required>

            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion[${giftcardIndex}][descripcion]"></textarea>
            
            <button type="button" class="btn btn-danger remove-giftcard mt-3">Eliminar</button>
        `;

        container.appendChild(newGiftcardGroup);
        loadGiftCards(newGiftcardGroup.querySelector('.giftcard-select'));
        giftcardIndex++;
    });

    // Restringe la entrada en el campo de cantidad a solo números enteros mayores a 1
    $('#Cantidad').on('input', function() {
        let valor = $(this).val();

        if (valor.includes('.') || valor < 1) {
            valor = parseInt(valor, 10);
            $(this).val(valor);
        }
    });
    
    // Evita el desplazamiento del campo de cantidad usando la rueda del mouse
    $('#Cantidad').on('wheel', function(e) {
        e.preventDefault();
    });

    document.getElementById('giftcards-container').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-giftcard')) {
            const giftcardGroup = event.target.closest('.giftcard-group');
            giftcardGroup.remove();
        }
    });

    // Función para manejar la carga de un archivo JSON
    document.getElementById('load-json').addEventListener('click', function () {
        const fileInput = document.getElementById('jsonFile');
        const file = fileInput.files[0];

        if (!file) {
            mostrarToast("Por favor, selecciona un archivo JSON.", "error");
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const jsonData = JSON.parse(e.target.result);
            populateForm(jsonData);
        };
        reader.readAsText(file);
    });

    // Función para llenar el formulario con datos desde un archivo JSON
    async function populateForm(data) {
        document.getElementById('Correlativo').value = data.identificacion.numeroControl || '';
        document.getElementById('Fecha_Compra').value = data.identificacion.fecEmi || '';
    
        const nrc = data.emisor.nrc; 
        const proveedor = proveedoresData.find(proveedor => proveedor.RegIva === nrc);
    
        if (proveedor) {
            $('#RegIva').val(proveedor.Nombre); 
            $('#RegIva').data('regiva', proveedor.RegIva);
        } else {
            $('#RegIva').val('');
            $('#RegIva').data('regiva', '');
        }
    
        document.getElementById('subtotal').value = data.resumen.subTotal || '0.00';
        document.getElementById('montoTotal').value = data.resumen.montoTotalOperacion || '0.00';
    
        document.getElementById('giftcards-container').innerHTML = '';
    
        const giftcardsRow = document.createElement('div');
        giftcardsRow.classList.add('row');

        const promises = data.cuerpoDocumento.map(async (item, index) => {
            const newGiftcardGroup = document.createElement('div');
            newGiftcardGroup.classList.add('giftcard-group', 'col-md-6', 'mb-3');
            newGiftcardGroup.innerHTML = `
                <label for="giftcard" class="form-label">Gift Card</label>
                <select class="form-control giftcard-select" name="giftcards[${index}][idGiftCard]" required>
                    <option value="">Cargando gift cards...</option>
                </select>
                
                <label for="Cantidad" class="form-label">Cantidad</label>
                <input type="number" step="0.01" class="form-control giftcard-cantidad" name="giftcards[${index}][Cantidad]" value="${item.cantidad}" required>
                
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion[${index}][descripcion]">${item.descripcion || ''}</textarea>
                
                <button type="button" class="btn btn-danger remove-giftcard mt-3">Eliminar</button>
            `;

            giftcardsRow.appendChild(newGiftcardGroup);
            const giftcardSelect = newGiftcardGroup.querySelector('.giftcard-select');
            await loadGiftCards(giftcardSelect);
            const jsonValue = parseFloat(item.precioUni).toFixed(2); 
            Array.from(giftcardSelect.options).forEach(option => {
                const optionValue = parseFloat(option.textContent.replace('$', '')).toFixed(2);
                if (optionValue === jsonValue) {
                    option.selected = true;
                }
            });
        });

        await Promise.all(promises);
        document.getElementById('giftcards-container').appendChild(giftcardsRow);
    }
    async function loadGiftCards(selectElement) {
        try {
            const response = await fetch('/giftcards-tabla');
            const data = await response.json();
            selectElement.innerHTML = '<option value="">Seleccione una gift card</option>'; 
            data.forEach(giftCard => {
                selectElement.innerHTML += `<option value="${giftCard.idGift}">$${giftCard.valor}</option>`;
            });
        } catch (error) {
            mostrarToast.error('Ocurrió un error al cargar gift cards', 'error');
        }
    }

    const form = document.querySelector('form'); 

    // Función para manejar la validación de la fecha de compra
    $('#Fecha_Compra').on('change', function() {
        const fechaActual = new Date().toISOString().split('T')[0];
        const fechaSeleccionada = $(this).val();
        if (fechaSeleccionada > fechaActual) {
            mostrarToast("La fecha no puede ser mayor a la fecha actual.", "error");
            $(this).val('');
        }
    });

    // Función para manejar el envío del formulario
    form.addEventListener('submit', function (event) {
        const fechaSeleccionada = $('#Fecha_Compra').val();
        const fechaActual = new Date().toISOString().split('T')[0];
        if (fechaSeleccionada > fechaActual) {
            mostrarToast("La fecha no puede ser mayor a la fecha actual.", "error");
            event.preventDefault(); 
        }

        event.preventDefault(); 
    
        const correlativo = document.getElementById('Correlativo').value.trim();
        const fechaCompra = document.getElementById('Fecha_Compra').value.trim();
        const regIva = $('#RegIva').data('regiva');
        const giftcards = [];
        const montoTotal = parseFloat(document.getElementById('montoTotal').value.trim());
        const subtotal = parseFloat(document.getElementById('subtotal').value.trim());
    
        if (!correlativo || !fechaCompra || isNaN(regIva) || isNaN(montoTotal) || isNaN(subtotal)) {
            mostrarToast("Por favor, completa todos los campos requeridos correctamente.", "error");
            return;
        }
    
        document.querySelectorAll('.giftcard-group').forEach((group) => {
            const idGiftCard = group.querySelector('.giftcard-select').value;
            const cantidad = parseInt(group.querySelector('.giftcard-cantidad').value);
            const descripcion = group.querySelector('textarea[name^="descripcion"]').value;
    
            giftcards.push({ 
                idGiftCard: parseInt(idGiftCard),
                cantidad: cantidad,
                descripcion 
            });
        });
    
        const dataToSend = {
            Correlativo: correlativo,
            Fecha_Compra: fechaCompra,
            NRC_Proveedor: regIva,
            subTotal: subtotal,
            montoTotal: montoTotal,
            giftcards: giftcards,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        console.log(dataToSend);

        $.ajax({
            url: '/facturas', 
            type: 'POST',
            data: dataToSend,
            success: function(response) {
                mostrarToast("Factura guardada exitosamente.", "success");
                $('#Correlativo').val('');
                $('#Fecha_Compra').val('');
                $('#RegIva').val('').data('regiva', '');
                $('#subtotal').val('0.00');
                $('#montoTotal').val('0.00');
                $('#giftcards-container').empty();
                $('#jsonFileInput').val('');
                $('#facturas-table').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText, error, status);
                mostrarToast("Hubo un error al guardar la factura.", "error");
            }
        });
    });   

});
