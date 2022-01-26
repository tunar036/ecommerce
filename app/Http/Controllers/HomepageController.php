<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomepageController extends Controller
{
    public function index(){
        $categories = Category::whereRaw('up_id is null')->take(8)->get();
        return view('homepage',compact('categories'));
        // return view('homepage')->with(['name'=>$name,'surname'=>$surname]);
    }
}
