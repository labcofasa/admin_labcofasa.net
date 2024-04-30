<div class="offcanvas offcanvas-end offcanvas-full-screen" tabindex="-1" id="verVacanteOffCanvas{{ $vacante->id }}"
    aria-labelledby="verVacanteOffCanvasLabel">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title" id="verVacanteOffCanvasLabel">{{ $vacante->nombre }}
        </h1>
        <button type="button" class="btn-icon-close" data-bs-dismiss="offcanvas">
            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                fill="#000000">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
            </svg>
        </button>
    </div>
    <div class="offcanvas-body contenedor">
        <div class="d-flex gap-3 align-items-center mb-2">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" color="#000000"
                fill="none">
                <path
                    d="M2.57198 8.22365C2.51219 7.73035 2.48229 7.4837 2.51104 7.28193C2.59477 6.69433 3.00682 6.213 3.56187 6.05444C3.75245 6 3.99351 6 4.47562 6H19.5244C20.0065 6 20.2475 6 20.4381 6.05444C20.9932 6.213 21.4052 6.69433 21.489 7.28193C21.5177 7.4837 21.4878 7.73035 21.428 8.22365C21.2687 9.53773 21.1891 10.1948 20.9939 10.7377C20.429 12.3094 19.138 13.4846 17.5556 13.8676C17.0089 14 16.3668 14 15.0826 14H8.91743C7.63318 14 6.99105 14 6.44436 13.8676C4.86198 13.4846 3.571 12.3094 3.00609 10.7377C2.81092 10.1948 2.73128 9.53773 2.57198 8.22365Z"
                    stroke="currentColor" stroke-width="1.8" />
                <path d="M12 11H12.009" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path
                    d="M3.5 12L3.5 15.02C3.5 18.0747 3.5 19.6021 4.60649 20.551C5.71297 21.5 7.49383 21.5 11.0556 21.5H12.9444C16.5062 21.5 18.287 21.5 19.3935 20.551C20.5 19.6021 20.5 18.0747 20.5 15.02V12"
                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M16 6L15.9117 5.69094C15.4717 4.15089 15.2517 3.38087 14.7279 2.94043C14.2041 2.5 13.5084 2.5 12.117 2.5H11.883C10.4916 2.5 9.79587 2.5 9.2721 2.94043C8.74832 3.38087 8.52832 4.15089 8.0883 5.69094L8 6"
                    stroke="currentColor" stroke-width="1.8" />
            </svg>
            <p>{{ $vacante->empresa->nombre }}</p>
        </div>
        <div class="d-flex gap-3 align-items-center mb-2">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" color="#000000"
                fill="none">
                <path
                    d="M13.6177 21.367C13.1841 21.773 12.6044 22 12.0011 22C11.3978 22 10.8182 21.773 10.3845 21.367C6.41302 17.626 1.09076 13.4469 3.68627 7.37966C5.08963 4.09916 8.45834 2 12.0011 2C15.5439 2 18.9126 4.09916 20.316 7.37966C22.9082 13.4393 17.599 17.6389 13.6177 21.367Z"
                    stroke="currentColor" stroke-width="1.8" />
                <path
                    d="M15.5 11C15.5 12.933 13.933 14.5 12 14.5C10.067 14.5 8.5 12.933 8.5 11C8.5 9.067 10.067 7.5 12 7.5C13.933 7.5 15.5 9.067 15.5 11Z"
                    stroke="currentColor" stroke-width="1.8" />
            </svg>
            <p>{{ $vacante->pais->nombre }} · {{ $vacante->departamento->nombre }} · {{ $vacante->municipio->nombre }}
            </p>
        </div>
        <br>
        <button class="btn btn-lg btn-primary mb-4" type="button">
            <div class="accion">
                <svg class="icon-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                    height="24" color="#000000" fill="none">
                    <path
                        d="M11.922 4.79004C16.6963 3.16245 19.0834 2.34866 20.3674 3.63261C21.6513 4.91656 20.8375 7.30371 19.21 12.078L18.1016 15.3292C16.8517 18.9958 16.2267 20.8291 15.1964 20.9808C14.9195 21.0216 14.6328 20.9971 14.3587 20.9091C13.3395 20.5819 12.8007 18.6489 11.7231 14.783C11.4841 13.9255 11.3646 13.4967 11.0924 13.1692C11.0134 13.0742 10.9258 12.9866 10.8308 12.9076C10.5033 12.6354 10.0745 12.5159 9.21705 12.2769C5.35111 11.1993 3.41814 10.6605 3.0909 9.64127C3.00292 9.36724 2.97837 9.08053 3.01916 8.80355C3.17088 7.77332 5.00419 7.14834 8.6708 5.89838L11.922 4.79004Z"
                        stroke="currentColor" stroke-width="2" />
                </svg>
                <span>Aplicar ahora</span>
            </div>
        </button>
        <div class="mb-3">
            <span class="link_name">Acerca del empleo</span>
            <div>
                <small class="texto-secundario">{{ $vacante->descripcion }}</small>
            </div>
        </div>
        <div class="mb-3">
            <span class="link_name">Perfil requerido</span>
            <p>{{ $vacante->requisitos }}</p>
        </div>
        <div class="mb-3">
            <span class="link_name">Beneficios</span>
            <p>{{ $vacante->beneficios }}</p>
        </div>
        <div class="mb-3">
            <span class="link_name">Acerca de la empresa</span>
            <div>
                <span>Nombre</span>
                <p>{{ $vacante->empresa->nombre }}</p>
                <span>Dirección</span>
                <p>{{ $vacante->empresa->direccion }}</p>
            </div>
        </div>
    </div>
</div>
