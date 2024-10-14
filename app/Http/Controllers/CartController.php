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

    if(isset($cart[$productId])) {
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
}
