<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VaccineReminderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;

    public $scheduleDate;

    public $centerName;

    public function __construct($name, $scheduleDate, $centerName)
    {
        $this->name = $name;
        $this->scheduleDate = $scheduleDate;
        $this->centerName = $centerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vaccine Reminder Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reminder_email',
            with: [
                'name' => $this->name,
                'scheduleDate' => $this->scheduleDate,
                'centerName' => $this->centerName,
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
