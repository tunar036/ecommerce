<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
        auth()->login($user);
        return redirect()->route('homepage');
    }
}
