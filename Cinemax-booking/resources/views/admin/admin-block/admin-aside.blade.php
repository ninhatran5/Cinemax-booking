            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


                <div class="app-brand demo ">
                    <a href="" class="app-brand-link">
                        <a href="/" style="width: 150px">
                            <img src="{{ asset('cinemax/images/logo.png') }}" alt="logo" class="img-fluid">
                        </a>
                    </a>
                </div>


                <div class="menu-divider mt-0  ">
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <!-- Dashboards -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                            <div class="badge bg-primary rounded-pill ms-auto"></div>
                        </a>
                    </li>

                    <!-- System Management Dropdown -->
                    <li class="menu-item menu-dropdown">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div>Quản lý hệ thống</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-film"></i>
                                    <div>Quản lý phim</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.rooms.index') }}" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-door-open"></i>
                                    <div>Phòng chiếu</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/admin/showtimes" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-time"></i>
                                    <div>Lịch chiếu phim</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/admin/bookings" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-book-content"></i>
                                    <div>Đơn đặt vé của khách</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/admin/seats" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-chair"></i>
                                    <div>Quản lý ghế trong từng phòng chiếu</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/admin/booking-seats" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-link"></i>
                                    <div>Quản lý ghế đã đặt trong từng đơn đặt</div>
                                </a>
                            </li>
                        </ul>
                    </li>


                </ul>



            </aside>
