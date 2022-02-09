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

Route::get('/product/{slug_product}',[ProductController::class,'index'])->name('product');
Route::get('/search',[ProductController::class,'search'])->name('search_product');

Route::group(['prefix'=>'basket'],function(){
    Route::get('/',[BasketController::class,'index'])->name('basket');
    Route::post('/add',[BasketController::class,'add'])->name('add.basket');
});


Route::group(['middleware'=>'auth'],function(){
    Route::get('/payment',[PaymentController::class,'index'])->name('payment');
    Route::get('/orders',[OrderController::class,'index'])->name('orders');
    Route::get('/orders/{id}',[OrderController::class,'detail'])->name('order');
});


Route::group(['prefix'=>'user'],function(){
    Route::get('/login',[UserController::class,'login_form'])->name('user.login');
    Route::post('/login',[UserController::class,'login']);
    Route::get('/signup',[UserController::class,'sign_up_form'])->name('user.signup');
    Route::post('/signup',[UserController::class,'sign_up']);
    Route::get('/activate/{key}',[UserController::class,'activate'])->name('activate');
    Route::post('/logout',[UserController::class,'logout'])->name('user.logout');
});

Route::post('/activate/{id}',[UserController::class,'activate_user'])->name('activate_user');

Route::get('/test/email',function(){
    $user = \App\Models\User::find(4     );
    return new App\Mail\UserRegistrationMail($user);
});