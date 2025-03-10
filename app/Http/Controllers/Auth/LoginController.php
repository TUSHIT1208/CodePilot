<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //use AuthenticatesUsers;

    public function create()
    {
        return view('auth.login');
    }
    public function login_check(request $request)
    {
        logger("login_check");
        $userData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        try{
        if (Auth::attempt($userData)) {
            $user = Auth::user();
                logger($userData);
                log::info($user);
            if ($user->role && $user->role->name === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role && $user->role->name === 'insructor') {
                return redirect()->route('instructor.dashboard');
            } elseif ($user->role && $user->role->name === 'learner') {
                return redirect()->route('learner.dashboard');
            }

        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
        }catch (\Exception $e) {
            Log::error('Error login : ' . $e->getMessage());
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

    public function closeAccount(Request $request)
    {   
        log::info("closeAccount");
        $request->validate([
            'yourassword' => 'required',
        ]);
    
        $user = Auth::user();
        logger($user);
        // Check if the provided password is correct
        if (!Hash::check($request->yourassword, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password.'], 401);
        }
    
        Auth::logout(); // Log out the user
        $user->delete(); // Delete the user from the database
    
        return response()->json(['success' => true]);
    }

}