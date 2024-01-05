<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
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
