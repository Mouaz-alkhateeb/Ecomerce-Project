@extends('layouts.frontend')

@section('title', "Edit Review on " .$review->product->name . " product")


@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>You Are Write Review For {{$review->product->name}}</h5>
                    <form action="{{url('update_review')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="review_id" value="{{$review->id}}">
                        <textarea name="user_review" class="form-control" rows="5" placeholder="Write a Review">{{$review->user_review}}</textarea>
                        <button type="submit" class="btn btn-primary mt-3">Update Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
