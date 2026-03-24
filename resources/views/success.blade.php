<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body style="background: #f1f5f9;">
    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="header-logo">
        </div>
        <div class="header-center">
            <h1>MCC IGH</h1>
        </div>
        <div class="header-right">
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleDropdown(event)">
                    <i class="ph-fill ph-user-circle"></i>
                </button>
                <div class="dropdown-menu" id="profileMenu">
                    @auth
                        <a href="#" class="dropdown-item logout">Logout</a>
                    @else
                        <a href="#" class="dropdown-item">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>
    <main style="padding: 2rem 1rem;">
        <div class="success-wrapper">
            <div class="success-header">
                @if($booking->approval_status === 'Pending')
                    <i class="ph-fill ph-clock-countdown success-icon-large"></i>
                    <h2>Booking Received!</h2>
                    <p>Your booking request has been received and is <strong>waiting for approval</strong>.</p>
                @elseif($booking->approval_status === 'Rejected')
                    <i class="ph-fill ph-x-circle success-icon-large"></i>
                    <h2>Booking Rejected</h2>
                    <p>Unfortunately, your booking request has been rejected.</p>
                @else
                    <i class="ph-fill ph-check-circle success-icon-large"></i>
                    <h2>Booking Confirmed!</h2>
                    <p>Your space booking has been confirmed.</p>
                @endif
            </div>

            <div class="success-body">
                <table class="receipt-table">
                    <tbody>
                        <tr>
                            <th>Booking ID</th>
                            <td id="recBkId">BK-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</td>
                        </tr>
                        <tr>
                            <th>Transaction ID</th>
                            <td id="recTxnId">{{ $booking->razorpay_payment_id ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td id="recName">{{ $booking->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td id="recEmail">{{ $booking->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td id="recPhone">{{ $booking->phone }}</td>
                        </tr>
                        <tr>
                            <th>GST ID</th>
                            <td id="recCompany">{{ $booking->gst_id ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Guests</th>
                            <td id="recGuests">{{ $booking->primary_guest_name ?: $booking->name }} ({{ $booking->no_of_persons }} {{ Str::plural('Person', $booking->no_of_persons) }})</td>
                        </tr>
                        <tr>
                            <th>Room Name</th>
                            <td id="recRoom">{{ $booking->room_name }}</td>
                        </tr>
                        <tr>
                            <th>Date & Time</th>
                            <td id="recDateTime">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }} | {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <th>{{ $booking->payment_status === 'Paid' ? 'Total Amount Paid' : 'Total Amount to be Paid' }}</th>
                            <td id="recAmount" style="color: var(--primary-color); font-size: 1.1rem;">₹{{ number_format($booking->total_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($booking->approval_status === 'Pending')
                                    <span style="background: #fff3cd; color: #856404; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.85rem;">Waiting for Approval</span>
                                @elseif($booking->approval_status === 'Rejected')
                                    <span style="background: #f8d7da; color: #721c24; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.85rem;">Rejected</span>
                                @else
                                    <span style="background: rgba(255, 122, 0, 0.1); color: var(--primary-color); padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.85rem; font-weight: 700;">Approved</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="success-actions">
                <button class="btn btn-outline" style="flex:1;" onclick="downloadDummyReceipt()"><i
                        class="ph-bold ph-download-simple"></i> Download Receipt</button>
                <button class="btn" style="flex:1;" onclick="window.location.href='{{ route('home') }}'"><i
                        class="ph-bold ph-house"></i> Back to Home</button>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', initSuccessPage);
    </script>
</body>

</html>