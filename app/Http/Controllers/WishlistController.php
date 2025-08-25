<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index2()
    {
        $wishlist = session()->get('wishlist', []);
        return view('Client.wishlist', compact('wishlist'));
    }

    public function add($id)
{
    $product = Product::findOrFail($id);

    $wishlist = session()->get('wishlist', []);

    if (!isset($wishlist[$id])) {
        $wishlist[$id] = [
            'id'    => $product->id,
            'name'  => $product->name,
            'price' => $product->price,
            // if you stored the filename in `image`
            'image' => asset('storage/' . $product->image),  
        ];
    }

    session()->put('wishlist', $wishlist);

    return back()->with('success', 'Product added to wishlist!');
}
    public function remove($id)
    {
        $wishlist = session()->get('wishlist', []);

        if(isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return back()->with('success', 'Product removed from wishlist!');
    }
}
