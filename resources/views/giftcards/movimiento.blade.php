@extends('layouts.autenticado')

@section('titulo', 'Movimiento')

@push('styles')
<style>
    .dataTables_wrapper .row .col-md-6:empty {
        display: none;
    }
    
    #tablaMovimientos_wrapper {
        width: 100%;
        overflow-x: auto; 
    }

    table.dataTable {
        width: 100% !important;
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

    .is-invalid {
    border-color: red;
    }

    .is-invalid + .invalid-feedback {
        display: block;
    }
    .btn-group .btn.active {
        background-color: #28a745;
        color: white;
        border-color: #218838; 
    }

    .btn-group .btn {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .table-uppercase td, .table-uppercase th {
        text-transform: uppercase;
    }

    @media (max-width: 768px) {
        .dataTables_wrapper .dataTables_paginate {
            display: block;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            display: none;  /* Ocultar todos los botones */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next {
            display: inline-block; /* Mostrar solo los botones de 'Anterior' y 'Siguiente' */
        }

        .dataTables_wrapper .dataTables_length {
            float: none;
            text-align: center;
        }

        .dataTables_filter input {
            width: 100%;       
            margin-left: 0;    
            margin-right: 0; 
        }
        .dataTables_filter {
            padding: 0 2rem;
        }

    }
    
    @media (min-width: 768px) {
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            display: inline-block; /* Mostrar todos los botones de paginación */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next {
            display: inline-block; /* Asegurarse de que los botones 'Anterior' y 'Siguiente' estén visibles */
        }
    }

    
</style>
@endpush

@section('contenido')
    <div class="container-fluid content">
        <!-- Encabezado -->
        <div class="encabezado">
            <h1 class="pb-3">@yield('titulo')</h1>
        </div>
        
        <!-- Pestañas -->
        <ul class="nav nav-tabs" id="movimientosVendedoresTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ver-vendedores-tab" data-bs-toggle="tab" href="#ver-vendedores" role="tab" aria-controls="ver-vendedores" aria-selected="true">Ver Vendedores</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ver-movimientos-tab" data-bs-toggle="tab" href="#ver-movimientos" role="tab" aria-controls="ver-movimientos" aria-selected="false">Ver Movimientos</a>
            </li>
        </ul>

        <!-- Contenido de las Pestañas -->
        <div class="tab-content" id="movimientosVendedoresTabsContent">
            <!-- Ver Vendedores -->
            <div class="tab-pane fade show active tab-background mt-3" id="ver-vendedores" role="tabpanel" aria-labelledby="ver-vendedores-tab">
                <div class="encabezado d-flex justify-content-between align-items-center mb-3">
                    <h1 class="pb-3">Asignar Gift Cards</h1>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('pag.productos') }}" class="btn btn-secondary">Ver Productos</a>
                    </div>
                </div>

                <!-- Tabla Vendedores -->
                <div class="table-responsive">
                    <table id="vendedores-table" class="table align-middle display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas generadas dinámicamente mediante AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ver Movimientos-->
            <div class="tab-pane fade mt-3 tab-background" id="ver-movimientos" role="tabpanel" aria-labelledby="ver-movimientos-tab">
                <div class="encabezado d-flex justify-content-between align-items-center mb-3">
                    <h1>Movimientos</h1>
                </div>

                <div class="btn-group mb-3" role="group" aria-label="Tipo de movimientos">
                    <button type="button" class="btn btn-outline-success" data-tipo="entrega">Asignación</button>
                    <button type="button" class="btn btn-outline-success" data-tipo="liquidacion">Liquidación</button>
                    <button type="button" class="btn btn-outline-success" data-tipo="devolucion">Devolución</button>
                </div>

                <div class="table-responsive">
                    <table id="tablaMovimientos" class="table align-middle display table-uppercase" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Tipo de Movimiento</th>
                                <th>Fecha del Movimiento</th>
                                <th>Valor del movimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se llenarán los datos dinámicamente con jQuery -->
                        </tbody>
                    </table>

                </div>

                
            </div>
            
        </div>
    </div>
    <x-movimientos.EntregarGift />
    <x-movimientos.LiquidarGift />
    <x-movimientos.DevolverGift />
    <x-facturas.detalleFactura/>
    <x-notificaciones />
    <x-notificaciones.confirmacion buttonColor="btn-danger" />
@endsection
@push('scripts')
    <script src="{{ asset('js/giftcards/asignarGift.js') }}"></script>
    <script src="{{ asset('js/giftcards/movimientos.js') }}"></script>
    <script src="{{ asset('js/giftcards/liquidarGift.js') }}"></script>
    <script src="{{ asset('js/giftcards/devolverGift.js') }}"></script>
@endpush