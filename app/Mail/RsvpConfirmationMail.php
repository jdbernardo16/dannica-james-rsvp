<?php

namespace App\Mail;

use App\Models\Rsvp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RsvpConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The RSVP instance.
     *
     * @var \App\Models\Rsvp
     */
    public $rsvp;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Rsvp  $rsvp
     * @return void
     */
    public function __construct(Rsvp $rsvp)
    {
        $this->rsvp = $rsvp->load(['group', 'group.guests']);
        
        // Transform the RSVP data to include group information as direct properties
        $this->rsvp->group_name = $this->rsvp->group ? $this->rsvp->group->name : null;
        $this->rsvp->max_attendees = $this->rsvp->group ? $this->rsvp->group->max_attendees : null;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'RSVP Confirmation - Thank You for Your Response!',
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
            view: 'mail.rsvp-confirmation',
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
