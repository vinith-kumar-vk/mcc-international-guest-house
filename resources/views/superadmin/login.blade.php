<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin Login - SpaceAdmin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        :root {
            --primary-color: #ff7a00;
            --bg-color: #f8fafc;
            --border: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        .auth-main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 2rem;
        }

        .auth-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            border: 1px solid var(--border);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: rgba(255, 122, 0, 0.1);
            color: var(--primary-color);
            border-radius: 12px;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .auth-header h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            color: var(--text-muted);
            font-size: 1.2rem;
        }

        .input-wrapper input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.8rem;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.2s;
            color: var(--text-main);
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(255, 122, 0, 0.1);
        }

        .btn-auth {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .btn-auth:hover {
            transform: translateY(-1px);
            filter: brightness(1.1);
            box-shadow: 0 4px 12px rgba(255, 122, 0, 0.2);
        }

        .alert-error {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fee2e2;
            text-align: center;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 1.5rem;
                margin: 1rem;
                border: none;
                box-shadow: none;
                background: transparent;
            }
        }
    </style>
    @include('partials.dynamic-styles')
</head>
<body>
    <main class="auth-main">
        <div class="auth-card">
            <div class="auth-header">
                <div class="sidebar-logo" style="justify-content: center; font-size: 2rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 800; color: var(--text-main);">
                    <i class="ph-bold ph-rocket-launch"></i> Space<span style="color: var(--primary-color);">Admin</span>
                </div>
                <p>System Control Center Login</p>
            </div>

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <form action="{{ route('superadmin.login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>System Account Email</label>
                    <div class="input-wrapper">
                        <i class="ph ph-envelope"></i>
                        <input type="email" name="email" required placeholder="superadmin@mccigh.com">
                    </div>
                </div>
                <div class="form-group">
                    <label>System Password</label>
                    <div class="input-wrapper">
                        <i class="ph ph-lock"></i>
                        <input type="password" name="password" required placeholder="••••••••">
                    </div>
                </div>
                <button type="submit" class="btn-auth">
                    Enter Control Center <i class="ph ph-shield-check"></i>
                </button>
            </form>
        </div>
    </main>
</body>
</html>
