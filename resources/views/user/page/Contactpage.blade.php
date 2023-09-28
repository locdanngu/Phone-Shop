@extends('user.layouts.Userlayout')

@section('title', trans('messages.contactpage'))

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('messages.contactpage') }}</h2>
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
                            <form action="{{ route('contact.add') }}" method="post">
                                @csrf
                                <h2 style="text-align:center" class="font-weight-bold mb-2">{{ trans('messages.contactpage') }}</h2>
                                <h4>{{ trans('messages.yourname') }}:</h4>
                                <input type="text" name="name" class="w-100 mb-2" required>
                                <h4>Email:</h4>
                                <input type="email" name="email" class="w-100 mb-2" required>
                                <h4>{{ trans('messages.phone') }}:</h4>
                                <input type="text" name="phone" class="w-100 mb-2" required>
                                <h4>{{ trans('messages.content') }}:</h4>
                                <textarea name="content" id="" cols="30" rows="10" class="w-100" required></textarea>
                                <input type="submit" class="add_to_cart_button" value="{{ trans('messages.submit') }}" style="float:right">
                            </form>
                            @else
                            <form action="{{ route('contact.add') }}" method="post">
                                @csrf
                                <h2 style="text-align:center" class="font-weight-bold mb-2">{{ trans('messages.contactpage') }}</h2>
                                <h4>{{ trans('messages.yourname') }}:</h4>
                                <input type="text" name="name" class="w-100 mb-2" disabled
                                    value="{{$user->firstname}} {{$user->lastname}}" required>
                                <h4>Email:</h4>
                                <input type="email" name="email" class="w-100 mb-2" disabled value="{{$user->email}}"
                                    required>
                                <h4>{{ trans('messages.phone') }}:</h4>
                                <input type="text" name="phone" class="w-100 mb-2" disabled value="{{$user->phone}}"
                                    required>
                                <h4>{{ trans('messages.content') }}:</h4>
                                <textarea name="content" id="" cols="30" rows="10" class="w-100" required></textarea>
                                <input type="submit" class="add_to_cart_button" value="{{ trans('messages.submit') }}"
                                    style="float:right">
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