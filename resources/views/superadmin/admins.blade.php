<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins - SuperAdmin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        :root {
            --sidebar-width: 260px;
            --bg-color: #f8fafc;
            --primary-color: #ff7a00;
            --border: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --success: #22c55e;
            --danger: #ef4444;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-color); display: flex; min-height: 100vh; }

        .sidebar {
            width: var(--sidebar-width); background: white; height: 100vh;
            border-right: 1px solid var(--border); position: fixed;
            display: flex; flex-direction: column; z-index: 100;
        }
        .sidebar-header { padding: 1.5rem; border-bottom: 1px solid var(--border); }
        .sidebar-logo { font-weight: 800; color: var(--text-main); font-size: 1.15rem; display: flex; align-items: center; gap: 0.5rem; }
        .sidebar-logo span { color: var(--primary-color); }
        .sidebar-menu { flex: 1; padding: 1rem 0.75rem; }
        .menu-item {
            display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem;
            color: var(--text-muted); text-decoration: none; border-radius: 8px;
            font-weight: 500; font-size: 0.9rem; transition: all 0.2s; margin-bottom: 0.25rem;
        }
        .menu-item:hover, .menu-item.active { background: rgba(255, 122, 0, 0.08); color: var(--primary-color); }
        .sidebar-footer { padding: 1rem; border-top: 1px solid var(--border); }
        .logout-btn {
            width: 100%; display: flex; align-items: center; gap: 0.75rem; background: none; border: none;
            padding: 0.75rem 1rem; color: var(--danger); cursor: pointer; font-weight: 600; border-radius: 8px; font-size: 0.9rem;
        }

        .main-content { 
            margin-left: var(--sidebar-width); 
            flex: 1; 
            min-height: 100vh;
            background: var(--bg-color);
            display: flex;
            flex-direction: column;
        }
        .topbar {
            height: 72px; background: white; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;
            position: sticky; top: 0; z-index: 90;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .page-body { padding: 2.5rem; max-width: 1400px; width: 100%; box-sizing: border-box; }
        .topbar-right { display: flex; align-items: center; gap: 1rem; }

        .card { background: white; border: 1px solid var(--border); border-radius: 14px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--text-main); }

        .btn {
            padding: 0.6rem 1.25rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem;
            cursor: pointer; transition: all 0.2s; border: none; display: inline-flex; align-items: center; gap: 0.5rem;
        }
        .btn-primary { background: var(--primary-color); color: white; }
        .btn-primary:hover { background: #e66d00; transform: translateY(-1px); }
        .btn-outline { background: white; border: 1px solid var(--border); color: var(--text-muted); }
        .btn-outline:hover { background: #f8fafc; color: var(--text-main); }
        .btn-danger { background: #fef2f2; color: var(--danger); }
        .btn-danger:hover { background: #fee2e2; }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em;
            color: var(--text-muted); font-weight: 700; padding: 0.75rem 1rem;
            background: #f8fafc; text-align: left; border-bottom: 1px solid var(--border);
        }
        .data-table td { padding: 1rem; border-bottom: 1px solid var(--border); font-size: 0.9rem; }
        
        /* Modal */
        .modal {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 1000;
        }
        .modal.active { display: flex; }
        .modal-content { background: white; padding: 2rem; border-radius: 16px; width: 100%; max-width: 450px; position: relative; }
        .modal-close { position: absolute; top: 1rem; right: 1rem; cursor: pointer; font-size: 1.5rem; color: var(--text-muted); }
        
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.5rem; }
        .form-control {
            width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--border); border-radius: 8px;
            font-family: inherit; font-size: 0.95rem; outline: none; transition: border-color 0.2s;
        }
        .form-control:focus { border-color: var(--primary); }

        .alert { padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 500; }
        .alert-success { background: #f0fdf4; color: #14532d; border: 1px solid #bbf7d0; }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            #sidebarToggle { display: flex !important; }
            .page-body { padding: 1rem; }
            .card { padding: 1rem; overflow: hidden; }
            .card-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .btn-primary { width: 100%; justify-content: center; }
            .topbar { padding: 0 1rem; height: 68px; }
            .topbar-right { display: none; }
        }
    </style>
    @include('partials.dynamic-styles')
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo"><i class="ph-bold ph-rocket-launch"></i> Space<span>Admin</span></div>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('superadmin.dashboard') }}" class="menu-item">
                <i class="ph ph-squares-four"></i> Overview
            </a>
            <a href="{{ route('superadmin.admins') }}" class="menu-item active">
                <i class="ph ph-users"></i> Manage Admins
            </a>
            <a href="{{ route('superadmin.settings') }}" class="menu-item">
                <i class="ph ph-gear"></i> System Settings
            </a>
            <a href="{{ route('home') }}" class="menu-item" target="_blank" rel="noopener noreferrer">
                <i class="ph ph-globe"></i> Visit Site
            </a>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('superadmin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i class="ph-bold ph-sign-out"></i> Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button id="sidebarToggle" class="btn btn-outline" style="display: none; width: 44px; height: 44px; padding: 0; align-items: center; justify-content: center; border-radius: 12px; border: 2px solid var(--primary) !important; background: white !important; color: var(--primary) !important; box-shadow: none !important;">
                    <i class="ph ph-list" style="font-size: 1.5rem; font-weight: 800;"></i>
                </button>
                <div style="font-weight: 700; font-size: 1.15rem; color: var(--text-main);">Manage Admin Accounts</div>
            </div>
            <div class="topbar-right">
                <div title="Current Theme Color" style="
                    width: 14px; height: 14px;
                    border-radius: 50%;
                    background: var(--primary-color, var(--primary));
                    border: 2px solid rgba(255,255,255,0.4);
                    box-shadow: 0 0 0 2px var(--primary-color, var(--primary));
                    flex-shrink: 0;
                "></div>
                <div style="font-size: 0.82rem; color: var(--muted); font-weight: 500;">{{ now()->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="page-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Admin Users</h2>
                    <button class="btn btn-primary" onclick="openModal('addAdminModal')">
                        <i class="ph-bold ph-plus"></i> Add New Admin
                    </button>
                </div>

                <div style="overflow-x: auto; width: 100%; -webkit-overflow-scrolling: touch;">
                    <table class="data-table" style="min-width: 600px;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td style="font-weight: 600;">{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td style="color: var(--muted);">{{ $admin->created_at->format('d M Y') }}</td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button class="btn btn-outline" 
                                                onclick="editAdmin({{ $admin->id }}, '{{ $admin->name }}', '{{ $admin->email }}')">
                                            <i class="ph ph-pencil-simple"></i>
                                        </button>
                                        <form action="{{ route('superadmin.admins.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Remove this admin?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="ph ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Admin Modal -->
    <div id="addAdminModal" class="modal">
        <div class="modal-content">
            <i class="ph ph-x modal-close" onclick="closeModal('addAdminModal')"></i>
            <h2 style="margin-bottom: 1.5rem;">Add New Admin</h2>
            <form action="{{ route('superadmin.admins.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Admin Name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@example.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem; padding: 0.8rem;">
                    Create Admin Account
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div id="editAdminModal" class="modal">
        <div class="modal-content">
            <i class="ph ph-x modal-close" onclick="closeModal('editAdminModal')"></i>
            <h2 style="margin-bottom: 1.5rem;">Edit Admin Credentials</h2>
            <form id="editForm" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" id="edit_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">New Password (Leave blank to keep current)</label>
                    <input type="password" name="password" class="form-control" placeholder="Update password if needed">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem; padding: 0.8rem;">
                    Save Changes
                </button>
            </form>
        </div>
    </div>

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
            if (window.innerWidth <= 1024 && sidebar && sidebar.classList.contains('open')) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle && sidebarToggle.contains(event.target);
                if (!isClickInsideSidebar && !isClickOnToggle) {
                    sidebar.classList.remove('open');
                }
            }
        });

        function openModal(id) { document.getElementById(id).classList.add('active'); }
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }

        function editAdmin(id, name, email) {
            document.getElementById('editForm').action = "/superadmin/admins/" + id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            openModal('editAdminModal');
        }
    </script>
</body>
</html>
