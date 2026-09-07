<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TwoFactorCode extends Notification
{
    use Queueable;


    public function via($notifiable)
    {
        return ['mail'];
    }

   
    public function toMail($notifiable)
{
    // Check if two_factor_enabled is false, return null to skip sending email
    if (!$notifiable->two_factor_enabled == 1) {
        return null;
    }
    
     $user = User::where('id',Auth::user()->id)->first(); 

    return (new MailMessage)
                ->subject('Zwei-Faktor-Authentifizierungscode (2FA) von EESTIL')
                ->line('Your two-factor code is ' . $notifiable->two_factor_code)
                ->action('Verify Here', route('verify.index'))
                ->line('The code will expire in 10 minutes')
                ->line('If you have not tried to log in, ignore this message.')
                ->from('info@eestill.de', 'Saiful Alam')
                    ->view('mail.2facodeemail', [
                         // Pass the reset URL to the Blade view
                        'notifiable' => $notifiable, // In case you need more details like email
                        'user' => $user,
                    ]);
          
}


}