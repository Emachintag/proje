<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_post(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended('panel');
        } else {
            return back()->with('errors', 'E-posta veya şifreniz hatalı, lütfen tekrar deneyin')->with('email', $request->email);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('giris');
    }
}
