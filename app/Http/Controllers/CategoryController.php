<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug){
        $category = Category::where('slug',$slug)->firstOrFail();
        $down_categories = Category::where('up_id',$category->id)->get();
        $order = request('order');
        if ($order == 'bestselling') {
            $products = $category->products()
            ->join('product_detail','product_detail.product_id','product.id')
            ->orderBy('product_detail.show_bestselling','desc')
            ->simplePaginate(4);
        }elseif($order == 'new'){
            $products = $category->products()->orderByDesc('updated_at')->simplePaginate(4);
        }else{
            $products = $category->products()->simplePaginate(4);
            // dd($products->toArray());
        }
        return view('category',compact('category','down_categories','products'));   
    }
}
