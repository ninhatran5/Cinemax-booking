<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cinemax - Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-white">

    <!-- Wrapper -->
    <div class="wrapper py-3">
        <div class="container">

            <!-- Header -->
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between py-2 px-4">
                <img src="../../cinemax/images/logo.png" alt="Logo" height="60" class="mb-3 mb-md-0" />

                <form class="d-flex align-items-center justify-content-end w-100" style="max-width: 650px;"
                    method="POST" action="{{ route('client.login') }}">
                    @csrf
                    <input type="email" class="form-control form-control-sm me-3" name="email" placeholder="Email"
                        style="flex: 1.2;">
                    <input type="password" class="form-control form-control-sm me-3" name="password"
                        placeholder="Mật khẩu" style="flex: 1.2;">
                    <button class="btn btn-sm btn-primary px-4" style="min-width: 130px; height: 38px;" type="submit">
                        Đăng Nhập
                    </button>
                </form>
            </div>

            <br>
            <!-- Main Content -->

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- THÔNG BÁO VALIDATION --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row justify-content-between">
                <!-- Left -->
                <div class="col-lg-6 mb-4">

                </div>
                <!-- Right -->
                <div class="col-lg-5">
                    <div class="login-box bg-white p-4 rounded border">
                        <h3>Đăng kí Tài Khoản</h3>
                        <p>Đăng kí để đặt vé xem phim tại Cinemax.</p>
                        <form method="POST" action="{{ route('client.register') }}">
                            @csrf
                            <div class="mb-2">
                                <input type="text" class="form-control" name="name" placeholder="Họ và tên" />
                            </div>
                            <div class="mb-2">
                                <input type="email" class="form-control" name="email" placeholder="Email" />
                            </div>
                            <div class="mb-2">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu" />
                            </div>
                            <div class="mb-2">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Nhập lại mật khẩu" />
                            </div>
                            <button class="btn btn-success w-100" type="submit">Tạo tài khoản</button>
                        </form>


                    </div>
                </div>
            </div>
            <br><br>
            <!-- Footer -->
            @include('client.block.footer')
            @include('client.block.footer-bottom')

        </div>
    </div>
</body>

</html>
