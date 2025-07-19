<style>
    /* Ẩn mũi tên dropdown */
    .user-icon-toggle::after,
    .user-icon-toggle::before,
    .no-arrow::after,
    .no-arrow::before {
        display: none !important;
        content: none !important;
    }

    /* Style đẹp cho icon người dùng */
    .user-icon-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: #f0f0f0;
        color: #000;
        text-decoration: none;
        position: relative;
        padding: 0;
        margin: 0;
    }

    /* Hover đẹp */
    .user-icon-toggle:hover {
        background-color: #e0e0e0;
    }

    .logout-btn {
        color: #000 !important;
        transition: color 0.2s ease;
    }

    .logout-btn:hover {
        color: #dc3545 !important;
    }

    .dropdown-item {
        color: #6c757d;
        transition: color 0.2s ease;
    }

    .dropdown-item:hover {
        color: #000 !important;
    }

    /* Giảm chiều cao logo */
    .main-logo img {
        max-height: 48px;
        height: auto;
        width: auto;
    }

    /* Giảm padding & margin trong header */
    header .row {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .search-bar {
        padding: 4px 8px !important;
        margin-top: 4px !important;
        margin-bottom: 4px !important;
    }

    .support-box h5 {
        font-size: 1rem;
        margin-bottom: 0;
    }
</style>

<header>
    <!-- Header top -->
    <div class="container-fluid">
        <div class="row py-2 border-bottom">
            <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                <div class="main-logo">
                    <a href="/">
                        <img src="{{ asset('cinemax/images/logo.png') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                <div class="search-bar row bg-light rounded-4">
                    <div class="col-11 col-md-13">
                        <form id="search-form" class="text-center" action="index.html" method="post">
                            <input type="text" class="form-control border-0 bg-transparent"
                                placeholder="Tìm kiếm ở đây" />
                        </form>
                    </div>
                    <div class="col-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="col-sm-8 col-lg-4 d-flex justify-content-end gap-4 align-items-center mt-3 mt-sm-0 justify-content-center justify-content-sm-end">
                <div class="support-box text-end d-none d-xl-block">
                    <span class="fs-6 text-muted">For Support?</span>
                    <h5 class="mb-0">+84 971364828</h5>
                </div>

                <ul class="d-flex justify-content-end list-unstyled m-0">
                    <li class="nav-item dropdown">
                        @auth
                            <div class="dropdown">
                                <a href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                    class="nav-link user-icon-toggle no-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                        <path fill-rule="evenodd"
                                            d="M14 13.5c0 1-1 1.5-6 1.5s-6-.5-6-1.5S4 10 8 10s6 2.5 6 3.5z" />
                                    </svg>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end mt-2 shadow"
                                    aria-labelledby="userDropdown">
                                    <li class="px-3 pt-2 small text-muted">Xin chào,</li>
                                    <li class="px-3 pb-2 fw-semibold text-dark">{{ Auth::user()->name }}</li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                                    <li><a class="dropdown-item" href="#">Lịch sử đặt vé</a></li>
                                    <li>
                                        <form action="{{ route('client.logout') }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item logout-btn">Đăng xuất</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth

                        @guest
                            <a href="{{ route('client.login') }}" class="nav-link user-icon-toggle no-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    <path fill-rule="evenodd"
                                        d="M14 13.5c0 1-1 1.5-6 1.5s-6-.5-6-1.5S4 10 8 10s6 2.5 6 3.5z" />
                                </svg>
                            </a>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="container-fluid">
        <div class="row py-2">
            <div class="d-flex justify-content-center justify-content-sm-between align-items-center">
                <nav class="main-menu d-flex navbar navbar-expand-lg">
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header justify-content-center">
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                                <li class="nav-item active">
                                    <a href="#women" class="nav-link">Trang Chủ</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#men" class="nav-link">Phim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#kids" class="nav-link">Giá Vé</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#accessories" class="nav-link">Phiếu Giảm Giá</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" id="pages"
                                        data-bs-toggle="dropdown" aria-expanded="false">Thể Loại Phim</a>
                                    <ul class="dropdown-menu" aria-labelledby="pages">
                                        <li><a href="#" class="dropdown-item">Hành Động</a></li>
                                        <li><a href="#" class="dropdown-item">Hài</a></li>
                                        <li><a href="#" class="dropdown-item">Tình Cảm</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#brand" class="nav-link">Giới Thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#sale" class="nav-link">Liên Hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
