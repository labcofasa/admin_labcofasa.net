@extends('layouts.autenticado')

@section('titulo', 'Articulos')

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

    #loading-spinner {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none; /* Para ocultarlo inicialmente */
        z-index: 1050; /* Asegura que esté sobre otros elementos */
    }

    /* Fondo oscuro opcional */
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 1049; /* Debajo del loader */
    }

</style>

@endpush

@section('contenido')
    <div class="container-fluid content">
        <!-- Encabezado -->
        <div class="encabezado d-flex justify-content-between align-items-center mb-3 mt-5">
            <a href="{{ route('pag.movimientos') }}" class="btn btn-link" title="Volver a Facturas">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20" color="#000000" fill="currentColor" class="icon">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" stroke="currentColor" stroke-width="27"/>
                </svg>
            </a>
            <h1>@yield('titulo')</h1>
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn btn-success" id="AgregarArticulo" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">Agregar un Producto</a>
            </div>
        </div>


        <form method="GET" action="{{ route('pag.productos') }}" class="mb-3 d-flex" id="searchForm">
            <div class="input-group">
                <input type="text" class="form-control" name="search" id="search" value="{{ $searchTerm }}" placeholder="Buscar artículo por código o nombre" autocomplete="off" />
            </div>
            @if(request()->has('search'))
                <a href="{{ route('pag.productos') }}" class="btn btn-secondary ms-2">Limpiar</a>
            @endif
        </form>
        <div id="loading-overlay"></div>
        <div id="loading-spinner">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        <!-- Tabla Artículos -->
        <div class="table-responsive">
            <table id="tabla-articulos" class="table table-hover responsive">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody id="articulos-tbody">
                    @include('partials.articulos-tabla', ['articulos' => $articulos])
                </tbody>
            </table> 
            <div id="pagination" class="d-flex justify-content-between align-items-center">
                <p id="pagination-text" class="small text-muted mb-0 me-auto">
                    Mostrando {{ $articulos->firstItem() }} a {{ $articulos->lastItem() }} de {{ $articulos->total() }} resultados
                </p>
                <div id="pagination-links">
                    {{ $articulos->links('pagination::bootstrap-5') }}
                </div>
            </div>
            
        </div>
        
    </div>
    <x-movimientos.AgregarArticulo />
    <x-notificaciones />
    <x-notificaciones.confirmacion buttonColor="btn-danger" />
@endsection
@push('scripts')
<script>
    var productosUrl = @json(route('pag.productos'));
</script>

<script src="{{ asset('js/giftcards/ArticulosGift.js') }}">

    function eliminarArticulo(button) {
        const codigo = $(button).data('id'); 
        $('#confirmModalLabel').text('Confirmar Eliminación'); 
        $('#confirmModalBody').text('¿Estás seguro de que deseas eliminar este artículo?');
    
        $('#confirmModal').modal('show');
        console.log(codigo);
    
        $('#btnConfirm').off('click').on('click', function() {
            $.ajax({
                url: `/productos/eliminar/${codigo}`,
                method: 'PUT',
                success: function(response) {
                    mostrarToast ('Artículo eliminado correctamente.','success');
                    $(button).closest('tr').remove();
                    $('#confirmModal').modal('hide'); 
                },
                error: function(xhr, status, error) {
                    mostrarToast ('Se produjo un error al eliminar el artículo.','error');
                    
                    $('#confirmModal').modal('hide');
                }
            });
        });
    };
</script>
@endpush