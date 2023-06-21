@extends('layouts.admin')

@section('title')
    Orders History
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Orders History <a href="{{url('orders')}}" class="btn btn-warning float-end">New Orders</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($orders as $order)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($order->created_at))}}</td>
                                    <td>{{$order->tracking_number}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>{{$order->status == "0" ? "pending" : "completed"}}</td>
                                    <td>
                                        <a href="{{url('orders/'. $order->id)}}" class="btn btn-primary">View</a>
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
