<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            $findUser = User::where('google_id',$user->id)->first();
            if($findUser){
                Auth::login($findUser);
                return redirect()->route('home');
            }else{
                $newUser = User::create([
                    'username' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('anggota123')
                ]);

                Auth::login($newUser);
                return redirect()->route('home');
            }

        } catch (\Throwable $e) {
            dd($e->getMessage()."gagal");
        }
    }
}
