<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$meta_title}}</title>
    <meta name="keywords" content="{{$meta_keywords}}" />
    <meta name="description" content="{{$meta_description}}" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link rel="shortcut icon" href="/img/favicon.ico">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Ionicons css -->
    <link rel="stylesheet" href="/css/ionicons.min.css">
    <!-- linearicons css -->
    <link rel="stylesheet" href="/css/linearicons.css">
    <!-- Nice select css -->
    <link rel="stylesheet" href="/css/nice-select.css">
    <!-- Jquery fancybox css -->
    <link rel="stylesheet" href="/css/jquery.fancybox.css">
    <!-- Jquery ui price slider css -->
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <!-- Meanmenu css -->
    <link rel="stylesheet" href="/css/meanmenu.min.css">
    <!-- Nivo slider css -->
    <link rel="stylesheet" href="/css/nivo-slider.css">
    <!-- Owl carousel css -->
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="/css/default.css">
    <!-- Main css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="/css/responsive.css">

    <!-- Modernizer js -->
    <script src="/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Main Wrapper Start Here -->
<div class="wrapper">
    <!-- Main Header Area Start Here -->
    <header>
        <!-- Header Top Start Here -->
        <div class="header-top-area">
            <div class="container">
                <!-- Header Top Start -->
                <div class="header-top">
                    <ul>
                        <li><a href="#">Free Shipping on order over $99</a></li>
                        <li><a href="#">Shopping Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                    </ul>
                    <ul>
                        <li><span>Language</span> <a href="#">English<i class="lnr lnr-chevron-down"></i></a>
                            <!-- Dropdown Start -->
                            <ul class="ht-dropdown">
                                <li><a href="#"><img src="/img/header/1.jpg" alt="language-selector">English</a></li>
                                <li><a href="#"><img src="/img/header/2.jpg" alt="language-selector">Francis</a></li>
                            </ul>
                            <!-- Dropdown End -->
                        </li>
                        <li><span>Currency</span><a href="#"> USD $ <i class="lnr lnr-chevron-down"></i></a>
                            <!-- Dropdown Start -->
                            <ul class="ht-dropdown">
                                <li><a href="#">&#36; USD</a></li>
                                <li><a href="#"> € Euro</a></li>
                                <li><a href="#">&#163; Pound Sterling</a></li>
                            </ul>
                            <!-- Dropdown End -->
                        </li>
                        <li><a href="javascript:;">My Account<i class="lnr lnr-chevron-down"></i></a>
                            <!-- Dropdown Start -->
                            <ul class="ht-dropdown">
                                @if(!Auth::user())
                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="{{route('register')}}">Register</a></li>
                                @else
                                    <li><a href="{{route('user_home')}}">Your data</a></li>
                                    <li>
                                        <a href="{{route('logout')}}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                @endif
                            </ul>
                            <!-- Dropdown End -->
                        </li>
                    </ul>
                </div>
                <!-- Header Top End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Header Top End Here -->
        <!-- Header Middle Start Here -->
        <div class="header-middle ptb-15">
            <div class="container">
                <div class="row align-items-center no-gutters">
                    <div class="col-lg-3 col-md-12">
                        <div class="logo mb-all-30">
                            <a href="{{route('main_page')}}"><img src="/img/logo/logo.png" alt="logo-image"></a>
                        </div>
                    </div>
                    <!-- Categorie Search Box Start Here -->
                    <div class="col-lg-5 col-md-8 ml-auto mr-auto col-10">
                        <div class="categorie-search-box">
                            <form action="#">
                                <div class="form-group">
                                    <select class="bootstrap-select" name="search_cat_id">
                                        <option value="0">All categories</option>
                                        @foreach($categories as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" name="search" placeholder="I’m shopping for...">
                                <button><i class="lnr lnr-magnifier"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Categorie Search Box End Here -->
                    <!-- Cart Box Start Here -->
                    <div class="col-lg-4 col-md-12">
                        <div class="cart-box mt-all-30">
                            <ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
                                <li><a href="#"><i class="lnr lnr-cart"></i><span class="my-cart"><span class="total-pro">2</span><span>cart</span></span></a>
                                    <ul class="ht-dropdown cart-box-width">
                                        <li>
                                            <!-- Cart Box Start -->
                                            <div class="single-cart-box">
                                                <div class="cart-img">
                                                    <a href="#"><img src="/img/products/1.jpg" alt="cart-image"></a>
                                                    <span class="pro-quantity">1X</span>
                                                </div>
                                                <div class="cart-content">
                                                    <h6><a href="product.html">Printed Summer Red </a></h6>
                                                    <span class="cart-price">27.45</span>
                                                    <span>Size: S</span>
                                                    <span>Color: Yellow</span>
                                                </div>
                                                <a class="del-icone" href="#"><i class="ion-close"></i></a>
                                            </div>
                                            <!-- Cart Box End -->
                                            <!-- Cart Box Start -->
                                            <div class="single-cart-box">
                                                <div class="cart-img">
                                                    <a href="#"><img src="/img/products/2.jpg" alt="cart-image"></a>
                                                    <span class="pro-quantity">1X</span>
                                                </div>
                                                <div class="cart-content">
                                                    <h6><a href="product.html">Printed Round Neck</a></h6>
                                                    <span class="cart-price">45.00</span>
                                                    <span>Size: XL</span>
                                                    <span>Color: Green</span>
                                                </div>
                                                <a class="del-icone" href="#"><i class="ion-close"></i></a>
                                            </div>
                                            <!-- Cart Box End -->
                                            <!-- Cart Footer Inner Start -->
                                            <div class="cart-footer">
                                                <ul class="price-content">
                                                    <li>Subtotal <span>$57.95</span></li>
                                                    <li>Shipping <span>$7.00</span></li>
                                                    <li>Taxes <span>$0.00</span></li>
                                                    <li>Total <span>$64.95</span></li>
                                                </ul>
                                                <div class="cart-actions text-center">
                                                    <a class="cart-checkout" href="checkout.html">Checkout</a>
                                                </div>
                                            </div>
                                            <!-- Cart Footer Inner End -->
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="lnr lnr-heart"></i><span class="my-cart"><span>Wish</span><span>list (0)</span></span></a>
                                </li>
                                <li><a href="#"><i class="lnr lnr-user"></i><span class="my-cart"><span> <strong>Sign in</strong> Or</span><span> Join My Site</span></span></a>



                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Cart Box End Here -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Header Middle End Here -->
        <!-- Header Bottom Start Here -->
        <div class="header-bottom  header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4 col-md-6 vertical-menu d-none d-lg-block">
                        <span class="categorie-title">Shop by Categories </span>
                    </div>
                    <div class="col-xl-9 col-lg-8 col-md-12 ">
                        <nav class="d-none d-lg-block">
                            <ul class="header-bottom-list d-flex">
                                <li><a href="javascript:;">shop<i class="fa fa-angle-down"></i></a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul class="ht-dropdown dropdown-style-two">
                                        <li><a href="{{route('brands_list')}}">Brands</a></li>
                                        <li><a href="javascript:;">compare</a></li>
                                        <li><a href="javascript:;">cart</a></li>
                                        <li><a href="javascript:;">checkout</a></li>
                                        <li><a href="javascript:;">wishlist</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="javascript:;">blog<i class="fa fa-angle-down"></i></a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul class="ht-dropdown dropdown-style-two">
                                        <li><a href="javascript:;">blog details</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="#">pages<i class="fa fa-angle-down"></i></a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul class="ht-dropdown dropdown-style-two">
                                        <li><a href="javascript:;">register</a></li>
                                        <li><a href="javascript:;">sign in</a></li>
                                        <li><a href="javascript:;">forgot password</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="javascript:;">About us</a></li>
                                <li><a href="javascript:;">contact us</a></li>
                            </ul>
                        </nav>
                        <div class="mobile-menu d-block d-lg-none">
                            <nav>
                                <ul>
                                    <li><a href="javascript:;">shop</a>
                                        <!-- Mobile Menu Dropdown Start -->
                                        <ul>
                                            <li><a href="{{route('brands_list')}}">Brands</a></li>
                                            <li><a href="javascript:;">compare</a></li>
                                            <li><a href="javascript:;">cart</a></li>
                                            <li><a href="javascript:;">checkout</a></li>
                                            <li><a href="javascript:;">wishlist</a></li>
                                        </ul>
                                        <!-- Mobile Menu Dropdown End -->
                                    </li>
                                    <li><a href="javascript:;">Blog</a>
                                        <!-- Mobile Menu Dropdown Start -->
                                        <ul>
                                            <li><a href="javascript:;">blog details</a></li>
                                        </ul>
                                        <!-- Mobile Menu Dropdown End -->
                                    </li>
                                    <li><a href="#">pages</a>
                                        <!-- Mobile Menu Dropdown Start -->
                                        <ul>
                                            <li><a href="javascript:;">register</a></li>
                                            <li><a href="javascript:;">sign in</a></li>
                                            <li><a href="javascript:;">forgot password</a></li>
                                        </ul>
                                        <!-- Mobile Menu Dropdown End -->
                                    </li>
                                    <li><a href="javascript:;">about us</a></li>
                                    <li><a href="javascript:;">contact us</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Header Bottom End Here -->
        <!-- Mobile Vertical Menu Start Here -->
        <div class="container d-block d-lg-none">
            <div class="vertical-menu mt-30">
                <span class="categorie-title mobile-categorei-menu">Shop by Categories</span>
                <nav>
                    <div id="cate-mobile-toggle" class="category-menu sidebar-menu sidbar-style mobile-categorei-menu-list menu-hidden ">
                        <ul>
                            @foreach($categories as $c)
                                <li>
                                    <a href="{{route('category_page', ['url'=>$c->url])}}">{{$c->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- category-menu-end -->
                </nav>
            </div>
        </div>
        <!-- Mobile Vertical Menu Start End -->
    </header>
    <!-- Main Header Area End Here -->

    <!-- Categorie Menu & Slider Area Start Here -->
    <div class="main-page-banner @isset($is_main_page) pb-50 off-white-bg @else home-3 @endisset">
        <div class="container">
            <div class="row">
                <!-- Vertical Menu Start Here -->
                @if(!empty($categories))
                    <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                        <div class="vertical-menu mb-all-30">
                            <nav>
                                <ul class="vertical-menu-list">
                                    @foreach($categories as $c)
                                        <li>
                                            <a href="{{route('category_page', ['url'=>$c->url])}}">
                                                {{--<span><img src="/img/vertical-menu/5.png" alt="menu-icon"></span>--}}
                                                {{$c->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                    <!-- More Categoies Start -->
                                    {{--<li id="cate-toggle" class="category-menu v-cat-menu">
                                        <ul>
                                            <li class="has-sub"><a href="#">More Categories</a>
                                                <ul class="category-sub">
                                                    <li><a href="shop.html"><span><img src="/img/vertical-menu/11.png" alt="menu-icon"></span>Accessories</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>--}}
                                    <!-- More Categoies End -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                @endif
                <!-- Vertical Menu End Here -->

                <!-- Slider Area Start Here -->
                @isset($is_main_page)
                    <div class="col-xl-9 col-lg-8 slider_box">
                        <div class="slider-wrapper theme-default">
                            <!-- Slider Background  Image Start-->
                            <div id="slider" class="nivoSlider">
                                <a href="shop.html"><img src="/img/slider/1.jpg" data-thumb="img/slider/1.jpg" alt="" title="#htmlcaption" /></a>
                                <a href="shop.html"><img src="/img/slider/2.jpg" data-thumb="img/slider/2.jpg" alt="" title="#htmlcaption2" /></a>
                            </div>
                            <!-- Slider Background  Image Start-->
                        </div>
                    </div>
                @endisset
                <!-- Slider Area End Here -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Categorie Menu & Slider Area End Here -->

    @yield('content')

    <!-- Support Area Start Here -->
    <div class="support-area bdr-top">
        <div class="container">
            <div class="d-flex flex-wrap text-center">
                <div class="single-support">
                    <div class="support-icon">
                        <i class="lnr lnr-gift"></i>
                    </div>
                    <div class="support-desc">
                        <h6>Great Value</h6>
                        <span>Nunc id ante quis tellus faucibus dictum in eget.</span>
                    </div>
                </div>
                <div class="single-support">
                    <div class="support-icon">
                        <i class="lnr lnr-rocket" ></i>
                    </div>
                    <div class="support-desc">
                        <h6>Worlwide Delivery</h6>
                        <span>Quisque posuere enim augue, in rhoncus diam dictum non</span>
                    </div>
                </div>
                <div class="single-support">
                    <div class="support-icon">
                        <i class="lnr lnr-lock"></i>
                    </div>
                    <div class="support-desc">
                        <h6>Safe Payment</h6>
                        <span>Duis suscipit elit sem, sed mattis tellus accumsan.</span>
                    </div>
                </div>
                <div class="single-support">
                    <div class="support-icon">
                        <i class="lnr lnr-enter-down"></i>
                    </div>
                    <div class="support-desc">
                        <h6>Shop Confidence</h6>
                        <span>Faucibus dictum suscipit eget metus. Duis  elit sem, sed.</span>
                    </div>
                </div>
                <div class="single-support">
                    <div class="support-icon">
                        <i class="lnr lnr-users"></i>
                    </div>
                    <div class="support-desc">
                        <h6>24/7 Help Center</h6>
                        <span>Quisque posuere enim augue, in rhoncus diam dictum non.</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Support Area End Here -->

    <!-- Footer Area Start Here -->
    <footer class="off-white-bg2 pt-95 bdr-top pt-sm-55">
        <!-- Footer Top Start -->
        <div class="footer-top">
            <div class="container">
                <!-- Signup Newsletter Start -->
                <div class="row mb-60">
                    <div class="col-xl-7 col-lg-7 ml-auto mr-auto col-md-8">
                        <div class="news-desc text-center mb-30">
                            <h3>Sign Up For Newsletters</h3>
                            <p>Be the First to Know. Sign up for newsletter today</p>
                        </div>
                        <div class="newsletter-box">
                            <form action="#">
                                <input class="subscribe" placeholder="your email address" name="email" id="subscribe" type="text">
                                <button type="submit" class="submit">subscribe!</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Signup-Newsletter End -->
                <div class="row">
                    <!-- Single Footer Start -->
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="single-footer mb-sm-40">
                            <h3 class="footer-title">Information</h3>
                            <div class="footer-content">
                                <ul class="footer-list">
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="contact.html">Terms & Conditions</a></li>
                                    <li><a href="login.html">FAQs</a></li>
                                    <li><a href="login.html">Return Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Start -->
                    <!-- Single Footer Start -->
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="single-footer mb-sm-40">
                            <h3 class="footer-title">Customer Service</h3>
                            <div class="footer-content">
                                <ul class="footer-list">
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Order History</a></li>
                                    <li><a href="wishlist.html">Wish List</a></li>
                                    <li><a href="#">Site Map</a></li>
                                    <li><a href="#">Gift Certificates</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Start -->
                    <!-- Single Footer Start -->
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="single-footer mb-sm-40">
                            <h3 class="footer-title">Extras</h3>
                            <div class="footer-content">
                                <ul class="footer-list">
                                    <li><a href="#">Newsletter</a></li>
                                    <li><a href="#">Brands</a></li>
                                    <li><a href="#">Gift Certificates</a></li>
                                    <li><a href="#">Affiliate</a></li>
                                    <li><a href="#">Specials</a></li>
                                    <li><a href="#">Site Map</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Start -->
                    <!-- Single Footer Start -->
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="single-footer mb-sm-40">
                            <h3 class="footer-title">My Account</h3>
                            <div class="footer-content">
                                <ul class="footer-list">
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Order History</a></li>
                                    <li><a href="wishlist.html">Wish List</a></li>
                                    <li><a href="#">Newsletter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Start -->
                    <!-- Single Footer Start -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer mb-sm-40">
                            <h3 class="footer-title">My Account</h3>
                            <div class="footer-content">
                                <ul class="footer-list address-content">
                                    <li><i class="lnr lnr-map-marker"></i> Address: 169-C, Technohub, Dubai Silicon Oasis.</li>
                                    <li><i class="lnr lnr-envelope"></i><a href="#"> mail Us: Support@truemart.com </a></li>
                                    <li>
                                        <i class="lnr lnr-phone-handset"></i> Phone: (+800) 123 456 789)
                                    </li>
                                </ul>
                                <div class="payment mt-25 bdr-top pt-30">
                                    <a href="#"><img class="img" src="/img/payment/1.png" alt="payment-image"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Start -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Footer Top End -->
        <!-- Footer Middle Start -->
        <div class="footer-middle text-center">
            <div class="container">
                <div class="footer-middle-content pt-20 pb-30">
                    <ul class="social-footer">
                        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><img src="/img/icon/social-img1.png" alt="google play"></a></li>
                        <li><a href="#"><img src="/img/icon/social-img2.png" alt="app store"></a></li>
                    </ul>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Footer Middle End -->
        <!-- Footer Bottom Start -->
        <div class="footer-bottom pb-30">
            <div class="container">

                <div class="copyright-text text-center">
                    <p>Copyright © 2018 <a target="_blank" href="#">Truemart</a> All Rights Reserved.</p>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Footer Bottom End -->
    </footer>
    <!-- Footer Area End Here -->

    <!-- Quick View Content Start -->
    <div class="main-product-thumbnail quick-thumb-content">
        <div class="container">
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <!-- Main Thumbnail Image Start -->
                                <div class="col-lg-5 col-md-6 col-sm-5">
                                    <!-- Thumbnail Large Image start -->
                                    <div class="tab-content">
                                        <div id="thumb1" class="tab-pane fade show active">
                                            <a data-fancybox="images_product_quick" href="/img/products/35.jpg"><img src="/img/products/35.jpg" alt="product-view"></a>
                                        </div>
                                        <div id="thumb2" class="tab-pane fade">
                                            <a data-fancybox="images_product_quick" href="/img/products/13.jpg"><img src="/img/products/13.jpg" alt="product-view"></a>
                                        </div>
                                        <div id="thumb3" class="tab-pane fade">
                                            <a data-fancybox="images_product_quick" href="/img/products/15.jpg"><img src="/img/products/15.jpg" alt="product-view"></a>
                                        </div>
                                        <div id="thumb4" class="tab-pane fade">
                                            <a data-fancybox="images_product_quick" href="/img/products/4.jpg"><img src="/img/products/4.jpg" alt="product-view"></a>
                                        </div>
                                        <div id="thumb5" class="tab-pane fade">
                                            <a data-fancybox="images_product_quick" href="/img/products/5.jpg"><img src="/img/products/5.jpg" alt="product-view"></a>
                                        </div>
                                    </div>
                                    <!-- Thumbnail Large Image End -->
                                    <!-- Thumbnail Image End -->
                                    <div class="product-thumbnail mt-20">
                                        <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                            <a class="active" data-toggle="tab" href="#thumb1"><img src="/img/products/35.jpg" alt="product-thumbnail"></a>
                                            <a data-toggle="tab" href="#thumb2"><img src="/img/products/13.jpg" alt="product-thumbnail"></a>
                                            <a data-toggle="tab" href="#thumb3"><img src="/img/products/15.jpg" alt="product-thumbnail"></a>
                                            <a data-toggle="tab" href="#thumb4"><img src="/img/products/4.jpg" alt="product-thumbnail"></a>
                                            <a data-toggle="tab" href="#thumb5"><img src="/img/products/5.jpg" alt="product-thumbnail"></a>
                                        </div>
                                    </div>
                                    <!-- Thumbnail image end -->
                                </div>
                                <!-- Main Thumbnail Image End -->
                                <!-- Thumbnail Description Start -->
                                <div class="col-lg-7 col-md-6 col-sm-7">
                                    <div class="thubnail-desc fix mt-sm-40">
                                        <h3 class="product-header">Printed Summer Dress</h3>
                                        <div class="pro-price mtb-30">
                                            <p class="d-flex align-items-center"><span class="prev-price">16.51</span><span class="price">$15.19</span><span class="saving-price">save 8%</span></p>
                                        </div>
                                        <p class="mb-20 pro-desc-details">Long printed dress with thin adjustable straps. V-neckline and wiring under the bust with ruffles at the bottom of the dress.</p>
                                        <div class="product-size mb-20 clearfix">
                                            <label>Size</label>
                                            <select class="">
                                                <option>S</option>
                                                <option>M</option>
                                                <option>L</option>
                                            </select>
                                        </div>
                                        <div class="color mb-20">
                                            <label>color</label>
                                            <ul class="color-list">
                                                <li>
                                                    <a class="orange active" href="#"></a>
                                                </li>
                                                <li>
                                                    <a class="paste" href="#"></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="box-quantity d-flex">
                                            <form action="#">
                                                <input class="quantity mr-40" type="number" min="1" value="1">
                                            </form>
                                            <a class="add-cart" href="cart.html">add to cart</a>
                                        </div>
                                        <div class="pro-ref mt-15">
                                            <p><span class="in-stock"><i class="ion-checkmark-round"></i> IN STOCK</span></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Thumbnail Description End -->
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="custom-footer">
                            <div class="socila-sharing">
                                <ul class="d-flex">
                                    <li>share</li>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Content End -->
</div>
<!-- Main Wrapper End Here -->

<!-- jquery 3.2.1 -->
<script src="/js/vendor/jquery-3.2.1.min.js"></script>
<!-- Countdown js -->
<script src="/js/jquery.countdown.min.js"></script>
<!-- Mobile menu js -->
<script src="/js/jquery.meanmenu.min.js"></script>
<!-- ScrollUp js -->
<script src="/js/jquery.scrollUp.js"></script>
<!-- Nivo slider js -->
<script src="/js/jquery.nivo.slider.js"></script>
<!-- Fancybox js -->
<script src="/js/jquery.fancybox.min.js"></script>
<!-- Jquery nice select js -->
<script src="/js/jquery.nice-select.min.js"></script>
<!-- Jquery ui price slider js -->
<script src="/js/jquery-ui.min.js"></script>
<!-- Owl carousel -->
<script src="/js/owl.carousel.min.js"></script>
<!-- Bootstrap popper js -->
<script src="/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="/js/bootstrap.min.js"></script>
<!-- Plugin js -->
<script src="/js/plugins.js"></script>
<!-- Main activaion js -->
<script src="/js/main.js"></script>
</body>

</html>