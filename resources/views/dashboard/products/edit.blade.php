
@extends('layouts.admin')


@section('content')
<div class="card">
    <div class="card-header">
        <h4>Update Product</h4>
    </div>
    <div class="card-body">
       <form action="{{route('products.update',$product)}}" method="post" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{$product->name}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Slug</label>
                <input type="text" class="form-control" name="slug" value="{{$product->slug}}">
            </div>
            <div class="col-md-12 mb-3">
                <select class="form-select">
                    <option value="">{{$product->category->name}}</option>

                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label for="">Description</label>
                <textarea name="description" class="form-control"  rows="3">{{$product->description}}</textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label for="">Small Description</label>
                <textarea name="small_desc" class="form-control"  rows="3">{{$product->small_desc}}</textarea>
            </div>





            <div class="col-md-6 mb-3">
                <label for="">Orginal price</label>
                <input type="number" class="form-control"  name="orginal_price" value="{{$product->orginal_price}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Selling price</label>
                <input type="number"  class="form-control" name="selling_price" value="{{$product->selling_price}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for=""> Qty</label>
                <input type="number" class="form-control"  name="qty" value="{{$product->qty}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for=""> Tax</label>
                <input type="number" class="form-control"  name="tax" value="{{$product->tax}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Status</label>
                <input type="checkbox"  name="status" {{$product->status == "1" ? "checked":""}}>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Trending</label>
                <input type="checkbox"  name="trending" {{$product->trending == "1" ? "checked":""}}>
            </div>


            <div class="col-md-12 mb-3">
                <label for="">Meta Title</label>
                <input type="text" class="form-control"  name="meta_title" value="{{$product->meta_title}}">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta Description</label>
                <input type="text" class="form-control"  name="meta_description" value="{{$product->meta_description}}">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta Key Word</label>
                <textarea name="meta_keyword" class="form-control"  rows="3">{{$product->meta_keyword}}</textarea>
            </div>
            @if ($product->image)
                <img src="{{asset('uploads/products/'. $product->image)}}" alt="Product Image">
            @endif
            <div class="col-md-12 mb-3">
                <label for="">Image</label>
                <input type="file" class="form-control"  name="image">
            </div>

            <div class="col-md-12 mb-3">

                <button class="btn btn-primary" type="submit"> Update </button>
            </div>

        </div>
       </form>
    </div>
</div>
@endsection
