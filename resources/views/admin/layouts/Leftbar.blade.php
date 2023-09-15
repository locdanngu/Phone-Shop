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
                <img src="/image/admin.png" class="img-circle elevation-2" alt="">
            </div>
            <div class="info">
                <a href="{{ route('adminhome.page') }}" class="d-block">{{ $admin->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('adminhome.page') }}"
                        class="nav-link {{ request()->is('admin/homepage') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house-door-fill"></i>
                        <p>Trang điều hành</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('listproduct.page', 'searchproduct') ? 'active' : '' }}">
                        <i class="nav-icon bi-box-seam-fill"></i>
                        <p>
                            Quản lý sản phẩm
                            <i class="bi bi-arrow-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listproduct.page') }}"
                                class="nav-link {{ request()->routeIs('listproduct.page', 'searchproduct') ? 'active' : '' }}">
                                <i class="bi-card-list nav-icon"></i>
                                <p>Danh sách sản phẩm</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->is('don-tra-loi-tu-van') ? 'active' : '' }}">
                                <i class="bi bi-file-x nav-icon"></i>
                                <p>Sản phẩm đã bị xóa</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->routeIs('listcategory.page', 'searchcategory') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-ui-checks-grid"></i>
                        <p>
                            Quản lý danh mục
                            <i class="bi bi-arrow-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listcategory.page') }}"
                                class="nav-link {{ request()->routeIs('listcategory.page', 'searchcategory') ? 'active' : '' }}">
                                <i class="bi bi-list-columns nav-icon"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->is('daura') ? 'active' : '' }}">
                                <i class="bi-file-x nav-icon"></i>
                                <p>Hãng đã xóa</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('listcoupon.page', 'searchcoupon') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-badge-vo"></i>
                        <p>
                            Quản lý mã khuyến mãi
                            <i class="bi bi-arrow-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listcoupon.page') }}"
                                class="nav-link {{ request()->routeIs('listcoupon.page', 'searchcoupon') ? 'active' : '' }}">
                                <i class="bi bi-list-stars nav-icon"></i>
                                <p>Danh sách mã giảm giá</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listexpiredcoupon.page') }}" class="nav-link {{ request()->is('daura') ? 'active' : '' }}">
                                <i class="bi bi-file-x nav-icon"></i>
                                <p>Mã hết hạn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('listuser.page') }}"
                        class="nav-link {{ request()->routeIs('listuser.page', 'searchuser') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>
                            Quản lý người dùng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('listorder.page', 'order.search') ? 'active' : '' }}">
                        <i class="nav-icon bi-receipt"></i>
                        <p>
                            Quản lý đơn
                            <!-- <i class="bi bi-arrow-left right"></i> -->
                            <span class="badge badge-danger right">{{ $countorder }}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listorder.page') }}"
                                class="nav-link {{ request()->routeIs('listorder.page') ? 'active' : '' }}">
                                <i class="bi-receipt-cutoff nav-icon"></i>
                                <p>Đơn đặt hàng</p>
                                <span class="badge badge-danger right">{{ $countorder }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->routeIs('listproduct.page', 'searchproduct') ? 'active' : '' }}">
                                <i class="bi-file-earmark-check nav-icon"></i>
                                <p>Đơn đang giao</p>
                                <span class="badge badge-warning right">{{ $countorder2 }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->routeIs('listproduct.page', 'searchproduct') ? 'active' : '' }}">
                                <i class="bi-file-earmark-excel nav-icon"></i>
                                <p>Đơn đã hủy</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('listrevenue.page', 'revenue.search') ? 'active' : '' }}">
                        <i class="nav-icon bi-wallet"></i>
                        <p>
                            Quản lý doanh thu
                            <i class="bi bi-arrow-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listrevenue.page') }}"
                                class="nav-link {{ request()->routeIs('listrevenue.page') ? 'active' : '' }}">
                                <i class="bi bi-piggy-bank nav-icon"></i>
                                <p>Thống kê thu nhập</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ request()->routeIs('listproduct.page', 'searchproduct') ? 'active' : '' }}">
                                <i class="bi bi-wrench nav-icon"></i>
                                <p>Thống kê chi tiêu</p>
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