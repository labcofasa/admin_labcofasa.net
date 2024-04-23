<div class="d-none d-xl-block">
    <div class="row justify-content-between pb-3">
        <div class="encabezado">
            <h1>@yield('titulo')</h1>
            @if (auth()->user()->hasAnyPermission([
                        'admin_empresas_crear',
                        'admin_entidades_ver',
                        'admin_clasificaciones_ver',
                        'admin_giros_ver',
                        'admin_paises_ver',
                    ]))
                <button class="btn btn-lg btn-primary d-none d-xl-block dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false" ata-bs-auto-close="outside">
                    <div class="accion">
                        <svg class="icon-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                            height="24" color="#000000" fill="none">
                            <path
                                d="M2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path
                                d="M4.64856 5.07876C4.7869 4.93211 4.92948 4.7895 5.0761 4.65111M7.94733 2.72939C8.12884 2.6478 8.31313 2.57128 8.5 2.5M2.5 8.5C2.57195 8.31127 2.64925 8.12518 2.73172 7.94192"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 8V16M16 12L8 12" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Crear registro</span>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @can('admin_empresas_crear')
                        <li data-bs-toggle="modal" data-bs-target="#empresaModal">
                            <a class="dropdown-item nav-link" href="#">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24" color="#000000" fill="none">
                                    <path d="M15 2H9C5.69067 2 5 2.69067 5 6V22H19V6C19 2.69067 18.3093 2 15 2Z"
                                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                    <path d="M3 22H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M15 22V19C15 17.3453 14.6547 17 13 17H11C9.34533 17 9 17.3453 9 19V22"
                                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                    <path d="M13.5 6H10.5M13.5 9.5H10.5M13.5 13H10.5" stroke="currentColor" stroke-width="2"
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
                                        stroke="currentColor" stroke-width="2" />
                                    <path
                                        d="M12 22H18C19.8856 22 20.8284 22 21.4142 21.4142C22 20.8284 22 19.8856 22 18V12C22 10.1144 22 9.17157 21.4142 8.58579C20.8284 8 19.8856 8 18 8H12"
                                        stroke="currentColor" stroke-width="2" />
                                    <path d="M18.5 16H15.5M18.5 12L15.5 12" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                    <path d="M8.5 14H5.5M8.5 10H5.5M8.5 6H5.5" stroke="currentColor" stroke-width="2"
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
                                    <path d="M11 5L18 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M10 10L14.5 14.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M5 11L5 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <circle cx="6.44444" cy="6.44444" r="4.44444" stroke="currentColor"
                                        stroke-width="2" />
                                    <circle cx="5" cy="20" r="2" stroke="currentColor"
                                        stroke-width="2" />
                                    <circle cx="16" cy="16" r="2" stroke="currentColor"
                                        stroke-width="2" />
                                    <circle cx="20" cy="5" r="2" stroke="currentColor"
                                        stroke-width="2" />
                                </svg>
                                <span class="link">Clasificaciones</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin_giros_ver')
                        <li data-bs-toggle="modal" data-bs-target="#giroModal">
                            <a href="#" class="dropdown-item nav-link">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    width="24" height="24" color="#000000" fill="none">
                                    <path
                                        d="M11.0065 21H9.60546C6.02021 21 4.22759 21 3.11379 19.865C2 18.7301 2 16.9034 2 13.25C2 9.59661 2 7.76992 3.11379 6.63496C4.22759 5.5 6.02021 5.5 9.60546 5.5H13.4082C16.9934 5.5 18.7861 5.5 19.8999 6.63496C20.7568 7.50819 20.9544 8.7909 21 11"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    <path
                                        d="M20.0167 20.0233L21.9998 22M21.0528 17.5265C21.0528 15.5789 19.4739 14 17.5263 14C15.5786 14 13.9998 15.5789 13.9998 17.5265C13.9998 19.4742 15.5786 21.0531 17.5263 21.0531C19.4739 21.0531 21.0528 19.4742 21.0528 17.5265Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M15.9998 5.5L15.9004 5.19094C15.4054 3.65089 15.1579 2.88087 14.5686 2.44043C13.9794 2 13.1967 2 11.6313 2H11.3682C9.8028 2 9.02011 2 8.43087 2.44043C7.84162 2.88087 7.59411 3.65089 7.0991 5.19094L6.99976 5.5"
                                        stroke="currentColor" stroke-width="2" />
                                </svg>
                                <span class="link">Actividades económicas</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin_paises_ver')
                        <li data-bs-toggle="modal" data-bs-target="#paisModal">
                            <a href="#" class="dropdown-item nav-link">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    width="24" height="24" color="#000000" fill="none">
                                    <path
                                        d="M12 22C6.47715 22 2 17.5228 2 12C2 9.20746 3.14465 6.68227 4.99037 4.86802M12 22C11.037 21.2864 11.1907 20.4555 11.6738 19.6247C12.4166 18.3474 12.4166 18.3474 12.4166 16.6444C12.4166 14.9414 13.4286 14.1429 17 14.8571C18.6047 15.1781 19.7741 12.9609 21.8573 13.693M12 22C16.9458 22 21.053 18.4096 21.8573 13.693M21.8573 13.693C21.9511 13.1427 22 12.5771 22 12C22 7.11857 18.5024 3.05405 13.8766 2.17579M13.8766 2.17579C14.3872 3.11599 14.1816 4.23551 13.1027 4.66298C11.3429 5.3603 12.6029 6.64343 11.1035 7.4356C10.1038 7.96372 8.6044 7.83152 7.10496 6.24716C6.31517 5.41264 5.83966 4.95765 4.99037 4.86802M13.8766 2.17579C13.2687 2.06039 12.6414 2 12 2C9.26969 2 6.79495 3.09421 4.99037 4.86802"
                                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                </svg>
                                <span class="link">Localidades</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            @endif
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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                color="#000000" fill="none">
                <path d="M12 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M4 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    @endcan
    <ul class="dropdown-menu">
        @can('admin_giros_ver')
            <li>
                <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal" data-bs-target="#giroModal">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24" color="#000000" fill="none">
                        <path
                            d="M11.0065 21H9.60546C6.02021 21 4.22759 21 3.11379 19.865C2 18.7301 2 16.9034 2 13.25C2 9.59661 2 7.76992 3.11379 6.63496C4.22759 5.5 6.02021 5.5 9.60546 5.5H13.4082C16.9934 5.5 18.7861 5.5 19.8999 6.63496C20.7568 7.50819 20.9544 8.7909 21 11"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path
                            d="M20.0167 20.0233L21.9998 22M21.0528 17.5265C21.0528 15.5789 19.4739 14 17.5263 14C15.5786 14 13.9998 15.5789 13.9998 17.5265C13.9998 19.4742 15.5786 21.0531 17.5263 21.0531C19.4739 21.0531 21.0528 19.4742 21.0528 17.5265Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M15.9998 5.5L15.9004 5.19094C15.4054 3.65089 15.1579 2.88087 14.5686 2.44043C13.9794 2 13.1967 2 11.6313 2H11.3682C9.8028 2 9.02011 2 8.43087 2.44043C7.84162 2.88087 7.59411 3.65089 7.0991 5.19094L6.99976 5.5"
                            stroke="currentColor" stroke-width="2" />
                    </svg>
                    <span class="link">Actividades económicas</span>
                </a>
            </li>
        @endcan
        @can('admin_paises_ver')
            <li>
                <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal" data-bs-target="#paisModal">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24" color="#000000" fill="none">
                        <path
                            d="M12 22C6.47715 22 2 17.5228 2 12C2 9.20746 3.14465 6.68227 4.99037 4.86802M12 22C11.037 21.2864 11.1907 20.4555 11.6738 19.6247C12.4166 18.3474 12.4166 18.3474 12.4166 16.6444C12.4166 14.9414 13.4286 14.1429 17 14.8571C18.6047 15.1781 19.7741 12.9609 21.8573 13.693M12 22C16.9458 22 21.053 18.4096 21.8573 13.693M21.8573 13.693C21.9511 13.1427 22 12.5771 22 12C22 7.11857 18.5024 3.05405 13.8766 2.17579M13.8766 2.17579C14.3872 3.11599 14.1816 4.23551 13.1027 4.66298C11.3429 5.3603 12.6029 6.64343 11.1035 7.4356C10.1038 7.96372 8.6044 7.83152 7.10496 6.24716C6.31517 5.41264 5.83966 4.95765 4.99037 4.86802M13.8766 2.17579C13.2687 2.06039 12.6414 2 12 2C9.26969 2 6.79495 3.09421 4.99037 4.86802"
                            stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                    </svg>
                    <span class="link">Localidades</span>
                </a>
            </li>
        @endcan
        @can('admin_clasificaciones_ver')
            <li>
                <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal"
                    data-bs-target="#clasificacionModal">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24" color="#000000" fill="none">
                        <path d="M11 5L18 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M10 10L14.5 14.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M5 11L5 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <circle cx="6.44444" cy="6.44444" r="4.44444" stroke="currentColor" stroke-width="2" />
                        <circle cx="5" cy="20" r="2" stroke="currentColor" stroke-width="2" />
                        <circle cx="16" cy="16" r="2" stroke="currentColor" stroke-width="2" />
                        <circle cx="20" cy="5" r="2" stroke="currentColor" stroke-width="2" />
                    </svg>
                    <span class="link">Clasificaciones</span>
                </a>
            </li>
        @endcan
        @can('admin_entidades_ver')
            <li>
                <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal"
                    data-bs-target="#entidadModal">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24" color="#000000" fill="none">
                        <path
                            d="M12 22V6C12 4.11438 12 3.17157 11.4142 2.58579C10.8284 2 9.88562 2 8 2H6C4.11438 2 3.17157 2 2.58579 2.58579C2 3.17157 2 4.11438 2 6V18C2 19.8856 2 20.8284 2.58579 21.4142C3.17157 22 4.11438 22 6 22H12Z"
                            stroke="currentColor" stroke-width="2" />
                        <path
                            d="M12 22H18C19.8856 22 20.8284 22 21.4142 21.4142C22 20.8284 22 19.8856 22 18V12C22 10.1144 22 9.17157 21.4142 8.58579C20.8284 8 19.8856 8 18 8H12"
                            stroke="currentColor" stroke-width="2" />
                        <path d="M18.5 16H15.5M18.5 12L15.5 12" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <path d="M8.5 14H5.5M8.5 10H5.5M8.5 6H5.5" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                    <span class="link">Entidades</span>
                </a>
            </li>
        @endcan
        @can('admin_empresas_crear')
            <li>
                <a class="dropdown-item nav-link" href="#" data-bs-toggle="modal"
                    data-bs-target="#empresaModal">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24" color="#000000" fill="none">
                        <path d="M15 2H9C5.69067 2 5 2.69067 5 6V22H19V6C19 2.69067 18.3093 2 15 2Z"
                            stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                        <path d="M3 22H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M15 22V19C15 17.3453 14.6547 17 13 17H11C9.34533 17 9 17.3453 9 19V22"
                            stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                        <path d="M13.5 6H10.5M13.5 9.5H10.5M13.5 13H10.5" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                    <span class="link">Nueva empresa</span>
                </a>
            </li>
        @endcan
    </ul>
</div>
