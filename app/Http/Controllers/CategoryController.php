<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createcategory(){
        
        return view("Dashboard.Category.createcategory");
    }

    public function insert(Request $request){
      				        Category::create([
           							 'name'=>$request->name
        							]);   
                        return redirect()->route('category.show');
                          
        
    }
    public function showcategory(){
        $categories=Category::all();
         return view("Dashboard.Category.showcategory",compact("categories"));
    }

    public function delete($id){
        $category=Category::findOrFail($id);
        $category->delete();
         return redirect()->route('category.show');
    }


    public function edit($id){
        $category=Category::findOrFail($id);
        return view("Dashboard.Category.edit",compact("category"));
    }

    public function update(Request $request,$id){
        $category=Category::findorFail($id);
                           $category->update([
                            'name'=>$request->name
                                    ]);
                          return redirect()->route("category.show");
    }
}
