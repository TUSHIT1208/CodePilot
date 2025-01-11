<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('sign_in');
    }
    public function login(request $request)
    {
        $userData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        if(Auth::attempt($userData))
        {
            return redirect()->route('admin.dashboard');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    
}
