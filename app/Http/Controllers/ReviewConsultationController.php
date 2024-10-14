<?php

namespace App\Http\Controllers;

use App\Models\ReviewConsultation; // Ensure this model exists
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewConsultationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reviewConsultationID' => 'required|string', // Validate the reviewConsultationID if it’s passed
            'consultationID' => 'required|integer', // This should be the FK
            'rating' => 'required|numeric|min:0|max:5',
            'comment' => 'required|string|max:255',
        ]);

        // Create a new review consultation entry
        ReviewConsultation::create([
            'reviewConsultationID' => $request->reviewConsultationID, // Use the ID from the request
            'consultationID' => $request->consultationID,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'createdAT' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Review submitted successfully!']);
    }
}
