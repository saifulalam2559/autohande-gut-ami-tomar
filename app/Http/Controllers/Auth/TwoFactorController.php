<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'twofactor']);
    }

    public function index() 
    {   
         $user = User::where('id',Auth::user()->id)->first(); 
        if ($user->two_factor_enabled == 1) {
        
        return view('auth.twoFactor', compact('user'));
        }

    return redirect()->back()->withMessage('Die Zwei-Faktor-Authentifizierung ist nicht aktiviert.');
   
    }

   public function store(Request $request)
{
    $request->validate([
        'two_factor_code' => 'integer|required',
    ]);

    $user = auth()->user();

    if ($request->input('two_factor_code') == $user->two_factor_code) {
        $user->resetTwoFactorCode();
        
        // Set session flag indicating 2FA has been verified
        session(['2fa_verified' => true]);

        // Redirect based on the user's role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'seller') {
            return redirect()->route('seller.dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('customer.dashboard');
        } else {
            return redirect()->back();
        }
    }

    return redirect()->back()->withErrors(['two_factor_code' => 'Der von Ihnen eingegebene Zwei-Faktor-Code ist nicht korrekt.']);
}

    public function resend()
{
    $user = auth()->user();

    // Check if 2FA is enabled before sending the notification
    if ($user->two_factor_enabled == 1) {
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());
        return redirect()->back()->withMessage('Der Zwei-Faktor-Code wurde erneut gesendet');
    }

    return redirect()->back()->withMessage('Die Zwei-Faktor-Authentifizierung ist nicht aktiviert.');
}



}