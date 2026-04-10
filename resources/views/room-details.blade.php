<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        :root {
            --primary-color: #FF6B35;
            --text-dark: #1a1a1a;
            --text-medium: #4a4a4a;
            --text-light: #7a7a7a;
            --border-light: #e0e0e0;
            --bg-light: #fafafa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fcfcfc;
            color: var(--text-medium);
            line-height: 1.6;
        }

        /* ===== GLOBAL RESET FOR THIS PAGE ===== */
        *, *::before, *::after { box-sizing: border-box; }
        html, body { width: 100%; overflow-x: hidden; }

        .details-container {
            max-width: 1300px;
            margin: 2rem auto;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 2.5rem;
            padding: 0 2rem;
            width: 100%;
            box-sizing: border-box;
        }

        .main-content {
            min-width: 0; /* Prevent grid blowout */
            width: 100%;
        }

        /* Image Gallery & Actions */
        .gallery-section {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            width: 100%;
        }

        .main-img-wrapper {
            width: 100%;
            height: 500px;
            overflow: hidden;
        }

        .main-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 10px;
            background: #f8fafc;
        }

        .thumb-item {
            height: 90px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
        }

        .thumb-item.active { border-color: var(--primary-color); }
        .thumb-item img { width: 100%; height: 100%; object-fit: cover; }

        /* Spec Cards Row */
        .gallery-info-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 16px;
            width: 100%;
        }

        .spec-card {
            background: white;
            padding: 0.85rem 0.75rem;
            border-radius: 12px;
            border: 1px solid var(--border-light);
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 4px;
            overflow: hidden;
            min-width: 0;
        }

        .spec-card i { color: var(--primary-color); font-size: 1.25rem; margin-bottom: 4px; }
        .spec-card .val { display: block; font-weight: 700; color: var(--text-dark); font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .spec-card .lbl { font-size: 0.7rem; color: var(--text-light); text-transform: uppercase; font-weight: 600; }

        .gallery-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid var(--border-light);
            margin-bottom: 24px;
            width: 100%;
            gap: 12px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-medium);
            cursor: pointer;
            transition: color 0.2s;
        }

        .action-btn:hover { color: var(--primary-color); }
        .action-btn i { font-size: 1.1rem; }

        /* Main Content Typography */
        .room-title {
            font-size: 2.25rem; /* 36px */
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }

        .room-meta-row {
            display: flex;
            gap: 24px;
            color: var(--text-medium);
            font-size: 1rem;
            margin-bottom: 2rem;
            align-items: center;
        }

        .room-meta-item { display: flex; align-items: center; gap: 8px; }
        .room-meta-item i { color: var(--primary-color); font-size: 1.3rem; }

        .tabs-container {
            border-bottom: 2px solid var(--border-light);
            margin-bottom: 2rem;
            display: flex;
            gap: 40px;
        }

        .tab-btn {
            padding: 12px 0;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-light);
            border-bottom: 3px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            bottom: -2px;
        }

        .tab-btn.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .tab-pane { display: none; }
        .tab-pane.active { display: block; animation: fadeIn 0.3s ease; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-size: 1.25rem; /* 20px */
            font-weight: 700;
            color: var(--text-dark);
            margin: 2.5rem 0 1.25rem 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .description-text {
            color: var(--text-medium);
            line-height: 1.8;
            font-size: 1rem; /* 16px */
        }

        /* Sidebar Standardized Typography & Spacing */
        .sidebar-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid var(--border-light);
            position: relative; /* Removed sticky sliding behavior */
            height: fit-content;
        }

        .price-box {
            background: #fff8f3;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 122, 0, 0.1);
            text-align: center;
        }

        .price-val { font-size: 2.25rem; font-weight: 800; color: var(--primary-color); }
        .price-unit { color: var(--text-medium); font-size: 1rem; font-weight: 500; }

        .sidebar-section-box {
            background: #fafafa;
            border-radius: 4px;
            padding: 12px 16px;
            margin-bottom: 14px; /* Strictly 14px gap */
            border: 1px solid var(--border-light);
        }

        .sidebar-section-title {
            font-size: 0.95rem; /* 15-16px */
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sidebar-section-title i { font-size: 1.25rem; }

        .highlights-list { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .highlight-item {
            display: flex;
            gap: 8px;
            font-size: 0.85rem; /* 13-14px */
            color: var(--text-medium);
            line-height: 1.5;
            align-items: flex-start;
        }

        .highlight-item i { color: #16a34a; font-size: 0.9rem; margin-top: 3px; }

        .capacity-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .capacity-item { background: white; padding: 10px 5px; border-radius: 12px; border: 1px solid var(--border-light); text-align: center; }
        .capacity-item i { font-size: 1.1rem; color: var(--text-light); margin-bottom: 6px; display: block; }
        .cap-val { display: block; font-weight: 800; color: var(--text-dark); font-size: 1.1rem; }
        .cap-label { font-size: 0.7rem; color: var(--text-light); text-transform: uppercase; font-weight: 700; }

        .amenity-mini-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px; }
        .amenity-mini-icon {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            background: white;
            border-radius: 10px;
            border: 1px solid var(--border-light);
        }

        .amenity-mini-icon i {
            font-size: 1.25rem;
            color: var(--primary-color);
            background: #fff8f3;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .amenity-mini-label { font-size: 0.8rem; font-weight: 600; color: var(--text-medium); }

        .guide-list li {
            font-size: 0.85rem; /* 13-14px */
            color: var(--text-medium);
            margin-bottom: 8px;
            line-height: 1.6;
            padding-left: 20px;
            position: relative;
        }
        .guide-list li::before { content: "•"; position: absolute; left: 0; color: var(--primary-color); font-weight: bold; }

        .collapsible-content { display: none; padding-top: 10px; border-top: 1px solid var(--border-light); margin-top: 10px; }
        .expanded .collapsible-content { display: block; }

        .sidebar-footer { border-top: 1px solid var(--border-light); padding-top: 16px; margin-top: 16px; }

        .amenity-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        /* Interactive State Styles */
        .action-btn { transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); cursor: pointer; }
        .action-btn:hover { transform: scale(1.1); color: var(--primary-color); }
        .action-btn.liked { color: #ef4444 !important; }
        .action-btn.liked i { font-weight: bold; }

        /* Modal Base Styles */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.85); backdrop-filter: blur(5px);
            display: none; justify-content: center; align-items: center;
            z-index: 2000; opacity: 0; transition: opacity 0.3s ease;
        }
        .modal-overlay.active { display: flex; opacity: 1; }
        .modal-content {
            background: white; border-radius: 20px; padding: 30px;
            width: 90%; max-width: 400px; position: relative;
            transform: translateY(20px); transition: transform 0.3s ease;
        }
        .modal-overlay.active .modal-content { transform: translateY(0); }
        .modal-close {
            position: absolute; top: 20px; right: 20px;
            font-size: 1.5rem; cursor: pointer; color: var(--text-light);
        }

        /* Share Modal */
        .share-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 20px; }
        .share-option {
            display: flex; flex-direction: column; align-items: center; gap: 8px;
            padding: 15px; border-radius: 12px; background: #f8fafc;
            text-decoration: none; color: var(--text-dark); font-weight: 600; font-size: 0.8rem;
            transition: all 0.2s; border: 1px solid transparent;
        }
        .share-option:hover { background: #fff8f3; border-color: var(--primary-color); color: var(--primary-color); }
        .share-option i { font-size: 1.5rem; }

        /* Lightbox */
        .lightbox-content { max-width: 90vw; max-height: 90vh; border-radius: 10px; overflow: hidden; position: relative; }
        .lightbox-img { width: 100%; height: auto; object-fit: contain; }
        .lightbox-nav {
            position: absolute; top: 50%; width: 100%; transform: translateY(-50%);
            display: flex; justify-content: space-between; padding: 0 20px; pointer-events: none;
        }
        .lightbox-btn {
            width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: white;
            cursor: pointer; pointer-events: auto; transition: background 0.2s;
        }
        .lightbox-btn:hover { background: var(--primary-color); }

        /* Toast */
        .toast {
            position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(100px);
            background: var(--text-dark); color: white; padding: 12px 24px;
            border-radius: 50px; font-weight: 600; font-size: 0.9rem;
            z-index: 3000; transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex; align-items: center; gap: 10px;
        }
        .toast.active { transform: translateX(-50%) translateY(0); }

        /* FAQ */
        .faq-item-sidebar { border-bottom: 1px solid var(--border-light); padding: 12px 0; }
        .faq-answer { max-height: 0; overflow: hidden; transition: all 0.3s ease; opacity: 0; }
        .expanded .faq-answer { max-height: 200px; opacity: 1; margin-top: 10px; }

        /* ===== RESPONSIVE: TABLET (≤ 1100px) ===== */
        @media (max-width: 1100px) {
            .details-container {
                grid-template-columns: 1fr !important;
                padding: 0 1.5rem !important;
                gap: 1.5rem !important;
            }
            .sidebar-card { position: static !important; }
        }

        /* ===== RESPONSIVE: MOBILE (≤ 768px) ===== */
        @media (max-width: 768px) {
            .details-container {
                padding: 0 12px !important;
                margin: 0.5rem auto 2rem !important;
                gap: 1.25rem !important;
            }

            /* Gallery */
            .main-img-wrapper { height: 260px !important; }
            .gallery-section { border-radius: 14px !important; }
            .thumbnail-grid {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 8px !important;
                padding: 8px !important;
            }
            .thumb-item { height: 72px !important; }

            /* Spec cards: stack vertically full width */
            .gallery-info-row {
                grid-template-columns: 1fr !important;
                gap: 8px !important;
                margin-bottom: 12px !important;
            }
            .spec-card {
                flex-direction: row !important;
                align-items: center !important;
                justify-content: flex-start !important;
                gap: 12px !important;
                padding: 12px 14px !important;
                text-align: left !important;
                min-width: 0 !important;
            }
            .spec-card i { margin-bottom: 0 !important; flex-shrink: 0 !important; }
            .spec-card .val {
                font-size: 0.95rem !important;
                white-space: normal !important;
                overflow: visible !important;
                text-overflow: unset !important;
            }
            .spec-card .lbl { font-size: 0.72rem !important; }

            /* Gallery Actions */
            .gallery-actions {
                padding: 10px 14px !important;
                gap: 10px !important;
                margin-bottom: 18px !important;
                flex-wrap: wrap !important;
            }

            /* Room header */
            .room-title { font-size: 1.5rem !important; line-height: 1.2 !important; }
            .room-meta-row {
                flex-direction: column !important;
                gap: 8px !important;
                margin-bottom: 1.25rem !important;
            }

            /* Tabs */
            .tabs-container {
                gap: 16px !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
                padding-bottom: 4px !important;
                scrollbar-width: none !important;
            }
            .tabs-container::-webkit-scrollbar { display: none !important; }
            .tab-btn { font-size: 0.875rem !important; padding: 10px 2px !important; white-space: nowrap !important; }

            /* Section titles */
            .section-title { font-size: 1.1rem !important; margin: 1.5rem 0 1rem !important; }

            /* Amenity & Highlight grids */
            .amenity-grid { grid-template-columns: 1fr 1fr !important; gap: 10px !important; }
            .highlights-list { grid-template-columns: 1fr !important; gap: 8px !important; }
            .capacity-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 8px !important; }

            /* Sidebar */
            .sidebar-card { padding: 16px !important; }
            .price-val { font-size: 1.75rem !important; }
            .amenity-mini-grid { grid-template-columns: 1fr 1fr !important; }

            /* Modals */
            .modal-content { width: 95% !important; padding: 20px 16px !important; }
            .share-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 10px !important; }
        }

        /* ===== RESPONSIVE: SMALL PHONE (≤ 480px) ===== */
        @media (max-width: 480px) {
            .details-container { padding: 0 10px !important; }
            .main-img-wrapper { height: 210px !important; }
            .thumbnail-grid { grid-template-columns: repeat(3, 1fr) !important; }
            .thumb-item { height: 60px !important; }
            .room-title { font-size: 1.35rem !important; }
            .amenity-grid { grid-template-columns: 1fr !important; }
            .capacity-grid { grid-template-columns: 1fr 1fr !important; }
            .highlights-list { grid-template-columns: 1fr !important; }
        }
    </style>
    @include('partials.dynamic-styles')
