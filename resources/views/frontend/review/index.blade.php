@extends('layouts.frontend')

@section('title', "Write Review")


@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($verified_purshase->count() > 0)
                        <h5>You Are Write Review For {{$product->name}}</h5>
                        <form action="{{url('add_review')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <textarea name="user_review" class="form-control" rows="5" placeholder="Write a Review"></textarea>
                            <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                        </form>
                    @else
                        <div class="alert alert-danger">
                             <h5>You Are eligible to review this product</h5>
                             <p>
                                For the trust worthness of review,only customers who purchased the product can write a review about the product.
                             </p>
                             <a href="{{url('/')}}" class="btn btn-primary mt-3">Go To Home Page</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
