@extends('frontend.master');
@section('content')

<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shop Page</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Shop</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- product area start --}}
<div class="product-area ptb-100 product-sidebar-area">
    <div class="container">
        <div class="row revarce-wrap">
            <div class="col-lg-3 col-12">
                <aside class="sidebar-area">
                    <div class="widget widget_search">
                        <h4 class="widget-title">Search Product</h4>
                        <form action="#" class="searchform">
                            <input type="text" name="s" placeholder="Search Product...">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="product-filter">
                        <h4 class="widget-title">Filter by Price</h4>
                        <div class="filter-price">
                            <form action="#">
                                <div id="slider-range"
                                    class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                    <div class="ui-slider-range ui-widget-header ui-corner-all"
                                        style="left: 0%; width: 46.8085%;"></div><span
                                        class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                        style="left: 0%;"></span><span
                                        class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                        style="left: 46.8085%;"></span>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <p>Price :
                                            <input type="text" id="amount">
                                        </p>
                                    </div>
                                    <div class="col-5 text-right">
                                        <button>filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="widget widget_categories">
                        <h4 class="widget-title">Categories</h4>
                        <ul>
                            @foreach ($Categories as $catagory)
                                
                            <li><a href="{{route('CategorySearch',$catagory->slug)}}">{{$catagory->catagory_name}}</a></li>
                            @endforeach
                            {{-- <li><a href="#">Honey</a></li>
                            <li><a href="#">Olive Oil</a></li>
                            <li><a href="#">Nut Oil</a></li>
                            <li><a href="#">Mustard Oil</a></li>
                            <li><a href="#">Sunrise Oil</a></li> --}}
                        </ul>
                    </div>
                    {{-- <div class="widget widget_recent_entries">
                        <h4 class="widget-title">Related Product</h4>
                        <ul>
                            <li>
                                <div class="post-img">
                                    <img src="assets/images/post/1.jpg" alt="">
                                </div>
                                <div class="post-content">
                                    <a href="shop.html">Mustard Oil</a>
                                    <p>$478.56</p>
                                </div>
                            </li>
                            <li>
                                <div class="post-img">
                                    <img src="assets/images/post/2.jpg" alt="">
                                </div>
                                <div class="post-content">
                                    <a href="shop.html">Mustard Oil</a>
                                    <p>$245.56</p>
                                </div>
                            </li>
                            <li>
                                <div class="post-img">
                                    <img src="assets/images/post/3.jpg" alt="">
                                </div>
                                <div class="post-content">
                                    <a href="shop.html">Mustard Oil</a>
                                    <p>$219.56</p>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </aside>
            </div>
            <div class="col-lg-9 col-12">
                <div class="row mb-30">
                    <div class="col-sm-4 col-12">
                      <h3 style="color: #ef4836;">{{$category->catagory_name}}</h3>
                      <p>Result : {{$Products->count()}} Product </p>
                    </div>
                   
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="grid">
                        <ul class="row">
                            @forelse ($Products as $product)

                            <li class="col-lg-4 col-sm-6 col-12">
                                <div class="product-wrap">
                                    <div class="product-img">
                                        <img src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}"
                                            alt="{{ $product->title }}">
                                        <div class="product-icon flex-style">
                                            <ul>
                                                <li><a data-toggle="modal" style="padding-top: 7px"
                                                        data-target="#exampleModalCenter{{ $product->id }}"
                                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="wishlist.html" style="padding-top: 7px"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="cart.html" style="padding-top: 7px"><i class="fa fa-shopping-bag"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="">{{ $product->title }}</a></h3>
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
                                            <div class="product-single-img w-50 text-center mt-5">
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
                                                    <li><a href="cart.html">Add to Cart</a></li>
                                                </ul>
                                                <ul class="cetagory">
                                                    <li>Categories:</li>
                                                    <li><a href="#">{{ $product->Catagory->catagory_name }}</a></li>
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
                        </ul>
                        {{-- <div class="row">
                            <div class="col-12">
                                <div class="pagination-wrapper text-center">
                                    <ul class="page-numbers">
                                        <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a>
                                        </li>
                                        <li><a class="page-numbers" href="#">1</a></li>
                                        <li><span class="page-numbers current">2</span></li>
                                        <li><a class="page-numbers" href="#">3</a></li>
                                        <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="tab-pane product-list" id="list">
                        <ul class="row">
                            <li class="col-12">
                                <div class="product-wrap">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="product-img">
                                                <span>New</span>
                                                <img src="assets/images/product/19.jpg" alt="">
                                                <div class="product-icon flex-style">
                                                    <ul>
                                                        <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                                                href="javascript:void(0);"><i class="fa fa-eye"></i></a>
                                                        </li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="product-content">
                                                <div class="product-text fix">
                                                    <h3><a href="single-product.html">Pure Nature Product</a></h3>
                                                    <span class="pull-left">$351.56</span>
                                                    <ul class="pull-right d-flex">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-half-o"></i></li>
                                                    </ul>
                                                </div>
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It
                                                    has
                                                    roots
                                                    in a piece of classical Latin literature from 45 BC, </p>
                                                <ul class="cart-btn">
                                                    <li><a href="cart.html">Add to Cart</a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-12">
                                <div class="product-wrap">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="product-img">
                                                <span>New</span>
                                                <img src="assets/images/product/20.jpg" alt="">
                                                <div class="product-icon flex-style">
                                                    <ul>
                                                        <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                                                href="javascript:void(0);"><i class="fa fa-eye"></i></a>
                                                        </li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="product-content">
                                                <div class="product-text fix">
                                                    <h3><a href="single-product.html">Pure Nature Product</a></h3>
                                                    <span class="pull-left">$351.56</span>
                                                    <ul class="pull-right d-flex">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-half-o"></i></li>
                                                    </ul>
                                                </div>
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It
                                                    has
                                                    roots
                                                    in a piece of classical Latin literature from 45 BC, </p>
                                                <ul class="cart-btn">
                                                    <li><a href="cart.html">Add to Cart</a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-12">
                                <div class="product-wrap">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="product-img">
                                                <span>New</span>
                                                <img src="assets/images/product/21.jpg" alt="">
                                                <div class="product-icon flex-style">
                                                    <ul>
                                                        <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                                                href="javascript:void(0);"><i class="fa fa-eye"></i></a>
                                                        </li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="product-content">
                                                <div class="product-text fix">
                                                    <h3><a href="single-product.html">Pure Nature Product</a></h3>
                                                    <span class="pull-left">$351.56</span>
                                                    <ul class="pull-right d-flex">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-half-o"></i></li>
                                                    </ul>
                                                </div>
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It
                                                    has
                                                    roots
                                                    in a piece of classical Latin literature from 45 BC, </p>
                                                <ul class="cart-btn">
                                                    <li><a href="cart.html">Add to Cart</a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-12">
                                <div class="product-wrap">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="product-img">
                                                <span>New</span>
                                                <img src="assets/images/product/22.jpg" alt="">
                                                <div class="product-icon flex-style">
                                                    <ul>
                                                        <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                                                href="javascript:void(0);"><i class="fa fa-eye"></i></a>
                                                        </li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="product-content">
                                                <div class="product-text fix">
                                                    <h3><a href="single-product.html">Pure Nature Product</a></h3>
                                                    <span class="pull-left">$351.56</span>
                                                    <ul class="pull-right d-flex">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-half-o"></i></li>
                                                    </ul>
                                                </div>
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It
                                                    has
                                                    roots
                                                    in a piece of classical Latin literature from 45 BC, </p>
                                                <ul class="cart-btn">
                                                    <li><a href="cart.html">Add to Cart</a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-12">
                                <div class="pagination-wrapper text-center">
                                    <ul class="page-numbers">
                                        <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a>
                                        </li>
                                        <li><a class="page-numbers" href="#">1</a></li>
                                        <li><span class="page-numbers current">2</span></li>
                                        <li><a class="page-numbers" href="#">3</a></li>
                                        <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




{{--
@php
$sale = collect($Product->Attribute)->min('sell_price');
$regular = collect($Product->Attribute)->min('regular_price');

@endphp
@if ($sale == '')

<p class="pull-left">৳ {{$regular}} </p>
@else

<p class="pull-left">৳ {{$sale}}</p>
@endif
@if ($sale != '')
<del>৳ {{$regular}} </del>
@endif --}}