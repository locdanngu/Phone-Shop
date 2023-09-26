<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        @if($user)
                        <li><a href="{{ route('user.page') }}"><i class="bi bi-person-fill"></i> {{ $user->firstname }}
                                {{ $user->lastname }}</a></li>
                        <li><a href="{{ route('wishlist.page') }}"><i class="bi bi-list"></i> Wishlist</a></li>
                        <li><a href="{{ route('cart.page') }}"><i class="bi bi-cart"></i> My Cart</a></li>
                        <li><a href="{{ route('checkoutlist.page') }}"><i class="bi bi-credit-card"></i> Checkout</a>
                        </li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#modal-logout"><i
                                    class="bi bi-box-arrow-right"></i> Logout</a></li>
                        @else
                        <li><a href="#" type="button" data-toggle="modal" data-target="#modal-login"><i
                                    class="bi bi-person-fill"></i> Login</a></li>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#modal-register"><i
                                    class="bi bi-person-fill-add"></i> Register</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span
                                    class="key">currency :</span><span class="value">USD </span><b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <!-- <li><a href="#">INR</a></li>
                                    <li><a href="#">GBP</a></li> -->
                                <li><a href="#">VND</a></li>
                            </ul>
                        </li>

                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span
                                    class="key">language :</span><span class="value">English </span><b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <!-- <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li> -->
                                <li><a href="#">Vietnamese</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img src="/image/example/logo.png"></a></h1>
                </div>
            </div>
            @if($user)
            <div class="col-sm-6">
                <div class="shopping-item" id="capnhatcart">
                    <a href="{{ route('cart.page') }}">Cart - <span class="cart-amunt">${{ $scart_product }}</span> <i
                            class="bi bi-cart"></i>
                        <span class="product-count">{{ $ccart_product }}</span></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ request()->routeIs('home.page') ? 'active' : '' }}"><a
                            href="{{ route('home.page') }}">Home</a></li>
                    <li class="{{ request()->routeIs('shop.page','shop.search') ? 'active' : '' }}"><a
                            href="{{ route('shop.page') }}">Shop page</a></li>
                    <!-- <li><a href="{{ route('product.page') }}">Single product</a></li> -->
                    <li>
                        <a href="#" class="dropbtn" type="button" data-toggle="modal"
                            data-target="#modal-category">Category</a>
                    </li>
                    <li class="dropdown dropdown-small">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span
                                class="key">Type</span><span class="value"></span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach($type as $ty)
                            <li><a href="{{ route('shop.search', ['searchproduct' => $ty->nametype]) }}"
                                    class="fixpadding">{{ $ty->nametype }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @if($user)
                    <!-- <li class="{{ request()->routeIs('checkout.page') ? 'active' : '' }}"><a
                            href="{{ route('checkout.page') }}">Checkout</a></li> -->
                    <li class="{{ request()->routeIs('wishlist.page') ? 'active' : '' }}"><a
                            href="{{ route('wishlist.page') }}">Wishlist</a></li>
                    <li class="{{ request()->routeIs('cart.page') ? 'active' : '' }}"><a
                            href="{{ route('cart.page') }}">Cart</a></li>
                    <li class="{{ request()->routeIs('checkoutlist.page') ? 'active' : '' }}"><a
                            href="{{ route('checkoutlist.page') }}">Checkout</a></li>
                    <li class="{{ request()->routeIs('listhistoryorder.page') ? 'active' : '' }}"><a
                            href="{{ route('listhistoryorder.page') }}">History order</a></li>

                    @endif
                    <li class="{{ request()->routeIs('usercontact.page') ? 'active' : '' }}"><a
                            href="{{ route('usercontact.page') }}">Contact</a></li>

                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->