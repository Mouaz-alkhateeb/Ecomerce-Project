<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $trending_products = Product::where('trending', "1")->take(15)->get();

        $trending_categories = Category::where('popular', "1")->take(15)->get();
        return view('frontend.index', compact('trending_products', 'trending_categories'));
    }

    public function all_categories()
    {
        $categories = Category::where('status', "1")->get();
        return view('frontend.categories.index', compact('categories'));
    }

    public function view_category($slug)
    {
        if (Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('category_id', $category->id)->where('status', "0")->get();

            return view('frontend.products.index', compact('category', 'products'));
        } else {
            return redirect('/')->with('status', 'Slug Not Fount');
        }
    }
    public function view_product($category_slug, $product_slug)
    {
        if (Category::where('slug', $category_slug)->exists()) {
            if (Product::where('slug', $product_slug)->exists()) {
                $product = Product::where('slug', $product_slug)->first();
                $ratings = Rating::where('product_id', $product->id)->get();

                $rating_sum = Rating::where('product_id', $product->id)->sum('stars_rated');

                $user_rating = Rating::where('product_id', $product->id)->where('user_id', Auth::id())->first();

                $reviews = Review::where('product_id', $product->id)->get();

                if ($ratings->count() > 0) {
                    $rating_value = $rating_sum / $ratings->count();
                } else {
                    $rating_value = 0;
                }

                return view('frontend.products.show', compact('product', 'ratings', 'rating_value', 'user_rating', 'reviews'));
            } else {
                return redirect('/')->with('status', 'The Link Was Broken..!!');
            }
        } else {
            return redirect('/')->with('status', 'Category Not Found..!!');
        }
    }

    public function product_list()
    {
        $products = Product::select('name')->where('status', '0')->get();
        $data = [];
        foreach ($products as $product) {
            $data[] = $product['name'];
        }
        return $data;
    }

    public function  search(Request $request)
    {
        $product_searched = $request->input('product_name');
        if ($product_searched != "") {
            $product = Product::where('name', 'LIKE', "%$product_searched%")->first();
            if ($product) {
                return redirect('view_category/' . $product->category->slug . '/' . $product->slug);
            } else {
                return redirect()->back()->with("status", "No Products  Matched Your Search");
            }
        } else {
            return redirect()->back();
        }
    }
}
