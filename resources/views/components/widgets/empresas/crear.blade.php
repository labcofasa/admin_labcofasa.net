<div class="d-none d-xl-block">
    <div class="row justify-content-between pb-3 align-items-end">
        <div class="col-md-4">
            <h1>@yield('titulo')</h1>
        </div>
        <div class="col-md-4 d-flex justify-content-end">
            @if (auth()->user()->hasAnyPermission([
                        'admin_empresas_crear',
                        'admin_entidades_ver',
                        'admin_clasificaciones_ver',
                        'admin_giros_ver',
                        'admin_paises_ver',
                    ]))
                <button class="btn btn-lg btn-store gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" ata-bs-auto-close="outside" aria-expanded="false">
                    <svg class="icon-add-empresa" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                        width="24px" fill="#ffffff">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                    </svg>
                    <span class="action-title">Crear registro</span>
                </button>
            @endif
            <ul class="dropdown-menu dropdown-menu-end">
                @can('admin_empresas_crear')
                    <li data-bs-toggle="modal" data-bs-target="#empresaModal">
                        <a class="dropdown-item nav-link" href="#">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" color="#000000" fill="none">
                                <path d="M15 2H9C5.69067 2 5 2.69067 5 6V22H19V6C19 2.69067 18.3093 2 15 2Z"
                                    stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                <path d="M3 22H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15 22V19C15 17.3453 14.6547 17 13 17H11C9.34533 17 9 17.3453 9 19V22"
                                    stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                <path d="M13.5 6H10.5M13.5 9.5H10.5M13.5 13H10.5" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                            <span class="link">Nueva empresa</span>
                        </a>
                    </li>
                @endcan
                @can('admin_entidades_ver')
                    <li data-bs-toggle="modal" data-bs-target="#entidadModal">
                        <a class="dropdown-item nav-link" href="#">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" color="#000000" fill="none">
                                <path
                                    d="M12 22V6C12 4.11438 12 3.17157 11.4142 2.58579C10.8284 2 9.88562 2 8 2H6C4.11438 2 3.17157 2 2.58579 2.58579C2 3.17157 2 4.11438 2 6V18C2 19.8856 2 20.8284 2.58579 21.4142C3.17157 22 4.11438 22 6 22H12Z"
                                    stroke="currentColor" stroke-width="1.8" />
                                <path
                                    d="M12 22H18C19.8856 22 20.8284 22 21.4142 21.4142C22 20.8284 22 19.8856 22 18V12C22 10.1144 22 9.17157 21.4142 8.58579C20.8284 8 19.8856 8 18 8H12"
                                    stroke="currentColor" stroke-width="1.8" />
                                <path d="M18.5 16H15.5M18.5 12L15.5 12" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                                <path d="M8.5 14H5.5M8.5 10H5.5M8.5 6H5.5" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                            <span class="link">Entidades</span>
                        </a>
                    </li>
                @endcan
                @can('admin_clasificaciones_ver')
                    <li data-bs-toggle="modal" data-bs-target="#clasificacionModal">
                        <a class="dropdown-item nav-link" href="#">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" color="#000000" fill="none">
                                <path d="M11 5L18 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M10 10L14.5 14.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M5 11L5 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <circle cx="6.44444" cy="6.44444" r="4.44444" stroke="currentColor"
                                    stroke-width="1.8" />
                                <circle cx="5" cy="20" r="2" stroke="currentColor" stroke-width="1.8" />
                                <circle cx="16" cy="16" r="2" stroke="currentColor" stroke-width="1.8" />
                                <circle cx="20" cy="5" r="2" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                            <span class="link">Clasificaciones</span>
                        </a>
                    </li>
                @endcan
                @can('admin_giros_ver')
                    <li data-bs-toggle="modal" data-bs-target="#giroModal">
                        <a href="#" class="dropdown-item nav-link">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" color="#000000" fill="none">
                                <path
                                    d="M11.0065 21H9.60546C6.02021 21 4.22759 21 3.11379 19.865C2 18.7301 2 16.9034 2 13.25C2 9.59661 2 7.76992 3.11379 6.63496C4.22759 5.5 6.02021 5.5 9.60546 5.5H13.4082C16.9934 5.5 18.7861 5.5 19.8999 6.63496C20.7568 7.50819 20.9544 8.7909 21 11"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                <path
                                    d="M20.0167 20.0233L21.9998 22M21.0528 17.5265C21.0528 15.5789 19.4739 14 17.5263 14C15.5786 14 13.9998 15.5789 13.9998 17.5265C13.9998 19.4742 15.5786 21.0531 17.5263 21.0531C19.4739 21.0531 21.0528 19.4742 21.0528 17.5265Z"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M15.9998 5.5L15.9004 5.19094C15.4054 3.65089 15.1579 2.88087 14.5686 2.44043C13.9794 2 13.1967 2 11.6313 2H11.3682C9.8028 2 9.02011 2 8.43087 2.44043C7.84162 2.88087 7.59411 3.65089 7.0991 5.19094L6.99976 5.5"
                                    stroke="currentColor" stroke-width="1.8" />
                            </svg>
                            <span class="link">Actividades económicas</span>
                        </a>
                    </li>
                @endcan
                @can('admin_paises_ver')
                    <li data-bs-toggle="modal" data-bs-target="#paisModal">
                        <a href="#" class="dropdown-item nav-link">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" color="#000000" fill="none">
                                <path
                                    d="M12 22C6.47715 22 2 17.5228 2 12C2 9.20746 3.14465 6.68227 4.99037 4.86802M12 22C11.037 21.2864 11.1907 20.4555 11.6738 19.6247C12.4166 18.3474 12.4166 18.3474 12.4166 16.6444C12.4166 14.9414 13.4286 14.1429 17 14.8571C18.6047 15.1781 19.7741 12.9609 21.8573 13.693M12 22C16.9458 22 21.053 18.4096 21.8573 13.693M21.8573 13.693C21.9511 13.1427 22 12.5771 22 12C22 7.11857 18.5024 3.05405 13.8766 2.17579M13.8766 2.17579C14.3872 3.11599 14.1816 4.23551 13.1027 4.66298C11.3429 5.3603 12.6029 6.64343 11.1035 7.4356C10.1038 7.96372 8.6044 7.83152 7.10496 6.24716C6.31517 5.41264 5.83966 4.95765 4.99037 4.86802M13.8766 2.17579C13.2687 2.06039 12.6414 2 12 2C9.26969 2 6.79495 3.09421 4.99037 4.86802"
                                    stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                            </svg>
                            <span class="link">Localidades</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>

<div class="dropup d-xl-none">
    @if (auth()->user()->hasAnyPermission([
                'admin_empresas_crear',
                'admin_entidades_ver',
                'admin_clasificaciones_ver',
                'admin_giros_ver',
                'admin_paises_ver',
            ]))
        <button class="btn btn-lg gap-2 btn-float dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" data-bs-offset="0,7">
            <svg class="icon-add-empresa" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                width="24px" fill="#ffffff">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z" />
            </svg>
        </button>
    @endcan
    <ul class="dropdown-menu">
        @can('admin_giros_ver')
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
        @endcan
        @can('admin_paises_ver')
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
        @endcan
        @can('admin_clasificaciones_ver')
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
        @endcan
        @can('admin_entidades_ver')
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
        @endcan
        @can('admin_empresas_crear')
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
        @endcan
    </ul>
</div>
