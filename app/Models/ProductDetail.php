<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{   
    protected $table = 'product_detail';
    public $timestamps = false;
    protected $guarded = [];
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    use HasFactory;
}
