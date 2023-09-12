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
                <a href="#" class="d-block">{{ $admin->name }}</a>
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
                            Quản lý hãng
                            <i class="bi bi-arrow-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('listcategory.page') }}"
                                class="nav-link {{ request()->routeIs('listcategory.page', 'searchcategory') ? 'active' : '' }}">
                                <i class="bi bi-list-columns nav-icon"></i>
                                <p>Danh sách hãng</p>
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
                    <a href="#" class="nav-link {{ request()->is('dauvao', 'daura') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-badge-vo"></i>
                        <p>
                            Quản lý mã khuyến mãi
                            <i class="bi bi-arrow-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link {{ request()->is('dauvao') ? 'active' : '' }}">
                                <i class="bi bi-list-stars nav-icon"></i>
                                <p>Danh sách mã giảm giá</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link {{ request()->is('daura') ? 'active' : '' }}">
                                <i class="bi bi-file-x nav-icon"></i>
                                <p>Mã hết hạn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->is('dauvao', 'daura') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>
                            Quản lý người dùng
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>