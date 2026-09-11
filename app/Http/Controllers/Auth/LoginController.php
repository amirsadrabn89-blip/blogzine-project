<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index(){

        if (Auth::check()) {
            return redirect()->route('admin.dashboard.page');
        }
        return view('auth.login');
    }


    public function checkAuth(Request $request)
    {
        $validated = $request->validate([

            'email'    => ['required'],
            'password' => ['required' , 'min:8'],
        ],[
            'email.required'    => '● لطفا فیلد ایمیل را تکمیل کنید !',
            'password.required' => '● لطفا فیلد رمز عبور را تکمیل کنید !',
            'password.min'      => '● رمز عبور باید حداقل 8 کاراکتر باشد !',
        ]);

        $remember = $request->has('remember');
        
        if (Auth::attempt($validated, $remember)) {

            $request->session()->regenerate();
            return redirect()
            ->intended(route('index.page'))
            ->with('success', ' ورود شما با موفقیت انجام شد.');
        }

        return back()->withErrors([
            'password' => '● رمز عبور وارد شده یا ایمیل اشتباه است !',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index.page');
    }
}   
