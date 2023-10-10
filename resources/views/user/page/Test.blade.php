@extends('user.layouts.Userlayout')

@section('title', trans('messages.product'))

@section('body')
<form action="{{ route('sendSMS') }}" method="post">
    @csrf
    <input type="text" name="numberphone">
    <button class="btn btn-success" type="submit">Gửi</button>
</form>



@endsection