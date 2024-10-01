<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::guard('student')->attempt($credentials)){
        
            $request->session()->regenerate();

            return redirect()->intended('/');
  
        }elseif (Auth::guard('teacher')->attempt($credentials)){
            
            $request->session()->regenerate();

            return redirect()->intended('/');
        
        }elseif (Auth::guard('user')->attempt($credentials)){
            
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        
        }

        return back()->with('loginError', 'Login failed!');

    }

    public function logout(Request $request){
        if(Auth::guard('student')->check()){
            Auth::guard('student')->logout();
        }elseif(Auth::guard('teacher')->check()){
            Auth::guard('teacher')->logout();
        }elseif(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }
        

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
