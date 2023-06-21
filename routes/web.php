<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [FrontendController::class, 'index']);
Route::get('all_categories', [FrontendController::class, 'all_categories']);
Route::get('view_category/{slug}', [FrontendController::class, 'view_category']);
Route::get('view_category/{category_slug}/{product_slug}', [FrontendController::class, 'view_product']);

Route::get('product_list', [FrontendController::class, 'product_list']);
Route::post('search', [FrontendController::class, 'search']);



route::middleware(['auth'])->group(function () {
    Route::post('add_to_cart', [CartController::class, 'add_to_cart']);
    Route::get('cart', [CartController::class, 'show']);
    Route::post('delete_cart_item', [CartController::class, 'delete_cart_item']);
    Route::post('update_cart', [CartController::class, 'update_cart']);
    Route::get('load-cart-data', [CartController::class, 'cartCount']);
    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::post('place_order', [CheckoutController::class, 'place_order']);
    Route::get('my_orders', [UserController::class, 'index']);
    Route::get('view_order/{id}', [UserController::class, 'view_order']);
    Route::get('wishlist', [WishlistController::class, 'index']);
    Route::get('load-wishlist-data', [WishlistController::class, 'wishlistCount']);
    Route::post('rating', [RatingController::class, 'store']);
    Route::get('review/{product_slug}/user_review', [ReviewController::class, 'add']);
    Route::post('add_review', [ReviewController::class, 'store']);
    Route::get('edit_review/{product_slug}/user_review', [ReviewController::class, 'edit']);
    Route::put('update_review', [ReviewController::class, 'update']);
});

Route::post('add_to_wishlist', [WishlistController::class, 'add_to_wishlist']);
Route::post('remove-wishlist-item', [WishlistController::class, 'remove_wishlist_item']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

route::middleware(['auth', 'CheckAdmin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });
    // --- Categories---//

    Route::resource('categories', CategoryController::class);
    Route::get('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    //--- Products ---//
    Route::resource('products', ProductController::class);
    Route::get('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    //--- Orders ---//
    Route::resource('orders', OrderController::class);
    Route::get('order_history', [OrderController::class, 'order_history']);

    //---Users---//
    Route::get('users', [DashboardController::class, 'index']);
    Route::get('users/{id}', [DashboardController::class, 'show']);
});
