<!-- Single Product Start -->
@isset($params['is_catalog'])
<div class="col-lg-4 col-md-4 col-sm-6 col-6">
@endisset
    <div class="single-product fn_product_block">
        <!-- Product Image Start -->
        <div class="pro-img">
            <a href="{{route('product_page', ['url'=>$p->url])}}">
                @if(!empty($p->image))
                    <img class="primary-img" src="{{$p->imageView()}}" alt="{{$p->name}}">
                @else
                    <img class="primary-img" src="/img/products/40.jpg" alt="{{$p->name}}">
                @endif
                @if(!empty($p->image2))
                    <img class="secondary-img" src="{{$p->imageView(1)}}" alt="{{$p->name}}">
                @else
                    <img class="secondary-img" src="/img/products/41.jpg" alt="{{$p->name}}">
                @endif
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
                    <a href="javascript:;" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
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
@isset($params['is_catalog'])
</div>
@endisset
<!-- Single Product End -->