<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $paginateInput = $request->input('paginate', 5);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'name');

        // Start building the query
        $orders = Order::with('customer')
            ->when($search, function ($query, $search) {
                return $query->whereHas('customer', function ($query) use ($search) {
                    $query->where('fullname', 'LIKE', '%' . $search . '%');
                })
                    ->orWhere('orderDate', 'LIKE', '%' . $search . '%')
                    ->orWhere('status1', 'LIKE', '%' . $search . '%')
                    ->orWhere('totalPrice', 'LIKE', '%' . $search . '%')
                    ->orWhere('shippingAddress', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('orderDate', $sort)
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);

        $noResults = $orders->isEmpty();
        return view('admin.orders.orders', compact('orders', 'noResults'));
    }


    public function edit($orderID)
    {
        $order = Order::findOrFail($orderID);
        return response()->json($order); // Return order data for editing via AJAX
    }

    public function update(Request $request, $orderID)
    {
        $request->validate([
            'orderDate' => 'required|date',
            'status1' => 'required|string',
            'totalPrice' => 'required|integer',
            'shippingAddress' => 'required|string|max:255',
        ]);

        $order = Order::findOrFail($orderID);
        $order->update([
            'orderDate' => $request->orderDate,
            'status1' => $request->status,
            'totalPrice' => $request->totalPrice,
            'shippingAddress' => $request->shippingAddress,
        ]);

        return redirect()->back()->with('success', 'Order updated successfully!');
    }
    // disable
    public function toggleStatus($orderID)
    {
        $order = Order::find($orderID);

        if ($order) {
            $order->status = !$order->status;
            $order->save();

            $status = $order->status ? 'enabled' : 'disabled';
            return redirect()->back()->with('success', "Order has been {$status}");
        }

        return redirect()->back()->with('error', 'Order not found');
    }
    // show order details
    public function show($orderID)
    {
        $order = Order::with(['orderDetails.product', 'customer'])->findOrFail($orderID);
        $discount = 0.05;
        $voucher = $order->totalPrice * $discount;
        $tax = ($order->totalPrice - $voucher) * 0.10;
        $payment = $order->totalPrice + $tax;

        return view('admin.orders.show', compact('order', 'voucher', 'tax', 'payment',));
    }
    // PDF
    public function downloadPDF($orderID)
    {
        $logoPath = storage_path('app/public/Image/LOGO.png');
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/png;base64,' . $logoData;

        $order = Order::with(['customer', 'orderDetails.product'])->findOrFail($orderID);
        $discount = 0.05;
        $voucher = $order->totalPrice * $discount;
        $tax = ($order->totalPrice - $voucher) * 0.10;
        $payment = $order->totalPrice + $tax;

        $pdf = PDF::loadView('admin.orders.pdf', compact('order', 'voucher', 'tax', 'payment', 'logoSrc'));
        return $pdf->download('order_detail_' . $orderID . '.pdf');
    }

    public function showDeliveryPage()
    {
        // Lấy sản phẩm trong giỏ hàng
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        return view('delivery', compact('cart'));
    }

    // Xử lý đơn hàng
    public function submitOrder(Request $request)
    {
        // Validate thông tin giao hàng
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ]);

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Tính tổng giá trị đơn hàng
        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        try {
            // Tạo mới đơn hàng
            $order = new Order();
            $order->customerID = Auth::check() ? Auth::id() : null;
            $order->orderDate = now();
            $order->status1 = 'Pending';
            $order->status = true;
            $order->totalPrice = $totalPrice;
            $order->shippingAddress = $validatedData['address'];
            $order->save(); // OrderID tự động tăng

            // Clear giỏ hàng
            session()->forget('cart');

            // Chuyển tới trang xác nhận đơn hàng
            return redirect()->route('order.confirmation', ['orderID' => $order->id])->with('success', 'Order has been placed successfully.');
        } catch (\Exception $e) {
            return redirect()->route('cart')->with('error', 'An error occurred while processing your order.');
        }
    }

    // Xác nhận đơn hàng
    public function orderConfirmation($orderID)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($orderID);

        // Truyền đơn hàng sang view
        return view('order-confirm', compact('order'));
    }
}
