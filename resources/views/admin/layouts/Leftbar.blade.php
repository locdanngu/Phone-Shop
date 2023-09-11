<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="" class="brand-link justify-content-center d-flex">
                <img src="images/icon.png" class="brand-image img-circle elevation-3" style="opacity: .8">
                <i class="bi bi-badge-ad"></i>
                <span class="brand-text font-weight-light">Admin</span>
            </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="" class="img-circle elevation-2" alt="">
            </div>
            <div class="info">
                <a href="" class="d-block">Trần Lộc</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('Admin-home-page') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house-door-fill"></i>
                        <p>Trang điều hành</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ request()->is('don-dang-ky-tu-van', 'don-tra-loi-tu-van', 'danh-sach-don-tu-van') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-card-text"></i>
                        <p>
                            Đơn đăng ký tư vấn
                            <i class="bi bi-arrow-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->is('don-dang-ky-tu-van') ? 'active' : '' }}">
                                <i class="bi bi-envelope nav-icon"></i>
                                <p>Mẫu đơn mới</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->is('don-tra-loi-tu-van') ? 'active' : '' }}">
                                <i class="bi bi-envelope-check-fill nav-icon"></i>
                                <p>Đơn đã trả lời</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->is('danh-sach-don-tu-van') ? 'active' : '' }}">
                                <i class="bi bi-file-text nav-icon"></i>
                                <p>Thống kê đơn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ request()->is('dichvu') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-cart2"></i>
                        <p>
                            Thống kê dịch vụ
                            <!-- <i class="bi bi-arrow-left right"></i> -->
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-check2-square"></i>
                                <p>Dịch vụ đã đăng ký</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-list"></i>
                                <p>Quản lí dịch vụ</p>
                            </a>
                        </li>
                    </ul> -->
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-google nav-icon"></i>
                                <p>Google Ads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-facebook nav-icon"></i>
                                <p>Facebook Ads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-tiktok nav-icon"></i>
                                <p>Tiktok Ads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-newspaper nav-icon"></i>
                                <p>Creative Content</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-youtube nav-icon"></i>
                                <p>TVC/Viral Videos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-badge-ad-fill nav-icon"></i>
                                <p>KOLs, Influencers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="bi bi-bookmark-check nav-icon"></i>
                                <p>PR, Bookings</p>
                            </a>
                        </li>
                    </ul> -->
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ request()->is('danh-sach-brief') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-menu-button-wide"></i>
                        <p>
                            Quản lí Brief
                            <!-- <i class="bi bi-arrow-left right"></i> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('danh-sach-blog') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file"></i>
                        <p>Quản lí Blog</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('danh-sach-video') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-camera-reels"></i>
                        <p>Quản lí Viral Video</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('danh-sach-kol') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>Quản lí KOL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('danh-sach-thuong-hieu') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-badge-tm"></i>
                        <p>Quản lí Thương hiệu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('danh-sach-email-nhan-thong-bao') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-bell"></i>
                        <p>Quản lí thông báo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->is('dauvao', 'daura') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-wallet"></i>
                        <p>
                            Thống kê doanh thu
                            <i class="bi bi-arrow-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->is('dauvao') ? 'active' : '' }}">
                                <i class="bi bi-piggy-bank nav-icon"></i>
                                <p>Thống kê đầu vào</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->is('daura') ? 'active' : '' }}">
                                <i class="bi bi-wrench nav-icon"></i>
                                <p>Thống kê đầu ra</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>