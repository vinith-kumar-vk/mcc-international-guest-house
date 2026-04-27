<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        body {
            background-color: #f8fafc;
            color: #1e293b;
        }

        .payment-container {
            max-width: 600px;
            margin: 4rem auto;
            padding: 0 1.5rem;
        }

        .pay-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.05);
            border: 1px solid #eef2f6;
            overflow: hidden;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pay-header {
            padding: 2.5rem 2rem;
            text-align: center;
            background: var(--primary-color);
            color: white;
            position: relative;
        }

        .pay-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 15px solid var(--primary-color);
        }

        .pay-header .icon {
            width: 72px;
            height: 72px;
            background: rgba(255,255,255,0.25);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 36px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .pay-header h1 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff;
        }

        .pay-body {
            padding: 3rem 2.5rem;
        }

        .booking-summary {
            background: rgba(var(--primary-rgb), 0.05);
            border-radius: 20px;
            padding: 1.75rem;
            margin-bottom: 2.5rem;
            border: 2px dashed rgba(var(--primary-rgb), 0.2);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .summary-item:last-child { margin-bottom: 0; }

        .label { color: #64748b; font-weight: 500; }
        .value { color: #1e293b; font-weight: 700; }

        .total-amount {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
            border-top: 1px solid rgba(var(--primary-rgb), 0.15);
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .btn-pay {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 1.25rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            box-shadow: 0 10px 25px -5px rgba(var(--primary-rgb), 0.4);
        }

        .btn-pay:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 30px -5px rgba(var(--primary-rgb), 0.5);
            filter: brightness(1.1);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 2.5rem;
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .secure-badge i { font-size: 1.1rem; color: #10b981; }
    </style>
    @include('partials.dynamic-styles')
</head>
<body>
    @include('partials.header')

    <div class="payment-container">
        <div class="pay-card">
            <div class="pay-header">
                <div class="icon"><i class="ph-fill ph-shield-check"></i></div>
                <h1>Secure Checkout</h1>
                <p style="opacity: 0.85; font-size: 0.95rem; margin-top: 0.5rem; font-weight: 500;">MCC International Guest House</p>
            </div>
            <div class="pay-body">
                <div class="booking-summary">
                    <div class="summary-item">
                        <span class="label">Booking ID</span>
                        <span class="value">MCC/IGH/{{ date('Y') }}/{{ str_pad($link->booking->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Guest Name</span>
                        <span class="value">{{ $link->booking->name }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Room / Space</span>
                        <span class="value">{{ $link->booking->room_name }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Booking Date</span>
                        <span class="value">{{ \Carbon\Carbon::parse($link->booking->booking_date)->format('d M, Y') }}</span>
                    </div>
                    @php
                        $gstRate = \App\Models\Setting::where('key', 'gst_rate')->value('value') ?? 5;
                        $subtotal = $link->booking->total_price / (1 + ($gstRate / 100));
                        $gstAmount = $link->booking->total_price - $subtotal;
                    @endphp
                    <div class="summary-item" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(0,0,0,0.05);">
                        <span class="label">Subtotal</span>
                        <span class="value">Rs. {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">GST ({{ $gstRate }}%)</span>
                        <span class="value">Rs. {{ number_format($gstAmount, 2) }}</span>
                    </div>
                    <div class="total-amount">
                        <span>Total Payable</span>
                        <span>Rs. {{ number_format($link->booking->total_price, 2) }}</span>
                    </div>
                </div>

                <form action="{{ route('payment.process', ['token' => $link->token]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-pay">
                        Pay Securely Now
                        <i class="ph-bold ph-arrow-right"></i>
                    </button>
                </form>

                <div class="secure-badge">
                    <i class="ph-fill ph-lock-key"></i>
                    PCI-DSS Compliant Encryption
                </div>
                
                <div style="text-align: center; margin-top: 1.5rem; opacity: 0.6;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 76 26" fill="none" height="20">
                        <path d="M10.8 25.1c-6 0-10.8-4.8-10.8-10.8V0h10.8v14.3c0 .5.4.9.9.9h7.3v9.9h-8.2z" fill="#A4C639"/>
                        <path d="M40.2 25.1c-6 0-10.8-4.8-10.8-10.8V0h10.8v14.3c0 .5.4.9.9.9h7.3v9.9h-8.2z" fill="#A4C639"/>
                        <path d="M72.3 17.5H62.4v7.6H51.6V0h20.7c6 0 10.8 4.8 10.8 10.8 0 6-4.8 10.8-10.8 10.8v-4.1zm-9.9-10v5.3h9.9c.5 0 .9-.4.9-.9V8.4c0-.5-.4-.9-.9-.9h-9.9z" fill="#A4C639"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
