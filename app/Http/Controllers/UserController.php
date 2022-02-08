<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function sign_in_form(){
        return view('user.sign_in');
    }
    public function sign_in(){
        // dd(request()->all());
        $this->validate(request(),[
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if(auth()->attempt(['email' => request('email'),'password'=>request('password'),'is_active'=>'1'],request()->has('remember_me'))){
            request()->session()->regenerate();
            return redirect()->intended('/');
        }elseif(auth()->attempt(['email' => request('email'),'password'=>request('password'),'is_active'=>'0'])){
            // dd(request()->all());
            User::where('email',request('email'))
            ->update([
                'activation_key'=> Str::random(60),
                'activation_key_send_date' => Carbon::now()
            ]);
            $user = User::where('email',request('email'))->first();
            Mail::to(request('email'))->send(new UserRegistrationMail($user));
            auth()->login($user);
            return redirect()->route('homepage')
            ->with('message','İstifadəçi qeydiyyatınızı emailinizə gələn mesaj vasitəsi ilə aktivləşdirin!')
            ->with('message_type','warning');;

        }else{
            $errors = ['email'=>'Email və ya şifrə düzgün deyil !'];
            return back()->withErrors($errors);
        }
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

    public function logout(){
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('homepage');
    }
}
