<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sponsor;

    public function __construct($sponsor)
    {
        $this->sponsor = $sponsor;
    }

    public function build()
    {
        return $this->subject('Cảm ơn bạn đã ủng hộ dự án!')->view('emails.thankyou');
    }
}
