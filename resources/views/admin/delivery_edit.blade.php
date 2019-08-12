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
                Edit delivery
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
                            <form method="post" action="{{route('deliveries.update', $delivery->id)}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" placeholder="" value="{{$delivery->name}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-primary">
                                                <input class="custom-control-input" id="enabled" name="enabled" @if($delivery->enabled) checked="" @endif type="checkbox">
                                                <label class="custom-control-label" for="enabled">Enable</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input class="form-control" id="price" name="price" placeholder="" value="{{$delivery->price}}" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="free_from">Free from</label>
                                                    <input class="form-control" id="free_from" name="free_from" placeholder="" value="{{$delivery->free_from}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Payment methods</label>
                                            <select name="delivery_payments[]" class="select2 select2-multiple" multiple="multiple" data-placeholder="Choose">
                                                @foreach($all_payments as $p)
                                                    <option value="{{$p->id}}" @if(in_array($p->id, $delivery_payments)) selected @endif>{{$p->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group fn_image_div">
                                            <label for="">Image</label>
                                            @if(!empty($delivery->icon))
                                                <div class="fn_image_block">
                                                    <img src="{{$delivery->imageView()}}" width="160" height="120">
                                                    <BR>
                                                    <a class="fn_delete_image" href="javascript:;">Delete</a>
                                                </div>
                                            @endif
                                            <input class="fn_accept_delete" type="hidden" name="delete_icon" value="0" />
                                        </div>
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload image</span>
                                                </div>
                                                <div class="form-control text-truncate" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                <span class="input-group-append">
														<span class=" btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                                <input type="file" name="icon">
                                                </span>
                                                <a href="#" class="btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Full description</label>
                                            <div class="tinymce-wrap">
                                                <textarea class="tinymce" name="full_text">{{$delivery->full_text}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @can('update', $delivery)
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <button type="submit" class="btn btn-primary btn-rounded">Save</button>
                                        </div>
                                    </div>
                                @endcan
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
@endsection

@section('include_footer')
    <!-- Tinymce JavaScript -->
    <script src="/adm/vendors/tinymce/tinymce.min.js"></script>

    <!-- Tinymce Wysuhtml5 Init JavaScript -->
    <script src="/adm/js/tinymce-data.js"></script>

    <!-- Select2 JavaScript -->
    <script src="/adm/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="/adm/js/select2-data.js"></script>

    <script>
        $(function() {
            $(document).on('click', '.fn_delete_image', function() {
                $(this).closest('.fn_image_div').find('.fn_accept_delete').val(1);
                $(this).closest('.fn_image_block').remove();
                return false;
            });
        });
    </script>
@endsection
