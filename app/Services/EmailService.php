<?php
namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendEmail($to, $subject, $message, $from = null)
    {
        $from = $from ?? config('mail.from.address');

        Mail::send([], [], function ($mail) use ($to, $subject, $message, $from) {
            $mail->to($to)
                 ->from($from)
                 ->subject($subject)
                 ->setBody($message, 'text/html');
        });

        return true;
    }
}
