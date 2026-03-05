<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failure - Space Booking Demo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <h1>Space Booking Demo</h1>
    </header>
    <main>
        <div class="status-container">
            <div class="status-icon fail-icon">✗</div>
            <h2>Payment Failed</h2>
            <p>Your booking was cancelled. Please try again.</p>
            <button onclick="window.location.href='{{ route('home') }}'" class="btn">Back to Home</button>
        </div>
    </main>
</body>

</html>