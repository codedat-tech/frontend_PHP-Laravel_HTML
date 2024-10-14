<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category', 'brand')->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.view', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();

        return view('admin.products.create', compact('brands', 'categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'categoryID' => 'required|exists:categories,categoryID',
            'brandID' => 'required|exists:brands,brandID',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->categoryID = $request->categoryID;
        $product->brandID = $request->brandID;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Asset/Image/product'), $fileName);
            $product->image = $fileName;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');
    }


    public function edit($productID)
    {
        $product = Product::findOrFail($productID);
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.update', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $productID)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'categoryID' => 'required|exists:categories,categoryID',
            'brandID' => 'required|exists:brands,brandID',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($productID);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->categoryID = $request->categoryID;
        $product->brandID = $request->brandID;

        if ($request->hasFile('image')) {
            // Remove old image if it exists
            if ($product->image && file_exists(public_path('Asset/Image/product/' . $product->image))) {
                unlink(public_path('Asset/Image/product/' . $product->image));
            }

            // Upload new image
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Asset/Image/product'), $fileName);
            $product->image = $fileName;
        }

        $product->save();
        Log::info("Product updated: " . $product->name);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function destroy($productID)
    {
        $product = Product::findOrFail($productID);
        if ($product->image) {
            unlink(public_path('img/' . $product->image));
        }

        $product->delete();
        Log::info("Product deleted: " . $product->name);

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
    public function show()
    {
        $products = Product::with('category', 'brand')->get();
        return view('product', compact('products'));
    }

}
