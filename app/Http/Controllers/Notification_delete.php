<?php

namespace App\Http\Controllers;

use App\Mail\ConsultationReminderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Notification extends Controller
{
    public function index()
    {
        $notifications = \App\Models\Customer::user()->notifications;
        return view('notification.index', compact('notifications'));
    }
    //     public function sendemail($email)
    //     {
    //         Mail::to($email)->send(new ConsultationReminderMail($consultationID));
    //         return back()->with('success', 'Email sent successfully');
    //     }
}
