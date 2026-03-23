<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --sidebar-width: 260px;
            --admin-bg: #f4f7fa;
        }

        body {
            background-color: var(--admin-bg);
            display: flex;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
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
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-menu {
            padding: 1.5rem 0.75rem;
            flex: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 122, 0, 0.08);
            color: var(--primary-color);
        }

        .menu-item i {
            font-size: 1.25rem;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
        }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .admin-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-color);
        }

        /* Content Card */
        .content-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        /* Filter Section */
        .filter-section {
            padding: 1.5rem;
            background: #fff;
            border-bottom: 1px solid var(--border);
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
        }

        .filter-group input, .filter-group select {
            padding: 0.65rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .filter-group input:focus, .filter-group select:focus {
            border-color: var(--primary-color);
        }

        /* Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            padding: 1.25rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .data-table th {
            background: #f8fafc;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .data-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .data-table td {
            font-size: 0.9rem;
            color: #334155;
        }

        .customer-name {
            font-weight: 600;
            color: #1e293b;
        }

        .customer-id {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: normal;
        }

        .status-pill {
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .pill-paid { background: #dcfce7; color: #166534; }
        .pill-pending { background: #fef9c3; color: #854d0e; }
        .pill-failed { background: #fee2e2; color: #991b1b; }

        .btn-view {
            padding: 0.5rem 1rem;
            background: #f1f5f9;
            color: #475569;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-view:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        /* Pagination */
        .pagination-container {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .pagination-links {
            display: flex;
            gap: 0.5rem;
        }

        .pagination-btn {
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            text-decoration: none;
            color: #64748b;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .pagination-btn:hover {
            background: #f8fafc;
            color: var(--primary-color);
        }

        .pagination-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="ph-bold ph-rocket-launch"></i> SpaceAdmin</h2>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="ph ph-squares-four"></i> Dashboard
            </a>
            <a href="{{ route('admin.bookings') }}" class="menu-item active">
                <i class="ph ph-calendar-check"></i> Bookings
            </a>
            <a href="{{ route('home') }}" class="menu-item">
                <i class="ph ph-globe"></i> Visit Website
            </a>
        </div>
        <div class="sidebar-footer">
            <a href="#" class="menu-item" style="margin-bottom: 0;">
                <i class="ph ph-sign-out"></i> Logout
            </a>
        </div>
    </div>

    <main class="admin-main">
        <div class="admin-header">
            <h1>Booking Management</h1>
            <div style="display: flex; gap: 1rem;">
                <button class="btn btn-outline" style="width: auto; padding: 0.6rem 1.25rem; font-size: 0.85rem;"><i class="ph ph-file-arrow-down"></i> Export CSV</button>
            </div>
        </div>

        <div class="content-card">
            <form action="{{ route('admin.bookings') }}" method="GET" class="filter-section">
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Customer Name or Booking ID...">
                </div>
                <div class="filter-group">
                    <label>Date</label>
                    <input type="date" name="date" value="{{ request('date') }}">
                </div>
                <div class="filter-group">
                    <label>Workspace</label>
                    <select name="workspace">
                        <option value="">All Workspaces</option>
                        @foreach($workspaces as $workspace)
                            <option value="{{ $workspace }}" {{ request('workspace') == $workspace ? 'selected' : '' }}>{{ $workspace }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="">All Status</option>
                        <option value="Paid" {{ request('status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Failed" {{ request('status') == 'Failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="btn" style="width: auto; height: 42px; padding: 0 1.25rem;"><i class="ph ph-magnifying-glass"></i></button>
                    <a href="{{ route('admin.bookings') }}" class="btn btn-outline" style="width: auto; height: 42px; padding: 0 1.25rem; display: flex; align-items: center;"><i class="ph ph-arrows-clockwise"></i></a>
                </div>
            </form>

            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Workspace</th>
                            <th>Date / Time Slot</th>
                            <th>Duration</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>
                                <div class="customer-name">{{ $booking->name }}</div>
                                <div class="customer-id">{{ $booking->email }}</div>
                            </td>
                            <td>{{ $booking->room_name }}</td>
                            <td>
                                <div style="font-weight: 500;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                <div style="font-size: 0.75rem; color: #64748b;">{{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}</div>
                            </td>
                            <td>
                                @php
                                    $start = \Carbon\Carbon::parse($booking->start_time);
                                    $end = \Carbon\Carbon::parse($booking->end_time);
                                    $hours = $start->diffInHours($end);
                                @endphp
                                {{ $hours }} {{ Str::plural('Hour', $hours) }}
                            </td>
                            <td style="font-weight: 600;">₹{{ number_format($booking->total_price, 2) }}</td>
                            <td>
                                <span class="status-pill pill-{{ strtolower($booking->payment_status) }}">
                                    {{ $booking->payment_status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn-view">
                                    <i class="ph ph-eye"></i> View Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 4rem; color: #64748b;">
                                <i class="ph ph-calendar-x" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.2; display: block; margin-left: auto; margin-right: auto;"></i>
                                No bookings found matching your criteria.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($bookings->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} entries
                </div>
                <div class="pagination-links">
                    {{ $bookings->appends(request()->query())->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </main>
</body>
</html>
