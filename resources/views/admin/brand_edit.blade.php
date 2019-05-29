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
                Edit brand
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
                            <form method="post" action="{{route('brands.update', $brand->id)}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" placeholder="" value="{{$brand->name}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="url">ULR</label>
                                            <input class="form-control" id="url" name="url" placeholder="" value="{{$brand->url}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-primary">
                                                <input class="custom-control-input" id="enabled" name="enabled" @if($brand->enabled) checked="" @endif type="checkbox">
                                                <label class="custom-control-label" for="enabled">Enable</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta title</label>
                                            <input class="form-control" id="meta_title" name="meta_title" placeholder="" value="{{$brand->meta_title}}" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta keywords</label>
                                            <input class="form-control" id="meta_keywords" name="meta_keywords" placeholder="" value="{{$brand->meta_keywords}}" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description">{{$brand->meta_description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group fn_image_div">
                                            <label for="">Image</label>
                                            @if(!empty($brand->img))
                                                <div class="fn_image_block">
                                                    <img src="{{$brand->imageView()}}" width="160" height="120">
                                                    <BR>
                                                    <a class="fn_delete_image" href="javascript:;">Delete</a>
                                                </div>
                                            @endif
                                            <input class="fn_accept_delete" type="hidden" name="delete_img" value="0" />
                                        </div>
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload image</span>
                                                </div>
                                                <div class="form-control text-truncate" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                <span class="input-group-append">
														<span class=" btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                                <input type="file" name="img">
                                                </span>
                                                <a href="#" class="btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-12 d-none">
                                        <div class="form-group">
                                            <label>Short description</label>
                                            <div class="tinymce-wrap">
                                                <textarea class="tinymce" name="short_text">{{$brand->short_text}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Full description</label>
                                            <div class="tinymce-wrap">
                                                <textarea class="tinymce" name="full_text">{{$brand->full_text}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <button type="submit" class="btn btn-primary btn-rounded">Save</button>
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
@endsection

@section('include_footer')
    <!-- Tinymce JavaScript -->
    <script src="/adm/vendors/tinymce/tinymce.min.js"></script>

    <!-- Tinymce Wysuhtml5 Init JavaScript -->
    <script src="/adm/js/tinymce-data.js"></script>

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
