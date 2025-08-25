<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\adminMiddleware;
use App\Http\Middleware\ClientMiddleware;
use App\Http\Controllers\ClientController;

use App\Http\Controllers\FilterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CouponController as AdminCouponController;

Route::get('/', function () {
    return view('welcome');
});

// ---------------- DASHBOARD ---------------- //
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// ---------------- ADMIN ROUTES ---------------- //
Route::middleware([adminMiddleware::class])->group(function () {
    // Dashboard
    Route::get("index",[DashboardController::class,"index"])->name("index");

    // Category
    Route::get("createcategory",[CategoryController::class,"createcategory"])->name("category.create");
    Route::get("showcategory",[CategoryController::class,"showcategory"])->name("category.show");
    Route::post("insertcategory",[CategoryController::class,"insert"])->name("Category.insert");
    Route::delete('deletecategory/{id}',[CategoryController::class,"delete"])->name("category.delete");
    Route::get("editcategory/{id}",[CategoryController::class,"edit"])->name("category.edit");
    Route::put("updatecategory/{id}",[CategoryController::class,"update"])->name("category.update");

    // Product
    Route::get("createproduct",[ProductController::class,"createproduct"])->name("product.create");
    Route::get("showproduct",[ProductController::class,"showproduct"])->name("product.show");
    Route::post("insertproduct",[ProductController::class,"insert"])->name("product.insert");
    Route::delete("deleteproduct/{id}",[ProductController::class,"delete"])->name("product.delete");
    Route::get("edit/{id}",[ProductController::class,"edit"])->name("product.edit");
    Route::put("update/{id}",[ProductController::class,"update"])->name("product.update");

    // Coupons
    Route::get('/coupons', [AdminCouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [AdminCouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [AdminCouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}', [AdminCouponController::class, 'show'])->name('coupons.show');
    Route::get('/coupons/{coupon}/edit', [AdminCouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/coupons/{coupon}', [AdminCouponController::class, 'update'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [AdminCouponController::class, 'destroy'])->name('coupons.destroy');

});
   







Route::middleware(['auth'])->group(function () {
Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/apply-coupon', [ClientController::class, 'applyCoupon'])->name('checkout.coupon');
    Route::post('/checkout/place-order', [ClientController::class, 'placeOrder'])->name('checkout.place');
});








// ---------------- CLIENT ROUTES ---------------- //
Route::middleware(['auth', ClientMiddleware::class])->group(function () {
    Route::get("/clientpage", [ClientController::class, "clientshow"])->name("client");
    Route::get("/addtocart/{id}", [ClientController::class, "showcart"])->name("addtocart");
    Route::post("insertcart/{product}", [ClientController::class, "insert"])->name("client.insert");
});

// ---------------- SEARCH ---------------- //
Route::get("/search",[SearchController::class,"search"])->name("client.search");
Route::get('/products/searchbyname', [SearchController::class, 'searchbyname']);

// ---------------- FILTER ---------------- //
Route::get("/filterprice",[FilterController::class,"filter"])->name("filter");

// ---------------- WISHLIST ---------------- //
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'index2'])->name('wishlist.index');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

// ---------------- PROFILE ---------------- //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
