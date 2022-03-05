<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
  
    protected $table = 'category';
    protected $guarded = [];
    // protected $fillable = ['name','slug'];
    use HasFactory;

    public function products (){
        return $this->belongsToMany(Product::class);
    }

    public function up_category(){
        return $this->belongsTo(Category::class,'up_id')->withDefault([
            'name' =>'Main category'
        ]);
    }

}
