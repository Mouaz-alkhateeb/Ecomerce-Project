@extends('layouts.frontend')

@section('title')
My Wishlist
@endsection


@section('content')
<div class="py-3 mb-4 shadow-sm  bg-warning">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a> /
            <a href="{{url('/wishlist')}}">Wishlist</a>
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow wishlistItems" >
<div class="card-body">
    @if ($wishlists->count() > 0)
    <div class="card-body">

            @foreach ($wishlists as $item)
            <div class="row product_data mt-2">
                <div class="col-md-2 my-auto">
                    <img src="{{asset('uploads/products/'.$item->products->image)}}" height="70px" width="70px" alt="">
                </div>
                <div class="col-md-2 my-auto">
                    <h6 class="mt-2">{{$item->products->name}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6 class="mt-2">{{$item->products->selling_price}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <input type="hidden"  class="product_id" value="{{$item->product_id}}">
                    @if ($item->products->qty >= $item->product_quantity)
                    <div class="input-group text-center mb-3 mt-2" style="width: 130px">
                        <button class="input-group-text decrement-btn">-</button>
                        <input type="numbertext" name="quantity" value="1" class="form-control text-center qty-input">
                        <button class="input-group-text increment-btn">+</button>
                    </div>
                        @else
                        <h6>Out Of Stock</h6>
                    @endif
                </div>
                <div class="col-md-2 my-auto">
                    <h6 class="btn btn-success addToCartBtn"><i class="fa fa-shopping-cart"></i> Add To Cart</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6 class="btn btn-danger remove-wishlist-item"><i class="fa fa-trash"></i> Remove</h6>
                </div>
            </div>
            @endforeach
    </div>

    @else
<h4>There Are No products  in your wishlists</h4>
    @endif

</div>

    </div>
</div>
@endsection
