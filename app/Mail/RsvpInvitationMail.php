<?php

namespace App\Mail;

use App\Models\Guest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RsvpInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The guest instance.
     *
     * @var \App\Models\Guest
     */
    public $guest;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Guest  $guest
     * @return void
     */
    public function __construct(Guest $guest)
    {
        $this->guest = $guest->load(['group', 'group.guests']);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'You\'re Invited! - Dannica & James\'s Wedding',
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
            view: 'mail.rsvp-invitation',
        );
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