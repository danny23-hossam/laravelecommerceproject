<?php

use GuzzleHttp\Client;
use App\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\adminMiddleware;
use App\Http\Middleware\ClientMiddleware;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});




Route::middleware([adminMiddleware::class])->group(function(){
Route::get("index",[DashboardController::class,"index"])->name("index");
Route::get("createcategory",[CategoryController::class,"createcategory"])->name("category.create");
Route::get("showcategory",[CategoryController::class,"showcategory"])->name("category.show");
Route::post("insertcategory",[CategoryController::class,"insert"])->name("Category.insert");
Route::delete('deletecategory/{id}',[CategoryController::class,"delete"])->name("category.delete");
Route::get("editcategory/{id}",[CategoryController::class,"edit"])->name("category.edit");
Route::put("updatecategory/{id}",[CategoryController::class,"update"])->name("category.update");
Route::get("createproduct",[ProductController::class,"createproduct"])->name("product.create");
Route::get("showproduct",[ProductController::class,"showproduct"])->name("product.show");
Route::post("insertproduct",[ProductController::class,"insert"])->name("product.insert");
Route::delete("deleteproduct/{id}",[ProductController::class,"delete"])->name("product.delete");
Route::get("edit/{id}",[ProductController::class,"edit"])->name("product.edit");
Route::put("update/{id}",[ProductController::class,"update"])->name("product.update");
});


Route::middleware(['auth', ClientMiddleware::class])->group(function () {
    Route::get("/clientpage", [ClientController::class, "clientshow"])->name("client");
    Route::get("/addtocart/{id}", [ClientController::class, "showcart"])->name("addtocart");
    Route::post("insertcart/{product}", [ClientController::class, "insert"])->name("client.insert");
});



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
