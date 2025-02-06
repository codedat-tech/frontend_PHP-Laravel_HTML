<?php

namespace App\Http\Controllers;

use App\Mail\ConsultationNotificationMail;
use App\Models\Consultation;
use App\Models\Customer;
use App\Models\Designer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsultationReminderMail;
use App\Mail\ConsultationScheduled;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Psy\Readline\Hoa\Console;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $paginateInput = $request->input('paginate', 5);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'scheduledAT');

        $consultations = Consultation::with(['customer', 'designer'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('customer', function ($query) use ($search) {
                    $query->where('fullname', 'LIKE', '%' . $search . '%');
                })
                    ->orWhereHas('designer', function ($query) use ($search) {
                        $query->where('fullname', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhere('scheduledAT', 'LIKE', '%' . $search . '%')
                    ->orWhere('status1', 'LIKE', '%' . $search . '%')
                    ->orWhere('note', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sort)
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);

        $noResults = $consultations->isEmpty();
        $designers = Designer::all();
        $customers = Customer::all();
        return view('admin.consultations.consultations', compact('consultations', 'noResults', 'designers', 'customers'));
    }

    public function store(Request $request)
    {
        Log::info('Request data:', $request->all());

        try {
            $data = $request->validate([
                'designerID' => 'required|exists:designers,designerID',
                'customerID' => 'required|exists:customers,customerID',
                'scheduledAT' => 'required|date',
                'note' => 'required|string',
                'status' => 'nullable|boolean',
                'status1' => 'nullable|string',
            ]);

            $badWords = file(storage_path('app/bad_words.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            // kiểm tra từ ngữ không phù hợp
            foreach ($badWords as $word) {
                if (stripos($data['note'], $word) !== false) {
                    return response()->json(['error' => 'Your note contains inappropriate language: ' . $word], 400);
                }
            }

            $consultation = Consultation::create($data);

            return response()->json(['message' => 'Schedule added successfully!'], 200);
        } catch (\Exception $e) {
            Log::error('Error creating consultation: ' . $e->getMessage());
            return response()->json(['error' => 'There was an error creating the schedule.'], 500);
        }
    }
    public function checkScheduleConflict(Request $request)
    {
        $request->validate([
            'designerID' => 'required|exists:designers,designerID',
            'scheduledAT' => 'required|date',
        ]);

        $scheduledDate = \Carbon\Carbon::parse($request->scheduledAT)->format('Y-m-d');

        // check
        $conflict = Consultation::where('designerID', $request->designerID)
            ->whereDate('scheduledAT', $scheduledDate) // duplicate date
            ->exists();

        return response()->json(['conflict' => $conflict]);
    }


    public function toggleStatus($consultationID)
    {
        $consultation = Consultation::find($consultationID);

        if ($consultation) {
            $consultation->status = !$consultation->status;
            $consultation->save();

            $status = $consultation->status ? 'enabled' : 'disabled';
            return redirect()->back()->with('success', "Consultation has been {$status}");
        }

        return redirect()->back()->with('error', 'Consultation not found');
    }
    public function sendMail($consultationID)
    {
        $consultation = Consultation::with(['customer', 'designer'])->findOrFail($consultationID);

        try {
            Mail::to($consultation->customer->email)
                ->cc($consultation->designer->email)
                ->bcc('congtu7677@gmail.com')
                ->send(new ConsultationScheduled($consultation));
            Log::info('Sending email to: ' . $consultation->customer->email);
            Log::info('CC email: ' . $consultation->designer->email);
            $consultation->update(['alert_sent' => 'sent']);

            return back()->with('success', 'Email sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function showSchedule(Request $request)
    {
        $customerID = $request->query('customerID') ?? Auth::id();
        $designerID = $request->query('designerID');

        if (!$customerID) {
            return response()->json(['error' => 'Customer is not logged in'], 401);
        }

        try {
            // Log
            Log::info("Get customer's appointment", [
                'customerID' => $customerID,
                'designerID' => $designerID
            ]);

            // Lấy lịch hẹn của designer và customer
            $consultations = Consultation::with('designer')
                ->where('customerID', $customerID)
                ->when($designerID, function ($query, $designerID) {
                    return $query->where('designerID', $designerID);
                })
                ->orderBy('scheduledAT', 'asc')
                ->get();

            if ($consultations->isEmpty()) {
                return response()->json(['message' => 'No consultations found for this designer.'], 200);
            }

            Log::info("Query result", ['consultations' => $consultations]);

            return response()->json($consultations);
        } catch (\Exception $e) {
            Log::error('Error while getting customer appointment:', [
                'error' => $e->getMessage(),
                'customerID' => $customerID,
                'designerID' => $designerID
            ]);

            return response()->json(['error' => 'Error while getting appointment'], 500);
        }
    }

    // function edit -> not use
    public function edit($consultationID)
    {
        $consultation = Consultation::with('designer', 'customer')->findOrFail($consultationID);
        $designers = Designer::all();
        $customers = Customer::all();

        return response()->json(['consultation' => $consultation, 'designers' => $designers, 'customers' => $customers]);
    }
    // not use
    public function update(Request $request, $consultationID)
    {
        $request->validate([
            'designerID' => 'required|exists:designers,designerID',
            'customerID' => 'required|exists:customers,customerID',
            'scheduledAT' => 'required|date',
            'status' => 'required|string',
            'note' => 'nullable|string|max:255',
        ]);

        $consultation = Consultation::where('consultationID', $consultationID)->firstOrFail();
        $consultation->scheduledAT = $request->scheduledAT;
        $consultation->designerID = $request->designerID;
        $consultation->customerID = $request->customerID;
        $consultation->save();

        return redirect()->route('consultation.index')->with('success', 'Consultation updated successfully!');
    }

    // group add schedule function

    public function checkSchedule(Request $request)
    {
        $request->validate([
            'designerID' => 'required|exists:designers,designerID',
            'scheduledDateTime.date' => 'required|date',
            'scheduledDateTime.time' => 'required|date_format:H:i',
        ]);

        $designerID = $request->designerID;
        $scheduleDate = $request->scheduledDateTime['date'];
        $scheduleTime = $request->scheduledDateTime['time'];

        $scheduledAT = Carbon::createFromFormat('Y-m-d H:i', "$scheduleDate $scheduleTime");

        // Kiểm tra lịch hẹn trùng giờ
        $conflict = Consultation::where('designerID', $designerID)
            ->whereDate('scheduledAT', $scheduleDate)
            ->whereTime('scheduledAT', $scheduleTime)
            ->exists();

        if ($conflict) {
            return response()->json(['error' => 'Designer is already booked at this time.'], 409);
        }

        return response()->json(['success' => 'Time slot is available.'], 200);
    }
}
