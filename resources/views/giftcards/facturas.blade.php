@extends('layouts.autenticado')

@section('titulo', 'Facturas')

@push('styles')
<style>
    .dataTables_wrapper .row .col-md-6:empty {
        display: none;
    }

    .dataTables_filter {
        display: flex;
        justify-content: flex-start; 
        align-items: center;
    }

    .dataTables_filter label {
        margin-right: 15px;
        font-weight: bold;
    }

    .dataTables_filter input {
        border-radius: 25px;
        padding: 5px 10px;
        border: 1px solid #ccc;
        margin-left: 15px;
        max-width: 50%;
        box-shadow: none;
    }

    @media (max-width: 768px) {
        .dataTables_filter input {
            width: 100%;       
            margin-left: 0;    
            margin-right: 0; 
        }

        .dataTables_filter {
            padding: 0 2rem;
        }
    }

    
</style>
@endpush

@section('contenido')
    
    <div class="container-fluid content">
        <!-- tabla facturas -->
        <div class="encabezado">
            <h1 class="pb-3">@yield('titulo')</h1>
        </div>
        <!-- Pestañas -->
        <ul class="nav nav-tabs" id="facturasTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ver-facturas-tab" data-bs-toggle="tab" href="#ver-facturas" role="tab" aria-controls="ver-facturas" aria-selected="true">Ver Facturas</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="crear-factura-tab" data-bs-toggle="tab" href="#crear-factura" role="tab" aria-controls="crear-factura" aria-selected="false">Crear Factura</a>
            </li>
        </ul>

        <!-- Contenido de las Pestañas -->
        <div class="tab-content" id="facturasTabsContent">
            <!-- Ver Facturas -->
            <div class="tab-pane fade show active tab-background mt-3" id="ver-facturas" role="tabpanel" aria-labelledby="ver-facturas-tab">
                <div class="encabezado d-flex justify-content-between align-items-center mb-3">
                    <h1 class="pb-3">Lista de Facturas</h1>
                    <!-- Botón para abrir el modal -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Ver Proveedores</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="facturas-table" class="table align-middle display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Comprobante</th>
                                <th>Fecha de compra</th>
                                <th>NRC del Proveedor</th>
                                <th>Monto Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Las filas se insertarán aquí mediante AJAX -->
                        </tbody>
                    </table>
                </div> 
            </div>
            <!-- Crear Factura -->
            <div class="tab-pane fade mt-3 tab-background" id="crear-factura" role="tabpanel" aria-labelledby="crear-factura-tab">
                <form action="{{ route('facturas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jsonFile" class="form-label">Cargar JSON</label>
                        <input type="file" class="form-control" id="jsonFile" accept=".json">
                        <button type="button" id="load-json" class="btn btn-primary mt-2">Cargar JSON</button>
                    </div>
                    <div class="mb-3">
                        <label for="Correlativo" class="form-label">Correlativo</label>
                        <input type="text" class="form-control" id="Correlativo" name="Correlativo" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="Fecha_Compra" class="form-label">Fecha de Compra</label>
                        <input type="date" class="form-control" id="Fecha_Compra" name="Fecha_Compra" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="RegIva" class="form-label">Proveedor</label>
                        <input type="text" class="form-control" id="RegIva" name="RegIva" placeholder="Buscar proveedor..." required>
                        <div id="dropdown-suggestions" class="dropdown-menu" style="display: none;"></div>
                    </div>
                    
                    
                    <div id="giftcards-container" class="row">
                        <!-- Fila inicial de Gift Card sin botón "Eliminar" -->
                        <div class="giftcard-group col-md-6 mb-3">
                            <label for="giftcard" class="form-label">Gift Card</label>
                            <select class="form-control giftcard-select mb-3" name="giftcards[0][idGiftCard]" required>
                                <option value="">Cargando gift cards...</option>
                            </select>
                    
                            <label for="Cantidad" class="form-label">Cantidad</label>
                            <input type="number" step="1" min="1" id="Cantidad" class="form-control giftcard-cantidad mb-3" name="giftcards[0][Cantidad]" required>
                    
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion[0][descripcion]"></textarea>
                        </div>
                    </div>
                    <button type="button" id="add-giftcard" class="btn btn-secondary">Agregar otra gift card</button>

                    <div class="mb-3">
                        <label for="subtotal" class="form-label">Subtotal</label>
                        <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="montoTotal" class="form-label">Monto Total</label>
                        <input type="text" class="form-control" id="montoTotal" name="montoTotal" readonly>
                    </div>
                    
                    <!-- Alinear el botón "Enviar" a la derecha -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Enviar Factura</button>
                    </div>
                </form>
            </div>
            <x-notificaciones />
            <x-facturas.detalleFactura/>
            <x-notificaciones.confirmacion buttonColor="btn-danger" />
        </div>
        @push('scripts')
         <script src="{{ asset('js/giftcards/addgift.js') }}"></script>
         <script src="{{ asset('js/giftcards/facturas.js') }}"></script>
        @endpush
@endsection


