<!-- index.blade.php -->
@extends('frontend.base')

<!-- title -->
@section('title') Trang Chủ @endsection 
<!-- content -->
@section('content')
<div class="login-page">
  <div class="form">
    <form class="login-form" method="post" action="{{ route('auth.register') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="name" required/>
        <input type="text" name="phone" placeholder="phone" required/>
        <input type="email" name="email" placeholder="email" required/>
        <input type="password" name="password" placeholder="password" required/>
        <input type="file" name="avatar" placeholder="avatar"/>
        <button type="submit">Register</button>
      </form>
      <p class="message">Already have an account? <a href="#">Login</a></p>
  </div>
</div>
@endsection