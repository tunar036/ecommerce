<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\HomepageController as AdminHomepageController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
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

Route::group(['prefix'=>'admin'],function(){
   // Route::redirect('/','/admin/login');
    // Route::get('/login',[AdminUserController::class,'login_form'])->name('admin.login');
    // Route::post('/login',[AdminUserController::class,'login']);
    Route::match(['get','post'],'/login',[AdminUserController::class,'login'])->name('admin.login');
    Route::get('/logout',[AdminUserController::class,'logout'])->name('admin.logout');

    Route::group(['middleware'=>'admin'],function(){
        Route::get('/',[AdminHomepageController::class,'index'])->name('admin.homepage');
            // Admin Panel User
        Route::prefix('user')->group(function () {
            Route::match(['get','post'],'/',[AdminUserController::class,'index'])->name('admin.user');
            Route::get('/new',[AdminUserController::class,'new'])->name('admin.user.new');
            Route::get('/edit/{id}',[AdminUserController::class,'edit'])->name('admin.user.edit');
            Route::post('/update/{id}',[AdminUserController::class,'update'])->name('admin.user.update');
            Route::post('/save',[AdminUserController::class,'save'])->name('admin.user.save');
            Route::get('/delete/{id}', [AdminUserController::class,'delete'])->name('admin.user.delete');
        });
            // Admin Panel Category 
        Route::prefix('category')->group(function () {
            Route::match(['get','post'],'/',[AdminCategoryController::class,'index'])->name('admin.category');
            Route::get('/new',[AdminCategoryController::class,'new'])->name('admin.category.new');
            Route::get('/edit/{id}',[AdminCategoryController::class,'edit'])->name('admin.category.edit');
            Route::post('/update/{id}',[AdminCategoryController::class,'update'])->name('admin.category.update');
            Route::post('/save',[AdminCategoryController::class,'save'])->name('admin.category.save');
            Route::get('/delete/{id}', [AdminCategoryController::class,'delete'])->name('admin.category.delete');
        });
            // Admin Panel Product
        Route::prefix('product')->group(function(){
            Route::match(['get','post'],'/',[AdminProductController::class,'index'])->name('admin.product');
            Route::get('/new',[AdminProductController::class,'new'])->name('admin.product.new');
            Route::get('/edit/{id}',[AdminProductController::class,'edit'])->name('admin.product.edit');
            Route::post('/update/{id}',[AdminProductController::class,'update'])->name('admin.product.update');
            Route::post('/save',[AdminProductController::class,'save'])->name('admin.product.save');
            Route::get('/delete/{id}',[AdminProductController::class,'delete'])->name('admin.product.delete');
        });

        Route::prefix('order')->group(function(){
            Route::match(['get','post'],'/',[AdminOrderController::class,'index'])->name('admin.order');
            Route::get('/new',[AdminOrderController::class,'new'])->name('admin.order.new');
            Route::get('/edit/{id}',[AdminOrderController::class,'edit'])->name('admin.order.edit');
            Route::get('/delete/{id}',[AdminOrderController::class,'delete'])->name('admin.order.delete');
        });
    });
});

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
    Route::delete('/delete/{rowid}',[BasketController::class,'delete'])->name('delete.basket');
    Route::delete('/delete',[BasketController::class,'deleteAll'])->name('empty.basket');
    Route::patch('/update/{rowid}',[BasketController::class,'update'])->name('update.basket');
});

Route::get('/payment',[PaymentController::class,'index'])->name('payment');
Route::post('/payment',[PaymentController::class,'pay'])->name('pay');



Route::group(['middleware'=>'auth'],function(){
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