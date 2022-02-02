<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug){
        $product = Product::whereSlug($slug)->firstOrFail();
        $categories = $product->categories()->distinct()->get();
        // dd($product);
        return view('product',compact('product','categories'));
    }

    public function search(){
        $search = request()->input('search'); 
        $products = Product::where('name', 'like',"%$search%")->orWhere('desc','like',"%$search%")->get();
        request()->flash();
        return view('search',compact('products'));
    }
}
