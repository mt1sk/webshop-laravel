<li class="fn_cart_informer">
    <a href="javascript:;">
        <i class="lnr lnr-cart"></i>
        <span class="my-cart">
            <span class="total-pro">2</span>
            <span>cart</span>
        </span>
    </a>
    <ul class="ht-dropdown cart-box-width">
        <li>
            @foreach($cart->products as $p)
                <!-- Cart Box Start -->
                <div class="single-cart-box">
                    <div class="cart-img">
                        @if(!empty($p->image))
                            <a href="{{route('product_page', ['url'=>$p->url])}}"><img src="{{$p->imageView()}}" alt="cart-image"></a>
                        @else
                            <a href="{{route('product_page', ['url'=>$p->url])}}"><img src="/img/products/1.jpg" alt="cart-image"></a>
                        @endif
                        <span class="pro-quantity">{{$p->pivot->amount}}X</span>
                    </div>
                    <div class="cart-content">
                        <h6><a href="{{route('product_page', ['url'=>$p->url])}}">Printed Summer Red </a></h6>
                        <span class="cart-price">{{$p->price}}</span>
                        {{--<span>Size: S</span>
                        <span>Color: Yellow</span>--}}
                    </div>
                    <a class="del-icone fn_delete_cart" data-product_id="{{$p->id}}" href="#"><i class="ion-close"></i></a>
                </div>
                <!-- Cart Box End -->
            @endforeach

            <!-- Cart Footer Inner Start -->
            <div class="cart-footer">
                <ul class="price-content">
                    <li>Subtotal <span>$57.95</span></li>
                    <li>Total <span>$64.95</span></li>
                </ul>
                <div class="cart-actions text-center">
                    <a class="cart-checkout" href="javascript:;">Checkout</a>
                </div>
            </div>
            <!-- Cart Footer Inner End -->
        </li>
    </ul>
</li>