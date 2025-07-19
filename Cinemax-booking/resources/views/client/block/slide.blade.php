@if ($banners->count())
    <style>
        #myCarousel .carousel-item img {
            height: 300px;
            /* Giảm chiều cao */
            object-fit: cover;
            /* Cắt ảnh cho vừa khung mà không méo */
            width: 100%;
            /* Chiếm toàn bộ chiều ngang */
        }

        @media (min-width: 768px) {
            #myCarousel .carousel-item img {
                height: 500px;
                /* Chiều cao lớn hơn ở màn hình lớn */
            }
        }
    </style>

    <div class="container-custom mx-auto mb-4">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">

            <!-- Indicators -->
            <div class="carousel-indicators">
                @foreach ($banners as $index => $banner)
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>

            <!-- Slides -->
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
