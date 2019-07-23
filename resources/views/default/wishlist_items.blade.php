<div class="row fn_wishlist_items">
    @foreach($wishlist->products as $p)
        @include('default.product_item', $params = ['is_wishlist'=>1])
    @endforeach
</div>