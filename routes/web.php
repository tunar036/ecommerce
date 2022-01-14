<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/',[HomepageController::class,'index']);


Route::get('/test',function(){
    return 'ecommerce';
});

Route::get('/api/v1/merheba',function(){
    return ['name'=>'Tunar','surname'=>'M'];
});

Route::get('/products/{ad}/{say}/{qiymet}',function($productname,$productsay,$productcost){
    // return 'mehsulun adi ' . $product;
    return ['mehsulun adi'=>$productname,
            'mehsulun sayi'=>$productsay,
            'mehsulun qiymeti'=>$productcost.' manat'
        ];
})->name('filansehy');


Route::get('company',function(){
    return redirect()->route('filansehy',['ad'=>'alma','say'=>'5','qiymet'=>5]);
});

Route::view('/category','category');
Route::view('/product','product');
Route::view('/basket','basket');
