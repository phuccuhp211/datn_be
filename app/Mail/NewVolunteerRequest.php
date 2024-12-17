<?php

namespace App\Mail;

use App\Models\FormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewVolunteerRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $formRequest;

    public function __construct(FormRequest $formRequest)
    {
        $this->formRequest = $formRequest;
    }

    public function build()
    {
        return $this->subject('New Volunteer Request')
            ->view('emails.new_volunteer_request')
            ->with(['formRequest' => $this->formRequest]);
    }
}
