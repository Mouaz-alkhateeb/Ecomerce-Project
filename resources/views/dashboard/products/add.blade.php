@extends('layouts.admin')


@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Product</h4>
    </div>
    <div class="card-body">
       <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Slug</label>
                <input type="text" class="form-control" name="slug">
            </div>
            <div class="col-md-12 mb-3">
                <select class="form-select" name="category_id">
                    <option value="">Select Category</option>
                    @foreach ($catrgories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label for="">Description</label>
                <textarea name="description" class="form-control"  rows="3"></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label for="">Small Description</label>
                <textarea name="small_desc" class="form-control"  rows="3"></textarea>
            </div>





            <div class="col-md-6 mb-3">
                <label for="">Orginal price</label>
                <input type="number" class="form-control"  name="orginal_price">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Selling price</label>
                <input type="number"  class="form-control" name="selling_price">
            </div>
            <div class="col-md-6 mb-3">
                <label for=""> Qty</label>
                <input type="number" class="form-control"  name="qty">
            </div>
            <div class="col-md-6 mb-3">
                <label for=""> Tax</label>
                <input type="number" class="form-control"  name="tax">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Status</label>
                <input type="checkbox"  name="status">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Trending</label>
                <input type="checkbox"  name="trending">
            </div>


            <div class="col-md-12 mb-3">
                <label for="">Meta Title</label>
                <input type="text" class="form-control"  name="meta_title">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta Description</label>
                <input type="text" class="form-control"  name="meta_description">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta Key Word</label>
                <textarea name="meta_keyword" class="form-control"  rows="3"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Image</label>
                <input type="file" class="form-control"  name="image">
            </div>

            <div class="col-md-12 mb-3">

                <button class="btn btn-primary" type="submit"> Add Product</button>
            </div>

        </div>
       </form>
    </div>
</div>
@endsection
