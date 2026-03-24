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
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 1000; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: white; border-radius: 12px; padding: 2.5rem; width: 90%; max-width: 650px; max-height: 90vh; overflow-y: auto; position: relative; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .modal-close { position: absolute; top: 1.5rem; right: 1.5rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #555; transition: 0.2s; }
        .modal-close:hover { color: var(--primary-color); transform: scale(1.1); }
        .room-img-modal { width: 100%; height: 260px; object-fit: cover; border-radius: 8px; margin-bottom: 1.5rem; }
        .form-input { padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 6px; font-family: 'Inter', sans-serif; font-size: 0.9rem; transition: border-color 0.2s; width: 100%; }
        .form-input:focus { outline: none; border-color: var(--primary-color); }
        .breadcrumb { font-size: 0.95rem; color: var(--text-light); margin-bottom: 2rem; font-weight: 500; }
        .breadcrumb a { color: var(--primary-color); text-decoration: none; transition: 0.2s; }
        .breadcrumb a:hover { text-decoration: underline; color: #cc4800; }
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
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Dashboard</a> &gt; <span style="color: var(--text-color);">Conference / Glass Rooms</span>
            </div>

            <div class="title-section" style="margin: 0rem 0 3rem 0; text-align: left;">
                <h2 style="font-size: 2.2rem; margin-bottom: 0.5rem; color: var(--text-color);">Conference / Glass Rooms</h2>
                <p style="color: var(--text-light); font-size: 1.05rem;">Dedicated interactive halls for large meetings, corporate events, and collaborative sessions.</p>
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
                        <div style="margin-top: 1.5rem; background: #fafafa; padding: 1rem; border-radius: 8px; border: 1px solid #f0f0f0;">
                            <div style="margin-bottom: 0.8rem;">
                                <label style="font-size: 0.75rem; font-weight:600; display:block; margin-bottom:4px; color: var(--text-light);">Select Duration (Hours):</label>
                                <input type="number" id="hours-{{ $roomId }}" min="1" max="24" step="0.5" value="4" oninput="calcSpecialPrice('{{ $roomId }}')" class="form-input" style="padding:0.5rem; font-size:0.8rem; background: white;">
                            </div>
                            <div style="display: flex; gap: 0.8rem; align-items: center;">
                                <div style="flex:1;">
                                    <label style="font-size: 0.75rem; font-weight:600; display:block; margin-bottom:4px; color: var(--text-light);">Clock In</label>
                                    <input type="datetime-local" class="form-input" style="padding:0.5rem; font-size:0.8rem; background: white;">
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
            <img id="modalImg" src="" alt="Room" class="room-img-modal">
            
            <h2 style="font-size:1.8rem; margin-bottom: 0.5rem; color: var(--text-color);"><span id="detailsRoomNo"></span></h2>
            <div class="price-highlight" style="font-size: 1.4rem; margin-bottom: 1rem; color: var(--primary-color); font-weight: 700;">₹2000 <span style="font-size:0.95rem; color: var(--text-light); font-weight: 500;">/ 4 hrs</span> <span style="font-size:0.85rem; color:#888; font-weight: 500; margin-left: 0.5rem;">+ 5% GST</span></div>
            
            <p style="color:var(--text-light); margin-bottom:1.5rem; line-height:1.7; font-size: 1.05rem;">An interactive and professional facility equipped to host formal meetings, presentations, and large-scale collaborative sessions.</p>
            
            <h4 style="margin-bottom:1rem; font-size: 1.1rem; color: var(--text-color);">Hall Facilities</h4>
            <div style="display:flex; flex-wrap:wrap; gap:1rem; margin-bottom: 2.5rem;">
                <span class="badge" style="background:#fff4ed; color:var(--primary-color); padding: 0.6rem 1rem; border: 1px solid rgba(230, 81, 0, 0.1); font-size: 0.9rem;"><i class="ph ph-wifi-high" style="margin-right:4px;"></i> High-Speed WiFi</span>
                <span class="badge" style="background:#fff4ed; color:var(--primary-color); padding: 0.6rem 1rem; border: 1px solid rgba(230, 81, 0, 0.1); font-size: 0.9rem;"><i class="ph ph-wind" style="margin-right:4px;"></i> Central AC</span>
                <span class="badge" style="background:#fff4ed; color:var(--primary-color); padding: 0.6rem 1rem; border: 1px solid rgba(230, 81, 0, 0.1); font-size: 0.9rem;"><i class="ph ph-projector-screen" style="margin-right:4px;"></i> Projector Setup</span>
                <span class="badge" style="background:#fff4ed; color:var(--primary-color); padding: 0.6rem 1rem; border: 1px solid rgba(230, 81, 0, 0.1); font-size: 0.9rem;"><i class="ph ph-chalkboard-teacher" style="margin-right:4px;"></i> Whiteboard</span>
            </div>
            
            <a id="modalBookNowBtn" href="#" class="btn" style="width:100%; padding: 1.2rem; font-size: 1.1rem; font-weight: 600; text-align: center; text-decoration: none; display: block; box-sizing: border-box; box-shadow: 0 6px 15px rgba(230, 81, 0, 0.2);">Proceed to Booking Form</a>
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
