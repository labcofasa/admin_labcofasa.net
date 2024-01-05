@extends('layouts.autenticado')

@section('titulo', 'Papelera')

@section('contenido')
    <div class="container-fluid main-container py-3">
        <h1 class="py-3">@yield('titulo')</h1>

        <x-skeleton />

        <div class="table-responsive rounded-3" id="tabla-papelera-container" style="display: none;">
            <table id="tabla-papelera" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal para confirmar la restauración de regsitros -->
    <div class="modal fade" id="restaurarRegistro" tabindex="-1" role="dialog" aria-labelledby="restaurarRegistroLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo" id="restaurarRegistroLabel">Confirmar restauración</h1>
                    <button class="btn-icon-close" data-bs-dismiss="modal">
                        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                            width="24px" fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center mt-3">
                        ¿Está seguro de que desea restaurar el registro: "<span id="nombre-registro"></span>"?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-actions btn btn-lg btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn-actions btn btn-lg btn-success"
                        id="btn-restaurar-registro">Restaurar</button>
                </div>
            </div>
        </div>
    </div>

    <x-notificaciones />

    <script src="{{ asset('js/papelera/papelera.js') }}"></script>
@endsection
