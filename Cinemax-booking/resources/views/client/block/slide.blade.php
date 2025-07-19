@if ($banners->count())
    <style>
        /* Bố cục Slide */
        #myCarousel {
            max-width: 100%;
            overflow: hidden;
        }

        #myCarousel .carousel-item {
            text-align: center;
        }

        #myCarousel .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            object-position: center;
            border-radius: 8px;
        }

        @media (min-width: 768px) {
            #myCarousel .carousel-item img {
                height: 550px;
            }
        }

        /* Indicator spacing */
        .carousel-indicators [data-bs-target] {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 100% 100%;
            width: 30px;
            height: 30px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }
    </style>

    <div class="container-fluid px-0">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <!-- Indicators -->
            <div class="carousel-indicators">
                @foreach ($banners as $index => $banner)
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                @foreach ($banners as $index => $banner)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block mx-auto"
                            alt="{{ $banner->title ?? 'Slide ' . ($index + 1) }}">
                    </div>
                @endforeach
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endif
