@extends('frontend.master')
@section('title')
{{$product->title}} @endsection
@section('meta_description')
{{$product->meta_description}} @endsection
@section('meta_keyword')
{{$product->meta_keyword}} @endsection
@section('social_thumbnail')
<meta property="og:image" content="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}" />
<meta property="og:image:url" content="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}" />
<meta property="og:image:secure_url" content="{{ asset('thumbnail_img/' . $product->thumbnail_img) }}" />
<meta property="og:image:height" content="640" />
<meta property="og:image:height" content="640" />
@endsection
@section('content')
<!-- .breadcumb-area end -->
<!-- single-product-area start-->
@if (session('cart_added'))
<div class="container">
    <div class="alert alert-dismissible alert-success">{{session('cart_added')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="single-product-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-single-img">
                    <div class="product-active owl-carousel">
                        @foreach ($product->Gallery as $Gallery)

                        <div class="item">
                            <img loading="lazy" src="{{asset('product_image/'.$Gallery->product_img)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                    <div class="product-thumbnil-active  owl-carousel">
                        @foreach ($product->Gallery as $Gallery)

                        <div class="item">
                            <img loading="lazy" src="{{asset('product_image/'.$Gallery->product_img)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-single-content">
                    <h3>{{$product->title}}</h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">
                            @php
                            // regular price and selling price
                            $sale = collect($product->Attribute)->min('sell_price');
                            $regular = collect($product->Attribute)->min('regular_price');
                            @endphp
                            {{-- #######  regular price section start  ######### --}}

                            {{-- if theres available selling price regular price add into this field by ajax --}}
                            @if ($regular != '')
                            {{-- if regular price available --}}
                            <span @if ($sale !='' ) style="text-decoration:line-through;padding-right:8px" @endif
                                class="pull-left regular_Price"> ৳
                                {{ $regular }}
                            </span>
                            @endif
                            {{-- if theres no selling price available regular price add into this field ajax --}}
                            <span class="pull-left regular_Price_if_selling_null"></span>

                            {{-- #######  regular price section end  ######### --}}

                            {{-- #######  selling price section start  ######### --}}

                            @if ($sale != '')
                            {{-- if selling price available --}}
                            <span class="pull-left sell_Price"> ৳
                                {{ $sale }}
                            </span> &nbsp;&nbsp;
                            @endif
                            {{-- #######  selling price section end  ######### --}}

                            {{-- quantity section --}}
                            @if ($product->Attribute->sum('quantity') != 0)

                            <span style="display:none">(<span
                                    class="available">{{ $product->Attribute->sum('quantity') }}</span> &nbsp;Product
                                Available)</span>
                            @else
                            (<span>Out of Stock</span>)
                            @endif
                    </div>
                    <form action="" id="Form_submit" method="POST">
                        @csrf
                        <p>{{$product->product_summary}}</p>
                        @if ($product->Attribute->sum('quantity') != 0)

                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input name="cart_quantity" type="text" value="1" />
                            </li>
                            <li>
                                <button type="submit" id="Cart_add"
                                    style="padding:5px 7px;border:none;background:#ef4836;color:white;border-radius:5%">
                                    Add to Cart
                                </button>
                            </li>
                            <button id="wishlist" href=""><i class="fa fa-heart"></i></button>
                        </ul>
                        <input type="hidden" value="{{$product->id}}" name="product_id">
                        @if ($color != '')
                        <ul class="cetagory">
                            @php
                            $attribute = collect($product->Attribute);
                            $group = $attribute->unique('color_id')
                            @endphp

                            <li>Color:</li>
                            @foreach ($group as $color)
                            @if ($color->color_id != 1)
                            <input class=" {{($size == '')? 'no_size_color' : 'color_name'}}" type="radio"
                                name="color_id" id="color_id{{$color->Color->id}}" value="{{$color->Color->id}}"
                                data-product="{{$product->id}}">
                            <label for="color_id{{$color->Color->id}}">{{$color->Color->color_name}}</label>&nbsp;
                            @endif
                            @endforeach
                        </ul>
                        @if ($size != '')

                        <ul class="cetagory">
                            <li>Size:</li>
                            <li class="size_add"></li>
                        </ul>
                        @else
                        <input type="hidden" name="size_id" value="1">
                        @endif

                        @else

                        @if ($size != '')
                        <ul class="cetagory">

                            <li>Size:</li>
                            @foreach ($product->Attribute as $Attribute)
                            <input class="form-group SizebyPrice" type="radio" name="size_id"
                                data-product="{{$product->id}}" id="size_id{{$Attribute->Size->id}}"
                                value="{{$Attribute->Size->id}}">
                            <label class="form-group"
                                for="size_id{{$Attribute->Size->id}}">{{$Attribute->Size->size_name}}</label> &nbsp;
                            @endforeach
                        </ul>
                        <input type="hidden" name="color_id" value="1">
                        @endif

                        @endif
                        @if ($color == '')

                        <input type="hidden" name="color_id" value="1">
                        @endif
                        @if ($size == '')

                        <input type="hidden" name="size_id" value="1">
                        @endif
                        @if ($product->flavour_count != 0)

                        <ul class="cetagory" style="margin-bottom: 10px">
                            <li>Flavour:</li>
                            <li>
                                <select name="flavour_id" disabled id="flavour_id"
                                    class="form-control ml-2 @error('flavour_id') is-invalid @enderror">
                                    {{-- @if ($product->flavour_count != 1)
                                    <option value="">Select One</option>
                                    @endif
                                    @foreach ($product->Flavour as $Flavour)
                                    <option value="{{$Flavour->id}}">{{$Flavour->flavour_name}}</option>
                                    @endforeach --}}
                                </select>
                            </li>
                        </ul>
                        @endif
                        @endif

                        @if ($product->brand_id != '')
                        <ul class="cetagory" style="margin-bottom: 10px">
                            <li>Brand:</li>
                            <li>
                                <a class="ml-2" href="{{route('BrandSearch',$product->Brand->slug)}}">
                                    <img width="60" src="{{asset('brand_img/'.$product->Brand->brand_img)}}"
                                        title="{{$product->Brand->brand_name}}" alt="{{$product->Brand->brand_name}}">
                                </a>
                            </li>
                        </ul>
                        @endif
                        <ul class="cetagory">
                            <li>Categories:</li>
                            <li><a
                                    href="{{route('CategorySearch',$product->Catagory->slug)}}">{{$product->Catagory->catagory_name}}</a>
                            </li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li> <a
                                    href="https://www.facebook.com/sharer/sharer.php?u={{route('SingleProductView',$product->slug)}}&display=popup"><i
                                        class="fa fa-facebook"></i></a></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-12">
                <div class="single-product-menu">
                    <ul class="nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                        <li><a data-toggle="tab" href="#review">Review</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <div class="description-wrap">
                            <p> {!! nl2br($product->product_description) !!}</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="review">
                        <div class="review-wrap">
                            <ul>
                                @forelse ($product->ProductReview as $review)

                                <li class="review-items">
                                    <div class="review-content">
                                        <h3><a href="#">{{$review->name}}</a></h3>
                                        {{-- <span>27 Jun, 2019 at 2:30pm</span> --}}
                                        <span>{{$review->created_at->format('d M, Y') }}</span>
                                        <p>{{$review->message}}</p>
                                        <ul class="rating">
                                            @if ($review->rating ==1)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            @endif
                                            @if ($review->rating ==2)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            @endif
                                            @if ($review->rating ==3)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            @endif
                                            @if ($review->rating ==4)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            @endif
                                            @if ($review->rating ==5)
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                                @empty
                                <li>
                                    No Review
                                </li>
                                @endforelse
                            </ul>
                        </div>
                        <style>
                            .rate {
                                float: left;
                                height: 46px;
                                padding: 0 10px;
                            }

                            .rate:not(:checked)>input {
                                position: absolute;
                                left: -9999px;
                            }

                            .rate:not(:checked)>label {
                                float: right;
                                width: 1em;
                                overflow: hidden;
                                white-space: nowrap;
                                cursor: pointer;
                                font-size: 30px;
                                color: #ccc;
                            }

                            .rate:not(:checked)>label:before {
                                content: '★ ';
                            }

                            .rate>input:checked~label {
                                color: #ffc700;
                            }

                            .rate:not(:checked)>label:hover,
                            .rate:not(:checked)>label:hover~label {
                                color: #deb217;
                            }

                            .rate>input:checked+label:hover,
                            .rate>input:checked+label:hover~label,
                            .rate>input:checked~label:hover,
                            .rate>input:checked~label:hover~label,
                            .rate>label:hover~input:checked~label {
                                color: #c59b08;
                            }

                        </style>
                        <form action="{{route('ProductReview')}}" method="post">
                            @csrf
                            <div class="add-review">

                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <h4>Rate this Product</h4>
                                        <div class="rate ">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="5 star">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="4 star">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="3 star">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="2 star">2 stars</label>
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="1 star">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h4>Name:</h4>
                                        <input type="text" name="name" placeholder="Your name here..." />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h4>Email:</h4>
                                        <input type="email" name="email" placeholder="Your Email here..." />
                                    </div>
                                    <div class="col-12">
                                        <h4>Your Review:</h4>
                                        <textarea name="massage" id="massage" cols="30" rows="10"
                                            placeholder="Your review here..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn-style">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- single-product-area end-->
    <!-- featured-product-area start -->
    @if ($product->Catagory->Product->count() != 1)

    <div class="featured-product-area mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-left">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($product->Catagory->Product->take(8) as $Catgory_wise_product)
                @if ($Catgory_wise_product->id != $product->id)
                @if ($Catgory_wise_product->status == 1)
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="featured-product-wrap">
                        <div class="featured-product-img">
                            <a href="{{route('SingleProductView',$Catgory_wise_product->slug)}}">
                                <img src="{{asset('thumbnail_img/'.$Catgory_wise_product->thumbnail_img)}}"
                                    alt="{{$Catgory_wise_product->title}}">
                            </a>
                        </div>
                        <div class="featured-product-content">
                            <div class="row">
                                <div class="col-7">
                                    <h3><a
                                            href="{{route('SingleProductView',$Catgory_wise_product->slug)}}">{{$Catgory_wise_product->title}}</a>
                                    </h3>
                                    <p>৳
                                        @php
                                        $sale = collect($Catgory_wise_product->Attribute)->min('sell_price');
                                        $regular = collect($Catgory_wise_product->Attribute)->min('regular_price');
                                        if ($sale == '') {
                                        echo $regular;
                                        } else {
                                        echo $sale;
                                        }
                                        @endphp

                                    </p>
                                </div>
                                <div class="col-5 text-right">
                                    <ul>
                                        <li><a href="{{route('SingleProductView',$Catgory_wise_product->slug)}}"><i
                                                    class="fa fa-shopping-cart"></i></a></li>
                                        <li><a href="{{route('SingleProductView',$Catgory_wise_product->slug)}}"><i
                                                    class="fa fa-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="container">
        <div class="your-class one-time responsive">
            @foreach ($brands as $brand)
            <div>
                <a href="{{route('BrandSearch',$brand->slug)}}">
                    <img loading="lazy" src="{{asset('brand_img/'.$brand->brand_img)}}" alt="">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- featured-product-area end -->
@endsection

@section('script_js')
<script>
    @error('color_id')
        
    Swal.fire({
        icon: 'warning',
        text: '{{$message}}',
    })
      @enderror
    @error('size_id')
        
    Swal.fire({
        icon: 'warning',
        text: '{{$message}}',
    })
      @enderror
    @error('flavour_id')
        
    Swal.fire({
        icon: 'warning',
        text: '{{$message}}',
    })
      @enderror
    // if therese color available start
    $('.color_name').change(function() {
            var color_id = $(this).val();
            var product_id = $(this).attr('data-product');
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/product/get-size",
           data:{product_id:product_id, color_id:color_id},
           success: function(res) {
                    if (res) {
                        // get size by color
                        $('.size_add').html(res);
                        $('.size_name').change(function() {
                            // get price on change size
                            var regular_price = $(this).attr('data-regular_price');
                            var selling_price = $(this).attr('data-sell_price');
                            var quantity = $(this).attr('data-quantity');
                            $('.available').html(quantity);
                            if (selling_price == '') {
                            $('.sell_Price').html( selling_price);
                                // if theres no selling price
                                $('.regular_Price').empty();
                                $('.regular_Price_if_selling_null').html('৳' +
                                    regular_price);
                            } else {
                            $('.sell_Price').html('৳' + selling_price);
                                // if theres a selling price
                                $('.regular_Price_if_selling_null').empty();
                                $('.regular_Price').html('৳'+regular_price);
                            }
                        })

                    }
                }
            })
        });
    // if therese color available end

    // if therese color but no size available start
    $('.no_size_color').change(function() {
            var color_id = $(this).val();
            var product_id = $(this).attr('data-product');
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/product/get-size",
           data:{product_id:product_id, color_id:color_id},
           success: function(res) {
            if (res) {
                // get price and quantity
                        $('.available').html(res);
                        var regular_price = $('.quantityadd').attr('data-regularprice');
                        var selling_price = $('.quantityadd').attr('data-sellprice');
                        if (selling_price == '') {
                            // if theres no selling price
                        $('.sell_Price').html(selling_price);
                            $('.regular_Price').empty();
                            $('.regular_Price_if_selling_null').html('৳' +
                                regular_price);
                        } else {
                        $('.sell_Price').html('৳' +selling_price);
                            // if theres a selling price
                            $('.regular_Price_if_selling_null').empty();
                            $('.regular_Price').html('৳' +regular_price);
                        }
                    }
                }
            })
        });
    // if therese color but no size available end

    // if therese only size available start
    $('.SizebyPrice').change(function() {
            var size_id = $(this).val();
            var product_id = $(this).attr('data-product');
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/product/get-pricebysize",
           data:{product_id:product_id, size_id:size_id},
           success: function(res) {
            if (res) {
                // get price and quantity
                        $('.available').html(res);
                        var regular_price = $('.quantityadd').attr('data-regularprice');
                        var selling_price = $('.quantityadd').attr('data-sellprice');
                        // alert(selling_price);
                        if (selling_price == '') {
                            // if theres no selling price
                        $('.sell_Price').html(selling_price);
                            $('.regular_Price').empty();
                            $('.regular_Price_if_selling_null').html( '৳' +
                                regular_price);
                        } else {
                            // if theres a selling price
                        $('.sell_Price').html('৳' +selling_price);
                            $('.regular_Price_if_selling_null').empty();
                            $('.regular_Price').html('৳' +regular_price);
                        }
                    }
                }
            })
        });
      // if therese only size available end

      $('.SizebyPrice').change(function() {
        //   alert('ok');
          var size = $(this).val();
            var product = $(this).attr('data-product');
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/product/get-flavour",
           data:{product_id:product, size_id:size},
                    success: function(res) {
                        if (res != '') {
                            $('#flavour_id').removeAttr('disabled');
                            $("#flavour_id").empty();
                            $("#flavour_id").append('<option value=>Select One</option>');
                            $.each(res, function(key, value) {
                                $("#flavour_id").append('<option value="' + value.id + '" >' +
                                    value.flavour_name + '</option>');
                            });
                        } else {
                            $("#flavour_id").empty();
                        }
                    }
        })
        });


</script>
@endsection