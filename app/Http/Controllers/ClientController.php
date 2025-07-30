<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // Show all products to the client
    public function clientshow()
    {
        $products = Product::all();
        return view('Client.index', compact('products'));
    }

    // Show single product details and add to cart form
    public function showcart($id)
    {
        $product = Product::findOrFail($id);
        return view('Client.Addtocart', compact('product'));
    }

    // Insert selected product to cart
    public function insert(Request $request, Product $product)
    {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->input('quantity', 1) // Default quantity is 1
        ]);

        return redirect()->route('client')->with('success', 'Product added to cart!');
    }
}
