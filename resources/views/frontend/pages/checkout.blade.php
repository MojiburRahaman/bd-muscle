@extends('frontend.master')
@section('title',config('app.name')) 
@section('content')
<!-- header-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <form action="{{route('CheckoutPost')}}" method="POST">
            @csrf
            <div class="row ">
                <div class="col-lg-7 pt-4">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5>Something is wrong with this field!</h5                
                            @foreach ($errors->all() as $err_msg)
                            <li>{{$err_msg}}</li>
                            @endforeach
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <p> Name <span style="color: red">*</span></p>
                                <input class="@error('billing_user_name') is-invalid @enderror form-control" type="text"
                                    name="billing_user_name" @error('billing_user_name') required @enderror
                                    placeholder="Enter Name" autocomplete="none" value="{{old('billing_user_name')}}">
                            </div>
                            <div class="col-sm-12 col-12">
                                <p>Phone No.<span style="color: red">*</span> </p>
                                <input class="@error('billing_number') is-invalid @enderror form-control" type="number"
                                    type="number" name="billing_number" placeholder="Enter Your Number"
                                    autocomplete="none" value="{{old('billing_number')}}">
                            </div>
                            <div class="col-4 m-none">
                                <p>Division <span style="color: red">*</span></p>
                                <select name="division_name"  id="divisions_name">
                                    <option value=>Select One</option>
                                    @foreach ($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 ">
                                <p>District <span style="color: red">*</span></p>
                                <select class="@error('district_name') is-invalid @enderror form-control"
                                    name="district_name" id="disctrict_name">

                                </select>
                            </div>
                            <div class="col-4">
                                <p>Upozila <span style="color: red">*</span></p>
                                <select class="@error('upozila_name') is-invalid @enderror form-control"
                                    name="upozila_name" id="upozila_name">

                                </select>
                            </div>
                            <br><br>
                            <div class="col-12 col-sm-8 mt-4">
                                <p>Your Address <span style="color: red">*</span></p>
                                <input class="@error('billing_number') is-invalid @enderror form-control"
                                    name="billing_address" type="text">
                            </div>
                            <div class="col-sm-4 col-12 mt-4">
                                <p>Postcode/ZIP</p>
                                <input type="text" name="billing_postcode">
                            </div>
                            <div class="col-12 mb-4">
                                <p>Order Notes (Optional) </p>
                                <textarea name="billing_order_note" placeholder="Notes about Your Order."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 ml-5 pt-4 pr-4 pl-4" style="background: #f4f4f4;height:100%">
                    <div class="order-area">
                        <h3 class="">Your Order</h3>
                        <ul class="total-cost">
                            {{-- @foreach (cart_product_view() as $cart_product)

                    <li> {{$cart_product->product->title}} <span class="pull-right">৳
                                @php
                                $product = App\Models\attribute::where('product_id', $cart_product->product_id)
                                ->where('color_id', $cart_product->color_id)
                                ->where('size_id', $cart_product->size_id)
                                ->first();

                                $sale_price = $product->selling_price;
                                $regular_price = $product->regular_price;

                                if ($sale_price) {
                                echo $sale_price * $cart_product->quantity;
                                }
                                if ($sale_price == '') {
                                echo $regular_price *$cart_product->quantity;
                                }
                                @endphp
                            </span></li>
                            @endforeach --}}
                            <li>Total <span class="pull-right"> <strong>৳{{session()->get('cart_total')}}</strong>
                                </span>
                            </li>
                            {{-- @if (session('cart_discount')) --}}

                            <li>Discount<span
                                    class="pull-right"><strong>৳{{session()->get('cart_discount')}}</strong></span></li>
                            {{-- @endif --}}
                            <li>Shipping <span class="pull-right">৳<strong id="shipping_id">0</spstrongan></span></li>
                            <li> Subtotal<span class="pull-right"
                                    id="sub_total"><strong>৳{{session()->get('cart_subtotal')}}
                                    </strong></span></li>
                        </ul>
                        <ul class="payment-method">
                            {{-- <li>
                                <input @error('payment_option') required  @enderror name="payment_option" style="background: orange" id="bank" value="pay_now" type="radio">
                                <label for="bank">Direct Bank Transfer</label>
                            </li> --}}
                            <li>
                                <input checked @error('payment_option') required  @enderror name="payment_option" id="cash_on_delivery" value="cash_on_delivery" type="radio">
                                <label for="cash_on_delivery">Cash On Delivery</label>
                            </li>

                        </ul>
                        <button type="submit" class="mb-5">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- checkout-area end -->
@endsection

@section('script_js')
<script>
    $(document).ready(function(){
// #### select 2 dependency dropdown start
$('#divisions_name').select2({
allowClear: true,

});
$('#disctrict_name').select2({
allowClear: true,
// {{-- theme: "classic" --}}
});
$('#upozila_name').select2({
allowClear: true,
// {{-- theme: "classic" --}}
});
// #### select 2 dependency dropdown end

// #### get district information by division start 

$('#divisions_name').change(function(){
var division_id = $(this).val();

if (division_id) {
   
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        }),
            $.ajax({
                type: 'POST',
                url: '/checkout/billing/division_id' ,
                data :{division_id: division_id},

                success: function(res) {
                    if (res) {
                        $("#upozila_name").empty();
                        $("#disctrict_name").empty();
                        $("#disctrict_name").append('<option value=>Select One</option>');
                        $.each(res, function(key, value) {
                            $("#disctrict_name").append('<option value="' + value.id + '" >' +
                                value.name + '</option>');
                        });

                    } else {
                        $("disctrict_name").empty();
                    }
                }
            });
        }
        else{
            $("#disctrict_name").empty();
            $("#upozila_name").empty();
            $('#shipping_id').html(0);

        }
    });

// #### get district information by division end


// #### get upozila information by district start 

        $('#disctrict_name').change(function(){
        var disctrict_id = $(this).val();
        var total_amount = {{session()->get('cart_subtotal')}};
        if (!disctrict_id == '') {
           if (disctrict_id == 47) {
               $('#shipping_id').html(60);
               @php
                   session()->put('shipping',60);
               @endphp
               $('#sub_total').html(60 + parseInt(total_amount));
            }
            else{
                @php
                   session()->put('shipping',100);
               @endphp
                $('#shipping_id').html(100)
                $('#sub_total').html(100 + parseInt(total_amount));
                
           }
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
                url: 'checkout/billing/disctrict_id',
                data:{district_id: disctrict_id},

                success: function(res) {
                    if (res) {
                        $("#upozila_name").empty();
                        $("#upozila_name").append('<option>Select One</option>');
                        $.each(res, function(key, value) {
                            $("#upozila_name").append('<option value="' + value.id + '" >' +
                                value.name + '</option>');
                        });

                    } else {
                        $("upozila_name").empty();
                    }
                }
            });
        } else{
            $('#sub_total').html(parseInt(total_amount));
            $("#upozila_name").empty();
            $('#shipping_id').html(0);


        }
    });
// #### get upozila information by district end 

});

</script>
@endsection