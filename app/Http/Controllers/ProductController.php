<?php

namespace App\Http\Controllers;

use App\Models\Product;  // Import the Product model
use App\Models\Category; // Import the Category model
use App\Models\Admin;    // Import the Admin model for user verification
use Illuminate\Http\Request;
use PDF;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Check if username is passed via session or request
        $username = session('username') ?? $request->input('username');

        // If no username is provided, redirect back to admin login
        if (!$username) {
            return redirect()->route('admin.login')->with('error', 'Please log in to continue.');
        }

        // Validate the username against the admins table
        $admin = Admin::where('username', $username)->first();

        // If the admin is not found, redirect back to admin login
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Invalid credentials. Please log in again.');
        }

        // If the username is valid, fetch products and categories
        $products = Product::all();
        $categories = Category::all(); 

        // Pass the data along with the username to the view
        return view('index', compact('products', 'categories', 'username'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_name' => 'required|string|max:255', // Validate category name
        ]);
    
        // Create a new product with the selected category
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_name' => $request->category_name, // Save selected category
        ]);
    
        return redirect()->back()->with('success', 'Product added successfully!');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_name' => 'required|string|max:255', // Validate category
        ]);
    
        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_name' => $request->category_name, // Update the category
        ]);
    
        return redirect()->route('index')->with('success', 'Product updated successfully!');
    }
    

    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('index')->with('success', 'Product deleted successfully!');

    }


    public function downloadPDF()
    {
        // Fetch all products
        $products = Product::all();

        // Load the view and pass the products data to it
        $pdf = PDF::loadView('products_pdf', compact('products'));

        // Download the PDF file
        return $pdf->download('products_data.pdf');
    }
}
