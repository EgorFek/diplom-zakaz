<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $req)
    {
        $validations = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validations)) {
            if (!Auth::user()->cart()->first()) {
                Cart::create(['user_id' => Auth::id()]);
            }
            return redirect()->route('main');
        }

        return redirect()->route('login')->withErrors(['email' => "Неверная почта или пароль"]);
    }

    public function register()
    {
        return view('auth.register');
    }
    public function store(Request $req)
    {
        $validations = $req->validate([
            'nick' => 'required|min:3|max:50|unique:users,nick',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        User::create($validations);

        return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('main');
    }
}
