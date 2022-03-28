<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if(request()->filled('search')){
            request()->flash();    
            $search = request('search');
            $list = Order::with('basket.user')
            ->where('name','like',"%$search%")
            ->orWhere('id',$search)
            ->orderByDesc('id')
            ->paginate(8);
            
        }else{
            $list =  Order::with('basket.user')
                    ->orderByDesc('id')
                    ->paginate(8);
        }
        
       return view('admin.order.index',compact('list'));
    }

    public function edit($id)
    {
        $order = Order::with('basket.basket_product.product')->findOrFail($id);
        return view('admin.order.formEditOrder',compact('order'));
    }
}
