<!-- index.blade.php -->
@extends('frontend.base')

<!-- title -->
@section('title') Trang Chủ @endsection 
<!-- content -->
@section('content')
<div id="login-container">
<form method="post" action="{{route('custom.login')}}">
    <input type="text" name="email">
    <input type="password" name="password">
    <button type="submit">Login</button>
</form>
</div>
@endsection