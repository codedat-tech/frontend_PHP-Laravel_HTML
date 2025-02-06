<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Console\Commands\SendConsultationReminders;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:check-upcoming-consultations')->everyThreeMinutes();
        $schedule->call(function () {})->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
