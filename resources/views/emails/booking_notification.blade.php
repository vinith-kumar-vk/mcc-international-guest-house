<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Request</title>
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
            background: linear-gradient(135deg, #ff8c00 0%, #ff4500 100%);
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
        .badge {
            background-color: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Booking Request</h1>
            <p>A new reservation has been submitted for approval</p>
        </div>
        <div class="content">
            <h3>Booking Details</h3>
            <table class="booking-details">
                <tr>
                    <th>Guest Name</th>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $booking->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $booking->phone }}</td>
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
                    <th>Check-out</th>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date . ' ' . $booking->end_time)->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>Persons</th>
                    <td>{{ $booking->no_of_persons }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>₹{{ number_format($booking->total_price, 2) }}</td>
                </tr>
            </table>

            <p style="text-align: center; color: #666; font-size: 14px; margin-bottom: 20px;">
                Please review the booking details above and take an action.
            </p>

            <div class="actions">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <a href="{{ route('admin.bookings.approve.get', $booking->id) }}" class="btn btn-approve">APPROVE</a>
                            &nbsp;&nbsp;
                            <a href="{{ route('admin.bookings.reject.get', $booking->id) }}" class="btn btn-reject">REJECT</a>
                        </td>
                    </tr>
                </table>
            </div>
            
            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ route('admin.bookings.show', $booking->id) }}" style="color: #ff4500; font-size: 14px;">View full details in Dashboard</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MCC IGH. All rights reserved.</p>
            <p>This is an automated notification. Please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>
