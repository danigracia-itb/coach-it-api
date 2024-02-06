<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $athlete;
    public $coach;
    public $date;
    public $quantity;

    /**
     * Create a new message instance.
     */
    public function __construct($athlete, $coach, $date, $quantity)
    {
        $this->athlete = $athlete;
        $this->coach = $coach;
        $this->date = $date;
        $this->quantity = $quantity;
    }


    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('mails.paymentReminder')
            ->subject("Payment Reminder")
            ->with([
                "athlete" => $this->athlete,
                "coach" => $this->coach,
                "date" => $this->date,
                "quantity" => $this->quantity,
            ]);
    }
}
