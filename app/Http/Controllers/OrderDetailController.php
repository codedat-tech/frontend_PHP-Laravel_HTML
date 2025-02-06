<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    // public function index(Request $request)
    public function index(Request $request)
    {
        $orderDeatailId = $request->orderDeatailId;

        // $noResults = $orderDetails->isEmpty();
        return view('admin.orderDetails.orderDetails', compact('orderDetails', 'noResults'));
    }
}
