<?php

namespace App\Http\Controllers;

use App\Models\Blueprint;
use App\Models\CategoryDesign;
use Illuminate\Http\Request;

class BlueprintController extends Controller
{
    // Display the list of blueprints
    public function index()
    {
        $blueprints = Blueprint::with('categoryDesign')->get();
        $categories = CategoryDesign::all();
        return view('admin.blueprints.view', compact('blueprints', 'categories'));
    }

    // Create a new blueprint form
    public function create()
    {
        $blueprints = Blueprint::all(); // Fetch all blueprints
        $categories = CategoryDesign::all(); // Fetch all categories
        return view('admin.blueprints.create', compact('blueprints', 'categories')); // Pass both variables to the view
    }

    // Store a new blueprint
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'categoryDesignID' => 'required|exists:category_designs,categoryDesignID',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
        }

        Blueprint::create([
            'name' => $request->name,
            'description' => $request->description,
            'categoryDesignID' => $request->categoryDesignID,
            'image' => $imageName,
        ]);

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

    // Show the edit form (for modal)
    public function edit($blueprintID)
    {
        $blueprint = Blueprint::with('categoryDesign')->findOrFail($blueprintID);

        return response()->json([
            'blueprintID' => $blueprint->blueprintID,
            'name' => $blueprint->name,
            'description' => $blueprint->description,
            'categoryDesignID' => $blueprint->categoryDesignID,
        ]);
    }

    // Update an existing blueprint
    public function update(Request $request, $blueprintID)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categoryDesignID' => 'required|exists:category_designs,categoryDesignID',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blueprint = Blueprint::where('blueprintID', $blueprintID)->firstOrFail();
        $blueprint->name = $request->name;
        $blueprint->description = $request->description;
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

        $blueprint->save();

        return redirect()->back()->with('success', 'Blueprint updated successfully!');
    }

    // Delete a blueprint
    public function destroy($blueprintID)
    {
        $blueprint = Blueprint::findOrFail($blueprintID);
        if ($blueprint->image && file_exists(public_path('img/' . $blueprint->image))) {
            unlink(public_path('img/' . $blueprint->image));
        }
        $blueprint->delete();
        return redirect()->back()->with('success', 'Blueprint deleted successfully!');
    }
}
