@extends('frontend.master')
@section('title')
BD Muscle - Home
@endsection
@section('content')
<!-- slider-area start -->
<div class="slider-area">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide overlay">
                <div class="single-slider slide-inner slide-inner1">
                    <div class="container">
                        <div class="row">
                            {{-- <div class="col-lg-12 col-lg-9 col-12">
                                <div class="slider-content">
                                    <div class="slider-shape">
                                        <h2 data-swiper-parallax="-500">Amazing Pure Nature Hohey</h2>
                                        <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not
                                            simply random text. It has roots in a piece of classical Latin</p>
                                        <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-xl-8 col-lg-9 col-6">
                                <div class="slider-content slider-content3">
                                    <h2>Amazing Pure Nature Hohey</h2>
                                    {{-- <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p> --}}
                                    <a href="shop.html" data-swiper-parallax="-300"
                                        style="transition-duration: 1000ms; transform: translate3d(0px, 0px, 0px);">Shop
                                        Now</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-inner slide-inner7">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-lg-9 col-12">
                                <div class="slider-content">
                                    <div class="slider-shape">
                                        <h2 data-swiper-parallax="-500">Amazing Pure Nature Coconut Oil</h2>
                                        <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not
                                            simply random text. It has roots in a piece of classical Latin</p>
                                        <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-inner slide-inner8">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-lg-9 col-12">
                                <div class="slider-content">
                                    <div class="slider-shape">
                                        <h2 data-swiper-parallax="-500">Amazing Pure Nut Oil</h2>
                                        <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not
                                            simply random text. It has roots in a piece of classical Latin</p>
                                        <a href="shop.html" data-swiper-parallax="-300">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- slider-area end -->
<!-- featured-area start -->
<div class="featured-area featured-area2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="featured-active2 owl-carousel next-prev-style">
            @foreach ($latest_product->take(6) as $Product)
            <div class="featured-wrap">
                <div class="featured-img">
                    <img src="{{asset('thumbnail_img/'.$Product->thumbnail_img)}}" alt="">
                    <div class="featured-content">
                        <a style="padding: 12px 15px"
                            href="{{route('CategorySearch',$Product->Catagory->slug)}}">{{$Product->Catagory->catagory_name}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
<!-- featured-area end -->
<!-- start count-down-section -->
<div class="count-down-area count-down-area-sub">
    <section class="count-down-section section-padding parallax" data-speed="7">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12 text-center">
                    <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random
                            text. It has roots in a piece of classical Latin</span></h2>
                </div>
                <div class="col-12 col-lg-12 text-center">
                    <div class="count-down-clock text-center">
                        <div id="clock">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
<!-- end count-down-section -->
<!-- product-area start -->
<div class="product-area product-area-2">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Best Seller</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            @forelse ($best_seller as $product )
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        {{-- <span style="z-index: 2">New</span> --}}
                        <img src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}" alt="{{ $product->title }}">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $product->id }}"
                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{route('SingleProductView',$product->slug)}}"><i
                                            class="fa fa-heart"></i></a></li>
                                <li><a href="{{route('SingleProductView',$product->slug)}}"><i
                                            class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="{{route('SingleProductView',$product->slug)}}">{{ $product->title }}</a></h3>
                        <p class="pull-left"> ৳
                            @php
                            $sale = collect($product->Attribute)->min('sell_price');
                            $regular = collect($product->Attribute)->min('regular_price');
                            if ($sale == '') {
                            echo $regular;
                            } else {
                            echo $sale;
                            }
                            @endphp

                        </p>
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </li>
            <div class="modal fade" id="exampleModalCenter{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body d-flex">
                            <div class="product-single-img w-50">
                                <img src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}"
                                    alt="{{ $product->title }}">
                            </div>
                            <div class="product-single-content w-50">
                                <h3>{{ $product->title }}</h3>
                                <div class="rating-wrap fix">
                                    <span class="pull-left">৳
                                        @php
                                        $sale = collect($product->Attribute)->min('sell_price');
                                        $regular = collect($product->Attribute)->min('regular_price');
                                        if ($sale == '') {
                                        echo $regular;
                                        } else {
                                        echo $sale;
                                        }
                                        @endphp
                                    </span>
                                    <ul class="rating pull-right">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li>(05 Customar Review)</li>
                                    </ul>
                                </div>
                                <p>{{ $product->product_summary }}</p>
                                <ul class="input-style">
                                    <li class="quantity cart-plus-minus">
                                        <input type="text" value="1" />
                                    </li>
                                    <li><a href="{{route('SingleProductView',$product->slug)}}">Add to Cart</a></li>
                                </ul>
                                <ul class="cetagory">
                                    <li>Categories:</li>
                                    <li>
                                        <a href="{{route('CategorySearch',$product->Catagory->catagory_name)}}">
                                            {{ $product->Catagory->catagory_name }}
                                        </a>
                                    </li>
                                </ul>
                                <ul class="socil-icon">
                                    <li>Share :</li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                No Product
            @endforelse
            {{-- <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        <img src="{{asset('front/images/product/2.jpg')}}" alt="">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="single-product.html">Olive Oil</a></h3>
                        <p class="pull-left">$125

                        </p>
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        <img src="{{asset('front/images/product/3.jpg')}}" alt="">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="single-product.html">Olive Oil</a></h3>
                        <p class="pull-left">$125

                        </p>
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        <img src="{{asset('front/images/product/4.jpg')}}" alt="">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="single-product.html">Coconut Oil</a></h3>
                        <p class="pull-left">$125

                        </p>
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </li> --}}
        </ul>
    </div>
