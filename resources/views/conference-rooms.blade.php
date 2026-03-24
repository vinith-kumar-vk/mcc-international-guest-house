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
                    ['name' => 'Conference Hall', 'capacity' => 60, 'img' => 'https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'],
                    ['name' => 'Glass Room', 'capacity' => 15, 'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'],
                ];
            @endphp

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 2rem;">
                @foreach ($specialRooms as $room)
                @php $roomId = Str::slug($room['name']); @endphp
                <div class="card" data-name="{{ $room['name'] }}" style="background: white; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 4px 15px rgba(0,0,0,0.04); transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.04)';">
                    <div class="card-image-wrapper">
                        <img src="{{ $room['img'] }}" alt="{{ $room['name'] }}">
                        <span class="badge status-available">Available</span>
                    </div>
                    <div class="card-content">
                        <div class="card-header">
                            <h2>{{ $room['name'] }}</h2>
                            <div class="rating"><i class="ph-fill ph-users"></i> {{ $room['capacity'] }} Members</div>
                        </div>
                        <p class="description">Premium Hall Facility</p>
                        
                        <div class="price-highlight" style="font-size: 1.2rem; color: var(--primary-color); font-weight: 700; margin-top: 1rem;">
                            <span id="price-{{ $roomId }}">₹2000</span> <span style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">for </span><span id="time-text-{{ $roomId }}" style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">4 hours</span></div>
                        <p style="font-size: 0.8rem; color: #888; margin-top: 2px; font-weight: 500;">+ 5% GST applicable</p>
                        
                        <!-- Quick Schedule & Duration -->
                        <div style="margin-top: 1.5rem; background: #fbfbfb; padding: 1.15rem; border-radius: 10px; border: 1px solid #eeeeee; width: 100%; box-sizing: border-box; overflow: hidden;">
                            <div style="margin-bottom: 1rem; min-width: 0;">
                                <label style="font-size: 0.7rem; font-weight:700; text-transform: uppercase; display:block; margin-bottom:6px; color: #888; letter-spacing: 0.5px;">Duration (Hours)</label>
                                <input type="number" id="hours-{{ $roomId }}" min="1" max="24" step="0.5" value="4" oninput="calcSpecialPrice('{{ $roomId }}')" class="form-input" style="background: white; border: 1px solid #ddd; padding: 10px 14px; width: 100%;">
                            </div>
                            <div style="min-width: 0;">
                                <label style="font-size: 0.7rem; font-weight:700; text-transform: uppercase; display:block; margin-bottom:6px; color: #888; letter-spacing: 0.5px;">Clock In</label>
                                <div class="datetime-wrapper" style="width: 100%;">
                                    <i class="ph ph-calendar-blank datetime-icon"></i>
                                    <input type="datetime-local" class="form-input" style="background: white; border: 1px solid #ddd;">
                                </div>
                            </div>
                        </div>

                        <div class="card-actions" style="margin-top: 1.5rem; display:flex; gap: 0.8rem;">
                            <button class="btn btn-outline" style="flex: 1; padding: 0.7rem; transition: 0.2s;" onclick="openDetailsModal('{{ $room['name'] }}', '{{ $room['img'] }}')">View Details</button>
                            <a href="{{ route('booking.form.full', ['room' => $roomId]) }}" class="btn" style="flex: 1; padding: 0.7rem; text-align: center; text-decoration: none; transition: 0.2s; box-shadow: 0 4px 10px rgba(230, 81, 0, 0.2);">Book Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Details Modal -->
    <div class="modal-overlay" id="detailsModal">
        <div class="modal-card">
            <button class="modal-close" onclick="closeModal('detailsModal')"><i class="ph-bold ph-x"></i></button>
            <div class="modal-img-container">
                <img id="modalImg" src="" alt="Room" class="room-img-modal">
            </div>
            
            <h2 style="font-size:1.5rem; margin-bottom: 0.25rem; color: var(--text-color);"><span id="detailsRoomNo"></span></h2>
            <div class="price-highlight" style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--primary-color); font-weight: 700;">₹2000 <span style="font-size:0.85rem; color: var(--text-light); font-weight: 500;">/ 4 hrs</span></div>
            
            <p class="line-clamp-2" style="color:var(--text-light); margin-bottom:1rem; line-height:1.5; font-size: 0.95rem;">An interactive and professional facility equipped to host formal meetings, presentations, and large-scale collaborative sessions.</p>
            
            <div style="display:flex; flex-wrap:wrap; gap:0.5rem; margin-bottom: 1.25rem;">
                <span class="facility-compact"><i class="ph ph-wifi-high"></i> WiFi</span>
                <span class="facility-compact"><i class="ph ph-wind"></i> AC</span>
                <span class="facility-compact"><i class="ph ph-projector-screen"></i> Projector</span>
            </div>
            
            <a id="modalBookNowBtn" href="#" class="btn" style="width:100%; padding: 1rem; font-size: 1rem; font-weight: 600; text-align: center; text-decoration: none; display: block; box-sizing: border-box; margin-top: 12px;">Proceed to Booking Form</a>
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

        function openDetailsModal(roomName, roomImg) {
            document.getElementById('detailsRoomNo').innerText = roomName;
            document.getElementById('modalImg').src = roomImg;
            document.getElementById('modalBookNowBtn').href = "{{ route('booking.form.full') }}?room=" + encodeURIComponent(roomName.toLowerCase().replace(/ /g, '-'));
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
