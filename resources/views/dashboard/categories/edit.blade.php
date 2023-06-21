@extends('layouts.admin')


@section('content')
<div class="card">
    <div class="card-header">
        <h4>Update Category</h4>
    </div>
    <div class="card-body">
       <form action="{{route('categories.update',$category)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{$category->name}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Slug</label>
                <input type="text" class="form-control" name="slug" value="{{$category->slug}}">
            </div>
            <div class="col-md-12 mb-3">
                <textarea name="description" class="form-control"  rows="3" >{{$category->description}}</textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Status</label>
                <input type="checkbox"  name="status" {{$category->status == "1" ? 'checked' : ''}}>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">popular</label>
                <input type="checkbox"  name="popular" {{$category->popular =="1" ? 'checked' : ''}}>
            </div>

            <div class="col-md-12 mb-3">
                <label for="">Meta Title</label>
                <input type="text" class="form-control"  name="meta_title" value="{{$category->meta_title}}">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta Description</label>
                <input type="text" class="form-control"  name="meta_description" value="{{$category->meta_description}}">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta Key Word</label>
                <textarea name="meta_keyword" class="form-control"  rows="3" >{{$category->meta_keyword}}</textarea>
            </div>
            @if ($category->image)
                <img src="{{asset('uploads/categories/'. $category->image)}}" alt="Category Image">
            @endif
            <div class="col-md-12 mb-3">
                <label for="">Image</label>
                <input type="file" class="form-control"  name="image">
            </div>

            <div class="col-md-12 mb-3">

                <button class="btn btn-primary" type="submit"> Update Category</button>
            </div>

        </div>
       </form>
    </div>
</div>
@endsection
