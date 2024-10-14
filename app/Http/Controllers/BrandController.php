<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Display the brands management page
    public function index()
    {
        $brands = Brand::all(); // Retrieve all brands
        return view('admin.brands.brands', compact('brands')); // Return the brands view
    }

    // Store a new brand
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate image
        ]);

        $brand = new Brand();
        $brand->name = $request->name; // Set the brand name

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate a unique file name
            $file->move('img', $fileName); // Move image to the correct folder
            $brand->image = $fileName; // Set image name
        }

        $brand->save(); // Save brand to the database
        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    // Edit an existing brand
    public function edit($id)
    {
        $brand = Brand::findOrFail($id); // Use findOrFail to handle cases where the brand doesn't exist
        return response()->json($brand);
    }

    // Update an existing brand
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate image
        ]);

        $brand = Brand::findOrFail($id); // Find brand by ID
        $brand->name = $request->name; // Update name

        // Handle file upload if a new image is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate a unique file name
            $file->move('img', $fileName); // Move new image to the correct folder
            $brand->image = $fileName; // Set new image name
        }

        $brand->save(); // Save updated brand
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    // Delete a brand
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id); // Find brand or fail
        $brand->delete(); // Delete the brand
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
