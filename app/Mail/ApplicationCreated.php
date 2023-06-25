<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use App\Models\Application;
use Illuminate\Mail\Mailables\Attachment;

class ApplicationCreated extends Mailable
{
    use Queueable, SerializesModels;



    public Application $application;



    public function __construct(Application $application)
    {
        $this->application = $application;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('example@example.com', 'Example'),
            subject: 'Application Created',

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.application-created',
            with: [
                // 'orderName' => $this->order->name,
                // 'orderPrice' => $this->order->price,
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
        return [
            // Attachment::fromStorageDisk('public', $this->application->file_url),
            if (! is_null($this->application->file_url)) {
                Attachment::fromStorageDisk('public', $this->application->file_url)
            }
        ];
    }
}
