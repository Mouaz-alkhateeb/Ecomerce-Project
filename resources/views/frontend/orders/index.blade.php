@extends('layouts.frontend')

@section('title')
   My Orders
@endsection


@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    My Orders
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->tracking_number}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>{{$order->status == "0" ? "pending" : "completed"}}</td>
                                    <td>
                                        <a href="{{url('view_order/'. $order->id)}}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
