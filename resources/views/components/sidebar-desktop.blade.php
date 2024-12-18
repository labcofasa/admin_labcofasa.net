<nav class="sidebar-desktop">
    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <span class="link_name subtitle">Menú</span>
                @can('admin_dashboard_ver')
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                color="#000000" fill="none">
                                <path
                                    d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M2.5 9H21.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M6.99981 6H7.00879" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M10.9998 6H11.0088" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M17 17C17 14.2386 14.7614 12 12 12C9.23858 12 7 14.2386 7 17" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" />
                                <path d="M12.707 15.293L11.2928 16.7072" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="link_name">Dashboard</span>
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{ route('accesos') }}"
                        class="nav-link {{ request()->routeIs('accesos') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                            color="#000000" fill="none">
                            <path
                                d="M2 18C2 16.4596 2 15.6893 2.34673 15.1235C2.54074 14.8069 2.80693 14.5407 3.12353 14.3467C3.68934 14 4.45956 14 6 14C7.54044 14 8.31066 14 8.87647 14.3467C9.19307 14.5407 9.45926 14.8069 9.65327 15.1235C10 15.6893 10 16.4596 10 18C10 19.5404 10 20.3107 9.65327 20.8765C9.45926 21.1931 9.19307 21.4593 8.87647 21.6533C8.31066 22 7.54044 22 6 22C4.45956 22 3.68934 22 3.12353 21.6533C2.80693 21.4593 2.54074 21.1931 2.34673 20.8765C2 20.3107 2 19.5404 2 18Z"
                                stroke="currentColor" stroke-width="1.8" />
                            <path
                                d="M14 18C14 16.4596 14 15.6893 14.3467 15.1235C14.5407 14.8069 14.8069 14.5407 15.1235 14.3467C15.6893 14 16.4596 14 18 14C19.5404 14 20.3107 14 20.8765 14.3467C21.1931 14.5407 21.4593 14.8069 21.6533 15.1235C22 15.6893 22 16.4596 22 18C22 19.5404 22 20.3107 21.6533 20.8765C21.4593 21.1931 21.1931 21.4593 20.8765 21.6533C20.3107 22 19.5404 22 18 22C16.4596 22 15.6893 22 15.1235 21.6533C14.8069 21.4593 14.5407 21.1931 14.3467 20.8765C14 20.3107 14 19.5404 14 18Z"
                                stroke="currentColor" stroke-width="1.8" />
                            <path
                                d="M2 6C2 4.45956 2 3.68934 2.34673 3.12353C2.54074 2.80693 2.80693 2.54074 3.12353 2.34673C3.68934 2 4.45956 2 6 2C7.54044 2 8.31066 2 8.87647 2.34673C9.19307 2.54074 9.45926 2.80693 9.65327 3.12353C10 3.68934 10 4.45956 10 6C10 7.54044 10 8.31066 9.65327 8.87647C9.45926 9.19307 9.19307 9.45926 8.87647 9.65327C8.31066 10 7.54044 10 6 10C4.45956 10 3.68934 10 3.12353 9.65327C2.80693 9.45926 2.54074 9.19307 2.34673 8.87647C2 8.31066 2 7.54044 2 6Z"
                                stroke="currentColor" stroke-width="1.8" />
                            <path
                                d="M14 6C14 4.45956 14 3.68934 14.3467 3.12353C14.5407 2.80693 14.8069 2.54074 15.1235 2.34673C15.6893 2 16.4596 2 18 2C19.5404 2 20.3107 2 20.8765 2.34673C21.1931 2.54074 21.4593 2.80693 21.6533 3.12353C22 3.68934 22 4.45956 22 6C22 7.54044 22 8.31066 21.6533 8.87647C21.4593 9.19307 21.1931 9.45926 20.8765 9.65327C20.3107 10 19.5404 10 18 10C16.4596 10 15.6893 10 15.1235 9.65327C14.8069 9.45926 14.5407 9.19307 14.3467 8.87647C14 8.31066 14 7.54044 14 6Z"
                                stroke="currentColor" stroke-width="1.8" />
                        </svg>
                        <span class="link_name">Aplicaciones</span>
                    </a>
                </li>
                @can('admin_formularios_ver')
                    <li>
                        <a href="{{ route('pag.formularios') }}"
                            class="nav-link {{ request()->routeIs('pag.formularios') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                color="#000000" fill="none">
                                <path
                                    d="M2 12.4C2 9.38301 2 7.87452 2.94627 6.93726C3.89254 6 5.41554 6 8.46154 6H9.53846C12.5845 6 14.1075 6 15.0537 6.93726C16 7.87452 16 9.38301 16 12.4V15.6C16 18.617 16 20.1255 15.0537 21.0627C14.1075 22 12.5845 22 9.53846 22H8.46154C5.41554 22 3.89254 22 2.94627 21.0627C2 20.1255 2 18.617 2 15.6V12.4Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                <path
                                    d="M15.5376 16H16.4608C19.072 16 20.3776 16 21.1888 15.1799C22 14.3598 22 13.0399 22 10.4V7.6C22 4.96013 22 3.6402 21.1888 2.8201C20.3776 2 19.072 2 16.4608 2H15.5376C12.9264 2 11.6208 2 10.8096 2.8201C10.1002 3.53726 10.0112 4.63664 10 6.66667"
                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M6 12H9M6 17H11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M10.5 3L14.5 6.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="link_name">Formularios</span>
                        </a>
                    </li>
                @endcan
                @if (auth()->user()->hasAnyPermission([
                            'admin_empresas_ver',
                            'admin_usuarios_ver',
                            'admin_empresas_ver',
                            'admin_aplicaciones_ver',
                            'admin_clientes_ver',
                            'admin_articulos_ver',
                            'admin_avisos_ver',
                            'admin_papelera_ver',
                        ]))
                    <span class="link_name subtitle">Empleos</span>
                @endif
                @can('admin_vacantes_ver')
                    <li>
                        <a href="{{ route('pag.vacantes') }}"
                            class="nav-link {{ request()->routeIs('pag.vacantes') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                color="#000000" fill="none">
                                {{-- Suit case --}}
                                <path
                                    d="M11.0065 21H9.60546C6.02021 21 4.22759 21 3.11379 19.865C2 18.7301 2 16.9034 2 13.25C2 9.59661 2 7.76992 3.11379 6.63496C4.22759 5.5 6.02021 5.5 9.60546 5.5H13.4082C16.9934 5.5 18.7861 5.5 19.8999 6.63496C20.7568 7.50819 20.9544 8.7909 21 11"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                {{-- lupa --}}
                                <path
                                    d="M20.0167 20.0233L21.9998 22M21.0528 17.5265C21.0528 15.5789 19.4739 14 17.5263 14C15.5786 14 13.9998 15.5789 13.9998 17.5265C13.9998 19.4742 15.5786 21.0531 17.5263 21.0531C19.4739 21.0531 21.0528 19.4742 21.0528 17.5265Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                {{-- manija --}}
                                <path
                                    d="M15.9998 5.5L15.9004 5.19094C15.4054 3.65089 15.1579 2.88087 14.5686 2.44043C13.9794 2 13.1967 2 11.6313 2H11.3682C9.8028 2 9.02011 2 8.43087 2.44043C7.84162 2.88087 7.59411 3.65089 7.0991 5.19094L6.99976 5.5"
                                    stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <span class="link_name">Vacantes</span>
                        </a>
                    </li>
                @endcan
                @can('admin_encuestas_ver')
                <li>
                    {{-- iconos con Fonts Awesome (más parecido a original) 27 de strokewidth --}}
                    <a href="{{ route('pag.encuesta') }}"
                        class="nav-link {{ request()->routeIs('pag.encuesta') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24" height="24"
                            color="#000000" fill="none" class="icon">
                            <path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM325.8 139.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-21.4 21.4-71-71 21.4-21.4c15.6-15.6 40.9-15.6 56.6 0zM119.9 289L225.1 183.8l71 71L190.9 359.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"
                            stroke="currentColor" stroke-width="27"
                            />
                            
                        </svg>
                        <span class="link_name">Encuesta</span>
                    </a>
                </li>
                @endcan
            </ul>
            <ul class="menu-links">
                @if (auth()->user()->hasAnyPermission([
                            'admin_empresas_ver',
                            'admin_usuarios_ver',
                            'admin_empresas_ver',
                            'admin_aplicaciones_ver',
                            'admin_clientes_ver',
                            'admin_articulos_ver',
                            'admin_avisos_ver',
                            'admin_papelera_ver',
                        ]))
                    <span class="link_name subtitle">Administración</span>
                @endif
                @can('admin_usuarios_ver')
                    <li class="pt-1">
                        <div class="menus {{ request()->routeIs('pag.usuarios') ? 'active' : '' }}">
                            <a href="{{ route('pag.usuarios') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    color="#000000" fill="none">
                                    <path
                                        d="M12.5 22H6.59087C5.04549 22 3.81631 21.248 2.71266 20.1966C0.453365 18.0441 4.1628 16.324 5.57757 15.4816C7.67837 14.2307 10.1368 13.7719 12.5 14.1052C13.3575 14.2261 14.1926 14.4514 15 14.7809"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M16.5 6.5C16.5 8.98528 14.4853 11 12 11C9.51472 11 7.5 8.98528 7.5 6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path d="M18.5 22L18.5 15M15 18.5H22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="link_name">Usuarios</span>
                            </a>
                            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" color="#000000" fill="none">
                                <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <ul class="sub-menu">
                            @can('admin_roles_ver')
                                <li>
                                    <a href="{{ route('pag.roles') }}"
                                        class="nav-link {{ request()->routeIs('pag.roles') ? 'active' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" color="#000000" fill="none">
                                            <path
                                                d="M11.5 14.0116C9.45338 13.9164 7.38334 14.4064 5.57757 15.4816C4.1628 16.324 0.453365 18.0441 2.71266 20.1966C3.81631 21.248 5.04549 22 6.59087 22H12"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M15.5 6.5C15.5 8.98528 13.4853 11 11 11C8.51472 11 6.5 8.98528 6.5 6.5C6.5 4.01472 8.51472 2 11 2C13.4853 2 15.5 4.01472 15.5 6.5Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path
                                                d="M18 20.7143V22M18 20.7143C16.8432 20.7143 15.8241 20.1461 15.2263 19.2833M18 20.7143C19.1568 20.7143 20.1759 20.1461 20.7737 19.2833M18 14.2857C19.1569 14.2857 20.1761 14.854 20.7738 15.7169M18 14.2857C16.8431 14.2857 15.8239 14.854 15.2262 15.7169M18 14.2857V13M22 14.9286L20.7738 15.7169M14.0004 20.0714L15.2263 19.2833M14 14.9286L15.2262 15.7169M21.9996 20.0714L20.7737 19.2833M20.7738 15.7169C21.1273 16.2271 21.3333 16.8403 21.3333 17.5C21.3333 18.1597 21.1272 18.773 20.7737 19.2833M15.2262 15.7169C14.8727 16.2271 14.6667 16.8403 14.6667 17.5C14.6667 18.1597 14.8728 18.773 15.2263 19.2833"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                        <span class="links">Roles</span>
                                    </a>
                                </li>
                            @endcan
                            @can('admin_permisos_ver')
                                <li>
                                    <a href="{{ route('pag.permisos') }}"
                                        class="nav-link {{ request()->routeIs('pag.permisos') ? 'active' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" color="#000000" fill="none">
                                            <path
                                                d="M12 14.0466C9.7927 13.8404 7.53058 14.3187 5.57757 15.4816C4.1628 16.324 0.453365 18.0441 2.71266 20.1966C3.81631 21.248 5.04549 22 6.59087 22H13"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M15.5 6.5C15.5 8.98528 13.4853 11 11 11C8.51472 11 6.5 8.98528 6.5 6.5C6.5 4.01472 8.51472 2 11 2C13.4853 2 15.5 4.01472 15.5 6.5Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path
                                                d="M17.9992 14C16.7328 14 15.9117 14.8076 14.9405 15.102C14.5456 15.2217 14.3482 15.2815 14.2683 15.3659C14.1884 15.4502 14.165 15.5735 14.1182 15.8201C13.6174 18.4584 14.712 20.8976 17.3222 21.847C17.6027 21.949 17.7429 22 18.0006 22C18.2583 22 18.3986 21.949 18.679 21.847C21.2891 20.8976 22.3826 18.4584 21.8817 15.8201C21.8349 15.5735 21.8114 15.4502 21.7315 15.3658C21.6516 15.2814 21.4542 15.2216 21.0593 15.102C20.0878 14.8077 19.2657 14 17.9992 14Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span class="links">Permisos</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('admin_empresas_ver')
                    <li>
                        <a href="{{ route('pag.empresas') }}"
                            class="nav-link {{ request()->routeIs('pag.empresas') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                color="#000000" fill="none">
                                <path
                                    d="M2.57956 8.62505C2.50886 8.03528 2.47351 7.74039 2.52323 7.499C2.6651 6.81015 3.27111 6.25159 4.07871 6.06529C4.36172 6 4.717 6 5.42757 6H18.5724C19.283 6 19.6383 6 19.9213 6.06529C20.7289 6.25159 21.3349 6.81015 21.4768 7.499C21.5265 7.74039 21.4911 8.03528 21.4204 8.62505C21.2584 9.97669 20.4991 10.716 19.0512 11.1423L14.88 12.3703C13.4541 12.7901 12.7411 13 12 13C11.2589 13 10.5459 12.7901 9.11996 12.3703L4.94882 11.1423C3.50094 10.7161 2.7416 9.97669 2.57956 8.62505Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path
                                    d="M3.46283 10.5L3.26658 12.7757C2.91481 16.855 2.73892 18.8947 3.86734 20.1974C4.99576 21.5 6.93851 21.5 10.824 21.5H13.176C17.0615 21.5 19.0042 21.5 20.1327 20.1974C21.2611 18.8947 21.0852 16.855 20.7334 12.7757L20.5372 10.5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M15.5 5.5L15.4227 5.23509C15.0377 3.91505 14.8452 3.25503 14.3869 2.87752C13.9286 2.5 13.3199 2.5 12.1023 2.5H11.8977C10.6801 2.5 10.0714 2.5 9.61309 2.87752C9.15478 3.25503 8.96228 3.91505 8.57727 5.23509L8.5 5.5"
                                    stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <span class="link_name">Empresas</span>
                        </a>
                    </li>
                @endcan
                @can('admin_aplicaciones_ver')
                    <li>
                        <a href="{{ route('pag.aplicaciones') }}"
                            class="nav-link {{ request()->routeIs('pag.aplicaciones') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                                color="#000000" fill="none">
                                <path
                                    d="M2 18C2 16.4596 2 15.6893 2.34673 15.1235C2.54074 14.8069 2.80693 14.5407 3.12353 14.3467C3.68934 14 4.45956 14 6 14C7.54044 14 8.31066 14 8.87647 14.3467C9.19307 14.5407 9.45926 14.8069 9.65327 15.1235C10 15.6893 10 16.4596 10 18C10 19.5404 10 20.3107 9.65327 20.8765C9.45926 21.1931 9.19307 21.4593 8.87647 21.6533C8.31066 22 7.54044 22 6 22C4.45956 22 3.68934 22 3.12353 21.6533C2.80693 21.4593 2.54074 21.1931 2.34673 20.8765C2 20.3107 2 19.5404 2 18Z"
                                    stroke="currentColor" stroke-width="1.8" />
                                <path
                                    d="M14 18C14 16.4596 14 15.6893 14.3467 15.1235C14.5407 14.8069 14.8069 14.5407 15.1235 14.3467C15.6893 14 16.4596 14 18 14C19.5404 14 20.3107 14 20.8765 14.3467C21.1931 14.5407 21.4593 14.8069 21.6533 15.1235C22 15.6893 22 16.4596 22 18C22 19.5404 22 20.3107 21.6533 20.8765C21.4593 21.1931 21.1931 21.4593 20.8765 21.6533C20.3107 22 19.5404 22 18 22C16.4596 22 15.6893 22 15.1235 21.6533C14.8069 21.4593 14.5407 21.1931 14.3467 20.8765C14 20.3107 14 19.5404 14 18Z"
                                    stroke="currentColor" stroke-width="1.8" />
                                <path
                                    d="M2 6C2 4.45956 2 3.68934 2.34673 3.12353C2.54074 2.80693 2.80693 2.54074 3.12353 2.34673C3.68934 2 4.45956 2 6 2C7.54044 2 8.31066 2 8.87647 2.34673C9.19307 2.54074 9.45926 2.80693 9.65327 3.12353C10 3.68934 10 4.45956 10 6C10 7.54044 10 8.31066 9.65327 8.87647C9.45926 9.19307 9.19307 9.45926 8.87647 9.65327C8.31066 10 7.54044 10 6 10C4.45956 10 3.68934 10 3.12353 9.65327C2.80693 9.45926 2.54074 9.19307 2.34673 8.87647C2 8.31066 2 7.54044 2 6Z"
                                    stroke="currentColor" stroke-width="1.8" />
                                <path
                                    d="M14 6C14 4.45956 14 3.68934 14.3467 3.12353C14.5407 2.80693 14.8069 2.54074 15.1235 2.34673C15.6893 2 16.4596 2 18 2C19.5404 2 20.3107 2 20.8765 2.34673C21.1931 2.54074 21.4593 2.80693 21.6533 3.12353C22 3.68934 22 4.45956 22 6C22 7.54044 22 8.31066 21.6533 8.87647C21.4593 9.19307 21.1931 9.45926 20.8765 9.65327C20.3107 10 19.5404 10 18 10C16.4596 10 15.6893 10 15.1235 9.65327C14.8069 9.45926 14.5407 9.19307 14.3467 8.87647C14 8.31066 14 7.54044 14 6Z"
                                    stroke="currentColor" stroke-width="1.8" />
                            </svg>
                            <span class="link_name">Aplicaciones</span>
                        </a>
                    </li>
                @endcan
                @can('admin_clientes_ver')
                    <li>
                        <a href="{{ route('pag.cliente') }}"
                            class="nav-link {{ request()->routeIs('pag.cliente') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                color="#000000" fill="none">
                                <path
                                    d="M2.9668 10.4961V15.4979C2.9668 18.3273 2.9668 19.742 3.84548 20.621C4.72416 21.5001 6.13837 21.5001 8.9668 21.5001H14.9668C17.7952 21.5001 19.2094 21.5001 20.0881 20.621C20.9668 19.742 20.9668 18.3273 20.9668 15.4979V10.4961"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M14.9668 16.9932C14.2827 17.6004 13.1936 17.9932 11.9668 17.9932C10.74 17.9932 9.65089 17.6004 8.9668 16.9932"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M10.1038 8.41848C9.82182 9.43688 8.79628 11.1936 6.84777 11.4482C5.12733 11.673 3.82246 10.922 3.48916 10.608C3.12168 10.3534 2.28416 9.53872 2.07906 9.02952C1.87395 8.52032 2.11324 7.41706 2.28416 6.96726L2.96743 4.98888C3.13423 4.49196 3.5247 3.31666 3.92501 2.91913C4.32533 2.5216 5.13581 2.5043 5.4694 2.5043H12.4749C14.2781 2.52978 18.2209 2.48822 19.0003 2.50431C19.7797 2.52039 20.2481 3.17373 20.3848 3.45379C21.5477 6.27061 22 7.88382 22 8.57124C21.8482 9.30456 21.22 10.6873 19.0003 11.2955C16.6933 11.9275 15.3854 10.6981 14.9751 10.2261M9.15522 10.2261C9.47997 10.625 10.4987 11.4279 11.9754 11.4482C13.4522 11.4686 14.7273 10.4383 15.1802 9.92062C15.3084 9.76786 15.5853 9.31467 15.8725 8.41848"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="link_name">Clientes</span>
                        </a>
                    </li>
                @endcan
                @can('admin_articulos_ver')
                    <li>
                        <a href="{{ route('pag.articulo') }}"
                            class="nav-link {{ request()->routeIs('pag.articulo') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                color="#000000" fill="none">
                                <path
                                    d="M12 22C11.1818 22 10.4002 21.6698 8.83693 21.0095C4.94564 19.3657 3 18.5438 3 17.1613C3 16.7742 3 10.0645 3 7M12 22C12.8182 22 13.5998 21.6698 15.1631 21.0095C19.0544 19.3657 21 18.5438 21 17.1613V7M12 22L12 11.3548"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M8.32592 9.69138L5.40472 8.27785C3.80157 7.5021 3 7.11423 3 6.5C3 5.88577 3.80157 5.4979 5.40472 4.72215L8.32592 3.30862C10.1288 2.43621 11.0303 2 12 2C12.9697 2 13.8712 2.4362 15.6741 3.30862L18.5953 4.72215C20.1984 5.4979 21 5.88577 21 6.5C21 7.11423 20.1984 7.5021 18.5953 8.27785L15.6741 9.69138C13.8712 10.5638 12.9697 11 12 11C11.0303 11 10.1288 10.5638 8.32592 9.69138Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M6 12L8 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M17 4L7 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="link_name">Artículos</span>
                        </a>
                    </li>
                @endcan
                <li class="pt-1">
                    <div class="menus {{ request()->routeIs('pag.giftcards') ? 'active' : '' }}">
                        <a href="{{ route('pag.giftcards') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20"
                            color="#000000" fill="none" class="icon">
                                <path d="M64 32C28.7 32 0 60.7 0 96l0 32 576 0 0-32c0-35.3-28.7-64-64-64L64 32zM576 224L0 224 0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-192zM112 352l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16z"
                                stroke="currentColor" stroke-width="35"/>
                            </svg>
                            <span class="link_name">Gift Cards</span>
                        </a>
                        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                            height="24" color="#000000" fill="none">
                            <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <ul class="sub-menu">
                            <li>
                                <a href="{{ route('pag.movimientos') }}"
                                    class="nav-link {{ request()->routeIs('pag.movimientos') ? 'active' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20"
                                    color="#000000" fill="none" class="icon">
                                        <path d="M297.4 9.4c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L338.7 160 128 160c-35.3 0-64 28.7-64 64l0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32C0 153.3 57.3 96 128 96l210.7 0L297.4 54.6c-12.5-12.5-12.5-32.8 0-45.3zm-96 256c12.5-12.5 32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 416 96 416c-17.7 0-32 14.3-32 32l0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32c0-53 43-96 96-96l146.7 0-41.4-41.4c-12.5-12.5-12.5-32.8 0-45.3z"
                                        stroke="currentColor" stroke-width="41"/>
                                    </svg>
                                    
                                    <span class="links">Movimientos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pag.facturas') }}"
                                    class="nav-link {{ request()->routeIs('pag.facturas') ? 'active' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="24"
                                    height="24" color="#000000" fill="none">
                                        <path d="M160 0c17.7 0 32 14.3 32 32l0 35.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11l0 33.4c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-34.9c-.4-.1-.9-.1-1.3-.2l-.2 0s0 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7s0 0 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11L128 32c0-17.7 14.3-32 32-32z"/
                                        stroke="currentColor" stroke-width="30"/>
                                    </svg>
                                    <span class="links">Facturas</span>
                                </a>
                            </li>

                    </ul>
                </li>
                @can('admin_avisos_ver')
                    <li>
                        <a href="{{ route('pag.aviso') }}"
                            class="nav-link {{ request()->routeIs('pag.aviso') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                color="#000000" fill="none">
                                <path
                                    d="M14.9263 2.91103L8.27352 6.10452C7.76151 6.35029 7.21443 6.41187 6.65675 6.28693C6.29177 6.20517 6.10926 6.16429 5.9623 6.14751C4.13743 5.93912 3 7.38342 3 9.04427V9.95573C3 11.6166 4.13743 13.0609 5.9623 12.8525C6.10926 12.8357 6.29178 12.7948 6.65675 12.7131C7.21443 12.5881 7.76151 12.6497 8.27352 12.8955L14.9263 16.089C16.4534 16.8221 17.217 17.1886 18.0684 16.9029C18.9197 16.6172 19.2119 16.0041 19.7964 14.778C21.4012 11.4112 21.4012 7.58885 19.7964 4.22196C19.2119 2.99586 18.9197 2.38281 18.0684 2.0971C17.217 1.8114 16.4534 2.17794 14.9263 2.91103Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M11.4581 20.7709L9.96674 22C6.60515 19.3339 7.01583 18.0625 7.01583 13H8.14966C8.60978 15.8609 9.69512 17.216 11.1927 18.197C12.1152 18.8012 12.3054 20.0725 11.4581 20.7709Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7.5 12.5V6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="link_name">Publicidad</span>
                        </a>
                    </li>
                @endcan
                @can('admin_papelera_ver')
                    <li>
                        <a href="{{ route('pag.papelera') }}"
                            class="nav-link {{ request()->routeIs('pag.papelera') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                color="#000000" fill="none">
                                <path d="M22 12L2 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M3.5 12.1819C3.5 9.21871 3.5 7.73713 3.96894 6.55382C4.72281 4.65149 6.31714 3.15095 8.33836 2.44142C9.59563 2.00007 11.1698 2.00007 14.3182 2.00007C16.1173 2.00007 17.0168 2.00007 17.7352 2.25227C18.8902 2.65771 19.8012 3.51516 20.232 4.60221C20.5 5.27839 20.5 6.12501 20.5 7.81825L20.5 12.0001"
                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                <path
                                    d="M3.5 12C3.5 10.1591 4.99238 8.66667 6.83333 8.66667C7.49912 8.66667 8.28404 8.78333 8.93137 8.60988C9.50652 8.45576 9.95576 8.00652 10.1099 7.43136C10.2833 6.78404 10.1667 5.99912 10.1667 5.33333C10.1667 3.49238 11.6591 2 13.5 2"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M6 15L6 17M10 15V22M14 15V18M18 15V20" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="link_name">Papelera</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
