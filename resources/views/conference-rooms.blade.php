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
        .rooms-grid {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 2rem !important;
            margin-top: 2rem !important;
        }
        @media (max-width: 1024px) { .rooms-grid { grid-template-columns: repeat(2, 1fr) !important; } }
        @media (max-width: 768px) { .rooms-grid { grid-template-columns: 1fr !important; } }

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
        .modal-close:hover { background: #ff4757; color: white; transform: rotate(90deg); }
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
        .help-btn {
            background: none; border: none; font-family: 'Inter', sans-serif;
            font-size: 0.95rem; font-weight: 600; color: #444; cursor: pointer;
            text-transform: uppercase; letter-spacing: 0.5px; padding: 8px 12px; transition: color 0.3s;
        }
        .help-btn:hover { color: var(--primary-color); }

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
            position: absolute; top: 20px; right: 20px; left: auto; background: none; border: none;
            font-size: 1.5rem; color: #999; cursor: pointer; transition: color 0.3s;
            display: flex; align-items: center; justify-content: center; width: 32px; height: 32px;
            z-index: 10;
        }
        .help-modal-close:hover { color: #333; }
        .help-modal-title { text-align: center; font-size: 1.8rem; font-weight: 700; color: #111; margin-bottom: 25px; margin-top: 0; }
        .help-form { display: flex; flex-direction: column; gap: 20px; }
        .help-form-row { display: flex; gap: 20px; }
        .help-input-group { display: flex; flex-direction: column; gap: 8px; flex: 1; }
        .help-input-group.full-width { width: 100%; }
        .help-input-group label { font-size: 0.85rem; font-weight: 700; color: #444; text-transform: uppercase; letter-spacing: 0.5px; }
        .help-input-group input, .help-input-group textarea {
            padding: 14px 16px; border: 1px solid #ddd; border-radius: 8px;
            font-family: inherit; font-size: 1rem; transition: all 0.3s; background: #fafafa;
            width: 100%;
        }
        .help-input-group input:focus, .help-input-group textarea:focus {
            border-color: var(--primary-color); outline: none; background: #fff; box-shadow: 0 0 0 4px rgba(255, 122, 0, 0.1);
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
        .help-form-footer { display: flex; justify-content: center; margin-top: 5px; }
        .help-send-btn {
            background: var(--primary-color); color: white; border: none; padding: 16px;
            border-radius: 40px; font-size: 1.1rem; font-weight: 700; cursor: pointer;
            transition: all 0.3s; box-shadow: 0 4px 12px rgba(255, 122, 0, 0.2);
            width: 100%; text-align: center;
        }
        .help-send-btn:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 6px 15px rgba(255, 122, 0, 0.3); }
        
        @media (max-width: 600px) {
            .help-form-row { flex-direction: column; gap: 20px; }
            .help-modal-card { padding: 30px 20px; }
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
        <div class="header-right" style="display: flex; align-items: center; gap: 20px;">
            <button class="help-btn" onclick="openHelpModal()">Help</button>
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

            <!-- Room Grid -->
            <div class="rooms-grid">
                @foreach ($specialRooms as $room)
                @php $roomId = Str::slug($room['name']); @endphp
                <div class="card" data-name="{{ $room['name'] }}">
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
                        
                        <div class="price-highlight">
                            <span id="price-{{ $roomId }}">₹2000</span> <span style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">for </span><span id="time-text-{{ $roomId }}" style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">4 hours</span></div>
                        <p class="gst-text">+ 5% GST applicable</p>
                        
                        <!-- Room Features -->
                        @if($room['name'] === 'Suite Room')
                        <div class="luxury-features" style="margin: 1rem 0; padding: 0.8rem; background: #fff9e6; border-radius: 12px; border: 1px dashed #d4af37;">
                            <h3 style="font-size: 0.75rem; font-weight: 700; color: #555; margin-bottom: 0.6rem; text-transform: uppercase; letter-spacing: 0.8px;">Luxury Features</h3>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.75rem; color: #666;">
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-bed" style="color: #d4af37;"></i> King Size Bed</div>
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-television" style="color: #d4af37;"></i> Smart TV</div>
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-snowflake" style="color: #d4af37;"></i> Mini Fridge</div>
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-bottle" style="color: #d4af37;"></i> Premium Toiletries</div>
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-layout" style="color: #d4af37;"></i> Spacious Interior</div>
                            </div>
                            <p style="font-size: 0.7rem; color: #999; margin-top: 0.6rem; font-style: italic;">Luxury stay with maximum comfort</p>
                        </div>
                        @else
                        <div class="facility-features" style="margin: 1rem 0; padding: 0.8rem; background: #f0f4ff; border-radius: 12px; border: 1px dashed #4e73df;">
                            <h3 style="font-size: 0.75rem; font-weight: 700; color: #555; margin-bottom: 0.6rem; text-transform: uppercase; letter-spacing: 0.8px;">Facility Features</h3>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.75rem; color: #666;">
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-wifi-high" style="color: #4e73df;"></i> High-Speed WiFi</div>
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-monitor" style="color: #4e73df;"></i> Projector / Screen</div>
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-wind" style="color: #4e73df;"></i> AC Space</div>
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-users" style="color: #4e73df;"></i> {{ $room['capacity'] }} Members</div>
                                <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-chalkboard" style="color: #4e73df;"></i> Presentation Setup</div>
                            </div>
                            <p style="font-size: 0.7rem; color: #999; margin-top: 0.6rem; font-style: italic;">Perfect for meetings and collaboration</p>
                        </div>
                        @endif

                        <div class="card-actions">
                            <button type="button" class="btn btn-outline" 
                                onclick="window.showQuickRoomDetails(this)"
                                data-room="{{ $roomId }}" 
                                data-name="{{ $room['name'] }}" 
                                data-price="₹2000" 
                                data-time="for 4 hours"
                                 data-img="{{ $room['img'] }}"
                                 data-facilities="Projector:ph-monitor,PA System:ph-speaker-high,Whiteboard:ph-chalkboard,High Speed WiFi:ph-wifi-high,Drinking Water:ph-drop,AC:ph-wind"
                                 data-desc="Spacious and professionally designed environment suitable for meetings, collaboration, or luxury stay with privacy.">View Details</button>
                            <a href="{{ route('booking.form.full', ['room' => $roomId]) }}" class="btn">Book Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

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
                    <span style="font-size: 0.85rem; color: #999; font-weight: 500;">+ 5% GST</span>
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
    <div class="help-modal-overlay" id="helpModal">
        <div class="help-modal-card">
            <button class="help-modal-close" onclick="closeHelpModal()">
                <i class="ph ph-x"></i>
            </button>
            <div class="help-modal-content">
                <h2 class="help-modal-title">Contact Us</h2>
                <form class="help-form" onsubmit="event.preventDefault(); return false;">
                    <div class="help-form-row">
                        <div class="help-input-group">
                            <label>Name</label>
                            <input type="text" placeholder="Your name">
                        </div>
                        <div class="help-input-group">
                            <label>Email</label>
                            <input type="email" placeholder="Your email">
                        </div>
                    </div>
                    
                    <div class="help-input-group full-width">
                        <label>Subject</label>
                        <div class="custom-dropdown" id="helpSubjectDropdown">
                            <div class="dropdown-selected" onclick="toggleHelpDropdown(event)">
                                <span id="selectedSubject">Choose subject…</span>
                                <i class="ph ph-caret-down"></i>
                            </div>
                            <div class="dropdown-options" id="helpDropdownOptions">
                                <div class="dropdown-option" onclick="selectHelpOption('Are you a property owner who needs help?')">Are you a property owner who needs help?</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Change booking')">Change booking</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Cancel booking')">Cancel booking</div>
                                <div class="dropdown-option" onclick="selectHelpOption('I did not stay at the hotel')">I did not stay at the hotel</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Hotel info')">Hotel info</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Partnership')">Partnership</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Other')">Other</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Check prices and availability')">Check prices and availability</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Group booking (for business clients)')">Group booking (for business clients)</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Group booking (for travel agencies)')">Group booking (for travel agencies)</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Request my personal data')">Request my personal data</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Remove my personal data')">Remove my personal data</div>
                                <div class="dropdown-option" onclick="selectHelpOption('Legal and law-related matters')">Legal and law-related matters</div>
                            </div>
                        </div>
                    </div>

                    <div class="help-input-group full-width">
                        <label>Message</label>
                        <textarea placeholder="How can we help you?" rows="5"></textarea>
                    </div>

                    <div class="help-form-footer">
                        <button type="submit" class="help-send-btn">SEND</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            document.getElementById('modalBookNowBtn').href = "{{ route('booking.form.full') }}?room=" + data.room;
            
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

        function openHelpModal() {
            document.getElementById('helpModal').classList.add('active');
        }

        function closeHelpModal() {
            document.getElementById('helpModal').classList.remove('active');
            document.getElementById('helpDropdownOptions').classList.remove('active');
        }

        function toggleHelpDropdown(event) {
            event.stopPropagation();
            document.getElementById('helpDropdownOptions').classList.toggle('active');
        }

        function selectHelpOption(val) {
            document.getElementById('selectedSubject').innerText = val;
            document.getElementById('helpDropdownOptions').classList.remove('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const detailsModal = document.getElementById('detailsModal');
            const helpModal = document.getElementById('helpModal');

            window.onclick = function(event) {
                if (event.target == detailsModal) closeModal('detailsModal');
                if (event.target == helpModal) closeHelpModal();

                const dropdownOptions = document.getElementById('helpDropdownOptions');
                const dropdownSelected = document.querySelector('.dropdown-selected');
                if (dropdownOptions && dropdownSelected && !dropdownSelected.contains(event.target)) {
                    dropdownOptions.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>
