<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $reservation;
    public $pdfPath;
    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation, $pdfPath)
    {
        $this->reservation = $reservation;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Your Reservation Confirmation')
            ->view('emails.reservation')
            ->attach($this->pdfPath);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Confirmation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
