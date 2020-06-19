<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'min:8'],
            'role' => ['required']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role

        ]);
    }
}