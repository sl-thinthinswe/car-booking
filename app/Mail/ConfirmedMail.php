<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->subject('Your Car Ticket Confirmation')
                    ->view('pages.admin.emails.ticket_confirmed');
    }
}
