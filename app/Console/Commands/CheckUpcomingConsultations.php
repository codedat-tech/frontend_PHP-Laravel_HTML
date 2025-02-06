<?php

namespace App\Console\Commands;

use App\Mail\ConsultationNotificationMail;
use App\Mail\ConsultationReminderMail;
use App\Mail\ConsultationScheduled;
use App\Models\Consultation;
use App\Notifications\ConsultationReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckUpcomingConsultations extends Command
{
    protected $signature = 'app:check-upcoming-consultations';
    protected $description = 'Check consultations that are scheduled soon and alert admin';

    public function handle()
    {
        $timeToCheck = now()->addMinutes(3);

        $upcomingConsultations = Consultation::with(['customer', 'designer'])
            ->where('scheduledAT', '<=', $timeToCheck)
            ->where('alert_sent', 'active')
            ->get();

        if ($upcomingConsultations->isEmpty()) {
            $this->info('No upcoming consultations to notify.');
            return;
        }

        foreach ($upcomingConsultations as $consultation) {
            try {
                // Bạn đã có đối tượng $consultation từ vòng lặp, không cần phải tìm lại nó.
                $consultation->load('customer', 'designer'); // Nạp thêm thông tin liên quan

                // Kiểm tra nếu $consultation đúng là đối tượng Consultation
                if (!$consultation instanceof Consultation) {
                    throw new \Exception('Đối tượng không phải là Consultation');
                }

                Mail::to($consultation->customer->email)
                    ->cc([$consultation->designer->email, 'congtu7677@gmail.com'])
                    ->send(new ConsultationScheduled($consultation));

                $consultation->update(['alert_sent' => 'sent']);
                $this->info('Email sent for consultation ID: ' . $consultation->consultationid);
            } catch (\Exception $e) {
                Log::error('Error sending email for consultation ID ' . $consultation->consultationid . ': ' . $e->getMessage());
                $this->error('An error occurred while sending email for consultation ID ' . $consultation->consultationid);
            }
        }
    }
}
