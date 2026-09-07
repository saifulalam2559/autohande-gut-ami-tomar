<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; 
use App\Mail\VerificationEmail;


class VerifyEmailController extends Controller
{
    
    public function showVerificationForm()
    {
        $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->withErrors('Sie müssen angemeldet sein, um auf diese Seite zugreifen zu können.');
    }

    return view('emailverification.form', ['email' => $user->email]);
    }
    
    
    
 public function verify(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'verification_code' => 'required',
    ]);

    // Retrieve the user by email
    $user = User::where('email', $request->email)->first();

    if (!$user || $user->verification_code != $request->verification_code) {
        return back()->withErrors(['verification_code' => 'Ungültiger Bestätigungscode.']);
    }

    // Check if the verification code has expired
    if ($user->expires_at < now()) {
        return back()->withErrors(['verification_code' => 'Der Bestätigungscode ist abgelaufen.']);
    }

    // Update the user's verification status
    $user->email_verified_at = now();
    $user->verification_code = null;
    $user->expires_at = null;
    $user->save();



    // Redirect to the dashboard or intended route
    return redirect()->route('customer.dashboard')->with('success', 'Ihre E-Mail wurde bestätigt.');
}


    public function resendVerificationCode(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'E-Mail Adresse nicht gefunden.']);
        }

        // Generate a new verification code and set expiration
        $user->verification_code = rand(100000, 999999);
        $user->expires_at = now()->addMinutes(15); // Set expiration time
        $user->save();

        // Resend the verification email
        Mail::to($user->email)->send(new VerificationEmail($user));

        return back()->with('success', 'Ein neuer Bestätigungscode wurde an Ihre E-Mail gesendet'.' ' .$user->email);
    }


    
}
