<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $voucher;
    public $tax;
    public $payment;
    public $logoCid;
    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $voucher, $tax, $payment)
    {
        $this->order = $order;
        $this->voucher = $voucher;
        $this->tax = $tax;
        $this->payment = $payment;
    }
    /**
     * Build the message.
     */
    public function build()
{
    return $this->view('admin.emails.order')
                ->with([
                    'order' => $this->order,
                    'voucher' => $this->voucher,
                    'tax' => $this->tax,
                    'payment' => $this->payment,
                ])
                ->subject('Order Confirmation for Order ID: ' . $this->order->orderID);
}
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Định dạng ngày tháng từ order (ngày tạo đơn hàng)
        $orderDate = $this->order->created_at->format('d/m/Y'); 

        return new Envelope(
            subject: "Order Confirmation for Order ID: {$this->order->orderID} - Date: {$orderDate}"
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'admin.emails.order',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
