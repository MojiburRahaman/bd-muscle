@extends('frontend.master')

@section('content')
<style>
    .cart_button {
        padding: 5px 7px;
        border: none;
        background: #ef4836;
        color: white;
        border-radius: 5%;
    }

</style>
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Wishlist</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Wishlist</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- <form action=""> --}}
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="stock">Quantity </th>
                                <th class="addcart">Add to Cart</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wish_lists as $wish_list)
                            <tr>
                                <form action="{{route('CartPost')}}" method="POST">
                                    @csrf
                                    <td class="images">
                                        <a href="{{ route('SingleProductView', $wish_list->Product->slug) }}">
                                            <img src="{{ asset('thumbnail_img/' . $wish_list->Product->thumbnail_img) }}"
                                                alt="">
                                        </a>
                                    </td>
                                    <td class="product"><a
                                            href="{{route('SingleProductView',$wish_list->Product->slug)}}">{{$wish_list->Product->title}}</a>
                                    </td>
                                    <td class="ptice">৳
                                        @php
                                        $product =$wish_list->Product->Attribute
                                        ->where('color_id',$wish_list->color_id)
                                        ->where('size_id',$wish_list->size_id)->first();

                                        $sale_price = $product->sell_price;
                                        $regular_price = $product->regular_price;

                                        if ($sale_price) {
                                        echo $sale_price;
                                        }
                                        if ($sale_price == '') {
                                        echo $regular_price;
                                        }
                                        @endphp
                                    </td>
                                    <input type="hidden" name="product_id" value="{{$wish_list->product_id}}">
                                    <input type="hidden" name="color_id" value="{{$wish_list->color_id}}">
                                    <input type="hidden" name="size_id" value="{{$wish_list->size_id}}">
                                    <input type="hidden" name="wish_list_id" value="{{$wish_list->id}}">

                                    <td class="stock">
                                        <li style="list-style: none" class="quantity cart-plus-minus">
                                            <input name="cart_quantity" type="text" value="{{$wish_list->quantity}}" />
                                        </li>
                                    </td>
                                    <td class="addcart">
                                        @if ($wish_list->Product->Attribute->sum('quantity') != 0)
                                        <button class="cart_button" class="add_cart_btn">Add to Cart</button>
                                        @else
                                        Out Of stock
                                        @endif
                                    </td>
                                    <td class="remove">
                                        <a href="{{route('WishlistRemove',$wish_list->id)}}" title="Delete Item">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </form>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">No item</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->
@endsection