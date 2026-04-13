<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Reports - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        :root {
            --sidebar-width: 260px;
            --bg-color: #f8fafc;
            --primary-color: #ff7a00; /* Fallback */
            --border: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        * {
            box-sizing: border-box;
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

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo {
            font-weight: 800;
            color: var(--text-main);
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-logo span { color: var(--primary-color); }

        .sidebar-menu {
            padding: 1rem 0.75rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }

        .menu-item:hover {
            background: rgba(255, 122, 0, 0.08);
            color: var(--primary-color);
        }

        .menu-item.active {
            background: rgba(255, 122, 0, 0.1);
            color: var(--primary-color);
            font-weight: 600;
            border-left: 3px solid var(--primary-color);
            padding-left: calc(1rem - 3px);
        }

        .menu-item i {
            font-size: 1.25rem;
        }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            width: calc(100% - var(--sidebar-width));
            min-width: 0;
            transition: all 0.3s ease;
        }

        .top-navbar {
            height: 68px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .admin-body {
            padding: 2rem 2.5rem;
        }

        /* Report Controls */
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .filter-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid var(--border);
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
        }

        .filter-form .form-group {
            flex: 1;
            min-width: 150px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .form-input {
            padding: 0.6rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            color: var(--text-main);
            outline: none;
            transition: border 0.2s;
        }

        .form-input:focus {
            border-color: var(--primary-color);
        }

        .btn-download {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }

        /* Table Styles */
        .report-table-container {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: #f8fafc;
            padding: 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
        }

        .status-pill {
            padding: 0.25rem 0.75rem;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .pill-pending { background: #fff7ed; color: #c2410c; }
        .pill-approved { background: #f0fdf4; color: #15803d; }
        .pill-rejected { background: #fef2f2; color: #b91c1c; }
    </style>
    @include('partials.dynamic-styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo"><i class="ph-bold ph-rocket-launch"></i> Space<span>Admin</span></div>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="ph ph-squares-four"></i> Dashboard
            </a>
            <a href="{{ route('admin.bookings') }}" class="menu-item">
                <i class="ph ph-calendar-check"></i> Bookings
            </a>
            <a href="{{ route('admin.reports') }}" class="menu-item active">
                <i class="ph ph-file-text"></i> Reports
            </a>
            <a href="{{ route('home') }}" class="menu-item" target="_blank">
                <i class="ph ph-globe"></i> Visit Website
            </a>
            <div style="margin-top: auto; padding: 1.5rem; border-top: 1px solid rgba(0,0,0,0.05);">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="width: 100%; display: flex; align-items: center; gap: 0.75rem; background: none; border: none; padding: 0.75rem 1rem; color: #ef4444; cursor: pointer; font-weight: 600; border-radius: 8px;">
                        <i class="ph-bold ph-sign-out" style="font-size: 1.25rem;"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <main class="admin-main">
        <div class="top-navbar">
            <div style="font-weight: 700; font-size: 1.1rem; color: var(--text-main);">Booking Reports</div>
        </div>

        <div class="admin-body">
            <!-- Financial Summary Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border); box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="color: var(--text-muted); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Total Revenue</div>
                    <div style="font-size: 1.5rem; font-weight: 800; color: var(--primary-color);">₹{{ number_format($totalRevenue, 2) }}</div>
                </div>
                <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border); box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="color: var(--text-muted); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Net Revenue (Excl. GST)</div>
                    <div style="font-size: 1.5rem; font-weight: 800; color: #1e293b;">₹{{ number_format($netRevenue, 2) }}</div>
                </div>
                <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border); box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="color: var(--text-muted); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Total GST Collected ({{ $gstRate }}%)</div>
                    <div style="font-size: 1.5rem; font-weight: 800; color: #64748b;">₹{{ number_format($totalGst, 2) }}</div>
                </div>
            </div>

            <div class="filter-card">
                <form action="{{ route('admin.reports') }}" method="GET" class="filter-form">
                    <div class="form-group">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-input" value="{{ request('start_date') }}" style="height: 48px;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-input" value="{{ request('end_date') }}" style="height: 48px;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn-download" style="background: var(--text-main); height: 48px;">
                            <i class="ph ph-funnel"></i> Apply Filter
                        </button>
                    </div>
                    @if(count($bookings) > 0)
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <a href="{{ route('admin.reports.download', request()->all()) }}" class="btn-download" style="height: 48px;">
                            <i class="ph ph-file-pdf"></i> Download PDF Report
                        </a>
                    </div>
                    @endif
                </form>
            </div>

            <div class="report-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Guest Details</th>
                            <th>Room / Slot</th>
                            <th>Base Price</th>
                            <th>GST ({{ $gstRate }}%)</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                        @php
                            $bGstFactor = 1 + ($gstRate / 100);
                            $bSubtotal = $b->total_price / $bGstFactor;
                            $bGstAmount = $b->total_price - $bSubtotal;
                        @endphp
                        <tr>
                            <td style="font-weight: 600;">BK-{{ str_pad($b->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div style="font-weight: 600;">{{ $b->name }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $b->email }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 600;">{{ str_replace('-', ' ', ucwords($b->room_name, '- ')) }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ \Carbon\Carbon::parse($b->booking_date)->format('d M Y') }}</div>
                            </td>
                            <td style="color: #64748b;">₹{{ number_format($bSubtotal, 2) }}</td>
                            <td style="color: #64748b;">₹{{ number_format($bGstAmount, 2) }}</td>
                            <td style="font-weight: 700; color: var(--text-main);">₹{{ number_format($b->total_price, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                                No records found for the selected period.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
