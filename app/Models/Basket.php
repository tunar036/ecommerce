<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;
}
