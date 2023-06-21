@extends('layouts.admin')


@section('content')
<div class="card">
    <div class="card-header">
        <h1>Categories</h1>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Descrtiption</th>
                    <th >Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>

                    <td>{{$category->description}}</td>
                    <td>
                        <img src="{{asset('uploads/categories/'. $category->image)}}" style="width: 100px" alt="Image Here">
                    </td>
                    <td>
                        <a href="{{route('categories.edit',$category)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{route('categories.destroy',$category)}}" class="btn btn-danger btn-sm">Delete</a>


                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
