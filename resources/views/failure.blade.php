<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failure - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="header-logo">
        </div>
        <div class="header-center">
            <h1>MCC IGH</h1>
        </div>
        <div class="header-right">
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleDropdown(event)">
                    <i class="ph-fill ph-user-circle"></i>
                </button>
                <div class="dropdown-menu" id="profileMenu">
                    @auth
                        <a href="#" class="dropdown-item logout">Logout</a>
                    @else
                        <a href="#" class="dropdown-item">Login</a>
                    @endauth
                </div>
            </div>
        </div>
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