</div>
<!-- product-area end -->
<!-- product-area start -->
<div class="product-area">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Our Latest Product</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            @foreach ($latest_product as $product)
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        <span style="z-index: 2">New</span>
                        <img src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}" alt="{{ $product->title }}">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $product->id }}"
                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{route('SingleProductView',$product->slug)}}"><i
                                            class="fa fa-heart"></i></a></li>
                                <li><a href="{{route('SingleProductView',$product->slug)}}"><i
                                            class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="{{route('SingleProductView',$product->slug)}}">{{ $product->title }}</a></h3>
                        <p class="pull-left"> ৳
                            @php
                            $sale = collect($product->Attribute)->min('sell_price');
                            $regular = collect($product->Attribute)->min('regular_price');
                            if ($sale == '') {
                            echo $regular;
                            } else {
                            echo $sale;
                            }
                            @endphp

                        </p>
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </li>
            <div class="modal fade" id="exampleModalCenter{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body d-flex">
                            <div class="product-single-img w-50">
                                <img src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}"
                                    alt="{{ $product->title }}">
                            </div>
                            <div class="product-single-content w-50">
                                <h3>{{ $product->title }}</h3>
                                <div class="rating-wrap fix">
                                    <span class="pull-left">৳
                                        @php
                                        $sale = collect($product->Attribute)->min('sell_price');
                                        $regular = collect($product->Attribute)->min('regular_price');
                                        if ($sale == '') {
                                        echo $regular;
                                        } else {
                                        echo $sale;
                                        }
                                        @endphp
                                    </span>
                                    <ul class="rating pull-right">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li>(05 Customar Review)</li>
                                    </ul>
                                </div>
                                <p>{{ $product->product_summary }}</p>
                                <ul class="input-style">
                                    <li class="quantity cart-plus-minus">
                                        <input type="text" value="1" />
                                    </li>
                                    <li><a href="{{route('SingleProductView',$product->slug)}}">Add to Cart</a></li>
                                </ul>
                                <ul class="cetagory">
                                    <li>Categories:</li>
                                    <li>
                                        <a href="{{route('CategorySearch',$product->Catagory->catagory_name)}}">
                                            {{ $product->Catagory->catagory_name }}
                                        </a>
                                    </li>
                                </ul>
                                <ul class="socil-icon">
                                    <li>Share :</li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <li class="col-12 text-center">
                <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
            </li>
        </ul>
    </div>
</div>
<!-- product-area end -->
<!-- testmonial-area start -->
{{-- <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                                    piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random
                                    text. It has roots in a piece of classical Latin</p>
                                <h2>Elizabeth Ayna</h2>
                                <p>CEO of Woman Fedaration</p>
                            </div>
                            <div class="test-img2">
                                <img src="assets/images/test/1.png" alt="">
                            </div>
                        </div>
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                                    piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random
                                    text. It has roots in a piece of classical Latin</p>
                                <h2>Elizabeth Ayna</h2>
                                <p>CEO of Woman Fedaration</p>
                            </div>
                            <div class="test-img2">
                                <img src="assets/images/test/1.png" alt="">
                            </div>
                        </div>
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                                    piece of classical LatinContrary to popular belief, Lorem Ipsum is not simply random
                                    text. It has roots in a piece of classical Latin</p>
                                <h2>Elizabeth Ayna</h2>
                                <p>CEO of Woman Fedaration</p>
                            </div>
                            <div class="test-img2">
                                <img src="assets/images/test/1.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



<section id="blog_part" class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center mb-30px0px">
                    <h2 class="title">#blog</h2>
                    {{-- <p class="sub-title">Lorem ipsum dolor sit amet consectetur adipisicing eiusmod. --}}
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($blogs as $blog)

            <div class="col-lg-4 mb-md-30px mb-lm-30px">
                <div class="single-blog ">
                    <div class="blog-image">
                        <a href="{{route('FrontenblogView',$blog->slug)}}">
                            <img src="{{asset('blogs/thumbnail/'.$blog->blog_thumbnail)}}" class="img-responsive w-100"
                                alt="{{Str::ucfirst($blog->title)}}">
                        </a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar" aria-hidden="true"></i>
                                {{$blog->created_at->format('d M, Y')}}
                            </a>
                            <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                K</a>
                        </div>
                        <h5 class="blog-heading mt-2">
                            <a class="blog-heading-link" href="{{route('FrontenblogView',$blog->slug)}}">
                                {{Str::ucfirst($blog->title)}}
                            </a>
                        </h5>

                        <a href="{{route('FrontenblogView',$blog->slug)}}" class="btn btn-primary blog-btn"> Read More<i
                                class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            @empty
            No Blogs
            @endforelse
        </div>
    </div>
</section>
<!-- testmonial-area end -->
<!-- Modal area start -->

<!-- Modal area start -->


@endsection