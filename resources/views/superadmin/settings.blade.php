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
            --sidebar-width: 260px;
            --bg-color: #f8fafc;
            --primary-color: {{ $settings['primary_color'] ?? '#ff7a00' }};
            --secondary-color: {{ $settings['secondary_color'] ?? '#001a33' }};
            --border: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --success: #22c55e;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }

        body {
            background-color: var(--bg-color);
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
    @include('partials.dynamic-styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo"><i class="ph-bold ph-rocket-launch"></i> Space<span>Admin</span></div>
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
            <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">
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
        <div class="topbar-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; background: white; padding: 1rem 2rem; border-bottom: 1px solid var(--border); margin: 0 -2.5rem 2.5rem -2.5rem; position: sticky; top: 0; z-index: 90;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button id="sidebarToggle" class="btn btn-outline" style="display: none; width: 42px; height: 42px; padding: 0; align-items: center; justify-content: center; transform: none !important; border: 1px solid var(--border) !important;">
                    <i class="ph ph-list" style="font-size: 1.5rem;"></i>
                </button>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <i class="ph ph-gear-six" style="font-size: 1.5rem; color: var(--primary-color);"></i>
                    <h1 style="font-size: 1.25rem; margin: 0; color: #1e293b; font-weight: 700;">System Configuration</h1>
                </div>
            </div>
            <div class="topbar-right" style="display: flex; align-items: center; gap: 1rem;">
                <div title="Current Theme Color" style="
                    width: 14px; height: 14px;
                    border-radius: 50%;
                    background: var(--primary-color);
                    border: 2px solid rgba(255,255,255,0.4);
                    box-shadow: 0 0 0 2px var(--primary-color);
                    flex-shrink: 0;
                "></div>
                <div style="font-size: 0.82rem; color: #64748b; font-weight: 500;">{{ now()->format('d M Y, H:i') }}</div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="settings-card">
            <form action="{{ route('superadmin.settings.update') }}" method="POST">
                @csrf
                <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
                    <i class="ph-bold ph-envelope" style="color: var(--primary-color);"></i> Mail Service Configuration
                </h3>

                <div class="form-group">
                    <label>System Email Address (Sender)</label>
                    <input type="email" name="system_email" value="{{ $settings['sender_email'] ?? '' }}" required placeholder="e.g. user@gmail.com">
                </div>

                <div class="form-group">
                    <label>Mail Password / App Password</label>
                    <input type="password" name="mail_password" value="{{ $settings['mail_password'] ?? '' }}" required placeholder="•••• •••• •••• ••••">
                    <div style="font-size: 0.75rem; color: #64748b; margin-top: 5px;">
                        <i class="ph ph-shield-check"></i> This password is encrypted for security.
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Mail Host</label>
                        <input type="text" name="mail_host" value="{{ $settings['mail_host'] ?? 'smtp.gmail.com' }}" required placeholder="e.g. smtp.gmail.com">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Mail Port</label>
                        <input type="number" name="mail_port" value="{{ $settings['mail_port'] ?? '587' }}" required placeholder="e.g. 587">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Mail Encryption</label>
                        <select name="mail_encryption" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--border); border-radius: 8px; font-size: 1rem; color: #1e293b;">
                            <option value="tls" {{ ($settings['mail_encryption'] ?? 'tls') == 'tls' ? 'selected' : '' }}>TLS</option>
                            <option value="ssl" {{ ($settings['mail_encryption'] ?? 'tls') == 'ssl' ? 'selected' : '' }}>SSL</option>
                            <option value="none" {{ ($settings['mail_encryption'] ?? 'tls') == 'none' ? 'selected' : '' }}>None</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Mail Driver / Mailer</label>
                        <select name="mail_mailer" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--border); border-radius: 8px; font-size: 1rem; color: #1e293b;">
                            <option value="smtp" {{ ($settings['mail_mailer'] ?? 'smtp') == 'smtp' ? 'selected' : '' }}>SMTP (Default)</option>
                            <option value="sendmail" {{ ($settings['mail_mailer'] ?? 'smtp') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                            <option value="log" {{ ($settings['mail_mailer'] ?? 'smtp') == 'log' ? 'selected' : '' }}>Log (Testing)</option>
                        </select>
                    </div>
                </div>

                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 1rem; margin-bottom: 2rem; font-size: 0.85rem; color: #166534;">
                    <i class="ph-fill ph-check-circle"></i> <strong>Configuration Active:</strong> These credentials will be used for <strong>all outgoing system emails</strong> including approvals and notifications.
                </div>

                    <h3 style="font-size: 1.1rem; color: #1e293b; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
                        <i class="ph-bold ph-palette" style="color: var(--primary-color);"></i> Appearance & Branding
                    </h3>

                    <!-- Primary Color (Always On) -->
                    <div class="form-group" style="margin-bottom: 2rem; background: #fff; padding: 1.25rem; border: 1px solid #e2e8f0; border-radius: 12px;">
                        <label style="color: #1e293b; font-weight: 700; margin-bottom: 0.75rem; display: block;">Global Primary Color</label>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <input type="color" name="primary_color" value="{{ $settings['primary_color'] ?? '#ff7a00' }}" style="width: 50px; height: 50px; padding: 2px; cursor: pointer; border: 2px solid #e2e8f0; border-radius: 10px;">
                            <input type="text" id="colorCode" value="{{ $settings['primary_color'] ?? '#ff7a00' }}" readonly style="flex: 1; background: #f8fafc; border: 1px solid #e2e8f0; font-family: monospace; color: #64748b; font-size: 0.95rem; font-weight: 600;">
                        </div>
                        <div style="font-size: 0.75rem; color: #64748b; margin-top: 10px;">
                            <i class="ph ph-info"></i> This is the main theme color used for buttons, links, and icons throughout the site.
                        </div>
                    </div>

                    <!-- Secondary Color (Optional Toggle) -->
                    <div style="padding: 1.5rem; background: #f8fafc; border: 2px dashed #e2e8f0; border-radius: 16px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 0.95rem; color: #1e293b; font-weight: 700;">
                                <input type="checkbox" name="use_secondary_color" id="useSecondaryToggle" {{ ($settings['use_secondary_color'] ?? '0') == '1' ? 'checked' : '' }} style="width: 18px !important; height: 18px !important; accent-color: var(--primary-color);">
                                Enable Secondary Complementary Theme
                            </label>
                            <span class="badge" id="themeStatusBadge" style="{{ ($settings['use_secondary_color'] ?? '0') == '1' ? 'background:#dcfce7;color:#166534;' : 'background:#f1f5f9;color:#64748b;' }}">
                                {{ ($settings['use_secondary_color'] ?? '0') == '1' ? 'Active' : 'Disabled' }}
                            </span>
                        </div>

                        <div id="secondaryColorSection" style="{{ ($settings['use_secondary_color'] ?? '0') == '1' ? '' : 'opacity: 0.5; pointer-events: none;' }}">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: #475569;">Accent Secondary Color</label>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <input type="color" name="secondary_color" value="{{ $settings['secondary_color'] ?? '#001a33' }}" style="width: 42px; height: 42px; padding: 2px; cursor: pointer; border: 2px solid #e2e8f0; border-radius: 8px;">
                                    <input type="text" id="secondaryColorCode" value="{{ $settings['secondary_color'] ?? '#001a33' }}" readonly style="flex: 1; background: #fff; border: 1px solid #e2e8f0; font-family: monospace; color: #64748b; font-size: 0.85rem;">
                                </div>
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 12px; font-style: italic;">
                                    <i class="ph ph-magic-wand"></i> The secondary color creates structural depth by applying it to the main footer and header borders.
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 style="font-size: 1.1rem; color: #1e293b; margin: 2rem 0 1.5rem 0; display: flex; align-items: center; gap: 0.5rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
                        <i class="ph-bold ph-coins" style="color: var(--primary-color);"></i> Financial & Tax Configuration
                    </h3>

                    <div class="form-group" style="margin-bottom: 2rem; background: #fff; padding: 1.25rem; border: 1px solid #e2e8f0; border-radius: 12px; max-width: 300px;">
                        <label style="color: #1e293b; font-weight: 700; margin-bottom: 0.75rem; display: block;">Default GST Rate (%)</label>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <input type="number" name="gst_rate" value="{{ $settings['gst_rate'] ?? '5' }}" step="0.1" min="0" max="100" style="flex: 1; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; font-weight: 700; font-size: 1.25rem; text-align: center;">
                            <span style="font-weight: 800; color: #64748b; font-size: 1.25rem;">%</span>
                        </div>
                        <div style="font-size: 0.75rem; color: #64748b; margin-top: 10px;">
                            <i class="ph ph-info"></i> This rate will be used to calculate GST for all room bookings.
                        </div>
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

        // Color Sync
        const colorInput = document.querySelector('input[name="primary_color"]');
        const colorCode = document.getElementById('colorCode');
        const secondaryInput = document.querySelector('input[name="secondary_color"]');
        const secondaryCode = document.getElementById('secondaryColorCode');
        
        if (colorInput && colorCode) {
            colorInput.addEventListener('input', (e) => {
                colorCode.value = e.target.value.toUpperCase();
            });
        }
        if (secondaryInput && secondaryCode) {
            secondaryInput.addEventListener('input', (e) => {
                secondaryCode.value = e.target.value.toUpperCase();
            });
        }

        const useSecondaryToggle = document.getElementById('useSecondaryToggle');
        const secondarySection = document.getElementById('secondaryColorSection');
        const statusBadge = document.getElementById('themeStatusBadge');
        
        if (useSecondaryToggle && secondarySection && statusBadge) {
            useSecondaryToggle.addEventListener('change', (e) => {
                if (e.target.checked) {
                    secondarySection.style.opacity = '1';
                    secondarySection.style.pointerEvents = 'auto';
                    statusBadge.innerText = 'Active';
                    statusBadge.style.background = '#dcfce7';
                    statusBadge.style.color = '#166534';
                } else {
                    secondarySection.style.opacity = '0.5';
                    secondarySection.style.pointerEvents = 'none';
                    statusBadge.innerText = 'Disabled';
                    statusBadge.style.background = '#f1f5f9';
                    statusBadge.style.color = '#64748b';
                }
            });
        }
    </script>
</body>
</html>
