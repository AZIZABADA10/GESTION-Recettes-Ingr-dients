<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name'=> 'required|string|max:50',
                'email'=> 'required|email',
                'password' => 'required|min:6'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);
        return redirect('/recettes');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $info_connexion = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

       if (Auth::attempt($info_connexion)) {
        $request->session()->regenerate();
        return redirect('/recettes');
       }else{
        return back()->withErrors([
            'email' => 'Identifiants incorrects'
        ]);
       }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
