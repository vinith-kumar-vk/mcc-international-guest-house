@php
    $primaryColor = \App\Models\Setting::where('key', 'primary_color')->first()->value ?? '#ff7a00';
    $secondaryColor = \App\Models\Setting::where('key', 'secondary_color')->first()->value ?? '#001a33';

    function hexToRgb($hex) {
        $hex = str_replace("#", "", $hex);
        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        return "$r, $g, $b";
    }
    $primaryRgb = hexToRgb($primaryColor);
    $secondaryRgb = hexToRgb($secondaryColor);
    $useSecondary = \App\Models\Setting::where('key', 'use_secondary_color')->first()->value ?? '0';
@endphp
<style>
    :root {
        --primary-color: {{ $primaryColor }};
        --primary-rgb: {{ $primaryRgb }};
        --primary: {{ $primaryColor }};
        --secondary-color: {{ $secondaryColor }};
        --secondary: {{ $secondaryColor }};
    }

    * {
        font-family: 'Inter', sans-serif !important;
    }

    body, input, select, textarea, button, h1, h2, h3, h4, h5, h6 {
        font-family: 'Inter', sans-serif !important;
    }
    
    /* Secondary Style Overrides for Visual Balance */
    @if($useSecondary == '1')
    header:not(.auth-header) {
        border-bottom: 2px solid var(--secondary-color) !important;
    }

    .main-footer {
        border-top: 4px solid var(--secondary-color) !important;
        background: var(--secondary-color) !important;
        color: #fff !important;
    }

    .main-footer .footer-column h4,
    .main-footer .footer-column h4::after,
    .main-footer .footer-column ul li,
    .main-footer .footer-column ul li a,
    .main-footer .footer-contact-link,
    .main-footer .footer-column p {
        color: #f1f5f9 !important;
    }

    .main-footer .footer-bottom {
        background: rgba(0,0,0,0.15) !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        color: #cbd5e1 !important;
    }

    .sidebar, .admin-sidebar {
        border-right: 1px solid var(--secondary-color) !important;
    }
    @endif

    /* Global overrides for common elements */
    .btn:not(.btn-outline), 
    .btn-primary, 
    .btn-save, 
    .submit-btn,
    .help-send-btn,
    .confirm-booking-btn,
    .active-nav,
    .badge-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: #ffffff !important;
    }
    
    .text-primary, 
    .primary-text, 
    .welcome-title span,
    .price-highlight span,
    .modal-price-line span:first-child,
    .breadcrumb a,
    .footer-column h4::after,
    .header-logo i,
    .hero-prev:hover, .hero-next:hover,
    .dropdown-item:hover {
        color: var(--primary-color) !important;
    }

    .room-highlights i, .facility-item i, .ph-list {
        color: var(--primary-color) !important;
    }

    .header-container {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06) !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03) !important;
        padding: 0 2rem !important;
        height: 80px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 1000 !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .igh-text {
        font-family: 'Inter', sans-serif !important;
        color: #64748b !important;
    }

    .help-btn {
        background: rgba({{ $primaryRgb }}, 0.08) !important;
        color: var(--primary-color) !important;
        border: 1px solid rgba({{ $primaryRgb }}, 0.2) !important;
        padding: 0.5rem 1.25rem !important;
        border-radius: 50px !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        transition: all 0.3s ease !important;
        cursor: pointer !important;
    }

    .help-btn:hover {
        background: var(--primary-color) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba({{ $primaryRgb }}, 0.3) !important;
        transform: translateY(-1px) !important;
    }

    /* Header center: only visible on large screens (1280px+) */
    .header-center {
        position: absolute !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        text-align: center !important;
        display: none !important; /* hidden by default, shown on large screens below */
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        pointer-events: none !important;
        white-space: nowrap !important;
    }

    .logo-text {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
    }

    /* Fixed alignment for header parts */
    .header-left, .header-right {
        display: flex !important;
        align-items: center !important;
        gap: 1rem !important;
        z-index: 2 !important;
    }

    @media (max-width: 992px) {
        .header-title {
            display: none !important; /* Hide long title on mobile/tablet to avoid overlap */
        }
    }

    /* Show header center text only on wide screens */
    @media (min-width: 1280px) {
        .header-center {
            display: flex !important;
        }
    }

    /* ── Logo and link base styles (must be before mobile overrides) ── */
    .logo-link {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        height: auto !important;
    }

    /* Default (desktop) logo size */
    .header-logo {
        height: 70px !important;
        width: auto !important;
        object-fit: contain !important;
    }

    /* Mobile header adjustments */
    @media (max-width: 767px) {
        .header-container {
            padding: 0 0.75rem !important;
            height: 60px !important;
        }
        .header-logo {
            height: 38px !important;
        }
        .help-btn {
            padding: 0.35rem 0.65rem !important;
            font-size: 0.75rem !important;
            letter-spacing: 0 !important;
        }
        .help-btn span {
            display: none !important;
        }
        .header-left, .header-right {
            gap: 0.5rem !important;
        }
    }

    /* Tablet header adjustments */
    @media (min-width: 768px) and (max-width: 1279px) {
        .header-container {
            padding: 0 1.5rem !important;
            height: 70px !important;
        }
        .header-logo {
            height: 52px !important;
        }
    }


    .border-primary, .room-highlights, .form-section-title {
        border-color: var(--primary-color) !important;
    }

    /* Input focus */
    .form-input:focus, .form-select:focus, input:focus, select:focus, textarea:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba({{ $primaryRgb }}, 0.15) !important;
    }

    /* Radio/Checkbox */
    input[type="radio"], input[type="checkbox"] {
        accent-color: var(--primary-color) !important;
    }



    /* Modal & Popups */
    .modal-close {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
    }

    .modal-close:hover {
        background-color: var(--primary-color) !important;
        color: #fff !important;
        transform: rotate(90deg) scale(1.1) !important;
    }

    .facility-item i {
        color: var(--primary-color) !important;
    }

    .dropdown-option:hover {
        background-color: rgba({{ $primaryRgb }}, 0.08) !important;
        color: var(--primary-color) !important;
    }

    /* Form Fields */
    .form-input:focus, .form-select:focus, input:focus, select:focus, textarea:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 4px rgba({{ $primaryRgb }}, 0.1) !important;
    }

    /* Hover states */
    .btn-outline:hover,
    .btn-outline:active,
    .btn-outline:focus {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba({{ $primaryRgb }}, 0.3) !important;
    }

    .btn:not(.btn-outline):hover, 
    .btn:not(.btn-outline):active,
    .btn:not(.btn-outline):focus,
    .btn-primary:hover, 
    .btn-primary:active,
    .btn-primary:focus,
    .submit-btn:hover, 
    .submit-btn:active,
    .submit-btn:focus,
    .help-send-btn:hover, 
    .help-send-btn:active,
    .help-send-btn:focus,
    .confirm-booking-btn:hover,
    .confirm-booking-btn:active,
    .confirm-booking-btn:focus {
        background-color: var(--primary-color) !important;
        filter: brightness(90%) !important;
        color: #ffffff !important;
    }

    .btn-outline {
        border-color: var(--primary-color) !important;
        color: var(--primary-color) !important;
    }

    /* Sidebar and Navigation */
    .sidebar-menu a.active { 
        color: var(--primary-color) !important; 
        background: rgba({{ $primaryRgb }}, 0.08) !important; 
        border-left: 4px solid var(--primary-color) !important;
    }

    .nav-link:hover, .menu-item:hover {
        color: var(--primary-color) !important;
    }

    .hero-dot.active {
        background-color: var(--primary-color) !important;
    }
