<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Authenticate;

//auth class

class Auth extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }

    public function loginPost(Request $request)
    {
//        dd($request->post()); dump and die
        if (Authenticate::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            toastr()->success('Welcome Back '.Authenticate::user()->name);
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->withErrors('Email or password is wrong');

    }

    public function logout(){
        Authenticate::logout();
        return redirect()->route('login');
    }
}
