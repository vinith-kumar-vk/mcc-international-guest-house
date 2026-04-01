@php
    $primaryColor = \App\Models\Setting::where('key', 'primary_color')->first()->value ?? '#ff7a00';
@endphp
<style>
    :root {
        --primary-color: {{ $primaryColor }};
        --primary: {{ $primaryColor }};
    }
    
    /* Global overrides for common elements */
    .btn:not(.btn-outline), 
    .btn-primary, 
    .btn-save, 
    .submit-btn,
    .help-send-btn,
    .confirm-booking-btn,
    .active-nav,
    .badge-primary,
    .badge:not(.badge-outline),
    .status-available {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
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

    i.ph-fill, i.ph-bold, i.ph-user-circle, .room-highlights i, .facility-item i, .ph-list {
        color: var(--primary-color) !important;
    }

    .border-primary, .room-highlights, .form-section-title {
        border-color: var(--primary-color) !important;
    }

    /* Input focus */
    .form-input:focus, .form-select:focus, input:focus, select:focus, textarea:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px rgba({{ hexToRgb($primaryColor) }}, 0.15) !important;
    }

    /* Radio/Checkbox */
    input[type="radio"], input[type="checkbox"] {
        accent-color: var(--primary-color) !important;
    }

    /* Catch-all for hardcoded inline styles (experimental but effective) */
    [style*="#ff7a00"], [style*="rgb(255, 122, 0)"] {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: var(--primary-color) !important;
    }

    /* Hover states */
    .btn-outline:hover, .btn:hover, .submit-btn:hover {
        filter: brightness(90%) !important;
    }

    .btn-outline {
        border-color: var(--primary-color) !important;
        color: var(--primary-color) !important;
    }

    /* Sidebar and Navigation */
    .sidebar-menu a.active { 
        color: var(--primary-color) !important; 
        background: rgba({{ hexToRgb($primaryColor) }}, 0.08) !important; 
        border-left: 4px solid var(--primary-color) !important;
    }

    .nav-link:hover, .menu-item:hover {
        color: var(--primary-color) !important;
    }

    .hero-dot.active {
        background-color: var(--primary-color) !important;
    }
    
    @php
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
        $rgbColor = hexToRgb($primaryColor);
    @endphp
</style>

<script>
    window.primaryColor = "{{ $primaryColor }}";
    window.primaryColorRGB = "{{ $rgbColor }}";

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
            "rgba(255, 122, 0, 0.1)"
        ];
        
        const allElements = document.getElementsByTagName('*');
        for (let i = 0; i < allElements.length; i++) {
            const el = allElements[i];
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
