<!-- Single Product Start -->
@isset($params['is_catalog'])
<div class="col-lg-4 col-md-4 col-sm-6 col-6">
@endisset
@isset($params['is_wishlist'])
<div class="col-lg-3 col-md-3 col-sm-6 col-6">
@endisset
    <div class="single-product fn_product_block">
        <!-- Product Image Start -->
        <div class="pro-img">
            <a href="{{route('product_page', ['url'=>$p->url])}}">
                <img class="primary-img" src="{{$p->showImage()}}" alt="{{$p->name}}">
                <img class="secondary-img" src="{{$p->showImage(1)}}" alt="{{$p->name}}">
            </a>
            {{--<div class="countdown" data-countdown="2020/03/01"></div>--}}
            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
        </div>
        <!-- Product Image End -->

        <!-- Product Content Start -->
        <div class="pro-content">
            <div class="pro-info">
                <h4><a href="{{route('product_page', ['url'=>$p->url])}}">{{$p->name}}</a></h4>
                <p>
                    <span class="price">${{$p->price}}</span>
                    @if(!is_null($p->old_price))
                        <del class="prev-price">${{$p->old_price}}</del>
                    @endif
                </p>
                @if(!is_null($p->old_price))
                    <div class="label-product l_sale">{{$p->discountAmount}}<span class="symbol-percent">%</span></div>
                @endif
            </div>
            <div class="pro-actions">
                <div class="actions-primary">
                    <a href="javascript:;" class="fn_cart_add" data-product_id="{{$p->id}}" title="Add to Cart"> + Add To Cart</a>
                </div>
                <div class="actions-secondary">
                    <a href="javascript:;" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                    <a href="javascript:;" class="fn_wishlist @if($wishlist->products->contains($p->id)) fn_selected @endif" data-product_id="{{$p->id}}" data-toggle_text="@if($wishlist->products->contains($p->id)) Add to WishList @else Remove from WishList @endif" title="WishList">
                        <i class="lnr lnr-heart"></i>
                        <span>@if($wishlist->products->contains($p->id)) Remove from WishList @else Add to WishList @endif</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Product Content End -->
        @if($p->isNew)
            <span class="sticker-new">new</span>
        @endif
        @if(!is_null($p->old_price))
            <span class="sticker-sale">sale</span>
        @endif
    </div>
@if(isset($params['is_catalog']) || isset($params['is_wishlist']))
</div>
@endif
<!-- Single Product End -->

@section('include_footer')
    <script src="/js/shop/wishlist.js"></script>
@endsection