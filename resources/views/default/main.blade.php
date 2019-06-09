@extends('default.layouts.index')

@section('content')
    @if(!empty($bestseller_products))
        <!-- Hot Deal Products Start Here -->
        <div class="hot-deal-products off-white-bg pb-10">
            <div class="container">
                <!-- Product Title Start -->
                <div class="post-title pb-30">
                    <h2>hot deals</h2>
                </div>
                <!-- Product Title End -->
                <!-- Hot Deal Product Activation Start -->
                <div class="hot-deal-active owl-carousel">
                    @foreach($bestseller_products as $items)
                        @foreach($items as $p)
                            @include('default.product_item')
                        @endforeach
                    @endforeach
                </div>
                <!-- Hot Deal Product Active End -->

            </div>
            <!-- Container End -->
        </div>
        <!-- Hot Deal Products End Here -->
    @endif

    @if(!empty($bestseller_products))
        <!-- Arrivals Products Area Start Here -->
        <div class="second-arrivals-product pb-45 pt-40 pb-sm-5 pt-sm-5">
            <div class="container">
                <div class="main-product-tab-area">
                    <div class="tab-menu mb-25">
                        <div class="section-ttitle">
                            <h2>Best Seller</h2>
                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav tabs-area" role="tablist">
                            @foreach($bestseller_products as $b_name=>$items)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#bestseller_{{$loop->index}}">{{$b_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Tab Contetn Start -->
                    <div class="tab-content">
                        @foreach($bestseller_products as $b_name=>$items)
                            <div id="bestseller_{{$loop->index}}" class="tab-pane fade @if($loop->first) show active @endif">
                                <!-- Arrivals Product Activation Start Here -->
                                <div class="best-seller-pro-active owl-carousel">
                                    @foreach($items as $p)
                                        @include('default.product_item')
                                    @endforeach
                                </div>
                                <!-- Arrivals Product Activation End Here -->
                            </div>
                        @endforeach
                    </div>
                    <!-- Tab Content End -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Arrivals Products Area End Here -->
    @endif

    @if(!empty($brands))
        <div class="hot-deal-products off-white-bg pb-10 pt-40">
            <div class="container">
                <!-- Product Title Start -->
                <div class="post-title pb-30">
                    <h2>Brands</h2>
                </div>
                <!-- Product Title End -->

                <!-- Hot Deal Product Activation Start -->
                <div class="hot-deal-active owl-carousel">
                    @foreach($brands as $b)
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="{{route('brand_page', ['url'=>$b->url])}}">
                                    @if(!empty($b->img))
                                        <img class="primary-img" src="{{$b->imageView()}}" alt="{{$b->name}}">
                                        <img class="secondary-img" src="{{$b->imageView()}}" alt="{{$b->name}}">
                                    @else
                                        <img class="primary-img" src="/img/products/1.jpg" alt="{{$b->name}}">
                                        <img class="secondary-img" src="/img/products/7.jpg" alt="{{$b->name}}">
                                    @endif
                                </a>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content">
                                <div class="pro-info">
                                    <h4><a href="{{route('brand_page', ['url'=>$b->url])}}">{{$b->name}}</a></h4>
                                </div>
                                <div class="pro-actions">
                                    <div class="actions-primary">
                                        <a href="{{route('brand_page', ['url'=>$b->url])}}">Show on page</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                    @endforeach
                </div>
                <!-- Hot Deal Product Active End -->

            </div>
            <!-- Container End -->
        </div>
    @endif
@endsection