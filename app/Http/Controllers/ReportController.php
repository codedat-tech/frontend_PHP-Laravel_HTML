<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Consultation;
use App\Models\Customer;
use App\Models\Designer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // lấy count
    private function getStatistics()
    {
        return [
            'productCount' => Product::count(),
            'orderCount' => Order::count(),
            'userCount' => Customer::count(),
            'consultationCount' => Consultation::count(),
        ];
    }
    // Product report
    public function index()
    {
        $totalCounts = $this->getStatistics();

        $categories = Category::withCount('products')->get();

        $categoryNames = $categories->pluck('name');
        $productCounts = $categories->pluck('products_count');
        return view('admin.report.product-dashboard', array_merge($totalCounts, compact('categories', 'categoryNames', 'productCounts')));
    }

    // Order report
    public function order(Request $request)
    {
        $totalCounts = $this->getStatistics();

        $year = $request->query('year');

        // Truy vấn dữ liệu đơn hàng theo năm
        $orders = Order::selectRaw('DATE_FORMAT(orderDate, "%Y-%m") as month, COUNT(*) as count')
            ->when($year, function ($query, $year) {
                return $query->whereYear('orderDate', $year);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $orderMonths = $orders->pluck('month'); // Tháng
        $orderCounts = $orders->pluck('count'); // Số lượng đơn hàng

        // AJAX thì trả về dữ liệu JSON
        if ($request->ajax()) {
            return response()->json([
                'orderMonths' => $orderMonths,
                'orderCounts' => $orderCounts,
            ]);
        }
        return view('admin.report.order-dashboard', array_merge($totalCounts, compact('orderMonths', 'orderCounts')));
    }

    // customer and déigner chart
    public function customerDesignerChart(Request $request)
    {
        $totalCounts = $this->getStatistics();
        $year = $request->query('year');

        // Khách hàng theo năm đã chọn
        $customers = Customer::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->when($year, function ($query, $year) {
                return $query->whereYear('created_at', $year);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $customerMonths = $customers->pluck('month');
        $customerCounts = $customers->pluck('count');

        // Designer theo năm đã chọn
        $designers = Designer::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->when($year, function ($query, $year) {
                return $query->whereYear('created_at', $year);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $designerMonths = $designers->pluck('month');
        $designerCounts = $designers->pluck('count');

        // Kiểm tra nếu là AJAX thì trả về dữ liệu JSON
        if ($request->ajax()) {
            return response()->json([
                'customerMonths' => $customerMonths,
                'customerCounts' => $customerCounts,
                'designerMonths' => $designerMonths,
                'designerCounts' => $designerCounts,
            ]);
        }

        // Nếu không phải AJAX, trả về view bình thường
        return view('admin.report.custDesigner-dashboard', array_merge($totalCounts, compact('customerMonths', 'customerCounts', 'designerMonths', 'designerCounts')));
    }


    public function consultationsChart(Request $request)
    {
        $totalCounts = $this->getStatistics();

        $year = $request->query('year');

        // Truy vấn dữ liệu consultations theo năm
        $consultationsByMonth = Consultation::selectRaw('DATE_FORMAT(scheduledAT, "%Y-%m") as month, COUNT(*) as count')
            ->when($year, function ($query, $year) {
                return $query->whereYear('scheduledAT', $year);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $consultationMonths = $consultationsByMonth->pluck('month');
        $consultationCounts = $consultationsByMonth->pluck('count');

        // AJAX thì trả về dữ liệu JSON
        if ($request->ajax()) {
            return response()->json([
                'consultationMonths' => $consultationMonths,
                'consultationCounts' => $consultationCounts,
            ]);
        }

        return view('admin.report.consultation-dashboard', array_merge($totalCounts, compact('consultationMonths', 'consultationCounts')));
    }
}
