<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class PayPalController extends Controller
{
    public function createTransaction($orderID)
    {
        // Retrieve the order details using the orderID
        $order = Order::findOrFail($orderID);

        // Initialize PayPal client
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // Prepare the data for the PayPal order
        $data = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD", // Change to your currency
                        "value" => number_format($order->totalPrice, 2, '.', '') // Use the order total
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('payment.success', ['orderID' => $orderID]),
                "cancel_url" => route('payment.cancel'),
            ],
        ];

        // Create the order
        $response = $provider->createOrder($data);

        // Check for successful response
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('createTransaction', ['orderID' => $orderID])->with('error', 'Something went wrong.');
        }
    }

    public function success(Request $request, $orderID)
{
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();

    // Capture the payment
    $response = $provider->capturePaymentOrder($request['token']);

    // Check if the payment was successful
    if (isset($response['status']) && $response['status'] == 'COMPLETED') {
        // Update the order status to completed
        $order = Order::findOrFail($orderID);
        $order->status1 = 'Completed';
        $order->save();

        // Retrieve additional data needed for the email
        $cart = session()->get('cart'); // Assuming you store the cart in the session
        $totalPrice = $order->totalPrice; // Assuming this is the total price of the order
        $vat = $order->vat; // Assuming you have a VAT field in your Order model
        $totalAmount = $order->totalAmount; // Assuming you have a total amount field in your Order model
        $orderDetails = $order->details; // Assuming you have order details in your Order model

        // Send confirmation email with all necessary data
        Mail::to($order->customer->email)->send(new OrderConfirmationMail($order, $cart, $totalPrice, $vat, $totalAmount, $orderDetails));

        // Clear the cart (if applicable)
        session()->forget('cart');

        return redirect()->route('order.confirmation', ['id' => $order->orderID])->with('success', 'Transaction complete.');
    } else {
        return redirect()->route('createTransaction', ['orderID' => $orderID])->with('error', 'Transaction failed.');
    }
}
}