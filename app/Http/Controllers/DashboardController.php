<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Blueprint;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch products and blueprints
        $products = Product::with('category', 'brand')->get();
        $blueprints = Blueprint::with('categoryDesign')->get();
        $categories = Category::all(); // If needed for filtering or dropdowns

        return view('dashboard', compact('products', 'blueprints', 'categories'));
    }
}
