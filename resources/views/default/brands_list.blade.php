@extends('default.layouts.index')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area mt-30">
        <div class="container">
            <div class="breadcrumb">
                <ul class="d-flex align-items-center">
                    <li><a href="{{route('main_page')}}">Home</a></li>
                    <li class="active"><a href="javascript:;">Brands</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->

    <div class="blog ptb-100  ptb-sm-60">
        <div class="container">
            @if(!$brands->isEmpty())
                <div class="main-blog">
                    <div class="row">
                        @foreach($brands as $b)
                            <div class="col-lg-6 col-sm-12">
                                <div class="single-latest-blog">
                                    <div class="blog-img">
                                        <a href="{{route('brand_page', ['url'=>$b->url])}}">
                                            <img src="{{$b->showImage()}}" alt="{{$b->name}}">
                                        </a>
                                    </div>
                                    <div class="blog-desc">
                                        <h4><a href="{{route('brand_page', ['url'=>$b->url])}}">{{$b->name}}</a></h4>
                                        <ul class="meta-box d-flex">
                                            <li><a href="#">By Truemart</a></li>
                                        </ul>
                                        <p>{!! $b->short_text !!}</p>
                                        <a  class="readmore" href="{{route('brand_page', ['url'=>$b->url])}}">Show more</a>
                                    </div>
                                    <div class="blog-date">
                                        New
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pro-pagination">
                                {{$brands->links('default.pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection