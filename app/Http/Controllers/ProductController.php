<?php

namespace App\Http\Controllers;

use App\Models\Product;  // Import the Product model
use App\Models\Category; // Import the Category model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all(); // Fetch categories to use in the form
        return view('index', compact('products', 'categories'));
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
}
