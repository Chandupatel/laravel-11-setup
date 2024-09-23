<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contents;
    public $subject;
    public $fromEmail;
    public $ccEmails;
    public $bccEmails;
    public $attachments;

    /**
     * Create a new message instance.
     *
     * @param array $contents
     * @param string $subject
     * @param string $fromEmail
     * @param string $fromName
     * @param array $cc
     * @param array $bcc
     * @param array $attachments
     */
    public function __construct($contents, $subject, $cc = [], $bcc = [], $attachments = [])
    {
        $this->contents = $contents;
        $this->subject = $subject;
        $this->fromEmail = env('MAIL_FROM_ADDRESS');
        $this->fromName = env('MAIL_FROM_NAME');
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->attachments = $attachments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: $this->fromEmail, // Dynamic from address
            subject: $this->subject, // Dynamic subject
            cc: $this->cc, // Dynamic CC
            bcc: $this->bcc// Dynamic BCC
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notification', // The view for the email
            with: ['contents' => $this->contents]// Pass data to the view
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $emailAttachments = [];

        // Attach multiple files if provided
        foreach ($this->attachments as $filePath) {
            $emailAttachments[] = Attachment::fromPath($filePath)
                ->as(basename($filePath)) // Use the file name dynamically
                ->withMime(mime_content_type($filePath)); // Detect MIME type
        }

        return $emailAttachments;
    }
}
