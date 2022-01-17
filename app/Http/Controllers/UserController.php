<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function sign_in(){
        return view('user.sign_in');
    }
    public function sign_up(){
        return view('user.sign_up');
    }
}
