<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.products.index', compact('products'));
    }
    public function create()
    {
        $catrgories = Category::all();
        return view('dashboard.products.add', compact('catrgories'));
    }


    public function store(Request $request)
    {
        $product = new Product();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extention;
            $file->move('uploads/products', $file_name);
            $product->image =   $file_name;
        }
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->small_desc = $request->input('small_desc');
        $product->orginal_price = $request->input('orginal_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keyword = $request->input('meta_keyword');
        $product->status = $request->input('status') == true ? '1' : '0';
        $product->trending = $request->input('trending') == true ? '1' : '0';
        $product->save();
        return redirect('/products')->with('status', 'Product Added Succesfully..!!');
    }

    public function edit(Product $product)
    {
        $catrgories = Category::all();
        return view('dashboard.products.edit', compact('product', 'catrgories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $path = 'uploads/products/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extention;
            $file->move('uploads/products', $file_name);
            $product->image =   $file_name;
        }

        $product->name = $request->input('name');
        // $product->category_id = $request->input('category_id');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->small_desc = $request->input('small_desc');
        $product->orginal_price = $request->input('orginal_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keyword = $request->input('meta_keyword');
        $product->status = $request->input('status') == true ? '1' : '0';
        $product->trending = $request->input('trending') == true ? '1' : '0';
        $product->update();
        return redirect('/products')->with('status', 'Product Updated Succesfully..!!');
    }

    public function destroy(Product $product)
    {

        if ($product->image) {
            $path = 'uploads/products/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('/products')->with('status', 'product Deleted Succesfully..!!');
    }
}