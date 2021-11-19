@extends('frontend.master')
@section('content')
<!-- cart-area start -->
<style>
    .rotate {
        -moz-transition: all 1s linear;
        -webkit-transition: all 1s linear;
        transition: all 1s linear;
    }

    .rotate.down {
        -ms-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }

</style>
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            @if (session('cart_empty'))
            <div class="col-lg-7">
                <div class="alert alert-danger"><i class="fa fa-warning"> {{session('cart_empty')}}</i></div>
            </div>
            @endif
            <div class="col-12">
                {{-- <form action=" "> --}}
                <table class="table-responsive cart-wrap">
                    <thead>
                        <tr>
                            <th class="images">Image</th>
                            <th class="product">Product</th>
                            <th class="ptice">Color</th>
                            <th class="ptice">Size</th>
                            <th class="ptice">Price</th>
                            <th class="quantity">Quantity</th>
                            <th class="">Total</th>
                            <th class="remove">Action</th>
                        </tr>
                    </thead>
                    <tbody class="load">
                        @php
                        $total_cart_amount = 0;
                        @endphp
                        @forelse ($Carts as $item)

                        <tr style="border-bottom: 1px solid rgb(211, 211, 211)">
                            <td style="border:none" class="images">
                                <a href="{{ route('SingleProductView', $item->product->slug) }}">
                                    <img src="{{ asset('thumbnail_img/' . $item->Product->thumbnail_img) }}" alt="">
                                </a>
                            </td>
                            <td style="border:none" class="product">
                                <a href="{{ route('SingleProductView', $item->product->slug) }}">
                                    {{ $item->product->title }}
                                </a>
                                @if ($item->flavour_count != '')
                                <br>
                                (Flavour: {{$item->Flavour->flavour_name}})
                                @endif
                            </td>
                            <td style="border:none" class="ptice">
                                {{ $item->color->color_name }}
                            </td>
                            <td style="border:none" class="ptice">
                                {{ $item->size->size_name }}
                            </td>
                            <td style="border:none" class="ptice"> ৳
                                <span class="singlesub_price">
                                    @php
                                    $product = App\Models\attribute::where('product_id', $item->product_id)
                                    ->where('color_id', $item->color_id)
                                    ->where('size_id', $item->size_id)
                                    ->first();

                                    $sale_price = $product->selling_price;
                                    $regular_price = $product->regular_price;

                                    if ($sale_price) {
                                    echo $sale_price;
                                    }
                                    if ($sale_price == '') {
                                    echo $regular_price;
                                    }
                                    @endphp
                                </span>
                            </td>
                            <td style="border:none" class="quantity cart-plus-minus">
                                <input type="text" class="cart_quantity" name="cart_quantity"
                                    value="{{ $item->quantity }}" />
                            </td>
                            <td style="border:none" class="total "> ৳
                                <span class="sub_product_total">
                                    @php
                                    if ($sale_price) {
                                    $total_cart_amount += $sale_price * $item->quantity;
                                    echo $sale_price * $item->quantity;
                                    }
                                    if ($sale_price == '') {
                                    $total_cart_amount += $regular_price * $item->quantity;
                                    echo $regular_price * $item->quantity;
                                    }
                                    @endphp
                                </span>
                            </td>
                            <td style="border:none" class="remove">
                                <a class="pointer" title="Update Item"><i data-id="{{$item->id}}"
                                        class="rotate fa fa-refresh"></i>
                                </a>
                                &nbsp;
                                <a href="{{route('CartDelete',$item->id)}}" title="Delete Item"><i
                                        class="fa fa-times"></i>
                                </a>
                                @empty
                            </td>
                            <td colspan="10" class="text-center">No data available</td>

                            @endforelse
                        </tr>
                    </tbody>
                </table>
                <div id="coupon_section" class="row mt-60">
                    <div class="col-xl-4 col-lg-5 col-md-6 ">
                        <div class="cartcupon-wrap">
                            <ul class="d-flex">
                                {{-- <li>
                                    <button>Update Cart</button>
                                </li> --}}
                                <li><a href="{{route('Frontendshop')}}">Continue Shopping</a></li>
                            </ul>
                            <h3>Cupon</h3>
                            <p>Enter Your Cupon Code if You Have One</p>
                            <div class="cupon-wrap">
                                <input type="text" id="coupon_name" placeholder="Cupon Code" value="{{$coupon_name}}">
                                <button id="coupon_submit_btn">Apply Cupon</button>
                                @if(session('coupon_invalid'))
                                <span class="text-danger">{{session('coupon_invalid')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                        <div class="cart-total text-right">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li><span class="pull-left "> Total</span>
                                    <span class="subtotal"> ৳ {{ $total_cart_amount }}</span>
                                </li>
                                <li><span class="pull-left ">Discount({{$discount}}%) </span>
                                    <span class="discount"> ৳ {{ ($total_cart_amount * $discount)/100 }}</span>

                                </li>
                                <li><span class="pull-left ">Subtotal</span>
                                    <span class="cart_total">
                                        ৳{{round($total_cart_amount - ($total_cart_amount * $discount)/100)}}
                                    </span>
                                </li>
                            </ul>
                            @php
                            session()->put('cart_total',$total_cart_amount);
                            session()->put('coupon_name',$coupon_name);
                            session()->put('cart_discount',($total_cart_amount * $discount)/100);
                            session()->put('cart_subtotal',round($total_cart_amount - ($total_cart_amount *
                            $discount)/100));
                            @endphp
                            <a href="">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->

@endsection

@section('script_js')
<script>
    $(".rotate").click(function(){
    $(this).toggleClass("down"); 
        var ele = $(this);
        var sub_total = $('.subtotal').html();
        var cart_id = $(this).attr('data-id');
    //   var  cart_quantity=ele.parents("tr").find(".cart_quantity").val();
            //    alert(cart_quantity);
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/cart/quantity-update",
           data:{
               cart_id:cart_id, 
               cart_quantity:ele.parents("tr").find(".cart_quantity").val(),
            //    alert(cart_quantity),
               },
           success: function(res) {
                    if (res) {
                     ele.parents("tr").find('.sub_product_total').html(res);
                //      ele.parents("tr").find('.sub_product_total').html(res);
                //    var quantity =  ele.parents("tr").find('.singlesub_price').attr('data-quantity');
                //    ele.parents("tr").find(".cart_quantity").val(quantity);
                $(".subtotal").load(location.href + " .subtotal");
                $(".discount").load(location.href + " .discount");
                $(".cart_total").load(location.href + " .cart_total");

                    }
                }
            })
    });


    $(document).ready(function(){
        $('#coupon_submit_btn').click(function(){
            var coupon_name_test = $('#coupon_name').val();
            var coupon_redirect_url = " {{route('CartView')}}/" + coupon_name_test;
    window.location.href = coupon_redirect_url;
    });
    
    });
</script>





@endsection