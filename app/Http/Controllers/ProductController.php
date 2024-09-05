<?php

namespace App\Http\Controllers;

use App\Models\Product;  // Import the Product model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();
        
        // Pass the products to the view
        return view('index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('index')->with('success', 'Product added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product = Product::find($id);
        $product->update($request->all());

        return redirect()->route('index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('index')->with('success', 'Product deleted successfully!');
    }
}
