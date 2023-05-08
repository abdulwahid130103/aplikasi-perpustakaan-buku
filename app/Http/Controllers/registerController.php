<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class registerController extends Controller
{
    public function index(){
        return view('login.register');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            "username" => 'required|max:255',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/login')->with('success','Anda berhasil melakukan registrasi');
    }
}
