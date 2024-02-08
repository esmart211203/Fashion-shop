<!-- index.blade.php -->
@extends('frontend.base')

<!-- title -->
@section('title') Trang login @endsection 
<!-- content -->
@section('content')
<div class="login-page">
  <div class="form">
    <form class="login-form"  method="POST" action="{{ route('auth.login') }}">
    @csrf
      <input type="email" name="email" placeholder="email"/>
      <input type="password" name="password" placeholder="password"/>
      <button type="submit">login</button>
      <p class="message">Not registered? <a href="{{route('register')}}">Create an account</a></p>
    </form>
  </div>
</div>
@endsection