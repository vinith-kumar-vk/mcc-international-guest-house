<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin Dashboard - System Overview</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        :root {
            --sidebar-width: 280px;
            --admin-bg: #f8fafc;
            --primary-color: #ff7a00;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
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
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.25rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar-menu a.active {
            background: rgba(255, 122, 0, 0.08);
            color: var(--primary-color);
        }

        .sidebar-menu a:hover:not(.active) {
            background: #f8fafc;
            color: var(--text-main);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--card-shadow);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .icon-indigo { background: rgba(255, 122, 0, 0.08); color: #ff7a00; }
        .icon-emerald { background: #ecfdf5; color: #10b981; }
        .icon-amber { background: #fffbeb; color: #d97706; }
        .icon-rose { background: #fff1f2; color: #e11d48; }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .welcome-section {
            background: linear-gradient(135deg, #ff8a00 0%, #ff5200 100%);
            border-radius: 20px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-content h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
        }

        .welcome-content p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
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
            <a href="{{ route('superadmin.dashboard') }}" class="active"><i class="ph ph-squares-four"></i> Overview</a>
            <a href="{{ route('superadmin.settings') }}"><i class="ph ph-shield-star"></i> System Settings</a>
            <div style="padding: 1rem 0; color: #94a3b8; font-size: 0.65rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em; margin-top: 1rem;">Resources</div>
            <a href="{{ route('home') }}"><i class="ph ph-globe"></i> Visit Site</a>
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
        <div class="welcome-section">
            <div class="welcome-content">
                <h1>Hello, SuperAdmin!</h1>
                <p>Welcome to the system control center. Monitor global performance and configurations.</p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">System Wide Bookings</span>
                    <div class="stat-icon icon-indigo"><i class="ph ph-calendar"></i></div>
                </div>
                <div class="stat-value">{{ $totalSystemBookings }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Total GHW Revenue</span>
                    <div class="stat-icon icon-emerald"><i class="ph ph-currency-inr"></i></div>
                </div>
                <div class="stat-value">₹{{ number_format($totalRevenue) }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">System Uptime</span>
                    <div class="stat-icon icon-amber"><i class="ph ph-clock"></i></div>
                </div>
                <div class="stat-value">{{ $systemUpTime }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Pending Maintenance</span>
                    <div class="stat-icon icon-rose"><i class="ph ph-warning-circle"></i></div>
                </div>
                <div class="stat-value">{{ $pendingTasks }}</div>
            </div>
        </div>

        <div style="background: white; border-radius: 16px; border: 1px solid var(--border); padding: 2rem;">
            <h3 style="margin-top: 0; color: var(--text-main);">Recent System Logs</h3>
            <div style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                <p><i class="ph ph-info" style="color: var(--primary-color);"></i> [{{ now()->format('H:i') }}] System configuration updated via SuperAdmin Panel.</p>
                <p><i class="ph ph-info" style="color: var(--primary-color);"></i> [{{ now()->subHour()->format('H:i') }}] Daily backup completed successfully.</p>
                <p><i class="ph ph-info" style="color: var(--primary-color);"></i> [{{ now()->subHours(5)->format('H:i') }}] Email service heartbeat: Healthy.</p>
            </div>
        </div>
    </main>
</body>
</html>
