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
                Create new manager
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
                            <form method="post" action="{{route('managers.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" placeholder="" value="{{old('name')}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">E-Mail</label>
                                            <input class="form-control" id="email" name="email" placeholder="" value="{{old('email')}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input class="form-control" id="password" name="password" placeholder="" value="" type="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm password</label>
                                            <input class="form-control" id="password_confirmation" name="password_confirmation" placeholder="" value="" type="password">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-primary">
                                                <input class="custom-control-input" id="enabled" name="enabled" @if(old('enabled') || $errors->isEmpty()) checked="" @endif type="checkbox">
                                                <label class="custom-control-label" for="enabled">Enable</label>
                                            </div>
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
                                                <input type="file" name="photo">
                                                </span>
                                                <a href="#" class="btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </span>
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
@endsection

@section('include_footer')
@endsection
