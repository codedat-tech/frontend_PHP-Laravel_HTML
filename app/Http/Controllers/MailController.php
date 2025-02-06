<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\OrderShipped;
use App\Models\Consultation;

class MailController extends Controller
{

    public function sendOrderMail($orderID)
    {
        $order = Order::with(['customer', 'orderDetails.product'])->findOrFail($orderID);
        $discount = 0.05;
        $voucher = $order->totalPrice * $discount;
        $tax = ($order->totalPrice - $voucher) * 0.10;
        $payment = $order->totalPrice + $tax;

        //Mailable để gửi email
        Mail::to($order->customer->email)
            ->cc('congtu7677@gmail.com')
            ->send(new OrderShipped($order, $voucher, $tax, $payment));

        return back()->with('success', 'Order details email sent successfully!');
    }
}
