@extends('frontend.master')
@section('title')
{{$product->title}}
@endsection
@section('content')
<style>
    #wishlist {
        padding: 4px 7px;
        border: none;
        color: #fff;
        font-size: 18px;
        margin-left: 2px;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
        background-color: #ef4836;
        cursor: pointer;
    }

</style>
<!-- .breadcumb-area start -->
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
<!-- .breadcumb-area end -->
<!-- single-product-area start-->
<div class="single-product-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-single-img">
                    <div class="product-active owl-carousel">
                        @foreach ($product->Gallery as $Gallery)

                        <div class="item">
                            <img src="{{asset('product_image/'.$Gallery->product_img)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                    <div class="product-thumbnil-active  owl-carousel">
                        @foreach ($product->Gallery as $Gallery)

                        <div class="item">
                            <img src="{{asset('product_image/'.$Gallery->product_img)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <form action="{{route('CartPost')}}" method="POST"> --}}
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

                            (<span class="available">{{ $product->Attribute->sum('quantity') }}</span> &nbsp;Product
                            Available)
                            @else
                            (<span>Out of Stock</span>)
                            @endif
                    </div>
                    @if ($product->Attribute->sum('quantity') != 0)
                    <form action="" id="Form_submit" method="POST">
                        @csrf
                        <p>{{$product->product_summary}}</p>
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
                            <li>Flavour:</p>
                            <li>
                                <select name="flavour_id"
                                    class="form-control ml-2 @error('flavour_id') is-invalid @enderror">
                                    @if ($product->flavour_count != 1)
                                    <option value="">Select One</option>
                                    @endif
                                    @foreach ($product->Flavour as $Flavour)
                                    <option value="{{$Flavour->id}}">{{$Flavour->flavour_name}}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
                        @endif
                        @endif

                        @if ($product->brand_id != '')

                        <ul class="cetagory" style="margin-bottom: 10px">
                            <li>Brand:</p>
                            <li>
                                <a href="">
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
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>

                </div>
                </form>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-12">
                <div class="single-product-menu">
                    <ul class="nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                        <li><a data-toggle="tab" href="#tag">Faq</a></li>
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
                    <div class="tab-pane" id="tag">
                        <div class="faq-wrap" id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">General Inquiries ?</button> </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                        brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                        sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                        shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                        cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                        you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                        brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                        sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                        shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                        cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                        you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery
                                            ?</button></h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                        brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                        sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                        shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                        cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                        you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingfour">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour"
                                            aria-expanded="false" aria-controls="collapsefour">Additional Information
                                            ?</button></h5>
                                </div>
                                <div id="collapsefour" class="collapse" aria-labelledby="headingfour"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                        brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                        sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                        shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                        cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                        you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingfive">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive"
                                            aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button>
                                    </h5>
                                </div>
                                <div id="collapsefive" class="collapse" aria-labelledby="headingfive"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                        brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                        sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                        shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson
                                        cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                        you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="review">
                        <div class="review-wrap">
                            <ul>
                                <li class="review-items">
                                    <div class="review-img">
                                        <img src="assets/images/comment/1.png" alt="">
                                    </div>
                                    <div class="review-content">
                                        <h3><a href="#">GERALD BARNES</a></h3>
                                        <span>27 Jun, 2019 at 2:30pm</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan
                                            egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget
                                            eni Praesent et messages in con sectetur posuere dolor non.</p>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="review-items">
                                    <div class="review-img">
                                        <img src="assets/images/comment/2.png" alt="">
                                    </div>
                                    <div class="review-content">
                                        <h3><a href="#">Olive Oil</a></h3>
                                        <span>15 may, 2019 at 2:30pm</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan
                                            egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget
                                            eni Praesent et messages in con sectetur posuere dolor non.</p>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-half-o"></i></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="review-items">
                                    <div class="review-img">
                                        <img src="assets/images/comment/3.png" alt="">
                                    </div>
                                    <div class="review-content">
                                        <h3><a href="#">Nature Honey</a></h3>
                                        <span>14 janu, 2019 at 2:30pm</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan
                                            egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget
                                            eni Praesent et messages in con sectetur posuere dolor non.</p>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="add-review">
                            <h4>Add A Review</h4>
                            <div class="ratting-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>task</th>
                                            <th>1 Star</th>
                                            <th>2 Star</th>
                                            <th>3 Star</th>
                                            <th>4 Star</th>
                                            <th>5 Star</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>How Many Stars?</td>
                                            <td>
                                                <input type="radio" name="a" />
                                            </td>
                                            <td>
                                                <input type="radio" name="a" />
                                            </td>
                                            <td>
                                                <input type="radio" name="a" />
                                            </td>
                                            <td>
                                                <input type="radio" name="a" />
                                            </td>
                                            <td>
                                                <input type="radio" name="a" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <h4>Name:</h4>
                                    <input type="text" placeholder="Your name here..." />
                                </div>
                                <div class="col-md-6 col-12">
                                    <h4>Email:</h4>
                                    <input type="email" placeholder="Your Email here..." />
                                </div>
                                <div class="col-12">
                                    <h4>Your Review:</h4>
                                    <textarea name="massage" id="massage" cols="30" rows="10"
                                        placeholder="Your review here..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn-style">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- single-product-area end-->
<!-- featured-product-area start -->
@if ($product->Catagory->Product->count() != 1)

<div class="featured-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-left">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($product->Catagory->Product as $Catgory_wise_product)
            @if ($Catgory_wise_product->id != $product->id)
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
                                    $sale = collect($product->Attribute)->min('sell_price');
                                    $regular = collect($product->Attribute)->min('regular_price');
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
                                    <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- featured-product-area end -->
@endsection

@section('script_js')
<script>
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
                            $('.sell_Price').html(selling_price);
                            $('.available').html(quantity);
                            if (selling_price == '') {
                                // if theres no selling price
                                $('.regular_Price').empty();
                                $('.regular_Price_if_selling_null').html(
                                    regular_price);
                            } else {
                                // if theres a selling price
                                $('.regular_Price_if_selling_null').empty();
                                $('.regular_Price').html(regular_price);
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
                        $('.sell_Price').html(selling_price);
                        if (selling_price == '') {
                            // if theres no selling price
                            $('.regular_Price').empty();
                            $('.regular_Price_if_selling_null').html(
                                regular_price);
                        } else {
                            // if theres a selling price
                            $('.regular_Price_if_selling_null').empty();
                            $('.regular_Price').html(regular_price);
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
                        $('.sell_Price').html(selling_price);
                        if (selling_price == '') {
                            // if theres no selling price
                            $('.regular_Price').empty();
                            $('.regular_Price_if_selling_null').html(
                                regular_price);
                        } else {
                            // if theres a selling price
                            $('.regular_Price_if_selling_null').empty();
                            $('.regular_Price').html(regular_price);
                        }
                    }
                }
            })
        });
      // if therese only size available end


// add wishlist
$('#wishlist').click(function(){
        // alert('ok');
        var action =  '/wishlist-post';
        $('#Form_submit').attr('action', action);
        // $('#Form_submit').submit();
    });
// add cart
$('#Cart_add').click(function(){
        // alert('ok');
        var action =  '/cartpost';
        $('#Form_submit').attr('action', action);
        // $('#Form_submit').submit();
    });


</script>
@endsection