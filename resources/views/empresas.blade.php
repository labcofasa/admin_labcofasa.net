@extends('layouts.autenticado')

@section('titulo', 'Empresas registradas')

@section('contenido')
    <div class="container-fluid main-container py-3">
        <div class="d-none d-xl-block">
            <div class="row justify-content-between py-3">
                <div class="col-md-4">
                    <h1>@yield('titulo')</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <button class="btn btn-lg btn-store gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" ata-bs-auto-close="outside" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                        </svg>
                        <span>
                            Crear registro
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li data-bs-toggle="modal" data-bs-target="#empresaModal">
                            <a class="dropdown-item nav-link" href="#">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z" />
                                </svg>
                                <span class="link">Nueva empresa</span>
                            </a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#entidadModal">
                            <a class="dropdown-item nav-link" href="#">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2l.01-11c0-1.11.88-2 1.99-2h4V4c0-1.11.89-2 2-2h4c1.11 0 2 .89 2 2v2h4z" />
                                </svg>
                                <span class="link">Entidades</span>
                            </a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#clasificacionModal">
                            <a class="dropdown-item nav-link" href="#">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M6,15c1.1,0,2,0.9,2,2s-0.9,2-2,2s-2-0.9-2-2S4.9,15,6,15 M6,13c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S8.2,13,6,13z M12,5 c1.1,0,2,0.9,2,2s-0.9,2-2,2s-2-0.9-2-2S10.9,5,12,5 M12,3C9.8,3,8,4.8,8,7s1.8,4,4,4s4-1.8,4-4S14.2,3,12,3z M18,15 c1.1,0,2,0.9,2,2s-0.9,2-2,2s-2-0.9-2-2S16.9,15,18,15 M18,13c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S20.2,13,18,13z" />
                                        </g>
                                    </g>
                                </svg>
                                <span class="link">Clasificaciones</span>
                            </a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#giroModal">
                            <a href="#" class="dropdown-item nav-link">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M3,9H1v11c0,1.11,0.89,2,2,2h17v-2H3V9z" />
                                            <path
                                                d="M18,5V3c0-1.1-0.9-2-2-2h-4c-1.1,0-2,0.9-2,2v2H5v11c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5H18z M12,3h4v2h-4V3z M21,16H7 V7h14V16z" />
                                        </g>
                                    </g>
                                </svg>
                                <span class="link">Actividades económicas</span>
                            </a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#paisModal">
                            <a href="#" class="dropdown-item nav-link">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24"
                                    viewBox="0 -960 960 960" width="24">
                                    <path
                                        d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-40-82v-78q-33 0-56.5-23.5T360-320v-40L168-552q-3 18-5.5 36t-2.5 36q0 121 79.5 212T440-162Zm276-102q20-22 36-47.5t26.5-53q10.5-27.5 16-56.5t5.5-59q0-98-54.5-179T600-776v16q0 33-23.5 56.5T520-680h-80v80q0 17-11.5 28.5T400-560h-80v80h240q17 0 28.5 11.5T600-440v120h40q26 0 47 15.5t29 40.5Z" />
                                </svg>

                                <span class="link">Localidades</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <h1 class="pb-3 d-xl-none">@yield('titulo')</h1>

        <x-skeleton />

        <div class="table-responsive rounded-3" id="tabla-empresas-container" style="display: none;">
            <table id="tabla-empresas" class="table align-middle responsive display" width="100%">
                <tbody></tbody>
            </table>
        </div>

        <div class="dropup">
            <button class="btn btn-lg d-xl-none gap-2 btn-float dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" data-bs-offset="0,7">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal" data-bs-target="#giroModal">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                            height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                            <g>
                                <rect fill="none" height="24" width="24" />
                            </g>
                            <g>
                                <g>
                                    <path d="M3,9H1v11c0,1.11,0.89,2,2,2h17v-2H3V9z" />
                                    <path
                                        d="M18,5V3c0-1.1-0.9-2-2-2h-4c-1.1,0-2,0.9-2,2v2H5v11c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5H18z M12,3h4v2h-4V3z M21,16H7 V7h14V16z" />
                                </g>
                            </g>
                        </svg>
                        <span class="link">Actividades económicas</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal" data-bs-target="#paisModal">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                            width="24">
                            <path
                                d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-40-82v-78q-33 0-56.5-23.5T360-320v-40L168-552q-3 18-5.5 36t-2.5 36q0 121 79.5 212T440-162Zm276-102q20-22 36-47.5t26.5-53q10.5-27.5 16-56.5t5.5-59q0-98-54.5-179T600-776v16q0 33-23.5 56.5T520-680h-80v80q0 17-11.5 28.5T400-560h-80v80h240q17 0 28.5 11.5T600-440v120h40q26 0 47 15.5t29 40.5Z" />
                        </svg>

                        <span class="link">Localidades</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#clasificacionModal">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                            height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                            <g>
                                <rect fill="none" height="24" width="24" />
                            </g>
                            <g>
                                <g>
                                    <path
                                        d="M6,15c1.1,0,2,0.9,2,2s-0.9,2-2,2s-2-0.9-2-2S4.9,15,6,15 M6,13c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S8.2,13,6,13z M12,5 c1.1,0,2,0.9,2,2s-0.9,2-2,2s-2-0.9-2-2S10.9,5,12,5 M12,3C9.8,3,8,4.8,8,7s1.8,4,4,4s4-1.8,4-4S14.2,3,12,3z M18,15 c1.1,0,2,0.9,2,2s-0.9,2-2,2s-2-0.9-2-2S16.9,15,18,15 M18,13c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S20.2,13,18,13z" />
                                </g>
                            </g>
                        </svg>
                        <span class="link">Clasificaciones</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#entidadModal">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                            width="24px" fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2l.01-11c0-1.11.88-2 1.99-2h4V4c0-1.11.89-2 2-2h4c1.11 0 2 .89 2 2v2h4z" />
                        </svg>
                        <span class="link">Entidades</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#empresaModal">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                            width="24px" fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z" />
                        </svg>
                        <span class="link">Nueva empresa</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Modal -->
    <x-empresa.empresa />
    <x-empresa.giro-empresa />
    <x-empresa.entidad-empresa />
    <x-empresa.pais-empresa />
    <x-empresa.departamento-empresa />
    <x-empresa.municipio-empresa />
    <x-empresa.clasificaciones-empresa />

    <x-notificaciones />

    <script src="{{ asset('js/empresa/empresa.js') }}"></script>
@endsection
