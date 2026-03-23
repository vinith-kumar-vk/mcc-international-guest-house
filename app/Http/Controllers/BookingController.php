<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Razorpay\Api\Api;
use Exception;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function showBookingForm()
    {
        return view('booking');
    }

    public function storeBooking(Request $request)
    {
        // 1. Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'gst_id' => 'nullable|string|max:50',
            'room_name' => 'required|string',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_price' => 'required|numeric',
        ]);

        // Double booking check
        $exists = Booking::where('room_name', $validated['room_name'])
            ->where('booking_date', $validated['booking_date'])
            ->where('payment_status', 'Paid')
            ->where(function ($query) use ($validated) {
                $query->where(function ($q) use ($validated) {
                    $q->where('start_time', '<', $validated['end_time'])
                        ->where('end_time', '>', $validated['start_time']);
                });
            })->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Selected workspace is already booked for this time slot.');
        }

        // 2. Create the booking locally
        $booking = Booking::create(array_merge($validated, [
            'payment_status' => 'Pending'
        ]));

        // 3. Redirect to the dummy payment page with the booking ID
        return redirect()->route('payment.page', $booking->id);
    }

    public function simulateSuccess($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'payment_status' => 'Paid',
            'razorpay_payment_id' => 'DUMMY_' . uniqid()
        ]);

        return redirect()->route('checkout.success')->with('success', 'Payment successful!');
    }

    public function simulateFailure($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'payment_status' => 'Failed'
        ]);

        return redirect()->route('checkout.failure')->with('error', 'Payment cancelled.');
    }
}
