<?php

namespace App\Mail;

use App\Models\User; // Ensure this is the correct import
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Public property to hold the user instance

    // Update the constructor to expect the correct type
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('mail.emailverifycode')
        ->subject('Verifizieren Sie Ihre E-Mail Adresse')
        ->with([
            'code' => $this->user->verification_code,
        ]);
    }
}

