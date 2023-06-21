<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_quantity = $request->input('product_quantity');

        if (Auth::check()) {
            $product_check = Product::where('id', $product_id)->first();
            if ($product_check) {
                if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(["status" => $product_check->name . " Already Added To Cart Successfully..!!"]);
                } else {
                    $itemCart =  new Cart();
                    $itemCart->product_id =  $product_id;
                    $itemCart->product_quantity = $product_quantity;
                    $itemCart->user_id = Auth::id();
                    $itemCart->save();
                    return response()->json(["status" => $product_check->name . " Added To Cart Successfully..!!"]);
                }
            }
        } else {
            return response()->json(["status" => "Login To Continue..!!"]);
        }
    }


    public function show()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart.show', compact('cartItems'));
    }

    public function delete_cart_item(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');
            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $product_item = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $product_item->delete();
                return response()->json(["status" => "Product Deleted From Cart Successfully..!!"]);
            }
        } else {
            return response()->json(["status" => "Login To Continue..!!"]);
        }
    }

    public function update_cart(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');
            $product_quantity = $request->input('product_quantity');
            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {

                $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cart->product_quantity = $product_quantity;
                $cart->update();

                return response()->json(["status" => "Product Updated Successfully..!!"]);
            }
        } else {
            return response()->json(["status" => "Login To Continue..!!"]);
        }
    }

    public function cartCount()
    {
        $count = Cart::where('user_id', Auth::id())->count();
        return response()->json(["count" => $count]);
    }
}
