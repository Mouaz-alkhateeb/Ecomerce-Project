<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function index()
    {
        $old_cartItems = Cart::where('user_id', Auth::id())->get();

        foreach ($old_cartItems as $item) {
            if (!Product::where('id', $item->product_id)->where('qty', '>=', $item->product_quantity)->exists()) {
                $removeItem = Cart::where('user_id', Auth::id())->where('product_id', $item->product_id)->first();
                $removeItem->delete();
            }
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartItems'));
    }

    public function place_order(Request $request)
    {

        $order = new Order();
        $order->user_id = Auth::id();
        $order->first_name = $request->input('first_name');
        $order->last_name = $request->input('last_name');
        $order->phone = $request->input('phone');
        $order->state = $request->input('state');
        $order->city = $request->input('city');
        $order->country = $request->input('country');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->pin_code = $request->input('pin_code');
        $order->email = $request->input('email');
        $order->tracking_number = 'mouaz' . rand(1111, 9999);


        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems_total as $prod) {
            $total += $prod->products->selling_price;
        }

        $order->total_price = $total;

        $order->save();

        $cartItems = Cart::where('user_id', Auth::id())->get();

        foreach ($cartItems as  $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->product_quantity,
                'price' => $item->products->selling_price
            ]);
        }
        $product = Product::where('id', $item->product_id)->first();
        $product->qty = $product->qty - $item->product_quantity;
        $product->update();

        if (Auth::user()->address1 == Null) {
            $user = User::where('id', Auth::id())->first();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone_number = $request->input('phone');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->pin_code = $request->input('pin_code');
            $user->state = $request->input('state');
            $user->update();
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);
        return redirect('/')->with("status", "Order Placed Successfully..!!");
    }
}
