@extends('default.layouts.index')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area mt-30">
        <div class="container">
            <div class="breadcrumb">
                <ul class="d-flex align-items-center">
                    <li><a href="{{route('main_page')}}">Home</a></li>
                    <li class="active"><a href="javascript:;">Order</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->

    <div class="fn_content">
    @if(count($order->purchases) > 0)
        <!-- checkout-area start -->
        <div class="checkout-area pb-100 pt-30 pb-sm-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 pb-20">
                        <div class="your-order">
                            <h3>Your order #{{$order->id}}</h3>
                            <div class="your-order-table table-responsive fn_cart_purchases">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="">Price</th>
                                            <th class="">Amount</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->purchases as $p)
                                            <tr class="cart_item">
                                                <td class="col-lg-1">
                                                    @isset($p->product)
                                                        <a href="{{route('product_page', ['url'=>$p->product->url])}}">
                                                            <img src="{{$p->product->showImage()}}" height="50" />
                                                        </a>
                                                    @else
                                                        <img src="{{asset('/img/no-photo-available.png')}}" height="50" />
                                                    @endisset
                                                </td>
                                                <td class="col-lg-5 product-name">
                                                    @isset($p->product)
                                                        <a href="{{route('product_page', ['url'=>$p->product->url])}}">{{$p->product_name}}</a>
                                                    @else
                                                        {{$p->product_name}}
                                                    @endisset
                                                </td>
                                                <td class="col-lg-2">${{$p->price}}</td>
                                                <td class="col-lg-2">
                                                    <span class="product-quantity"> × {{$p->amount}}</span>
                                                </td>
                                                <td class="col-lg-2 product-total">
                                                    <span class="amount">${{$p->totalPrice}}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <th>Total</th>
                                            <td><span class="amount">${{$order->subtotalPrice}}</span></td>
                                        </tr>
                                        @if($order->coupon_discount > 0)
                                            <tr class="cart-subtotal">
                                                <td class=""></td>
                                                <td class=""></td>
                                                <td class=""></td>
                                                <th>Coupon discount</th>
                                                <td><span class="amount">-${{$order->coupon_discount}}</span></td>
                                            </tr>
                                        @endif
                                        <tr class="order-total">
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <th>Order Total</th>
                                            <td><span class=" total amount">${{$order->total_price}}</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{--<div id="personal_data" class="col-lg-12 col-md-12">
                        <div class="checkbox-form mb-sm-40">
                            <h3>Billing Details</h3>
                            @error('database')
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{$message}}</li>
                                </ul>
                            </div>
                            @enderror
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                        <label>Name <span class="required">*</span></label>
                                        <input type="text" name="name" value="{{$name}}" class="form-control @error('name') is-invalid @enderror" placeholder="" />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{$phone}}" class="form-control @error('phone') is-invalid @enderror" placeholder="" />
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input type="email" name="email" value="{{$email}}" class="form-control @error('email') is-invalid @enderror" placeholder="" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list mb-30">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{$address}}" class="form-control" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="order-notes">
                                        <div class="checkout-form-list mb-30">
                                            <label>Order Notes</label>
                                            <textarea id="checkout-mess" name="comment" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery.">{{$comment}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                --}}{{--<div class="col-md-12">
                                    <div class="checkout-form-list create-acc mb-30">
                                        <input id="cbox" type="checkbox" />
                                        <label>Create an account?</label>
                                    </div>
                                    <div id="cbox_info" class="checkout-form-list create-accounts mb-25">
                                        <p class="mb-10">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                        <label>Account password  <span class="required">*</span></label>
                                        <input type="password" placeholder="password" />
                                    </div>
                                </div>--}}{{--
                            </div>
                        </div>
                        <div class="float-right">
                            <input type="submit" value="Make order" class="return-customer-btn" />
                        </div>
                    </div>--}}
                </div>

                @if(!empty($order->payment))
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="checkbox-form mb-sm-40">
                                <h3>Payment</h3>
                                <div class="card">
                                    <div class="card-header" id="headingone">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                {{$order->payment->name}}
                                            </a>
                                        </h5>
                                    </div>

                                    {{--@if(!empty($order->payment->full_text))
                                        <div class="">
                                            <div class="card-body">
                                                <p>
                                                    {!! $order->payment->full_text !!}
                                                </p>
                                            </div>
                                        </div>
                                    @endif--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row" id="order_payment_method">
                    <div class="col-lg-12 col-md-12">
                        <div class="checkbox-form mb-sm-40">
                            @if(!$order->is_paid)
                                {!! $payment_module_form !!}
                            @else
                                <div class="alert alert-success mt-15">
                                    The order is paid
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
    @else
        <div class="checkout-area pb-30 pl-10 pt-30 pb-sm-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 pb-20">
                        Empty order
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
@endsection