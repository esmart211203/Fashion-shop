<!-- index.blade.php -->
@extends('frontend.base')

<!-- title -->
@section('title') Kết quả tìm kiếm @endsection 

<!-- content -->
@section('content')
<section id="shop"class="section-p1">
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
        <!-- phan trang -->
</section>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <div class="pagination justify-content-center">
            {{ $products->links() }}
    </div>
</div>
@endsection