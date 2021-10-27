<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('front/images/favicon.png') }}">
        <!-- Place favicon.ico in the root directory -->
        <!-- all css here -->
        <!-- bootstrap v4.0.0-beta.2 css -->
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
        <!-- owl.carousel.2.0.0-beta.2.4 css -->
        <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
        <!-- font-awesome v4.6.3 css -->
        <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- flaticon.css -->
        <link rel="stylesheet" href="{{ asset('front/css/flaticon.css') }}">
        <!-- jquery-ui.css -->
        <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
        <!-- metisMenu.min.css -->
        <link rel="stylesheet" href="{{ asset('front/css/metisMenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/selectsearch.css') }}">
        <!-- swiper.min.css -->
        <link rel="stylesheet" href="{{ asset('front/css/swiper.min.css') }}">
        <!-- style css -->
        <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
        <!-- modernizr css -->
        <script src="{{ asset('front/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>

    <body>
      <!-- Messenger Chat plugin Code -->
    {{-- <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "181003548728126");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script> --}}
        <!--Start Preloader-->
        {{-- <div class="preloader-wrap">
        <div class="spinner"></div>
    </div> --}}
        <!-- search-form here -->
        <div class="search-area flex-style">
            <span class="closebar">Close</span>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 col-12">
                        <div class="search-form">
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- search-form here -->
        <!-- header-area start -->
        <header class="header-area">
            <div class="header-top bg-2">
                <div class="fluid-container">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <ul class="d-flex header-contact">
                                <li><i class="fa fa-phone"></i> +01 123 456 789</li>
                                <li><i class="fa fa-envelope"></i> youremail@gmail.com</li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-12">
                            <ul class="d-flex account_login-area">
                                <li>
                                    <a href="javascript:void(0);"><i class="fa fa-user"></i> My Account <i
                                            class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        @auth
                                        <li><a target="_blank" href="{{ route('dashboard.index') }}"> Dashboard </a>
                                        </li>
                                        @else
                                        <li><a href="{{ route('login') }}"> Login/Register </a></li>

                                        <li><a href="{{ route('register') }}">Register</a></li>
                                        @endauth

                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="wishlist.html">wishlist</a></li>
                                    </ul>
                                </li>
                                {{-- @auth
                                @if (Auth::user()->roles()->first()->name == 'Customer')

                                <li><a href="{{route('frontendProfile')}}"> <i class="fa fa-user "><span
                                        class="pl-2">Profile</span></i> </a></li>
                                @else
                                <li><a href="{{ route('login') }}"> Login/Register </a></li>
                                @endif
                                @else
                                <li><a href="{{ route('login') }}"> Login/Register </a></li>

                                @endauth --}}
                                @auth
                                <li><a href="{{ route('dashboard.index') }}"> Login/Register </a></li>
                                @else
                                <li><a href="{{ route('login') }}"> Login/Register </a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="fluid-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="assets/images/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 d-none d-lg-block">
                            <nav class="mainmenu">
                                <ul class="d-flex">
                                    <li class="{{ route('Frontendhome') == url()->current() ? 'active' : '' }}"><a
                                            href="{{ route('Frontendhome') }}">Home</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li>
                                        <a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown_style">
                                            <li><a href="shop.html">Shop Page</a></li>
                                            <li><a href="single-product.html">Product Details</a></li>
                                            <li><a href="">Shopping cart</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Pages <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown_style">
                                            <li><a href="about.html">About Page</a></li>
                                            <li><a href="single-product.html">Product Details</a></li>
                                            <li><a href="">Shopping cart</a></li>
                                            <li><a href="">Checkout</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Blog <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown_style">
                                            <li><a href="blog.html">blog Page</a></li>
                                            <li><a href="blog-details.html">blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="">
                                            <i class="fa fa-shopping-cart"></i>
                                            Cart</a>
                                    </li>
                                    <li class="">
                                        <a href="">
                                            <i class="fa fa-shopping-cart"></i>
                                            Checkout</a>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                            <ul class="search-cart-wrapper d-flex">
                                <li class="search-tigger"><a href="javascript:void(0);"><i
                                            class="flaticon-search"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="flaticon-like"></i> <span>2</span></a>
                                    <ul class="cart-wrap dropdown_style">
                                        <li class="cart-items">
                                            <div class="cart-img">
                                                <img src="assets/images/cart/1.jpg" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <a href="cart.html">Pure Nature Product</a>
                                                <span>QTY : 1</span>
                                                <p>$35.00</p>
                                                <i class="fa fa-times"></i>
                                            </div>
                                        </li>
                                        <li class="cart-items">
                                            <div class="cart-img">
                                                <img src="assets/images/cart/3.jpg" alt="">
                                            </div>
                                            <div class="cart-content">
                                                <a href="cart.html">Pure Nature Product</a>
                                                <span>QTY : 1</span>
                                                <p>$35.00</p>
                                                <i class="fa fa-times"></i>
                                            </div>
                                        </li>
                                        <li>Subtotol: <span class="pull-right">$70.00</span></li>
                                        <li>
                                            <button>Check Out</button>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    {{-- ###########cart list############# --}}
                                    <a href="javascript:void(0);"><i class="flaticon-shop"></i>
                                        {{-- <span>{{ cart_total_product() }}</span></a>
                                    @php
                                    $total_cart_amount = 0;
                                    @endphp
                                    <ul class="cart-wrap dropdown_style">
                                        @forelse (cart_product_view() as $cart_product)
                                        <li class="cart-items">
                                            <div>
                                                <img style="width:40%;margin-right:10px;float: left;"
                                                    src="{{ asset('product_thumbnail/' . $cart_product->product->thumbnail) }}"
                                                    alt="{{ $cart_product->product->title }}">
                                            </div>
                                            <div class="cart-content">
                                                <a
                                                    href="{{ route('singleproductview', $cart_product->product->slug) }}">{{ $cart_product->product->title }}</a>
                                                <span>QTY : {{ $cart_product->quantity }}</span>
                                                <p>৳
                                                    @php
                                                    $product = App\Models\attribute::where('product_id',
                                                    $cart_product->product_id)
                                                    ->where('color_id', $cart_product->color_id)
                                                    ->where('size_id', $cart_product->size_id)
                                                    ->first();
                                                    $sale_price = $product->selling_price;
                                                    $regular_price = $product->regular_price;
                                                    if ($sale_price) {
                                                    $total_cart_amount += $sale_price * $cart_product->quantity;

                                                    echo $sale_price * $cart_product->quantity;
                                                    }
                                                    if ($sale_price == '') {
                                                    $total_cart_amount += $regular_price * $cart_product->quantity;

                                                    echo $regular_price * $cart_product->quantity;
                                                    }
                                                    @endphp
                                                </p>
                                            </div>
                                        </li>
                                        @empty
                                        <li>
                                            No Product In Your Cart
                                        </li>
                                        @endforelse --}}
                                        {{-- <li>Subtotol: <span class="pull-right">৳ {{ $total_cart_amount }}</span>
                                </li>
                                <li>
                                    <a class="btn btn-regular"
                                        onMouseOver="this.style.color='white',this.style.backgroundColor='#ef4836'"
                                        onMouseOut="this.style.backgroundColor='#FFFFFF',this.style.color='#ef4836'"
                                        style="background-color:white;color:#ef4836" href="">View
                                        More</a>
                                </li>
                            </ul>
                            {{-- ###########cart list############# --}}

                            </li>
                            </ul>
                        </div>
                        <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                            <div class="responsive-menu-tigger">
                                <a href="javascript:void(0);">
                                    <span class="first"></span>
                                    <span class="second"></span>
                                    <span class="third"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- responsive-menu area start -->
                <div class="responsive-menu-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 d-block d-lg-none">
                                <ul class="metismenu">
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li class="sidemenu-items">
                                        <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
                                        <ul aria-expanded="false">
                                            <li><a href="shop.html">Shop Page</a></li>
                                            <li><a href="single-product.html">Product Details</a></li>
                                            <li><a href="cart.html">Shopping cart</a></li>
                                            <li><a href="">Checkout</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                        </ul>
                                    </li>
                                    <li class="sidemenu-items">
                                        <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages </a>
                                        <ul aria-expanded="false">
                                            <li><a href="about.html">About Page</a></li>
                                            <li><a href="single-product.html">Product Details</a></li>
                                            <li><a href="cart.html">Shopping cart</a></li>
                                            <li><a href="">Checkout</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                        </ul>
                                    </li>
                                    <li class="sidemenu-items">
                                        <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
                                        <ul aria-expanded="false">
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- responsive-menu area start -->
            </div>
        </header>
        <!-- header-area end -->
        @yield('content')
        <!-- start social-newsletter-section -->
        <section class="social-newsletter-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="newsletter text-center">
                            <h3>Subscribe Newsletter</h3>
                            <div class="newsletter-form">
                                <form>
                                    <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                                    <button type="submit"><i class="fa fa-send"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </section>
        <!-- end social-newsletter-section -->
        <!-- .footer-area start -->
        <div class="footer-area">
            <div class="footer-top">
                <div class="container">
                    <div class="footer-top-item">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="footer-top-text text-center">
                                    <ul>
                                        <li><a href="home.html">home</a></li>
                                        <li><a href="#">our story</a></li>
                                        <li><a href="#">feed shop</a></li>
                                        <li><a href="blog.html">how to eat blog</a></li>
                                        <li><a href="contact.html">contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-12">
                            <div class="footer-icon">
                                <ul class="d-flex">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8 col-sm-12">
                            <div class="footer-content">
                                <p>On the other hand, we denounce with righteous indignation and dislike men who are so
                                    beguiled and demoralized by the charms of pleasure righteous indignation and dislike
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-12">
                            <div class="footer-adress">
                                <ul>
                                    <li><a href="#"><span>Email:</span> domain@gmail.com</a></li>
                                    <li><a href="#"><span>Tel:</span> 0131234567</a></li>
                                    <li><a href="#"><span>Adress:</span> 52 Web Bangale , Adress line2 , ip:3105</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="footer-reserved">
                                <ul>
                                    <li>Copyright © 2019 Tohoney All rights reserved.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Messenger Chat plugin Code -->
      
        <!-- Your Chat plugin code -->

        <!-- .footer-area end -->

        <!-- jquery latest version -->
        <script src="{{ asset('front/js/vendor/jquery-2.2.4.min.js') }}"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <!-- owl.carousel.2.0.0-beta.2.4 css -->
        <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
        <!-- scrollup.js -->
        <script src="{{ asset('front/js/scrollup.js') }}"></script>
        <!-- isotope.pkgd.min.js -->
        <script src="{{ asset('front/js/isotope.pkgd.min.js') }}"></script>
        <!-- imagesloaded.pkgd.min.js -->
        <script src="{{ asset('front/js/imagesloaded.pkgd.min.js') }}"></script>
        <!-- jquery.zoom.min.js -->
        <script src="{{ asset('front/js/jquery.zoom.min.js') }}"></script>
        <!-- countdown.js -->
        <script src="{{ asset('front/js/countdown.js') }}"></script>
        <!-- swiper.min.js -->
        <script src="{{ asset('front/js/swiper.min.js') }}"></script>
        <!-- metisMenu.min.js -->
        <script src="{{ asset('front/js/metisMenu.min.js') }}"></script>
        <!-- mailchimp.js -->
        <script src="{{ asset('front/js/mailchimp.js') }}"></script>
        <!-- jquery-ui.min.js -->
        <script src="{{ asset('front/js/jquery-ui.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- main js -->


        <script src="{{ asset('front/js/selectsearch.js') }}"></script>
        <script src="{{ asset('front/js/scripts.js') }}"></script>

        @yield('script_js')
    
    
      <!-- Messenger Chat plugin Code -->
    {{-- <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div> --}}

    {{-- <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "181003548728126");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script> --}}
    </body>
    <!-- Mirrored from themepresss.com/tf/html/tohoney/index.html by HTTrack Website Copier/3.x
            [XR&CO'2014], Fri, 13 Mar 2020 03:33:34 GMT -->

</html>