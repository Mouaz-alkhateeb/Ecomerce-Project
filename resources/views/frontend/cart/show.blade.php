@extends('layouts.frontend')

@section('title')
   My Cart
@endsection


@section('content')
<div class="py-3 mb-4 shadow-sm  bg-warning">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a> /
            <a href="{{url('/cart')}}">Cart</a>
        </h6>
    </div>
</div>

<div class="container ">
    <div class="card shadow cartItems">
        @if ($cartItems->count() > 0)
            <div class="card-body">
                @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                    <div class="row product_data">
                        <div class="col-md-2 my-auto">
                            <img src="{{asset('uploads/products/'.$item->products->image)}}" height="70px" width="70px" alt="">
                        </div>
                        <div class="col-md-3 my-auto">
                            <h6 class="mt-2">{{$item->products->name}}</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6 class="mt-2">{{$item->products->selling_price}}</h6>
                        </div>
                        <div class="col-md-3 my-auto">
                            <input type="hidden"  class="product_id" value="{{$item->product_id}}">
                            @if ($item->products->qty >= $item->product_quantity)
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="width: 130px">
                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                    <input type="numbertext" name="quantity" value="{{$item->product_quantity}}" class="form-control text-center qty-input">
                                    <button class="input-group-text changeQuantity increment-btn">+</button>
                                </div>
                                @php $total += $item->products->selling_price * $item->product_quantity;  @endphp
                                @else
                                <h6>Out Of Stock</h6>
                            @endif
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6 class="btn btn-danger delete_cart_item"><i class="fa fa-trash"></i> Remove</h6>
                        </div>
                    </div>
                    @endforeach
            </div>

            <div class="card-footer">
                <h6>Total Price : $ {{ $total }}</h6>
                <a  href="{{url('checkout')}}" class="btn btn-outline-success float-end" >Proccesse To Checkout</a>
            </div>
        @else
        <div class="card-body text-center">
            <h2>Your <i class="fa fa-shopping-cart"> Cart is Empty</i></h2>
            <a  href="{{url('all_categories')}}" class="btn btn-outline-success float-end" >Continue Shopping</a>
        </div>
    @endif
    </div>
</div>
@endsection
