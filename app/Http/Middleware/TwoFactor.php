<?php


namespace App\Http\Middleware;

use Closure;

class TwoFactor
{

    // TwoFactor Middleware

    
    public function handle($request, Closure $next)
{
    $user = auth()->user();

    // Check if the request is for enabling/disabling 2FA and skip verification
    if ($request->is('customer/dashboard/enable2fa/*') || $request->is('customer/dashboard/disable2fa/*')) {
        return $next($request);
    }

    if (auth()->check() && $user->two_factor_enabled == 1) {
        if (session()->has('2fa_verified')) {
            return $next($request);
        }

        if ($user->two_factor_expires_at < now()) {
            $user->resetTwoFactorCode();
            auth()->logout();
            return redirect()->route('login')->withMessage('Der Zwei-Faktor-Code ist abgelaufen. Bitte melden Sie sich erneut an.');
        }

        if (!$request->is('verify*')) {
            return redirect()->route('verify.index');
        }
    }

    return $next($request);
}
    
    
    
  




}
