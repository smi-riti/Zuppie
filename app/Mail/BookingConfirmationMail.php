<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $isAdminNotification;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, $isAdminNotification = false)
    {
        $this->booking = $booking;
        $this->isAdminNotification = $isAdminNotification;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->isAdminNotification 
            ? 'New Booking Received - ' . $this->booking->eventPackage->name
            : 'Booking Confirmation - ' . $this->booking->eventPackage->name;

        $view = $this->isAdminNotification 
            ? 'emails.admin-booking-notification'
            : 'emails.booking-confirmation';

        return $this->subject($subject)
            ->view($view)
            ->with([
                'booking' => $this->booking,
                'user' => $this->booking->user,
                'isAdminNotification' => $this->isAdminNotification
            ]);
    }
}
