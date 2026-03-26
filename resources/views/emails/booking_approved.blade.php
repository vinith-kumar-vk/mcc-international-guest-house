<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed - MCC IGH</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #ff7a00 0%, #ff4d00 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .content {
            padding: 30px;
        }
        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background-color: #dcfce7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .checkmark-icon {
            color: #166534;
            font-size: 40px;
            font-weight: bold;
        }
        .booking-details {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #f8fafc;
            border-radius: 8px;
            overflow: hidden;
        }
        .booking-details th {
            text-align: left;
            padding: 12px 15px;
            color: #64748b;
            font-size: 13px;
            text-transform: uppercase;
            width: 40%;
        }
        .booking-details td {
            text-align: left;
            padding: 12px 15px;
            color: #1e293b;
            font-weight: 500;
        }
        .btn {
            display: inline-block;
            padding: 14px 40px;
            background-color: #ff7a00;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(255, 122, 0, 0.2);
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reservation Confirmed!</h1>
        </div>
        <div class="content" style="text-align: center;">
            <div class="success-checkmark">
                <span class="checkmark-icon">✓</span>
            </div>
            
            <h2 style="color: #1e293b;">Hello {{ $booking->name }},</h2>
            <p style="color: #64748b; line-height: 1.6;">Your booking request for <strong>{{ $booking->room_name }}</strong> has been officially approved and confirmed. We look forward to welcoming you!</p>
            
            <table class="booking-details">
                <tr>
                    <th>Booking ID</th>
                    <td>BK-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <th>Workspace</th>
                    <td>{{ $booking->room_name }}</td>
                </tr>
                <tr>
                    <th>Check-in</th>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date . ' ' . $booking->start_time)->format('M d, Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>Amount Paid</th>
                    <td>₹{{ number_format($booking->total_price, 2) }}</td>
                </tr>
            </table>

            <p style="margin-top: 30px;">
                <a href="{{ url('/success') }}?id={{ $booking->id }}" class="btn">Download Your Receipt</a>
            </p>
            
            <p style="margin-top: 20px; font-size: 14px; color: #94a3b8;">
                If you have any questions, please contact our support team.
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MCC IGH. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
