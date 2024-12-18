@extends('layouts.autenticado')

@section('titulo', 'Proveedores')

@push('styles')
<style>
    .encabezado {
        display: flex;
        align-items: center; 
        margin-bottom: 20px;
    }

    .encabezado a {
        margin-right: 10px; 
    }

    .encabezado h1 {
        margin: 0;
        font-size: 1.5rem; 
        flex-grow: 1; 
        line-height: 1; 
    }

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
        <!-- Encabezado -->
        <div class="encabezado d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('pag.facturas') }}" class="btn btn-link" title="Volver a Facturas">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20" color="#000000" fill="currentColor" class="icon">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" stroke="currentColor" stroke-width="27"/>
                </svg>
            </a>
            <h1>@yield('titulo')</h1>
        </div>

        <!-- Tabla Proveedores -->
        <div class="table-responsive">
            <table id="tabla-proveedores" class="table table-hover responsive nowrap">
                <thead>
                    <tr>
                        <th>NRC</th>              <!-- Cambiado de Nombre a NRC -->
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>NIT</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se cargarán los datos dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
    <x-notificaciones />
    <x-notificaciones.confirmacion buttonColor="btn-danger" />
@endsection

@push('scripts')
    <script src="{{ asset('js/proveedores/proveedores.js') }}"></script>
@endpush
