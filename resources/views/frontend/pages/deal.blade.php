@extends('frontend.master')

@section('content')
<style>
    .count-down-area {
        @if ($Best_deal->deal_banner != '')
            
        background-image: url('{{asset('deal_banner/'.$Best_deal->deal_banner)}}')
        @else
        background-image: none;
            background-color:@php echo $Best_deal->deal_backgraound_color; @endphp;
        @endif
    }

</style>
{{-- count-down-area --}}
<div class="ptb-100">
    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">{{$Best_deal->title}} </h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<div class="ptb-100">
    <div class="container">
        <ul class="row">
            @foreach ($deal_products as $deal)
            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <div class="product-wrap">
                    <div class="product-img">
                        @if (collect($deal->Product->Attribute)->min('discount') != '')
                        <span style=" z-index: 2">{{collect($deal->Product->Attribute)->max('discount')}}%</span>
                        @endif
                        <img loading="lazy" src="{{ asset('thumbnail_img/' . $deal->Product->thumbnail_img) }}"
                            alt="{{ $deal->Product->title }}">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $deal->Product->id }}"
                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{route('SingleProductView',$deal->Product->slug)}}"><i
                                            class="fa fa-heart"></i></a></li>
                                <li><a href="{{route('SingleProductView',$deal->Product->slug)}}"><i
                                            class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href={{route('SingleProductView',$deal->Product->slug)}}>{{ $deal->Product->title }}</a></h3>
                        @php
                        $sale = collect($deal->Product->Attribute)->min('sell_price');
                        $regular = collect($deal->Product->Attribute)->min('regular_price');
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
            <div class="modal fade" id="exampleModalCenter{{ $deal->Product->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body d-flex">
                            <div class="product-single-img w-50  mt-5">
                                @if (collect($deal->Product->Attribute)->max('discount') != '')
                                <span class="discount_tag">{{collect($deal->Product->Attribute)->max('discount')}}%</span>
                                @endif
                                <img src="{{ asset('thumbnail_img/' . $deal->Product->thumbnail_img) }}"
                                    alt="{{ $deal->Product->title }}">
                            </div>
                            <div class="product-single-content w-50">
                                <h3>{{ $deal->Product->title }}</h3>
                                <div class="rating-wrap fix">
                                    <span class="pull-left">৳
                                        @php
                                        $sale = collect($deal->Product->Attribute)->min('sell_price');
                                        $regular = collect($deal->Product->Attribute)->min('regular_price');
                                        if ($sale == '') {
                                        echo $regular;
                                        } else {
                                        echo $sale;
                                        }
                                        @endphp
                                    </span>
                                </div>
                                <p>{{ $deal->Product->product_summary }}</p>
                                <ul class="input-style">
                                    <li class="quantity cart-plus-minus">
                                        <input type="text" value="1" />
                                    </li>
                                    <li><a href="{{route('SingleProductView',$deal->Product->slug)}}">Add to Cart</a>
                                    </li>
                                </ul>
                                <ul class="cetagory">
                                    <li>Categories:</li>
                                    <li><a
                                            href="{{route('CategorySearch',$deal->Product->Catagory->catagory_name)}}">{{ $deal->Product->Catagory->catagory_name }}</a>
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
        <div class="mt-4">
            {{$deal_products->links('frontend.paginator')}}
        </div>
    </div>
    
</div>


@endsection
@section('script_js')
<script>
     @if ($deal != '') 
   if ($("#clock").length) {
        $('#clock').countdown('{{$Best_deal->expire_date .','. $Best_deal->expire_time}}', function(event) {
        // $('#clock').countdown('{{$Best_deal->expire_date}},{{$deal->expire_time}}', function(event) {
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
</script>
@endsection
