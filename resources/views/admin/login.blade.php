<!DOCTYPE html>
<!--
Template Name: Mintos - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework
Contact: https://hencework.ticksy.com/

License: You must have a valid license purchased only from templatemonster to legally use the template for your project.
-->
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Mintos - SHARED ON THEMELOCK.COM  I Login</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

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
<div class="hk-wrapper">

    <!-- Main Content -->
    <div class="hk-pg-wrapper hk-auth-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 pa-0">
                    <div class="auth-form-wrap pt-xl-0 pt-70">
                        <div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
                            <a class="auth-brand text-center d-block mb-20" href="javascript:;">
                                <img class="brand-img" src="/adm/img/logo-light.png" alt="brand"/>
                            </a>
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{route('administrator.login')}}">
                                @csrf
                                <h1 class="display-4 text-center mb-10">Sign in</h1>
                                {{--<p class="text-center mb-30">Sign in</p>--}}
                                <div class="form-group">
                                    <input class="form-control" name="email" placeholder="Email" type="email" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" name="password" placeholder="Password" type="password" value="">
                                        {{--<div class="input-group-append">
                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                                        </div>--}}
                                    </div>
                                </div>
                                <div class="custom-control custom-checkbox mb-25">
                                    <input class="custom-control-input" id="remember" name="remember" type="checkbox" checked>
                                    <label class="custom-control-label font-14" for="remember">Keep me logged in</label>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Content -->

</div>
<!-- /HK Wrapper -->

<!-- JavaScript -->

<!-- jQuery -->
<script src="/adm/vendors/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/adm/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="/adm/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="/adm/js/jquery.slimscroll.js"></script>

<!-- Fancy Dropdown JS -->
<script src="/adm/js/dropdown-bootstrap-extended.js"></script>

<!-- FeatherIcons JavaScript -->
<script src="/adm/js/feather.min.js"></script>

<!-- Init JavaScript -->
<script src="/adm/js/init.js"></script>
</body>
</html>