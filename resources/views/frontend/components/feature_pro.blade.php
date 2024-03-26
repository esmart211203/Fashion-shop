    <!-- start product1  -->
    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Morden Design</p>
        <div class="pro-container">
            @foreach($featured_pro as $product)
                <div class="pro">
                    <a href="{{route('shop.single', $product->id)}}"><img src="{{ asset('images/product_images/' . $product->getFirstImage($product->id)) }}" alt=""></a>
                    <div class="des">
                    <span>{{ $product->brand->name }}</span>
                        <h5>{{ $product->name }}</h5>
                        <div class="star">
                            @for($i = 0; $i < $product->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <h4>${{ $product->price }}</h4>
                    </div>
                    <a href="#"><i class="fa-solid fa-bag-shopping cart"></i></a>
                </div>
            @endforeach
            <!-- <div class="pro">
                <img src="./img/products/f2.jpg" alt="">
                <div class="des">
                    <span>Adidas</span>
                    <h5>Cartoon Astronau T-Shirt</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$100</h4>
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping cart"></i></a>
            </div> -->
        </div>
    </section>
    <!-- end product 1 -->