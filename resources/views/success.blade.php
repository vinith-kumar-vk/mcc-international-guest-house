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

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .success-wrapper {
                margin: 1.5rem 1rem;
                border-radius: 12px;
            }
            .success-header {
                padding: 2.5rem 1.5rem 2rem;
            }
            .success-header h2 {
                font-size: 1.5rem;
            }
            .success-body {
                padding: 1.5rem !important;
            }
            .success-actions {
                flex-direction: column;
                padding: 0 1.5rem 2rem;
            }
            
            /* Stacking the main 50/50 blocks on mobile */
            .info-table > tbody > tr > td {
                display: block !important;
                width: 100% !important;
                padding: 0 !important;
                margin-bottom: 2rem;
            }
            .info-table > tbody > tr > td:last-child {
                margin-bottom: 0;
            }
            
            /* Ensure inner table cells in details stay side-by-side if possible */
            .detail-table td {
                display: table-cell !important;
                width: auto !important;
                padding: 4px 0 !important;
                margin: 0 !important;
            }
            
            .receipt-header h3 {
                font-size: 16px !important;
            }
            .receipt-header p {
                font-size: 12px !important;
            }
            .total-amount {
                font-size: 20px !important;
            }
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

            <div class="success-body" id="receiptContent" style="background: #ffffff; border-radius: 12px;">
                <!-- Official Header -->
                <div class="receipt-header" style="text-align: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 30px;">
                    <img src="{{ asset('assets/logo.png') }}" alt="MCC Logo" style="height: 70px; margin-bottom: 12px; opacity: 0.9;">
                    <h3 style="margin: 0; color: #1e293b; font-weight: 700; font-size: 18px; text-transform: uppercase;">Madras Christian College</h3>
                    <p style="margin: 5px 0 0; color: #64748b; font-size: 13px; font-weight: 500;">International Guest House & Conference Centre</p>
                    <div style="display: inline-block; background: #f8fafc; padding: 4px 16px; border-radius: 6px; font-weight: 700; font-size: 11px; margin-top: 15px; color: #475569; letter-spacing: 1.5px; border: 1px solid #e2e8f0;">RECEIPT SUMMARY</div>
                </div>

                <!-- Info Grid using Table for PDF Compatibility -->
                <table class="info-table" style="width: 100%; margin-bottom: 25px; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50%; vertical-align: top; padding-right: 20px;">
                            <p style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 8px 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 4px;">Guest Details</p>
                            <table class="detail-table" style="width: 100%; font-size: 13px;">
                                <tr>
                                    <td style="color: #64748b; padding: 4px 0; width: 40%;">Name:</td>
                                    <td style="font-weight: 600; color: #1e293b;">{{ $booking->name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; padding: 4px 0;">Phone:</td>
                                    <td style="font-weight: 600; color: #1e293b;">{{ $booking->phone }}</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%; vertical-align: top; padding-left: 20px;">
                            <p style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 8px 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 4px;">Booking Details</p>
                            <table class="detail-table" style="width: 100%; font-size: 13px;">
                                <tr>
                                    <td style="color: #64748b; padding: 4px 0; width: 40%;">ID:</td>
                                    <td style="font-weight: 600; color: #1e293b;">#{{ str_pad($booking->id, 8, '0', STR_PAD_LEFT) }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; padding: 4px 0;">Date:</td>
                                    <td style="font-weight: 600; color: #1e293b;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Stay Details -->
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 8px 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 4px;">Stay Information</p>
                    <table style="width: 100%; font-size: 13px;">
                        <tr>
                            <td style="color: #64748b; padding: 8px 0; width: 20%;">Category:</td>
                            <td style="font-weight: 600; color: #1e293b;">{{ str_replace('-', ' ', ucwords($booking->room_name, '- ')) }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b; padding: 8px 0; width: 20%;">Clock In:</td>
                            <td style="font-weight: 600; color: #1e293b;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') }} | {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b; padding: 8px 0;">Clock Out:</td>
                            <td style="font-weight: 600; color: #1e293b;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') }} | {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}</td>
                        </tr>
                    </table>
                </div>

                @php
                    $gstRate = \App\Models\Setting::where('key', 'gst_rate')->value('value') ?? 5;
                    $gstFactor = 1 + ($gstRate / 100);
                    $subtotal = $booking->total_price / $gstFactor;
                    $gstAmount = $booking->total_price - $subtotal;
                @endphp

                <!-- Pricing Breakdown -->
                <div style="background: #f8fafc; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="color: #64748b; font-size: 13px; padding-bottom: 10px;">Accommodation (Subtotal)</td>
                            <td style="text-align: right; font-weight: 600; font-size: 14px; padding-bottom: 10px;">Rs. {{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b; font-size: 13px; padding-bottom: 15px; border-bottom: 1px solid #cbd5e1;">Tax (GST {{ $gstRate }}%)</td>
                            <td style="text-align: right; font-weight: 600; font-size: 14px; padding-bottom: 15px; border-bottom: 1px solid #cbd5e1;">Rs. {{ number_format($gstAmount, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="color: #1e293b; font-size: 14px; font-weight: 800; padding-top: 15px;">TOTAL AMOUNT</td>
                            <td class="total-amount" style="text-align: right; color: #7f1d1d; font-size: 24px; font-weight: 900; padding-top: 15px;">Rs. {{ number_format($booking->total_price, 2) }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Footer Notes -->
                <div style="margin-top: 30px; border-top: 1px dashed #cbd5e1; padding-top: 20px; text-align: center;">
                    <p style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 0 0 5px 0;">Payment Status: {{ $booking->payment_status === 'Paid' ? 'PAID' : 'PAY AT COUNTER' }}</p>
                    <p style="font-size: 12px; color: #64748b; margin: 0;">Madras Christian College, East Tambaram, Chennai</p>
                </div>
            </div>

            <div class="success-actions" style="margin-top: 2rem;">
                <a href="{{ route('receipt.download', $booking->id) }}" class="btn-download" id="manualDownloadBtn">
                    <i class="ph-bold ph-download-simple"></i> Download Receipt
                </a>
                <button class="btn-home" onclick="window.location.href='{{ route('home') }}'">
                    <i class="ph-bold ph-house"></i> Back to Home
                </button>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Check if auto-download is requested from email link
            if (window.location.search.includes('download=1')) {
                // For auto-download, we redirect to the direct download route
                setTimeout(() => {
                    window.location.href = "{{ route('receipt.download', $booking->id) }}";
                }, 1500);
            }
        });
    </script>
</body>

</html>