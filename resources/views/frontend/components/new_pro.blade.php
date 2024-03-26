    <!-- start product1  -->
    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Summer Collection New Morden Design</p>
        <div class="pro-container">
        @foreach($featured_pro as $product)
            <div class="pro">
                <a href="{{route('shop.single', $product->id)}}"><img src="{{ asset('images/product_images/' . $product->getFirstImage($product->id)) }}" alt=""></a>
                <div class="des">
                    <span>{{ $product->brand->name }}</span>
                    <span>{{ $product->getFirstImage($product->id) }}</span>
                    <h5>{{ $product->name }}</h5>
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
            </div>
        @endforeach
        </div>
    </section>
    <!-- end product 1 -->