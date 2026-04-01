<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin Dashboard - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        :root {
            --sidebar-width: 260px;
            --bg: #f8fafc;
            --primary: #ff7a00;
            --border: #e2e8f0;
            --text: #1e293b;
            --muted: #64748b;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            height: 100vh;
            border-right: 1px solid var(--border);
            position: fixed;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo {
            font-weight: 800;
            color: var(--text);
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-logo span { color: var(--primary); }

        .sidebar-menu {
            flex: 1;
            padding: 1rem 0.75rem;
            display: flex;
            flex-direction: column;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--muted);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            margin-bottom: 0.25rem;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 122, 0, 0.08);
            color: var(--primary);
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid var(--border);
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: none;
            border: none;
            padding: 0.75rem 1rem;
            color: var(--danger);
            cursor: pointer;
            font-weight: 600;
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: inherit;
            transition: background 0.2s;
        }

        .logout-btn:hover { background: #fef2f2; }

        /* ── Main ── */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: var(--bg);
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 90;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .topbar-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .badge-pill {
            background: rgba(255, 122, 0, 0.1);
            color: var(--primary);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            border: 1px solid rgba(255, 122, 0, 0.2);
        }

        .page-body { padding: 2rem; max-width: 1400px; }

        /* ── Welcome Banner ── */
        .welcome-banner {
            background: linear-gradient(135deg, #ff8a00 0%, #e65c00 100%);
            border-radius: 16px;
            padding: 2rem 2.5rem;
            color: white;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .welcome-banner h1 { font-size: 1.6rem; font-weight: 800; margin-bottom: 0.25rem; }
        .welcome-banner p  { opacity: 0.85; font-size: 0.95rem; }

        .welcome-stats {
            display: flex;
            gap: 2rem;
        }

        .welcome-stat {
            text-align: center;
        }

        .welcome-stat .val { font-size: 1.5rem; font-weight: 800; }
        .welcome-stat .lbl { font-size: 0.7rem; opacity: 0.8; text-transform: uppercase; letter-spacing: 0.5px; }

        /* ── Stat Cards ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .stat-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-label { font-size: 0.7rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; }
        .stat-value { font-size: 1.7rem; font-weight: 800; color: var(--text); line-height: 1.2; }
        .stat-sub   { font-size: 0.72rem; color: var(--muted); }

        .stat-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .icon-orange  { background: #fff7ed; color: #f97316; }
        .icon-green   { background: #f0fdf4; color: #22c55e; }
        .icon-blue    { background: #eff6ff; color: #3b82f6; }
        .icon-purple  { background: #faf5ff; color: #a855f7; }
        .icon-red     { background: #fef2f2; color: #ef4444; }
        .icon-yellow  { background: #fffbeb; color: #d97706; }

        /* ── Grid Layout ── */
        .row-2 { display: grid; grid-template-columns: 2fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem; }
        .row-2-equal { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem; }

        /* ── Card ── */
        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ── Chart ── */
        .chart-wrap { height: 220px; position: relative; }

        /* ── Table ── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em;
            color: var(--muted); font-weight: 700; padding: 0.6rem 0.75rem;
            background: #f8fafc; text-align: left; border-bottom: 1px solid var(--border);
        }
        .data-table td {
            font-size: 0.8rem; color: var(--text); padding: 0.7rem 0.75rem;
            border-bottom: 1px solid var(--border);
        }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #fafafa; }

        /* ── Status Pills ── */
        .pill { display: inline-block; padding: 0.15rem 0.55rem; border-radius: 999px; font-size: 0.65rem; font-weight: 700; }
        .pill-paid     { background: #dcfce7; color: #15803d; }
        .pill-pending  { background: #fef9c3; color: #a16207; }
        .pill-approved { background: #dbeafe; color: #1d4ed8; }
        .pill-rejected { background: #fee2e2; color: #b91c1c; }

        /* ── Alerts ── */
        .alert-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 0.75rem;
            font-size: 0.82rem;
            font-weight: 500;
        }
        .alert-warning { background: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
        .alert-info    { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #14532d; }

        /* ── Progress Bar ── */
        .progress-bg   { height: 6px; background: #f1f5f9; border-radius: 999px; overflow: hidden; margin-top: 4px; }
        .progress-fill { height: 100%; background: var(--primary); border-radius: 999px; }

    </style>
    @include('partials.dynamic-styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="ph-bold ph-rocket-launch"></i>
                Space<span>Admin</span>
            </div>
            <div style="font-size: 0.7rem; color: #94a3b8; margin-top: 4px; font-weight: 600;">SUPERADMIN PANEL</div>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('superadmin.dashboard') }}" class="menu-item {{ Route::is('superadmin.dashboard') ? 'active' : '' }}">
                <i class="ph ph-squares-four"></i> Overview
            </a>
            <a href="{{ route('superadmin.admins') }}" class="menu-item {{ Route::is('superadmin.admins') ? 'active' : '' }}">
                <i class="ph ph-users"></i> Manage Admins
            </a>
            <a href="{{ route('superadmin.settings') }}" class="menu-item {{ Route::is('superadmin.settings') ? 'active' : '' }}">
                <i class="ph ph-gear"></i> System Settings
            </a>
            <a href="{{ route('home') }}" class="menu-item">
                <i class="ph ph-globe"></i> Visit Site
            </a>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('superadmin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="ph-bold ph-sign-out"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button id="sidebarToggle" class="btn btn-outline" style="display: none; width: 44px; height: 44px; padding: 0; align-items: center; justify-content: center; border-radius: 12px; border: 2px solid var(--primary) !important; background: white !important; color: var(--primary) !important; box-shadow: none !important;">
                    <i class="ph ph-list" style="font-size: 1.5rem; font-weight: 800;"></i>
                </button>
                <div class="topbar-title">System Overview</div>
            </div>
            <div class="topbar-right">
                <span class="badge-pill"><i class="ph-fill ph-shield-check"></i> SuperAdmin</span>
                <div style="font-size: 0.8rem; color: var(--muted);">{{ now()->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="page-body">


            <!-- Stat Cards Row -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-label">Total Revenue</span>
                        <div class="stat-icon icon-green"><i class="ph ph-currency-inr"></i></div>
                    </div>
                    <div class="stat-value">₹{{ number_format($totalRevenue) }}</div>
                    <div class="stat-sub">All paid bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-label">This Month</span>
                        <div class="stat-icon icon-orange"><i class="ph ph-trend-up"></i></div>
                    </div>
                    <div class="stat-value">₹{{ number_format($monthRevenue) }}</div>
                    <div class="stat-sub">
                        @if($revenueGrowth !== null)
                            <span style="color: {{ $revenueGrowth >= 0 ? '#22c55e' : '#ef4444' }}; font-weight: 700;">
                                {{ $revenueGrowth >= 0 ? '+' : '' }}{{ $revenueGrowth }}%
                            </span> vs last month
                        @else
                            First month of data
                        @endif
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-label">Today Revenue</span>
                        <div class="stat-icon icon-blue"><i class="ph ph-coins"></i></div>
                    </div>
                    <div class="stat-value">₹{{ number_format($todayRevenue) }}</div>
                    <div class="stat-sub">Paid today</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-label">Paid Bookings</span>
                        <div class="stat-icon icon-green"><i class="ph ph-check-circle"></i></div>
                    </div>
                    <div class="stat-value">{{ $paidBookings }}</div>
                    <div class="stat-sub">Payment confirmed</div>
                </div>
                <div class="stat-card" style="border-left: 3px solid var(--warning);">
                    <div class="stat-card-header">
                        <span class="stat-label">Pending Approval</span>
                        <div class="stat-icon icon-yellow"><i class="ph ph-hourglass"></i></div>
                    </div>
                    <div class="stat-value">{{ $pendingApprovals }}</div>
                    <div class="stat-sub">Awaiting principal</div>
                </div>
                <div class="stat-card" style="border-left: 3px solid var(--info);">
                    <div class="stat-card-header">
                        <span class="stat-label">Principal Approved</span>
                        <div class="stat-icon icon-blue"><i class="ph ph-check-square"></i></div>
                    </div>
                    <div class="stat-value">{{ $principalApprovals }}</div>
                    <div class="stat-sub">Needs admin final action</div>
                </div>
            </div>

            <!-- Row: Revenue Chart + Alerts -->
            <div class="row-2" style="margin-bottom: 1.5rem;">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="ph-bold ph-chart-line-up" style="color: var(--primary);"></i>
                            Revenue Trend (Last 6 Months)
                        </div>
                    </div>
                    <div class="chart-wrap">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="ph-bold ph-warning-circle" style="color: var(--warning);"></i>
                            System Alerts
                        </div>
                    </div>
                    @foreach($alerts as $alert)
                        <div class="alert-item alert-{{ $alert['type'] }}">
                            <i class="ph ph-{{ $alert['type'] === 'success' ? 'check-circle' : ($alert['type'] === 'warning' ? 'warning' : 'info') }}" style="font-size: 1rem; flex-shrink:0; margin-top:1px;"></i>
                            {{ $alert['msg'] }}
                        </div>
                    @endforeach

                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                        <div style="font-size: 0.75rem; font-weight: 700; color: var(--muted); margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Booking Status Summary</div>
                        @php $total = max($totalSystemBookings, 1); @endphp
                        @foreach([
                            ['label' => 'Approved', 'count' => $approvedBookings, 'color' => '#22c55e'],
                            ['label' => 'Pending',  'count' => $pendingApprovals, 'color' => '#f59e0b'],
                            ['label' => 'Rejected', 'count' => $rejectedBookings, 'color' => '#ef4444'],
                        ] as $row)
                        <div style="margin-bottom: 0.6rem;">
                            <div style="display:flex; justify-content:space-between; font-size:0.78rem; margin-bottom:3px;">
                                <span style="font-weight:600;">{{ $row['label'] }}</span>
                                <span style="color:var(--muted);">{{ $row['count'] }} / {{ $total }}</span>
                            </div>
                            <div class="progress-bg">
                                <div class="progress-fill" style="width: {{ round(($row['count']/$total)*100) }}%; background: {{ $row['color'] }};"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Row: Top Rooms + Booking Status -->
            <div class="row-2-equal">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="ph-bold ph-buildings" style="color: var(--primary);"></i>
                            Top Rooms by Bookings
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Room</th>
                                    <th>Bookings</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topRooms as $i => $room)
                                <tr>
                                    <td style="color: var(--muted);">{{ $i + 1 }}</td>
                                    <td style="font-weight: 600;">{{ $room->room_name }}</td>
                                    <td>{{ $room->total }}</td>
                                    <td style="font-weight: 700; color: var(--primary);">₹{{ number_format($room->revenue) }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" style="text-align:center; padding:1.5rem; color:var(--muted);">No data yet</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="ph-bold ph-chart-pie" style="color: var(--primary);"></i>
                            Payment Status Breakdown
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                        @foreach([
                            ['label' => 'Paid',     'val' => $paidBookings,     'icon' => 'check-circle', 'color' => '#22c55e', 'bg' => '#f0fdf4'],
                            ['label' => 'Pending Payment', 'val' => $pendingPayments,  'icon' => 'clock', 'color' => '#f59e0b', 'bg' => '#fffbeb'],
                            ['label' => 'Approved', 'val' => $approvedBookings, 'icon' => 'check-square', 'color' => '#3b82f6', 'bg' => '#eff6ff'],
                            ['label' => 'Rejected', 'val' => $rejectedBookings, 'icon' => 'x-circle',  'color' => '#ef4444', 'bg' => '#fef2f2'],
                        ] as $s)
                        <div style="background: {{ $s['bg'] }}; border-radius: 10px; padding: 1rem; text-align: center;">
                            <i class="ph ph-{{ $s['icon'] }}" style="font-size: 1.5rem; color: {{ $s['color'] }};"></i>
                            <div style="font-size: 1.4rem; font-weight: 800; color: var(--text); margin-top: 0.25rem;">{{ $s['val'] }}</div>
                            <div style="font-size: 0.65rem; font-weight: 700; color: var(--muted); text-transform: uppercase;">{{ $s['label'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Bookings (Full Width) -->
            <div class="card" style="margin-bottom: 2rem;">
                <div class="card-header">
                    <div class="card-title">
                        <i class="ph-bold ph-clock-counter-clockwise" style="color: var(--primary);"></i>
                        Recent Bookings
                    </div>
                    <a href="{{ route('admin.bookings') }}" style="font-size: 0.78rem; color: var(--primary); text-decoration: none; font-weight: 700;">View All →</a>
                </div>
                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Guest Name</th>
                                <th>Room</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Approval</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $b)
                            <tr>
                                <td style="font-weight: 600;">{{ $b->name }}</td>
                                <td>{{ $b->room_name }}</td>
                                <td style="color: var(--muted);">{{ \Carbon\Carbon::parse($b->booking_date)->format('d M Y') }}</td>
                                <td style="font-weight: 700;">₹{{ number_format($b->total_price, 2) }}</td>
                                <td>
                                    <span class="pill pill-{{ strtolower(str_replace(' ', '-', $b->approval_status)) }}
                                        {{ $b->approval_status === 'Approved' ? 'pill-approved' : ($b->approval_status === 'Rejected' ? 'pill-rejected' : 'pill-pending') }}">
                                        {{ $b->approval_status }}
                                    </span>
                                </td>
                                <td>
                                    <span class="pill {{ $b->payment_status === 'Paid' ? 'pill-paid' : 'pill-pending' }}">
                                        {{ $b->payment_status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align:center; padding: 2rem; color: var(--muted);">No bookings yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                sidebar.classList.toggle('open');
            });
        }

        document.addEventListener('click', (event) => {
            if (window.innerWidth <= 1024 && sidebar && sidebar.classList.contains('open')) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle && sidebarToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnToggle) {
                    sidebar.classList.remove('open');
                }
            }
        });

        // Revenue Chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyRevenue->pluck('month')->map(fn($m) => \Carbon\Carbon::parse($m)->format('M Y'))) !!},
                datasets: [{
                    label: 'Revenue (₹)',
                    data: {!! json_encode($monthlyRevenue->pluck('revenue')) !!},
                    backgroundColor: `rgba(${window.primaryColorRGB}, 0.85)`,
                    borderRadius: 6,
                    borderSkipped: false,
                }, {
                    label: 'Bookings',
                    data: {!! json_encode($monthlyRevenue->pluck('count')) !!},
                    type: 'line',
                    borderColor: '#3b82f6',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    pointBackgroundColor: '#3b82f6',
                    pointRadius: 4,
                    yAxisID: 'y2',
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top', labels: { font: { size: 11 }, boxWidth: 12 } }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { font: { size: 10 }, callback: v => '₹' + v.toLocaleString() }
                    },
                    y2: {
                        beginAtZero: true,
                        position: 'right',
                        grid: { display: false },
                        ticks: { font: { size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10 } }
                    }
                }
            }
        });
    </script>
</body>
</html>
