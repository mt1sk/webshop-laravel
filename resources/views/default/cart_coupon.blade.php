<!-- ACCORDION START -->
<div id="checkout_coupon" class="fn_cart_coupon">
    @error('coupon')
        <div class="alert alert-danger fn_coupon_errors">
            <ul>
                <li>{{$message}}</li>
            </ul>
        </div>
    @enderror
    <div class="coupon-info">
        <p class="checkout-coupon">
            <input type="text" class="code fn_coupon_code" value="@isset($coupon_code){{$coupon_code}}@endisset" placeholder="Coupon code" />
            <input type="submit" class="fn_coupon_apply" value="Apply Coupon" />
        </p>
    </div>
</div>
<!-- ACCORDION END -->