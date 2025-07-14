<div class="container-custom mx-auto">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4"></button>
        </div>

        <!-- Slideshow images -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('cinemax/images/slide1.png') }}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('cinemax/images/slide1.png') }}" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('cinemax/images/slide2.jpg') }}" class="d-block w-100" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('cinemax/images/slide1.png') }}" class="d-block w-100" alt="Slide 4">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('cinemax/images/slide1.png') }}" class="d-block w-100" alt="Slide 5">
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
        
    </div>
</div>
