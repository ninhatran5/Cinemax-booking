<section class="py-5">
    <div class="container-fluid">
        <div class="py-5 my-5 rounded-5 shadow-lg"
            style="background-color: #f8f9fa; background-image: url('images/bg-leaves-img-pattern.png'); background-repeat: no-repeat; background-size: cover;">
            <div class="container my-5">
                <div class="row align-items-center">

                    <!-- Thông tin liên hệ -->
                    <div class="col-md-6 p-5 text-dark">
                        <h2 class="display-4 fw-bold mb-4">📞 Liên hệ với Cinemax</h2>
                        <p class="fs-5 fw-semibold">
                            Chúng tôi luôn sẵn sàng hỗ trợ bạn!
                            Vui lòng để lại thông tin và nội dung cần liên hệ,
                            đội ngũ Cinemax sẽ phản hồi trong thời gian sớm nhất.
                        </p>
                        <ul class="fs-5 mt-4 fw-semibold">
                            <li>🏢 <strong>Địa chỉ:</strong> 123 Đường ABC, TP. Hà Nội</li>
                            <li>📧 <strong>Email:</strong> support@cinemax.vn</li>
                            <li>📱 <strong>Hotline:</strong> 0123 456 789</li>
                        </ul>
                    </div>

                    <!-- Form liên hệ -->
                    <div class="col-md-6 p-5">
                        <form action="{{ route('client.lienhe') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Họ và tên</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" class="form-control form-control-lg" id="phone" name="phone"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label fw-bold">Nội dung</label>
                                <textarea class="form-control form-control-lg" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark btn-lg fw-bold shadow">
                                    Gửi Liên Hệ
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
