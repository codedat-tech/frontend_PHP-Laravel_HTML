<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\PostTooLargeException;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        // request
        $paginateInput = $request->input('paginate', 5);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'name');

        // query
        $brands = Brand::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', '%' . $search . '%');
        })
            ->orderBy($sortBy === 'status' ? 'status' : 'name', $sort)
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);
        $noResults = $brands->isEmpty();
        return view('admin.brands.brands', compact('brands', 'noResults'));
    }

    // Store a new brand
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->status = $request->status;

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('./Asset/Image/brand/', $fileName);
            $brand->image = $fileName;
        }

        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    // Edit an existing brand
    public function edit($brandID)
    {
        $brand = Brand::findOrFail($brandID);
        return response()->json([
            'brandID' => $brand->brandID,
            'name' => $brand->name,
            'image' => $brand->image,
            'description' => $brand->description,
            'status' => $brand->status,
        ]);
    }
    public function update(Request $request, $brandID)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $brand = Brand::findOrFail($brandID);
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->status = $request->status;
        if ($request->hasFile('image')) {
            // delete old img
            if ($brand->image && file_exists(public_path('Asset/Image/brand/' . $brand->image))) {
                unlink(public_path('Asset/Image/brand/' . $brand->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Asset/Image/brand/'), $fileName);
            $brand->image = $fileName;
        }

        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }
    // díable a brand
    public function toggleStatus($brandID)
    {
        $brand = Brand::find($brandID);

        if ($brand) {
            // Thay đổi trạng thái của sản phẩm
            $brand->status = !$brand->status;
            $brand->save();

            $status = $brand->status ? 'enabled' : 'disabled';
            return redirect()->back()->with('success', "Brand has been {$status}");
        }
        return redirect()->back()->with('error', 'Brand not found');
    }

    // check duplicate name
    public function checkBrandName(Request $request)
    {
        $name = $request->input('name');

        $exists = Brand::where('name', $name)->exists();

        return response()->json(['isAvailable' => !$exists]);
    }
}
