<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Official Receipt - {{ $booking->id }}</title>
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'Inter', 'Helvetica', 'Arial', sans-serif; 
            color: #1e293b; 
            line-height: 1.5; 
            margin: 0; 
            padding: 40px;
            background: #fff;
        }
        .header { 
            text-align: center; 
            margin-bottom: 40px;
            border-bottom: 2px solid {{ $primaryColor }};
            padding-bottom: 20px;
        }
        .logo {
            height: 70px;
            margin-bottom: 10px;
        }
        .institution-name {
            font-size: 20px;
            font-weight: 800;
            color: {{ $primaryColor }};
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }
        .dept-name {
            font-size: 14px;
            color: #64748b;
            margin: 5px 0 0 0;
            font-weight: 600;
        }
        .receipt-label {
            display: inline-block;
            background: #f1f5f9;
            padding: 6px 20px;
            border-radius: 4px;
            font-weight: 800;
            font-size: 14px;
            margin-top: 20px;
            color: #334155;
            letter-spacing: 2px;
        }
        .grid {
            width: 100%;
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 12px;
            font-weight: 800;
            color: {{ $primaryColor }};
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 15px 0;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 5px;
        }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table th { 
            text-align: left; 
            padding: 8px 0; 
            color: #64748b; 
            font-size: 11px; 
            text-transform: uppercase;
            width: 35%;
        }
        .info-table td { 
            text-align: left; 
            padding: 8px 0; 
            color: #1e293b; 
            font-weight: 600; 
            font-size: 13px;
        }
        .price-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
            background: #f8fafc;
            border-radius: 8px;
        }
        .price-table th, .price-table td { 
            padding: 15px; 
            border-bottom: 1px solid #e2e8f0;
        }
        .price-table th {
            text-align: left;
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
        }
        .price-table td {
            font-size: 14px;
            font-weight: 600;
        }
        .total-amount {
            font-size: 24px;
            font-weight: 800;
            color: {{ $primaryColor }};
        }
        .footer { 
            position: absolute;
            bottom: 40px;
            left: 40px;
            right: 40px;
            text-align: center; 
            font-size: 11px; 
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }
        .status-badge {
            background: #dcfce7;
            color: #166534;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
        }
        .unpaid-badge {
            background: #fee2e2;
            color: #991b1b;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/logo.png'))) }}" class="logo">
        <h1 class="institution-name">Madras Christian College</h1>
        <p class="dept-name">International Guest House & Conference Centre</p>
        <div class="receipt-label">OFFICIAL RECEIPT</div>
    </div>

    <table class="grid" style="table-layout: fixed;">
        <tr>
            <td style="vertical-align: top; padding-right: 20px;">
                <p class="section-title">Guest Details</p>
                <table class="info-table">
                    <tr>
                        <th>Name</th>
                        <td>{{ $booking->name }}</td>
                    </tr>
                    <tr>
                        <th>ID / Email</th>
                        <td style="font-size: 11px;">{{ $booking->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $booking->phone }}</td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: top; padding-left: 20px;">
                <p class="section-title">Booking Info</p>
                <table class="info-table">
                    <tr>
                        <th>Receipt No</th>
                        <td>#{{ str_pad($booking->id, 8, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ date('d M, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($booking->payment_status === 'Paid')
                                <span class="status-badge">PAID</span>
                            @else
                                <span class="unpaid-badge">PAY AT COUNTER</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p class="section-title">Stay & Service Summary</p>
    <table class="info-table" style="margin-bottom: 30px;">
        <tr>
            <th style="width: 20%;">Category</th>
            <td>{{ str_replace('-', ' ', ucwords($booking->room_name, '- ')) }}</td>
        </tr>
        <tr>
            <th>Schedule</th>
            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F, Y') }} | {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}</td>
        </tr>
    </table>

    @php
        $gstRate = \App\Models\Setting::where('key', 'gst_rate')->value('value') ?? 5;
        $gstFactor = 1 + ($gstRate / 100);
        $subtotal = $booking->total_price / $gstFactor;
        $gstAmount = $booking->total_price - $subtotal;
    @endphp

    <p class="section-title">Payment Breakdown</p>
    <table class="price-table">
        <tr>
            <th style="width: 70%;">Description</th>
            <th style="text-align: right;">Amount</th>
        </tr>
        <tr>
            <td>Accommodation Charges (Subtotal)</td>
            <td style="text-align: right;">Rs. {{ number_format($subtotal, 2) }}</td>
        </tr>
        <tr>
            <td>Goods & Services Tax (GST {{ $gstRate }}%)</td>
            <td style="text-align: right;">Rs. {{ number_format($gstAmount, 2) }}</td>
        </tr>
        <tr style="background: #fff;">
            <td style="text-align: right; border-bottom: none; font-weight: 800; padding-top: 25px;">TOTAL AMOUNT</td>
            <td style="text-align: right; border-bottom: none; padding-top: 25px;">
                <span class="total-amount">Rs. {{ number_format($booking->total_price, 2) }}</span>
            </td>
        </tr>
    </table>

    <div style="margin-top: 40px; font-size: 12px; color: #64748b; line-height: 1.8;">
        <p style="margin-bottom: 5px;"><strong>Important Notes:</strong></p>
        <ul style="padding-left: 20px; margin: 0;">
            <li>This is a computer-generated receipt and does not require a physical signature.</li>
            <li>Please present a copy of this receipt (Digital or Printed) at the guesthouse reception.</li>
            <li>Standard check-in/check-out rules of the MCC International Guest House apply.</li>
        </ul>
    </div>

    <div class="footer">
        <p><strong>Madras Christian College (Autonomous)</strong></p>
        <p>Tambaram, Chennai - 600 059, Tamil Nadu, India</p>
        <p style="margin-top: 10px;">&copy; {{ date('Y') }} MCC IGH. Generated on {{ date('d/m/Y h:i A') }}</p>
    </div>
</body>
</html>
