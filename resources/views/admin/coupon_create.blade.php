@extends('admin.layouts.index')

@section('content')
    <div class="container">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title">
                <span class="pg-title-icon">
                    <span class="feather-icon">
                        <i data-feather="package"></i>
                    </span>
                </span>
                Create new coupon
            </h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    {{--<h5 class="hk-sec-title">Default Layout</h5>
                    <p class="mb-25">More complex forms can be built using the grid classes. Use these for form layouts that require multiple columns, varied widths, and additional alignment options.</p>--}}
                    <div class="row">
                        <div class="col-sm">
                            @if(!$errors->isEmpty())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{route('coupons.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="code">Code</label>
                                            <input class="form-control" id="code" name="code" placeholder="" value="{{old('code')}}" type="text">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label for="value">Value</label>
                                                    <input class="form-control" id="value" name="value" placeholder="" value="{{old('value')}}" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="type">Type</label>
                                                    <select id="type" name="type" class="form-control select2">
                                                        <option value="percentage" @if(!old('type') || old('type')=='percentage') selected @endif>%</option>
                                                        <option value="absolute" @if(old('type')=='absolute') selected @endif>$</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="expire">Expiration date</label>
                                            <input class="form-control" id="expire" name="expire" placeholder="empty is forever" value="{{old('expire')}}" type="text">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="min_order_price">Min order price</label>
                                                    <input class="form-control" id="min_order_price" name="min_order_price" placeholder="empty is 0" value="{{old('min_order_price')}}" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="max_usages">Max usages</label>
                                                    <input class="form-control" id="max_usages" name="max_usages" placeholder="empty is a lot" value="{{old('max_usages')}}" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <button type="submit" class="btn btn-outline-primary btn-rounded">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('include_head')
    <!-- select2 CSS -->
    <link href="/adm/vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('include_footer')
    <!-- Select2 JavaScript -->
    <script src="/adm/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="/adm/js/select2-data.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $('[name=expire]').datepicker({
                dateFormat: "dd.mm.yy",
            });
        });
    </script>
@endsection
