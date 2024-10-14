<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Consultation;
use App\Models\Customer;
use App\Models\Designer;
use App\Models\Order;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class ReportController extends Controller
{
    // Product report
    public function index()
    {
        $categories = Category::withCount('products')->get();

        $categoryNames = $categories->pluck('name');
        $productCounts = $categories->pluck('products_count');

        return view('admin.report.product-dashboard', compact('categories', 'categoryNames', 'productCounts'));
    }

    // Order report
    public function order()
    {
        $orders = Order::selectRaw('DATE_FORMAT(orderDate, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $orderMonths = $orders->pluck('month');
        $orderCounts = $orders->pluck('count');
        return view('admin.report.order-dashboard', compact('orderMonths', 'orderCounts'));
    }

    // customer and déigner chart
    public function customerDesignerChart()
    {
        $customers = Customer::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
        // month
        $designers = Designer::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
        // create array
        $months = [];
        $customerCounts = [];
        $designerCounts = [];

        $allMonths = $customers->keys()->merge($designers->keys())->unique()->sort();

        foreach ($allMonths as $month) {
            $months[] = $month;
            $customerCounts[] = $customers->get($month)->count ?? 0;
            $designerCounts[] = $designers->get($month)->count ?? 0;
        }

        return view('admin.report.custDesigner-dashboard', compact('months', 'customerCounts', 'designerCounts'));
    }
    public function consultationsChart()
    {
        $consultationsByMonth = Consultation::selectRaw('DATE_FORMAT(scheduledAT, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
        $months = $consultationsByMonth->pluck('month');

        $consultationCountsByMonth = $consultationsByMonth->pluck('count');

        // Trả dữ liệu về view
        return view('admin.report.consultation-dashboard', compact('months', 'consultationCountsByMonth'));
    }
}
