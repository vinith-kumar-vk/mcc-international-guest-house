<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::where('payment_status', 'Paid')->count();
        $todayBookings = Booking::whereDate('booking_date', Carbon::today())->count();
        $totalRevenue = Booking::where('payment_status', 'Paid')->sum('total_price');
        $todayRevenue = Booking::whereDate('booking_date', Carbon::today())
            ->where('payment_status', 'Paid')
            ->sum('total_price');
        
        // Status Counts
        $pendingBookings = Booking::where('payment_status', 'Pending')->count();
        $completedBookings = Booking::where('payment_status', 'Paid')->count();
        $cancelledBookings = Booking::where('payment_status', 'Failed')->count();

        // Active spaces
        $activeWorkspaces = Booking::where('payment_status', 'Paid')
            ->distinct('room_name')
            ->count('room_name');

        $recentBookings = Booking::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $upcomingBookings = Booking::where('booking_date', '>=', Carbon::today())
            ->where('payment_status', 'Paid')
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->take(5)
            ->get();

        // Revenue analytics
        $dailyRevenue = Booking::where('payment_status', 'Paid')
            ->where('booking_date', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(booking_date) as date'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $monthlyRevenue = Booking::where('payment_status', 'Paid')
            ->where('booking_date', '>=', Carbon::now()->subMonths(6))
            ->select(DB::raw("strftime('%Y-%m', booking_date) as month"), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Workspace Analytics
        $workspaceData = Booking::where('payment_status', 'Paid')
            ->select('room_name', DB::raw('count(*) as total_bookings'))
            ->groupBy('room_name')
            ->orderBy('total_bookings', 'desc')
            ->get();
            
        $totalPaidBookings = Booking::where('payment_status', 'Paid')->count();
        foreach($workspaceData as $workspace) {
            $workspace->usage_percentage = $totalPaidBookings > 0 
                ? round(($workspace->total_bookings / $totalPaidBookings) * 100, 1) 
                : 0;
        }

        // Dynamic Insights
        $insights = [];
        if ($todayBookings > 0) {
            $insights[] = "You have $todayBookings bookings scheduled for today.";
        }
        if ($pendingBookings > 0) {
            $insights[] = "There are $pendingBookings bookings awaiting payment confirmation.";
        }
        $topSpace = $workspaceData->first();
        if ($topSpace) {
            $insights[] = "{$topSpace->room_name} is your most popular workspace this month.";
        }

        return view('admin.dashboard', compact(
            'totalBookings', 'todayBookings', 'totalRevenue', 'todayRevenue', 
            'pendingBookings', 'completedBookings', 'cancelledBookings', 'activeWorkspaces',
            'recentBookings', 'upcomingBookings', 'dailyRevenue', 'monthlyRevenue', 'workspaceData', 'insights'
        ));
    }

    public function bookings(Request $request)
    {
        $query = Booking::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%")
                  ->orWhere('razorpay_payment_id', 'LIKE', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        if ($request->filled('workspace')) {
            $query->where('room_name', $request->workspace);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $workspaces = Booking::distinct('room_name')->pluck('room_name');

        return view('admin.bookings', compact('bookings', 'workspaces'));
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.booking_details', compact('booking'));
    }
}
