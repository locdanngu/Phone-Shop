@extends('user.layouts.Userlayout')

@section('title', 'Product page')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Search Products</h2>
                    <form action="">
                        <input type="text" placeholder="Search products...">
                        <input type="submit" value="Search">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Products</h2>
                    @foreach($list as $l)
                    <div class="thubmnail-recent">
                        <img src="{{ $l->imageproduct }}" class="recent-thumb" alt="">
                        <h2><a
                                href="{{ route('product.page', ['nameproduct' => $l->nameproduct]) }}">{{ $l->nameproduct }}</a>
                        </h2>
                        <div class="product-sidebar-price">
                            <ins>${{ $l->price }}</ins> <del>${{ $l->oldprice }}</del>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Recent Posts</h2>
                    <ul>
                        @foreach($recent as $re)
                        <li><a
                                href="{{ route('product.page', ['nameproduct' => $re->nameproduct]) }}">{{ $re->nameproduct }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="">Home</a>
                        <a href="">{{ $product->category->namecategory }}</a>
                        <a href="">{{ $product->nameproduct }}</a>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="{{ $product->imageproduct }}" alt="">
                                </div>

                                <!-- <div class="product-gallery">
                                    <img src="img/product-thumb-1.jpg" alt="">
                                    <img src="img/product-thumb-2.jpg" alt="">
                                    <img src="img/product-thumb-3.jpg" alt="">
                                </div> -->
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name">{{ $product->nameproduct }}</h2>
                                <div class="product-inner-price">
                                    <ins>${{ $product->price }}</ins> <del>${{ $product->oldprice }}</del>
                                </div>

                                <form action="" class="cart">
                                    <div class="quantity">
                                        <input type="number" class="input-text qty text" title="Qty" value="1"
                                            name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" type="submit">Add to cart</button>
                                </form>

                                <div class="product-inner-category">
                                    <p>Category: <a href="">{{ $product->category->namecategory }}</a>. Tags: <a
                                            href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a
                                            href="">shoes</a>. </p>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                role="tab" data-toggle="tab">Description</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
                                                data-toggle="tab">Reviews</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Product Description</h2>
                                            <p>{{ $product->detail }}</p>

                                            <!-- <p>Mauris placerat vitae lorem gravida viverra. Mauris in fringilla ex.
                                                Nulla facilisi. Etiam scelerisque tincidunt quam facilisis lobortis. In
                                                malesuada pulvinar neque a consectetur. Nunc aliquam gravida purus, non
                                                malesuada sem accumsan in. Morbi vel sodales libero.</p> -->
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email">
                                                </p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id=""
                                                        cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="related-products-wrapper">
                        <h2 class="related-products-title">Related Products</h2>
                        <div class="related-products-carousel">
                            @foreach($random as $rd)
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="{{ $rd->imageproduct }}" alt="" style="height:300px">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to
                                            cart</a>
                                        <a href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}"
                                            class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a
                                        href="{{ route('product.page', ['nameproduct' => $rd->nameproduct]) }}">{{ $rd->nameproduct }}</a>
                                </h2>

                                <div class="product-carousel-price">
                                    <ins>${{ $rd->price }}</ins> <del>${{ $rd->oldprice }}</del>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection