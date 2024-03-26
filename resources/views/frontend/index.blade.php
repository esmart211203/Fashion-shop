<!-- index.blade.php -->
@extends('frontend.base')

<!-- title -->
@section('title') Trang Chủ @endsection 

<!-- slide -->
@section('content')
    @include('frontend.components.slide')
    @include('frontend.components.feature_pro', ['featured_pro' => $featured_pro])
    @include('frontend.components.discount')
    @include('frontend.components.new_pro', ['new_pro' => $new_pro])
    @include('frontend.components.trend')
@endsection
