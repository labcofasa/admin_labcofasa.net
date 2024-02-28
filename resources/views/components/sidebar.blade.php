<div class="offcanvas-body">
    <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                aria-current="page">
                <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                    width="24">
                    <path
                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h240v-560H200v560Zm320 0h240v-280H520v280Zm0-360h240v-200H520v200Z" />
                </svg>
                <span class="link">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('accesos') }}" class="nav-link {{ request()->routeIs('accesos') ? 'active' : '' }}"
                aria-current="page">
                <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                    width="24">
                    <path
                        d="M240-160q-33 0-56.5-23.5T160-240q0-33 23.5-56.5T240-320q33 0 56.5 23.5T320-240q0 33-23.5 56.5T240-160Zm240 0q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm240 0q-33 0-56.5-23.5T640-240q0-33 23.5-56.5T720-320q33 0 56.5 23.5T800-240q0 33-23.5 56.5T720-160ZM240-400q-33 0-56.5-23.5T160-480q0-33 23.5-56.5T240-560q33 0 56.5 23.5T320-480q0 33-23.5 56.5T240-400Zm240 0q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm240 0q-33 0-56.5-23.5T640-480q0-33 23.5-56.5T720-560q33 0 56.5 23.5T800-480q0 33-23.5 56.5T720-400ZM240-640q-33 0-56.5-23.5T160-720q0-33 23.5-56.5T240-800q33 0 56.5 23.5T320-720q0 33-23.5 56.5T240-640Zm240 0q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Zm240 0q-33 0-56.5-23.5T640-720q0-33 23.5-56.5T720-800q33 0 56.5 23.5T800-720q0 33-23.5 56.5T720-640Z" />
                </svg>
                <span class="link">Aplicaciones</span>
            </a>
        </li>
        <span class="link_name my-2 px-3">Administración</span>
        @can('admin_usuarios_ver')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                        height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
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
                    <span class="link">Usuarios</span>
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
                                enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#000000">
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
        @can('admin_aplicaciones_ver')
            <li class="nav-item">
                <a href="{{ route('pag.aplicaciones') }}"
                    class="nav-link {{ request()->routeIs('pag.aplicaciones') ? 'active' : '' }}">
                    <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
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
                    class="nav-link {{ request()->routeIs('pag.empresas') ? 'active' : '' }}" aria-current="page">
                    <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
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
                    class="nav-link {{ request()->routeIs('pag.papelera') ? 'active' : '' }}" aria-current="page">
                    <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z" />
                    </svg>
                    <span class="link">Papelera</span>
                </a>
            </li>
        @endcan
        <span class="link_name my-2 px-3">Ventas</span>
        <li class="nav-item">
            <a href="{{ route('pag.cliente') }}"
                class="nav-link {{ request()->routeIs('pag.cliente') ? 'active' : '' }}">
                <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                    height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                    <g>
                        <rect fill="none" height="24" width="24" />
                    </g>
                    <g>
                        <g />
                        <g>
                            <path
                                d="M21.9,8.89l-1.05-4.37c-0.22-0.9-1-1.52-1.91-1.52H5.05C4.15,3,3.36,3.63,3.15,4.52L2.1,8.89 c-0.24,1.02-0.02,2.06,0.62,2.88C2.8,11.88,2.91,11.96,3,12.06V19c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2v-6.94 c0.09-0.09,0.2-0.18,0.28-0.28C21.92,10.96,22.15,9.91,21.9,8.89z M18.91,4.99l1.05,4.37c0.1,0.42,0.01,0.84-0.25,1.17 C19.57,10.71,19.27,11,18.77,11c-0.61,0-1.14-0.49-1.21-1.14L16.98,5L18.91,4.99z M13,5h1.96l0.54,4.52 c0.05,0.39-0.07,0.78-0.33,1.07C14.95,10.85,14.63,11,14.22,11C13.55,11,13,10.41,13,9.69V5z M8.49,9.52L9.04,5H11v4.69 C11,10.41,10.45,11,9.71,11c-0.34,0-0.65-0.15-0.89-0.41C8.57,10.3,8.45,9.91,8.49,9.52z M4.04,9.36L5.05,5h1.97L6.44,9.86 C6.36,10.51,5.84,11,5.23,11c-0.49,0-0.8-0.29-0.93-0.47C4.03,10.21,3.94,9.78,4.04,9.36z M5,19v-6.03C5.08,12.98,5.15,13,5.23,13 c0.87,0,1.66-0.36,2.24-0.95c0.6,0.6,1.4,0.95,2.31,0.95c0.87,0,1.65-0.36,2.23-0.93c0.59,0.57,1.39,0.93,2.29,0.93 c0.84,0,1.64-0.35,2.24-0.95c0.58,0.59,1.37,0.95,2.24,0.95c0.08,0,0.15-0.02,0.23-0.03V19H5z" />
                        </g>
                    </g>
                </svg>
                <span class="link">Clientes</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pag.articulo') }}"
                class="nav-link {{ request()->routeIs('pag.articulo') ? 'active' : '' }}">
                <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                    width="24">
                    <path
                        d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z" />
                </svg>
                <span class="link">Artículos</span>
            </a>
        </li>
        @can('admin_avisos_ver')
            <li class="nav-item">
                <a href="{{ route('pag.aviso') }}"
                    class="nav-link {{ request()->routeIs('pag.aviso') ? 'active' : '' }}">
                    <svg class="icon pe-none" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm80 240v-80h400v80H280Zm0 160v-80h280v80H280Z" />
                    </svg>
                    <span class="link">Publicidad</span>
                </a>
            </li>
        @endcan
    </ul>
</div>
