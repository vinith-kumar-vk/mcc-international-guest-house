@php
    $primaryColor = \App\Models\Setting::where('key', 'primary_color')->first()->value ?? '#ff7a00';
    $secondaryColor = \App\Models\Setting::where('key', 'secondary_color')->first()->value ?? '#001a33';

    function hexToRgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        return "$r, $g, $b";
    }
    $primaryRgb = hexToRgb($primaryColor);
    $secondaryRgb = hexToRgb($secondaryColor);
    $useSecondary = \App\Models\Setting::where('key', 'use_secondary_color')->first()->value ?? '0';
@endphp
<style>
    :root {
        --primary-color:
            {{ $primaryColor }}
        ;
        --primary-rgb:
            {{ $primaryRgb }}
        ;
        --primary:
            {{ $primaryColor }}
        ;
        --secondary-color:
            {{ $secondaryColor }}
        ;
        --secondary:
            {{ $secondaryColor }}
        ;
    }

    * {
        font-family: 'Inter', sans-serif !important;
    }

    body,
    input,
    select,
    textarea,
    button,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Inter', sans-serif !important;
    }

    /* Secondary Style Overrides for Visual Balance */
    @if($useSecondary == '1')
        header:not(.auth-header) {
            border-bottom: 2px solid var(--secondary-color) !important;
        }

        .main-footer {
            border-top: 2px solid var(--secondary-color) !important;
            background: #fdfbf9 !important; /* Keep professional beige as requested */
            color: #444 !important;
        }

        .main-footer .footer-column h4,
        .main-footer .footer-column ul li,
        .main-footer .footer-column ul li a,
        .main-footer .footer-contact-link,
        .main-footer .footer-column p {
            color: #475569 !important;
        }

        .main-footer .footer-bottom {
            background: transparent !important;
            border-top: 1px solid rgba(0, 0, 0, 0.05) !important;
            color: #64748b !important;
        }

        .sidebar,
        .admin-sidebar {
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
    .hero-prev:hover,
    .hero-next:hover,
    .dropdown-item:hover {
        color: var(--primary-color) !important;
    }

    .room-highlights i,
    .facility-item i,
    .ph-list {
        color: var(--primary-color) !important;
    }

    .header-container,
    header:not(.auth-header) {
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
        padding: 0 2.5rem !important;
        height: 100px !important;
        /* Increased for better visibility */
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 1000 !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .logo-text {
        gap: 2px !important;
    }

    .mcc-text {
        font-weight: 800 !important;
        color: var(--primary-color) !important;
        font-size: 1.5rem !important;
        letter-spacing: 1px !important;
    }

    .igh-text {
        font-family: 'Inter', sans-serif !important;
        color: var(--primary-color) !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
        letter-spacing: 0.5px !important;
    }

    /* Standardized Breadcrumb Spacing for Category Pages */
    .breadcrumb {
        margin-top: 30px !important;
        margin-bottom: 1.5rem !important;
        font-size: 0.9rem !important;
        color: #7f1d1d !important; /* Maroon */
        font-weight: 500 !important;
    }

    .breadcrumb a {
        color: #7f1d1d !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    .breadcrumb span {
        color: #7f1d1d !important;
        opacity: 0.8 !important;
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
        display: none !important;
        /* hidden by default, shown on large screens below */
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
    .header-left,
    .header-right {
        display: flex !important;
        align-items: center !important;
        gap: 1rem !important;
        z-index: 2 !important;
    }

    @media (max-width: 992px) {
        .header-title {
            display: none !important;
            /* Hide long title on mobile/tablet to avoid overlap */
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
        mix-blend-mode: multiply !important;
        /* Enhances clarity and visual pop - removes "dull" look */
        filter: brightness(1.08) contrast(1.08) saturate(1.1);
    }

    /* Mobile header adjustments */
    @media (max-width: 767px) {
        .header-container {
            padding: 0 1rem !important;
            height: 75px !important;
        }

        .header-logo {
            height: 55px !important;
            mix-blend-mode: multiply !important;
            filter: brightness(1.08) contrast(1.08) saturate(1.1);
        }

        .help-btn {
            padding: 0.4rem 0.8rem !important;
            font-size: 0.75rem !important;
            letter-spacing: 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
        }

        .help-btn span {
            display: inline !important;
        }

        .header-left,
        .header-right {
            gap: 0.5rem !important;
        }
    }

    /* Tablet header adjustments */
    @media (min-width: 768px) and (max-width: 1279px) {
        .header-container {
            padding: 0 2rem !important;
            height: 90px !important;
        }

        .header-logo {
            height: 72px !important;
            mix-blend-mode: multiply !important;
        }
    }


    .border-primary,
    .room-highlights,
    .form-section-title {
        border-color: var(--primary-color) !important;
    }

    /* Input focus */
    .form-input:focus,
    .form-select:focus,
    input:focus,
    select:focus,
    textarea:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba({{ $primaryRgb }}, 0.15) !important;
    }

    /* Radio/Checkbox */
    input[type="radio"],
    input[type="checkbox"] {
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
    .form-input:focus,
    .form-select:focus,
    input:focus,
    select:focus,
    textarea:focus {
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

    .nav-link:hover,
    .menu-item:hover {
        color: var(--primary-color) !important;
    }

    .hero-dot.active {
        background-color: var(--primary-color) !important;
    }

    /* =============================================================
       STRICT UI UPDATE - HEADER & HERO
       ============================================================= */

    /* 7. Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }

    /* 1. Header Logo Size Fix (CRITICAL VISIBILITY) */
    .header-logo {
        height: 55px !important;
        /* Mobile */
        width: auto !important;
        object-fit: contain !important;
        transition: all 0.3s ease !important;
        mix-blend-mode: multiply !important;
        /* Removes visible white box border around logo PNG */
    }

    @media (min-width: 768px) {
        .header-logo {
            height: 75px !important;
            /* Tablet */
            mix-blend-mode: multiply !important;
        }
    }

    @media (min-width: 1280px) {
        .header-logo {
            height: 85px !important;
            /* Desktop */
            mix-blend-mode: multiply !important;
        }
    }

    /* 2. Compact Hero Banner */
    .main-image-slider {
        height: 600px !important;
        min-height: 600px !important;
        position: relative !important;
        overflow: hidden !important;
    }

    @media (max-width: 767px) {
        .main-image-slider {
            height: 450px !important;
            min-height: 450px !important;
        }
    }

    /* 3. Modern Hero Gradient Overlay (Professional Corporate Style) */
    .hero-slide::before {
        content: '';
        position: absolute;
        inset: 0;
        /* Balanced gradient for centered text: darker in middle/left, clear on right */
        background: linear-gradient(to right, 
            rgba(0, 0, 0, 0.6) 0%, 
            rgba(0, 0, 0, 0.4) 40%, 
            rgba(0, 0, 0, 0.1) 70%, 
            transparent 100%) !important;
        backdrop-filter: blur(1.5px);
        /* Extremely subtle for readability */
        -webkit-backdrop-filter: blur(1.5px);
        z-index: 1;
    }

    /* Ensure the Right side is explicitly clear - we can use a mask or just reliable gradient */
    .hero-slide {
        overflow: hidden;
    }

    /* Ensure text layers are above the overlay */
    .hero-layer {
        z-index: 5 !important;
        background: transparent !important;
        /* Centered alignment for natural balance with the header */
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        padding: 0 10% !important;
    }

    .hero-slide img {
        z-index: 0;
        object-fit: cover !important;
    }

    /* 4. Text Visibility Improvement */
    .slide-title {
        font-size: clamp(2rem, 8vw, 4rem) !important;
        font-weight: 800 !important;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7) !important;
        /* Exact request */
        margin-bottom: 0.8rem !important;
        color: #fff !important;
    }

    .slide-subtitle {
        font-size: clamp(1rem, 3vw, 1.3rem) !important;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7) !important;
        /* Exact request */
        color: #fff !important;
        max-width: 800px;
    }

    /* 5. "BOOK NOW" Button Style */
    .banner-cta {
        margin-top: 2rem !important;
        padding: 0.5rem 1.5rem !important;
        /* Smaller rounded button */
        background: var(--primary-color) !important;
        color: #fff !important;
        font-size: 0.8rem !important;
        font-weight: 700 !important;
        border-radius: 50px !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2) !important;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        pointer-events: auto !important;
    }

    .banner-cta:hover {
        transform: scale(1.05) !important;
        /* Slight scale */
        background: var(--primary-color) !important;
        box-shadow: 0 6px 20px rgba({{ $primaryRgb }}, 0.4) !important;
        /* Shadow */
        color: #fff !important;
    }

    /* =============================================================
       STRICT UI SPACING NORMALIZATION (SPACING REDUCTION)
       ============================================================= */

    /* 1. Global Section Spacing & 5. Section Gap Rule */
    main>section {
        padding-top: 30px !important;
        padding-bottom: 30px !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        width: 100% !important;
        box-sizing: border-box !important;
        /* 2. Container Width & Alignment */
        max-width: 1200px !important;
        margin-left: auto !important;
        margin-right: auto !important;
        padding-left: 16px !important;
        padding-right: 16px !important;
    }

    /* 1 (Special Cases). First and Last Section Padding */
    main>section:first-of-type {
        padding-top: 40px !important;
    }

    main>section:last-of-type {
        padding-bottom: 40px !important;
    }

    /* 3. Heading & Subtext Spacing */
    .title-section h2,
    main h2 {
        margin-bottom: 6px !important;
    }

    .title-section p,
    main p,
    .welcome-subtitle {
        margin-bottom: 20px !important;
        margin-top: 0 !important;
    }

/* Standardized Card Grid Alignment (Parallel Buttons) */
.rooms-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)) !important;
    align-items: stretch !important;
    gap: 24px !important;
}

