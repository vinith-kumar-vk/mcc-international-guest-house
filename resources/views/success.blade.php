<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @include('partials.dynamic-styles')
    <style>
        .success-wrapper {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 650px;
            margin: 3rem auto;
        }

        .success-header {
            background: var(--primary-color);
            color: #ffffff;
            padding: 3.5rem 2.5rem 3rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .success-header h2 {
            font-size: 2rem;
            margin: 1.25rem 0 1.75rem;
            font-weight: 800;
            color: #ffffff !important;
            line-height: 1.1;
        }

        .success-header p {
            font-size: 1.15rem;
            opacity: 0.95;
            margin: 0;
            line-height: 1.5;
            max-width: 480px;
        }

        .success-icon-container {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        .success-icon-large {
            font-size: 3rem;
            color: #ffffff !important;
            opacity: 1 !important;
            -webkit-text-fill-color: #ffffff !important;
        }

        .success-body {
            padding: 2.5rem;
        }

        .receipt-table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt-table th {
            text-align: left;
            padding: 12px 0;
            color: #64748b;
            font-weight: 500;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .receipt-table td {
            text-align: right;
            padding: 12px 0;
            color: #1e293b;
            font-weight: 600;
            border-bottom: 1px solid #f1f5f9;
        }

        .success-actions {
            padding: 0 2.5rem 2.5rem;
            display: flex;
            gap: 1rem;
        }

        .btn-home {
            background: #f1f5f9 !important;
            color: #475569 !important;
            padding: 1.1rem !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.5rem !important;
            width: 100% !important;
            transition: all 0.2s ease !important;
            border: 1px solid #e2e8f0 !important;
            cursor: pointer !important;
        }

        .btn-download {
            background: var(--primary-color) !important;
            color: white !important;
            padding: 1.1rem !important;
            border-radius: 12px !important;
            font-weight: 800 !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.5rem !important;
            width: 100% !important;
            transition: all 0.2s ease !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            border: none !important;
            cursor: pointer !important;
            box-shadow: 0 4px 14px rgba(255, 122, 0, 0.3) !important;
        }

        .btn-home:hover {
            background: #e2e8f0 !important;
            color: #1e293b !important;
        }

        .btn-download:hover {
            filter: brightness(92%);
            box-shadow: 0 6px 20px rgba(255, 122, 0, 0.45) !important;
        }
    </style>
</head>

<body style="background: #f1f5f9;">
    @include('partials.header')
    <main>
        <div class="success-wrapper">
            <div class="success-header">
                <div class="success-icon-container">
                    @if($booking->approval_status === 'Pending')
                        <i class="ph-fill ph-clock success-icon-large"></i>
                    @elseif($booking->approval_status === 'Rejected')
                        <i class="ph-fill ph-x-circle success-icon-large"></i>
                    @else
                        <i class="ph-fill ph-check-circle success-icon-large"></i>
                    @endif
                </div>
                @if($booking->approval_status === 'Pending')
                    <h2 style="color: #ffffff !important;">Booking Submitted!</h2>
                    <p style="color: rgba(255,255,255,0.95) !important;">Your request has been sent to the <strong>Principal</strong> for approval. You will receive an email once it is approved.</p>
                @elseif($booking->approval_status === 'Rejected')
                    <h2>Booking Rejected</h2>
                    <p>Unfortunately, your booking request has been rejected.</p>
                @else
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
                            <td id="recRoom">{{ str_replace('-', ' ', ucwords($booking->room_name, '- ')) }}</td>
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
                                    <span style="background: #fef3c7; color: #92400e; padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; border: 1px solid #fde68a;">Waiting for Approval</span>
                                @elseif($booking->approval_status === 'Principal Approved')
                                    <span style="background: #ecfdf5; color: #065f46; padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; border: 1px solid #a7f3d0;">Principal Approved</span>
                                @elseif($booking->approval_status === 'Approved')
                                    <span style="background: var(--primary-color); color: #ffffff; padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">Fully Approved</span>
                                @elseif($booking->approval_status === 'Rejected')
                                    <span style="background: #fee2e2; color: #991b1b; padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; border: 1px solid #fecaca;">Rejected</span>
                                @else
                                    <span style="background: #f1f5f9; color: #475569; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.85rem;">{{ $booking->approval_status }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="success-actions">
                <button class="btn-home" onclick="window.location.href='{{ route('home') }}'">
                    <i class="ph-bold ph-house"></i> Back to Home
                </button>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        function downloadReceiptPDF() {
            const element = document.querySelector('.success-wrapper');
            const bookingId = 'BK-{{ str_pad($booking->id, 6, "0", STR_PAD_LEFT) }}';
            const opt = {
                margin: 0.2,
                filename: `Booking_Receipt_${bookingId}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            
            // Hide house icon/buttons during capture if any
            const actions = document.querySelector('.success-actions');
            if (actions) actions.style.display = 'none';
            
            html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
                if (actions) actions.style.display = 'flex';
            }).save();
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Check if auto-download is requested from email link
            if (window.location.search.includes('download=1')) {
                setTimeout(downloadReceiptPDF, 1500);
            }
        });
    </script>
</body>

</html>