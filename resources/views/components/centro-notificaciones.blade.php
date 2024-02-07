<button class="navbar-toggler position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
    aria-controls="offcanvasRight">
    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle">
        <span class="visually-hidden">New alerts</span>
    </span>
    <svg class="icon me-1" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
        fill="#000000">
        <path d="M0 0h24v24H0V0z" fill="none" />
        <path
            d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z" />
    </svg>
</button>

<div class="mx-3 mx-lg-3"></div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title" id="offcanvasRightLabel">Notificaciones <span class="badge bg-danger">3</span></h6>
        <button class="btn-icon-close" data-bs-dismiss="offcanvas">
            <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                fill="#000000">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
            </svg>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
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
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
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
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
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
</div>
