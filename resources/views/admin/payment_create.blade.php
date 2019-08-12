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
                Create new payment
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
                            <form method="post" action="{{route('payments.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" placeholder="" value="{{old('name')}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox checkbox-primary">
                                                <input class="custom-control-input" id="enabled" name="enabled" @if(old('enabled') || $errors->isEmpty()) checked="" @endif type="checkbox">
                                                <label class="custom-control-label" for="enabled">Enable</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Delivery methods</label>
                                            <select name="payment_deliveries[]" class="select2 select2-multiple" multiple="multiple" data-placeholder="Choose">
                                                @foreach($all_deliveries as $d)
                                                    <option value="{{$d->id}}" @if(in_array($d->id, old('payment_deliveries', []))) selected @endif>{{$d->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Module</label>
                                            <select name="module" class="form-control select2 fn_select_module">
                                                <option value="" @empty(old('module')) selected @endempty>--Empty--</option>
                                                @foreach($payment_modules as $value=>$details)
                                                    <option value="{{$value}}" @if(old('module')==$value) selected @endif>{{$details['name']}}</option>
                                                @endforeach
                                            </select>
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
                                                <input type="file" name="icon">
                                                </span>
                                                <a href="#" class="btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        @foreach($payment_modules as $value=>$details)
                                            @if(!empty($details['settings']))
                                                <div class="row fn_module_block" data-module="{{$value}}" style="display: none;">
                                                    @foreach($details['settings'] as $setting)
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                @empty($setting['options'])
                                                                    <label for="{{$loop->iteration}}_{{$setting['field']}}">{{$setting['name']}} - {{old('settings.'.$setting['field'])}}</label>
                                                                    <input class="form-control" id="{{$loop->iteration}}_{{$setting['field']}}" name="settings[{{$setting['field']}}]" placeholder="" value="{{old('settings.'.$setting['field'])}}" type="text">
                                                                @else
                                                                    <label>{{$setting['name']}}</label>
                                                                    <select name="settings[{{$setting['field']}}]" class="form-control select2">
                                                                        @foreach($setting['options'] as $option_value=>$option_name)
                                                                            <option value="{{$option_value}}" @if($option_value == old('settings.'.$setting['field'])) selected @endif>{{$option_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
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

    <script>
        $(function() {
            $(document).on('change', '.fn_select_module', function() {
                var block = $('.fn_module_block');
                block.find("input, select, textarea").attr("disabled", true);
                block.hide();

                var block_to_enable = $('.fn_module_block[data-module="' + $(this).val() + '"]');
                block_to_enable.find("input, select, textarea").attr("disabled", false);
                block_to_enable.show();
            });
            $('.fn_select_module').trigger('change');
        });
    </script>
@endsection
