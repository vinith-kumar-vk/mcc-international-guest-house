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
