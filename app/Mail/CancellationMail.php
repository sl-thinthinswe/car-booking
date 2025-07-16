<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CancellationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $reason;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $reason = null)
    {
        $this->user = $user;
        $this->reason = $reason;
    }
    public function build()
    {
        return $this->subject('Booking Cancelled')
                    ->view('pages.admin.emails.cancellation');
    }

    /**
     * Get the message envelope.
     */
}
