<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::all();
        return view('admin.consultations.consultations', compact('consultations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'designerID' => 'required|exists:designers,designerID',
            'customerID' => 'required|exists:customers,customerID',
            'scheduledAT' => 'required|date',
            'status' => 'required|string',
            'note' => 'nullable|string|max:255',
        ]);

        Consultation::create($request->all());
        return redirect()->route('consultations.index')->with('success', 'Consultation created successfully.');
    }

    public function update(Request $request, $consultationID)
    {
        $request->validate([
            'designerID' => 'required|exists:designers,designerID',
            'customerID' => 'required|exists:customers,customerID',
            'scheduledAT' => 'required|date',
            'status' => 'required|string',
            'note' => 'nullable|string|max:255',
        ]);

        $consultation = Consultation::findOrFail($consultationID);
        $consultation->update($request->all());

        return redirect()->route('consultations.index')->with('success', 'Consultation updated successfully!');
    }

    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();

        return redirect()->route('consultations.index')->with('success', 'Consultation deleted successfully.');
    }
}
