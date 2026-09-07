<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Override the sendResetLinkEmail method to check if the email is verified.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email
        $this->validate($request, ['email' => 'required|email']);

        // Check if the user exists and if their email is verified
        $user = User::where('email', $request->email)->where('status','active')->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Wir können keinen Benutzer mit dieser E-Mail-Adresse finden.']);
        }

        if (!$user->email_verified_at) {
            return back()->withErrors(['email' => 'Ihre E-Mail-Adresse wurde nicht bestätigt. Bitte bestätigen Sie Ihre E-Mail, bevor Sie Ihr Passwort zurücksetzen.']);
        }

        // If the email is verified, send the password reset link
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }


    protected function sendResetLinkResponse(Request $request, $response)
{
    $user = User::where('email', $request->email)->where('status','active')->first();
    return back()->with('status', 'Wir haben Ihnen eine E-Mail gesendet an  '. $user->email . ' Klicken Sie auf den enthaltenen Link, um Ihr neues Passwort zu vergeben.');
}



    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(['email' => trans($response)]);
    }
}
