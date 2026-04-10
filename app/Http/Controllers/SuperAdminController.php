<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function index()
    {
        // ── Core System Stats ──────────────────────────────────────────
        $totalSystemBookings  = Booking::count();
        $totalRevenue         = Booking::where('payment_status', 'Paid')->sum('total_price');
        $todayRevenue         = Booking::whereDate('booking_date', Carbon::today())
                                    ->where('payment_status', 'Paid')->sum('total_price');
        $monthRevenue         = Booking::whereMonth('booking_date', Carbon::now()->month)
                                    ->whereYear('booking_date', Carbon::now()->year)
                                    ->where('payment_status', 'Paid')->sum('total_price');

        // ── Booking Status Breakdown ───────────────────────────────────
        $pendingApprovals     = Booking::where('approval_status', 'Pending')->count();
        $principalApprovals   = Booking::where('approval_status', 'Principal Approved')->count();
        $approvedBookings     = Booking::where('approval_status', 'Approved')->count();
        $rejectedBookings     = Booking::where('approval_status', 'Rejected')->count();
        $pendingPayments      = Booking::where('payment_status', 'Pending')->count();
        $paidBookings         = Booking::where('payment_status', 'Paid')->count();

        // ── Month-over-Month Revenue Growth ───────────────────────────
        $lastMonthRevenue = Booking::whereMonth('booking_date', Carbon::now()->subMonth()->month)
                                ->whereYear('booking_date', Carbon::now()->subMonth()->year)
                                ->where('payment_status', 'Paid')->sum('total_price');
        $revenueGrowth = $lastMonthRevenue > 0
            ? round((($monthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : null;

        // ── Monthly Revenue Chart (last 6 months) ─────────────────────
        $monthlyRevenue = Booking::where('payment_status', 'Paid')
            ->where('booking_date', '>=', Carbon::now()->subMonths(6))
            ->select(
                DB::raw("strftime('%Y-%m', booking_date) as month"),
                DB::raw('SUM(total_price) as revenue'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // ── Top Rooms by Booking Volume ────────────────────────────────
        $topRooms = Booking::select('room_name', DB::raw('count(*) as total'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('room_name')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // ── Recent Bookings ────────────────────────────────────────────
        $recentBookings = Booking::orderBy('created_at', 'desc')->take(8)->get();

        // ── Actionable Alerts ──────────────────────────────────────────
        $alerts = [];
        if ($pendingApprovals > 0)
            $alerts[] = ['type' => 'warning', 'msg' => "$pendingApprovals booking(s) pending principal approval."];
        if ($principalApprovals > 0)
            $alerts[] = ['type' => 'info', 'msg' => "$principalApprovals booking(s) approved by Principal, awaiting admin final action."];
        if ($pendingPayments > 0)
            $alerts[] = ['type' => 'warning', 'msg' => "$pendingPayments approved booking(s) awaiting counter payment."];
        if (empty($alerts))
            $alerts[] = ['type' => 'success', 'msg' => 'All systems are running smoothly. No pending actions.'];

        $systemUpTime = '99.9%';

        return view('superadmin.dashboard', compact(
            'totalSystemBookings', 'totalRevenue', 'todayRevenue', 'monthRevenue',
            'pendingApprovals', 'principalApprovals', 'approvedBookings', 'rejectedBookings',
            'pendingPayments', 'paidBookings',
            'revenueGrowth', 'lastMonthRevenue', 'monthlyRevenue',
            'topRooms', 'recentBookings', 'alerts', 'systemUpTime'
        ));
    }

    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('superadmin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'system_email'        => 'required|email',
            'mail_password'       => 'required',
            'mail_host'           => 'required|string',
            'mail_port'           => 'required|integer',
            'mail_encryption'     => 'required|string',
            'mail_mailer'         => 'required|string',
            'primary_color'       => 'nullable|string',
            'secondary_color'     => 'nullable|string',
            'use_secondary_color' => 'nullable'
        ]);

        Setting::updateOrCreate(['key' => 'principal_email'], ['value' => $request->system_email]);
        Setting::updateOrCreate(['key' => 'mail_password'],   ['value' => $request->mail_password]);
        Setting::updateOrCreate(['key' => 'sender_email'],    ['value' => $request->system_email]);
        
        Setting::updateOrCreate(['key' => 'mail_host'],       ['value' => $request->mail_host]);
        Setting::updateOrCreate(['key' => 'mail_port'],       ['value' => $request->mail_port]);
        Setting::updateOrCreate(['key' => 'mail_encryption'], ['value' => $request->mail_encryption]);
        Setting::updateOrCreate(['key' => 'mail_mailer'],     ['value' => $request->mail_mailer]);
        
        Setting::updateOrCreate(['key' => 'primary_color'],   ['value' => $request->primary_color ?? '#ff7a00']);
        Setting::updateOrCreate(['key' => 'secondary_color'], ['value' => $request->secondary_color ?? '#001a33']);
        Setting::updateOrCreate(['key' => 'use_secondary_color'], ['value' => $request->has('use_secondary_color') ? '1' : '0']);

        return redirect()->back()->with('success', 'System settings updated successfully.');
    }

    public function manageAdmins()
    {
        $admins = \App\Models\User::where('role', 'admin')->get();
        return view('superadmin.admins', compact('admins'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin user created successfully.');
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = \App\Models\User::where('role', 'admin')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $admin->save();

        return redirect()->back()->with('success', 'Admin credentials updated successfully.');
    }

    public function deleteAdmin($id)
    {
        $admin = \App\Models\User::where('role', 'admin')->findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin user removed.');
    }
}
