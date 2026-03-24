<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MCC IGH</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="auth-page">
    <header>
        <div class="header-left">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="header-logo">
            </a>
        </div>
        <div class="header-center">
            <h1>MCC IGH</h1>
        </div>
        <div class="header-right">
            <!-- Header empty on auth pages or can keep home link -->
            <a href="{{ route('home') }}" class="btn btn-outline" style="width: auto; padding: 0.5rem 1.2rem;">Back to Home</a>
        </div>
    </header>

    <main class="auth-main">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Welcome Back</h2>
                <p>Login to manage your bookings</p>
            </div>
            <form action="#" class="auth-form">
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-with-icon">
                        <i class="ph ph-envelope"></i>
                        <input type="email" placeholder="name@company.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-with-icon">
                        <i class="ph ph-lock"></i>
                        <input type="password" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="auth-utils">
                    <label class="remember-me">
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>
                <button type="submit" class="btn auth-btn">Login</button>
            </form>
            <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('register') }}">Create an Account</a></p>
            </div>
        </div>
    </main>
</body>
</html>
