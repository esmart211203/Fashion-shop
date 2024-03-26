<!-- index.blade.php -->
@extends('frontend.base')

<!-- title -->
@section('title') Trang cửa hàng @endsection 

<!-- slide -->
@section('content')
    <!-- shop here  -->
    <section id="shop"class="section-p1">
        <div class="sidebar">
            <span >Categories</span>
            <hr style="margin-top: 10px;margin-bottom: 20px;">
            <ul class="main-menu">
                @foreach($categories as $data)
                    <a href="{{route('shop.category', $data->id)}}" style="text-decoration: none; color: cadetblue;"><li class="menu-item">{{$data->name}}</li></a>
                @endforeach
                <!-- <li class="menu-item">Danh mục 2
                    <ul class="sub-menu">
                        <li class="menu-item">Danh mục con 1</li>
                        <li class="menu-item">Danh mục con 2</li>
                    </ul>
                </li>
                <li class="menu-item">Danh mục 3</li> -->
            </ul>
        </div>
        <section id="product1" >
            <div class="pro-container">
                @foreach($products as $data)
                <div class="pro">
                    <a href="{{route('shop.single', $data->id)}}" ><img src="{{ asset('images/product_images/' . $data->getFirstImage($data->id)) }}" alt=""></a>
                    <div class="des">
                        <span>{{$data->brand->name}}</span>
                        <h5>{{$data->name}}</h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>$100</h4>
                    </div>
                    <a href="{{route('cart.store', $data->id)}}"><i class="fa-solid fa-bag-shopping cart"></i></a>
                </div>
                @endforeach
            </div>
        </section>
    </section>
@endsection