<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCode;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
           // Check if the user's email is verified
        if (is_null($user->email_verified_at)) {
          
            return redirect()->route('verification.form')->withErrors([
                'email' => 'Sie müssen Ihre E-Mail Adresse bestätigen, bevor Sie sich anmelden.',
            ]);
            
        }
        


        // Check if two-factor authentication is enabled
        if ($user->two_factor_enabled == 1) {
            $user->generateTwoFactorCode();
            $user->notify(new TwoFactorCode());
        }



        // Otherwise, go to the default dashboard
        return redirect()->intended($this->redirectTo);
    }
    
    
    
     public function credentials( Request $request ) {
        
        return ['email'=>$request->email, 'password'=>$request->password, 'status'=>'active', 'role'=>['admin','customer'] ];
    }
    
    
    
}