.card {
    display: flex !important;
    flex-direction: column !important;
    height: 100% !important;
}

.card-content {
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
    height: 100% !important;
}

.card-actions {
    margin-top: auto !important;
}

    /* Slider Specific Width Normalization (Wider) */
    .explore-rooms-section,
    .slider-master-container {
        max-width: 1400px !important;
        width: 100% !important;
        padding-left: 8px !important;
        padding-right: 8px !important;
    }

    .slider-outer-frame {
        padding: 0 10px !important;
    }

    /* 4. Card Inner Details */
    .card-content,
    .slider-card .card-content {
        padding: 16px !important;
    }

    .card-image-wrapper,
    .slider-card .card-image-wrapper {
        margin-bottom: 12px !important;
    }

    .card-btn-wrapper,
    .card-actions {
        margin-top: 12px !important;
    }

    /* 6. About Section Spacing */
    .premium-facility-card {
        padding: 32px !important;
        margin: 0 auto !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    /* 7. Footer Spacing */
    .main-footer {
        margin-top: 0 !important;
    }

    .main-footer .footer-content {
        padding-top: 3rem !important;
        padding-bottom: 2rem !important;
    }

    /* 8. Removal of Random Large Spacing */
    header,
    .main-header {
        margin-bottom: 0 !important;
    }

    main {
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Clean rhythm for room details/descriptions if they appear */
    .description {
        margin-bottom: 16px !important;
    }

    /* =============================================================
       STRICT FIX: BROWSE ALL ROOMS ALIGNMENT & LAYOUT
       ============================================================= */

    .dashboard-rooms-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        gap: 20px !important;
        align-items: stretch !important;
        width: 100% !important;
    }

    .premium-card {
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
        background: #fff !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        transition: all 0.3s ease !important;
    }

    .premium-card .card-image-wrapper {
        height: 180px !important;
        width: 100% !important;
        margin-bottom: 0 !important;
        /* Reset margin for image container */
    }

    .premium-card .card-image-wrapper img {
        height: 100% !important;
        width: 100% !important;
        object-fit: cover !important;
    }

    .premium-card .card-content {
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        padding: 20px !important;
        /* Standardized deep padding */
    }

    .premium-card h2,
    .premium-card h3 {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        margin-bottom: 6px !important;
        min-height: 40px !important;
        /* Title alignment */
        display: flex !important;
        align-items: center !important;
    }

    .premium-card .description {
        font-size: 0.95rem !important;
        line-height: 1.5 !important;
        min-height: 60px !important;
        /* Description alignment */
        margin-bottom: 16px !important;
        color: #64748b !important;
    }

    .premium-card .card-btn-wrapper {
        margin-top: auto !important;
        /* Buttons at bottom */
        padding-top: 12px !important;
    }

    .premium-card .view-details-btn {
        width: 100% !important;
        justify-content: center !important;
    }

    /* Admin Sidebar Logo Enhancement */
    .sidebar-logo {
        font-size: 1.5rem !important;
        font-weight: 800 !important;
        letter-spacing: -0.5px !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.75rem !important;
    }

    .sidebar-logo i {
        font-size: 1.8rem !important;
        color: var(--primary-color) !important;
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