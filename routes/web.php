<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

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

Route::get('/',[HomepageController::class,'index'])->name('homepage');
Route::get('/category/{slug_category}',[CategoryController::class,'index'])->name('category');
Route::get('/product/{slug_productname}',[ProductController::class,'index'])->name('product');
Route::get('/basket',[BasketCOntroller::class,'index'])->name('basket');
Route::get('/payment',[PaymentController::class,'index'])->name('payment');
Route::get('/orders',[OrderController::class,'index'])->name('orders');
Route::get('/orders/{id}',[OrderController::class,'detail'])->name('order');

ROute::group(['prefix'=>'user'],function(){
    Route::get('/signin',[UserController::class,'sign_in'])->name('user.signin');
    Route::get('/signup',[UserController::class,'sign_up'])->name('user.signup');
});


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

