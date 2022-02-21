<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index (){
        $orders = Order::with('basket')->orderByDesc('created_at')->get();
        return view('orders',compact('orders'));
    }

    public function detail($id){
        $order = Order::with('basket.basket_product.product')->where('orders.id',$id)->firstOrFail();
        return view('order',compact('order'));
        // return $order;
    }
}
