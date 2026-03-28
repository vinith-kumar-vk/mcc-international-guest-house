<header class="header-container">
    <div class="header-left">
        <button class="hamburger-btn" onclick="toggleGuestNav(event)" id="guestHamburger">
            <i class="ph ph-list" style="font-size: 1.5rem; color: #ff7a00;"></i>
        </button>
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="header-logo">
        </a>
    </div>
    <div class="header-center">
        <h1 class="header-title">{{ $title ?? 'MCC International Guest House' }}</h1>
    </div>
    <div class="header-right">
        @if(isset($showHelpBtn) && $showHelpBtn)
            <button class="help-btn" onclick="openHelpModal()">Help</button>
        @endif

        @if(isset($headerBackBtn))
            <a href="{{ $headerBackBtn['url'] }}" class="btn btn-outline" style="text-decoration:none;">{{ $headerBackBtn['label'] ?? 'Back' }}</a>
        @else
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleDropdown(event)">
                    <i class="ph-fill ph-user-circle" style="color:#ff7a00; font-size:1.75rem;"></i>
                </button>
                <div class="dropdown-menu" id="profileMenu">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="dropdown-item logout" style="width:100%; text-align:left; background:none; border:none; padding:10px 15px; cursor:pointer; font-family:inherit;">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                    @endauth
                </div>
            </div>
        @endif
    </div>
</header>

{{-- Guest Mobile Nav Overlay --}}
<div class="guest-nav-overlay" id="guestNav">
    <div class="guest-nav-content">
        <div class="guest-nav-header">
            <span style="font-weight: 800; color: #1e293b;">Navigation</span>
            <button onclick="toggleGuestNav()" style="background:none; border:none; cursor:pointer;">
                <i class="ph ph-x" style="font-size: 1.5rem; color: #64748b;"></i>
            </button>
        </div>
        <div class="guest-nav-menu">
            <a href="{{ route('home') }}" class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                <i class="ph ph-house"></i> Home
            </a>
            <a href="{{ route('standard.rooms') }}" class="nav-item {{ Route::is('standard.rooms') ? 'active' : '' }}">
                <i class="ph ph-bed"></i> Standard Rooms
            </a>
            <a href="{{ route('advance.rooms') }}" class="nav-item {{ Route::is('advance.rooms') ? 'active' : '' }}">
                <i class="ph ph-star"></i> Advance Rooms
            </a>
            <a href="{{ route('conference.rooms') }}" class="nav-item {{ Route::is('conference.rooms') ? 'active' : '' }}">
                <i class="ph ph-users-three"></i> Conference / Glass Rooms
            </a>
            <a href="{{ route('approval.status') }}" class="nav-item {{ Route::is('approval.status') ? 'active' : '' }}">
                <i class="ph ph-clock"></i> Check Status
            </a>
            <div style="margin-top: 1.5rem; padding: 1rem 0; border-top: 1px solid #f1f5f9;">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-item" style="width:100%; text-align:left; color:#ef4444; background:none; border:none;">
                            <i class="ph ph-sign-out"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-item">
                        <i class="ph ph-sign-in"></i> Guest Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDropdown(event) {
        event.stopPropagation();
        document.getElementById('profileMenu').classList.toggle('active');
    }

    function toggleGuestNav(event) {
        if(event) event.stopPropagation();
        document.getElementById('guestNav').classList.toggle('active');
    }

    document.addEventListener('click', function(event) {
        const profileMenu = document.getElementById('profileMenu');
        const guestNav = document.getElementById('guestNav');
        
        if (profileMenu && !profileMenu.contains(event.target)) {
            profileMenu.classList.remove('active');
        }
        
        if (guestNav && guestNav.classList.contains('active') && !guestNav.querySelector('.guest-nav-content').contains(event.target)) {
            guestNav.classList.remove('active');
        }
    });

    function openHelpModal() {
        const modal = document.getElementById('helpModalOverlay');
        if(modal) modal.classList.add('active');
    }
</script>
