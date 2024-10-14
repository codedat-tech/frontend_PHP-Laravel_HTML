<?php

namespace App\Http\Controllers;

use App\Models\ReviewOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewOrderController extends Controller
{
    public function index()
    {
        $reviewOrders = ReviewOrder::with('order')->get();
        $orders = Order::all();
        return view('admin.review_orders.review_orders', compact('reviewOrders', 'orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'orderID' => 'required|exists:orders,orderID',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        ReviewOrder::create($request->all());
        return redirect()->route('review_orders.index')->with('success', 'Review Order created successfully.');
    }

    public function update(Request $request, $reviewOrderID)
    {
        $request->validate([
            'orderID' => 'required|exists:orders,orderID',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $reviewOrder = ReviewOrder::findOrFail($reviewOrderID);
        $reviewOrder->update($request->all()); // Use update method for brevity

        return redirect()->route('review_orders.index')->with('success', 'Review Order updated successfully!');
    }

    public function destroy($id)
    {
        $reviewOrder = ReviewOrder::findOrFail($id);
        $reviewOrder->delete();

        return redirect()->route('review_orders.index')->with('success', 'Review Order deleted successfully.');
    }
}
