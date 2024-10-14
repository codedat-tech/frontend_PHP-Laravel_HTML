<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.checkout'); // Adjust to your Blade file path
    }

    public function process(Request $request)
    {
        // Validate payment information
        $request->validate([
            'cardNumber' => 'required|string',
            'expiryDate' => 'required|string',
            'cvv' => 'required|string',
        ]);

        // Here you can process the order and payment
        // For example, save order details to the database

        // Clear the cart after successful checkout
        Session::forget('cart');

        return redirect('/home')->with('success', 'Order placed successfully! Thank you for your purchase.');
    }


}
