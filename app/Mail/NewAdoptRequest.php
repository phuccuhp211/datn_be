<?php

namespace App\Mail;

use App\Models\FormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAdoptRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $formRequest;

    public function __construct(FormRequest $formRequest)
    {
        $this->formRequest = $formRequest;
    }

    public function build()
    {
        return $this->subject('New Adoption Request')
            ->view('emails.adopt')
            ->with(['formRequest' => $this->formRequest]);
    }
}
