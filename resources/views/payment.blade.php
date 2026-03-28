<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Simulation - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body style="background: #f1f5f9;">
    @include('partials.header')
    <main style="padding: 2rem 1rem;">

        <div class="pg-wrapper">
            <!-- LEFT: Dummy Payment Simulation Interface -->
            <div class="pg-main">
                <div class="pg-header">
                    <div class="pg-logo" style="font-size: 1.05rem;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            style="margin-right:0.5rem;">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM11 19.93C7.06 19.43 4 16.03 4 12C4 7.97 7.06 4.57 11 4.07V19.93ZM13 4.07C16.94 4.57 20 7.97 20 12C20 16.03 16.94 19.43 13 19.93V4.07Z"
                                fill="white" />
                        </svg>
                        Secure Payment Simulation
                    </div>
                    <div class="pg-test-badge">SIMULATION MODE</div>
                </div>

                <div class="pg-body">
                    <div class="pg-sidebar">
                        <div class="pg-sidebar-header">Payment Options</div>
                        <button class="pg-method active" onclick="switchPgMethod('pg-upi', this)"><i
                                class="ph ph-qr-code"></i> UPI / QR</button>
                        <button class="pg-method" onclick="switchPgMethod('pg-card', this)"><i
                                class="ph ph-credit-card"></i> Card</button>
                    </div>

                    <div class="pg-content">
                        <!-- UPI Pane -->
                        <div id="pg-upi" class="pg-pane active">
                            <h4>Scan QR to Confirm Payment</h4>
                            <div class="pg-upi-container">
                                <div class="qr-container">
                                    <div class="qr-placeholder" style="margin-bottom:1rem;">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa=dummy@ybl&pn=SpaceBookingDemo&cu=INR"
                                            alt="Dummy UPI">
                                    </div>
                                    <div class="timer" style="color:#d32f2f; font-weight:600; font-size:0.9rem;">
                                        <i class="ph-bold ph-timer"></i> Expires in: <span
                                            id="paymentTimer">05:00</span>
                                    </div>
                                </div>
                                <div class="upi-instructions">
                                    <p style="font-weight:600; font-size:0.95rem; margin-bottom:0.75rem;">Simulation Instructions</p>
                                    <ul style="padding-left:1.5rem; font-size:0.9rem; color:#555; margin-bottom:1.5rem;">
                                        <li>Click "Confirm & Pay" to simulate a successful transaction.</li>
                                        <li>Click "Cancel Transaction" to simulate a failed/cancelled payment.</li>
                                        <li>No actual money will be debited.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Card Pane -->
                        <div id="pg-card" class="pg-pane">
                            <h4>Simulate Card Payment</h4>
                            <div class="pg-input-group">
                                <label>Card Number</label>
                                <input type="text" placeholder="4242 4242 4242 4242" disabled>
                            </div>
                            <div class="pg-input-row" style="display:flex; gap:1rem;">
                                <div class="pg-input-group" style="flex: 1;">
                                    <label>Expiry</label>
                                    <input type="text" placeholder="12/28" disabled>
                                </div>
                                <div class="pg-input-group" style="flex: 1;">
                                    <label>CVV</label>
                                    <input type="password" placeholder="***" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pg-footer">
                    <div style="display: flex; gap: 1rem;">
                        <form action="{{ route('booking.simulate.success', $booking->id) }}" method="POST" style="flex: 1;">
                            @csrf
                            <button type="submit" class="pg-pay-btn" id="sim-pay-btn">
                                Confirm & Pay ₹{{ number_format($booking->total_price, 2) }}
                            </button>
                        </form>
                    </div>

                    <div style="text-align: center; margin-top: 1rem; display:flex; justify-content:space-between; align-items:center;">
                        <form action="{{ route('booking.simulate.failure', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" style="background:transparent; border:none; color:#d32f2f; font-size:0.85rem; cursor:pointer; font-weight: 600;"
                                onmouseover="this.style.textDecoration='underline'"
                                onmouseout="this.style.textDecoration='none'">Cancel Transaction</button>
                        </form>
                        <div style="font-size:0.8rem; color:#666;"><i class="ph-fill ph-lock-key"
                                style="color:#28a745;"></i> Simulation protected by Secure Protocol</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Booking Details -->
            <div class="pg-summary-pane" style="position:relative;">
                <h3>Booking Summary</h3>
                <div class="pg-summary-details">
                    <div class="pg-summary-row">
                        <span>Room</span>
                        <span>{{ $booking->room_name }}</span>
                    </div>
                    <div class="pg-summary-row">
                        <span>Date</span>
                        <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</span>
                    </div>
                    <div class="pg-summary-row">
                        <span>Time</span>
                        <span>{{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}</span>
                    </div>
                </div>

                <div class="pg-summary-total"
                    style="border-top:1px dashed #cbd5e1; margin-top:2rem; padding-top:1rem; font-size:1.3rem;">
                    <span>Final Total</span>
                    <span style="color:var(--primary-color);">₹{{ number_format($booking->total_price, 2) }}</span>
                </div>

                <div class="pg-footer-branding"
                    style="text-align:center; font-size:0.8rem; color:#888; font-weight:500; margin-top:10rem;">
                    Payment Simulation System
                </div>
            </div>
        </div>

    </main>

    <script>
        function switchPgMethod(methodId, btnElement) {
            document.querySelectorAll('.pg-pane').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.pg-method').forEach(el => el.classList.remove('active'));

            document.getElementById(methodId).classList.add('active');
            btnElement.classList.add('active');
        }

        // Timer Script
        let minutes = 5;
        let seconds = 0;
        const timerElement = document.getElementById('paymentTimer');
        
        setInterval(() => {
            if (seconds === 0) {
                if (minutes === 0) return;
                minutes--;
                seconds = 59;
            } else {
                seconds--;
            }
            timerElement.innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }, 1000);
    </script>
</body>

</html>