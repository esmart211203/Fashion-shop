<!-- index.blade.php -->
@extends('frontend.base')

<!-- title -->
@section('title') Trang cửa hàng @endsection 

<!-- slide -->
@section('content')
<style>
    .product-container {
    display: flex;
    justify-content: start;
    align-items: start;
    gap: 40px;
    margin: 30px;
    }

    .img-card{
        width: 40%;
    }

    .img-card img {
    width: 100%;
    flex-shrink: 0;
    border-radius: 4px;
    height: 520px;
    object-fit: cover;
    }

    .small-Card {
    display: flex;
    justify-content: start;
    align-items: center;
    margin-top: 15px;
    gap: 12px;
    }

    .small-Card img {
    width: 104px;
    height: 104px;
    border-radius: 4px;
    cursor: pointer;
    }

    .small-Card img:active {
    border: 1px solid #17696a;
    }

    .sm-card {
    border: 2px solid darkred;
    }

    .product-info{
    width: 60%;
    }
    .product-info h3 {
    font-size: 32px;
    font-family: Lato;
    font-weight: 600;
    line-height: 130%;
    }

    .product-info h5 {
    font-size: 24px;
    font-family: Lato;
    font-weight: 500;
    line-height: 130%;
    color: #ff4242;
    margin: 6px 0;
    }

    .product-info del {
    color: #a9a9a9;
    }

    .product-info p {
    color: #424551;
    margin: 15px 0;
    width: 70%;
    }

    .sizes p {
    font-size: 22px;
    color: black;
    }

    .size-option {
    width: 200px;
    height: 30px;
    margin-bottom: 15px;
    padding: 5px;
    }

    .quantity input {
    width: 51px;
    height: 33px;
    margin-bottom: 15px;
    padding: 6px;
    }

    #btn-add {
    background: #17696a;
    border-radius: 4px;
    padding: 10px 37px;
    border: none;
    color: white;
    font-weight: 600;
    }

    button:hover {
    background: #ff4242;
    transition: ease-in 0.4s;
    }

    .delivery {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 70%;
    color: #787a80;
    font-size: 12px;
    font-family: Lato;
    line-height: 150%;
    letter-spacing: 1px;
    }

    hr {
    color: #787a80;
    width: 58%;
    opacity: 0.67;
    }

    .pagination {
        color: #787a80;
        margin: 15px 0;
        cursor: pointer;
    }

    @media screen and (max-width: 576px) {
    .product-container{
        flex-direction: column;
    }
    .small-Card img{
        width: 80px;
    }
    .product-info{
        width: 100%;
    }
    echo "# product-details-page-html-css-js" >> README.md
    .product-info p{
        width: 100%;
    }

    .delivery{
        width: 100%;
    }

    hr{
        width: 100%;
    }
    }
</style>
<section class="product-container">
        <!-- left side -->
        <div class="img-card">
            <img src="{{ asset('images/product_images/' . $product->getFirstImage($product->id)) }}" id="featured-image" alt="">
            <!-- <img src="img/image-1.png" alt="" id="featured-image"> -->
            <!-- small img -->
            <div class="small-Card">
                @foreach($product_images as $image)
                    <div class="small-img-wrapper">
                        <img src="{{ asset('images/product_images/' . $image->name) }}" alt="" class="small-img">
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Right side -->
        <div class="product-info">
            <h3><small style="color: darkgray;">{{$product->brand->name}}®</small> {{$product->name}}</h3>
            <h5>Price: ${{$product->price}} </h5> 
            <!-- <del>$170</del> -->
            <p>{{$product->description}}.</p>
            <div class="quantity">
                <input type="number" value="1" min="1">
                <button id="btn-add">Add to Cart</button>
            </div>

            <div>
                <p>PRODUCT DETAILS</p>
                <div class="delivery">
                    <p>STATUS</p> <p>Quantity in stock</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>{{$product->status}}</p> 
                    <p>{{$product->quantity_in_stock}}</p> 
                </div>
            </div>
        </div>
</section>
<script>
    // Lắng nghe sự kiện click trên tất cả các ảnh nhỏ
    document.querySelectorAll('.small-img').forEach(function(element) {
        element.addEventListener('click', function() {
            // Lấy đường dẫn của ảnh được nhấp
            var newImageSrc = this.getAttribute('src');
            
            // Chuyển đổi ảnh lớn thành ảnh mới
            document.getElementById('featured-image').setAttribute('src', newImageSrc);

            // Xóa lớp active của tất cả các ảnh nhỏ
            document.querySelectorAll('.small-img').forEach(function(el) {
                el.classList.remove('active');
            });

            // Thêm lớp active cho ảnh được nhấp
            this.classList.add('active');
        });
    });
</script>

@endsection