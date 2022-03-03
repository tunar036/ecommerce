<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{


    public function login()
    {
        // dd(request()->all());
        if (request()->isMethod('post')) {
            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = [
                'email' => request('email'),
                'password' => request('password'),
                'is_active' => 1,
                'is_admin' => 1
            ];
            if (Auth::guard('admin')->attempt($credentials, request()->has('remember_me'))) {
                return redirect()->route('admin.homepage');
            }
            return back()->withInput()->withErrors(['email' => 'Email və ya şifrə düzgün deyil!']);
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('admin.login');
    }

    public function index()
    {
        $list = User::orderByDesc('created_at')->paginate(8);
        return view('admin.user.index', compact('list'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.formEditUser', compact('user'));
    }

    public function new()
    {
        return view('admin.user.formCreateUser');
    }

    public function update($id)
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $data = request()->only('name', 'email');

        if (request()->filled('password')) {
            $data['password'] = Hash::make(request('password'));
        }

        $data['is_active'] = request()->has('is_active') ? 1 : 0;
        $data['is_admin'] = request()->has('is_admin') ? 1 : 0;

        $user = User::where('id', $id)->firstOrFail();
        $user->update($data);

        UserDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => request('address'),
                'phone' => request('phone'),
            ]
        );

        return redirect()
            ->route('admin.user.edit', $user->id)
            ->with('message', 'Updated')
            ->with('message_type', 'success');
    }

    public function save()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' =>'required'
        ]);

        $data = request()->only('name', 'email');

        $data['password'] = Hash::make(request('password'));
        $data['is_active'] = request()->has('is_active') ? 1 : 0;
        $data['is_admin'] = request()->has('is_admin') ? 1 : 0;

        try {
            DB::beginTransaction();

            $user = User::create($data);

            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address' => request('address'),
                    'phone' => request('phone'),
                ]
            );

            DB::commit();
        } catch (Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->with('message', $e->getMessage())
                ->with('message_type', 'error');
        }

        return redirect()
            ->back()
            ->with('message', "Created")
            ->with('message_type', 'success');
    }
}
