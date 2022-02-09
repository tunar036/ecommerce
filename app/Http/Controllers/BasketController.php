<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('basket');
    }

    public function add (){
        $product = Product::find(request('id'));
        Cart::add($product->id,$product->name,1,$product->price);
        
        return redirect()->route('basket')
        ->with('message_type','success')
        ->with('message','Mehsul sebete elave olundu');
    }
}
