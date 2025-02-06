<?php

namespace App\Console\Commands;

use App\Mail\ConsultationReminder;
use App\Models\Consultation; // Giả sử bạn có model Consultation
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendConsultationReminders extends Command
{
    protected $signature = 'consultation:send-reminders';
    protected $description = 'Send consultation reminders to customers';

    public function handle()
    {
        // Lấy tất cả các cuộc tư vấn còn 24 giờ
        $consultations = Consultation::where('scheduledAT', '>=', now()->addHours(24))
            ->where('scheduledAT', '<=', now()->addHours(25))
            ->get();

        foreach ($consultations as $consultation) {
            Mail::to($consultation->customer_email)->send(new ConsultationReminder($consultation));
        }

        $this->info('Consultation reminders sent successfully!');
    }
}
