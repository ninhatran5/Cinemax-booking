    <header>
        <!-- bắt đầu thẻ nv -->
        <div class="container-fluid">
            <div class="row py-3 border-bottom">

                <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                    <div class="main-logo">
                        <a href="/">
                            <img src="{{ asset('cinemax/images/logo.png') }}" alt="logo" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                    <div class="search-bar row bg-light p-2 my-2 rounded-4">

                        <div class="col-11 col-md-13">
                            <form id="search-form" class="text-center" action="index.html" method="post">
                                <input type="text" class="form-control border-0 bg-transparent"
                                    placeholder="Tìm kiếm ở đây" />
                            </form>
                        </div>
                        <div class="col-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
                    <div class="support-box text-end d-none d-xl-block">
                        <span class="fs-6 text-muted">For Support?</span>
                        <h5 class="mb-0">+84 971364828</h5>
                    </div>

                    <ul class="d-flex justify-content-end list-unstyled m-0">
                        <!-- Icon Ticket/Vé -->
                        <li>
                            <a href="/booking"
                                class="bg-light d-flex align-items-center justify-content-center mx-2 p-0"
                                title="Đặt vé"
                                style="width:48px;height:48px;min-width:48px;min-height:48px;border-radius:50%;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="7" width="18" height="10" rx="2" stroke="currentColor"
                                        stroke-width="2" />
                                    <path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" stroke="currentColor"
                                        stroke-width="2" />
                                    <circle cx="12" cy="12" r="2" fill="currentColor" />
                                </svg>
                            </a>
                        </li>
                        <!-- Icon Profile -->
                        <li>
                            <a href="/profile"
                                class="bg-light d-flex align-items-center justify-content-center mx-2 p-0"
                                title="Tài khoản"
                                style="width:48px;height:48px;min-width:48px;min-height:48px;border-radius:50%;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="8" r="4" stroke="currentColor"
                                        stroke-width="2" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke="currentColor" stroke-width="2" />
                                </svg>
                            </a>
                        </li>

                        <li class="d-lg-none">
                            <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#cart"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="d-lg-none">
                            <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="row py-3">
                <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
                    <nav class="main-menu d-flex navbar navbar-expand-lg">
                        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button> --}}
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
                                            <li><a href="index.html" class="dropdown-item">About Us </a></li>
                                            <li><a href="index.html" class="dropdown-item">Shop </a></li>
                                            <li><a href="index.html" class="dropdown-item">Single Product </a></li>
                                            <li><a href="index.html" class="dropdown-item">Cart </a></li>
                                            <li><a href="index.html" class="dropdown-item">Checkout </a></li>
                                            <li><a href="index.html" class="dropdown-item">Blog </a></li>
                                            <li><a href="index.html" class="dropdown-item">Single Post </a></li>
                                            <li><a href="index.html" class="dropdown-item">Styles </a></li>
                                            <li><a href="index.html" class="dropdown-item">Contact </a></li>
                                            <li><a href="index.html" class="dropdown-item">Thank You </a></li>
                                            <li><a href="index.html" class="dropdown-item">My Account </a></li>
                                            <li><a href="index.html" class="dropdown-item">404 Error </a></li>
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
        <!-- kết thúc nav -->
    </header>
