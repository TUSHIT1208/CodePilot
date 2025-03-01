<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    //use AuthenticatesUsers;

    public function create()
    {
        return view('auth.login');
    }
    public function login_check(request $request)
    {
        
        $userData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        try{
        if (Auth::attempt($userData)) {
            $user = Auth::user();

            if ($user->role && $user->role->name === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role && $user->role->name === 'insructor') {
                return redirect()->route('instructor.dashboard');
            } else {
                return redirect()->route('learner.dashboard');
            }

        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
        }catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            // return response()->json(['error' => 'An error occurred while updating the category.'], 500);
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