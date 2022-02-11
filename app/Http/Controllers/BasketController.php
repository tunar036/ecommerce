<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function update ($rowid){
        $validator = Validator::make(request()->all(),[
            'piece'=> 'required|numeric|between:1,5'
        ]);
        if ($validator->fails()) {
            session()->flash('message_type','danger');
            session()->flash('message','Eded deyeri 1 ve 5 arasinda olmalidir');
            return response()->json(['success'=>false]);

        }
            Cart::update($rowid,request('piece'));

            session()->flash('message_type','success');
            session()->flash('message','Səbət yenilendi.');
            
            return response()->json(['success'=>true]);
        }
}
