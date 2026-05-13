<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotification;
use App\Mail\BookingApproved;
use App\Models\PaymentLink;
use App\Mail\PaymentLinkMail;
use Illuminate\Support\Str;

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

        // Feed for the Notification Center (Only Unread)
        $notificationBookings = Booking::whereIn('approval_status', ['Pending', 'Principal Approved'])
            ->where('is_admin_read', false)
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

    public function exportCsv(Request $request)
    {
        $query = Booking::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }
        if ($request->filled('date'))      $query->whereDate('booking_date', $request->date);
        if ($request->filled('status'))    $query->where('payment_status', $request->status);
        if ($request->filled('workspace')) $query->where('room_name', $request->workspace);

        $bookings = $query->orderBy('created_at', 'desc')->get();

        $filename = 'bookings_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($bookings) {
            $handle = fopen('php://output', 'w');

            // CSV Header Row
            fputcsv($handle, [
                'Booking ID', 'Guest Name', 'Email', 'Phone',
                'Room / Space', 'Booking Date', 'Start Time', 'End Time',
                'No. of Persons', 'User Type', 'Approval Status', 'Payment Status',
                'Total Price (₹)', 'Payment ID', 'Submitted At'
            ]);

            foreach ($bookings as $b) {
                fputcsv($handle, [
                    $b->id,
                    $b->name,
                    $b->email,
                    $b->phone ?? '',
                    $b->room_name,
                    \Carbon\Carbon::parse($b->booking_date)->format('d M Y'),
                    \Carbon\Carbon::parse($b->start_time)->format('H:i'),
                    \Carbon\Carbon::parse($b->end_time)->format('H:i'),
                    $b->no_of_persons ?? '',
                    $b->user_type ?? '',
                    $b->approval_status,
                    $b->payment_status,
                    number_format($b->total_price, 2),
                    $b->razorpay_payment_id ?? '',
                    $b->created_at->format('d M Y, H:i'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Mark as read when admin views details
        if (!$booking->is_admin_read) {
            $booking->update(['is_admin_read' => true]);
        }
        
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
        
        if ($booking->approval_status !== 'Principal Approved' && $booking->approval_status !== 'Approved') {
            return back()->with('error', 'Strict Enforced: This booking must be approved by the Principal first.');
        }

        if ($booking->approval_status !== 'Approved') {
            $booking->update(['approval_status' => 'Approved']);
            app(\App\Services\WebhookService::class)->trigger('booking.confirmed', $booking);
        }
        
        // Generate Secure Payment Token
        $token = Str::random(32);
        $paymentLink = PaymentLink::create([
            'booking_id' => $id,
            'token' => $token,
            'expires_at' => Carbon::now()->addHours(24),
            'is_used' => false
        ]);

        // Notify Guest
        try {
            // Apply Dynamic Mail Config
            $this->applyMailConfig();

            Mail::to($booking->email)->send(new PaymentLinkMail($booking, $paymentLink));
        } catch (\Exception $e) {
            \Log::error('Failed to send guest payment link: ' . $e->getMessage());
        }

        return back()->with('success', 'Booking approved. Payment link has been sent to the guest.');
    }

    public function resendPaymentLink($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->payment_status === 'Paid') {
            return back()->with('error', 'This booking is already paid.');
        }

        // Generate New Secure Payment Token (invalidates previous if we want, but typically we just send a fresh one)
        $token = Str::random(32);
        $paymentLink = PaymentLink::create([
            'booking_id' => $id,
            'token' => $token,
            'expires_at' => Carbon::now()->addHours(24),
            'is_used' => false
        ]);

        try {
            $this->applyMailConfig();
            Mail::to($booking->email)->send(new PaymentLinkMail($booking, $paymentLink));
        } catch (\Exception $e) {
            \Log::error('Failed to resend guest payment link: ' . $e->getMessage());
            return back()->with('error', 'Failed to send email. Check logs.');
        }

        return back()->with('success', 'A new payment link has been sent to the guest.');
    }

    private function applyMailConfig()
    {
        $senderEmail    = \App\Models\Setting::where('key', 'sender_email')->value('value')    ?? 'prasathragul75@gmail.com';
        $mailPassword   = \App\Models\Setting::where('key', 'mail_password')->value('value')   ?? 'wnzt bweh qwvk gtbu';
        $mailHost       = \App\Models\Setting::where('key', 'mail_host')->value('value')       ?? 'smtp.gmail.com';
        $mailPort       = \App\Models\Setting::where('key', 'mail_port')->value('value')       ?? '587';
        $mailEncryption = \App\Models\Setting::where('key', 'mail_encryption')->value('value') ?? 'tls';
        $mailMailer     = \App\Models\Setting::where('key', 'mail_mailer')->value('value')     ?? 'smtp';

        config([
            'mail.default' => $mailMailer,
            'mail.mailers.smtp.host' => $mailHost,
            'mail.mailers.smtp.port' => $mailPort,
            'mail.mailers.smtp.encryption' => $mailEncryption,
            'mail.mailers.smtp.username' => $senderEmail,
            'mail.mailers.smtp.password' => $mailPassword,
            'mail.from.address' => $senderEmail,
            'mail.from.name' => 'MCC IGH System'
        ]);

        \Illuminate\Support\Facades\Mail::purge('smtp');
    }

    public function reject($id, Request $request)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['approval_status' => 'Rejected']);
        app(\App\Services\WebhookService::class)->trigger('booking.cancelled', $booking);
        
        if ($request->isMethod('post')) {
            return back()->with('error', 'Booking has been rejected.');
        }
        
        return redirect()->route('approval.status')->with('error', 'Booking has been rejected.');
    }

    public function markAsPaid($id)
    {
        $booking = Booking::findOrFail($id);
        
        $booking->update([
            'payment_status' => 'Paid',
            'razorpay_payment_id' => 'COUNTER_' . uniqid()
        ]);

        return back()->with('success', 'Booking marked as Paid at counter.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings')->with('success', 'Booking deleted successfully.');
    }

    public function reports(Request $request)
    {
        $query = Booking::query();

        if ($request->filled('start_date')) {
            $query->whereDate('booking_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('booking_date', '<=', $request->end_date);
        }

        $bookings = $query->orderBy('booking_date', 'desc')->get();
        
        // Calculate dynamic totals for the report summary
        $gstRate = \App\Models\Setting::where('key', 'gst_rate')->value('value') ?? 5;
        $gstFactor = 1 + ($gstRate / 100);
        
        $totalRevenue = $bookings->sum('total_price');
        $netRevenue = $totalRevenue / $gstFactor;
        $totalGst = $totalRevenue - $netRevenue;
        
        return view('admin.reports', compact('bookings', 'totalRevenue', 'netRevenue', 'totalGst', 'gstRate'));
    }

    public function markNotificationsRead()
    {
        Booking::whereIn('approval_status', ['Pending', 'Principal Approved'])
            ->where('is_admin_read', false)
            ->update(['is_admin_read' => true]);
            
        return back()->with('success', 'All notifications marked as read.');
    }

    public function downloadReport(Request $request)
    {
        $query = Booking::query();

        if ($request->filled('start_date')) {
            $query->whereDate('booking_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('booking_date', '<=', $request->end_date);
        }

        $bookings = $query->orderBy('booking_date', 'desc')->get();
        
        // Calculate dynamic totals for the PDF report
        $gstRate = \App\Models\Setting::where('key', 'gst_rate')->value('value') ?? 5;
        $gstFactor = 1 + ($gstRate / 100);
        
        $totalRevenue = $bookings->sum('total_price');
        $netRevenue = $totalRevenue / $gstFactor;
        $totalGst = $totalRevenue - $netRevenue;
        
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $primaryColor = \App\Models\Setting::where('key', 'primary_color')->value('value') ?? '#ff7a00';

        // Using the global 'Pdf' alias which is auto-discovered
        $pdf = \Pdf::loadView('admin.report_pdf', compact('bookings', 'startDate', 'endDate', 'primaryColor', 'totalRevenue', 'netRevenue', 'totalGst', 'gstRate'));
        
        return $pdf->download('Revenue_Report_'.now()->format('dM_Y').'.pdf');
    }
}
