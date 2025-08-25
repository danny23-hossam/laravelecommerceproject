<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function  filter(Request $request){

         $query = Product::query();

        // Filter by min price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Filter by max price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        
     // Filter by availability (stock)
if ($request->filled('availability')) {
    if ($request->availability == '1') {
        $query->where('quantity', '>', 0); // In Stock
    } elseif ($request->availability == '0') {
        $query->where('quantity', '=', 0); // Out of Stock
    }
}

       

        $products = $query->get();
        $categories = Category::all();
        return view("Client.filter",compact("categories","products"));
    }
}
