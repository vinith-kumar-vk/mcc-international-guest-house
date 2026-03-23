<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details #{{ $booking->id }} - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --sidebar-width: 260px;
            --admin-bg: #f4f7fa;
        }

        body {
            background-color: var(--admin-bg);
            display: flex;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-menu {
            padding: 1.5rem 0.75rem;
            flex: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 122, 0, 0.08);
            color: var(--primary-color);
        }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
        }

        .admin-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 1px solid var(--border);
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .admin-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-color);
        }

        /* Details Layout */
        .details-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        .details-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .details-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .details-section-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: #1e293b;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .badge-paid { background: #dcfce7; color: #166534; }
        .badge-pending { background: #fef9c3; color: #854d0e; }
        .badge-failed { background: #fee2e2; color: #991b1b; }

        /* Payment Summary */
        .payment-summary {
            background: #f8fafc;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .summary-row.total {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed #cbd5e1;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--primary-color);
        }

        /* Timeline */
        .timeline {
            margin-top: 2rem;
        }

        .timeline-item {
            position: relative;
            padding-left: 2rem;
            padding-bottom: 1.5rem;
            border-left: 2px solid #e2e8f0;
        }

        .timeline-item:last-child {
            border-left: 2px solid transparent;
        }

        .timeline-point {
            position: absolute;
            left: -7px;
            top: 0;
            width: 12px;
            height: 12px;
            background: #cbd5e1;
            border-radius: 50%;
            border: 2px solid white;
        }

        .timeline-item.active .timeline-point {
            background: var(--primary-color);
        }

        .timeline-content {
            font-size: 0.875rem;
        }

        .timeline-time {
            color: var(--text-light);
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="ph-bold ph-rocket-launch"></i> SpaceAdmin</h2>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="ph ph-squares-four"></i> Dashboard
            </a>
            <a href="{{ route('admin.bookings') }}" class="menu-item active">
                <i class="ph ph-calendar-check"></i> Bookings
            </a>
            <a href="{{ route('home') }}" class="menu-item">
                <i class="ph ph-globe"></i> Visit Website
            </a>
        </div>
    </div>

    <main class="admin-main">
        <div class="admin-header">
            <a href="{{ route('admin.bookings') }}" class="btn-back"><i class="ph ph-arrow-left"></i></a>
            <div>
                <div style="font-size: 0.8rem; color: var(--text-light); margin-bottom: 0.25rem;">Back to list</div>
                <h1>Booking Details #{{ $booking->id }}</h1>
            </div>
        </div>

        <div class="details-grid">
            <div class="grid-left">
                <div class="details-card">
                    <div class="details-section-header">
                        <h3>Customer Information</h3>
                        <div class="status-badge badge-{{ strtolower($booking->payment_status) }}">
                            <i class="ph-fill ph-{{ $booking->payment_status == 'Paid' ? 'check-circle' : ($booking->payment_status == 'Pending' ? 'clock' : 'x-circle') }}"></i>
                            {{ $booking->payment_status }}
                        </div>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Full Name</span>
                            <span class="info-value">{{ $booking->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email Address</span>
                            <span class="info-value">{{ $booking->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone Number</span>
                            <span class="info-value">{{ $booking->phone }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">GST ID (if any)</span>
                            <span class="info-value">{{ $booking->gst_id ?: 'Not Provided' }}</span>
                        </div>
                    </div>
                </div>

                <div class="details-card">
                    <div class="details-section-header">
                        <h3>Workspace & Schedule</h3>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Workspace Name</span>
                            <span class="info-value">{{ $booking->room_name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Booking Date</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Time Slot</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Duration</span>
                            <span class="info-value">
                                @php
                                    $start = \Carbon\Carbon::parse($booking->start_time);
                                    $end = \Carbon\Carbon::parse($booking->end_time);
                                    $hours = $start->diffInHours($end);
                                @endphp
                                {{ $hours }} {{ Str::plural('Hour', $hours) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid-right">
                <div class="details-card">
                    <div class="details-section-header" style="margin-bottom: 1.5rem;">
                        <h3>Payment Details</h3>
                    </div>
                    
                    <div class="info-item" style="margin-bottom: 1.5rem;">
                        <span class="info-label">Transaction ID</span>
                        <span class="info-value" style="font-family: monospace; font-size: 0.9rem;">{{ $booking->razorpay_payment_id ?: 'Pending' }}</span>
                    </div>

                    <div class="payment-summary">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($booking->total_price / 1.18, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>GST (18%)</span>
                            <span>₹{{ number_format($booking->total_price - ($booking->total_price / 1.18), 2) }}</span>
                        </div>
                        <div class="summary-row total">
                            <span>Amount Paid</span>
                            <span>₹{{ number_format($booking->total_price, 2) }}</span>
                        </div>
                    </div>

                    <div class="timeline">
                        <div class="timeline-item active">
                            <div class="timeline-point"></div>
                            <div class="timeline-content">Booking Created</div>
                            <div class="timeline-time">{{ $booking->created_at->format('M d, Y h:i A') }}</div>
                        </div>
                        @if($booking->payment_status == 'Paid')
                        <div class="timeline-item active">
                            <div class="timeline-point"></div>
                            <div class="timeline-content">Payment Verified</div>
                            <div class="timeline-time">{{ $booking->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                        <div class="timeline-item active">
                            <div class="timeline-point"></div>
                            <div class="timeline-content">Booking Confirmed</div>
                            <div class="timeline-time">{{ $booking->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <button class="btn"><i class="ph ph-printer"></i> Print Invoice</button>
                    <button class="btn btn-outline"><i class="ph ph-envelope"></i> Resend Confirmation</button>
                    @if($booking->payment_status == 'Pending')
                        <form action="{{ route('booking.simulate.success', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn" style="background: #22c55e; border-color: #22c55e;">Mark as Paid</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>
