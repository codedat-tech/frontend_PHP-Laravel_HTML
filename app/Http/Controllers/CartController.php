<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => 1,
                'image' => $request->image,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }


    public function remove($productId)
    {
        $cart = Session::get('cart', []);

        // Remove the product from the cart if it exists
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }
    public function update(Request $request, $id)
    {
        // Lấy số lượng từ yêu cầu
        $quantity = $request->input('quantity');

        if ($quantity < 1) {
            return response()->json(['success' => false, 'message' => 'Quantity must be at least 1']);
        }

        // Giả sử bạn đang sử dụng session để lưu giỏ hàng
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['success' => false, 'message' => 'Product not found in cart']);
        }

        // Cập nhật số lượng
        $cart[$id]['quantity'] = $quantity;

        // Cập nhật giá tổng của sản phẩm
        $cart[$id]['total_price'] = $cart[$id]['price'] * $quantity;

        // Cập nhật giỏ hàng trong session
        session()->put('cart', $cart);

        // Tính toán tổng số lượng và tổng giá trị của giỏ hàng
        $totalQuantity = array_sum(array_column($cart, 'quantity'));
        $totalPrice = array_sum(array_column($cart, 'total_price'));

        return response()->json([
            'success' => true,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
        ]);
    }
}
