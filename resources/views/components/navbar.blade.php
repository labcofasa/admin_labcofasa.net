<nav class="navbar fixed-top" aria-label="Menu">
    <div class="container-fluid">
        <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-scroll="false" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                color="#000000" fill="none">
                <path d="M4 5L20 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M4 12L20 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M4 19L20 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
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
            <span class="logo-nombre">Labs. Cofasa</span>
        </div>

        <div class="offcanvas offcanvas-start" data-bs-scroll="false" tabindex="-1" id="offcanvasNavbar2"
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
                    <span class="logo-nombre">Labs. Cofasa</span>
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
            <x-sidebar />
        </div>

        <div class="d-flex align-items-center">

            {{-- <x-centro-notificaciones /> --}}

            <div class="flex-shrink-0 dropdown perfil-usuario me-1">
                <a href="#" id="dropdown-perfil"
                    class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-auto-close="outside">
                    @if ($usuario->perfil && $usuario->perfil->imagen)
                        <img class="icono-perfil rounded-circle"
                            src="{{ asset('images/usuarios/imagen/' . $usuario->perfil->id . '/' . $usuario->perfil->imagen) }}"
                            alt="Foto de perfil">
                    @else
                        <img class="icono-perfil rounded-circle" src="{{ asset('images/defecto.png') }}"
                            alt="Foto de perfil">
                    @endif

                </a>

                <x-auth.menu-usuario />
            </div>
        </div>
    </div>
</nav>

<section class="overlay"></section>
