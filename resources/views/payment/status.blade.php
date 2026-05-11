<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        body { background: #f8fafc; color: #1e293b; min-height: 100vh; display: flex; flex-direction: column; }
        
        .status-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 1.5rem;
        }

        .status-card {
            background: white;
            width: 100%;
            max-width: 540px;
            border-radius: 40px;
            padding: 4rem 3rem;
            text-align: center;
            box-shadow: 0 40px 100px -20px rgba(0,0,0,0.08);
            border: 1px solid #eef2f6;
            animation: premiumIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes premiumIn {
            0% { transform: scale(0.92); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .icon-circle {
            width: 110px;
            height: 110px;
            border-radius: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2.5rem;
            font-size: 52px;
            position: relative;
        }

        .icon-success { background: #ecfdf5; color: #10b981; }
        .icon-failure { background: #fef2f2; color: #ef4444; }
        .icon-warning { background: rgba(var(--primary-rgb), 0.1); color: var(--primary-color); }
        
        .icon-circle::after {
            content: '';
            position: absolute;
            inset: -10px;
            border-radius: 48px;
            border: 2px dashed currentColor;
            opacity: 0.15;
            animation: rotate 15s linear infinite;
        }

        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        
        h1 { margin: 0; font-size: 2.25rem; font-weight: 800; color: #0f172a; letter-spacing: -1.5px; }
        p { color: #64748b; margin-top: 1.25rem; line-height: 1.7; font-size: 1.1rem; font-weight: 500; }
        
        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-top: 3rem;
            padding: 1.25rem 2.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-weight: 800;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 15px 30px -5px rgba(var(--primary-rgb), 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-home:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 40px -10px rgba(var(--primary-rgb), 0.4);
            filter: brightness(1.1);
        }
        
        .booking-details-box {
            margin-top: 2.5rem;
            padding: 2rem;
            background: #f8fafc;
            border-radius: 24px;
            text-align: left;
            border: 1px solid #e2e8f0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.85rem;
            font-size: 0.95rem;
        }

        .detail-row:last-child { margin-bottom: 0; }
        .detail-label { color: #64748b; font-weight: 600; }
        .detail-val { color: #1e293b; font-weight: 700; }
    </style>
    @include('partials.dynamic-styles')
</head>
<body>
    @include('partials.header')

    <div class="status-wrapper">
        <div class="status-card">
            @if($status === 'success')
                <div class="icon-circle icon-success"><i class="ph-fill ph-check-circle"></i></div>
                <h1>Payment Success</h1>
                <p>{{ $message }}</p>
                
                @if(isset($booking))
                <div class="booking-details-box">
                    <div class="detail-row">
                        <span class="detail-label">Transaction ID</span>
                        <span class="detail-val">#{{ $booking->id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total Amount</span>
                        <span class="detail-val">Rs. {{ number_format($booking->total_price, 2) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-val" style="color: #10b981;">Confirmed</span>
                    </div>
                </div>
                @endif
            @elseif($status === 'failed')
                <div class="icon-circle icon-failure"><i class="ph-fill ph-x-circle"></i></div>
                <h1>Payment Failed</h1>
                <p>{{ $message }}</p>
            @else
                <div class="icon-circle icon-warning"><i class="ph-fill ph-warning-circle"></i></div>
                <h1>Notice</h1>
                <p>{{ $message }}</p>
            @endif

            <a href="{{ route('home') }}" class="btn-home">
                <i class="ph-bold ph-house-line"></i>
                Return to Home
            </a>
        </div>
    </div>

    @include('partials.footer')
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
