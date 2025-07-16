@if ($banners->count())
    <div class="container-custom mx-auto mb-4">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">

            <!-- Indicators -->
            <div class="carousel-indicators">
                @foreach ($banners as $index => $banner)
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}">
                    </button>
                @endforeach
            </div>

            <!-- Slideshow images -->
            <div class="carousel-inner">
                @foreach ($banners as $index => $banner)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100"
                            alt="{{ $banner->title ?? 'Slide ' . ($index + 1) }}">
                    </div>
                @endforeach
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
@endif
