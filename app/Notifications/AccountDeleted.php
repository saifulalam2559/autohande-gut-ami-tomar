<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountDeleted extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail']; // Send email notification
    }

                public function toMail($notifiable)
            {
                return (new MailMessage)
                    ->subject('Account Deletion Notification')
                    ->greeting('Hello Admin,')
                    ->line('A user has deleted their account.')
                    ->view('mail.accountdeletion', [
                        'user' => $this->user,
                        'kundennummer' => optional($this->user->accountdelete)->kundennummer,
                        'reason' => optional($this->user->accountdelete)->reason,
                        'ip_address' => optional($this->user->accountdelete)->ip_address,
                        'browser_details' => optional($this->user->accountdelete)->browser_details,
                        'deleted_at' => now(),
                    ]);
            }

}