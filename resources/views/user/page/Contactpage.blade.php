@extends('user.layouts.Userlayout')

@section('title', 'Contact')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Contact</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            @include('user.layouts.Leftbar')

            <div class="col-md-8">
                <div class="product-content-right">


                    <div class="row">
                        @error('suc')
                        <div class="input-group">
                            <h2 style="color:green" class="font-weight-bold mb-2">{{ $message }}</h2>
                        </div>
                        @enderror

                        <div class="col-sm-12">
                            @if(!$user)
                            <form action="" method="post">
                                @csrf
                                <h2 style="text-align:center" class="font-weight-bold mb-2">Contact us</h2>
                                <h4>Your name:</h4>
                                <input type="text" name="name" class="w-100 mb-2">
                                <h4>Email:</h4>
                                <input type="email" name="email" class="w-100 mb-2">
                                <h4>Phone:</h4>
                                <input type="text" name="phone" class="w-100 mb-2">
                                <h4>Content:</h4>
                                <textarea name="content" id="" cols="30" rows="10" class="w-100"></textarea>
                                <input type="submit" class="add_to_cart_button" value="Send" style="float:right">
                            </form>
                            @else
                            <form action="" method="post">
                                @csrf
                                <h2 style="text-align:center" class="font-weight-bold mb-2">Contact us</h2>
                                <h4>Your name:</h4>
                                <input type="text" name="name" class="w-100 mb-2" disabled
                                    value="{{$user->firstname}} {{$user->lastname}}">
                                <h4>Email:</h4>
                                <input type="email" name="email" class="w-100 mb-2" disabled value="{{$user->email}}">
                                <h4>Phone:</h4>
                                <input type="text" name="phone" class="w-100 mb-2" disabled value="{{$user->phone}}">
                                <h4>Content:</h4>
                                <textarea name="content" id="" cols="30" rows="10" class="w-100"></textarea>
                                <input type="submit" class="add_to_cart_button" value="Send" style="float:right">
                            </form>
                            @endif
                        </div>
                    </div>






                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('popup')

@endsection

@section('js')


@endsection