@extends('layouts.frontend')

@section('title')
    E-Shop
@endsection


@section('content')
<div class="container mt-3">
    <form action="{{url('place_order')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                       <h6>Basic Details</h6>
                       <hr>
                       <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="Enter First Name" name="first_name">
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" value="{{Auth::user()->last_name}}" placeholder="Enter Last Name" name="last_name">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="email"> Email</label>
                                <input type="text" class="form-control" value="{{Auth::user()->email}}" placeholder="Enter Email" name="email">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" value="{{Auth::user()->phone_number}}" placeholder="Enter Phone Name" name="phone">
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="address1">Address1</label>
                                <input type="text" class="form-control" value="{{Auth::user()->address1}}" placeholder="Enter Adress1" name="address1">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="address2">Address2</label>
                                <input type="text" class="form-control" value="{{Auth::user()->address2}}" placeholder="Enter Adress2" name="address2">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="city">City</label>
                                <input type="text" class="form-control" value="{{Auth::user()->city}}" placeholder="Enter City" name="city">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="state">State</label>
                                <input type="text" class="form-control" value="{{Auth::user()->state}}" placeholder="Enter State" name="state">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" value="{{Auth::user()->country}}" placeholder="Enter Country" name="country">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="pin_code">Pin Code</label>
                                <input type="text" class="form-control" value="{{Auth::user()->pin_code}}" placeholder="Enter Pin Code" name="pin_code">
                            </div>

                       </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Order Details</h6>
                        <hr>
@if ($cartItems->count() > 0)
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $item)
            <tr>
                <td>{{$item->products->name}}</td>
                <td>{{$item->product_quantity}}</td>
                <td>{{$item->products->selling_price}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>
<button type="submit" class="btn btn-primary float-end">Pleace Order</button>
@else
<h6>Cart Empty</h6>
@endif

                    </div>
                </div>
            </div>
        </div>

    </form>

</div>
@endsection
