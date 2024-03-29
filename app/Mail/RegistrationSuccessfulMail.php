<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccessfulMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $name, public $confirmDate)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'COVID Registration Successful',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reg_success',
            with: [
                'name' => $this->name,
                'confirmDate' => $this->confirmDate,
            ],
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
