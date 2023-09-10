<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not found']);
        }

        if (Hash::check($request->token, $user->reset_password_token)) {
            $user->update([
                'password' => Hash::make($request->password),
                'reset_password_token' => null,
            ]);

            return redirect()->route('login')->with('status', 'Password reset successful. Please log in.');
        } else {
            return redirect()->back()->withErrors(['token' => 'Invalid reset token']);
        }
    }
    
}
