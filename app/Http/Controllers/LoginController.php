<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
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
    public function create_changepassword()
    {
        return view('change_password');
    }
    public function changePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'The current password is incorrect.']);
        }

        // Update the user's password using the update method
        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);

        // Redirect with success message
        return back()->with('success', 'Password changed successfully!');
    }
}
