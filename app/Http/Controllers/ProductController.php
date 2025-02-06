<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // request
        $paginateInput = $request->input('paginate', 10);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'name');

        // Query search và sort
        $products = Product::with('category', 'brand')
            ->when($search, function ($query, $search) {
                return $query->where('products.name', 'LIKE', '%' . $search . '%');
            })
            ->join('brands', 'products.brandID', '=', 'brands.brandID')
            ->join('categories', 'products.categoryID', '=', 'categories.categoryID')
            ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name')

            ->orderBy(
                match ($sortBy) {
                    'brand' => 'brand_name',
                    'category' => 'category_name',
                    'price' => 'products.price',
                    'quantityInStock' => 'products.quantityInStock',
                    'inStocked' => 'products.inStocked',
                    default => 'products.name',
                },
                $sort
            )
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);

        $noResults = $products->isEmpty();

        // Cập nhật tồn kho dựa trên các đơn hàng đã giao
        foreach ($products as $product) {
            $totalQuantityToSubtract = 0;

            foreach ($product->orderDetails as $orderDetail) {
                if ($orderDetail->order->status1 === 'Deliveried' || $orderDetail->order->status1 === 'Shipping') {
                    // Tính tổng số lượng cần trừ
                    $totalQuantityToSubtract += $orderDetail->quantity;
                    $product->InStocked = $product->quantityInStock - $totalQuantityToSubtract;
                }
            }
            $product->save();
        }

        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.view', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'noResults' => $noResults,
        ]);
    }


    // 2. create
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
            'name' => [
                'required',
                'string',
                'min:5',
                'max:255',
                'unique:products,name' // Tên không được trùng
            ],
            'price' => 'required|numeric',
            'quantityInStock' => 'required|integer',
            'categoryID' => 'required|exists:categories,categoryID',
            'brandID' => 'required|exists:brands,brandID',
            'description' => 'required|string|max:255', // Không để trống
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantityInStock = $request->quantityInStock;
            $product->inStocked = $product->quantityInStock; // Khởi tạo InStocked từ quantityInStock
            $product->categoryID = $request->categoryID;
            $product->brandID = $request->brandID;
            $product->description = $request->description;
            $product->status = $request->status;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('Asset/Image/product'), $fileName);
                $product->image = $fileName;
            }

            $product->save();
            return redirect()->back()->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to add product: ' . $e->getMessage());
            return redirect()->back()->with('error', "Failed to add product: {$e->getMessage()}. Please try again.");
        }
    }

    // 3. Edit
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
            'quantityInStock' => 'required|integer',
            'inStocked' => 'nullable|integer',
            'categoryID' => 'required|exists:categories,categoryID',
            'brandID' => 'required|exists:brands,brandID',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:255',
        ]);
        try {
            $product = Product::findOrFail($productID);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantityInStock = $request->quantityInStock;
            $product->inStocked = $request->inStocked;
            $product->categoryID = $request->categoryID;
            $product->brandID = $request->brandID;
            $product->description = $request->description;
            $product->status = $request->status;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $file->move('Asset/Image/product', $fileName);
                $product->image = $fileName;
            }
            $product->save();
            Log::info("Product updated: " . $product->name);
            return redirect()->back()->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to add product: ' . $e->getMessage());
            return redirect()->back()->with('error', "Failed to add product: {$e->getMessage()}. Please try again.");
        }
    }
    // 4. Disable
    public function toggleStatus($productID)
    {
        $product = Product::find($productID);

        if ($product) {
            $product->status = !$product->status;
            $product->save();

            $status = $product->status ? 'enabled' : 'disabled';
            return redirect()->back()->with('success', "Product has been {$status}");
        }

        return redirect()->back()->with('error', 'Product not found');
    }
    public function show()
    {
        $products = Product::with('category', 'brand')->get();
        return view('product', compact('products'));
    }
    //  check duplicate name
    public function checkName(Request $request)
    {
        $exists = Product::where('name', $request->name)->exists();
        return response()->json(['exists' => $exists]);
    }
    //  check dupliacte image name
    public function checkImageName(Request $request)
    {
        $exists = Product::where('image', $request->imageName)->exists();
        return response()->json(['exists' => $exists]);
    }

    // search sort frontend
    public function showCategoryProducts(Request $request, $categoryID)
    {
        $paginateInput = $request->input('paginate', 10);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'name');

        $category = Category::findOrFail($categoryID);

        // product of categoryID
        $products = Product::with('category', 'brand')
            ->when($search, function ($query, $search) {
                return $query->where('products.name', 'LIKE', '%' . $search . '%');
            })
            ->join('brands', 'products.brandID', '=', 'brands.brandID')
            ->join('categories', 'products.categoryID', '=', 'categories.categoryID')
            ->where('products.categoryID', $categoryID) // Lọc theo categoryID
            ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name')
            ->orderBy(
                match ($sortBy) {
                    'brand' => 'brand_name',
                    'category' => 'category_name',
                    'price' => 'products.price',
                    'quantityInStock' => 'products.quantityInStock',
                    'inStocked' => 'products.inStocked',
                    default => 'products.name',
                },
                $sort
            )
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);

        $noResults = $products->isEmpty();

        return view('category.search', [
            'category' => $category,
            'products' => $products,
            'noResults' => $noResults,
        ]);
    }
}
