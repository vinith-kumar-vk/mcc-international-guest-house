<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        :root {
            --sidebar-width: 260px;
            --admin-bg: #f4f7fa;
            --primary-color: #ff7a00;
            --border: #e2e8f0;
            --text-color: #1e293b;
            --text-light: #64748b;
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

        * {
            box-sizing: border-box;
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

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
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
            display: flex;
            flex-direction: column;
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
            width: calc(100% - var(--sidebar-width));
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .admin-main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .admin-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-color);
            margin: 0;
        }

        /* Content Card */
        .content-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            margin-bottom: 2rem;
        }

        /* Filter Section */
        .filter-section {
            padding: 1.5rem;
            background: #fff;
            border-bottom: 1px solid var(--border);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            align-items: end;
        }

        @media (max-width: 640px) {
            .filter-section {
                grid-template-columns: 1fr;
            }
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
            text-align: left;
            padding: 1.25rem 1rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            color: #64748b;
            font-weight: 700;
            border-bottom: 2px solid #f1f5f9;
            white-space: nowrap;
        }

        .data-table td {
            font-size: 0.9rem;
            color: #334155;
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
            white-space: nowrap;
            display: inline-block;
        }

        .pill-paid { background: #dcfce7; color: #166534; }
        .pill-pending { background: #fef9c3; color: #854d0e; }
        .pill-failed { background: #fee2e2; color: #991b1b; }
        .pill-approved { background: #dcfce7; color: #166534; }
        .pill-principal-approved { background: #d1fae5; color: #065f46; border: 1px solid #059669; }
        .pill-rejected { background: #fee2e2; color: #991b1b; }

        .btn-approve {
            padding: 0.5rem 0.75rem;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-reject {
            padding: 0.5rem 0.75rem;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-approve:hover { background: #218838; }
        .btn-reject:hover { background: #c82333; }

        .btn-view {
            padding: 0.5rem 0.75rem;
            background: #f1f5f9;
            color: #334155;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
        }

        .btn-view:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-delete {
            padding: 0.5rem 0.75rem;
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: #ffe4e6;
            color: #9f1239;
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
    @include('partials.dynamic-styles')
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
        <div class="sidebar-footer" style="margin-top: auto; border-top: 1px solid var(--border); padding: 1rem;">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; color: #ef4444; margin: 0;">
                    <i class="ph ph-sign-out"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <main class="admin-main">
        <div class="admin-header">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button id="sidebarToggle" class="btn btn-outline" style="display: none; width: 40px; height: 40px; padding: 0; align-items: center; justify-content: center;">
                    <i class="ph ph-list" style="font-size: 1.5rem;"></i>
                </button>
                <h1>Booking Management</h1>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <a href="{{ route('admin.bookings.export', request()->only(['search','date','status','workspace'])) }}"
                   style="display: inline-flex; align-items: center; gap: 0.5rem;
                          background: #16a34a; color: #ffffff;
                          padding: 0.65rem 1.4rem;
                          border-radius: 10px;
                          font-weight: 700; font-size: 0.85rem;
                          text-decoration: none;
                          letter-spacing: 0.3px;
                          box-shadow: 0 2px 8px rgba(22,163,74,0.25);
                          transition: background 0.2s ease, box-shadow 0.2s ease;">
                    <i class="ph-bold ph-file-arrow-down" style="font-size: 1rem;"></i>
                    Export CSV
                </a>
            </div>
        </div>

        <style>
            @media (max-width: 768px) {
                #sidebarToggle {
                    display: flex !important;
                }
            }
        </style>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

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

            <div style="overflow-x: auto; padding: 0 1px;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Workspace</th>
                            <th>Date / Time Slot</th>
                            <th>Approval Status</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <div>
                                        <div class="customer-name">{{ $booking->name }}</div>
                                        <div class="customer-id">{{ $booking->email }}</div>
                                    </div>
                                    @if($booking->referral_attachment)
                                        <i class="ph-bold ph-paperclip" style="color: var(--primary-color);" title="Has Referral Attachment"></i>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $booking->room_name }}</td>
                            <td style="white-space: nowrap;">
                                <div style="font-weight: 600; color: #1e293b;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                <div style="font-size: 0.75rem; color: #64748b;">
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                                </div>
                            </td>
                            <td>
                                <span class="status-pill pill-{{ str_replace(' ', '-', strtolower($booking->approval_status)) }}">
                                    {{ $booking->approval_status }}
                                </span>
                            </td>
                            <td>
                                <span class="status-pill pill-{{ strtolower($booking->payment_status) }}">
                                    {{ $booking->payment_status }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; align-items: center;">
                                    @if($booking->approval_status === 'Pending' || $booking->approval_status === 'Principal Approved')
                                        <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-approve">
                                                <i class="ph-bold ph-check"></i> 
                                                {{ $booking->approval_status === 'Principal Approved' ? 'Final Approve' : 'Approve' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-reject">
                                                <i class="ph-bold ph-x"></i> Reject
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn-view">
                                        <i class="ph ph-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking permanently?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="ph ph-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
    <script>
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
    </script>
</body>
</html>
