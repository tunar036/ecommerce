<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug){
        $category = Category::where('slug',$slug)->firstOrFail();
        $down_categories = Category::where('up_id',$category->id)->get();
        // dd($down_categories);
        $products = $category->products()->simplePaginate(4);
        return view('category',compact('category','down_categories','products'));   
    }
}
