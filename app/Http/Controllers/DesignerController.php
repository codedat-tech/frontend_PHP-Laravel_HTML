<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Design;
use App\Models\Designer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DesignerController extends Controller
{
    public function index(Request $request)
    {
        $paginateInput = $request->input('paginate', 5);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'name');
        $designers = Designer::all();
        // Query for searching
        $designers = Designer::when($search, function ($query, $search) {
            return $query->where('fullname', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%')
                ->orWhere('experienceYear', 'LIKE', '%' . $search . '%')
                ->orWhere('specialization', 'LIKE', '%' . $search . '%')
                ->orWhere('rating', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('fullname', $sort)
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);

        $noResults = $designers->isEmpty();

        return view('admin.designers.designers', compact('designers', 'noResults'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:designers,email',
            'password' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string|max:255',
            'portfolio' => 'nullable|file|mimes:pdf|max:2048',
            'experienceYear' => 'required|integer',
            'specialization' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        try {
            $designer = new Designer();
            $designer->fullname = $request->fullname;
            $designer->email = $request->email;
            $designer->password = Hash::make($request->password);
            $designer->phone = $request->phone;
            $designer->address = $request->address;
            $designer->experienceYear = $request->experienceYear;
            $designer->specialization = $request->specialization;
            $designer->rating = $request->rating;
            $designer->status = $request->status;

            // Handle PDF upload for portfolio
            if ($request->hasFile('portfolio')) {
                $portfolioFile = $request->file('portfolio');
                $portfolioFileName = time() . '_' . $portfolioFile->getClientOriginalName();
                $portfolioFile->move(public_path('Asset/PDF/portfolio'), $portfolioFileName);
                $designer->portfolio = $portfolioFileName;
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('Asset/Image/designer'), $fileName);
                $designer->image = $fileName;
            }

            $designer->save();
            return redirect()->back()->with('success', 'Designer added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to add designer: ' . $e->getMessage());
            return redirect()->back()->with('error', "Failed to add product: {$e->getMessage()}. Please try again.");
        }
    }

    public function edit($designerID)
    {
        $designer = Designer::findOrFail($designerID);
        return response()->json($designer);
        // return view('designers.edit', compact('designer'));
    }


    // Update designer details
    public function update(Request $request, $designerID)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string',
            'address' => 'required|string|max:255',
            'portfolio' => 'required|file|mimes:pdf|max:2048',
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
        $designer->experienceYear = $request->experienceYear;
        $designer->specialization = $request->specialization;
        $designer->rating = $request->rating;
        $designer->status = $request->status;

        // Handle PDF upload for portfolio
        if ($request->hasFile('portfolio')) {
            $portfolioFile = $request->file('portfolio');
            $portfolioFileName = time() . '_' . $portfolioFile->getClientOriginalName();
            $portfolioFile->move(public_path('Asset/PDF/portfolio'), $portfolioFileName);
            $designer->portfolio = $portfolioFileName; // Save file name in DB
        }
        //lây password old
        if ($request->filled('password')) {
            $designer->password = Hash::make($request->password); // mã hóa
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());
            $file->move('Asset/Image/designer', $fileName);
            $designer->image = $fileName;
        }
        $designer->save();

        return redirect()->route('index')->with('success', 'Designer updated successfully.');
    }

    // disable
    public function toggleStatus($designerID)
    {
        $designer = Designer::find($designerID);
        if ($designer) {
            $designer->status = !$designer->status;
            $designer->save();
            $status = $designer->status ? 'enabled' : 'disabled';
            return redirect()->back()->with('success', "designer has been {$status}");
        }
        return redirect()->back()->with('error', 'designer not found');
    }
    public function showDesigners()
    {
        $designers = Designer::all();
        return view('designer.designer', compact('designers'));
    }
    public function showIndex()
    {
        $designers = Designer::all();
        $brands = Brand::all();
        return view('index', compact('designers', 'brands'));
    }
    public function showProfile($id)
    {
        // $designer = Auth::user();
        $designer = Designer::findOrFail($id);
        Log::info('11111 file User  Email: ' . $designer);
        return view('admin.designers.profile', compact('designer'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'portfolio' => 'nullable|string|max:255',
            'experienceYear' => 'nullable|integer',
            'specialization' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $designer = Auth::user();
        $designer->fullname = $request->fullname;
        $designer->email = $request->email;
        $designer->phone = $request->phone;
        $designer->address = $request->address;
        $designer->portfolio = $request->portfolio;
        $designer->experienceYear = $request->experienceYear;
        $designer->specialization = $request->specialization;

        if ($request->hasFile('image')) {
            // Xử lý upload hình ảnh
            $imagePath = $request->file('image')->store('designers', 'public');
            $designer->image = $imagePath;
        }

        if ($request->password) {
            $designer->password = Hash::make($request->password);
        }

        // $designer->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
