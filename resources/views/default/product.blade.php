@extends('default.layouts.index')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area mt-30">
        <div class="container">
            <div class="breadcrumb">
                <ul class="d-flex align-items-center">
                    <li><a href="{{route('main_page')}}">Home</a></li>
                    @if(!empty($product->category))
                        <li><a href="{{route('category_page', ['url'=>$product->category->url])}}">{{$product->category->name}}</a></li>
                    @endif
                    <li class="active"><a href="javascript:;">{{$product->name}}</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail pt-30 pb-100 ptb-sm-60">
        <div class="container">
            <div class="thumb-bg">
                <div class="row">
                    <!-- Main Thumbnail Image Start -->
                    <div class="col-lg-5 mb-all-40">
                        <!-- Thumbnail Large Image start -->
                        <div class="tab-content">
                            <div id="thumb1" class="tab-pane fade show active">
                                @if(!empty($product->image))
                                    <a data-fancybox="images_product" href="{{$product->imageView()}}">
                                        <img src="{{$product->imageView()}}" alt="{{$product->name}}">
                                    </a>
                                @else
                                    <a data-fancybox="images_product" href="/img/products/35.jpg">
                                        <img src="/img/products/35.jpg" alt="{{$product->name}}">
                                    </a>
                                @endif
                            </div>
                            <div id="thumb2" class="tab-pane fade">
                                @if(!empty($product->image2))
                                    <a data-fancybox="images_product" href="{{$product->imageView(1)}}">
                                        <img src="{{$product->imageView(1)}}" alt="{{$product->name}}">
                                    </a>
                                @else
                                    <a data-fancybox="images_product" href="/img/products/13.jpg">
                                        <img src="/img/products/13.jpg" alt="{{$product->name}}">
                                    </a>
                                @endif
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->

                        <!-- Thumbnail Image End -->
                        <div class="product-thumbnail mt-15">
                            <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                <a class="active" data-toggle="tab" href="#thumb1">
                                    @if(!empty($product->image))
                                        <img src="{{$product->imageView()}}" alt="{{$product->name}}">
                                    @else
                                        <img src="/img/products/35.jpg" alt="{{$product->name}}">
                                    @endif
                                </a>
                                <a data-toggle="tab" href="#thumb2">
                                    @if(!empty($product->image2))
                                        <img src="{{$product->imageView(1)}}" alt="{{$product->name}}">
                                    @else
                                        <img src="/img/products/13.jpg" alt="{{$product->name}}">
                                    @endif
                                </a>
                            </div>
                        </div>
                        <!-- Thumbnail image end -->
                    </div>
                    <!-- Main Thumbnail Image End -->

                    <!-- Thumbnail Description Start -->
                    <div class="col-lg-7">
                        <div class="thubnail-desc fix">
                            <h3 class="product-header">{{$product->name}}</h3>
                            <div class="rating-summary fix mtb-10">
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="rating-feedback">
                                    <a href="#">(1 review)</a>
                                    <a href="#">add to your review</a>
                                </div>
                            </div>
                            <div class="pro-price mtb-30">
                                <p class="d-flex align-items-center">
                                    @if(!is_null($product->old_price))
                                        <span class="prev-price">${{$product->old_price}}</span>
                                    @endif
                                    <span class="price">${{$product->price}}</span>
                                    @if(!is_null($product->old_price))
                                        <span class="saving-price">save {{$product->discountAmount}}%</span>
                                    @endif
                                </p>
                            </div>
                            <p class="mb-20 pro-desc-details">{!! $product->short_text !!}</p>
                            <div class="product-size mb-20 clearfix">
                                <label>Size</label>
                                <select class="">
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                </select>
                            </div>
                            <div class="color clearfix mb-20">
                                <label>color</label>
                                <ul class="color-list">
                                    <li>
                                        <a class="orange active" href="#"></a>
                                    </li>
                                    <li>
                                        <a class="paste" href="#"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="box-quantity d-flex hot-product2">
                                <form action="#">
                                    <input class="quantity mr-15" type="number" min="1" value="1">
                                </form>
                                <div class="pro-actions">
                                    <div class="actions-primary">
                                        <a href="javascript:;" title="" data-original-title="Add to Cart"> + Add To Cart</a>
                                    </div>
                                    <div class="actions-secondary">
                                        <a href="javascript:;" title="" data-original-title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                        <a href="javascript:;" title="" data-original-title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="pro-ref mt-20">
                                <p><span class="in-stock"><i class="ion-checkmark-round"></i> IN STOCK</span></p>
                            </div>
                            <div class="socila-sharing mt-25">
                                <ul class="d-flex">
                                    <li>share</li>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Description End -->
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail End -->

    <!-- Product Thumbnail Description Start -->
    <div class="thumnail-desc pb-100 pb-sm-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="main-thumb-desc nav tabs-area" role="tablist">
                        <li><a class="active" data-toggle="tab" href="#dtail">Product Details</a></li>
                        <li><a data-toggle="tab" href="#review">Reviews 1</a></li>
                    </ul>
                    <!-- Product Thumbnail Tab Content Start -->
                    <div class="tab-content thumb-content border-default">
                        <div id="dtail" class="tab-pane fade show active">
                            <p>{!! $product->full_text !!}</p>
                        </div>
                        <div id="review" class="tab-pane fade">
                            <!-- Reviews Start -->
                            <div class="review border-default universal-padding">
                                <div class="group-title">
                                    <h2>customer review</h2>
                                </div>
                                <h4 class="review-mini-title">Truemart</h4>
                                <ul class="review-list">
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>Quality</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <label>Truemart</label>
                                    </li>
                                    <!-- Single Review List End -->
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>price</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <label>Review by <a href="https://themeforest.net/user/hastech">Truemart</a></label>
                                    </li>
                                    <!-- Single Review List End -->
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>value</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <label>Posted on 7/20/18</label>
                                    </li>
                                    <!-- Single Review List End -->
                                </ul>
                            </div>
                            <!-- Reviews End -->
                            <!-- Reviews Start -->
                            <div class="review border-default universal-padding mt-30">
                                <h2 class="review-title mb-30">You're reviewing: <br><span>Faded Short Sleeves T-shirt</span></h2>
                                <p class="review-mini-title">your rating</p>
                                <ul class="review-list">
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>Quality</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                    <!-- Single Review List End -->
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>price</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                    <!-- Single Review List End -->
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>value</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                    <!-- Single Review List End -->
                                </ul>
                                <!-- Reviews Field Start -->
                                <div class="riview-field mt-40">
                                    <form autocomplete="off" action="#">
                                        <div class="form-group">
                                            <label class="req" for="sure-name">Nickname</label>
                                            <input type="text" class="form-control" id="sure-name" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="req" for="subject">Summary</label>
                                            <input type="text" class="form-control" id="subject" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="req" for="comments">Review</label>
                                            <textarea class="form-control" rows="5" id="comments" required="required"></textarea>
                                        </div>
                                        <button type="submit" class="customer-btn">Submit Review</button>
                                    </form>
                                </div>
                                <!-- Reviews Field Start -->
                            </div>
                            <!-- Reviews End -->
                        </div>
                    </div>
                    <!-- Product Thumbnail Tab Content End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail Description End -->

    <!-- Realted Products Start Here -->
    <div class="hot-deal-products off-white-bg pt-100 pb-90 pt-sm-60 pb-sm-50">
        <div class="container">
            <!-- Product Title Start -->
            <div class="post-title pb-30">
                <h2>Realted Products</h2>
            </div>
            <!-- Product Title End -->
            <!-- Hot Deal Product Activation Start -->
            <div class="hot-deal-active owl-carousel">
                @for($i=0/*, $p=$product*/; $i<7; $i++)
                    @php($p=$product)
                    @include('default.product_item')
                @endfor
            </div>
            <!-- Hot Deal Product Active End -->

        </div>
        <!-- Container End -->
    </div>
    <!-- Realated Products End Here -->
@endsection
