<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart ;
use Illuminate\Http\Request;
// use Gloudemans\Shoppingcart\Contracts\Buyable;


class BasketController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(){
        return view('basket');
    }

    public function add (){
        $product = Product::find(request('id'));
        // dd($product->slug);
        Cart::add($product->id,$product->name,1,$product->price,['slug'=>$product->slug]);

        return redirect()->route('basket')
            ->with('message_type','success')
            ->with('message','Mehsul sebete elave olundu.');
    }

    public function delete($rowid){
        Cart::remove($rowid);
        return redirect()->route('basket')
        ->with('message_type','success')
        ->with('message','Mehsul sebetden silindi.');
    }

    public function deleteAll(){
        Cart::destroy();
        return redirect()->route('basket')
        ->with('message_type','success')
        ->with('message','Səbət boşaldıldı.');
    }
}