</head>
<body style="background: #fbfbfb;">
    @include('partials.header', ['headerBackBtn' => ['url' => url()->previous(), 'label' => 'Back'], 'showHelpBtn' => true])

    @php
        // Hardcoded room data lookup for the specific demonstration
        $roomsData = [
            'conference-hall' => [
                'name' => 'Conference Hall',
                'price' => '₹2000',
                'time' => 'for 4 hours',
                'capacity' => '60 Members',
                'size' => '1200 sq.ft',
                'location' => 'Main Wing, 1st Floor',
                'img' => asset('assets/standard/conference.JPG'),
                'desc' => 'A versatile and professionally equipped venue designed for large-scale gatherings, corporate events, and interactive workshops. Featuring high-definition projection systems, professional-grade acoustics, and premium seating for 60 members, our Conference Hall provides an impactful environment for collaborative success.',
                'amenities' => [
                    ['name' => 'Projector', 'icon' => 'ph-projector-screen'],
                    ['name' => 'PA System', 'icon' => 'ph-speaker-hifi'],
                    ['name' => 'Whiteboard', 'icon' => 'ph-chalkboard'],
                    ['name' => 'High Speed WiFi', 'icon' => 'ph-wifi-high'],
                    ['name' => 'Drinking Water', 'icon' => 'ph-drop'],
                    ['name' => 'AC', 'icon' => 'ph-snowflake'],
                ],
                'highlights' => [
                    ['text' => 'High-definition projection systems', 'icon' => 'ph ph-monitor'],
                    ['text' => 'Professional-grade acoustics', 'icon' => 'ph ph-speaker-hifi'],
                    ['text' => 'Flexible seating arrangements', 'icon' => 'ph ph-users-three'],
                    ['text' => 'Dedicated technical support', 'icon' => 'ph ph-headset'],
                ],
                'capacity_breakdown' => [
                    ['title' => 'Standing', 'value' => '80'],
                    ['title' => 'Theater', 'value' => '60'],
                    ['title' => 'Conference', 'value' => '40'],
                    ['title' => 'Boardroom', 'value' => '30'],
                ],
                'tips' => [
                    'Minimum booking: 4 hours',
                    'Book at least 3 days in advance',
                    'Arrive 15 mins early for technical check',
                    'Setup time included in booking duration',
                ],
                'included' => [
                    'Basic stationery and whiteboards',
                    'Bottled drinking water',
                    'Standard room setup and cleanup',
                    'On-site technical representative',
                ],
                'faqs' => [
                    ['q' => 'Can we bring outside catering?', 'a' => 'Yes, however prior approval and a small maintenance fee apply.'],
                    ['q' => 'Is parking available for guests?', 'a' => 'Dedicated visitor parking is available near the Main Wing.'],
                    ['q' => 'Do you provide hybrid meeting tools?', 'a' => 'Yes, we have high-end cameras and mics for hybrid sessions.'],
                ],
                'category' => 'conference'
            ],
            'glass-room' => [
                'name' => 'Glass Room',
                'price' => '₹2000',
                'time' => 'for 4 hours',
                'capacity' => '15 Members',
                'size' => '450 sq.ft',
                'location' => 'East Wing, Ground Floor',
                'img' => asset('assets/standard/glass.JPG'),
                'desc' => 'Inspire creativity in our modern Glass Room, a unique transparent facility designed for collaborative brainstorming and focused team sessions for up to 15 members. Flooded with natural light and equipped with the latest presentation technology, this space fosters an atmosphere of transparency and professional innovation.',
                'amenities' => [
                    ['name' => 'Modern Furniture', 'icon' => 'ph-armchair'],
                    ['name' => 'High Speed WiFi', 'icon' => 'ph-wifi-high'],
                    ['name' => 'Charging Ports', 'icon' => 'ph-lightning'],
                    ['name' => 'Glass Walls', 'icon' => 'ph-squares-four'],
                    ['name' => 'AC', 'icon' => 'ph-snowflake'],
                    ['name' => 'Presentation Support', 'icon' => 'ph-presentation-chart'],
                ],
                'highlights' => [
                    ['text' => 'Ample natural morning light', 'icon' => 'ph ph-sun'],
                    ['text' => 'Sleek transparent glass walls', 'icon' => 'ph ph-bounding-box'],
                    ['text' => 'Ergonomic designer furniture', 'icon' => 'ph ph-chair'],
                    ['text' => 'Privacy blinds available', 'icon' => 'ph ph-eye-slash'],
                ],
                'capacity_breakdown' => [
                    ['title' => 'Standing', 'value' => '20'],
                    ['title' => 'Boardroom', 'value' => '12'],
                    ['title' => 'Informal', 'value' => '15'],
                ],
                'tips' => [
                    'Ideal for brainstorming sessions',
                    'Best light between 9 AM - 12 PM',
                    'Food not allowed inside the glass area',
                ],
                'included' => [
                    'Smart TV for presentations',
                    'Flip charts and markers',
                    'Central air conditioning',
                    'Charging docks at every seat',
                ],
                'faqs' => [
                    ['q' => 'Are the walls soundproof?', 'a' => 'Yes, we use double-glazed glass for enhanced acoustic privacy.'],
                    ['q' => 'Is it completely transparent?', 'a' => 'Yes, but integrated automated blinds can be used for full privacy.'],
                ],
                'category' => 'conference'
            ],
            'suite-room' => [
                'name' => 'Suite Room',
                'price' => '₹2000',
                'time' => 'for 4 hours',
                'capacity' => '4 Members',
                'size' => '600 sq.ft',
                'location' => 'Executive Wing, 2nd Floor',
                'img' => asset('assets/suite.JPG'),
                'desc' => 'Our flagship Suite Room offers the pinnacle of luxury and spaciousness, specifically curated for guests seeking a grand experience. Featuring a premium king-size bed, sophisticated furnishings, and exclusive amenities, it provides ultimate relaxation and privacy for a restful stay at MCC IGH.',
                'amenities' => [
                    ['name' => 'King Size Bed', 'icon' => 'ph-bed'],
                    ['name' => 'Smart TV', 'icon' => 'ph-television'],
                    ['name' => 'Mini Fridge', 'icon' => 'ph-snowflake'],
                    ['name' => 'Premium Toiletries', 'icon' => 'ph-spray-bottle'],
                    ['name' => 'Spacious Interior', 'icon' => 'ph-arrows-out'],
                    ['name' => 'AC', 'icon' => 'ph-snowflake'],
                    ['name' => 'Room Service', 'icon' => 'ph-bell-ringing'],
                ],
                'highlights' => [
                    ['text' => 'Premium king-size luxury bed', 'icon' => 'ph ph-bed'],
                    ['text' => 'Dedicated executive lounge access', 'icon' => 'ph ph-crown'],
                    ['text' => 'Panoramic campus views', 'icon' => 'ph ph-mountains'],
                    ['text' => 'Priority check-in service', 'icon' => 'ph ph-clock-user'],
                ],
                'capacity_breakdown' => [
                    ['title' => 'Sleeps', 'value' => '4'],
                    ['title' => 'Lounging', 'value' => '6'],
                ],
                'tips' => [
                    'Perfect for delegates and special guests',
                    'Complimentary breakfast included',
                    'Late checkout available on request',
                ],
                'included' => [
                    'Daily housekeeping service',
                    'Laundry and pressing (optional)',
                    'Private workspace setup',
                    '24/7 concierge support',
                ],
                'faqs' => [
                    ['q' => 'Is breakfast included?', 'a' => 'Yes, a choice of Indian or Continental breakfast is delivered to the room.'],
                    ['q' => 'Can we add an extra bed?', 'a' => 'Yes, one extra rollaway bed can be added for an additional fee.'],
                ],
                'category' => 'conference'
            ]
        ];

        // Generic fallback for numbered rooms (Standard/Advance)
        $room = $roomsData[$roomId] ?? [
            'name' => str_replace('-', ' ', ucwords($roomId)),
            'price' => str_contains($roomId, 'advance') ? '₹2500' : '₹1400',
            'time' => str_contains($roomId, 'advance') ? '/ day' : '/ 12 hours',
            'capacity' => str_contains($roomId, 'advance') ? '4 Members' : '2 Members',
            'size' => '250 sq.ft',
            'location' => 'Guest Wing',
            'img' => str_contains($roomId, 'standard') ? asset('assets/standard/standardroom.JPG') : (str_contains($roomId, 'advance') ? asset('assets/room1.JPG') : 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=90'),
            'desc' => str_contains($roomId, 'advance') 
                ? 'Experience elevated hospitality in our Advance Rooms, specifically curated for guests seeking enhanced privacy and premium comfort during longer stays. Each room boasts sophisticated interiors and upgraded bedding for a superior guest experience.'
                : 'Thoughtfully designed for efficiency and comfort, our Standard Rooms provide a restful haven for short-term visitors. Featuring essential modern amenities including a dedicated workspace and high-speed WiFi, these rooms ensure a productive stay at an unmatched value.',
            'amenities' => [
                ['name' => 'AC', 'icon' => 'ph-snowflake'],
                ['name' => 'WiFi', 'icon' => 'ph-wifi-high'],
                ['name' => 'Work Desk', 'icon' => 'ph-desktop'],
                ['name' => 'Clean Bedding', 'icon' => 'ph-bed'],
                ['name' => 'Basic Toiletries', 'icon' => 'ph-spray-bottle'],
            ],
            'category' => 'standard'
        ];
    @endphp

    <main>
        <div class="details-container">
            <!-- Left Column -->
            <div class="main-content">
                <!-- Breadcrumbs -->
                <nav class="breadcrumb" style="font-size: 0.85rem; margin-bottom: 1.5rem; color: var(--text-light);">
                    <a href="{{ route('home') }}" style="color: var(--primary-color); text-decoration: none;">Home</a>
                    <span style="margin: 0 8px;">/</span>
                    <span style="text-transform: capitalize;">{{ $room['category'] }} Rooms</span>
                    <span style="margin: 0 8px;">/</span>
                    <span style="color: var(--text-dark); font-weight: 600;">{{ $room['name'] }}</span>
                </nav>

                <div class="gallery-section">
                    <div class="main-img-wrapper">
                        <img id="mainImage" src="{{ $room['img'] }}" alt="{{ $room['name'] }}" onerror="this.src='https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=90'">
                    </div>
                    <div class="thumbnail-grid">
                        @if(str_contains($roomId, 'standard'))
                            @for($j=1; $j<=3; $j++)
                                @php
                                    $standardImg = asset('assets/standard/standard'.$j.'.JPG');
                                @endphp
                                <div class="thumb-item {{ $j==1 ? 'active' : '' }}" onclick="changeImage('{{ $standardImg }}', this)">
                                    <img src="{{ $standardImg }}" alt="View {{ $j }}" onerror="this.src='https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60'">
                                </div>
                            @endfor
                        @elseif(str_contains($roomId, 'advance'))
                            @for($j=1; $j<=6; $j++)
                                @php
                                    $advanceImg = asset('assets/standard/std'.$j.'.JPG');
                                @endphp
                                <div class="thumb-item {{ $j==1 ? 'active' : '' }}" onclick="changeImage('{{ $advanceImg }}', this)">
                                    <img src="{{ $advanceImg }}" alt="View {{ $j }}" onerror="this.src='https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60'">
                                </div>
                            @endfor
                        @elseif($roomId === 'suite-room')
                            @for($j=1; $j<=7; $j++)
                                @php
                                    $suiteImg = asset('assets/standard/suite'.$j.'.JPG');
                                @endphp
                                <div class="thumb-item {{ $j==1 ? 'active' : '' }}" onclick="changeImage('{{ $suiteImg }}', this)">
                                    <img src="{{ $suiteImg }}" alt="Suite View {{ $j }}" onerror="this.src='https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60'">
                                </div>
                            @endfor
                        @elseif($roomId === 'conference-hall')
                            @for($j=1; $j<=5; $j++)
                                @php
                                    $conImg = asset('assets/standard/con'.$j.'.JPG');
                                @endphp
                                <div class="thumb-item {{ $j==1 ? 'active' : '' }}" onclick="changeImage('{{ $conImg }}', this)">
                                    <img src="{{ $conImg }}" alt="Conference View {{ $j }}" onerror="this.src='https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60'">
                                </div>
                            @endfor
                        @elseif($roomId === 'glass-room')
                            @for($j=1; $j<=5; $j++)
                                @php
                                    $glassImg = asset('assets/standard/glass'.$j.'.JPG');
                                @endphp
                                <div class="thumb-item {{ $j==1 ? 'active' : '' }}" onclick="changeImage('{{ $glassImg }}', this)">
                                    <img src="{{ $glassImg }}" alt="Glass Room View {{ $j }}" onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60'">
                                </div>
                            @endfor
                        @else
                            <div class="thumb-item active" onclick="changeImage('{{ $room['img'] }}', this)">
                                <img src="{{ $room['img'] }}" alt="View 1" onerror="this.src='https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60'">
                            </div>
                            <div class="thumb-item" onclick="changeImage('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60', this)">
                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60" alt="View 2">
                            </div>
                            <div class="thumb-item" onclick="changeImage('https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60', this)">
                                <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60" alt="View 3">
                            </div>
                            <div class="thumb-item" onclick="changeImage('https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60', this)">
                                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=60" alt="View 4">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- NEW: Information Row & Actions to fill the space -->
                <div class="gallery-info-row">
                    <div class="spec-card">
                        <i class="ph ph-ruler"></i>
                        <span class="val">{{ $room['size'] }}</span>
                        <span class="lbl">Area Size</span>
                    </div>
                    <div class="spec-card">
                        <i class="ph ph-users"></i>
                        <span class="val">{{ $room['capacity'] }}</span>
                        <span class="lbl">Max Capacity</span>
                    </div>
                    <div class="spec-card">
                        <i class="ph ph-map-pin"></i>
                        <span class="val">{{ $room['location'] }}</span>
                        <span class="lbl">Location</span>
                    </div>
                </div>

                <div class="gallery-actions">
                    <div style="display: flex; gap: 24px;">
                        <span class="action-btn" onclick="openLightbox()"><i class="ph ph-corners-out"></i> Full Screen</span>
                    </div>
                    <div style="display: flex; gap: 16px;">
                        <span id="likeBtn" class="action-btn" onclick="toggleLike()"><i class="ph ph-heart"></i></span>
                        <span class="action-btn" onclick="openShareModal()"><i class="ph ph-share-network"></i></span>
                    </div>
                </div>

                <div class="room-info-header">
                    <h1 class="room-title">{{ $room['name'] }}</h1>
                    <div class="room-meta-row">
                        <div class="room-meta-item"><i class="ph ph-map-pin"></i> {{ $room['location'] }}</div>
                        <div class="room-meta-item"><i class="ph ph-calendar"></i> Verified Location</div>
                    </div>
                </div>

                <nav class="tabs-container">
                    <div class="tab-btn active" onclick="switchTab('overview', this)">Overview</div>
                    <div class="tab-btn" onclick="switchTab('amenities', this)">Amenities</div>
                    <div class="tab-btn" onclick="switchTab('location', this)">Location</div>
                    <div class="tab-btn" onclick="switchTab('reviews', this)">Reviews</div>
                </nav>

                <div id="overview" class="tab-pane active">
                    <h2 class="section-title"><i class="ph-fill ph-article"></i> About this Space</h2>
                    <p class="description-text">{{ $room['desc'] }}</p>
                    
                    <h2 class="section-title"><i class="ph-fill ph-shield-check"></i> Stay Rules</h2>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; font-size: 0.95rem; margin-bottom: 30px;">
                        <div style="display: flex; gap: 10px; align-items: start;"><i class="ph-bold ph-check" style="color: #16a34a; margin-top: 4px;"></i> <span>Check-in: Flexible timings subject to availability.</span></div>
                        <div style="display: flex; gap: 10px; align-items: start;"><i class="ph-bold ph-check" style="color: #16a34a; margin-top: 4px;"></i> <span>Alcohol is strictly prohibited in the campus.</span></div>
                        <div style="display: flex; gap: 10px; align-items: start;"><i class="ph-bold ph-check" style="color: #16a34a; margin-top: 4px;"></i> <span>Valid ID proof is mandatory during check-in.</span></div>
                        <div style="display: flex; gap: 10px; align-items: start;"><i class="ph-bold ph-check" style="color: #16a34a; margin-top: 4px;"></i> <span>Guests are responsible for room belongings.</span></div>
                    </div>

                    <h2 class="section-title"><i class="ph-fill ph-map-pin"></i> Getting There</h2>
                    <p class="description-text" style="margin-bottom: 20px;">Madras Christian College, Tambaram East, Chennai, Tamil Nadu, India</p>
                    <div style="height: 300px; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-light); margin-bottom: 30px;">
                        <iframe 
                            width="100%" height="100%" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.37526978187!2d80.1189493758832!3d12.92215268738865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525f16422d86e5%3A0xc3b54b6d4793f0b0!2sMadras%20Christian%20College!5e0!3m2!1sen!2sin!4v1711620000000!5m2!1sen!2sin">
                        </iframe>
                    </div>

                    <h2 class="section-title"><i class="ph-fill ph-star"></i> Guest Experiences</h2>
                    <div class="reviews-list" style="display: flex; flex-direction: column; gap: 15px;">
                        @foreach([['name' => 'Rahul S.', 'rating' => 5, 'text' => "Excellent facility and remarkably clean environment."]] as $review)
                        <div class="review-item" style="background: #fafafa; border: 1px solid var(--border-light); padding: 16px; border-radius: 12px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <div style="font-weight: 700; color: var(--text-dark); font-size: 0.9rem;">{{ $review['name'] }}</div>
                                <div class="rating-stars" style="color: #fbbf24; font-size: 0.7rem;">
                                    @for($i=0; $i<$review['rating']; $i++) <i class="ph-fill ph-star"></i> @endfor
                                </div>
                            </div>
                            <p style="color: var(--text-medium); font-style: italic; font-size: 0.85rem; line-height: 1.5; margin: 0;">"{{ $review['text'] }}"</p>
                        </div>
                        @endforeach
                        <a href="javascript:void(0)" onclick="switchTab('reviews', document.querySelector('.tab-btn:last-child'))" style="color: var(--primary-color); font-weight: 700; text-decoration: none; font-size: 0.9rem;">View all reviews →</a>
                    </div>
                </div>

                <div id="amenities" class="tab-pane">
                    <h2 class="section-title"><i class="ph-fill ph-grid-four"></i> Available Amenities</h2>
                    
                    <div class="amenity-categories" style="display: flex; flex-direction: column; gap: 30px;">
                        <!-- Furniture & Setup -->
                        <div class="amenity-group">
                            <h3 style="font-size: 1rem; color: var(--text-dark); margin-bottom: 15px; font-weight: 700;">Furniture & Setup</h3>
                            <div class="amenity-grid">
                                <div class="amenity-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 16px; background: white; border: 1px solid var(--border-light); border-radius: 8px; transition: all 0.3s ease;">
                                    <div style="width: 60px; height: 60px; background: #fff8f3; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-bottom: 10px;">
                                        <i class="ph ph-armchair" style="font-size: 32px; color: var(--primary-color);"></i>
                                    </div>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--text-dark);">Modern Furniture</span>
                                </div>
                                @if($roomId === 'glass-room')
                                <div class="amenity-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 16px; background: white; border: 1px solid var(--border-light); border-radius: 8px; transition: all 0.3s ease;">
                                    <div style="width: 60px; height: 60px; background: #fff8f3; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-bottom: 10px;">
                                        <i class="ph ph-bounding-box" style="font-size: 32px; color: var(--primary-color);"></i>
                                    </div>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--text-dark);">Glass Walls</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Technology -->
                        <div class="amenity-group">
                            <h3 style="font-size: 1rem; color: var(--text-dark); margin-bottom: 15px; font-weight: 700;">Technology</h3>
                            <div class="amenity-grid">
                                <div class="amenity-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 16px; background: white; border: 1px solid var(--border-light); border-radius: 8px; transition: all 0.3s ease;">
                                    <div style="width: 60px; height: 60px; background: #fff8f3; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-bottom: 10px;">
                                        <i class="ph-bold ph-wifi-high" style="font-size: 32px; color: var(--primary-color);"></i>
                                    </div>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--text-dark);">High Speed WiFi</span>
                                </div>
                                @if($roomId === 'conference-hall')
                                <div class="amenity-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 16px; background: white; border: 1px solid var(--border-light); border-radius: 8px; transition: all 0.3s ease;">
                                    <div style="width: 60px; height: 60px; background: #fff8f3; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-bottom: 10px;">
                                        <i class="ph-bold ph-presentation-chart" style="font-size: 32px; color: var(--primary-color);"></i>
                                    </div>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--text-dark);">Presentation Support</span>
                                </div>
                                @endif
                                <div class="amenity-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 16px; background: white; border: 1px solid var(--border-light); border-radius: 8px; transition: all 0.3s ease;">
                                    <div style="width: 60px; height: 60px; background: #fff8f3; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-bottom: 10px;">
                                        <i class="ph-bold ph-lightning" style="font-size: 32px; color: var(--primary-color);"></i>
                                    </div>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--text-dark);">Charging Ports</span>
                                </div>
                            </div>
                        </div>

                        <!-- Comfort -->
                        <div class="amenity-group">
                            <h3 style="font-size: 1rem; color: var(--text-dark); margin-bottom: 15px; font-weight: 700;">Comfort</h3>
                            <div class="amenity-grid">
                                <div class="amenity-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 16px; background: white; border: 1px solid var(--border-light); border-radius: 8px; transition: all 0.3s ease;">
                                    <div style="width: 60px; height: 60px; background: #fff8f3; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-bottom: 10px;">
                                        <i class="ph ph-snowflake" style="font-size: 32px; color: var(--primary-color);"></i>
                                    </div>
                                    <span style="font-size: 13px; font-weight: 700; color: var(--text-dark);">Air Conditioning</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="location" class="tab-pane">
                    <h2 class="section-title"><i class="ph-fill ph-map-pin"></i> Getting There</h2>
                    <p class="description-text" style="margin-bottom: 20px;">Madras Christian College, Tambaram East, Chennai, Tamil Nadu, India</p>
                    <div style="height: 450px; border-radius: 20px; overflow: hidden; border: 1px solid var(--border-light); box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                        <iframe 
                            width="100%" height="100%" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.37526978187!2d80.1189493758832!3d12.92215268738865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525f16422d86e5%3A0xc3b54b6d4793f0b0!2sMadras%20Christian%20College!5e0!3m2!1sen!2sin!4v1711620000000!5m2!1sen!2sin">
                        </iframe>
                    </div>
                </div>

                <div id="reviews" class="tab-pane">
                    <h2 class="section-title"><i class="ph-fill ph-star"></i> Guest Experiences</h2>
                    <div class="reviews-list" style="display: flex; flex-direction: column; gap: 20px;">
                        @foreach([['name' => 'Rahul S.', 'rating' => 5, 'text' => "Excellent facility and remarkably clean environment. The staff was very professional."], ['name' => 'Priya K.', 'rating' => 4, 'text' => "Wonderful space for workshops. High speed internet was very helpful."], ['name' => 'Arjun M.', 'rating' => 5, 'text' => "Best guest house in the campus. Easy booking process and very convenient location."]] as $review)
                        <div class="review-item" style="background: white; border: 1px solid var(--border-light); padding: 20px; border-radius: 16px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                                <div style="font-weight: 700; color: var(--text-dark);">{{ $review['name'] }}</div>
                                <div class="rating-stars" style="color: #fbbf24; font-size: 0.8rem;">
                                    @for($i=0; $i<$review['rating']; $i++) <i class="ph-fill ph-star"></i> @endfor
                                </div>
                            </div>
                            <p style="color: var(--text-medium); font-style: italic; font-size: 0.95rem; line-height: 1.6; margin: 0;">"{{ $review['text'] }}"</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                </div>

            <!-- Right Column (Sidebar) -->
            <aside class="sidebar-section">
                <div class="sidebar-card">
                    <div class="price-box" style="padding: 16px; margin-bottom: 16px;">
                        <span class="price-val" style="font-size: 24px;">{{ $room['price'] }}</span>
                        <span class="price-unit" style="font-size: 14px;">{{ $room['time'] }}</span>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: var(--text-light); font-weight: 500;">+ 5% GST applicable</p>
                    </div>

                    <a href="{{ route('booking.form.full', ['room' => $roomId]) }}" class="btn" style="width: 100%; padding: 14px 16px !important; border-radius: 6px !important; font-size: 14px !important; margin-bottom: 16px; font-weight: 700;">
                        Book Now <i class="ph-bold ph-arrow-right"></i>
                    </a>

                    <!-- Sidebar Content with Improved Typography -->
                    <div class="sidebar-section-box" style="background: #fff8f3; border-color: rgba(255, 122, 0, 0.2); margin-bottom: 14px;">
                        <h4 class="sidebar-section-title" style="font-size: 13px; margin-bottom: 12px;"><i class="ph-fill ph-sketch-logo"></i> Key Highlights</h4>
                        <div class="highlights-list" style="gap: 8px;">
                            @foreach($room['highlights'] ?? [['text' => 'Clean & Modern', 'icon' => 'ph ph-sparkles'], ['text' => 'Prime Campus Spot', 'icon' => 'ph ph-map-pin']] as $highlight)
                                <div class="highlight-item" style="font-size: 12px;">
                                    <i class="ph-bold ph-check" style="color: #16a34a; font-size: 0.8rem;"></i>
                                    <span>{{ $highlight['text'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-section-box" style="margin-bottom: 14px;">
                        <h4 class="sidebar-section-title" style="font-size: 13px; margin-bottom: 12px;"><i class="ph-fill ph-users"></i> Room Capacity</h4>
                        <div class="capacity-grid" style="background: none; border: none;">
                            @foreach(array_slice($room['capacity_breakdown'] ?? [['title' => 'Standard', 'value' => $room['capacity']]], 0, 3) as $cap)
                                <div class="capacity-item" style="background: none; border: none; padding: 0;">
                                    <i class="ph ph-users" style="font-size: 24px; color: var(--text-light);"></i>
                                    <span class="cap-val" style="font-size: 18px;">{{ $cap['value'] }}</span>
                                    <span class="cap-label" style="font-size: 10px;">{{ $cap['title'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-section-box" style="margin-bottom: 14px;">
                        <h4 class="sidebar-section-title" style="font-size: 13px; margin-bottom: 12px;"><i class="ph-fill ph-grid-four"></i> Performance</h4>
                        <div class="amenity-mini-grid" style="gap: 12px;">
                            @foreach(array_slice($room['amenities'], 0, 4) as $amenity)
                                <div class="amenity-mini-icon" style="flex-direction: column; height: auto; padding: 8px; text-align: center; gap: 4px;">
                                    <i class="ph {{ $amenity['icon'] }}" style="font-size: 24px; width: 50px; height: 50px;"></i>
                                    <div class="amenity-mini-label" style="font-size: 11px;">{{ $amenity['name'] }}</div>
                                </div>
                            @endforeach
                        </div>
                        <a href="javascript:void(0)" onclick="scrollToAmenities()" style="font-size: 12px; color: var(--primary-color); font-weight: 700; text-decoration: none; text-transform: uppercase; display: flex; align-items: center; gap: 4px; border-top: 1px solid var(--border-light); padding-top: 10px; margin-top: 10px;">More Amenities <i class="ph ph-arrow-right"></i></a>
                    </div>

                    <div class="sidebar-section-box collapsible-section" style="margin-bottom: 14px;">
                        <h4 class="sidebar-section-title" onclick="this.parentElement.classList.toggle('expanded')" style="margin-bottom: 0; cursor: pointer; height: 40px; display: flex; align-items: center; font-size: 13px;">
                            <i class="ph-fill ph-lightbulb"></i> Booking Tips <i class="ph ph-caret-down" style="margin-left: auto; font-size: 0.9rem;"></i>
                        </h4>
                        <div class="collapsible-content" style="padding: 12px 0 0 0;">
                            <ul class="guide-list" style="list-style: none; padding: 0; margin: 0; gap: 8px; display: flex; flex-direction: column;">
                                @foreach($room['tips'] ?? ['Minimum 12 hours notice required', 'Subject to management approval'] as $tip)
                                    <li style="font-size: 12px;">{{ $tip }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-section-box" style="margin-bottom: 14px;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                            <h4 class="sidebar-section-title" style="margin: 0; font-size: 13px;"><i class="ph-fill ph-star"></i> Ratings</h4>
                            <div style="text-align: right;">
                                <span style="font-size: 12px; font-weight: 800; color: var(--text-dark); display: block;">4.8/5.0</span>
                                <div class="rating-stars" style="color: #fbbf24; font-size: 18px;">
                                    <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
                                </div>
                            </div>
                        </div>
                        <p style="font-size: 11px; color: var(--text-medium); font-style: italic; margin-bottom: 8px; line-height: 1.4;">"Perfect stay for any campus visitor."</p>
                        <a href="javascript:void(0)" onclick="scrollToReviews()" style="font-size: 12px; color: var(--primary-color); font-weight: 700; text-decoration: none;">View all reviews</a>
                    </div>

                    <div class="sidebar-section-box collapsible-section" style="margin-bottom: 14px;">
                        <h4 class="sidebar-section-title" onclick="this.parentElement.classList.toggle('expanded')" style="margin-bottom: 0; cursor: pointer; height: 40px; display: flex; align-items: center; font-size: 13px;">
                            <i class="ph-fill ph-question"></i> FAQs <i class="ph ph-caret-down" style="margin-left: auto; font-size: 0.9rem;"></i>
                        </h4>
                        <div class="collapsible-content" style="padding: 12px 0 0 0;">
                            <div class="faq-sidebar">
                                @php
                                    $faqs = [
                                        ['q' => 'What is the maximum capacity?', 'a' => 'Up to 20 people standing, 12 in boardroom style, and 15 in informal seating.'],
                                        ['q' => 'What amenities are included?', 'a' => 'Modern furniture, high-speed WiFi, charging ports, glass walls, AC, and presentation support.'],
                                        ['q' => 'What is the cancellation policy?', 'a' => 'Free cancellation up to 24 hours before booking. 50% charges apply within 24 hours.'],
                                        ['q' => 'Are beverages provided?', 'a' => 'Complimentary tea, coffee, and water are included. Catering is available at extra cost.'],
                                        ['q' => 'Can I customize the setup?', 'a' => 'Yes, choose from boardroom, theater, U-shape, or classroom layouts.'],
                                        ['q' => 'Is parking available?', 'a' => 'Yes, free ample parking is available at MCC Innovation Park.'],
                                        ['q' => 'Minimum booking duration?', 'a' => 'The minimum duration is 4 hours, with half-day and full-day packages available.'],
                                        ['q' => 'Is WiFi/Tech support provided?', 'a' => 'Yes, 100 Mbps WiFi and dedicated technical staff are available.'],
                                        ['q' => 'Can I host workshops/seminars?', 'a' => 'Absolutely! It\'s perfect for workshops, team meetings, and small seminars.'],
                                        ['q' => 'What payment methods are accepted?', 'a' => 'All credit/debit cards, net banking, UPI, and digital wallets.'],
                                        ['q' => 'Are the walls soundproof?', 'a' => 'Yes, the glass walls provide excellent acoustic insulation for private meetings.'],
                                        ['q' => 'Is it completely transparent?', 'a' => 'The walls are clear for light, but we offer privacy screens if required.']
                                    ];
                                @endphp
                                @foreach($faqs as $faq)
                                    <div class="faq-item-sidebar" style="margin-bottom: 10px;">
                                        <p style="font-weight: 700; font-size: 12px; color: var(--text-dark); margin-bottom: 2px; cursor: pointer;" onclick="this.parentElement.classList.toggle('expanded')">{{ $faq['q'] }}</p>
                                        <div class="faq-answer">
                                            <p style="font-size: 11px; color: var(--text-medium); margin: 0;">{{ $faq['a'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-section-box footer-section" style="background: #f8fafc; border: 1px solid var(--border-light); padding: 12px; margin-bottom: 0;">
                        <p style="font-size: 11px; color: var(--text-medium); margin-bottom: 12px; font-weight: 600;">Need assistance? We're here to help.</p>
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <a href="#" style="font-size: 12px; color: var(--text-dark); text-decoration: none; display: flex; align-items: center; gap: 8px; font-weight: 700;">
                                <i class="ph ph-file-text" style="color: var(--primary-color);"></i> Booking Policies
                            </a>
                            <a href="tel:+919876543210" style="font-size: 12px; color: var(--text-dark); text-decoration: none; display: flex; align-items: center; gap: 8px; font-weight: 700;">
                                <i class="ph ph-phone" style="color: var(--primary-color);"></i> +91 98765 43210
                            </a>
                        </div>
                        <div style="margin-top: 14px; border-radius: 4px; background: #e8f5e9; padding: 10px 12px; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 12px; font-weight: 800; color: #1b5e20;">
                            <i class="ph-fill ph-shield-check"></i> Safe & Secure Booking
                        </div>
                    </div>
                </div>
            </aside>
            </div>
        </div>

        <!-- Related Rooms -->
        <div class="related-section">
            <h2 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 2rem;">Related Rooms</h2>
            <div class="rooms-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
                <!-- Dummy related items reusing card styles -->
                <div class="card">
                    <div class="card-image-wrapper" style="height: 200px;">
                        <img src="{{ asset('assets/room1.JPG') }}" alt="Related Room">
                        <span class="badge" style="top: 1rem; right: 1rem; background: var(--primary-color); color: white; position: absolute;">Available</span>
                    </div>
                    <div class="card-content" style="padding: 1.25rem;">
                        <h2 style="font-size: 1.1rem; margin-bottom: 0.5rem;">Standard Guest Room</h2>
                        <div style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">₹1400 / 12h</div>
                        <a href="#" class="btn btn-outline" style="width: 100%;">View Details</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image-wrapper" style="height: 200px;">
                        <img src="{{ asset('assets/suite.JPG') }}" alt="Related Room">
                        <span class="badge" style="top: 1rem; right: 1rem; background: var(--primary-color); color: white; position: absolute;">Available</span>
                    </div>
                    <div class="card-content" style="padding: 1.25rem;">
                        <h2 style="font-size: 1.1rem; margin-bottom: 0.5rem;">Advance Executive Room</h2>
                        <div style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">₹2500 / day</div>
                        <a href="#" class="btn btn-outline" style="width: 100%;">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Interactive Modals -->
    <div id="shareModal" class="modal-overlay" onclick="closeModal(event, 'shareModal')">
        <div class="modal-content">
            <span class="modal-close" onclick="document.getElementById('shareModal').classList.remove('active')">✕</span>
            <h3 style="margin-bottom: 10px; color: var(--text-dark);">Share this Room</h3>
            <p style="font-size: 0.85rem; color: var(--text-medium); margin-bottom: 20px;">Help others discover this amazing space!</p>
            <div class="share-grid">
                <a href="javascript:void(0)" onclick="shareWhatsApp()" class="share-option"><i class="ph ph-whatsapp-logo" style="color: #25D366;"></i> WhatsApp</a>
                <a href="javascript:void(0)" onclick="shareFacebook()" class="share-option"><i class="ph ph-facebook-logo" style="color: #1877F2;"></i> Facebook</a>
                <a href="javascript:void(0)" onclick="shareTwitter()" class="share-option"><i class="ph ph-x-logo" style="color: #000000;"></i> Twitter</a>
                <a href="javascript:void(0)" onclick="shareEmail()" class="share-option"><i class="ph ph-envelope" style="color: #EA4335;"></i> Email</a>
                <a href="javascript:void(0)" onclick="copyToClipboard()" class="share-option" style="grid-column: span 2;"><i class="ph ph-link"></i> Copy Room Link</a>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" class="modal-overlay" onclick="closeModal(event, 'lightboxModal')">
        <div class="lightbox-content">
            <span class="modal-close" style="color: white; top: 20px; right: 20px;" onclick="document.getElementById('lightboxModal').classList.remove('active')">✕</span>
            <img id="lightboxImg" src="" class="lightbox-img">
            <div class="lightbox-nav">
                <div class="lightbox-btn" onclick="prevImage(event)"><i class="ph ph-caret-left"></i></div>
                <div class="lightbox-btn" onclick="nextImage(event)"><i class="ph ph-caret-right"></i></div>
            </div>
        </div>
    </div>

    <!-- Tooltip / Toast -->
    <div id="toast" class="toast">
        <i class="ph-fill ph-check-circle" style="color: #4ade80;"></i>
        <span id="toastMsg">Link copied!</span>
    </div>

    @include('partials.footer')

    <script>
        // Room Data for Gallery
        const galleryImages = @if(str_contains($roomId, 'standard'))
            [
                "{{ asset('assets/standard/standard1.JPG') }}",
                "{{ asset('assets/standard/standard2.JPG') }}",
                "{{ asset('assets/standard/standard3.JPG') }}"
            ]
        @elseif(str_contains($roomId, 'advance'))
            [
                "{{ asset('assets/standard/std1.JPG') }}",
                "{{ asset('assets/standard/std2.JPG') }}",
                "{{ asset('assets/standard/std3.JPG') }}",
                "{{ asset('assets/standard/std4.JPG') }}",
                "{{ asset('assets/standard/std5.JPG') }}",
                "{{ asset('assets/standard/std6.JPG') }}"
            ]
        @elseif($roomId === 'suite-room')
            [
                "{{ asset('assets/standard/suite1.JPG') }}",
                "{{ asset('assets/standard/suite2.JPG') }}",
                "{{ asset('assets/standard/suite3.JPG') }}",
                "{{ asset('assets/standard/suite4.JPG') }}",
                "{{ asset('assets/standard/suite5.JPG') }}",
                "{{ asset('assets/standard/suite6.JPG') }}",
                "{{ asset('assets/standard/suite7.JPG') }}"
            ]
        @elseif($roomId === 'conference-hall')
            [
                "{{ asset('assets/standard/con1.JPG') }}",
                "{{ asset('assets/standard/con2.JPG') }}",
                "{{ asset('assets/standard/con3.JPG') }}",
                "{{ asset('assets/standard/con4.JPG') }}",
                "{{ asset('assets/standard/con5.JPG') }}"
            ]
        @elseif($roomId === 'glass-room')
            [
                "{{ asset('assets/standard/glass1.JPG') }}",
                "{{ asset('assets/standard/glass2.JPG') }}",
                "{{ asset('assets/standard/glass3.JPG') }}",
                "{{ asset('assets/standard/glass4.JPG') }}",
                "{{ asset('assets/standard/glass5.JPG') }}"
            ]
        @else
            [
                "{{ $room['img'] }}",
                "https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80",
                "https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80",
                "https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80"
            ]
        @endif;
        let currentImgIndex = 0;

        function changeImage(src, thumb) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
            currentImgIndex = galleryImages.indexOf(src);
        }

        function switchTab(tabId, btn) {
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            
            const targetPane = document.getElementById(tabId);
            if(targetPane) {
                targetPane.classList.add('active');
                btn.classList.add('active');
            }
        }

        // Like Functionality
        const roomId = "{{ $roomId }}";
        function initLike() {
            const liked = localStorage.getItem('liked_' + roomId);
            if (liked === 'true') {
                document.getElementById('likeBtn').classList.add('liked');
            }
        }

        function toggleLike() {
            const btn = document.getElementById('likeBtn');
            const isLiked = btn.classList.toggle('liked');
            localStorage.setItem('liked_' + roomId, isLiked);
            
            if (isLiked) {
                showToast("Added to your favorites!", "ph ph-heart");
                btn.style.transform = "scale(1.3)";
                setTimeout(() => btn.style.transform = "scale(1.1)", 200);
            } else {
                showToast("Removed from favorites");
            }
        }

        // Share Functionality
        function openShareModal() {
            document.getElementById('shareModal').classList.add('active');
        }

        function shareWhatsApp() {
            const text = encodeURIComponent("Check out this " + "{{ $room['name'] }}" + " at MCC International Guest House! Book now: " + window.location.href);
            window.open(`https://wa.me/?text=${text}`, '_blank');
        }

        function shareFacebook() {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, 'facebook-share-dialog', 'width=800,height=600');
        }

        function shareTwitter() {
            const text = encodeURIComponent("Amazing " + "{{ $room['name'] }}" + " at @MCCInnovation Park. Book now: ");
            window.open(`https://twitter.com/intent/tweet?text=${text}&url=${encodeURIComponent(window.location.href)}`, '_blank');
        }

        function shareEmail() {
            const subject = encodeURIComponent("Inquiry about " + "{{ $room['name'] }}");
            const body = encodeURIComponent("I found this room at MCC International Guest House and thought you might like it: " + window.location.href);
            window.location.href = `mailto:?subject=${subject}&body=${body}`;
        }

        async function copyToClipboard() {
            try {
                await navigator.clipboard.writeText(window.location.href);
                showToast("Link copied to clipboard!");
                document.getElementById('shareModal').classList.remove('active');
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }

        // Lightbox
        function openLightbox() {
            const modal = document.getElementById('lightboxModal');
            const img = document.getElementById('lightboxImg');
            img.src = document.getElementById('mainImage').src;
            modal.classList.add('active');
        }

        function nextImage(event) {
            event.stopPropagation();
            currentImgIndex = (currentImgIndex + 1) % galleryImages.length;
            document.getElementById('lightboxImg').src = galleryImages[currentImgIndex];
        }

        function prevImage(event) {
            event.stopPropagation();
            currentImgIndex = (currentImgIndex - 1 + galleryImages.length) % galleryImages.length;
            document.getElementById('lightboxImg').src = galleryImages[currentImgIndex];
        }

        function closeModal(event, modalId) {
            if (event.target.id === modalId) {
                document.getElementById(modalId).classList.remove('active');
            }
        }

        // Toast
        function showToast(msg, iconClass = "ph ph-check-circle") {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            toast.classList.add('active');
            setTimeout(() => toast.classList.remove('active'), 3000);
        }

        // Navigation Links
        function scrollToAmenities() {
            const btn = document.querySelectorAll('.tab-btn')[1];
            switchTab('amenities', btn);
            document.getElementById('amenities').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function scrollToReviews() {
            const btn = document.querySelector('.tab-btn:last-child');
            switchTab('reviews', btn);
            document.getElementById('reviews').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Handle Escape Key
        document.addEventListener('keydown', (e) => {
            if (e.key === "Escape") {
                document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('active'));
            }
            if (document.getElementById('lightboxModal').classList.contains('active')) {
                if (e.key === "ArrowRight") nextImage(new Event('click'));
                if (e.key === "ArrowLeft") prevImage(new Event('click'));
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', initLike);
    </script>
</body>
</html>
