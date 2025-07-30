<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   public function createproduct()
   {
      $categories = Category::all();
      return view("Dashboard.Product.createproduct", compact("categories"));
   }

   public function insert(Request $request)
   {
      $imagePath = null;
      if ($request->hasFile("image")) {
         $imagePath = $request->file("image")->store("products", "public");
      }

      Product::create([
         'name' => $request->name,
         'price' => $request->price,
         'quantity' => $request->quantity,
         'description' => $request->description,
         'image' => $imagePath,
         'category_id' => $request->category_id
      ]);

      return redirect()->route('product.show');
   }



   public function showproduct()
   {
      $products = Product::all();


      return view("Dashboard.Product.showproduct", compact("products"));
   }


   public function delete($id)
   {
      $product = Product::findOrFail($id);
      if ($product->image) {
         Storage::disk('public')->delete($product->image);
      }

      $product->delete();

      return redirect()->route("product.show");
   }

   public function edit($id)
   {
      $product = Product::findOrFail($id);
      $categories = Category::all();
      return view("Dashboard.Product.edit", compact("product", "categories"));
   }
   public function update(Request $request, $id)
   {
      $product = Product::findorFail($id);
      $imagePath = null;
      if ($request->hasFile("image")) {
         $imagePath = $request->file("image")->store("products", "public");
      }
      $product->update([
         'name' => $request->name,
         'price' => $request->price,
         'quantity' => $request->quantity,
         'description' => $request->description,
         'image' => $imagePath,
         'category_id' => $request->category_id
      ]);
      return redirect()->route("product.show");
   }
}
