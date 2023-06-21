@extends('layouts.admin')


@section('content')
<div class="card">
    <div class="card-header">
        <h1>Products</h1>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Selling Price</th>
                    <th >Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>

                    <td>{{$product->category->name}}</td>
                    <td>{{$product->selling_price}}</td>
                    <td>
                        <img src="{{asset('uploads/products/'. $product->image)}}" style="width: 100px" alt="Image Here">
                    </td>
                    <td>
                        <a href="{{route('products.edit',$product)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{route('products.destroy',$product)}}" class="btn btn-danger btn-sm">Delete</a>


                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
