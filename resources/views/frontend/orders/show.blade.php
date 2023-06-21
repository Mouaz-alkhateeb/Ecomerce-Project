@extends('layouts.frontend')

@section('title')
   Order Details
@endsection


@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Order Details <a href="{{url('my_orders')}}" class="btn btn-secondary float-end">Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-details">
                            <h4 class="mt-2">Shipping Details</h4>
                            <hr>
                            <label for="">First Name</label>
                            <div class="border">{{$order->first_name}}</div>
                            <label for="">Last Name</label>
                            <div class="border">{{$order->last_name}}</div>
                            <label for="">Email</label>
                            <div class="border">{{$order->email}}</div>
                            <label for="">Phone</label>
                            <div class="border">{{$order->phone}}</div>
                            <label for="">Shipping Address</label>
                            <div class="border">
                                {{$order->address1}}, <br />
                                {{$order->address2}},<br />
                                {{$order->city}},<br />
                                {{$order->country}}

                            </div>
                            <label for="">Pin Code</label>
                            <div class="border p-2">{{$order->pin_code}}</div>
                        </div>
                        <div class="col-md-6 p-2">
                            <h4>Order Details</h4>
                            <hr>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{$item->products->name}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>{{$item->price }}</td>
                                            <td><img src="{{asset('uploads/products/'. $item->products->image)}}" width="60px" height="50px" alt=""></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2">Grand Total :  <span class="float-end"> $ {{$order->total_price}}</span></h4>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
