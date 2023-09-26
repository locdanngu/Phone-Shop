<div class="footer-top-area">
    <!-- <div class="zigzag-bottom"></div> -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                    <h2>u<span>Stora</span></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero
                        quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi
                        iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi
                        veritatis magni at?</p>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-twitter"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-youtube"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">User Navigation </h2>
                    <ul>
                        <li>
                            <a href="#">My account</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('messages.historypage') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('wishlist.page') }}">{{ trans('messages.wishlistbtn') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('messages.contactpage') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('home.page') }}">{{ trans('messages.homepage') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">{{ trans('messages.categorypage') }}</h2>
                    <ul>
                        @php $count = 0 @endphp
                        @foreach($category as $ct)
                        @if ($count < 5) <li><a
                                href="{{ route('shop.search', ['searchproduct' => $ct->namecategory]) }}">{{ $ct->namecategory }}</a>
                            </li>
                            @php $count++ @endphp
                            @else
                            @break
                            @endif
                            @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-newsletter">
                    <h2 class="footer-wid-title">Newsletter</h2>
                    <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to
                        your inbox!</p>
                    <div class="newsletter-form">
                        <form action="#">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer top area -->

<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>&copy; 2023. All Rights Reserved.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card-icon">
                    <i class="bi bi-cc-circle-fill"></i>
                    <i class="bi bi-credit-card-2-back-fill"></i>
                    <i class="bi bi-paypal"></i>
                    <i class="bi bi-passport"></i>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<div class="move-on-top">
    <div class="move-on-top__container">
        <i class="bi bi-arrow-up move-on-top-btn" style="cursor: pointer;"></i>
    </div>
</div>