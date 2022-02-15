<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationMail;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart ;


use function GuzzleHttp\Promise\all;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','activate','activate_user']);
    }

    public function login_form(){
        return view('user.login');
    }

    public function login(){
        // dd(request()->all());
        $this->validate(request(),[
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if(auth()->attempt(['email' => request('email'),'password'=>request('password')],request()->has('remember_me'))){
            request()->session()->regenerate();

            $activeBasketId = Basket::firstOrCreate(['user_id'=>auth()->id()])->id;
            session()->put('activeBasketId',$activeBasketId);
              if (Cart::count()>0) 
              {
                  foreach (Cart::content() as $cartItem) 
                  {
                      BasketProduct::updateOrCreate(
                          ['basket_id' => $activeBasketId,'product_id' =>$cartItem->id],
                          ['pieces'=>$cartItem->qty,'price'=>$cartItem->price,'status'=>'pending']
                      );
                  }
              }
              Cart::destroy();
              $basketProducts = BasketProduct::where('basket_id',$activeBasketId)->get();
              foreach ($basketProducts as $basketProduct) {
                  Cart::add($basketProduct->product->id,$basketProduct->product->name,$basketProduct->pieces,$basketProduct->price,['slug'=>$basketProduct->product->slug]);
              }
            // dd($activeBasketId);
            return redirect()->intended('/');
        }else{
            $errors = ['email'=>'Email və ya şifrə düzgün deyil !'];
            return back()->withErrors($errors);
        }

        // if(auth()->attempt(['email' => request('email'),'password'=>request('password'),'is_active'=>'1'],request()->has('remember_me'))){
        //     request()->session()->regenerate();
        //     return redirect()->intended('/');
        // }elseif(auth()->attempt(['email' => request('email'),'password'=>request('password'),'is_active'=>'0'])){
        //     // dd(request()->all());
        //     User::where('email',request('email'))
        //     ->update([
        //         'activation_key'=> Str::random(60),
        //         'activation_key_send_date' => Carbon::now()
        //     ]);
        //     $user = User::where('email',request('email'))->first();
        //     Mail::to(request('email'))->send(new UserRegistrationMail($user));
        //     auth()->login($user);
        //     return redirect()->route('homepage')
        //     ->with('message','İstifadəçi qeydiyyatınızı emailinizə gələn mesaj vasitəsi ilə aktivləşdirin!')
        //     ->with('message_type','warning');

        // }else{
        //     $errors = ['email'=>'Email və ya şifrə düzgün deyil !'];
        //     return back()->withErrors($errors);
        // }
    }

    public function sign_up_form(){
        return view('user.sign_up');
    }

    public function sign_up (){
        $this->validate(request(),[
            'name'=> 'required|min:5|max:60',
            'email'=>'required|email|unique:user',
            'password'=> 'required|confirmed|min:5|max:15'
        ]);
        
        $user = User::create([
            'name' => request('name'),
            'email'=> request('email'),
            'password'=> Hash::make(request('password')),
            'activation_key'=> Str::random(60),
            'activation_key_send_date' => Carbon::now(),
            'is_active' => 0,
        ]);
        Mail::to(request('email'))->send(new UserRegistrationMail($user));
        auth()->login($user);
        return redirect()->route('homepage')
        ->with('message','İstifadəçi qeydiyyatınızı emailinizə gələn mesaj vasitəsi ilə aktivləşdirin!')
        ->with('message_type','warning');
    }

    public function activate($key){
        $user = User::where('activation_key',$key)->first();
        if(!is_null($user)){
            if(Carbon::parse($user->activation_key_send_date)->gt(Carbon::now()->subSeconds(20))){
                $user->activation_key = null;
                $user->is_active = 1;
                $user->save();
                return redirect()->to('/')
                ->with('message','İstifadəçi qeydiyyatınız aktivləşdirildi')
                ->with('message_type','success');
            }
            else {
                return redirect()->to('/')
                ->with('message','İstifadəçi qeydiyyatınız aktivləşdirilmədi.Vaxt bitib')
                ->with('message_type','warning');
            }
        }else{
            return redirect()->to('/')
            ->with('message','İstifadəçi qeydiyyatınız aktivləşdirilmədi.')
            ->with('message_type','warning');
        }
    }

    public function activate_user ($id){
        User::where('id',$id)
        ->update([
            'activation_key'=> Str::random(60),
            'activation_key_send_date' => Carbon::now()
        ]);

        $user = User::where('id',$id)->first();
        // dd($user);
        Mail::to($user->email)->send(new UserRegistrationMail($user));
        return redirect()->route('homepage')
        ->with('message','Təsdiq mesajı emailinizə göndərildi')
        ->with('message_type','warning');
    }

    public function logout(){
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('homepage');
    }
}
