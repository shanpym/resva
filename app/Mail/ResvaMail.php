<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResvaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingID;
    public $invoicesID;

    /**
     * Create a new message instance.
     */
    public function __construct($bookingID, $invoicesID)
    {
        $this->bookingID = $bookingID;
        $this->invoicesID = $invoicesID;
    }
  
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resva Mail',
        );
    }
  
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.mail'
        );
    }
  
    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}