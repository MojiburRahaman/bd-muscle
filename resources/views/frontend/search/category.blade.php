@extends('frontend.master')
@section('title') @if (url()->current() == route('Frontendhome'))
Search Result for "{{$search}}" BD-Muscle
@else
{{$category->catagory_name}} BD-Mucle
@endif @endsection
@section('content')

<style>
    li {
        list-style: none;
    }

    * {
        margin: 0px;
        padding-top: 0px;
    }

    i {
        padding-top: 10px;
    }

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
    .max_price {
	float: right;
	padding-left: 30px;
	color: black;
	background: white;
}
    .min_price {
	color: black;
	background: white;
}

</style>
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
                        <form action="{{route('Frontendhome')}}">
                            <input name="search" value="{{$search}}" type="text" placeholder="Search Here...">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    {{-- <div class="product-filter">
                        <h4 class="widget-title">Filter by Price</h4>
                        <div class="filter-price">
                            <form action="{{url()->current()}}" method="GET">
                                <input type="text" name="min_price" min=0 max="9900" value="0" oninput="validity.valid||(value='0');"
                                id="min_price" class="price-range-field min_price" />
                                <div id="slider-range" class="price-filter-range" name="rangeInput">
                                    <input type="text" min=0 max="10000" value="10000" name="max_price"
                                            oninput="validity.valid||(value='10000');" id="max_price"
                                            class="price-range-field max_price" />
                                </div>
                             
                                
                                <div class="row mt-4">
                                    <div class="col-7">

                                    </div>
                                    <div class="col-5  text-right">
                                        <button type="submit" style="margin-left:90px;margin-top:10px">filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="widget widget_categories">
                        <h4 class="widget-title">Categories</h4>
                        <ul>
                            @foreach ($Categories as $catagory)

                            <li><a href="{{route('CategorySearch',$catagory->slug)}}">{{$catagory->catagory_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="col-lg-9 col-12">
                <div class="row mb-30">
                    <div class="col-sm-4 col-12">
                        @if ($category != '')
                        <h3 style="color: #ef4836;">{{$category->catagory_name}}</h3>
                        @endif
                        <p class="test">Result : <span class="result">{{$Products->count()}}</span> Product </p>
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
                                                <li>
                                                    <a data-toggle="modal" style="padding-top: 7px"
                                                        data-target="#exampleModalCenter{{ $product->id }}"
                                                        href="javascript:void(0);"><i style="padding-top: 0"
                                                            class="fa fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="wishlist.html" style="padding-top: 7px"><i
                                                            style="padding-top: 0" class="fa fa-heart"></i></a>
                                                </li>
                                                <li>
                                                    <a href="cart.html" style="padding-top: 7px"><i
                                                            style="padding-top: 0" class="fa fa-shopping-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a
                                                href="{{route('SingleProductView',$product->slug)}}">{{ $product->title }}</a>
                                        </h3>
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
                            @empty
                            No Product
                            @endforelse
                        </ul>
                        <ul id="ajax-data">

                        </ul>
                        <ul class="no_data" style="display: none">
                            <li class="text-center"> No More Product</li>
                        </ul>
                        @if (url()->current() != route('Frontendhome') )

                        {{$Products->links('frontend.paginator')}}
                        @else
                        @if ($Products->links() != '')
                        <li class="col-12 text-center">
                            <div class="load_image" style="display: none">
                                <p>
                                    <img width="30%" src="{{asset('front/images/Reload-Image-Gif-1.gif')}}" alt="">
                                </p>
                            </div>
                            <a class="loadMore_btn" href="javascript:void(0);">Load More</a>
                        </li>
                        @endif
                        @endif
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


$("#slider-range").slider({
  range: true,
  orientation: "horizontal",
  min: 0,
  max: 10000,
  values: [0, 10000],
  step: 100,

  slide: function (event, ui) {
    if (ui.values[0] == ui.values[1]) {
      return false;
    }
    
    $("#min_price").val(ui.values[0]);
    $("#max_price").val(ui.values[1]);
  }
});


</script>
@endsection



{{-- @section('script_js')
<script>
alert('ok');
    
    function loadMoreData(page){
        $.ajax({
            url:'?page=' + page,
            type='get'
            .done(function(data){
                if (data.html == ''){
                    $('.ajax-load').html("No Product");
                    return;
                }
                $('#ajax-data').append(data.html);
            })
            .fail(function(jqXHR,ajaxOptions){
                alert('server error'); 
            })

        })
    }
    var page = 1;
    // ('.loadmore-btn').onclick(function(){
    //     alert('ok');
    // }})
alert('ok');
$(document).on('click', '.btn-regular', function(event){
// event.preventDefault();
// var page = $(this).attr('href').split('page=')[1];
// fetch_data(page);
alert('ok');
});
</script>

@endsection --}}