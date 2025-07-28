<section class="py-5 my-5">
    <div class="container-fluid">
        <div class="py-5 px-4 rounded-5 shadow-sm"
            style="background-color: #fff9e6; background-image: url('images/bg-pattern-2.png'); background-repeat: no-repeat; background-size: cover;">
            <div class="container">
                <div class="row align-items-center">

                    <!-- Logo -->
                    <div class="col-md-5 text-center mb-4 mb-md-0">
                        <img src="{{ asset('cinemax/images/logo.png') }}" alt="Cinemax"
                            class="img-fluid rounded-4 shadow-lg p-3 bg-white" style="max-width: 300px;">
                    </div>

                    <!-- Nội dung -->
                    <div class="col-md-7">
                        <h2 class="mb-4 fw-bold text-dark display-5">🎬 Chào mừng đến với Cinemax</h2>
                        <p class="text-dark fs-5 lh-lg fw-semibold">
                            Cinemax mang đến cho bạn trải nghiệm xem phim đỉnh cao với hệ thống phòng chiếu hiện đại,
                            màn hình siêu nét và âm thanh sống động.
                            Đặt vé dễ dàng, nhanh chóng và tận hưởng những bộ phim bom tấn cùng bạn bè và gia đình.
                        </p>
                        <ul class="list-unstyled fs-5 mb-4 text-dark">
                            <li class="mb-2">🍿 Phòng chiếu chuẩn quốc tế</li>
                            <li class="mb-2">🎬 Lịch chiếu đa dạng, cập nhật liên tục</li>
                            <li class="mb-2">💺 Ghế ngồi VIP & đôi thoải mái</li>
                        </ul>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('client.movie') }}" class="btn btn-dark btn-lg px-4 shadow">Đặt Vé
                                Ngay</a>
                            <a href="{{ route('client.movie') }}" class="btn btn-outline-dark btn-lg px-4 shadow-sm">Xem
                                Lịch Chiếu</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
