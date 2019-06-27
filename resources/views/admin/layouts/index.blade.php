<!DOCTYPE html>
<!--
Template Name: Mintos - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework
Contact: https://hencework.ticksy.com/

License: You must have a valid license purchased only from templatemonster to legally use the template for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@if(isset($title)){{$title}}@endif</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    @yield('include_head')

    <!-- Toggles CSS -->
    <link href="/adm/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="/adm/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="/adm/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="loader-pendulums"></div>
</div>
<!-- /Preloader -->

<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
        <a class="navbar-brand" href="dashboard1.html">
            <img class="brand-img d-inline-block" src="/adm/img/logo-dark.png" alt="brand" />
        </a>
        <ul class="navbar-nav hk-navbar-content">
            <li class="nav-item">
                <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
            </li>
            <li class="nav-item">
                <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="settings"></i></span></a>
            </li>
            <li class="nav-item dropdown dropdown-notifications">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="feather-icon"><i data-feather="bell"></i></span><span class="badge-wrap"><span class="badge badge-primary badge-indicator badge-indicator-sm badge-pill pulse"></span></span></a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <h6 class="dropdown-header">Notifications <a href="javascript:void(0);" class="">View all</a></h6>
                    <div class="notifications-nicescroll-bar">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                        <img src="/adm/img/avatar1.jpg" alt="user" class="avatar-img rounded-circle">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text"><span class="text-dark text-capitalize">Evie Ono</span> accepted your invitation to join the team</div>
                                        <div class="notifications-time">12m</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                        <img src="/adm/img/avatar2.jpg" alt="user" class="avatar-img rounded-circle">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text">New message received from <span class="text-dark text-capitalize">Misuko Heid</span></div>
                                        <div class="notifications-time">1h</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                            <span class="avatar-text avatar-text-primary rounded-circle">
													<span class="initial-wrap"><span><i class="zmdi zmdi-account font-18"></i></span></span>
                                            </span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text">You have a follow up with<span class="text-dark text-capitalize"> Mintos head</span> on <span class="text-dark text-capitalize">friday, dec 19</span> at <span class="text-dark">10.00 am</span></div>
                                        <div class="notifications-time">2d</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                            <span class="avatar-text avatar-text-success rounded-circle">
													<span class="initial-wrap"><span>A</span></span>
                                            </span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text">Application of <span class="text-dark text-capitalize">Sarah Williams</span> is waiting for your approval</div>
                                        <div class="notifications-time">1w</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                            <span class="avatar-text avatar-text-warning rounded-circle">
													<span class="initial-wrap"><span><i class="zmdi zmdi-notifications font-18"></i></span></span>
                                            </span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text">Last 2 days left for the project</div>
                                        <div class="notifications-time">15d</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                @if(Auth::user()->photo)
                                    <img src="{{Auth::user()->imageView()}}" alt="user" class="avatar-img rounded-circle">
                                @else
                                    <img src="/adm/img/avatar12.jpg" alt="user" class="avatar-img rounded-circle">
                                @endif
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <span>{{Auth::user()->name}}<i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <a class="dropdown-item" href="javascript:;"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                    <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-card"></i><span>My balance</span></a>
                    <a class="dropdown-item" href="javascript:;"><i class="dropdown-icon zmdi zmdi-email"></i><span>Inbox</span></a>
                    <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
                    <div class="dropdown-divider"></div>
                    <div class="sub-dropdown-menu show-on-hover">
                        <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
                        <div class="dropdown-menu open-left-side">
                            <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-check text-success"></i><span>Online</span></a>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-circle-o text-warning"></i><span>Busy</span></a>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-minus-circle-outline text-danger"></i><span>Offline</span></a>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('administrator.logout')}}"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                </div>
            </li>
        </ul>
    </nav>
    <form role="search" class="navbar-search">
        <div class="position-relative">
            <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
            <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
            <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
        </div>
    </form>
    <!-- /Top Navbar -->

    <!-- Vertical Nav -->
    <nav class="hk-nav hk-nav-light">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item @if($menu_section=='catalog') active @endif ">
                        <a class="nav-link @if($menu_section!='catalog') collapsed @endif" href="javascript:void(0);" aria-expanded="@if($menu_section=='catalog'){{"true"}}@else{{"false"}}@endif" data-toggle="collapse" data-target="#dash_drp">
                            <span class="feather-icon"><i data-feather="package"></i></span>
                            <span class="nav-link-text">Catalog</span>
                        </a>
                        <ul id="dash_drp" class="nav flex-column collapse collapse-level-1 @if($menu_section=='catalog') show @endif">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    @can('list', \App\Product::class)
                                        <li class="nav-item @if($menu_item=='products') active @endif">
                                            <a class="nav-link" href="{{route('products.list')}}">Products</a>
                                        </li>
                                    @endcan
                                    @can('list', \App\Category::class)
                                        <li class="nav-item @if($menu_item=='categories') active @endif">
                                            <a class="nav-link" href="{{route('categories.list')}}">Categories</a>
                                        </li>
                                    @endcan
                                    @can('list', \App\Brand::class)
                                        <li class="nav-item @if($menu_item=='brands') active @endif">
                                            <a class="nav-link" href="{{route('brands.list')}}">Brands</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @if($menu_section=='orders') active @endif ">
                        <a class="nav-link @if($menu_section!='orders') collapsed @endif link-with-badge" href="javascript:void(0);" data-toggle="collapse" data-target="#app_drp">
                            <span class="feather-icon"><i data-feather="activity"></i></span>
                            <span class="nav-link-text">Orders</span>
                            <span class="badge badge-primary badge-pill">4</span>
                        </a>
                        <ul id="app_drp" class="nav flex-column collapse collapse-level-1 @if($menu_section=='orders') show @endif">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:;">Orders list</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:;">Orders settings</a>
                                    </li>
                                    @can('list', \App\Coupon::class )
                                        <li class="nav-item @if($menu_item=='coupons') active @endif">
                                            <a class="nav-link" href="{{route('coupons.list')}}">Coupons</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item @if($menu_section=='settings') active @endif ">
                        <a class="nav-link @if($menu_section!='settings') collapsed @endif" href="javascript:void(0);" aria-expanded="@if($menu_section=='settings'){{"true"}}@else{{"false"}}@endif" data-toggle="collapse" data-target="#tables_drp">
                            <span class="feather-icon"><i data-feather="list"></i></span>
                            <span class="nav-link-text">Settings</span>
                        </a>
                        <ul id="tables_drp" class="nav flex-column collapse collapse-level-1 @if($menu_section=='settings') show @endif">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    @can('list', \App\Manager::class )
                                        <li class="nav-item @if($menu_item=='managers') active @endif">
                                            <a class="nav-link" href="{{route('managers.list')}}">Managers</a>
                                        </li>
                                    @endcan
                                    <li class="nav-item @if($menu_item=='settings') active @endif">
                                        <a class="nav-link" href="javascript:;">Settings</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
    <!-- /Vertical Nav -->

    <!-- Setting Panel -->
    <div class="hk-settings-panel">
        <div class="nicescroll-bar position-relative">
            <div class="settings-panel-wrap">
                <div class="settings-panel-head">
                    <img class="brand-img d-inline-block align-top" src="/adm/img/logo-light.png" alt="brand" />
                    <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
                </div>
                <hr>
                <h6 class="mb-5">Layout</h6>
                <p class="font-14">Choose your preferred layout</p>
                <div class="layout-img-wrap">
                    <div class="row">
                        <a href="javascript:void(0);" class="col-6 mb-30 active">
                            <img class="rounded opacity-70" src="/adm/img/layout1.png" alt="layout">
                            <i class="zmdi zmdi-check"></i>
                        </a>
                        <a href="dashboard2.html" class="col-6 mb-30">
                            <img class="rounded opacity-70" src="/adm/img/layout2.png" alt="layout">
                            <i class="zmdi zmdi-check"></i>
                        </a>
                        <a href="dashboard3.html" class="col-6 mb-30">
                            <img class="rounded opacity-70" src="/adm/img/layout3.png" alt="layout">
                            <i class="zmdi zmdi-check"></i>
                        </a>
                        <a href="dashboard4.html" class="col-6 mb-30">
                            <img class="rounded opacity-70" src="/adm/img/layout4.png" alt="layout">
                            <i class="zmdi zmdi-check"></i>
                        </a>
                        <a href="dashboard5.html" class="col-6">
                            <img class="rounded opacity-70" src="/adm/img/layout5.png" alt="layout">
                            <i class="zmdi zmdi-check"></i>
                        </a>
                    </div>
                </div>
                <hr>
                <h6 class="mb-5">Navigation</h6>
                <p class="font-14">Menu comes in two modes: dark & light</p>
                <div class="button-list hk-nav-select mb-10">
                    <button type="button" id="nav_light_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                    <button type="button" id="nav_dark_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                </div>
                <hr>
                <h6 class="mb-5">Top Nav</h6>
                <p class="font-14">Choose your liked color mode</p>
                <div class="button-list hk-navbar-select mb-10">
                    <button type="button" id="navtop_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                    <button type="button" id="navtop_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Scrollable Header</h6>
                    <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch"></div>
                </div>
                <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Reset</button>
            </div>
        </div>
        <img class="d-none" src="/adm/img/logo-light.png" alt="brand" />
        <img class="d-none" src="/adm/img/logo-dark.png" alt="brand" />
    </div>
    <!-- /Setting Panel -->

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <div class="mb-30"></div>

        <!-- Container -->
        @yield('content')
        <!-- /Container -->

        <!-- Footer -->
        <div class="hk-footer-wrap container">
            <footer class="footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <p>Pampered by<a href="https://hencework.com/" class="text-dark" target="_blank">Hencework</a> © 2019</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="d-inline-block">Follow us</p>
                        <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                        <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                        <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /Footer -->
    </div>
    <!-- /Main Content -->

</div>
<!-- /HK Wrapper -->

<!-- jQuery -->
<script src="/adm/vendors/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/adm/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="/adm/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="/adm/js/jquery.slimscroll.js"></script>

<!-- Fancy Dropdown JS -->
{{--<script src="/adm/js/dropdown-bootstrap-extended.js"></script>--}}

<!-- FeatherIcons JavaScript -->
<script src="/adm/js/feather.min.js"></script>

<!-- Toggles JavaScript -->
<script src="/adm/vendors/jquery-toggles/toggles.min.js"></script>
<script src="/adm/js/toggle-data.js"></script>

@yield('include_footer')

<!-- Init JavaScript -->
<script src="/adm/js/init.js"></script>

</body>

</html>