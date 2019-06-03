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
                Brands
            </h4>
        </div>
        <!-- /Title -->
        <div class="hk-pg-header">
            @can('create', \App\Brand::class)
                <a href="{{route('brands.create')}}">
                    <button type="button" class="btn btn-primary btn-rounded">Create new one</button>
                </a>
            @endcan
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    {{--<h5 class="hk-sec-title">Categories</h5>--}}
                    {{--<p class="mb-40">Add class <code>.table-striped</code> in table tag.</p>--}}
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="col-lg-1"></th>
                                            <th class="col-lg-7">Name</th>
                                            <th class="col-lg-1">Enable</th>
                                            <th class="col-lg-3 text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($brands as $brand)
                                            <tr>
                                                <th class="col-lg-1">
                                                    @if(!empty($brand->img))
                                                        <img src="{{$brand->imageView()}}" width="50" height="50"/>
                                                    @endif
                                                </th>
                                                <td class="col-lg-7">{{$brand->name}}</td>
                                                <td class="col-lg-1">
                                                    {{--<div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input" id="list_item_{{$brand->id}}" @if($brand->enabled) checked @endif >
                                                        <label class="custom-control-label" for="list_item_{{$brand->id}}"></label>
                                                    </div>--}}
                                                    <div class="toggle-wrap">
                                                        <div class="toggle toggle-light toggle-bg-primary toggle2"></div>
                                                    </div>
                                                </td>
                                                <td class="col-lg-3 text-center">
                                                    @can('view', $brand)
                                                        <a href="{{route('brands.edit', $brand->id)}}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i> </a>
                                                    @endcan
                                                    <a href="javascript:;" class="mr-25" data-toggle="tooltip" data-original-title="On site"> <i class="pe-7s-next-2"></i> </a>
                                                    @can('delete', $brand)
                                                        <a href="javascript:;" class="fn_list_del_it"  data-action="{{route('brands.destroy', ['id'=>$brand->id])}}" data-toggle="tooltip" data-original-title="Delete"> <i class="icon-trash txt-danger"></i> </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <form class="fn_list_del_it_form d-none" method="POST" action="">
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <nav class="pagination-wrap d-inline-block mt-15">
                                {{$brands->links()}}
                            </nav>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->

    </div>
@endsection

@section('include_head')
    <!-- Bootstrap table CSS -->
    <link href="/adm/vendors/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('include_footer')

    <!-- Bootstrap-table JavaScript -->
    {{--<script src="/adm/vendors/bootstrap-table/dist/bootstrap-table.min.js"></script>--}}
    {{--<script src="/adm/js/bootstrap-table-data.js"></script>--}}

    <!-- Peity JavaScript -->
    <script src="/adm/vendors/peity/jquery.peity.min.js"></script>
    <script src="/adm/js/peity-data.js"></script>

    <script>
        $(function() {
            $(document).on('click', '.fn_list_del_it', function () {
                $('.fn_list_del_it_form').attr('action', $(this).data('action')).submit();
                return false;
            });
        });
    </script>

@endsection