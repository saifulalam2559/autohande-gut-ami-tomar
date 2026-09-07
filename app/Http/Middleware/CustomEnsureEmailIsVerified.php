<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomEnsureEmailIsVerified
{
    
    
     
    public function handle($request, Closure $next)
    {
        

        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user is verified
            if (!$user->email_verified_at) {
                // If the user is not verified, redirect to the verification form
                return redirect()->route('verification.form')->withErrors([
                    'message' => 'Bitte bestätigen Sie Ihre E-Mail Adresse '.' ' .$user->email.' '. ' um fortzufahren.',
                ]);
            }
            


            // If the user is verified, allow access to the next request
            return $next($request);
        }
        
        

        return $next($request);
    }
    
}
