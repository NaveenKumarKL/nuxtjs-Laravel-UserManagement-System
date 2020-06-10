<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
            'role' => ['required']
        ]);
        if (Auth::attempt($request->only('email', 'password', 'role'))) {
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'role' => ['The provided credentials are dontno.']
        ]);
    }
    public function logout()
    {
        Auth::logout();
    }
}