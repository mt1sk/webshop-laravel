<div class="your-order-table table-responsive fn_cart_purchases">
    <table>
        <thead>
            <tr>
                <th class="">Image</th>
                <th class="product-name">Product</th>
                <th class="">Price</th>
                <th class="">Amount</th>
                <th class="product-total">Total</th>
                <th class=""></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->products as $p)
                <tr class="cart_item">
                    <td class="col-lg-1">
                        @if(!empty($p->image))
                            <a href="{{route('product_page', ['url'=>$p->url])}}">
                                <img src="{{$p->imageView()}}" height="50" />
                            </a>
                        @endif
                    </td>
                    <td class="col-lg-4 product-name">
                        <a href="{{route('product_page', ['url'=>$p->url])}}">{{$p->name}}</a>
                    </td>
                    <td class="col-lg-2">${{$p->price}}</td>
                    <td class="col-lg-2">
                        <input class="quantity mr-15 fn_purchase_amount" data-product_id="{{$p->id}}" type="number" min="1" value="{{$p->pivot->amount}}" />
                    </td>
                    <td class="col-lg-2 product-total">
                        <span class="amount">${{$p->cartTotalPrice}}</span>
                    </td>
                    <td class="col-lg-1">
                        <a href="javascript:;" class="fn_cart_delete" data-product_id="{{$p->id}}">X</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="cart-subtotal">
                <td class=""></td>
                <td class=""></td>
                <td class=""></td>
                <th>Cart total</th>
                <td><span class="amount">${{$cart->subtotalCost}}</span></td>
            </tr>
            <tr class="order-total">
                <td class=""></td>
                <td class=""></td>
                <td class=""></td>
                <th>Order Total</th>
                <td><span class=" total amount">${{$cart->totalCost}}</span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>