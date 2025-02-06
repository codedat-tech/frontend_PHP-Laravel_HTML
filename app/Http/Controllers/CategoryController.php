<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $paginateInput = $request->input('paginate', 5);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'name');

        $categories = Category::when($search, function ($query, $search) {
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

        $noResults = $categories->isEmpty();
        return view('admin.categories.categories', compact('categories', 'noResults'));
    }


    public function create(Request $request)
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        // $category->description = $request->description;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json(
            [
                'categoryID' => $category->categoryID,
                'name' => $category->name,
                // 'description' => $category->description,
                'status' => $category->status,
            ]
        );
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        // $category->description = $request->description;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    // díable a category
    public function toggleStatus($categoryID)
    {
        $category = Category::find($categoryID);

        if ($category) {
            // Thay đổi trạng thái của sản phẩm
            $category->status = !$category->status;
            $category->save();

            $status = $category->status ? 'enabled' : 'disabled';
            return redirect()->back()->with('success', "Category has been {$status}");
        }

        return redirect()->back()->with('error', 'Category not found');
    }
    // check duplicate
    public function checkCategoryName(Request $request)
    {
        $name = $request->input('name');
        $exists = Category::where('name', $name)->exists();

        return response()->json(['isAvailable' => !$exists]);
    }
}
