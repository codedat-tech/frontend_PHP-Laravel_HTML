<?php

namespace App\Http\Controllers;

use App\Models\Admin;  // Import the Admin model for user verification
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Check if username is passed via session or request
        $username = session('username') ?? $request->input('username');

        // If no username provided, redirect to admin login
        if (!$username) {
            return redirect()->route('admin.login')->with('error', 'Please log in to continue.');
        }

        // Validate the username against the admins table
        $admin = Admin::where('username', $username)->first();

        // If the admin is not found, redirect back to admin login
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Invalid credentials. Please log in again.');
        }

        // If the username is valid, fetch the categories
        $categories = Category::all();

        // Pass the categories and username to the view
        return view('categories', compact('categories', 'username'));
    }

    public function create(Request $request)
    {
        // Check for username and validate as done in the index function
        $username = session('username') ?? $request->input('username');
        
        if (!$username || !Admin::where('username', $username)->exists()) {
            return redirect()->route('admin.login')->with('error', 'Invalid credentials. Please log in again.');
        }

        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
                        ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category, Request $request)
    {
        // Check for username and validate
        $username = session('username') ?? $request->input('username');
        
        if (!$username || !Admin::where('username', $username)->exists()) {
            return redirect()->route('admin.login')->with('error', 'Invalid credentials. Please log in again.');
        }

        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
                        ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category, Request $request)
    {
        // Check for username and validate
        $username = session('username') ?? $request->input('username');
        
        if (!$username || !Admin::where('username', $username)->exists()) {
            return redirect()->route('admin.login')->with('error', 'Invalid credentials. Please log in again.');
        }

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }
}

