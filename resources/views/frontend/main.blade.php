@extends('frontend.master')
@section('content')
<!-- slider-area start -->
<div class="slider-area">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @forelse ($banners as $banner)
            @if ($banner->product_id != '')
            <div class="swiper-slide overlay">
                <div class="single-slider slide-inner ">
                    <div class="container">
                        <div class="row">
                            <div class=" col-lg-6 col-7 col-sm-6">
                                <div class="mt-lg-5 pt-lg-5">
                                    <div class="slider-content slider-content3">
                                        <h2 class="text-left">{{$banner->Product->title}}</h2>
                                        @if (collect($banner->Product->Attribute)->max('discount') != '')
                                        <h6>
                                            <p style="padding-bottom: 0"> 
                                                <span style="color: red;font-size:25px">
                                                   ৳  {{collect($banner->product->Attribute)->min('sell_price')}}
                                               </span>
                                               <span style="font-size:25px;text-decoration:line-through" class="pl-2">
                                                   ৳  {{collect($banner->Product->Attribute)->min('regular_price')}}
                                           </span>
                                        </p>
                                        <br>
                                             <span style="color: red;font-size:25px" >
                                                {{collect($banner->Product->Attribute)->max('discount')}}%
                                            </span>
                                            Discount 
                                           
                                        </h6>
                                        @else
                                        <h6>
                                            <span style="color: red;font-size:25px">
                                                ৳ {{collect($banner->Product->Attribute)->min('regular_price')}}
                                            </span>
                                        </h6>

                                        @endif
                                        <a href="{{route('SingleProductView',$banner->Product->slug)}}"
                                            data-swiper-parallax="-300"
                                            style="transition-duration: 1000ms; transform: translate3d(0px, 0px, 0px);width:90px;height:40px;line-height:40px">Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-lg-6 col-5 col-sm-6">
                                <div class="slider-content slider-content3">
                                    <img loading="lazy"
                                        src="{{asset('thumbnail_img/'.$banner->Product->thumbnail_img)}}"
                                        alt="{{$banner->Product->title}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($banner->banner_image != '')
            <style>
                .slide{{$loop->index+1}} {
                    background-image: url('{{asset('banner_image/'.$banner->banner_image)}}');
                    background-position: center;
                    background-size: cover;
                }

            </style>
            <div class="swiper-slide">
                <div class="slide-inner slide{{$loop->index+1}}">
                </div>
            </div>
            @endif
            @empty
            @endforelse
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
                    @foreach ($latest_product as $Product)
                    <div class="featured-wrap">
                        <div class="featured-img">
                            <img loading="lazy" src="{{asset('thumbnail_img/'.$Product->thumbnail_img)}}" alt="">
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
@if ($deal != '')
<style>
    .count-down-area {
        @if ($deal->deal_banner != '')
            
        background-image: url('{{asset('deal_banner/'.$deal->deal_banner)}}')
        @else
        background-image: none;
            background-color:@php echo $deal->deal_backgraound_color; @endphp;
        @endif
    }

</style>
{{-- count-down-area --}}
<div class="count-down-area count-down-area-sub">
    <section class="count-down-section section-padding parallax" data-speed="7">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12 text-center">
                    <h2 class="big">{{$deal->title}} </h2>
                </div>
                <div class="col-12 col-lg-12 text-center">
                    <div class="count-down-clock text-center">
                        <div id="clock">
                        </div>
                    </div>
                    <a  class="loadmore-btn" href="{{route('FrontendDeals')}}">View Items</a>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
