<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('back.login');
    }

    public function login_post(Request $request)
    {
        request()->validate([
            'email'    => 'required|email|exists:users',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'E-posta gereklidir.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi girin, örneğin infok@ifeelcode.com gibi.',
            'email.exists' => 'Böyle bir e-posta bulunamadı',
            'password.required' => 'Şifre gereklidir.',
            'password.min' => 'Şifreniz en az 6 karakter olmalıdır.',
        ]);
        $userdata = array(
            'email'     => $request->email,
            'password'  => $request->password
        );
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)->first();
        if (!Hash::check($password, $user->password) ) {
            return back()->with('password1', 'Şifreniz girilen e-posta için yanlış!')->with('email_old', $email);
        }

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
