<?php

namespace App\Notifications;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationReminder extends Notification
{
    use Queueable;
    private $consultation;
    /**
     * Create a new notification instance.
     */
    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Consultation Reminder')
            ->line('You have an upcoming consultation.')
            ->line('Consultation ID: ' . $this->consultation->consultationID)
            ->line('Scheduled At: ' . $this->consultation->scheduledAT)
            ->action('View Consultation', url('/consultations/' . $this->consultation->consultationID))
            ->line('Please be prepared!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
