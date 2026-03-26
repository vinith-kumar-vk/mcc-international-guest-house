<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Booking;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Placeholder stats for SuperAdmin
        $totalSystemBookings = Booking::count();
        $totalRevenue = Booking::where('payment_status', 'Paid')->sum('total_price');
        $systemUpTime = "99.9%";
        $pendingTasks = 2; // e.g., backup, logs

        return view('superadmin.dashboard', compact('totalSystemBookings', 'totalRevenue', 'systemUpTime', 'pendingTasks'));
    }

    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('superadmin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'system_email' => 'required|email',
            'mail_password' => 'required',
        ]);

        Setting::updateOrCreate(['key' => 'principal_email'], ['value' => $request->system_email]);
        Setting::updateOrCreate(['key' => 'mail_password'], ['value' => $request->mail_password]);
        Setting::updateOrCreate(['key' => 'sender_email'], ['value' => $request->system_email]);

        return redirect()->back()->with('success', 'System settings updated successfully.');
    }
}
