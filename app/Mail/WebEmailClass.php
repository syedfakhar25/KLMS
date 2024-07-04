<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WebEmailClass extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $title;
    public $message;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->subject = $data['subject'];
        $this->title = $data['title'];
        $this->message = $data['message'];
        $this->view = isset($data['view']) ? $data['view'] : 'emails.default';
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view:  $this->view,
        );
    }
    public function build()
    {
        return $this->subject($this->subject)
                    ->view($this->view)
                    ->with([
                        'title' => $this->title,
                        'message' => $this->message,
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
