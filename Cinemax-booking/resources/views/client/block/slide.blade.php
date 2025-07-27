@if ($banners->count())
    <style>
        /* Khung chứa carousel - THU NHỎ và căn giữa */
        .carousel-wrapper {
            max-width: 900px;
            /* ✅ Giới hạn chiều rộng (có thể thay đổi: 800px, 70%, etc.) */
            margin: 0 auto;
            /* ✅ Căn giữa */
            padding: 20px 0;
        }

        #myCarousel {
            width: 100%;
        }

        .carousel-inner {
            aspect-ratio: 16 / 9;
            width: 100%;
        }

        .carousel-item {
            width: 100%;
            height: 100%;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            background-color: #fff;
        }

        /* Căn giữa nút chuyển slide */
        .carousel-control-prev,
        .carousel-control-next {
            top: 50%;
            transform: translateY(-50%);
            width: 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 30px;
            height: 30px;
            background-size: 100% 100%;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }

        .carousel-indicators [data-bs-target] {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
    </style>

    <div class="carousel-wrapper">
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
                        <img src="{{ asset('storage/' . $banner->image) }}"
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
