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
                Create new product
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
                            <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" placeholder="" value="{{old('name')}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="url">ULR</label>
                                            <input class="form-control" id="url" name="url" placeholder="" value="{{old('url')}}" type="text">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input class="form-control" id="price" name="price" placeholder="" value="{{old('price')}}" type="text">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="old_price">Old price</label>
                                                    <input class="form-control" id="old_price" name="old_price" placeholder="" value="{{old('old_price')}}" type="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-primary">
                                                <input class="custom-control-input" id="enabled" name="enabled" @if(old('enabled') || $errors->isEmpty()) checked="" @endif type="checkbox">
                                                <label class="custom-control-label" for="enabled">Enable</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-primary">
                                                <input class="custom-control-input" id="best_seller" name="best_seller" @if(old('best_seller') || $errors->isEmpty()) checked="" @endif type="checkbox">
                                                <label class="custom-control-label" for="best_seller">Best seller</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta title</label>
                                            <input class="form-control" id="meta_title" name="meta_title" placeholder="" value="{{old('meta_title')}}" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta keywords</label>
                                            <input class="form-control" id="meta_keywords" name="meta_keywords" placeholder="" value="{{old('meta_keywords')}}" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta description</label>
                                            <textarea class="form-control" id="meta_description" name="meta_description">{{old('meta_description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Image</label>
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload image</span>
                                                </div>
                                                <div class="form-control text-truncate" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                <span class="input-group-append">
														<span class=" btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                                <input type="file" name="image">
                                                </span>
                                                <a href="#" class="btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Image2</label>
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload image</span>
                                                </div>
                                                <div class="form-control text-truncate" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                <span class="input-group-append">
														<span class=" btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                                <input type="file" name="image2">
                                                </span>
                                                <a href="#" class="btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand_id">Brand</label>
                                            <select id="brand_id" name="brand_id" class="form-control select2">
                                                <option value="" @if(!old('brand_id')) selected @endif>--Empty--</option>
                                                @foreach($brands as $b)
                                                    <option value="{{$b->id}}" @if(old('brand_id')==$b->id) selected @endif>{{$b->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select id="category_id" name="category_id" class="form-control select2">
                                                <option value="" @if(!old('category_id')) selected @endif>--Empty--</option>
                                                @foreach($categories as $c)
                                                    <option value="{{$c->id}}" @if(old('category_id')==$c->id) selected @endif>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row pt-30">
                                            <div class="col-md-12">
                                                <label>Related products</label>
                                                <select name="related_products[]" class="select2 select2-multiple" multiple="multiple" data-placeholder="Choose">
                                                    @foreach($all_products as $p)
                                                        <option value="{{$p->id}}" @if(in_array($p->id, old('related_products', []))) selected @endif>{{$p->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-none">
                                        <div class="form-group">
                                            <label>Short description</label>
                                            <div class="tinymce-wrap">
                                                <textarea class="tinymce" name="short_text">{{old('short_text')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Full description</label>
                                            <div class="tinymce-wrap">
                                                <textarea class="tinymce" name="full_text">{{old('full_text')}}</textarea>
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
@endsection

@section('include_footer')
    <!-- Tinymce JavaScript -->
    <script src="/adm/vendors/tinymce/tinymce.min.js"></script>

    <!-- Tinymce Wysuhtml5 Init JavaScript -->
    <script src="/adm/js/tinymce-data.js"></script>

    <!-- Select2 JavaScript -->
    <script src="/adm/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="/adm/js/select2-data.js"></script>
@endsection
