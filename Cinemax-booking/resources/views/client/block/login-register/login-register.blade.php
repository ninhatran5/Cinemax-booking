<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cinemax - Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
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
                        style="flex: 1.2;" required>
                    <input type="password" class="form-control form-control-sm me-3" name="password"
                        placeholder="Mật khẩu" style="flex: 1.2;" required>
                    <button class="btn btn-sm btn-primary px-4" style="min-width: 130px; height: 38px;" type="submit">
                        Đăng Nhập
                    </button>
                </form>
            </div>

            <!-- Thanh ngang phân cách -->
            <hr class="my-4">

            <!-- Main Content -->
            <div class="row justify-content-between">
                <!-- Left -->
                <div class="col-lg-6 mb-4">
                    <h3>Log in with your phone</h3>
                    <p>
                        - No password needed.<br />
                        - If you use Facebook on your phone, you can use your phone to log in here.
                    </p>
                    <button class="btn btn-primary">Log in with your Phone</button>
                </div>

                <!-- Right -->
                <div class="col-lg-5">
                    <div class="login-box bg-white p-4 rounded border">
                        <h3>Create an account</h3>
                        <p>It's free and always will be.</p>
                        <form method="POST" action="{{ route('client.register') }}">
                            @csrf
                            <div class="mb-2">
                                <input type="text" class="form-control" name="name" placeholder="Họ và tên"
                                    required />
                            </div>
                            <div class="mb-2">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    required />
                            </div>
                            <div class="mb-2">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu"
                                    required />
                            </div>
                            <div class="mb-2">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Nhập lại mật khẩu" required />
                            </div>
                            <button class="btn btn-success w-100" type="submit">Tạo tài khoản</button>
                        </form>

                        <small class="d-block text-center mt-3">
                            <a href="#">Create a Page</a> for a celebrity, band or business.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('client.block.footer')
            @include('client.block.footer-bottom')

        </div>
    </div>
</body>

</html>
