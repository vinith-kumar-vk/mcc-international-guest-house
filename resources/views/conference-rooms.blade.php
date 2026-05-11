<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conference / Glass Rooms - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        /* Room grid base is in responsive.css, but we keep our specific gap/margin */

        .modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0; 
            background: rgba(0,0,0,0.7) !important; backdrop-filter: blur(6px) !important;
            display: none; align-items: center; justify-content: center; z-index: 5000;
            opacity: 0; visibility: hidden; transition: all 0.3s ease;
            padding: 15px;
        }
        .modal-overlay.active { display: flex !important; opacity: 1 !important; visibility: visible !important; }
        .modal-card {
            background: white; border-radius: 20px; width: 100%; max-width: 500px; 
            position: relative; box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            animation: modalPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden; display: flex; flex-direction: column;
            margin: auto; line-height: 1.3; max-height: 95vh;
        }
        @keyframes modalPop {
            from { opacity: 0; transform: scale(0.9) translateY(30px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-close {
            position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.9); border: none; 
            width: 28px; height: 28px; border-radius: 50%; box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; cursor: pointer; color: #333; transition: all 0.3s; z-index: 100;
        }
        .modal-close:hover { color: white; transform: rotate(90deg); }
        .modal-img-container { position: relative; width: 100%; height: 150px; overflow: hidden; flex-shrink: 0; }
        .room-img-modal { width: 100%; height: 100%; object-fit: cover; }
        .modal-body { padding: 1rem 1.25rem; flex: 1; display: flex; flex-direction: column; gap: 0.35rem; overflow: hidden; }
        .modal-title { font-size: 1.4rem; color: #111; margin: 0; font-weight: 800; letter-spacing: -0.5px; }
        .modal-price-line { font-size: 1rem; font-weight: 700; color: var(--primary-color); display: flex; align-items: baseline; gap: 4px; }
        .modal-divider { height: 1px; background: #eee; margin: 0.2rem 0; width: 100%; }
        .facility-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 6px; margin-top: 2px; }
        .facility-item { background: #f8f9fa; color: #444; padding: 6px 4px; border-radius: 6px; font-size: 0.75rem; display: flex; align-items: center; gap: 4px; border: 1px solid #eee; font-weight: 500; text-align: center; justify-content: center; flex-direction: column; }
        .facility-item i { font-size: 0.9rem; color: var(--primary-color); }

        /* Help Modal Styles */


        .help-modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);
            display: none; align-items: center; justify-content: center; z-index: 6000;
            opacity: 0; visibility: hidden; transition: all 0.3s ease;
        }
        .help-modal-overlay.active { display: flex; opacity: 1; visibility: visible; }
        .help-modal-card {
            background: white; border-radius: 16px; width: 100%; max-width: 600px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2); position: relative;
            padding: 40px; animation: modalSlideUp 0.4s ease; margin: 20px;
        }
        @keyframes modalSlideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .help-modal-close {
            position: absolute !important; top: 20px !important; right: 20px !important; left: auto !important;
            background: none !important; border: none !important; box-shadow: none !important;
            font-size: 1.5rem !important; color: #999 !important; cursor: pointer; transition: color 0.3s;
            display: flex !important; align-items: center !important; justify-content: center !important;
            width: 32px !important; height: 32px !important; padding: 0 !important;
            z-index: 10;
        }
        .help-modal-close:hover { color: #333 !important; background: none !important; box-shadow: none !important; transform: none !important; }
        .help-modal-title { text-align: center; font-size: 1.8rem; font-weight: 700; color: #111; margin-bottom: 25px; margin-top: 0; }
        .help-form { display: flex; flex-direction: column; gap: 15px; }
        .help-form-row { display: flex; flex-direction: column; gap: 15px; }
        .help-input-group { display: flex; flex-direction: column; gap: 6px; width: 100%; }
        .help-input-group.full-width { width: 100%; }
        .help-input-group label { font-size: 0.85rem; font-weight: 700; color: #444; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
        .help-input-group input, .help-input-group select, .help-input-group textarea {
            padding: 14px 16px !important; border: 1px solid #ddd !important; border-radius: 8px !important;
            font-family: inherit; font-size: 1rem !important; transition: all 0.3s; background: #fafafa !important;
            width: 100% !important; display: block !important; box-sizing: border-box !important;
        }
        .help-input-group input:focus, .help-input-group select:focus, .help-input-group textarea:focus {
            border-color: var(--primary-color) !important; outline: none !important; background: #fff !important; box-shadow: 0 0 0 4px rgba(255, 122, 0, 0.1) !important;
        }

        .custom-dropdown { position: relative; width: 100%; }
        .dropdown-selected {
            padding: 14px 16px; border: 1px solid #ddd; border-radius: 8px;
            display: flex; justify-content: space-between; align-items: center;
            cursor: pointer; background: #fafafa; transition: 0.3s;
        }
        .dropdown-selected:hover { border-color: #bbb; }
        .dropdown-selected span { color: #333; font-weight: 500; }
        .dropdown-selected i { color: #999; font-size: 1.2rem; }
        .dropdown-options {
            position: absolute; top: calc(100% + 5px); left: 0; right: 0;
            background: white; border: 1px solid #ddd; border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 10;
            max-height: 250px; overflow-y: auto; display: none;
        }
        .dropdown-options.active { display: block; }
        .dropdown-option {
            padding: 12px 16px; font-size: 0.95rem; color: #444; cursor: pointer;
            transition: background 0.2s; border-bottom: 1px solid #f5f5f5;
        }
        .dropdown-option:last-child { border-bottom: none; }
        .dropdown-option:hover { background: #fff8f3; color: var(--primary-color); }
        .help-form-footer { display: flex; justify-content: flex-end; margin-top: 10px; }
        .help-send-btn {
            background: var(--primary-color) !important;
            color: #ffffff !important;
            border: none !important;
            padding: 0.9rem 1.5rem !important;
            border-radius: 12px !important;
            font-size: 0.95rem !important;
            font-weight: 800 !important;
            letter-spacing: 0.5px !important;
            text-transform: uppercase !important;
            cursor: pointer !important;
            width: 100% !important;
            display: block !important;
            transform: none !important;
            box-shadow: 0 4px 14px rgba(255, 122, 0, 0.35) !important;
            transition: background 0.2s ease, box-shadow 0.2s ease !important;
        }
        .help-send-btn:hover {
            background: var(--primary-color) !important;
            box-shadow: 0 4px 18px rgba(255, 122, 0, 0.45) !important;
            transform: none !important;
            width: 100% !important;
            padding: 0.9rem 1.5rem !important;
        }
        .help-send-btn:focus,
        .help-send-btn:active {
            background: var(--primary-color) !important;
            transform: none !important;
            box-shadow: 0 4px 14px rgba(255, 122, 0, 0.35) !important;
        }
        .help-modal-card button:active { transform: none !important; scale: 1 !important; }
        

        /* View Details button hover/active fix */
        .card-actions .btn-outline:hover,
        .card-actions .btn-outline:focus {
            background-color: var(--primary-color) !important;
            color: #ffffff !important;
            border-color: var(--primary-color) !important;
        }
        .card-actions .btn-outline:active {
            background-color: var(--primary-color) !important;
            color: #ffffff !important;
            border-color: var(--primary-color) !important;
            filter: brightness(80%) !important;
        }

        /* Card Alignment Fixes */
        .card { 
            display: flex !important; 
            flex-direction: column !important; 
            height: 100% !important; 
            background: #fff !important;
            border-radius: 16px !important;
            border: 1px solid #e2e8f0 !important;
            transition: all 0.3s ease !important;
            padding: 0 !important; /* Padding moved to content */
        }
        .card:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1) !important;
        }
        .card-content { 
            flex: 1 !important; 
            display: flex !important; 
            flex-direction: column !important; 
            padding: 1.5rem !important;
        }
        .card-header { 
            min-height: 52px !important; 
            display: flex !important; 
            flex-direction: column !important; 
            justify-content: flex-start !important;
            align-items: flex-start !important;
            margin-bottom: 0.25rem !important;
        }
        .card h2 { 
            color: #0f172a !important; 
            font-weight: 800 !important; 
            margin-bottom: 0 !important; 
            font-size: 1.3rem !important;
        }
        .card-header .rating {
            margin-bottom: 0.2rem !important;
            font-size: 0.8rem !important;
            color: #64748b !important;
        }
        .card .description { 
            color: #475569 !important; 
            font-weight: 500 !important; 
            min-height: 85px !important; 
            margin-bottom: 0.75rem !important;
            line-height: 1.4 !important;
            font-size: 0.9rem !important;
        }
        .price-section {
            min-height: 60px !important;
            display: flex !important;
            flex-direction: column !important;
            margin-bottom: 1rem !important;
            justify-content: center !important;
            align-items: flex-start !important;
        }
        .price-highlight { 
            display: flex !important; 
            align-items: baseline !important; 
            gap: 5px !important;
            margin-bottom: 0 !important;
            font-size: 1.35rem !important;
            font-weight: 800 !important;
            color: var(--primary-color) !important;
        }
        .card .gst-text { 
            color: #64748b !important; 
            font-weight: 600 !important; 
            margin-bottom: 0 !important;
            font-size: 0.8rem !important;
            min-height: 18px !important;
        }
        .room-features-box {
            margin-bottom: 0.5rem !important;
            padding: 0.75rem !important;
            background: #f8fafc !important;
            border-radius: 12px !important;
            border: 1px dashed #cbd5e1 !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            min-height: 140px !important;
        }
        .features-title {
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            color: #64748b !important;
            margin-bottom: 0.6rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
        }
        .features-grid {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 8px !important;
            font-size: 0.75rem !important;
            color: #475569 !important;
            margin-bottom: 0.5rem !important;
        }
        .features-footer-text {
            font-size: 0.7rem !important;
            color: #94a3b8 !important;
            font-style: italic !important;
            border-top: 1px solid rgba(0,0,0,0.05) !important;
            padding-top: 0.4rem !important;
            margin-bottom: 1.5rem !important; /* Breathing room before buttons */
        }
        .card-actions { 
            margin-top: auto !important; /* Pushes buttons to the absolute bottom */
            display: flex !important; 
            gap: 10px !important; 
            width: 100% !important;
            padding-top: 1rem !important;
        }
        .btn-outline { border-width: 2px !important; font-weight: 700 !important; }

        .card .description { 
            color: #475569 !important; 
            font-weight: 500 !important; 
            margin-bottom: 0.5rem !important;
            line-height: 1.4 !important;
            font-size: 0.95rem !important;
            min-height: 48px !important;
        }

        /* Header Centering */
        .header-container { position: relative; display: flex; justify-content: space-between; align-items: center; padding: 1rem 2rem; }
        .header-title {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            white-space: nowrap;
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }
    </style>
    @include('partials.dynamic-styles')
</head>
<body style="background: #fbfbfb;">
    @include('partials.header', ['headerBackBtn' => ['url' => route('home'), 'label' => 'Home'], 'showHelpBtn' => true])

    <main>
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.25rem;">
            <!-- Breadcrumbs -->
            <div class="breadcrumb" style="font-size: 1rem; margin-bottom: 1.5rem;">
                <a href="{{ route('home') }}" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Home</a> 
                <span style="color: #333; margin: 0 8px;">></span> 
                <span style="color: var(--text-color); font-weight: 500;">Conference / Glass Rooms</span>
            </div>

            <div class="title-section" style="margin: 0rem 0 3.5rem 0; text-align: left;">
                <h1 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.6rem; color: #222; letter-spacing: -1px;">Conference / Glass Rooms</h1>
                <p style="color: #666; font-size: 1rem; font-weight: 400; line-height: 1.5; max-width: 600px;">A versatile and professionally equipped venue designed for large-scale gatherings, corporate events, and interactive workshops with HD projection.</p>
            </div>

            @php
                $specialRooms = [
                    [
                        'name' => 'Conference Hall', 
                        'capacity' => 60, 
                        'img' => asset('assets/standard/conference.JPG'), 
                        'desc' => 'Professional hall featuring HD projection, high-grade acoustics, and seating for 60 members.',
                        'amenities' => [
                            ['name' => 'High-Speed WiFi', 'icon' => 'ph-wifi-high'],
                            ['name' => 'Projector / Screen', 'icon' => 'ph-projector-screen'],
                            ['name' => 'AC Space', 'icon' => 'ph-snowflake'],
                            ['name' => '60 Members', 'icon' => 'ph-users'],
                            ['name' => 'Presentation Setup', 'icon' => 'ph-chalkboard'],
                        ],
                        'theme' => ['bg' => '#f0f4ff', 'border' => '#4e73df', 'icon' => '#4e73df', 'title' => 'Facility Features']
                    ],
                    [
                        'name' => 'Glass Room', 
                        'capacity' => 15, 
                        'img' => asset('assets/standard/glass.JPG'), 
                        'desc' => 'Modern transparent facility designed for collaborative brainstorming and focused team sessions with ample natural light.',
                        'amenities' => [
                            ['name' => 'Modern Furniture', 'icon' => 'ph-armchair'],
                            ['name' => 'High Speed WiFi', 'icon' => 'ph-wifi-high'],
                            ['name' => 'Charging Ports', 'icon' => 'ph-plug-connected'],
                            ['name' => 'Glass Walls', 'icon' => 'ph-squares-four'],
                            ['name' => 'AC', 'icon' => 'ph-snowflake'],
                            ['name' => 'Presentation Support', 'icon' => 'ph-presentation-chart'],
                        ],
                        'theme' => ['bg' => '#fff8f3', 'border' => 'var(--primary-color)', 'icon' => 'var(--primary-color)', 'title' => 'Premium Features']
                    ],
                    [
                        'name' => 'Suite Room', 
                        'capacity' => 2, 
                        'img' => asset('assets/suite.JPG'), 
                        'desc' => 'Our flagship Suite Room offers the pinnacle of luxury, featuring a grand king-size bed and premium toiletries for ultimate relaxation. <br><span style="display:inline-flex; align-items:center; gap:5px; margin-top:6px; background: var(--primary-color); color:#fff; font-size:0.75rem; font-weight:700; padding:3px 10px; border-radius:20px; letter-spacing:0.5px;"><i class=\"ph-bold ph-door\"></i> Room No: 202</span>',
                        'amenities' => [
                            ['name' => 'King Size Bed', 'icon' => 'ph-bed'],
                            ['name' => 'Smart TV', 'icon' => 'ph-television'],
                            ['name' => 'Mini Fridge', 'icon' => 'ph-snowflake'],
                            ['name' => 'Premium Toiletries', 'icon' => 'ph-spray-bottle'],
                            ['name' => 'Spacious Interior', 'icon' => 'ph-arrows-out'],
                        ],
                        'theme' => ['bg' => '#fff9e6', 'border' => '#d4af37', 'icon' => '#d4af37', 'title' => 'Luxury Features']
                    ],
                ];
            @endphp

            <!-- Room Grid -->
            <div class="rooms-grid">
                @foreach ($specialRooms as $room)
                @php $roomId = Str::slug($room['name']); @endphp
                <div class="card" data-name="{{ $room['name'] }}">
                    <div class="card-image-wrapper">
                        <img src="{{ $room['img'] }}" alt="{{ $room['name'] }}">
                        @if(isset($bookedRooms[$room['name']]) || isset($bookedRooms[$roomId]))
                            <span class="badge" style="background:#dc3545; color: white;">Booked</span>
                        @else
                            <span class="badge status-available">Available</span>
                        @endif
                        <span class="badge" style="top: 1rem; left: auto; right: 1rem; background: var(--primary-color); color: white;">Premium</span>
                    </div>
                    <div class="card-content">
                        <div class="card-header">
                            <h2>{{ $room['name'] }}</h2>
                            <div class="rating"><i class="ph-fill ph-users"></i> {{ $room['capacity'] }} Members</div>
                        </div>
                        
                        <!-- 1. Description -->
                        <p class="description" style="margin-top: 0 !important; margin-bottom: 2px !important; line-height: 1.4 !important;">{!! $room['desc'] !!}</p>
                        
                        <!-- 2. Pricing Section (Zero Gap) -->
                        <div class="price-section">
                            <div class="price-highlight">
                                <span id="price-{{ $roomId }}">₹2000</span> 
                                <span style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">for </span>
                                <span id="time-text-{{ $roomId }}" style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">4 hours</span>
                            </div>
                            <p class="gst-text">+ {{ $gstRate }}% GST applicable</p>
                        </div>
                        
                        <!-- 3. Room Features (Tight Spacing) -->
                        <div class="room-features-box" style="background: {{ $room['theme']['bg'] }}; border-color: {{ $room['theme']['border'] }};">
                            <h3 class="features-title">{{ $room['theme']['title'] }}</h3>
                            <div class="features-grid">
                                @foreach($room['amenities'] as $amenity)
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <i class="ph {{ $amenity['icon'] }}" style="color: {{ $room['theme']['icon'] }};"></i> 
                                    {{ $amenity['name'] }}
                                </div>
                                @endforeach
                            </div>
                            <p class="features-footer-text">
                                {{ $room['name'] === 'Suite Room' ? 'Luxury stay with maximum comfort' : ($room['name'] === 'Glass Room' ? 'Designed for transparency and innovation' : 'Perfect for meetings and collaboration') }}
                            </p>
                        </div>

                        @php 
                            $bookedInfo = $bookedRooms[$room['name']] ?? $bookedRooms[$roomId] ?? null;
                        @endphp
                        @if($bookedInfo)
                            <div class="next-available" style="margin-bottom: 0.5rem; padding: 0.5rem; background: #fff1f2; border-radius: 8px; border: 1px solid #fee2e2; text-align: center; min-height: 60px; display: flex; align-items: center; justify-content: center;">
                                <p style="font-size: 0.7rem; font-weight: 700; color: #991b1b; margin: 0;">
                                    <i class="ph-bold ph-clock-countdown"></i> Booked - Next: {{ date('d M, Y', strtotime($bookedInfo['date'])) }}
                                </p>
                            </div>
                        @else
                            <div class="next-available-placeholder" style="margin-bottom: 0.5rem; height: 60px;"></div> <!-- Spacer for breathing room if not booked -->
                        @endif

                        <div class="card-actions" style="margin-top: auto;">
                            <a href="{{ route('room.details', ['id' => $roomId]) }}" class="btn btn-outline" style="flex: 1; justify-content: center; text-align: center; text-transform: uppercase;">View Details</a>
                            <a href="{{ route('booking.form.full', ['room' => $room['name']]) }}" class="btn" style="flex: 1; justify-content: center; text-transform: uppercase; {{ $bookedInfo ? 'opacity: 0.7; pointer-events: none; background: #bc8e8e; border-color: #bc8e8e;' : '' }}">
                                {{ $bookedInfo ? 'Booked' : 'Book Now' }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>@include('partials.footer')

    <!-- Modal Modal -->
    <div class="modal-overlay" id="detailsModal">
        <div class="modal-card">
            <button class="modal-close" onclick="closeModal('detailsModal')"><i class="ph-bold ph-x"></i></button>
            <div class="modal-img-container">
                <img src="" alt="Room" class="room-img-modal" id="modalImg">
            </div>
            
            <div class="modal-body">
                <h2 class="modal-title" id="modalRoomTitle">Room Details</h2>
                
                <div class="modal-price-line">
                    <span id="modalRoomPrice">₹0</span> 
                    <span style="font-size: 0.95rem; color: #666; font-weight: 600;" id="modalRoomTime">/ period</span>
                    <span style="font-size: 0.85rem; color: #999; font-weight: 500;">+ {{ $gstRate }}% GST</span>
                </div>

                <p style="color: #666; line-height: 1.4; font-size: 0.85rem; margin: 0.25rem 0;" id="modalRoomDesc"></p>
                
                <div class="modal-divider"></div>
                
                <h3 style="font-size: 1rem; font-weight: 800; color: #111; margin: 0.25rem 0 0.5rem 0; display: flex; align-items: center; gap: 6px;">
                    Room Facilities
                </h3>
                <div class="facility-grid" id="modalFacilitiesContainer">
                    <!-- Dynamic Facilities -->
                </div>
            </div>

            <div class="modal-footer" style="padding: 1rem 1.25rem; background: #fff; border-top: 1px solid #eee; flex-shrink: 0;">
                <a id="modalBookNowBtn" href="#" class="btn" style="width:100%; text-align: center; border-radius: 10px; font-weight: 700; font-size: 1rem; background: var(--primary-color); color: white; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; padding: 0.75rem;">
                    Proceed to Booking Form <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Help Modal -->
    @include('partials.help-modal')


    <script>
        function calcSpecialPrice(id) {
            const h = document.getElementById('hours-' + id).value || 4;
            const price = h * 500;
            document.getElementById('price-' + id).innerText = '₹' + price;
            document.getElementById('time-text-' + id).innerText = h + ' hours';
            
            // Update button data if needed, but the button stays fixed at original price for View Details usually
            // or we could dynamically update button data attributes too.
        }

        window.showQuickRoomDetails = function(btn) {
            const data = btn.dataset;
            document.getElementById('modalRoomTitle').innerText = data.name;
            document.getElementById('modalRoomPrice').innerText = data.price;
            document.getElementById('modalRoomTime').innerText = data.time;
            document.getElementById('modalImg').src = data.img;
            document.getElementById('modalRoomDesc').innerText = data.desc;
            
            const isBooked = data.booked === 'true';
            const bookBtn = document.getElementById('modalBookNowBtn');
            if (isBooked) {
                bookBtn.style.opacity = '0.5';
                bookBtn.style.cursor = 'not-allowed';
                bookBtn.style.pointerEvents = 'none';
                bookBtn.innerHTML = 'Currently Booked <i class="ph-bold ph-lock-key"></i>';
                bookBtn.removeAttribute('href');
            } else {
                bookBtn.style.background = 'var(--primary-color)';
                bookBtn.style.cursor = 'pointer';
                bookBtn.style.pointerEvents = 'auto';
                bookBtn.innerHTML = 'Proceed to Booking Form <i class="ph-bold ph-arrow-right"></i>';
                bookBtn.href = "{{ route('booking.form.full') }}?room=" + data.room;
            }
            
            const container = document.getElementById('modalFacilitiesContainer');
            container.innerHTML = '';
            const facilities = data.facilities.split(',');
            facilities.forEach(f => {
                const [name, icon] = f.split(':');
                if (name && icon) {
                    const div = document.createElement('div');
                    div.className = 'facility-item';
                    div.innerHTML = `<i class="ph-bold ${icon}"></i> <span>${name}</span>`;
                    container.appendChild(div);
                }
            });

            document.getElementById('detailsModal').classList.add('active');
        };

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }



        document.addEventListener('DOMContentLoaded', () => {
            const detailsModal = document.getElementById('detailsModal');
            const helpModal = document.getElementById('helpModal');

            window.onclick = function(event) {
                if (event.target == detailsModal) closeModal('detailsModal');
                if (event.target == helpModal) closeHelpModal();
            }
        });
    </script>
</body>
</html>
