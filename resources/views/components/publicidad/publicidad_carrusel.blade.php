<!-- <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="image-container">
                <img src="{{ asset('images/fondo-carta-aut.jpg') }}" class="d-block" alt="Imagen carrusel">
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-container">
                <img src="{{ asset('images/fondo-carta-aut2.jpg') }}" class="d-block" alt="Imagen carrusel">
            </div>
        </div>
        <div class="carousel-item">
            <div class="image-container">
                <img src="{{ asset('images/fondo-carta-aut3.jpg') }}" class="d-block" alt="Imagen carrusel">
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
 -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <!-- Botones de indicadores (puedes mantenerlos como están) -->
    </div>
    <div class="carousel-inner">
        @foreach ($publicidades as $publicidad)
            <div class="carousel-item">
                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 cartas">
                    <div class="col">
                        <div class="btn-app">
                            <a href="{{ $publicidad->enlace_publicidad }}" target="_blank">
                                <div class="card">
                                    <div class="app-image">
                                        @if ($publicidad->imagen_publicidad)
                                            <img src="{{ asset('images/publicidades/imagen/' . $publicidad->id . '/' . $publicidad->imagen_publicidad) }}"
                                                alt="Icono aplicación">
                                        @else
                                            <img src="{{ asset('images/logo.svg') }}" alt="Imagen por defecto">
                                        @endif
                                    </div>
                                    <div class="app-name">
                                        <p class="name">{{ $publicidad->nombre_publicidad }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Botones de control (puedes mantenerlos como están) -->
</div>
