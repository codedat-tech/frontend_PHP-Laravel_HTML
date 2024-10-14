<?php

namespace App\Http\Controllers;

use App\Mail\BookingNotification;
use App\Models\Designer;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DesignerBookingController extends Controller
{
    // Hiển thị danh sách các designer
    public function index()
    {
        $designers = Designer::all(); // Lấy tất cả các designer từ cơ sở dữ liệu
        return view('customer.designer_booking', compact('designers')); // Trả về view danh sách designer
    }

    public function showBookingForm($id)
    {
        // Lấy thông tin designer theo ID
        $designer = Designer::findOrFail($id);

        // Trả về view với thông tin designer
        return view('customer.booking_form', compact('designer'));
    }




    // Xử lý đặt lịch từ người dùng
    public function store(Request $request)
{
    // Check if the user is authenticated
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to book a consultation.');
    }

    // Validate the request
    $validatedData = $request->validate([
        'designer_id' => 'required|exists:designers,designerID',
        'date' => 'required|date',
        'time' => 'required',
        'content' => 'nullable|string',
    ]);

    // Lấy ID của user hiện tại
    $userId = auth()->id();

    // Tạo chuỗi `schedule_at` từ ngày và giờ
    $scheduleAt = $validatedData['date'] . ' ' . $validatedData['time'];

    // Tạo bản ghi cuộc hẹn trong bảng `Consultation`
    $booking = Consultation::create([
        'user_id' => $userId,
        'designerID' => $validatedData['designer_id'],
        'schedule_at' => $scheduleAt,
        'note' => $validatedData['content'],
        'status' => 'pending',
    ]);

    // Send email notification
    Mail::to(auth()->user()->email)->send(new BookingNotification($booking));

    return redirect()->route('home')->with('success', 'Booking successful');
}




    // Hiển thị lịch sử đặt lịch của user
    public function bookingHistory()
    {
        $userId = auth()->id(); // Lấy ID của user hiện tại

        // Lấy danh sách các cuộc hẹn kèm thông tin designer cho user hiện tại
        $bookings = Consultation::where('user_id', $userId)
                                ->with('designer') // Gắn kèm dữ liệu của designer
                                ->get();

        // Trả về view hiển thị lịch sử đặt lịch
        return view('customer.booking_history', compact('bookings'));
    }

    // Hiển thị chi tiết cuộc hẹn
    public function show($id)
    {
        // Tìm cuộc hẹn theo ID kèm thông tin designer
        $booking = Consultation::with('designer')->findOrFail($id);

        // Trả về view hiển thị chi tiết cuộc hẹn
        return view('customer.booking_details', compact('booking'));
    }




    public function cancel($id)
    {
        $booking = Consultation::findOrFail($id);

        // Đảm bảo cuộc hẹn thuộc về người dùng hiện tại và đang chờ xử lý
        if ($booking->user_id === auth()->id() && $booking->status === 'pending') {
            $booking->status = 'canceled'; // Cập nhật trạng thái thành "canceled"
            $booking->save(); // Lưu thay đổi

            // Gửi email thông báo đến người dùng
            Mail::to(auth()->user()->email)->send(new BookingNotification($booking));

            return redirect()->route('user.booking_history')->with('success', 'Booking canceled successfully.');
        }

        return redirect()->route('user.booking_history')->with('error', 'Unable to cancel the booking.');
    }




}
