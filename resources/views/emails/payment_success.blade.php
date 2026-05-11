<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Invoice - MCC IGH</title>
    <style>
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; background-color: #f1f5f9; margin: 0; padding: 0; color: #334155; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f1f5f9; padding: 40px 0; }
        .main { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 650px; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0; }
        
        .header { background: {{ $primaryColor }}; padding: 30px; text-align: left; }
        .header h1 { color: #ffffff; margin: 0; font-size: 28px; font-weight: 800; letter-spacing: -1px; text-transform: uppercase; }
        .header p { color: rgba(255,255,255,0.9); margin: 5px 0 0; font-size: 14px; font-weight: 500; }

        .content { padding: 40px; }
        .top-meta { width: 100%; margin-bottom: 30px; }
        .top-meta td { vertical-align: top; }
        
        .section-label { font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; display: block; }
        .section-value { font-size: 15px; font-weight: 700; color: #1e293b; margin: 0; }

        .invoice-table { width: 100%; border-collapse: collapse; margin: 30px 0; background: #f8fafc; border-radius: 8px; overflow: hidden; }
        .invoice-table th { background: #f1f5f9; padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 700; color: #64748b; border-bottom: 1px solid #e2e8f0; }
        .invoice-table td { padding: 15px; font-size: 14px; color: #334155; border-bottom: 1px solid #f1f5f9; }
        
        .total-box { margin-left: auto; width: 250px; padding-top: 10px; }
        .total-row { display: table; width: 100%; margin-bottom: 8px; }
        .total-label { display: table-cell; font-size: 13px; color: #64748b; font-weight: 600; }
        .total-value { display: table-cell; text-align: right; font-size: 14px; font-weight: 700; color: #1e293b; }
        .final-total { border-top: 2px solid #e2e8f0; margin-top: 12px; padding-top: 12px; }
        .final-total .total-label { font-size: 16px; color: #0f172a; font-weight: 800; }
        .final-total .total-value { font-size: 20px; color: {{ $primaryColor }}; font-weight: 800; }

        .stay-details { background: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px; padding: 20px; margin-top: 30px; }
        .stay-details h3 { margin: 0 0 10px; font-size: 14px; font-weight: 800; color: #92400e; text-transform: uppercase; }
        .stay-grid { width: 100%; }
        .stay-grid td { font-size: 13px; color: #b45309; font-weight: 600; }

        .footer { background: #f8fafc; padding: 30px; text-align: center; border-top: 1px solid #f1f5f9; }
        .footer p { margin: 0; font-size: 12px; color: #94a3b8; line-height: 1.6; }
        
        .btn-wrapper { text-align: center; margin-top: 40px; }
        .btn { background: #0f172a; color: #ffffff !important; text-decoration: none; padding: 14px 30px; border-radius: 10px; font-weight: 700; font-size: 14px; display: inline-block; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.15); }
    </style>
</head>
@php
    $gstRate = \App\Models\Setting::where('key', 'gst_rate')->value('value') ?? 5;
    $subtotal = $payment->amount / (1 + ($gstRate / 100));
    $gstAmount = $payment->amount - $subtotal;
@endphp
<body>
    <div class="wrapper">
        <div class="main">
            <div class="header">
                <h1>OFFICIAL INVOICE</h1>
                <p>Tax invoice for your booking at MCC International Guest House</p>
            </div>
            <div class="content">
                <table class="top-meta">
                    <tr>
                        <td width="50%">
                            <span class="section-label">Billed To</span>
                            <p class="section-value">{{ $booking->name }}</p>
                            <p style="margin: 2px 0; font-size: 13px; color: #64748b;">{{ $booking->email }}</p>
                        </td>
                        <td width="50%" align="right">
                            <span class="section-label">Invoice Reference</span>
                            <p class="section-value">#INV-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                            <p style="margin: 2px 0; font-size: 12px; color: #64748b;">Date: {{ \Carbon\Carbon::parse($payment->updated_at)->format('d M, Y') }}</p>
                        </td>
                    </tr>
                </table>

                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th width="70%">Description</th>
                            <th width="30%" align="right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Accommodation Charges - <strong>{{ $booking->room_name }}</strong></td>
                            <td align="right">Rs. {{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Service Tax / GST ({{ $gstRate }}%)</td>
                            <td align="right">Rs. {{ number_format($gstAmount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="total-box">
                    <div class="total-row">
                        <span class="total-label">Subtotal</span>
                        <span class="total-value">Rs. {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Tax (GST)</span>
                        <span class="total-value">Rs. {{ number_format($gstAmount, 2) }}</span>
                    </div>
                    <div class="total-row final-total">
                        <span class="total-label">Grand Total</span>
                        <span class="total-value">Rs. {{ number_format($payment->amount, 2) }}</span>
                    </div>
                </div>

                <div class="stay-details">
                    <h3>Booking & Stay Summary</h3>
                    <table class="stay-grid">
                        <tr>
                            <td width="35%">Booking Reference</td>
                            <td><strong>MCC-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                        </tr>
                        <tr>
                            <td>Stay Period</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') }} | {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}</td>
                        </tr>
                        <tr>
                            <td>Transaction ID</td>
                            <td>{{ $payment->txnid }}</td>
                        </tr>
                    </table>
                </div>

                <div class="btn-wrapper">
                    <a href="{{ url('/') }}" class="btn">View Booking Status</a>
                </div>

                <p style="margin-top: 40px; font-size: 13px; color: #94a3b8; text-align: center;">
                    Thank you for choosing MCC International Guest House. We look forward to your visit.
                </p>
            </div>
            <div class="footer">
                <p>
                    <strong>Madras Christian College (Autonomous)</strong><br>
                    East Tambaram, Chennai - 600 059, Tamil Nadu, India<br>
                    This is a system-generated invoice. No signature required.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
