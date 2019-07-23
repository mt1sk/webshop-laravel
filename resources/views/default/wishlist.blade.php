@extends('default.layouts.index')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area mt-30">
        <div class="container">
            <div class="breadcrumb">
                <ul class="d-flex align-items-center">
                    <li><a href="{{route('main_page')}}">Home</a></li>
                    <li class="active"><a href="javascript:;">WishList</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="fn_content">
        @if(count($wishlist->products) > 0)
            <div class="main-shop-page pt-20 pb-100 ptb-sm-60">
                <div class="container">
                    <!-- Row End -->
                    <div class="row">
                        <!-- Product Categorie List Start -->
                        <div class="col-lg-12 order-1 order-lg-2">
                            <div class="main-categorie mb-all-40">
                                <!-- Grid & List Main Area End -->
                                <div class="tab-content fix">
                                    <div id="grid-view" class="tab-pane fade show active">
                                        @include('default.wishlist_items')
                                    </div>
                                </div>
                                <!-- Grid & List Main Area End -->
                            </div>
                        </div>
                        <!-- product Categorie List End -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Container End -->
            </div>
        @else
            <div class="main-shop-page pt-20 pb-100 ptb-sm-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 order-1 order-lg-2">
                            WishList is empty.
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
