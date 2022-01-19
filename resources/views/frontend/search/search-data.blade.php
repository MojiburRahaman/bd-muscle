@extends('frontend.master')
@section('title') @if (url()->current() == route('Frontendhome'))
Search Result for "{{$search}}" BD-Muscle
@else
{{$category}} BD-Mucle
@endif @endsection
@section('content')
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
            <div class="widget widget_categories">
                <h4 class="widget-title">Categories</h4>
                <ul>
                    @foreach ($Categories as $catagori)
                    <li class="mb-2"><a href="{{route('CategorySearch',$catagori->slug)}}">{{$catagori->catagory_name}}</a>
                    </li>
                    @forelse ($catagori->Subcatagory as $item)
                    <li style="margin-left: 30px;list-style-type:disc">
                        <a href="{{route('SubCategorySearch',$item->slug)}}">{{$item->subcatagory_name}}</a>
                    </li>
                    @empty

                    @endforelse
                    @endforeach
                </ul>
            </div>

            </aside>
        </div>
        <div class="col-lg-9 col-12">
            <div class="row mb-30">
                <div class="col-sm-4 col-12">
                    @if ($category != '')
                    <h3 style="color: #ef4836;">{{Str::ucfirst($category)}}</h3>
                    @endif
                </div>

            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="grid">
                    <ul class="row">
                        @forelse ($Products as $product)
                        <li class="col-lg-4 col-sm-6 col-12">
                            <div class="product-wrap">
                                <div class="product-img">
                                    @if (collect($product->Attribute)->max('discount') != '')
                                    <span style=" z-index: 2">{{collect($product->Attribute)->max('discount')}}%</span>
                                    @endif
                                    <img src="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}"
                                        alt="{{ $product->title }}">
                                    <div class="product-icon flex-style">
                                        <ul>
                                            <li>
                                                <a data-toggle="modal"
                                                    data-target="#exampleModalCenter{{ $product->id }}"
                                                    href="javascript:void(0);"><i style="padding-top: 0"
                                                        class="fa fa-eye"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('SingleProductView',$product->slug)}}" "><i
                                                           class=" fa fa-heart"></i></a>
                                            </li>
                                            <li>
                                                <a href="{{route('SingleProductView',$product->slug)}}"><i
                                                        style="padding-top: 0" class="fa fa-shopping-bag"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a
                                            href="{{route('SingleProductView',$product->slug)}}">{{ $product->title }}</a>
                                    </h3>
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
                                            <p>{{ $product->product_summary }}</p>
                                            <ul class="input-style">
                                                <li class="quantity cart-plus-minus">
                                                    <input type="text" value="1" />
                                                </li>
                                                <li><a href="{{route('SingleProductView',$product->slug)}}">Add to
                                                        Cart</a></li>
                                            </ul>
                                            <ul class="cetagory">
                                                <li>Categories:</li>
                                                <li><a
                                                        href="{{route('CategorySearch',$product->Catagory->slug )}}">{{ $product->Catagory->catagory_name }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <li class="text-center"> No Product</li>
                        @endforelse
                    </ul>
                    <ul id="ajax-data">

                    </ul>
                    <ul class="no_data" style="display: none">
                        <li class="text-center"> No More Product</li>
                    </ul>
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
                </div>
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