<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Basket extends Model
{
    use SoftDeletes;
    protected $table = 'basket';
    protected $guarded= [];

    public function order(){
        return $this->hasOne(Order::class);
    }

    public function basket_product(){
        return $this->hasMany(BasketProduct::class);
    }

    // public function user (){
    //     return $this->belongsTo(User::class);
    // }
    public static function activeBasketId(){
        $active_basket = DB::table('basket as b')
        ->leftJoin('orders as o','o.basket_id','=','b.id')
        ->where('b.user_id',auth()->id())
        ->whereRaw('o.id is null')
        ->orderByDesc('b.created_at')
        ->select('b.id')
        ->first();

        if(!is_null($active_basket)) return $active_basket->id;
    }



    public function getBasketProductPiecesAttribute(){
        return DB::table('basket_product')->where('basket_id',$this->id)->sum('pieces');
        // return BasketProduct::where('basket_id',$this->id)->sum('pieces');
    }

   
}
