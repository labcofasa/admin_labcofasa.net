@extends('layouts.autenticado')

@section('titulo', 'Formulario conozca a su cliente')

@section('contenido')

    <div class="container-fluid content">

        <ul class="nav nav-tabs" id="miPanel" role="tablist">

            @if (auth()->user()->can('admin_formularios_ver_cliente') && auth()->user()->can('admin_formularios_ver_proveedor'))
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="clientes-tab" data-bs-toggle="tab" data-bs-target="#clientes-tab-pane"
                        type="button" role="tab" aria-controls="clientes-tab-pane"
                        aria-selected="true">Clientes</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="proveedores-tab" data-bs-toggle="tab"
                        data-bs-target="#proveedores-tab-pane" type="button" role="tab"
                        aria-controls="proveedores-tab-pane" aria-selected="false">Proveedores</button>
                </li>
            @elseif (auth()->user()->can('admin_formularios_ver_cliente'))
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="clientes-tab" data-bs-toggle="tab"
                        data-bs-target="#clientes-tab-pane" type="button" role="tab" aria-controls="clientes-tab-pane"
                        aria-selected="true">Clientes</button>
                </li>
            @elseif (auth()->user()->can('admin_formularios_ver_proveedor'))
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="proveedores-tab" data-bs-toggle="tab"
                        data-bs-target="#proveedores-tab-pane" type="button" role="tab"
                        aria-controls="proveedores-tab-pane" aria-selected="false">Proveedores</button>
                </li>
            @endif
        </ul>
        <div class="tab-content" id="miPanelContent">
            @if (auth()->user()->can('admin_formularios_ver_cliente') && auth()->user()->can('admin_formularios_ver_proveedor'))
                <div class="tab-pane show active" id="clientes-tab-pane" role="tabpanel" aria-labelledby="clientes-tab"
                    tabindex="0">

                    <!-- Tabla fantasma -->
                    <div class="table-responsive placeholder-glow mt-3" id="placeholder_cliente">
                        <table class="table align-middle">
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-12 py-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                        </table>
                    </div>
                    <!-- Tabla aplicaciones -->
                    <div class="table-responsive mt-3" id="tabla-formulario-conozca-cliente-container"
                        style="display: none;">

                        <!-- Titulo-->
                        <h1 class="pb-3">Formulario conozca a su cliente</h1>

                        <table id="tabla-conozca-cliente" class="table align-middle responsive display" width="100%">
                            <tbody></tbody>
                        </table>
                    </div>

                    <!-- Permisos -->
                    <x-widgets.roles.permisos />
                </div>
                <div class="tab-pane" id="proveedores-tab-pane" role="tabpanel" aria-labelledby="proveedores-tab"
                    tabindex="0">
                    <!-- Tabla fantasma -->
                    <div class="table-responsive placeholder-glow mt-3" id="placeholder_proveedor">
                        <table class="table align-middle">
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-12 py-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                        </table>
                    </div>

                    <!-- Tabla aplicaciones -->
                    <div class="table-responsive mt-3" id="tabla-formulario-conozca-proveedor-container"
                        style="display: none;">

                        <!-- Titulo-->
                        <h1 class="pb-3">Formulario conozca a su proveedor</h1>

                        <table id="tabla-conozca-proveedor" class="table align-middle responsive display" width="100%">
                            <tbody></tbody>
                        </table>
                    </div>

                    <!-- Permisos -->
                    <x-widgets.roles.permisos />
                </div>
            @elseif (auth()->user()->can('admin_formularios_ver_cliente'))
                <div class="tab-pane show active" id="clientes-tab-pane" role="tabpanel" aria-labelledby="clientes-tab"
                    tabindex="0">

                    <!-- Tabla fantasma -->
                    <div class="table-responsive placeholder-glow mt-3" id="placeholder_cliente">
                        <table class="table align-middle">
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-12 py-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                        </table>
                    </div>
                    <!-- Tabla aplicaciones -->
                    <div class="table-responsive mt-3" id="tabla-formulario-conozca-cliente-container"
                        style="display: none;">

                        <!-- Titulo-->
                        <h1 class="pb-3">Formulario conozca a su cliente</h1>

                        <table id="tabla-conozca-cliente" class="table align-middle responsive display" width="100%">
                            <tbody></tbody>
                        </table>
                    </div>

                    <!-- Permisos -->
                    <x-widgets.roles.permisos />
                </div>
            @elseif (auth()->user()->can('admin_formularios_ver_proveedor'))
                <div class="tab-pane active active" id="proveedores-tab-pane" role="tabpanel"
                    aria-labelledby="proveedores-tab" tabindex="0">
                    <!-- Tabla fantasma -->
                    <div class="table-responsive placeholder-glow mt-3" id="placeholder_proveedor">
                        <table class="table align-middle">
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-12 py-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                                <div class="col-md-3">
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                        </table>
                    </div>

                    <!-- Tabla aplicaciones -->
                    <div class="table-responsive mt-3" id="tabla-formulario-conozca-proveedor-container"
                        style="display: none;">

                        <!-- Titulo-->
                        <h1 class="pb-3">Formulario conozca a su proveedor</h1>

                        <table id="tabla-conozca-proveedor" class="table align-middle responsive display" width="100%">
                            <tbody></tbody>
                        </table>
                    </div>

                    <!-- Permisos -->
                    <x-widgets.roles.permisos />
                </div>
            @endif
        </div>
    </div>

    <x-formularios.formulario />

    <!-- Scripts -->
    <script async src="{{ asset('js/forms/conozca_cliente/tabla.js') }}"></script>
    <script async src="{{ asset('js/empresa/functions/funciones.js') }}"></script>

@endsection
