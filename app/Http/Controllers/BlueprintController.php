<?php

namespace App\Http\Controllers;

use App\Models\Blueprint;
use App\Models\CategoryDesign;
use App\Models\Designer;
use Illuminate\Http\Request;

class BlueprintController extends Controller
{
    public function index(Request $request)
    {
        $paginateInput = $request->input('paginate', 5);
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'name');
        $sort = $request->input('sort', 'asc');

        //for view
        $categoryDesigns = CategoryDesign::all();
        $designers = Designer::all();

        // Query tìm kiếm và sắp xếp
        $blueprints = Blueprint::with('categoryDesign', 'designer')
            ->join('designers', 'blueprints.designerID', '=', 'designers.designerID')
            ->join('category_designs', 'blueprints.categoryDesignID', '=', 'category_designs.categoryDesignID')
            ->select('blueprints.*', 'designers.fullname as designer_name', 'category_designs.name as category_name')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('blueprints.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('designers.fullname', 'LIKE', '%' . $search . '%')
                        ->orWhere('category_designs.name', 'LIKE', '%' . $search . '%');
                });
            })
            // Xử lý sắp xếp
            ->orderBy(
                $sortBy === 'designer' ? 'designer_name' : ($sortBy === 'category' ? 'category_name' : 'blueprints.' . $sortBy),
                $sort
            )
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);

        $noResults = $blueprints->isEmpty();

        return view('admin.blueprints.view', [
            'blueprints' => $blueprints,
            'categoryDesigns' => $categoryDesigns,
            'designers' => $designers,
            'noResults' => $noResults,
        ]);
    }

    // Create
    public function create()
    {
        $blueprints = Blueprint::all(); // Fetch all
        $categoryDesigns = CategoryDesign::all(); // Fetch all
        $designers = Designer::all();
        return view('admin.blueprints.create', compact('blueprints', 'categoryDesigns', 'designers'));
    }

    // Store a new
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categoryDesignID' => 'required|exists:category_designs,categoryDesignID',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('./Asset/Image/blueprint/'), $imageName);
        }

        Blueprint::create([
            'name' => $request->name,
            'designerID' => $request->designerID,
            'categoryDesignID' => $request->categoryDesignID,
            'image' => $imageName,
            'status' => $request->status ?? 'Active',
        ]);
        // dd($request->all());
        return redirect()->back()->with('success', 'Blueprint added successfully!');
    }

    // Store a new design category
    public function storeCategoryDesign(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        CategoryDesign::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Design category created successfully!');
    }

    public function edit($blueprintID)
    {
        $blueprint = Blueprint::with('categoryDesign', 'designer')->findOrFail($blueprintID);
        $categoryDesigns = CategoryDesign::all();
        $designers = Designer::all();
        // return view('admin.products.update', compact('blueprint', 'categoryDesigns', 'designers'));
        return response()->json($blueprint, compact('designers', 'categoryDesigns'));
    }
    // Update an existing blueprint
    public function update(Request $request, $blueprintID)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designerID' => 'required|exists:designers,designerID',
            'categoryDesignID' => 'required|exists:category_designs,categoryDesignID',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blueprint = Blueprint::where('blueprintID', $blueprintID)->firstOrFail();
        $blueprint->name = $request->name;
        // $blueprint->designerID = $request->fullname;
        $blueprint->designerID = $request->designerID;

        $blueprint->categoryDesignID = $request->categoryDesignID;

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($blueprint->image && file_exists(public_path('img/' . $blueprint->image))) {
                unlink(public_path('img/' . $blueprint->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('img'), $imageName);
            $blueprint->image = $imageName;
        }
        $blueprint->status = $request->status ?? 'Active';

        $blueprint->save();

        return redirect()->back()->with('success', 'Blueprint updated successfully!');
    }


    // Disable a blueprint
    public function toggleStatus($blueprintID)
    {
        $blueprint = Blueprint::find($blueprintID);

        if ($blueprint) {
            // Thay đổi trạng thái của sản phẩm
            $blueprint->status = !$blueprint->status;
            $blueprint->save();

            $status = $blueprint->status ? 'enabled' : 'disabled';
            return redirect()->back()->with('success', "Blueprint has been {$status}");
        }

        return redirect()->back()->with('error', 'Blueprint not found');
    }
    // function show
    public function show()
    {
        $blueprints = Blueprint::with('categoryDesign', 'designer')->get();
        return view('blueprint', compact('blueprints'));
    }

    public function checkName(Request $request)
    {
        $exists = Blueprint::where('name', $request->name)->exists();
        return response()->json(['exists' => $exists]);
    }
    // public function checkName(Request $request)
    // {
    //     $name = $request->input('name');
    //     $blueprintID = $request->input('blueprintID'); // Nếu cần kiểm tra không trùng với bản ghi hiện tại

    //     // Kiểm tra tên blueprint có bị trùng không
    //     $exists = Blueprint::where('name', $name)
    //         ->where('blueprintID', '!=', $blueprintID) // Nếu là chỉnh sửa, không kiểm tra tên của chính nó
    //         ->exists();

    //     return response()->json(['exists' => $exists]);
    // }
}
