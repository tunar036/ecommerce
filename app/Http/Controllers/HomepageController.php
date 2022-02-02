<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;

class HomepageController extends Controller
{
    public function index(){
        $categories = Category::whereRaw('up_id is null')->take(8)->get();

        // $product_slider = ProductDetail::with('product')->where('show_slider',1)->take(5)->get();
        $product_slider = Product::select('product.*')
        ->join('product_detail','product_detail.product_id','product.id')
        ->where('product_detail.show_slider',1)
        ->orderBy('created_at','desc')
        ->take(5)
        ->get();

        $product_opportunity =Product::select('product.*')
        ->join('product_detail','product_detail.product_id','product_id')
        ->where('product_detail.show_opportunity',1)
        ->orderBy('created_at','desc')
        ->first();

        // $product_featured = ProductDetail::with('product')->where('show_featured',1)->take(4)->get();
        $product_featured = Product::select('product.*')
        ->join('product_detail','product_detail.product_id','product.id')
        ->where('product_detail.show_featured',1)
        ->orderBy('created_at','desc')
        ->take(4)
        ->get();

        // $product_bestselling  = ProductDetail::with('product')->where('show_bestselling',1)->take(4)->get();
        $product_bestselling = Product::select('product.*')
        ->join('product_detail','product_detail.product_id','product.id')
        ->where('product_detail.show_bestselling',1)
        ->orderBy('created_at','desc')
        ->take(4)
        ->get();

        // $product_discount = ProductDetail::with('product')->where('show_discount',1)->take(4)->get();
        $product_discount = Product::select('product.*')
        ->join('product_detail','product_detail.product_id','product.id')
        ->where('product_detail.show_discount',1)
        ->orderBy('created_at','desc')
        ->take(4)
        ->get();
        
        // dd($product_opportunity);
        return view('homepage',compact('categories','product_slider','product_opportunity','product_featured','product_bestselling','product_discount'));
        // return view('homepage')->with(['name'=>$name,'surname'=>$surname]);
    }
}
