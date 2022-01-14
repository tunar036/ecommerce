<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        $name = 'Tunar';
        $surname = 'M' ;
        $adlar = ['Amil','Ramil','Sadiq','Natiq','Yusif'];
        $users = [
            ['id'=>1,'username'=>'Amil'],
            ['id'=>2,'username'=>'Ramil'],
            ['id'=>3,'username'=>'Sadiq'],
            ['id'=>4,'username'=>'Natiq'],
            ['id'=>5,'username'=>'Yusif']
        ];
        return view('homepage',compact('name','surname','adlar','users'));
        // return view('homepage')->with(['name'=>$name,'surname'=>$surname]);
    }
}
