@extends('default.layouts.index')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area mt-30">
        <div class="container">
            <div class="breadcrumb">
                <ul class="d-flex align-items-center">
                    <li><a href="{{route('main_page')}}">Home</a></li>
                    <li class="active"><a href="javascript:;">Cart</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->

    <div class="fn_content">
        @if($cart->productsCount > 0)
            <!-- coupon-area start -->
            <div class="coupon-area pt-30 pt-sm-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="coupon-accordion">
                                <!-- ACCORDION START -->
                                {{--<h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                                <div id="checkout-login" class="coupon-content">
                                    <div class="coupon-info">
                                        <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>
                                        <form action="#">
                                            <p class="form-row-first">
                                                <label>Username or email <span class="required">*</span></label>
                                                <input type="text" />
                                            </p>
                                            <p class="form-row-last">
                                                <label>Password  <span class="required">*</span></label>
                                                <input type="text" />
                                            </p>
                                            <p class="form-row">
                                                <input type="submit" value="Login" />
                                                <label>
                                                    <input type="checkbox" />
                                                    Remember me
                                                </label>
                                            </p>
                                            <p class="lost-password">
                                                <a href="#">Lost your password?</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>--}}
                                <!-- ACCORDION END -->

                                <h3>Have a coupon? Enter your code</h3>
                                @include('default.cart_coupon')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- coupon-area end -->

            <!-- checkout-area start -->
            <div class="checkout-area pb-100 pt-30 pb-sm-60">
                <div class="container">
                    <div class="row">
                        <form method="POST" action="{{route('cart_page')}}">
                            @csrf
                            <div class="col-lg-12 col-md-12 pb-20">
                                <div class="your-order">
                                    <h3>Your order</h3>
                                    @include('default.cart_purchases')
                                    @include('default.cart_delivery_payment')
                                </div>
                            </div>
                            <div id="personal_data" class="col-lg-12 col-md-12">
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
                                        {{--<div class="col-md-12">
                                            <div class="checkout-form-list create-acc mb-30">
                                                <input id="cbox" type="checkbox" />
                                                <label>Create an account?</label>
                                            </div>
                                            <div id="cbox_info" class="checkout-form-list create-accounts mb-25">
                                                <p class="mb-10">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                                <label>Account password  <span class="required">*</span></label>
                                                <input type="password" placeholder="password" />
                                            </div>
                                        </div>--}}
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input type="submit" value="Make order" class="return-customer-btn" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- checkout-area end -->
        @else
            <div class="checkout-area pb-30 pl-10 pt-30 pb-sm-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 pb-20">
                            Empty cart
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('include_footer')
    <script src="/js/shop/delivery_payment.js"></script>
@endsection