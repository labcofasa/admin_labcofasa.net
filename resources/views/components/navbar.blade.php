<nav class="navbar navbar-movil fixed-top" aria-label="Menu">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <svg class="icon menu-btn" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                width="24px" fill="#000000">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M4 18h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1zm0-5h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1zM3 7c0 .55.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1z" />
            </svg>
        </button>

        <div class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="logotipo mx-3" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60.5 86.3"
                style="enable-background:new 0 0 60.5 86.3;" xml:space="preserve">
                <path class="st0" d="M24.3,1.7c-1-0.4-2.1-0.4-3,0.2c-1.1,0.8-1.2,2.1-0.4,3.8c0.5,1,1.2,2,2.2,2.8c0.5,0.5,0.9,1.2,0.9,2l0.8,14.8
               c0,0.5-0.1,1.1-0.3,1.6L3,68.1c0,0.1-0.1,0.2-0.1,0.3C-2,80,6.7,86.6,18.1,82.9l33.5-9.5c7.4-2.2,9.1-8,4.8-17.5
               c0-0.1-0.1-0.1-0.1-0.2l-7.9-22.2c-0.1-0.3-0.2-0.7-0.2-1L48.1,22c0-1.1,0.5-2.1,1.4-2.6c1.4-0.8,2-2.2,0.6-4.4
               c-1.3-1.7-5.8-3.9-10.3-5.9L24.3,1.7z" />
            </svg>
            <span class="logo-nombre">Cofasa</span>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <a href="/"
                    class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg class="logotipo me-3" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60.5 86.3"
                        style="enable-background:new 0 0 60.5 86.3;" xml:space="preserve">
                        <path class="st0" d="M24.3,1.7c-1-0.4-2.1-0.4-3,0.2c-1.1,0.8-1.2,2.1-0.4,3.8c0.5,1,1.2,2,2.2,2.8c0.5,0.5,0.9,1.2,0.9,2l0.8,14.8
               c0,0.5-0.1,1.1-0.3,1.6L3,68.1c0,0.1-0.1,0.2-0.1,0.3C-2,80,6.7,86.6,18.1,82.9l33.5-9.5c7.4-2.2,9.1-8,4.8-17.5
               c0-0.1-0.1-0.1-0.1-0.2l-7.9-22.2c-0.1-0.3-0.2-0.7-0.2-1L48.1,22c0-1.1,0.5-2.1,1.4-2.6c1.4-0.8,2-2.2,0.6-4.4
               c-1.3-1.7-5.8-3.9-10.3-5.9L24.3,1.7z" />
                    </svg>
                    <span class="logo-nombre">Cofasa</span>
                </a>
                <button class="btn-icon-close" data-bs-dismiss="offcanvas">
                    <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                    </svg>
                </button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a href="{{ route('inicio') }}"
                            class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}" aria-current="page">
                            <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z" />
                            </svg>
                            <span class="link">Inicio</span>
                        </a>
                    </li>
                    @can('admin_usuarios_ver')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg"
                                    enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
                                    fill="#000000">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M4,18v-0.65c0-0.34,0.16-0.66,0.41-0.81C6.1,15.53,8.03,15,10,15c0.03,0,0.05,0,0.08,0.01c0.1-0.7,0.3-1.37,0.59-1.98 C10.45,13.01,10.23,13,10,13c-2.42,0-4.68,0.67-6.61,1.82C2.51,15.34,2,16.32,2,17.35V20h9.26c-0.42-0.6-0.75-1.28-0.97-2H4z" />
                                            <path
                                                d="M10,12c2.21,0,4-1.79,4-4s-1.79-4-4-4C7.79,4,6,5.79,6,8S7.79,12,10,12z M10,6c1.1,0,2,0.9,2,2s-0.9,2-2,2 c-1.1,0-2-0.9-2-2S8.9,6,10,6z" />
                                            <path
                                                d="M20.75,16c0-0.22-0.03-0.42-0.06-0.63l1.14-1.01l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L18,11h-2l-0.3,1.49 c-0.4,0.15-0.76,0.36-1.08,0.63l-1.45-0.49l-1,1.73l1.14,1.01c-0.03,0.21-0.06,0.41-0.06,0.63s0.03,0.42,0.06,0.63l-1.14,1.01 l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L16,21h2l0.3-1.49c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1.01 C20.72,16.42,20.75,16.22,20.75,16z M17,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S18.1,18,17,18z" />
                                        </g>
                                    </g>
                                </svg>
                                <span class="link">Administrar usuarios</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item {{ request()->routeIs('pag.usuarios') ? 'active' : '' }}"
                                        href="{{ route('pag.usuarios') }}">
                                        <svg class="icon pe-none me-2" xmlns="http://www.w3.org/2000/svg" height="24px"
                                            viewBox="0 0 24 24" width="24px" fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path
                                                d="M9 13.75c-2.34 0-7 1.17-7 3.5V19h14v-1.75c0-2.33-4.66-3.5-7-3.5zM4.34 17c.84-.58 2.87-1.25 4.66-1.25s3.82.67 4.66 1.25H4.34zM9 12c1.93 0 3.5-1.57 3.5-3.5S10.93 5 9 5 5.5 6.57 5.5 8.5 7.07 12 9 12zm0-5c.83 0 1.5.67 1.5 1.5S9.83 10 9 10s-1.5-.67-1.5-1.5S8.17 7 9 7zm7.04 6.81c1.16.84 1.96 1.96 1.96 3.44V19h4v-1.75c0-2.02-3.5-3.17-5.96-3.44zM15 12c1.93 0 3.5-1.57 3.5-3.5S16.93 5 15 5c-.54 0-1.04.13-1.5.35.63.89 1 1.98 1 3.15s-.37 2.26-1 3.15c.46.22.96.35 1.5.35z" />
                                        </svg>
                                        <span class="link">Usuarios</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item {{ request()->routeIs('pag.roles') ? 'active' : '' }}"
                                        href="{{ route('pag.roles') }}">
                                        <svg class="icon pe-none me-2" xmlns="http://www.w3.org/2000/svg" height="24px"
                                            viewBox="0 0 24 24" width="24px" fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path
                                                d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2m0-12C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                        <span class="links">Roles</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item {{ request()->routeIs('pag.permisos') ? 'active' : '' }}"
                                        href="{{ route('pag.permisos') }}">
                                        <svg class="icon pe-none me-2" xmlns="http://www.w3.org/2000/svg"
                                            enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24"
                                            width="24px" fill="#000000">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                            </g>
                                            <g>
                                                <g>
                                                    <circle cx="17" cy="15.5" fill-rule="evenodd" r="1.12" />
                                                    <path
                                                        d="M17,17.5c-0.73,0-2.19,0.36-2.24,1.08c0.5,0.71,1.32,1.17,2.24,1.17 s1.74-0.46,2.24-1.17C19.19,17.86,17.73,17.5,17,17.5z"
                                                        fill-rule="evenodd" />
                                                    <path
                                                        d="M18,11.09V6.27L10.5,3L3,6.27v4.91c0,4.54,3.2,8.79,7.5,9.82 c0.55-0.13,1.08-0.32,1.6-0.55C13.18,21.99,14.97,23,17,23c3.31,0,6-2.69,6-6C23,14.03,20.84,11.57,18,11.09z M11,17 c0,0.56,0.08,1.11,0.23,1.62c-0.24,0.11-0.48,0.22-0.73,0.3c-3.17-1-5.5-4.24-5.5-7.74v-3.6l5.5-2.4l5.5,2.4v3.51 C13.16,11.57,11,14.03,11,17z M17,21c-2.21,0-4-1.79-4-4c0-2.21,1.79-4,4-4s4,1.79,4,4C21,19.21,19.21,21,17,21z"
                                                        fill-rule="evenodd" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="links">Permisos</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('admin_ver_aplicaciones')
                        <li class="nav-item">
                            <a href="{{ route('pag.aplicaciones') }}"
                                class="nav-link {{ request()->routeIs('pag.aplicaciones') ? 'active' : '' }}">
                                <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z" />
                                </svg>
                                <span class="link">Aplicaciones</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin_empresas_ver')
                        <li class="nav-item">
                            <a href="{{ route('pag.empresas') }}"
                                class="nav-link {{ request()->routeIs('pag.empresas') ? 'active' : '' }}"
                                aria-current="page">
                                <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2l.01-11c0-1.11.88-2 1.99-2h4V4c0-1.11.89-2 2-2h4c1.11 0 2 .89 2 2v2h4z" />
                                </svg>
                                <span class="link">Empresas</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin_papelera_ver')
                        <li class="nav-item">
                            <a href="{{ route('pag.papelera') }}"
                                class="nav-link {{ request()->routeIs('pag.papelera') ? 'active' : '' }}"
                                aria-current="page">
                                <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z" />
                                </svg>
                                <span class="link">Papelera</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>

        <div class="d-flex align-items-center">

            {{-- <button class="navbar-toggler position-relative" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
                <svg class="icon me-1" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                    width="24px" fill="#000000">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z" />
                </svg>
            </button>

            <div class="vr mx-3 mx-lg-3"></div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h6 class="offcanvas-title" id="offcanvasRightLabel">Notificaciones <span
                            class="badge bg-danger">3</span></h6>
                    <button class="btn-icon-close" data-bs-dismiss="offcanvas">
                        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px"
                            viewBox="0 0 24 24" width="24px" fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                        </svg>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                            aria-current="true">
                            <img src="{{ asset('images/logo.svg') }}" alt="twbs" width="32" height="32"
                                class="rounded-circle flex-shrink-0">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Titulo de notificación</h6>
                                    <p class="mb-0 opacity-75">Cuerpo de la notifiación</p>
                                </div>
                                <small class="opacity-50 text-nowrap">ahora</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                            aria-current="true">
                            <img src="{{ asset('images/logo.svg') }}" alt="twbs" width="32" height="32"
                                class="rounded-circle flex-shrink-0">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Titulo de notificación</h6>
                                    <p class="mb-0 opacity-75">Cuerpo de la notifiación</p>
                                </div>
                                <small class="opacity-50 text-nowrap">3d</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                            aria-current="true">
                            <img src="{{ asset('images/logo.svg') }}" alt="twbs" width="32" height="32"
                                class="rounded-circle flex-shrink-0">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Titulo de notificación</h6>
                                    <p class="mb-0 opacity-75">Cuerpo de la notifiación</p>
                                </div>
                                <small class="opacity-50 text-nowrap">1s</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div> --}}

            <div class="flex-shrink-0 dropdown perfil-usuario me-1">
                <a href="#" id="dropdown-perfil"
                    class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    @if ($usuario->perfil->imagen)
                        <img class="icono-perfil rounded-circle"
                            src="{{ asset('images/usuarios/' . $usuario->perfil->id . '/' . $usuario->perfil->imagen) }}"
                            alt="Foto de perfil">
                    @else
                        <img class="icono-perfil rounded-circle" src="{{ asset('images/defecto.png') }}"
                            alt="">
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item nav-link {{ request()->routeIs('pag.cuenta') ? 'active' : '' }}"
                            href="{{ route('pag.cuenta') }}">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <g>
                                    <rect fill="none" height="24" width="24" />
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.35 18.5C8.66 17.56 10.26 17 12 17s3.34.56 4.65 1.5c-1.31.94-2.91 1.5-4.65 1.5s-3.34-.56-4.65-1.5zm10.79-1.38C16.45 15.8 14.32 15 12 15s-4.45.8-6.14 2.12C4.7 15.73 4 13.95 4 12c0-4.42 3.58-8 8-8s8 3.58 8 8c0 1.95-.7 3.73-1.86 5.12z" />
                                        <path
                                            d="M12 6c-1.93 0-3.5 1.57-3.5 3.5S10.07 13 12 13s3.5-1.57 3.5-3.5S13.93 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z" />
                                    </g>
                                </g>
                            </svg>
                            <span class="link">Mi cuenta</span>
                        </a>
                    </li>
                    <li class="nav-item toggle-darkmode">
                        <div class="dropdown-item d-flex align-items-center">
                            <svg class="icon dropdown-icon dark" xmlns="http://www.w3.org/2000/svg"
                                enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#000000">
                                <rect fill="none" height="24" width="24" />
                                <path
                                    d="M9.37,5.51C9.19,6.15,9.1,6.82,9.1,7.5c0,4.08,3.32,7.4,7.4,7.4c0.68,0,1.35-0.09,1.99-0.27C17.45,17.19,14.93,19,12,19 c-3.86,0-7-3.14-7-7C5,9.07,6.81,6.55,9.37,5.51z M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36 c-0.98,1.37-2.58,2.26-4.4,2.26c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z" />
                            </svg>
                            <svg class="icon dropdown-icon light" xmlns="http://www.w3.org/2000/svg"
                                enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#000000">
                                <rect fill="none" height="24" width="24" />
                                <path
                                    d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5 S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1 s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0 c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95 c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41 L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41 s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06 c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z" />
                            </svg>
                            <div class="toggle-switch2" id="toggle-switch-nav2">
                                <div class="toggle-container d-flex align-items-center">
                                    <span class="mode-text mr-1">Tema oscuro</span>
                                    <span class="switch2"></span>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- <li>
                        <a class="dropdown-item nav-link {{ request()->routeIs('pag.ajustes') ? 'active' : '' }}"
                            href="{{ route('pag.ajustes') }}">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                            </svg>
                            <span class="link">Configuración</span>
                        </a>
                    </li> --}}
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item nav-link" href="{{ route('cerrar.sesion') }}">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <g>
                                    <path d="M0,0h24v24H0V0z" fill="none" />
                                </g>
                                <g>
                                    <path
                                        d="M17,8l-1.41,1.41L17.17,11H9v2h8.17l-1.58,1.58L17,16l4-4L17,8z M5,5h7V3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h7v-2H5V5z" />
                                </g>
                            </svg>
                            <span class="link">Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<section class="overlay"></section>
