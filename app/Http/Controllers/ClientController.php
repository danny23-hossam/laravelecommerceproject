<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
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




public function checkout()
{
$cart = Cart::with('product')
    ->where('user_id', Auth::id())
    ->get();
    $total = $cart->sum(fn($item) => $item->product->price * $item->quantity);

    return view('Client.checkout', [
        'cart' => $cart,
        'total' => $total
    ]);
}


public function applyCoupon(Request $request)
{
    // Validate input
    $request->validate([
        'coupon_code' => 'required|string',
    ]);

    $code = $request->input('coupon_code');

    // Find coupon in database
    $coupon = Coupon::where('code', $code)->first();

    if (!$coupon) {
        // Coupon not found
        return back()->with('error', 'Invalid coupon code.');
    }

    // Save the discount in session
    // You can store either fixed amount or percentage depending on your Coupon model
    session([
        'discount' => $coupon->discount, // assuming 'discount' column in DB
        'coupon_code' => $coupon->code
    ]);

    return back()->with('success', "Coupon applied successfully! Discount: $coupon->discount");
}

public function placeOrder(Request $request)
    {
        $quantities = $request->input('quantities');
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->with('product')->get();

        if ($cart->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Check stock
        foreach ($cart as $item) {
             $qty = $quantities[$item->id] ?? $item->quantity;

    if ($qty > $item->product->quantity) {
        return back()->with('error', "{$item->product->name} does not have enough stock.");
    }

    $item->quantity = $qty;
        }

        $subtotal = $cart->sum(fn($item) => $item->product->price * $item->quantity);
        $discount = session('discount', 0);
        $total = $subtotal - $discount;

        // Reduce stock for each product
        foreach ($cart as $item) {
            $item->product->decrement('quantity', $item->quantity);
        }

        // Clear cart and coupon
        Cart::where('user_id', $userId)->delete();
        session()->forget(['discount', 'coupon_code']);

        return redirect()->route('client')->with('success', 'Order placed successfully!');
    }
}


