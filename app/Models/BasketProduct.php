<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasketProduct extends Model
{
    use SoftDeletes;

    protected $table = 'basket_product';
    protected $guarded = [];
    
    public function product (){
        return $this->belongsTo(Product::class);
    }

    use HasFactory;
}
