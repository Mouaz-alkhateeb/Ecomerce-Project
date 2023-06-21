<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlists'));
    }

    public function add_to_wishlist(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');
            if (Product::find($product_id)) {
                $wish = new Wishlist();
                $wish->product_id = $product_id;
                $wish->user_id = Auth::id();
                $wish->save();
                return response()->json(["status" => "Product Added To Wishlist"]);
            } else {
                return response()->json(["status" => "Product Doesn't Exists"]);
            }
        } else {
            return response()->json(["status" => "Login To Continue"]);
        }
    }

    public function remove_wishlist_item(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');
            if (Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $wish = Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $wish->delete();
                return response()->json(["status" => "Item Deleted From WishList Successfully..!!"]);
            }
        } else {
            return response()->json(["status" => "Login To Continue..!!"]);
        }
    }

    public function wishlistCount()
    {
        $count = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(["count" => $count]);
    }
}
