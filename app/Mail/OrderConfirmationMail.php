<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $cart;
    public $totalPrice;
    public $vat;
    public $totalAmount;
    public $orderDetails;

    public function __construct($order, $cart, $totalPrice, $vat, $totalAmount, $orderDetails)
    {
        $this->order = $order;
        $this->cart = $cart;
        $this->totalPrice = $totalPrice;
        $this->vat = $vat;
        $this->totalAmount = $totalAmount; // Ensure this is set
        $this->orderDetails = $orderDetails; // Ensure this is set
    }

    public function build()
    {
        return $this->view('emails.order_confirmation')
                    ->with([
                        'order' => $this->order,
                        'cart' => $this->cart,
                        'totalPrice' => $this->totalPrice,
                        'vat' => $this->vat,
                        'totalAmount' => $this->totalAmount, // Ensure this is included
                        'orderDetails' => $this->orderDetails,
                    ]);
    }
}