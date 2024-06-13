<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingRejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reason)
    {
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.booking_rejection')
                    ->with([
                        'reason' => $this->reason,
                    ])
                    ->subject('Booking Rejection');
    }
}