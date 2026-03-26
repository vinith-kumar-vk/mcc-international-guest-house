<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - MCC IGH</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .auth-page {
            margin: 0 !important;
            padding: 0 !important;
            min-height: 100vh !important;
            display: flex !important;
            flex-direction: column !important;
            background: #f1f5f9 !important;
        }
        header {
            background: #ffffff !important;
            z-index: 10;
            border-bottom: 1px solid #e2e8f0;
        }
        .register-page-container {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            min-height: 100vh !important;
            width: 100%;
            padding: 40px 20px 20px !important;
            box-sizing: border-box !important;
        }
        .register-card {
            width: 100% !important;
            max-width: 420px !important;
            margin: 20px auto 0 !important;
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            box-sizing: border-box;
            z-index: 5;
        }
        .auth-form {
            width: 100%;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
            width: 100%;
        }
        .form-group label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
        }
        input {
            width: 100% !important;
            height: 44px !important;
            padding: 10px 12px 10px 40px !important;
            line-height: normal !important;
            box-sizing: border-box !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            font-size: 0.95rem !important;
            display: block;
        }
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
            z-index: 2;
        }
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px #ffffff inset !important;
            -webkit-text-fill-color: #1f2937 !important;
        }
        .auth-utils {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            font-size: 0.875rem;
        }
        .auth-btn {
            width: 100% !important;
            height: 44px !important;
            background-color: #ff6a00 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            border-radius: 8px !important;
            font-size: 1rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .auth-btn:hover {
            background-color: #e65c00 !important;
        }
        .auth-footer {
            width: 100%;
            text-align: center;
            margin-top: 16px;
            font-size: 0.875rem;
            color: #64748b;
        }

        /* NEW STRUCTURAL INPUT FIXES */
        input, input[type="email"], input[type="password"], input[type="text"] {
            width: 100% !important;
            height: 48px !important;
            padding: 12px 14px 12px 40px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 10px !important;
            background: #ffffff !important;
            font-size: 16px !important; /* Slightly larger for better mobile/browser handling */
            outline: none !important;
            box-sizing: border-box !important;
            display: block !important;
            line-height: normal !important;
            color: #000000 !important; /* FORCED BLACK TYPED TEXT */
            font-weight: 600 !important;
            position: relative !important;
            z-index: 1 !important;
            transition: all 0.2s ease !important;
        }

        input:focus {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2) !important;
            color: #000000 !important;
        }

        /* FORCE TYPED TEXT TO BE BLACK ON AUTOFILL */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px white inset !important;
            -webkit-text-fill-color: #000000 !important;
        }

        /* PLACEHOLDER COLOR AND FOCUS HANDLING */
        input::placeholder,
        input::-webkit-input-placeholder,
        input::-moz-placeholder,
        input:-ms-input-placeholder {
            color: #9ca3af !important;
            opacity: 1 !important;
        }

        /* IMMEDIATELY HIDE PLACEHOLDER ON FOCUS TO PREVENT OVERLAP */
        input:focus::placeholder,
        input:focus::-webkit-input-placeholder,
        input:focus::-moz-placeholder,
        input:focus:-ms-input-placeholder {
            color: transparent !important;
            opacity: 0 !important;
        }

        .input-group {
            position: relative !important;
            width: 100% !important;
        }

        .input-group .icon {
            position: absolute !important;
            left: 12px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            z-index: 10 !important;
            color: #94a3b8 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        input[type="checkbox"] {
            width: 16px !important;
            height: 16px !important;
            accent-color: #f97316 !important;
            display: inline-block !important;
            vertical-align: middle !important;
            margin: 0 !important;
        }
        
        .register-container {
            padding-top: 40px !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            min-height: 100vh !important;
            width: 100%;
            box-sizing: border-box !important;
        }
    </style>
</head>
<body class="auth-page">
    <header>
        <div class="header-left">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="header-logo" style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
            </a>
        </div>
        <div class="header-center">
            <h1>MCC International Guest House</h1>
        </div>
        <div class="header-right">
            <a href="{{ route('home') }}" class="btn btn-outline" style="width: auto; padding: 0.5rem 1.2rem;">Back to Home</a>
        </div>
    </header>

    <main class="register-container">
        <div class="register-card">
            <div class="auth-header">
                <h2>Join MMIP</h2>
                <p>Register to start booking spaces effortlessly</p>
            </div>
            <form action="#" class="auth-form">
                <div class="form-group">
                    <label>Full Name</label>
                    <div class="input-group">
                        <span class="icon"><i class="ph ph-user"></i></span>
                        <input type="text" placeholder="John Doe" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-group">
                        <span class="icon"><i class="ph ph-envelope"></i></span>
                        <input type="email" placeholder="name@company.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Create Password</label>
                    <div class="input-group">
                        <span class="icon"><i class="ph ph-lock"></i></span>
                        <input type="password" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-group">
                        <span class="icon"><i class="ph ph-lock"></i></span>
                        <input type="password" placeholder="••••••••" required>
                    </div>
                </div>
                <!-- Consent -->
                <div class="auth-utils">
                    <label class="remember-me">
                        <input type="checkbox" required> I agree to terms & conditions
                    </label>
                </div>
                <button type="submit" class="btn auth-btn">Register</button>
            </form>
            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </main>
</body>
</html>
