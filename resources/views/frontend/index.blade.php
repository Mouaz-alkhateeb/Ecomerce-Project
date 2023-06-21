@extends('layouts.frontend')

@section('title')
    E-Shop
@endsection


@section('content')
@include('layouts.include.frontend.slider')



<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Trending Products</h2>
            <div class="owl-carousel featured-carousel owl-theme">
                @foreach ($trending_products as $product)
                <div class="item">

    <div class="card">
        <img src="{{asset('uploads/products/'.$product->image)}}" alt="Product Image" style="height: 200px;">
        <div class="card-body" >
           <h5> {{$product->name}}</h5>
           <span class="float-start">{{$product->selling_price}}</span>
           <span class="float-end"><s>{{$product->orginal_price}}</s></span>
        </div>
    </div>



                </div>
            @endforeach
            </div>

        </div>
    </div>
</div>


<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Trending Categories</h2>
            <div class="owl-carousel trending-carousel owl-theme">
                @foreach ($trending_categories as $category)
                <div class="item" >
                    <a href="{{url('view_category/'. $category->slug)}}">

                        <div class="card">
                            <img src="{{asset('uploads/categories/'.$category->image)}}" alt="Category Image" style="height: 200px;">
                            <div class="card-body" >
                               <h5> {{$category->name}}</h5>
                               <p>{{$category->description}}</p>
                            </div>
                        </div>
                    </a>

                </div>
            @endforeach
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>

<script>
    $('.trending-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection
