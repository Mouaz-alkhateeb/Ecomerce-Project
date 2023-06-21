@extends('layouts.frontend')

@section('title')
{{$category->name}}
@endsection


@section('content')

<div class="py-3 mb-4 shadow-sm bg-secondary">
    <div class="container">
        <h6 class="mb-0">Collections/{{$category->name}}</h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>{{$category->name}}</h2>
                @foreach ($products as $product)
                <div class="col-md-3 mb-3">
                    <a href="{{url('view_category/'.$category->slug.'/'.$product->slug)}}">
                        <div class="card">
                            <img src="{{asset('uploads/products/'.$product->image)}}" alt="Product Image" style="height: 200px;">
                            <div class="card-body" >
                            <h5> {{$product->name}}</h5>
                            <span class="float-start">{{$product->selling_price}}</span>
                            <span class="float-end"><s>{{$product->orginal_price}}</s></span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
