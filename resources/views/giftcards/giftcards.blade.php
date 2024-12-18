@extends('layouts.autenticado')

@section('titulo', 'Gift Cards')

@push('styles')

@endpush

@section('contenido')
    <div class="container-fluid content">
        <div class="encabezado">
            <h1 class="pb-3">@yield('titulo')</h1>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalAgregarGiftCard">
                Agregar Gift Card
            </button>
        </div>
        <div class="table-responsive">
            <table id="tabla-Gift" class="table table-hover responsive nowrap">
                <thead>
                    <tr>
                        <th>Valor</th>
                        <th>Cantidad</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se cargarán los datos dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
    <x-giftcards.giftcardAdd />
    <x-notificaciones />
    <x-notificaciones.confirmacion buttonColor="btn-danger" />
@endsection

@push('scripts')
    <script src="{{ asset('js/giftcards/giftcards.js') }}"></script>
@endpush