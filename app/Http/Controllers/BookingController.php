<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotification;

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
            'nationality' => 'required|string',
            'user_type' => 'required|string',
            'stream' => 'nullable|string',
            'level' => 'nullable|string',
            'department' => 'nullable|string',
            'primary_guest_name' => 'nullable|string',
            'no_of_persons' => 'required|integer|min:1',
            'passport_number' => $request->nationality === 'Non-Indian' ? 'required|string' : 'nullable|string',
            'gst_id' => 'nullable|string|max:50',
            'room_name' => 'required|string',
            'clock_in' => 'required|date',
            'clock_out' => 'required|date|after:clock_in',
            'department_other' => 'nullable|string',
            'referral_attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // Max 5MB
        ]);

        if ($request->department === 'Other' && $request->filled('department_other')) {
            $validated['department'] = $request->department_other;
        }

        $clockIn = \Carbon\Carbon::parse($validated['clock_in']);
        $clockOut = \Carbon\Carbon::parse($validated['clock_out']);
        
        // Calculate hours and price
        $durationHours = $clockIn->diffInHours($clockOut);
        if ($durationHours == 0) $durationHours = 1;
        $totalPrice = $durationHours > 4 ? 5000 : 2000;

        // Double booking check
        $exists = Booking::where('room_name', $validated['room_name'])
            ->where('booking_date', $clockIn->toDateString())
            ->where('approval_status', '!=', 'Rejected')
            ->where(function ($query) use ($clockIn, $clockOut) {
                $query->where(function ($q) use ($clockIn, $clockOut) {
                    $q->where('start_time', '<', $clockOut->toTimeString())
                        ->where('end_time', '>', $clockIn->toTimeString());
                });
            })->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Selected workspace is already booked for this time slot.');
        }

        // Handle File Upload
        $attachmentPath = null;
        if ($request->hasFile('referral_attachment')) {
            $file = $request->file('referral_attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $attachmentPath = $file->storeAs('referrals', $fileName, 'public');
        }

        // 2. Create the booking locally
        $booking = Booking::create(array_merge($validated, [
            'booking_date' => $clockIn->toDateString(),
            'start_time' => $clockIn->toTimeString(),
            'end_time' => $clockOut->toTimeString(),
            'total_price' => $totalPrice,
            'payment_status' => 'Pending',
            'approval_status' => 'Pending',
            'referral_attachment' => $attachmentPath
        ]));

        // 3. Send notification email to the Principal
        try {
            // Get dynamic settings
            $principalEmail = \App\Models\Setting::where('key', 'principal_email')->value('value') ?? 'unfortunately2909@gmail.com';
            $senderEmail = \App\Models\Setting::where('key', 'sender_email')->value('value') ?? 'prasathragul75@gmail.com';
            $mailPassword = \App\Models\Setting::where('key', 'mail_password')->value('value') ?? 'wnzt bweh qwvk gtbu';

            // Override config at runtime
            config([
                'mail.mailers.smtp.username' => $senderEmail,
                'mail.mailers.smtp.password' => $mailPassword,
                'mail.from.address' => $senderEmail,
                'mail.from.name' => 'MCC IGH System'
            ]);

            \Illuminate\Support\Facades\Mail::purge('smtp');

            Mail::to($principalEmail)->send(new BookingNotification($booking));
            Log::info('Booking notification sent successfully for ID: ' . $booking->id);
        } catch (\Exception $e) {
            Log::error('Failed to send booking notification for ID ' . $booking->id . ': ' . $e->getMessage());
        }

        // 4. Redirect directly to the success page
        return redirect()->route('checkout.success', ['id' => $booking->id])->with('success', 'Booking submitted. Your request has been sent for approval.');
    }
}
