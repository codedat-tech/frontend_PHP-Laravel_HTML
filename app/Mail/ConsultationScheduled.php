<?php

namespace App\Mail;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $consultation;

    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    public function build()
    {
        return $this->markdown('admin.emails.consultation_reminder')
            ->with([
                'customerName' => $this->consultation->customer->fullname,
                'designerName' => $this->consultation->designer->fullname,
                'scheduledAt' => $this->consultation->scheduledAT,
            ])
            ->bcc('congtu7677@gmail.com');
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Consultation Scheduled',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'admin.emails.consultation_reminder',
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
