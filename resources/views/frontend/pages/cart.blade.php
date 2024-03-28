<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
<style>
    h3 {
        font-size: 16px;
    }
    .text-navy {
        color: #1ab394;
    }
    .cart-product-imitation {
    text-align: center;
    padding-top: 30px;
    height: 80px;
    width: 80px;
    background-color: #f8f8f9;
    }
    .product-imitation.xl {
    padding: 120px 0;
    }
    .product-desc {
    padding: 20px;
    position: relative;
    }
    .ecommerce .tag-list {
    padding: 0;
    }
    .ecommerce .fa-star {
    color: #d1dade;
    }
    .ecommerce .fa-star.active {
    color: #f8ac59;
    }
    .ecommerce .note-editor {
    border: 1px solid #e7eaec;
    }
    table.shoping-cart-table {
    margin-bottom: 0;
    }
    table.shoping-cart-table tr td {
    border: none;
    text-align: right;
    }
    table.shoping-cart-table tr td.desc,
    table.shoping-cart-table tr td:first-child {
    text-align: left;
    }
    table.shoping-cart-table tr td:last-child {
    width: 80px;
    }
    .ibox {
    clear: both;
    margin-bottom: 25px;
    margin-top: 0;
    padding: 0;
    }
    .ibox.collapsed .ibox-content {
    display: none;
    }
    .ibox:after,
    .ibox:before {
    display: table;
    }
    .ibox-title {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #ffffff;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 3px 0 0;
    color: inherit;
    margin-bottom: 0;
    padding: 14px 15px 7px;
    min-height: 48px;
    }
    .ibox-content {
    background-color: #ffffff;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
    }
    .ibox-footer {
    color: inherit;
    border-top: 1px solid #e7eaec;
    font-size: 90%;
    background: #ffffff;
    padding: 10px 15px;
    }
</style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <title>@yield('title')</title>
</head>
<body>
        <!-- start header -->
        <section id="header">
        <a href=""><img src="{{ asset('img/logo.png') }}" alt=""></a>
            <div>
                <ul id="navbar">
                    <li><a href="{{route('index')}}" class="active">Home</a></li>
                    <li><a href="{{route('viewShop')}}">Shop</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    @if(!auth()->check())
                    <li>
                        <a href="{{route('login')}}"><i class="fa-solid fa-right-to-bracket"></i></a></li>
                    @else
                    <li><a href="{{route('cart.index')}}"><i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
                        </form>
                    </li>
                    @endif
                    <a href="#" id="close"><i class="fas fa-times"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <i id="bar" class="fas fa-outdent"></i>
            </div>
        </section>
</body>
<div class="container">
    <div class="wrapper wrapper-content animated fadeInRight pt-3">
        <div class="row">
            <div class="col-md-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>5</strong>) items</span>
                        <h5>Items in your cart</h5>
                    </div>
                    @foreach($cartItems as $data)
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <tbody>
                                <tr>
                                    <td width="90">
                                        <div class="cart-product-imitation">
                                            <!-- <img src="{{ asset('img/logo.png') }}" alt=""> -->
                                            <img src="{{ asset('images/product_images/' . $data->product->getFirstImage($data->product->id)) }}" width="50px" alt="">
                                        </div>
                                    </td>
                                    <td class="desc">
                                        <h3>
                                        <a href="#" class="text-navy">{{$data->product->name}}</a>
                                        </h3>
                                        <p class="small">{{$data->product->description}}</p>
                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="{{route('cart.delete', $data->id)}}" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>
                                    <td width="65">
                                        <input type="number_format" class="form-control" value="{{$data->quantity}}">
                                    </td>
                                    <td>
                                        <h4>{{$data->product->price}}</h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="ibox-content">
                        <span>
                            Total
                        </span>
                        <h2 class="font-bold">
                            $390,00
                        </h2>

                        <hr>
                        <!-- <span class="text-muted small">
                            *For United States, France and Germany applicable sales tax will be applied
                        </span> -->
                        <div class="m-t-sm">
                            <form action="{{route('checkout')}}" method="POST">
                                @csrf <!-- CSRF token for Laravel form submission -->

                                <div class="mb-3">
                                    <label for="receiver" class="form-label">Receiver</label>
                                    <input type="text" class="form-control" id="receiver" name="receiver"  required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"  required>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<hr>
<footer class="section-p1">
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="logo" src="img/logo.png" alt="">
                <h4>Contact</h4>
                <p><strong>Address: </strong>15/4 Duong pham van dong go vap</p>
                <p><strong>Phone: </strong>0989748659</p>
                <p><strong>Hours: </strong>7h - 19h, thu 2 toi thu 7</p>
            </div>
            <div class="col">
                <h4>About</h4>
                <a href="">Delivery Infomation</a>
                <a href="">Privacy Policy</a>
                <a href="">Terms & Conditions</a>
                <a href="">Contact us</a>
            </div>
            <div class="col">
                <h4>MY account</h4>
                <a href="">Sign in</a>
                <a href="">View Cart</a>
                <a href="">My wishlist</a>
                <a href="">Track My Order</a>
                <a href="">Help</a>
            </div>
            <div class="col install">
                <h4>Install App</h4>
                <p>From App Store or Google Play</p>
                <div class="row">
                    <img src="img/pay/app.jpg" alt="">
                    <img src="img/pay/play.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</footer>
