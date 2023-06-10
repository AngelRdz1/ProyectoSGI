<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request){
        $user = new User();

        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->contrasena);

        $user->save();

        Auth::login($user);

        return redirect(route('home'));
    }
    public function login(Request $request){
        $credenciales = [
            "email" => $request->email,
            "password" => $request->contrasena
        ];

        $remember = ($request->has('remember')? true : false);

        if(Auth::attempt($credenciales,$remember)){
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }else{
            return redirect('login');
        }
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
