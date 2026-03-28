<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        :root {
            --sidebar-width: 280px;
            --admin-bg: #f8fafc;
            --primary-color: #ff7a00;
            --border: #e2e8f0;
            --success: #22c55e;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        body {
            background-color: var(--admin-bg);
            margin: 0;
            font-family: 'Inter', sans-serif;
            display: flex;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: white;
            height: 100vh;
            border-right: 1px solid var(--border);
            position: fixed;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            z-index: 100;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
        }

        .sidebar-footer {
            padding: 1.25rem 1rem;
            border-top: 1px solid var(--border);
            background: #fafafa;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2.5rem;
            box-sizing: border-box;
            min-width: 0;
        }

        .settings-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border);
            max-width: 800px;
        }

        .header {
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header h1 {
            font-size: 1.5rem;
            margin: 0;
            color: #1e293b;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            color: #1e293b;
            box-sizing: border-box;
        }

        .btn-save {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
        }

        .guide-box {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 3rem;
            max-width: 800px;
        }

        .guide-box h2 {
            font-size: 1.125rem;
            color: #9a3412;
            margin-top: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .guide-list {
            padding-left: 1.25rem;
            color: #7c2d12;
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #64748b;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.25rem;
        }

        .sidebar-menu a.active {
            background: rgba(255, 122, 0, 0.08);
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div style="font-weight: 800; color: #1e293b; font-size: 1.2rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="ph-bold ph-rocket-launch"></i> SpaceAdmin
            </div>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('superadmin.dashboard') }}" class="{{ Route::is('superadmin.dashboard') ? 'active' : '' }}">
                <i class="ph ph-squares-four"></i> Overview
            </a>
            <a href="{{ route('superadmin.admins') }}" class="{{ Route::is('superadmin.admins') ? 'active' : '' }}">
                <i class="ph ph-users"></i> Manage Admins
            </a>
            <a href="{{ route('superadmin.settings') }}" class="{{ Route::is('superadmin.settings') ? 'active' : '' }}">
                <i class="ph ph-gear"></i> System Settings
            </a>
            <div style="padding: 1rem 0; color: #94a3b8; font-size: 0.65rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em; margin-top: 1rem;">Resources</div>
            <a href="{{ route('home') }}">
                <i class="ph ph-globe"></i> Visit Site
            </a>
        </div>
        <div class="sidebar-footer">
            <form action="{{ route('superadmin.logout') }}" method="POST">
                @csrf
                <button type="submit" style="width: 100%; display: flex; align-items: center; gap: 0.75rem; background: none; border: none; padding: 0.75rem 1rem; color: #ef4444; cursor: pointer; font-weight: 600; border-radius: 8px; font-size: 0.95rem;">
                    <i class="ph-bold ph-sign-out" style="font-size: 1.2rem;"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <main class="main-content">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
            <button id="sidebarToggle" class="btn btn-outline" style="display: none; width: 42px; height: 42px; padding: 0; align-items: center; justify-content: center; transform: none !important; border: 1px solid var(--border) !important;">
                <i class="ph ph-list" style="font-size: 1.5rem;"></i>
            </button>
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="ph ph-gear-six" style="font-size: 2rem; color: var(--primary-color);"></i>
                <h1 style="font-size: 1.5rem; margin: 0; color: #1e293b;">System Configuration</h1>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="settings-card">
            <form action="{{ route('superadmin.settings.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>System Email Address</label>
                    <input type="email" name="system_email" value="{{ $settings['sender_email'] ?? '' }}" required placeholder="e.g. user@gmail.com">
                </div>

                <div class="form-group">
                    <label>Gmail App Password (16 characters)</label>
                    <input type="password" name="mail_password" value="{{ $settings['mail_password'] ?? '' }}" required placeholder="•••• •••• •••• ••••">
                    <div style="font-size: 0.75rem; color: #64748b; margin-top: 5px;">
                        <i class="ph ph-shield-check"></i> This password is encrypted for security.
                    </div>
                </div>

                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 1rem; margin-bottom: 2rem; font-size: 0.85rem; color: #166534;">
                    <i class="ph-fill ph-check-circle"></i> <strong>Configuration Active:</strong> This account will be used to <strong>send all notifications</strong> and it will also <strong>receive the initial approval links</strong>. This ensures a centralized control from a single secure account.
                </div>

                <button type="submit" class="btn-save">Save Configuration</button>
            </form>
        </div>

        <div class="guide-box">
            <h2><i class="ph-bold ph-lightbulb"></i> How to generate a Gmail App Password?</h2>
            <ol class="guide-list">
                <li>Go to your <a href="https://myaccount.google.com/" target="_blank">Google Account</a>.</li>
                <li>Ensure <strong>2-Step Verification</strong> is ON in the Security tab.</li>
                <li>Go directly to <a href="https://myaccount.google.com/apppasswords" target="_blank" style="font-weight: 700;">App Passwords</a>.</li>
                <li>Select "Mail" and "Other (Custom name: MCC IGH)".</li>
                <li>Copy the <strong>16-character code</strong> and paste it above.</li>
                <li><em>Note: Do not include spaces when pasting; the system will handle it.</em></li>
            </ol>
        </div>
    </main>
    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('open');
            });
        }

        document.addEventListener('click', (event) => {
            if (window.innerWidth <= 1024 && sidebar && !sidebar.contains(event.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>
</body>
</html>
