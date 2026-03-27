<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotification;
use App\Mail\BookingApproved;

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
        $completedBookings = Booking::where('approval_status', 'Approved')->count();
        $pendingApprovals = Booking::where('approval_status', 'Pending')->count();
        $principalApprovals = Booking::where('approval_status', 'Principal Approved')->count();
        $pendingPayments = Booking::where('payment_status', 'Pending')->count();
        $cancelledBookings = Booking::where('payment_status', 'Failed')->count();

        // Feed for the Notification Center
        $notificationBookings = Booking::whereIn('approval_status', ['Pending', 'Principal Approved'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

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
        if ($pendingPayments > 0) {
            $insights[] = "There are $pendingPayments bookings awaiting payment confirmation.";
        }
        if ($principalApprovals > 0) {
            $insights[] = "You have $principalApprovals bookings approved by the Principal awaiting your final confirmation.";
        }
        $topSpace = $workspaceData->first();
        if ($topSpace) {
            $insights[] = "{$topSpace->room_name} is your most popular workspace this month.";
        }

        return view('admin.dashboard', compact(
            'totalBookings', 'todayBookings', 'totalRevenue', 'todayRevenue', 
            'pendingPayments', 'pendingApprovals', 'principalApprovals', 'completedBookings', 'cancelledBookings', 'activeWorkspaces',
            'recentBookings', 'upcomingBookings', 'dailyRevenue', 'monthlyRevenue', 'workspaceData', 'insights', 'notificationBookings'
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

    public function principalApprove($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->approval_status === 'Pending') {
            $booking->update(['approval_status' => 'Principal Approved']);
            return redirect()->route('approval.status')->with('success', 'Booking approved by Principal. Admin has been notified for final confirmation.');
        } 
        
        return redirect()->route('approval.status')->with('info', 'This booking has already been processed.');
    }

    public function adminApprove($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->approval_status !== 'Principal Approved') {
            return back()->with('error', 'Strict Enforced: This booking must be approved by the Principal first.');
        }

        $booking->update(['approval_status' => 'Approved']);
        
        // Notify Guest (Testing with unfortunately2909@gmail.com)
        try {
            $senderEmail = \App\Models\Setting::where('key', 'sender_email')->value('value') ?? 'prasathragul75@gmail.com';
            $mailPassword = \App\Models\Setting::where('key', 'mail_password')->value('value') ?? 'wnzt bweh qwvk gtbu';

            config([
                'mail.mailers.smtp.username' => $senderEmail,
                'mail.mailers.smtp.password' => $mailPassword,
                'mail.from.address' => $senderEmail,
                'mail.from.name' => 'MCC IGH System'
            ]);

            \Illuminate\Support\Facades\Mail::purge('smtp');

            Mail::to('unfortunately2909@gmail.com')->send(new BookingApproved($booking));
        } catch (\Exception $e) {
            \Log::error('Failed to send guest approval notification: ' . $e->getMessage());
        }

        return back()->with('success', 'Booking fully approved. Guest has been notified.');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['approval_status' => 'Rejected']);
        
        return redirect()->route('approval.status')->with('success', 'Booking has been rejected.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings')->with('success', 'Booking deleted successfully.');
    }
}
