<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Generate the reset URL
        $resetUrl = url(config('app.url') . route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset()
        ], false));

        return (new MailMessage)
                   
                    ->greeting('Hello!')
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->line('Please copy and paste the link below to reset your password:')
                    ->line("<a href='{$resetUrl}'>{$resetUrl}</a>") // Display the URL as a clickable link in HTML
                    ->line('This password reset link will expire in 60 minutes.')
                    ->line('If you did not request a password reset, no further action is required.')
                    ->salutation('Regards, ' . config('app.name'))
                    ->subject('Setzen Sie das Passwort für EESTIL zurück')
                    ->from('info@eestill.de', 'Saiful Alam')
                    ->view('mail.resetpasswordemail', [
                        'resetUrl' => $resetUrl,  // Pass the reset URL to the Blade view
                        'notifiable' => $notifiable, // In case you need more details like email
                    ]);
    }
}
