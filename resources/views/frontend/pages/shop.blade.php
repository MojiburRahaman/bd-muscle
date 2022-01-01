@extends('frontend.master')
@section('title')
BD Muscle - Shop
@endsection
@section('content')
<style>
    .loadMore_btn {
        display: inline-block;
        padding: 8px 40px;
        border: 1px solid #ef4836;
        font-weight: 500;
        color: #ef4836;
        margin: 30px 0 0;
    }

    .loadMore_btn:hover {

        background-color: #ef4836;
        color: white;
    }

    li {
        list-style: none;
    }

</style>

<!-- product-area start -->
<div class="product-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="product-menu">
                    <ul class="nav justify-content-center">
                        <li>
                            <a class="active" data-toggle="tab" href="#all">All product</a>
                        </li>
                        @foreach ($catagories as $catagory)
                        <li>
                            <a data-toggle="tab" href="#{{$catagory->slug}}">{{$catagory->catagory_name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <ul class="row">
                    @foreach ($latest_product as $product)
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
                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href={{route('SingleProductView',$product->slug)}}>{{ $product->title }}</a></h3>
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
                                    <div class="product-single-img w-50  mt-5">
                                        @if (collect($product->Attribute)->max('discount') != '')
                                        <span
                                            class="discount_tag">{{collect($product->Attribute)->max('discount')}}%</span>
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
                                            <li><a href="{{route('SingleProductView',$product->slug)}}">Add to Cart</a>
                                            </li>
                                        </ul>
                                        <ul class="cetagory">
                                            <li>Categories:</li>
                                            <li><a
                                                    href="{{route('CategorySearch',$product->Catagory->catagory_name)}}">{{ $product->Catagory->catagory_name }}</a>
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
                </ul>
                <ul class="row" id="ajax-data">

                </ul>
                <ul class="no_data" style="display: none">
                    <li class="text-center"> No More Product</li>
                </ul>
                @if ($latest_product->links() != '')
                <li class="col-12 text-center">
                    <div class="load_image" style="display: none">
                        <p>
                            <img width="30%" src="{{asset('front/images/Reload-Image-Gif-1.gif')}}" alt="">
                        </p>
                    </div>
                    <a class="loadMore_btn" href="javascript:void(0);">Load More</a>
                </li>
                @endif
            </div>
            @foreach ($catagories as $catagory)
            <div class="tab-pane" id="{{$catagory->slug}}">
                <ul class="row">
                    @forelse ($catagory->Product as $product)
                    @if ($product->status == 1)
                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                        <div class="product-wrap">
                            <div class="product-img">
                                @if (collect($product->Attribute)->min('discount') != '')
                                <span style=" z-index: 2">{{collect($product->Attribute)->max('discount')}}%</span>
                                @endif

                                <img src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}"
                                    alt="{{ $product->title }}">
                                <div class="product-icon flex-style">
                                    <ul>
                                        <li><a data-toggle="modal" data-target="#ModalCenter{{$product->id}}"
                                                href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
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
                    <div class="modal fade" id="ModalCenter{{ $product->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body d-flex">
                                    <div class="product-single-img w-50 mt-5">
                                        @if (collect($product->Attribute)->max('discount') != '')
                                        <span
                                            class="discount_tag">{{collect($product->Attribute)->max('discount')}}%</span>
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
                                            <li><a href="{{route('SingleProductView',$product->slug)}}">Add to Cart</a>
                                            </li>
                                        </ul>
                                        <ul class="cetagory">
                                            <li>Categories:</li>
                                            <li><a
                                                    href="{{route('CategorySearch',$product->Catagory->catagory_name)}}">{{ $product->Catagory->catagory_name }}</a>
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
                    @else
                    <li>No Product</li>
                    @endif
                    @empty
                    <li>No Product</li>
                    @endforelse
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- product-area end -->

@endsection


@section('script_js')

<script>
    var page = 1;
    $(document).on('click', '.loadMore_btn', function(event){
    page++;
    loadMoreData(page)
    // alert('ok');
 });

function loadMoreData(page){
     $('.loadMore_btn').hide();
    $('.load_image').show();
    $.ajax({
        url:'?page=' + page,
        type:'get',
    })
    .done(function(data){
        if(data.html == ""){
         $('.loadMore_btn').hide();
        $('.load_image').hide();
        $('.no_data').show();
           
            return;
        }
        // $(".result").html( val +data.total);
        // $(".result").load(location.href + " .result");
        $('#ajax-data').append(data.html);
        $('.load_image').hide();
        $('.loadMore_btn').show();
    })
}
</script>
@endsection