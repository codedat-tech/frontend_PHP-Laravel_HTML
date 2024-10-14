<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class DesignerController extends Controller
{
    // Display list of designers and handle designer creation
    public function index()
    {
        $designers = Designer::all();
        return view('admin.designers.designers', compact('designers'));  // Refers to resources/views/designers.blade.php
    }

    // Store a new designer
   // Store a new designer
   public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:designers,email',
            'password' => 'required|string',
            'phone' => 'required|integer',
            'address' => 'required|string|max:255',
            'portfolio' => 'required|string|max:255',
            'experienceYear' => 'required|integer',
            'specialization' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('Asset/Image/designer', 'public') : null;

        Designer::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'portfolio' => $request->portfolio,
            'experienceYear' => $request->experienceYear,
            'specialization' => $request->specialization,
            'rating' => $request->rating,
            'image' => $imagePath,
        ]);

        return redirect()->route('designers.index')->with('success', 'Designer created successfully.');
    }


    // Show form for editing a designer in the same view
    public function edit($designerID)
{
    $designer = Designer::findOrFail($designerID);
    return response()->json($designer); // This should return the correct designer
}


    // Update designer details
    public function update(Request $request, $designerID)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|integer',
            'address' => 'required|string|max:255',
            'portfolio' => 'required|string|max:255',
            'experienceYear' => 'required|integer',
            'specialization' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $designer = Designer::findOrFail($designerID);
        $designer->fullname = $request->fullname;
        $designer->email = $request->email;
        $designer->phone = $request->phone;
        $designer->address = $request->address;
        $designer->portfolio = $request->portfolio;
        $designer->experienceYear = $request->experienceYear;
        $designer->specialization = $request->specialization;
        $designer->rating = $request->rating;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $ext= strtolower($file->getClientOriginalExtension());

                $file->move('Asset/Image/designer', $fileName);

                $designer->image = $fileName;

        }


        // if ($request->file('image')) {
        //     // Delete old image if it exists
        //     if ($designer->image) {
        //         Storage::delete('public/' . $designer->image);
        //     }
        //     // Store new image
        //     $designer->image = $request->file('image')->store('Asset/Image/designer', 'public');
        // }

        $designer->save();

        return redirect()->route('designers.index')->with('success', 'Designer updated successfully.');
    }



    // Delete a designer
    public function destroy($designerID)
    {
        $designer = Designer::findOrFail($designerID);
        if ($designer->image) {
            Storage::delete('public/' . $designer->image);
        }
        $designer->delete();

        return redirect()->route('designers.index')->with('success', 'Designer deleted successfully.');
    }
    public function showDesigners()
{
    $designers = Designer::all(); // Fetch all designers
    return view('designer', compact('designers')); // Pass the data to designer.blade.php
}

}
