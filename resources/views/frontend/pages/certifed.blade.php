@extends('frontend.master')
@section('title')
{{config('app.name')}} - Certified
@endsection
@section('content')
<style>
    li {
        list-style: none;
    }

</style>
<div class="ptb-100">
    <div class="container">
        <ul class="row">
            @forelse ($products as $product)
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        @if (collect($product->Attribute)->max('discount') != '')
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
                        <h3><a href={{route('SingleProductView',$product->slug)}}>{{ $product->title }}</a></h3>
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
                        @if ($product->product_review_count)
                            
                        <ul class="pull-right d-flex">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                        @endif
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
                            <div class="product-single-img w-50  mt-5">
                                @if (collect($product->Attribute)->max('discount') != '')
                                <span class="discount_tag">{{collect($product->Attribute)->max('discount')}}%</span>
                                @endif
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
                                    @if ($product->product_review_count)
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
                                    <li><a href="{{route('SingleProductView',$product->slug)}}">Add to Cart</a>
                                    </li>
                                </ul>
                                <ul class="cetagory">
                                    <li>Categories:</li>
                                    <li><a
                                            href="{{route('CategorySearch',$product->Catagory->slug)}}">{{ $product->Catagory->catagory_name }}</a>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            {{-- <li class="text-center">No product</li> --}}
            @endforelse
        </ul>
        <div class="mt-4">
            {{$products->links('frontend.paginator')}}
        </div>
    </div>
    <section id="security" class="container">
        <div class="row mt-5">
            <div class="col-lg-4  col-12 mb-5 ">
                <div class="secure-box">

                    <i class="fa fa-truck"></i>
                    <h4>Fast Delivery <Service></Service>
                    </h4>
                    <p>Fast delivery, competitive prices and excellent services.</p>
                </div>
            </div>
            <div class="col-lg-4  col-12 mb-5 ">
                <div class="secure-box">

                    <i class="fa fa-truck"></i>
                    <h4>Fast Delivery Service
                    </h4>
                    <p>Fast delivery, competitive prices and excellent services.</p>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-5  ">
                <div class="secure-box">

                    <i class="fa fa-unlock"></i>
                    <h4>
                        MONEY BACK GUARANTEE</h4>
                    <p>Return Within 7 Day..</p>
                </div>
            </div>
            <div class="col-lg-6  col-12 mb-5  ">
                <div class="secure-box">

                    <i ><img style="filter: grayscale(100%);margin:18px 0" width="15%" src="{{asset('icon/sss.png')}}" alt=""></i>
                    <h4>Informed Sports Certified</h4>
                    <p>This Product 100% Informed Sports Certified.</p>
                </div>
            </div>
            <div class="col-lg-6  col-12 mb-5 ">
                <div class="secure-box">

                    <i ><img  style="filter: grayscale(100%);margin:18px 0" width="25%" src="{{asset('icon/www.png')}}" alt=""></i>
                    <h4>Banned Substance Free </h4>
                    <p>Every Product 100% Dopping free.</p>
                </div>
            </div>
            
        </div>
    </section>
</div>
@endsection