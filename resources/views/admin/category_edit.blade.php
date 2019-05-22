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
                Edit category
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
                            <form method="post" action="{{route('categories.update', $category->id)}}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" placeholder="" value="{{$category->name}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="url">ULR</label>
                                            <input class="form-control" id="url" name="url" placeholder="" value="{{$category->url}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-primary">
                                                <input class="custom-control-input" id="enabled" name="enabled" @if($category->enabled) checked="" @endif type="checkbox">
                                                <label class="custom-control-label" for="enabled">Enable</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta title</label>
                                            <input class="form-control" id="meta_title" name="meta_title" placeholder="" value="{{$category->meta_title}}" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta keywords</label>
                                            <input class="form-control" id="meta_keywords" name="meta_keywords" placeholder="" value="{{$category->meta_keywords}}" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description">{{$category->meta_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-none">
                                        <div class="form-group">
                                            <label>Short description</label>
                                            <div class="tinymce-wrap">
                                                <textarea class="tinymce" name="short_text">{{$category->short_text}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Full description</label>
                                            <div class="tinymce-wrap">
                                                <textarea class="tinymce" name="full_text">{{$category->full_text}}</textarea>
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
@endsection
