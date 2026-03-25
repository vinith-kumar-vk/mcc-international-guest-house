<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conference / Glass Rooms - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6); display: none; justify-content: center; align-items: center; z-index: 1000;
            backdrop-filter: blur(4px);
        }
        .modal-overlay.active { display: flex; }
        .modal-card {
            background: white; border-radius: 16px; padding: 1.75rem; width: 90%; max-width: 580px; 
            position: relative; box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: modalPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden; 
        }
        @keyframes modalPop {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-close {
            position: absolute; top: 1rem; right: 1rem; background: white; border: none; 
            width: 32px; height: 32px; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; cursor: pointer; color: #555; transition: 0.2s; z-index: 20;
        }
        .modal-close:hover { color: var(--primary-color); transform: rotate(90deg); }
        .modal-img-container { position: relative; width: 100%; height: 180px; margin-bottom: 1.25rem; overflow: hidden; border-radius: 10px; }
        .room-img-modal { width: 100%; height: 100%; object-fit: cover; }
        .form-input { 
            height: 44px; padding: 10px 40px 10px 14px; border: 1px solid var(--border-color); 
            border-radius: 8px; font-family: 'Inter', sans-serif; font-size: 0.95rem; 
            transition: all 0.2s; width: 100%; max-width: 100%; line-height: 1.2; box-sizing: border-box !important;
            appearance: none; -webkit-appearance: none; min-width: 0;
        }
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(255, 122, 0, 0.1); }
        .datetime-wrapper { position: relative; width: 100%; }
        .datetime-icon {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            color: var(--text-light); font-size: 1.2rem; pointer-events: none; z-index: 5;
        }
        .form-input::-webkit-calendar-picker-indicator { 
            position: absolute; right: 0; top: 0; width: 100%; height: 100%;
            margin: 0; padding: 0; opacity: 0; cursor: pointer;
        }
        .line-clamp-2 {
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;  
            overflow: hidden; text-overflow: ellipsis;
        }
        .facility-compact {
            display: inline-flex; align-items: center; gap: 5px;
            background: #f8f9fa; color: var(--text-light);
            padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 500;
        }

        /* CARD PROPORTION FIXES */
        .card-image-wrapper { height: 150px !important; }
        .card-image-wrapper img { height: 100% !important; object-fit: cover; }
        .card-content { padding: 1rem !important; flex-direction: column; display: flex; }
        .card-header { margin-bottom: 0.25rem !important; }
        .card-header h2 { font-size: 1.35rem !important; margin: 0 !important; }
        .description { font-size: 0.85rem !important; margin-bottom: 0.4rem !important; color: #666; }
        .gst-text { margin-top: 0 !important; font-size: 0.75rem !important; }
        .price-highlight { margin-top: 0.25rem !important; font-size: 1.1rem !important; }
        
        .quick-schedule-box { 
            margin-top: 1rem !important; 
            background: #fbfbfb; 
            padding: 0.85rem !important; 
            border-radius: 10px; 
            border: 1px solid #eeeeee; 
        }

        /* RESPONSIVE GRID */
        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            width: 100%;
        }

        @media (max-width: 1024px) {
            .rooms-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .rooms-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body style="background: #fbfbfb;">
    <header>
        <div class="header-left">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="header-logo">
            </a>
        </div>
        <div class="header-center">
            <h1>MCC IGH</h1>
        </div>
        <div class="header-right">
            <a href="{{ route('home') }}" class="btn btn-outline" style="text-decoration: none;">Dashboard</a>
        </div>
    </header>

    <main style="padding-top: 100px; padding-bottom: 80px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <!-- Breadcrumbs -->
            <div class="breadcrumb" style="font-size: 1rem; margin-bottom: 1.5rem;">
                <a href="{{ route('home') }}" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Dashboard</a> 
                <span style="color: #333; margin: 0 8px;">></span> 
                <span style="color: var(--text-color); font-weight: 500;">Conference / Glass Rooms</span>
            </div>

            <div class="title-section" style="margin: 0rem 0 3.5rem 0; text-align: left;">
                <h1 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.6rem; color: #222; letter-spacing: -1px;">Conference / Glass Rooms</h1>
                <p style="color: #666; font-size: 1rem; font-weight: 400; line-height: 1.5; max-width: 600px;">Dedicated interactive halls for large meetings, corporate events, and collaborative sessions.</p>
            </div>

            @php
                $specialRooms = [
                    ['name' => 'Conference Hall', 'capacity' => 60, 'img' => 'https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60', 'desc' => 'Premium Hall Facility'],
                    ['name' => 'Glass Room', 'capacity' => 15, 'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60', 'desc' => 'Collaborative Facility'],
                    ['name' => 'Suite Room', 'capacity' => 2, 'img' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90', 'desc' => 'Luxury stay with premium comfort and privacy. <br><strong>Room No: 202</strong>'],
                ];
            @endphp

            <div class="rooms-grid">
                @foreach ($specialRooms as $room)
                @php $roomId = Str::slug($room['name']); @endphp
                <div class="card" data-name="{{ $room['name'] }}" style="background: white; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 4px 15px rgba(0,0,0,0.04); transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.04)';">
                    <div class="card-image-wrapper">
                        <img src="{{ $room['img'] }}" alt="{{ $room['name'] }}">
                        <span class="badge status-available">Available</span>
                        <span class="badge" style="top: 1rem; left: auto; right: 1rem; background: var(--primary-color); color: white;">Premium</span>
                    </div>
                    <div class="card-content">
                        <div class="card-header">
                            <h2>{{ $room['name'] }}</h2>
                            <div class="rating"><i class="ph-fill ph-users"></i> {{ $room['capacity'] }} Members</div>
                        </div>
                        <p class="description">{!! $room['desc'] !!}</p>
                        
                        <div class="price-highlight" style="font-size: 1.2rem; color: var(--primary-color); font-weight: 700; margin-top: 1rem;">
                            <span id="price-{{ $roomId }}">₹2000</span> <span style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">for </span><span id="time-text-{{ $roomId }}" style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">4 hours</span></div>
                        <p class="gst-text">+ 5% GST applicable</p>
                        
                        <!-- Quick Schedule & Duration -->
                        <div class="quick-schedule-box">
                            <div style="margin-bottom: 1rem;">
                                <label style="font-size: 0.75rem; font-weight:700; text-transform: uppercase; color: #888; margin-bottom: 4px; display: block;">Duration (Hours)</label>
                                <input type="number" id="hours-{{ $roomId }}" min="1" max="24" step="0.5" value="4" oninput="calcSpecialPrice('{{ $roomId }}')" class="form-input" style="background: white; border: 1px solid #ddd; height: 38px;">
                            </div>
                            <div class="datetime-col">
                                <label style="font-size: 0.75rem; font-weight:700; text-transform: uppercase; color: #888; margin-bottom: 4px; display: block;">Clock In</label>
                                <input type="datetime-local" class="form-input" style="background: white; border: 1px solid #ddd; height: 38px;">
                            </div>
                        </div>

                        <div class="card-actions" style="margin-top: 1.5rem; display:flex; gap: 0.8rem;">
                            <button class="btn btn-outline view-details-btn" style="flex: 1; padding: 0.7rem;" data-room="{{ $room['name'] }}" onclick="openDetailsModal('{{ $room['name'] }}', '{{ $room['img'] }}')">View Details</button>
                            <a href="{{ route('booking.form.full', ['room' => $roomId]) }}" class="btn" style="flex: 1; padding: 0.7rem;">Book Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Details Modal -->
    <div class="modal-overlay" id="detailsModal">
        <div class="hotel-modal">
            <button class="hotel-modal-close" onclick="closeModal('detailsModal')"><i class="ph-bold ph-x"></i></button>
            <div class="hotel-modal-image-wrapper">
                <img id="modalImg" src="" alt="Room">
            </div>
            
            <div class="hotel-modal-body">
                <div class="hotel-modal-header">
                    <h2 class="hotel-modal-title" id="detailsRoomNo"></h2>
                    <div class="hotel-modal-price">
                        <span id="detailsRoomPrice">₹2000</span> 
                        <span id="detailsRoomTime" style="font-size:0.85rem; color: var(--text-light); font-weight: 500;">/ 4 hrs</span>
                    </div>
                    <p class="gst-text">+ 5% GST applicable</p>
                </div>
                
                <div class="hotel-modal-feature-grid" id="modalFeatureGrid">
                    <!-- Chips dynamically injected -->
                </div>

                <div class="hotel-modal-why">
                    <h4 id="whyTitle">Why choose this space?</h4>
                    <ul id="whyList">
                        <!-- Dynamic points -->
                    </ul>
                </div>

                <p style="color:var(--text-light); margin-bottom:0; line-height:1.5; font-size: 0.95rem;" id="modalDesc">Professional facility equipped to host formal meetings and collaborative sessions.</p>
            </div>
            
            <div class="hotel-modal-footer">
                <a id="modalBookNowBtn" href="#" class="btn" style="width:100%;">Proceed to Booking</a>
            </div>
        </div>
    </div>

    <script>
        function calcSpecialPrice(roomId) {
            const hoursInput = document.getElementById('hours-' + roomId);
            const priceDisplay = document.getElementById('price-' + roomId);
            const timeTextDisplay = document.getElementById('time-text-' + roomId);
            
            let hours = parseFloat(hoursInput.value);
            if (isNaN(hours) || hours <= 0) {
                priceDisplay.innerHTML = '₹0';
                timeTextDisplay.innerHTML = '0 hours';
                return;
            }
            let finalPrice = hours > 4 ? 5000 : 2000;
            priceDisplay.innerHTML = '₹' + finalPrice;
            timeTextDisplay.innerHTML = hours + (hours === 1 ? ' hour' : ' hours');
        }

        function openDetailsModal(roomName, imgUrl) {
            const isGlass = roomName.toLowerCase().includes('glass');
            const roomId = roomName.toLowerCase().replace(/ /g, '-');
            const hoursInput = document.getElementById('hours-' + roomId);
            const duration = hoursInput ? hoursInput.value : 4;
            const price = duration > 4 ? 5000 : 2000;

            document.getElementById('modalImg').src = imgUrl;
            document.getElementById('detailsRoomNo').innerText = roomName;
            document.getElementById('detailsRoomPrice').innerText = '₹' + price;
            document.getElementById('detailsRoomTime').innerText = '/ ' + duration + (duration == 1 ? ' hr' : ' hrs');
            
            const featureGrid = document.getElementById('modalFeatureGrid');
            const whyList = document.getElementById('whyList');
            const modalDesc = document.getElementById('modalDesc');

            if (isGlass) {
                featureGrid.innerHTML = `
                    <span class="feature-chip"><i class="ph-fill ph-users"></i> 15 Members</span>
                    <span class="feature-chip"><i class="ph-fill ph-wind"></i> AC</span>
                    <span class="feature-chip"><i class="ph-fill ph-briefcase"></i> Meeting Setup</span>
                    <span class="feature-chip"><i class="ph-fill ph-wifi-high"></i> WiFi</span>
                `;
                whyList.innerHTML = `
                    <li>Modern aesthetic</li>
                    <li>Collaborative setup</li>
                    <li>Great for small teams</li>
                `;
                modalDesc.innerText = "A premium glass-walled facility designed for high-impact meetings and collaborative team sessions.";
            } else {
                featureGrid.innerHTML = `
                    <span class="feature-chip"><i class="ph-fill ph-users"></i> 60 Members</span>
                    <span class="feature-chip"><i class="ph-fill ph-projector-screen"></i> Projector</span>
                    <span class="feature-chip"><i class="ph-fill ph-microphone-stage"></i> Audio System</span>
                    <span class="feature-chip"><i class="ph-fill ph-wind"></i> AC</span>
                `;
                whyList.innerHTML = `
                    <li>Large capacity</li>
                    <li>Professional AV setup</li>
                    <li>Ideal for seminars</li>
                `;
                modalDesc.innerText = "A spacious and professional hall equipped to host formal presentations, large meetings, and corporate events.";
            }

            document.getElementById('modalBookNowBtn').href = "{{ route('booking.form.full') }}?room=" + roomId;
            document.getElementById('detailsModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('detailsModal')) document.getElementById('detailsModal').classList.remove('active');
        }
    </script>
</body>
</html>
