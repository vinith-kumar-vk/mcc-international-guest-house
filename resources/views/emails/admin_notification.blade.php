<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal Approved - Admin Approval Needed</title>
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
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
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
        .booking-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .booking-details th {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #eee;
            color: #666;
            width: 40%;
            font-weight: 600;
        }
        .booking-details td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #eee;
            color: #333;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s, background-color 0.2s;
            text-align: center;
            min-width: 120px;
        }
        .btn-approve {
            background-color: #28a745;
            color: white;
        }
        .btn-approve:hover {
            background-color: #218838;
        }
        .btn-reject {
            background-color: #dc3545;
            color: white;
        }
        .btn-reject:hover {
            background-color: #c82333;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
        }
        .status-badge {
            background-color: #d1fae5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Principal Approved</h1>
            <p>Admin final approval is required for this booking</p>
        </div>
        <div class="content">
            <div style="text-align: center; margin-bottom: 25px;">
                <span class="status-badge">PRINICPAL APPROVED</span>
            </div>
            
            <h3>Booking Summary</h3>
            <table class="booking-details">
                <tr>
                    <th>Guest Name</th>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <th>Workspace</th>
                    <td><strong>{{ $booking->room_name }}</strong></td>
                </tr>
                <tr>
                    <th>Check-in</th>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date . ' ' . $booking->start_time)->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>₹{{ number_format($booking->total_price, 2) }}</td>
                </tr>
            </table>

            <p style="text-align: center; color: #666; font-size: 14px; margin-bottom: 20px;">
                The Principal has approved this request. Please provide final Admin approval.
            </p>

            <div class="actions">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <a href="{{ route('admin.bookings.approve.get', $booking->id) }}" class="btn btn-approve">FINAL APPROVE</a>
                            &nbsp;&nbsp;
                            <a href="{{ route('admin.bookings.reject.get', $booking->id) }}" class="btn btn-reject">REJECT</a>
                        </td>
                    </tr>
                </table>
            </div>
            
            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ route('admin.bookings.show', $booking->id) }}" style="color: #1e3a8a; font-size: 14px;">View in Admin Dashboard</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MCC IGH. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
