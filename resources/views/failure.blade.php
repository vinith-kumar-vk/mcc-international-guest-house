<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failure - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>
    @include('partials.header')
    <main>
        <div class="status-container">
            <div class="status-icon fail-icon">✗</div>
            <h2>Payment Failed</h2>
            <p>Your booking was cancelled. Please try again.</p>
            <div class="button-group" style="display:flex; justify-content:center; gap: 1rem;">
                @if(isset($id))
                    <button onclick="window.location.href='{{ route('payment.page', $id) }}'" class="btn">Retry Payment</button>
                @endif
                <button onclick="window.location.href='{{ route('home') }}'" class="btn btn-outline" style="background:#fff; color:var(--primary-color); border: 2px solid var(--primary-color);">Back to Home</button>
            </div>
        </div>
    </main>
</body>

</html>