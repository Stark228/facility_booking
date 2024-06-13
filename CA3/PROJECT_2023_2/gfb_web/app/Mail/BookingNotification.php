<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $userEmail;
    public $facilityName;

    /**
     * Create a new message instance.
     *
     * @param string $userName
     * @param string $userEmail
     * @param string $facilityName
     */
    public function __construct($userName, $userEmail, $facilityName)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->facilityName = $facilityName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.booking_notification')
            ->subject('New Booking Notification'); // Set the subject for the email
    }
}