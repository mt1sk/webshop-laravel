<form action="https://www.liqpay.ua/api/pay" method="post">
    <input type="hidden" name="public_key"  value="{{$payment_public_key}}" />
    <input type="hidden" name="amount"      value="{{$order->total_price}}"/>
    <input type="hidden" name="currency"    value="{{$payment_currency}}"/>
    <input type="hidden" name="description" value="{{$payment_description}}"/>
    <input type="hidden" name="order_id"    value="{{$order->id}}"/>
    <input type="hidden" name="result_url"  value="{{$payment_result_url}}"/>
    <input type="hidden" name="server_url"  value="{{$payment_server_url}}"/>
    <input type="hidden" name="type"        value="buy"/>
    <input type="hidden" name="signature"   value="{{$signature}}"/>

    <div class="float-right">
        {{--<input type="submit" value="Generate receipt" class="return-customer-btn" />--}}
        <input type="image" class="mt-15" src="//static.liqpay.ua/buttons/p1ru.radius.png"/>
    </div>
</form>