@if(!$errors->isEmpty())
    <div class="alert alert-danger mt-15">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if($payment->module == 'Receipt')
    <form action="{{route('payment_callback')}}" method="post">
        {{--@csrf--}}
        @foreach($payment_module->getConfig('settings') as $setting)
            <input type="hidden" name="{{$setting['field']}}" value="{{$payment->getSetting($setting['field'])}}" />
        @endforeach
        <input type="hidden" name="order_id"    value="{{$order->id}}">
        <input type="hidden" name="amount"      value="{{$order->total_price}}">

        <div class="row pt-20">
            <div class="col-md-3">
                <div class="checkout-form-list mb-30">
                    <label>Name <span class="required">*</span></label>
                    <input type="text" name="name" value="" class="form-control {{--@error('name') is-invalid @enderror--}}" placeholder="" />
                    {{--@error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror--}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkout-form-list mb-30">
                    <label>Address <span class="required">*</span></label>
                    <input type="text" name="address" value="" class="form-control {{--@error('address') is-invalid @enderror--}}" placeholder="" />
                    {{--@error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror--}}
                </div>
            </div>
        </div>
        <div class="float-right">
            <input type="submit" value="Generate receipt" class="return-customer-btn" />
        </div>
    </form>
@elseif($payment->module == 'LiqPay')
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
@endif