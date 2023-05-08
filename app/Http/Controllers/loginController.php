<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index(){
        return view('login.login');
    }
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $userRole = Auth::user()->role;
            $request->session()->regenerate();
            if ($userRole == 'anggota') {
                return redirect()->route('home');
            }else if ($userRole == 'admin' || $userRole == 'petugas') {
                return redirect()->route('dashboard');
            }
        }

        return back()->with('loginError','Login Failed!');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
