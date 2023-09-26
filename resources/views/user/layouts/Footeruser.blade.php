<div class="footer-top-area">
    <!-- <div class="zigzag-bottom"></div> -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                    <h2>u<span>Stora</span></h2>
                    <p>{{ trans('messages.foot') }}</p>
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
                    <h2 class="footer-wid-title">{{ trans('messages.usernavigation') }} </h2>
                    <ul>
                        <li>
                            <a href="#">{{ trans('messages.myaccount') }}</a>
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
                    <h2 class="footer-wid-title">{{ trans('messages.newletter') }}</h2>
                    <p>{{ trans('messages.newletter2') }}</p>
                    <div class="newsletter-form">
                        <form action="#">
                            <input type="email" placeholder="{{ trans('messages.typeemail') }}">
                            <input type="submit" value="{{ trans('messages.subscribe') }}">
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
                    <p>&copy; 2023. {{ trans('messages.banquyen') }}.</p>
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