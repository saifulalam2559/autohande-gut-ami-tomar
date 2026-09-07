<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $lastName;
    public $trackingUrl;
    public $shipmentNo;

    public function __construct(public string $subjectLine, string $firstName, string $lastName, string $shipmentNo, string $trackingUrl)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->shipmentNo = $shipmentNo;
        $this->trackingUrl = $trackingUrl;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('mail.dhl')
                    ->with([
                        'firstName' => $this->firstName,
                        'lastName' => $this->lastName,
                        'shipmentNo' => $this->shipmentNo,
                        'trackingUrl' => $this->trackingUrl,
                    ]);
    }
}
