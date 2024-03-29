<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
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
                    <li>
                        <form action="{{ route('search') }}" method="get" class="search-form">
                            <input type="text" class="input-search" name="keyword" id="searchInput" placeholder="Type to Search...">
                            <button class="btn-search" id="searchButton"><i class="fas fa-search"></i></button>
                        </form>
                    </li>
                    <li><a href="{{route('index')}}" class="active">Home</a></li>
                    <li><a href="{{route('viewShop')}}">Shop</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    @if(!auth()->check())
                    <li>
                        <a href="{{route('login')}}"><i class="fa-solid fa-right-to-bracket"></i></a></li>
                    @else
                    <li><a href="{{route('cart.index')}}"><i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li><a href="{{ route('users.profile') }}"><i class="fa-solid fa-user"></i></a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" style="background: none;border: none;cursor: pointer;">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
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
    <!-- Nội dung chính của trang -->
    <main>
        @yield('content')
    </main>
    <footer class="section-p1">
        <div class="col">
            <img  class="logo" src="img/logo.png" alt="">
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
    </footer>
    <div class="copyright"><p>C 2024, EmTrongKotd</p></div>
    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>