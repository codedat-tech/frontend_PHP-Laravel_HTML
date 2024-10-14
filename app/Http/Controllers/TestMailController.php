<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class TestMailController extends Controller
{
    public function sendTestEmail()
    {
        Mail::raw('This is a test email T1.2311.M0', function ($message) {
            $message->to('your_email@example.com') 
                    ->subject('Custom Test Email Subject');
        });

        return 'Test email sent';
    }
}