@endif
<!-- end count-down-section -->
<!-- product-area start -->
<div class="product-area product-area-2">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Most View</h2>
                    <img src="{{asset('front/images/section-title.png')}}" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            @forelse ($best_seller as $product )
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        @if (collect($product->Attribute)->min('discount') != '')
                        <span style=" z-index: 2">{{collect($product->Attribute)->max('discount')}}%</span>
                        @endif
                        <img loading="lazy" src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}"
                            alt="{{ $product->title }}">
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
                        @php
                        $sale = collect($product->Attribute)->min('sell_price');
                        $regular = collect($product->Attribute)->min('regular_price');
                        @endphp
                        @if ($sale == '')
                        <p class="pull-left"> ৳
                            {{$regular}}
                        </p>
                        @else
                        <p class="pull-left "> ৳
                            {{$sale}}
                        </p>
                        <p style="text-decoration:line-through" class="pull-left pl-2"> ৳
                            {{$regular}}
                        </p>
                        @endif
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
                                @if (collect($product->Attribute)->max('discount') != '')
                                <span class="discount_tag">{{collect($product->Attribute)->min('discount')}}%</span>
                                @endif
                                <img loading="lazy" src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}"
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
                                    @if ($product->product_review_count > 0)
                                    <ul class="rating pull-right">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li>({{$product->product_review_count}} Customar Review)</li>
                                    </ul>
                                    @endif
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
                                    <li><a
                                            href="https://www.facebook.com/sharer/sharer.php?u={{route('SingleProductView',$product->slug)}}&display=popup"><i
                                                class="fa fa-facebook"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            No Product
            @endforelse
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
                    <img src="{{asset('front/images/section-title.png')}}" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            @foreach ($latest_product as $product)
            <li class="mb-4 col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        @if (collect($product->Attribute)->min('discount') != '')
                        <span class="mt-5" style=" z-index: 2">{{collect($product->Attribute)->min('discount')}}%</span>
                        @endif
                        <span style="z-index: 2">New</span>
                        <img lazy="loading" src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}"
                            alt="{{ $product->title }}">
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
                        @php
                        $sale = collect($product->Attribute)->min('sell_price');
                        $regular = collect($product->Attribute)->min('regular_price');
                        @endphp
                        @if ($sale == '')
                        <p class="pull-left"> ৳
                            {{$regular}}
                        </p>
                        @else
                        <p class="pull-left "> ৳
                            {{$sale}}
                        </p>
                        <p style="text-decoration:line-through" class="pull-left pl-2"> ৳
                            {{$regular}}
                        </p>
                        @endif
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
                                    @if ($product->product_review_count > 0)
                                    <ul class="rating pull-right">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li>({{$product->product_review_count}} Customar Review)</li>
                                    </ul>
                                    @endif
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
                                    <li>
                                        <a
                                            href="https://www.facebook.com/sharer/sharer.php?u={{route('SingleProductView',$product->slug)}}&display=popup"><i
                                                class="fa fa-facebook"></i></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <li class="col-12 text-center">
                <a class="loadmore-btn" href="{{route('Frontendshop')}}">Load More</a>
            </li>
        </ul>
    </div>
</div>
<!-- product-area end -->

<section id="blog_part" class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center mb-30px0px">
                    <h2 class="title">Whats your <span style="color:#ef4836">Goal?</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($blogs as $blog)
            <div class="col-lg-4 mb-md-30px mb-lm-30px">
                <div class="single-blog ">
                    <div class="blog-image">
                        <a href="{{route('FrontenblogView',$blog->slug)}}">
                            <img lazy="loading" src="{{asset('blogs/thumbnail/'.$blog->blog_thumbnail)}}"
                                class="img-responsive w-100" alt="{{Str::ucfirst($blog->title)}}">
                        </a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar" aria-hidden="true"></i>
                                {{$blog->created_at->format('d M, Y')}}
                            </a>
                            <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i>
                                @if ($blog->blog_comment_count > 999)
                                {{number_format($comments->count(),2)}}k
                                @else
                                {{$blog->blog_comment_count }}
                                @endif
                            </a>
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
<section id="security" class="container">
    <div class="row ptb-50">
        <div class="col-lg-4 col-12 mb-5  ">
            <div class="secure-box">

                <i class="fa fa-unlock"></i>
                <h4>
                    MONEY BACK GUARANTEE</h4>
                <p>Return Within 7 Day..</p>
            </div>
        </div>
        <div class="col-lg-4 col-12 mb-5  ">
            <div class="secure-box">

                <i class="fa fa-lock"></i>
                <h4>100% Authentic Products</h4>
                <p>We only deal with original products.</p>
            </div>
        </div>
        <div class="col-lg-4  col-12 mb-5 ">
            <div class="secure-box">

                <i class="fa fa-truck"></i>
                <h4>Fast Delivery <Service></Service>
                </h4>
                <p>Fast delivery, competitive prices and excellent services.</p>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script_js')
<script>
    @if (session('subscribe'))
   Swal.fire(
     'Thanks',
    '{{session("subscribe")}}',
     'success'
   )
   @endif
    @if (session('orderPlace'))
   Swal.fire(
     'Thanks',
    'Your order is placed order #{{session("orderPlace")}}',
     'success'
   )
   @endif

    @if ($deal != '') 
   if ($("#clock").length) {
        $('#clock').countdown('{{$deal->expire_date .','. $deal->expire_time}}', function(event) {
        // $('#clock').countdown('2022-01-09,10:00', function(event) {
            var $this = $(this).html(event.strftime('' +
                '<div class="box"><div>%m</div> <span>month</span> </div>' +
                '<div class="box"><div>%D</div> <span>Days</span> </div>' +
                '<div class="box"><div>%H</div> <span>Hours</span> </div>' +
                '<div class="box"><div>%M</div> <span>Mins</span> </div>' +
                '<div class="box"><div>%S</div> <span>Secs</span> </div>'));
        });
    }
   @endif
@auth
$.fn.cornerpopup({
variant: 5,
slide: 1,
displayOnce : 1,
position : 'left',
timeOut : '10000',
text2 : '<h6><span style="color:#ef4836">Hey,</span> {{Auth()->user()->name}}</h6>Welcome to {{config('app.name')}}',
colors : '#ef4836',
});
@endauth
</script>
@endsection