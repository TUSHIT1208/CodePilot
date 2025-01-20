<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    public function create()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'emailaddress' => 'required|email|exists:users,email', // Validate the input field named 'emailaddress'
        ]);

        // Map the input 'emailaddress' to 'email' before sending the reset link
        $status = Password::sendResetLink([
            'email' => $request->input('emailaddress'),
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['emailaddress' => __($status)]);
    }
}
