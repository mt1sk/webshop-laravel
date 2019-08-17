<div class="fn_cart_delivery_payment">
    @if(!empty($delivery))
        <div class="payment-method">
            <input type="hidden" name="delivery_id" value="{{$delivery->id}}" />
            <h4>Delivery methods</h4>
            <div id="delivery_methods" class="pt-10">
                @foreach($deliveries as $d)
                    <div class="card">
                        <div class="card-header" id="delivery_header_{{$d->id}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link fn_delivery_method" data-id="{{$d->id}}" data-toggle="collapse" data-target="#delivery_block_{{$d->id}}" aria-expanded="true" aria-controls="delivery_block_{{$d->id}}">
                                    {{$d->name}} - <span class="fn_delivery_price">@if($cart->totalCost > $d->free_from) Free @else {{ $d->price }}$@endif</span>
                                </button>
                            </h5>
                        </div>

                        <div id="delivery_block_{{$d->id}}" class="collapse @if($delivery->id == $d->id) show @endif" aria-labelledby="delivery_header_{{$d->id}}" data-parent="#delivery_methods">
                            <div class="card-body">
                                <p>{!! $d->full_text !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(!empty($delivery_payments))
            <div class="payment-method">
                <input type="hidden" name="payment_id" value="{{$payment->id}}" />
                <h4>Payment methods</h4>
                <div id="payment_methods" class="pt-10">
                    @foreach($delivery_payments as $p)
                        <div class="card">
                            <div class="card-header" id="payment_header_{{$p->id}}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link fn_payment_method" data-id="{{$p->id}}" data-toggle="collapse" data-target="#payment_block_{{$p->id}}" aria-expanded="true" aria-controls="payment_block_{{$p->id}}">
                                        {{$p->name}} - To pay: {{$p->toPay}}$
                                    </button>
                                </h5>
                            </div>

                            <div id="payment_block_{{$p->id}}" class="collapse @if(isset($payment) && $payment->id == $p->id || !isset($payment) && $loop->first) show @endif" aria-labelledby="payment_header_{{$p->id}}" data-parent="#payment_methods">
                                <div class="card-body">
                                    <p>{!! $p->full_text !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>