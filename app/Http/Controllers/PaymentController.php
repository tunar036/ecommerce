<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(){
        if (!auth()->check())
        {
            return redirect()->route('user.login')
            ->with('message','Ödəniş əməliyyatı üçün qeydiyyatdan keçməyiniz vacibdir!')
            ->with('message_type','info');
        }
        else {
            $isActive = User::where('id',auth()->id())->first()->is_active;
            // return User::where('id',auth()->id())->where('is_active',0)->get();
            
            if (count(Cart::content())==0) {
                return redirect()->route('homepage')
                ->with('message','Ödəniş əməliyyatı üçün səbətinizdə məhsul olmalıdır!')
                ->with('message_type','info');
            }elseif($isActive == 0){
                return redirect()->route('homepage')
                ->with('message','Ödəniş əməliyyatı üçün hesabinizi tesdiqleyin!')
                ->with('message_type','info');
            }
            $user_detail = Auth::user()->user_detail;
        }
     
        return view('payment',compact('user_detail'));
    }

    public function pay(){
        $order = request()->all();
        $order['basket_id'] = session('activeBasketId');
        $order['order_amount'] = Cart::subtotal();
        $order['status'] = 'Order has been received';
        $order['installment'] = 1;
        $order['bank'] = 'Kapital Bank';

        Order::create($order);
        Cart::destroy();
        session()->forget('activeBasketId');
        return redirect()->route('orders')
        ->with('message_type','success')
        ->with('message','Ödənişiniz uğurla həyata keçirildi');
    }
}
