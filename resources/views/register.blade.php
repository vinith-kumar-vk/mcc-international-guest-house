<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - MCC IGH</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
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
        /* ===========================
           INPUT RESET & STYLES
        =========================== */
        input,
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100% !important;
            height: 48px !important;
            padding: 0 16px 0 44px !important;
            border: 1.5px solid #d1d5db !important;
            border-radius: 10px !important;
            background: #ffffff !important;
            font-size: 15px !important;
            font-family: inherit !important;
            outline: none !important;
            box-sizing: border-box !important;
            display: block !important;
            line-height: 48px !important;
            color: #1e293b !important;
            font-weight: 500 !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
            -webkit-appearance: none !important;
            appearance: none !important;
        }

        input:focus,
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #ff7a00 !important;
            box-shadow: 0 0 0 3px rgba(255, 122, 0, 0.12) !important;
            color: #1e293b !important;
            outline: none !important;
        }

        input::placeholder {
            color: #9ca3af !important;
            font-weight: 400 !important;
        }

        input:focus::placeholder {
            opacity: 0 !important;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
            -webkit-text-fill-color: #1e293b !important;
        }

        input[type="checkbox"] {
            width: 16px !important;
            height: 16px !important;
            accent-color: #ff7a00 !important;
            display: inline-block !important;
            vertical-align: middle !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-appearance: auto !important;
            appearance: auto !important;
            line-height: normal !important;
        }

        /* ===== FLEX INPUT WRAPPER (immune to global padding overrides) ===== */
        .input-field-wrap {
            display: flex !important;
            align-items: center !important;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            background: #ffffff;
            overflow: hidden;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            height: 48px;
        }

        .input-field-wrap:focus-within {
            border-color: #ff7a00;
            box-shadow: 0 0 0 3px rgba(255, 122, 0, 0.12);
        }

        .input-field-wrap .field-icon {
            flex-shrink: 0;
            width: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 1rem;
            pointer-events: none;
        }

        .input-field-wrap input {
            flex: 1 !important;
            border: none !important;
            outline: none !important;
            background: transparent !important;
            height: 100% !important;
            padding: 0 12px 0 0 !important;
            font-size: 15px !important;
            color: #1e293b !important;
            font-weight: 500 !important;
            width: 100% !important;
            box-shadow: none !important;
            border-radius: 0 !important;
        }

        .input-field-wrap input::placeholder {
            color: #9ca3af !important;
            font-weight: 400 !important;
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
            background: #ff7a00 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            border-radius: 12px !important;
            font-size: 1rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            cursor: pointer !important;
            transition: background 0.2s ease !important;
            padding: 0.9rem 1.5rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            height: auto !important;
            transform: none !important;
        }
        .auth-btn:hover {
            background: #e66d00 !important;
            transform: none !important;
        }
        .auth-footer {
            width: 100%;
            text-align: center;
            margin-top: 16px;
            font-size: 0.875rem;
            color: #64748b;
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
    @include('partials.header', ['headerBackBtn' => ['url' => route('home'), 'label' => 'Back to Home']])

    <main class="register-container">
        <div class="register-card">
            <div class="auth-header">
                <h2>Join MMIP</h2>
                <p>Register to start booking spaces effortlessly</p>
            </div>
            <form action="#" class="auth-form">
                <div class="form-group">
                    <label>Full Name</label>
                    <div class="input-field-wrap">
                        <span class="field-icon"><i class="ph ph-user"></i></span>
                        <input type="text" name="name" placeholder="John Doe" required autocomplete="name">
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-field-wrap">
                        <span class="field-icon"><i class="ph ph-envelope"></i></span>
                        <input type="email" name="email" placeholder="name@company.com" required autocomplete="email">
                    </div>
                </div>
                <div class="form-group">
                    <label>Create Password</label>
                    <div class="input-field-wrap">
                        <span class="field-icon"><i class="ph ph-lock"></i></span>
                        <input type="password" name="password" placeholder="••••••••" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-field-wrap">
                        <span class="field-icon"><i class="ph ph-lock"></i></span>
                        <input type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
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
