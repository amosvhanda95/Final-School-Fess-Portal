<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword($token)
    {
        return view('auth.reset-password',compact('token')); 
    }
    

    public function resetPasswordPost(Request $request)
{
    $request->validate([
        "email" => "required|email|exists:users",
        "password" => "required|string|min:6|confirmed",
        "password_confirmation" => "required"
    ]);

    $passwordReset = DB::table('password_resets')->where([
        "email" => $request->email,
        "token" => $request->token
    ])->first();

    if (!$passwordReset) {
        return redirect()->to(route('password.reset'))->with("error", "Invalid");
    }

    // Find the user by email
    $user = User::where("email", $request->email)->first();

    if ($user) {
        // Update the user's password
        $user->update(['password' => Hash::make($request->password)]);

        // Delete the password reset record
        DB::table("password_resets")->where("email", $request->email)->delete();

        return redirect()->intended('/dashboard')->with("success", "Password reset successful");
    } else {
        return redirect()->to(route('password.reset'))->with("error", "User not found");
    }
}



    public function forgetPassword(Request $request)
    {
        
    
        $request->validate([
            'email' => 'required|email|exists:users',
            
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=> $request ->email,
            'token'=> $token,
            'created_at'=> Carbon::now()
        ]);

        Mail::send('emails.welcome', ['token' => $token], function ($message) use($request) {
           
            $message->to( $request ->email )
                    ->subject('Reset Password');
        });

        return redirect('/auth/forgot_password')->with('message', 'A reset link email was sent successfully');
    
       
    }
}
