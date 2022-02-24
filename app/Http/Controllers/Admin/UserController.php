<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function login (){
        // dd(request()->all());
        if(request()->isMethod('post')){
            $this->validate(request(),[
                'email'=>'required|email',
                'password'=>'required'
            ]);

            $credentials = [
                'email'=>request('email'),
                'password'=>request('password'),
                'is_admin'=>0
            ];
            if(Auth::guard('admin')->attempt($credentials,request()->has('remember_me')))
            {
                return redirect()->route('admin.homepage');
            }
            return back()->withInput()->withErrors(['email'=>'Email və ya şifrə düzgün deyil!']);
        }
        return view('admin.login');
    }
}
