<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketProduct;
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
        $cartItem = Cart::add($product->id,$product->name,1,$product->price,['slug'=>$product->slug]);

        if(auth()->check()){
            $activeBasketId = session('activeBasketId');
            if (!isset($activeBasketId)) {
                $activeBasket = Basket::create([
                    'user_id' => auth()->id()
                ]);
                $activeBasketId = $activeBasket->id;
                session()->put('activeBasketId',$activeBasketId);
            }

            BasketProduct::updateOrCreate(
                ['basket_id'=>$activeBasketId,'product_id'=>$product->id],
                ['pieces'=>$cartItem->qty,'price'=>$product->price,'status'=>'pending']
            );
        }

        return redirect()->route('basket')
            ->with('message_type','success')
            ->with('message','Mehsul sebete elave olundu.');
    }

    
    public function delete($rowid){
        if(auth()->check()){
            $activeBasketId = session('activeBasketId');
            $cartItem = Cart::get($rowid);
            BasketProduct::where('basket_id',$activeBasketId)->where('product_id',$cartItem->id)->delete();
        }
        Cart::remove($rowid);
        return redirect()->route('basket')
        ->with('message_type','success')
        ->with('message','Mehsul sebetden silindi.');
    }

    public function deleteAll(){
        if(auth()->check()){
            $activeBasketId = session('activeBasketId');
            BasketProduct::where('basket_id',$activeBasketId)->delete();
        }
        Cart::destroy();
        return redirect()->route('basket')
        ->with('message_type','success')
        ->with('message','Səbət boşaldıldı.');
    }

    public function update ($rowid){
        $validator = Validator::make(request()->all(),[
            'piece'=> 'required|numeric|between:0,5'
        ]);
        if ($validator->fails()) {
            session()->flash('message_type','danger');
            session()->flash('message','Eded deyeri 1 ve 5 arasinda olmalidir');
            return response()->json(['success'=>false]);

        }

        if(auth()->check()){
            $activeBasketId = session('activeBasketId');
            $cartItem = Cart::get($rowid);
            if(request('piece') == 0)
                BasketProduct::where('basket_id',$activeBasketId)->where('product_id',$cartItem->id)->delete();
            else
                BasketProduct::where('basket_id',$activeBasketId)->where('product_id',$cartItem->id)
                ->update(['pieces'=>request('piece')]);
        }
            Cart::update($rowid,request('piece'));

            session()->flash('message_type','success');
            session()->flash('message','Səbət yenilendi.');
            
            return response()->json(['success'=>true]);
        }
}
