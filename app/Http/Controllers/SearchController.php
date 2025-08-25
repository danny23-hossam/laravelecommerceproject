<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class SearchController extends Controller
{
    public function search(){
          return view("Client.search");
    }

    public function searchbyname(Request $request){

    
         $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        
        return ProductResource::collection($products);
    
    }
}


