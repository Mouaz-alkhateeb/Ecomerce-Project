<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function  add($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status', '0')->first();
        if ($product) {
            $product_id = $product->id;
            $review = Review::where('product_id', $product_id)->where('user_id', Auth::id())->first();
            if ($review) {
                return view('frontend.review.edit', compact('review'));
            } else {
                $verified_purshase = Order::where('orders.user_id', Auth::id())
                    ->join('order_items', 'orders.id', 'order_items.order_id')
                    ->where('order_items.product_id', $product_id)->get();
                return view('frontend.review.index', compact('product', 'verified_purshase'));
            }
        } else {
            return redirect()->back()->with("status", "The link You Followed Was broken..!");
        }
    }

    public function store(Request $request)
    {
        $product_id = $request->input('product_id');
        $product = Product::where('id', $product_id)->where('status', '0')->first();
        if ($product) {
            $user_review = $request->input('user_review');
            $new_review = Review::create([
                "user_id" => Auth::id(),
                "product_id" => $product_id,
                "user_review" => $user_review
            ]);
            $category_slug = $product->category->slug;
            $product_slug = $product->slug;
            if ($user_review) {
                return redirect('view_category/' . $category_slug . '/' . $product_slug)->with("status", "Thank You For Write Review");
            }
        } else {
            return redirect()->back()->with("status", "The link You Followed Was broken..!");
        }
    }
    public function edit($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status', '0')->first();
        if ($product) {
            $product_id = $product->id;
            $review = Review::where('user_id', Auth::id())->where('product_id', $product_id)->first();
            if ($review) {
                return view('frontend.review.edit', compact('review'));
            } else {
                return redirect()->back()->with("status", "The link You Followed Was broken..!");
            }
        } else {
            return redirect()->back()->with("status", "The link You Followed Was broken..!");
        }
    }
    public function update(Request $request)
    {
        $user_review = $request->input('user_review');
        if ($user_review != '') {
            $review_id = $request->input('review_id');
            $review = Review::where('id', $review_id)->where('user_id', Auth::id())->first();
            if ($review) {
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('view_category/' . $review->product->category->slug . '/' . $review->product->slug)->with("status", "Review Updateed Successfully..!");
            } else {
                return redirect()->back()->with("status", "The link You Followed Was broken..!");
            }
        } else {
            return redirect()->back()->with("status", "You Cannot Submit With Empty Review..!");
        }
    }
}
