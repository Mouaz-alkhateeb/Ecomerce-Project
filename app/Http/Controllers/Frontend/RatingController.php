<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $stars_rated = $request->input('product_rating');
        $product_id = $request->input('product_id');

        $product_check = Product::where('id', $product_id)->where('status', '0')->first();

        if ($product_check) {
            $verified_purshase = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.product_id', $product_id)->get();

            if ($verified_purshase->count() > 0) {
                $exists_rating = Rating::where('user_id', Auth::id())->where('product_id', $product_id)->first();
                if ($exists_rating) {

                    $exists_rating->stars_rated = $stars_rated;
                    $exists_rating->update();
                } else {
                    Rating::create([
                        "user_id" => Auth::id(),
                        "product_id" => $product_id,
                        "stars_rated" => $stars_rated
                    ]);
                }

                return redirect()->back()->with("status", "Product Rating Successfully..!");
            } else {

                return redirect()->back()->with("status", "You Cannot Rate This Product Without Prushase..!");
            }
        } else {
            return redirect()->back()->with("status", "The link You Followed Was broken..!");
        }
    }
}