</style>

<script>
    window.primaryColor = "{{ $primaryColor }}";
    window.primaryColorRGB = "{{ $primaryRgb }}";

    // "Nuclear" fix: Scan the DOM for hardcoded orange and replace it
    function applyDynamicTheme() {
        const orangeShades = [
            "rgb(255, 122, 0)",   // #ff7a00 (Main)
            "rgb(255, 106, 0)",   // #ff6a00
            "rgb(230, 109, 0)",   // #e66d00
            "rgb(204, 94, 0)",    // #cc5e00
            "rgb(255, 122, 0)",   // Repeated for safety
            "rgb(255, 121, 0)",   // slight variant
            "rgba(255, 122, 0, 0.85)",
            "rgba(255, 122, 0, 0.3)",
            "rgba(255, 122, 0, 0.15)",
            "rgba(255, 122, 0, 0.1)",
            "rgb(255, 154, 0)",
            "rgb(255, 165, 0)"
        ];
        const allElements = document.getElementsByTagName('*');
        for (let i = 0; i < allElements.length; i++) {
            const el = allElements[i];
            
            // Skip interactive elements whose states (hover, active, focus) must remain controlled purely by CSS
            if (el.matches('.tab-btn, .btn, [class*="btn-"], button, .submit-btn')) continue;

            const style = window.getComputedStyle(el);
            
            // Background
            if (orangeShades.includes(style.backgroundColor)) {
                el.style.setProperty('background-color', window.primaryColor, 'important');
            }
            // Transition rgba backgrounds
            if (style.backgroundColor.startsWith('rgba(255, 122, 0')) {
                const alpha = style.backgroundColor.split(',').pop().replace(')', '').trim();
                el.style.setProperty('background-color', `rgba(${window.primaryColorRGB}, ${alpha})`, 'important');
            }
 
            // Border
            if (orangeShades.includes(style.borderColor)) {
                el.style.setProperty('border-color', window.primaryColor, 'important');
            }
            // Border color starts with rgba
            if (style.borderColor.startsWith('rgba(255, 122, 0')) {
                const alpha = style.borderColor.split(',').pop().replace(')', '').trim();
                el.style.setProperty('border-color', `rgba(${window.primaryColorRGB}, ${alpha})`, 'important');
            }

            // Text Color
            if (orangeShades.includes(style.color)) {
                el.style.setProperty('color', window.primaryColor, 'important');
            }
        }
    }

    // Run on load and whenever the DOM changes
    window.addEventListener('DOMContentLoaded', applyDynamicTheme);
    window.addEventListener('load', applyDynamicTheme);
    
    // Mutation Observer to catch dynamic content (like modals or JS-generated elements)
    const observer = new MutationObserver((mutations) => {
        applyDynamicTheme();
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true,
        attributes: true,
        attributeFilter: ['style', 'class']
    });
</script>
