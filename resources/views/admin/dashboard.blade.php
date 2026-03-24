<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Admin Dashboard - Space Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --sidebar-width: 260px;
            --admin-bg: #f8fafc;
            --primary-color: #ff7a00;
            --border: #e2e8f0;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --card-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--admin-bg);
            display: flex;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar.open {
            transform: translateX(0) !important;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            color: var(--primary-color);
            display: flex; align-items: center; gap: 0.5rem; margin: 0;
        }

        .sidebar-menu {
            padding: 1rem 0.75rem; flex: 1;
        }

        .menu-item {
            display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem;
            color: #64748b; text-decoration: none; border-radius: 8px; font-weight: 500;
            transition: all 0.2s ease; margin-bottom: 0.25rem;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 122, 0, 0.08); color: var(--primary-color);
        }

        .sidebar-footer { padding: 1rem; border-top: 1px solid var(--border); }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-width); 
            flex: 1; 
            padding: 0;
            display: flex; 
            flex-direction: column;
            width: calc(100% - var(--sidebar-width));
            min-width: 0;
            transition: all 0.3s ease;
        }

        .top-navbar {
            height: 64px; background: white; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;
            position: sticky; top: 0; z-index: 90;
        }

        .nav-right { display: flex; align-items: center; gap: 1.25rem; }

        .notification-bell {
            position: relative; font-size: 1.25rem; color: #64748b; cursor: pointer;
            display: flex; align-items: center;
        }

        .notification-badge {
            position: absolute; top: -5px; right: -5px; background: var(--danger); color: white;
            font-size: 0.6rem; width: 15px; height: 15px; border-radius: 50%; display: flex;
            align-items: center; justify-content: center; border: 2px solid white; font-weight: 700;
        }

        .admin-body {
            padding: 1.5rem 2.5rem 3rem 2rem; max-width: 1600px; width: 100%; margin: 0 auto; box-sizing: border-box;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            gap: 1.25rem; 
            margin-bottom: 2rem;
            width: 100%;
        }

        .stat-card {
            background: white; 
            padding: 1.5rem; 
            border-radius: 16px; 
            border: 1px solid var(--border);
            display: flex; 
            flex-direction: column; 
            gap: 0.5rem; 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            min-width: 0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        .stat-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 0.5rem;
            gap: 0.5rem;
        }

        .stat-icon {
            width: 40px; 
            height: 40px; 
            border-radius: 10px; 
            display: flex; 
            align-items: center;
            justify-content: center; 
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-orange { background: #fff7ed; color: #f97316; }
        .icon-green { background: #f0fdf4; color: #22c55e; }
        .icon-purple { background: #faf5ff; color: #a855f7; }
        .icon-red { background: #fef2f2; color: #ef4444; }

        .stat-value { 
            font-size: 1.75rem; 
            font-weight: 700; 
            color: #1e293b;
            line-height: 1.2;
        }

        .stat-label { 
            font-size: 0.7rem; 
            color: #64748b; 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 0.05em;
            line-height: 1.2;
            word-break: break-all;
            display: block;
        }

        /* Generic Section Card */
        .dashboard-section {
            background: white; 
            border-radius: 16px; 
            border: 1px solid var(--border); 
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); 
            height: 100%; 
            box-sizing: border-box;
        }

        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; }

        .section-header h3 {
            font-size: 1rem; font-weight: 600; color: #1e293b; display: flex; align-items: center;
            gap: 0.5rem; margin: 0;
        }

        /* Custom Grids */
        .row-grid {
            display: grid; grid-template-columns: 2fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; align-items: start;
        }

        /* Chart Area */
        .chart-container { height: 240px; position: relative; width: 100%; }

        .chart-controls { display: flex; background: #f1f5f9; padding: 0.2rem; border-radius: 6px; }

        .chart-toggle {
            padding: 0.3rem 0.6rem; font-size: 0.75rem; font-weight: 600; border: none;
            background: transparent; color: #64748b; cursor: pointer; border-radius: 4px; transition: all 0.2s;
        }

        .chart-toggle.active { background: white; color: var(--primary-color); box-shadow: 0 1px 2px rgba(0,0,0,0.05); }

        /* Quick Actions & Calendar */
        .right-box { display: flex; flex-direction: column; gap: 1.25rem; }

        .quick-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }

        .action-btn {
            display: flex; flex-direction: column; align-items: center; padding: 0.75rem;
            background: #f8fafc; border: 1px solid var(--border); border-radius: 8px; gap: 0.4rem;
            text-decoration: none; color: #334155; font-size: 0.75rem; font-weight: 600; transition: all 0.2s;
        }

        .action-btn:hover { background: white; border-color: var(--primary-color); color: var(--primary-color); transform: translateY(-1px); }

        .action-btn i { font-size: 1.25rem; }

        /* Calendar */
        .mini-calendar { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; text-align: center; margin-top: 0.75rem; }

        .cal-day-name { font-size: 0.65rem; font-weight: 700; color: #94a3b8; }
        .cal-day { font-size: 0.75rem; padding: 5px 0; border-radius: 4px; color: #64748b; }
        .cal-day.active { background: var(--primary-color); color: white; font-weight: 700; }

        /* Tables */
        .mini-table { width: 100%; border-collapse: collapse; }

        .mini-table th, .mini-table td { padding: 0.75rem; text-align: left; border-bottom: 1px solid var(--border); }

        .mini-table th { font-size: 0.7rem; text-transform: uppercase; color: #64748b; font-weight: 700; background: #f8fafc; }

        .mini-table td { font-size: 0.8rem; color: #334155; }

        .status-pill { padding: 0.15rem 0.5rem; border-radius: 999px; font-size: 0.65rem; font-weight: 700; display: inline-block; }

        .pill-paid { background: #dcfce7; color: #15803d; }
        .pill-pending { background: #fef9c3; color: #a16207; }
        .pill-failed { background: #fee2e2; color: #b91c1c; }

        /* Space Usage */
        .usage-item { margin-bottom: 0.75rem; }
        .usage-info { display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 0.25rem; }
        .usage-bar-bg { height: 6px; background: #f1f5f9; border-radius: 3px; overflow: hidden; }
        .usage-bar-fill { height: 100%; background: var(--primary-color); }

        /* Responsive */
        @media (max-width: 1024px) {
            .row-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            #sidebarToggle {
                display: flex !important;
            }
            .admin-main { 
                margin-left: 0; 
                width: 100%;
            }
            .sidebar { transform: translateX(-100%); }
            .top-navbar { padding: 0 1rem; }
            .admin-body { padding: 1rem; }
        }

        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .nav-right .user-info div:first-child { display: none; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="ph-bold ph-rocket-launch"></i> SpaceAdmin</h2>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                <i class="ph ph-squares-four"></i> Dashboard
            </a>
            <a href="{{ route('admin.bookings') }}" class="menu-item">
                <i class="ph ph-calendar-check"></i> Bookings
            </a>
            <a href="{{ route('home') }}" class="menu-item">
                <i class="ph ph-globe"></i> Visit Website
            </a>
        </div>
        <div class="sidebar-footer">
            <a href="#" class="menu-item">
                <i class="ph ph-gear"></i> Settings
            </a>
        </div>
    </div>

    <main class="admin-main">
        <div class="top-navbar">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button id="sidebarToggle" class="btn btn-outline" style="display: none; width: 40px; height: 40px; padding: 0; align-items: center; justify-content: center;">
                    <i class="ph ph-list" style="font-size: 1.5rem;"></i>
                </button>
                <div style="font-weight: 700; font-size: 1.15rem; color: #1e293b;">Dashboard Overview</div>
            </div>
            <div class="nav-right">
                <div class="notification-bell">
                    <i class="ph ph-bell"></i>
                    @if($pendingBookings > 0)
                        <div class="notification-badge">{{ $pendingBookings }}</div>
                    @endif
                </div>
                <div class="user-info" style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="text-align: right;">
                        <div style="font-weight: 600; font-size: 0.85rem; color: #1e293b;">Praveen</div>
                        <div style="font-size: 0.7rem; color: #64748b;">Admin</div>
                    </div>
                    <div style="width: 34px; height: 34px; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748b;">
                        <i class="ph-fill ph-user"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-body">
            <!-- Row 1: Summary Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Total Rev</span>
                        <div class="stat-icon icon-green"><i class="ph ph-currency-inr"></i></div>
                    </div>
                    <div class="stat-value">₹{{ number_format($totalRevenue) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Today's Rev</span>
                        <div class="stat-icon icon-orange"><i class="ph ph-coins"></i></div>
                    </div>
                    <div class="stat-value">₹{{ number_format($todayRevenue) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Completed</span>
                        <div class="stat-icon icon-blue"><i class="ph ph-check-circle"></i></div>
                    </div>
                    <div class="stat-value">{{ $completedBookings }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Pending Approval</span>
                        <div class="stat-icon icon-purple"><i class="ph ph-hand-pointing"></i></div>
                    </div>
                    <div class="stat-value">{{ $pendingApprovals }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Pending Payment</span>
                        <div class="stat-icon icon-orange"><i class="ph ph-clock"></i></div>
                    </div>
                    <div class="stat-value">{{ $pendingBookings }}</div>
                </div>
            </div>

            <!-- Row 2: Revenue Chart + Quick/Calendar -->
            <div class="row-grid">
                <div class="dashboard-section">
                    <div class="section-header">
                        <h3><i class="ph-bold ph-chart-line-up" style="color: var(--primary-color);"></i> Revenue Growth</h3>
                        <div class="chart-controls">
                            <button class="chart-toggle active" onclick="switchChart('7day', this)">7D</button>
                            <button class="chart-toggle" onclick="switchChart('monthly', this)">6M</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="right-box">
                    <div class="dashboard-section" style="padding: 1rem;">
                        <div class="section-header" style="margin-bottom: 0.75rem;">
                            <h3><i class="ph-bold ph-lightning" style="color: var(--warning);"></i> Quick Actions</h3>
                        </div>
                        <div class="quick-actions">
                            <a href="{{ route('home') }}" class="action-btn">
                                <i class="ph ph-plus-circle" style="color: var(--success);"></i>
                                New
                            </a>
                            <a href="{{ route('admin.bookings') }}" class="action-btn">
                                <i class="ph ph-file-search" style="color: var(--info);"></i>
                                Reports
                            </a>
                            <a href="#" class="action-btn" onclick="alert('Export processing...')">
                                <i class="ph ph-export" style="color: var(--primary-color);"></i>
                                CSV
                            </a>
                            <a href="#" class="action-btn">
                                <i class="ph ph-users" style="color: #a855f7;"></i>
                                Admins
                            </a>
                        </div>
                    </div>

                    <div class="dashboard-section" style="padding: 1rem;">
                        <div class="section-header" style="margin-bottom: 0.5rem;">
                            <h3><i class="ph-bold ph-calendar-blank" style="color: var(--primary-color);"></i> Calendar</h3>
                        </div>
                        <div style="font-size: 0.75rem; font-weight: 700; color: #1e293b; margin-bottom: 0.25rem; text-align: center;">{{ \Carbon\Carbon::now()->format('F Y') }}</div>
                        <div class="mini-calendar">
                            <div class="cal-day-name">S</div><div class="cal-day-name">M</div><div class="cal-day-name">T</div>
                            <div class="cal-day-name">W</div><div class="cal-day-name">T</div><div class="cal-day-name">F</div><div class="cal-day-name">S</div>
                            @php
                                $startOfMonth = \Carbon\Carbon::now()->startOfMonth();
                                $daysInMonth = \Carbon\Carbon::now()->daysInMonth;
                                $dayOfWeek = $startOfMonth->dayOfWeek;
                                $today = \Carbon\Carbon::now()->day;
                            @endphp
                            @for($i = 0; $i < $dayOfWeek; $i++) <div></div> @endfor
                            @for($d = 1; $d <= $daysInMonth; $d++)
                                <div class="cal-day {{ $d == $today ? 'active' : '' }}">
                                    {{ $d }}
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Upcoming + Usage/Insights -->
            <div class="row-grid">
                <div class="dashboard-section">
                    <div class="section-header">
                        <h3><i class="ph-bold ph-calendar-check" style="color: var(--info);"></i> Upcoming Reservations</h3>
                        <a href="{{ route('admin.bookings') }}" style="font-size: 0.75rem; color: var(--primary-color); text-decoration: none; font-weight: 600;">View Full</a>
                    </div>
                    <div style="overflow-x: auto; padding: 0 1px;">
                        <table class="mini-table">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Workspace</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($upcomingBookings as $booking)
                                <tr>
                                    <td style="font-weight: 600;">{{ Str::limit($booking->name, 15) }}</td>
                                    <td>{{ $booking->room_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M') }}, {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                                    <td><span class="status-pill pill-paid">Paid</span></td>
                                </tr>
                                @empty
                                <tr><td colspan="4" style="text-align:center; padding: 1.5rem;">No upcoming bookings</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="right-box">
                    <div class="dashboard-section" style="padding: 1rem;">
                        <div class="section-header">
                            <h3><i class="ph-bold ph-chart-pie" style="color: var(--success);"></i> Space Usage</h3>
                        </div>
                        @foreach($workspaceData as $workspace)
                        <div class="usage-item">
                            <div class="usage-info">
                                <span style="font-weight: 600; font-size: 0.75rem;">{{ $workspace->room_name }}</span>
                                <span style="font-size: 0.7rem; color: #64748b;">{{ $workspace->usage_percentage }}%</span>
                            </div>
                            <div class="usage-bar-bg">
                                <div class="usage-bar-fill" style="width: {{ $workspace->usage_percentage }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="dashboard-section" style="padding: 1rem; background: #fff; border-left: 4px solid var(--primary-color);">
                        <div class="section-header" style="margin-bottom: 0.5rem;">
                            <h3 style="font-size: 0.85rem;"><i class="ph ph-info" style="color: var(--primary-color);"></i> Insights</h3>
                        </div>
                        <ul style="padding-left: 1rem; font-size: 0.75rem; color: #475569; line-height: 1.4; margin: 0;">
                            @foreach($insights as $insight)
                                <li style="margin-bottom: 0.35rem;">{{ $insight }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Row 4: Recent Bookings Table (Full Width) -->
            <div class="dashboard-section" style="margin-bottom: 2rem;">
                <div class="section-header">
                    <h3><i class="ph-bold ph-clock-counter-clockwise" style="color: var(--primary-color);"></i> Recent Bookings</h3>
                    <div style="display: flex; gap: 0.5rem;">
                        <button class="btn btn-outline" style="padding:0.35rem 0.75rem; font-size:0.7rem;"><i class="ph ph-download"></i> CSV</button>
                        <a href="{{ route('admin.bookings') }}" style="font-size: 0.8rem; color: var(--primary-color); text-decoration: none; font-weight: 600;">View All</a>
                    </div>
                </div>
                <div style="overflow-x: auto; padding: 0 1px;">
                    <table class="mini-table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Workspace</th>
                                <th>Time Slot</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $booking)
                            <tr>
                                <td style="font-weight: 600;">{{ $booking->name }}</td>
                                <td>{{ $booking->room_name }}</td>
                                <td style="color: #64748b;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M') }} | {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                                <td style="font-weight: 700;">₹{{ number_format($booking->total_price, 2) }}</td>
                                <td>
                                    <span class="status-pill pill-{{ strtolower($booking->payment_status) }}">
                                        {{ $booking->payment_status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr style="border: 0; border-top: 1px solid var(--border); margin: 2rem 0;">

            <!-- Section 1: Detailed Upcoming Bookings -->
            <div class="dashboard-section" style="margin-bottom: 1.5rem;">
                <div class="section-header">
                    <h3><i class="ph-bold ph-calendar-check" style="color: var(--info);"></i> Detailed Upcoming Bookings</h3>
                </div>
                <div style="overflow-x: auto; padding: 0 1px;">
                    <table class="mini-table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Workspace</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upcomingBookings as $booking)
                            <tr>
                                <td style="font-weight: 600;">{{ $booking->name }}</td>
                                <td>{{ $booking->room_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                                <td><span class="status-pill pill-paid">Confirmed</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="5" style="text-align:center; padding: 1.5rem;">No upcoming bookings</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section 2: Booking Status Overview -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div class="stat-card" style="padding: 1rem;">
                    <div class="stat-label" style="font-size: 0.7rem;">Paid Bookings</div>
                    <div class="stat-value" style="font-size: 1.25rem; color: var(--success);">{{ $completedBookings }}</div>
                </div>
                <div class="stat-card" style="padding: 1rem;">
                    <div class="stat-label" style="font-size: 0.7rem;">Pending Bookings</div>
                    <div class="stat-value" style="font-size: 1.25rem; color: var(--warning);">{{ $pendingBookings }}</div>
                </div>
                <div class="stat-card" style="padding: 1rem;">
                    <div class="stat-label" style="font-size: 0.7rem;">Cancelled Bookings</div>
                    <div class="stat-value" style="font-size: 1.25rem; color: var(--danger);">{{ $cancelledBookings }}</div>
                </div>
                <div class="stat-card" style="padding: 1rem;">
                    <div class="stat-label" style="font-size: 0.7rem;">Total Completed</div>
                    <div class="stat-value" style="font-size: 1.25rem; color: var(--info);">{{ $completedBookings }}</div>
                </div>
            </div>

            <!-- Section 3: Quick Admin Actions -->
            <div class="dashboard-section" style="margin-bottom: 2rem;">
                <div class="section-header">
                    <h3><i class="ph-bold ph-wrench" style="color: #64748b;"></i> Quick Admin Management</h3>
                </div>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="#" class="btn btn-primary" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; background: var(--primary-color); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem;">
                        <i class="ph ph-plus-circle"></i> Add Workspace
                    </a>
                    <a href="{{ route('admin.bookings') }}" class="btn" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; border: 1px solid var(--border); color: #1e293b; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; background: white;">
                        <i class="ph ph-calendar-check"></i> Manage Bookings
                    </a>
                    <a href="#" class="btn" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; border: 1px solid var(--border); color: #1e293b; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; background: white;">
                        <i class="ph ph-file-text"></i> Generate Report
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('open');
        });

        // Close sidebar if clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggle = document.getElementById('sidebarToggle');
            if (window.innerWidth <= 768 && 
                sidebar && toggle &&
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target) && 
                sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
            }
        });

        let revenueChart;
        const dailyData = {
            labels: {!! json_encode($dailyRevenue->pluck('date')->map(function($date) { return \Carbon\Carbon::parse($date)->format('d M'); })) !!},
            values: {!! json_encode($dailyRevenue->pluck('revenue')) !!}
        };
        const monthlyData = {
            labels: {!! json_encode($monthlyRevenue->pluck('month')->map(function($m) { return \Carbon\Carbon::parse($m)->format('M Y'); })) !!},
            values: {!! json_encode($monthlyRevenue->pluck('revenue')) !!}
        };

        document.addEventListener('DOMContentLoaded', function() {
            initChart(dailyData.labels, dailyData.values);
        });

        function initChart(labels, data) {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Revenue (₹)',
                        data: data,
                        borderColor: '#ff7a00',
                        backgroundColor: 'rgba(255, 122, 0, 0.05)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#ff7a00',
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: '#f1f5f9', drawBorder: false }, 
                            ticks: { 
                                font: { size: 10 },
                                callback: v => '₹' + v 
                            } 
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { size: 10 } }
                        }
                    }
                }
            });
        }

        function switchChart(type, btn) {
            document.querySelectorAll('.chart-toggle').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            if (type === '7day') {
                revenueChart.data.labels = dailyData.labels;
                revenueChart.data.datasets[0].data = dailyData.values;
            } else {
                revenueChart.data.labels = monthlyData.labels;
                revenueChart.data.datasets[0].data = monthlyData.values;
            }
            revenueChart.update();
        }
    </script>
</body>
</html>
