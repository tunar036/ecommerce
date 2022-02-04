<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function sign_in_form(){
        return view('user.sign_in');
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
            'is_active' => 0,
        ]);
        Mail::to(request('email'))->send(new UserRegistrationMail($user));
        auth()->login($user);
        return redirect()->route('homepage');
    }

    public function activate($key){
        $user = User::where('activation_key',$key)->first();
        if(isNull($user)){
            $user->activation_key = null;
            $user->is_active = 1;
            $user->save();
            return redirect()->to('/')
            ->with('message','İstifadəçi qeydiyyatınız aktivləşdirildi')
            ->with('message_type','success');
        }else{
            return redirect()->to('/')
            ->with('message','İstifadəçi qeydiyyatınız aktivləşdirilmədi.')
            ->with('message_type','warning');
        }
    }
}
