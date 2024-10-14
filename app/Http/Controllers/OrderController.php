<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // Fetch all orders
        return view('admin.orders.orders', compact('orders')); // Pass orders to view
    }

    public function edit($orderID)
    {
        $order = Order::findOrFail($orderID);
        return response()->json($order); // Return order data for editing via AJAX
    }

    public function update(Request $request, $orderID)
    {
        $request->validate([
            'orderDate' => 'required|string',
            'status' => 'required|string',
            'totalPrice' => 'required|integer',
            'shippingAddress' => 'required|string|max:255',
        ]);

        $order = Order::findOrFail($orderID);
        $order->update([
            'orderDate' => $request->orderDate,
            'status' => $request->status,
            'totalPrice' => $request->totalPrice,
            'shippingAddress' => $request->shippingAddress,
        ]);

        return redirect()->back()->with('success', 'Order updated successfully!');
    }

    public function destroy($orderID)
    {
        $order = Order::findOrFail($orderID);
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully!');
    }
}
