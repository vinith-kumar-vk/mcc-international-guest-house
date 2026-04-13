<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance Rooms - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        /* Compact Card Fixes */
        .card { height: auto !important; min-height: 0 !important; }
        .card-content { padding: 1.25rem !important; gap: 0.25rem !important; }
        .card-content h2 { min-height: 0 !important; margin-bottom: 0.25rem !important; line-height: 1.2 !important; }
        .card-content .description { min-height: 0 !important; margin-bottom: 0.5rem !important; }
        .price-highlight { margin-bottom: 0 !important; }
        .gst-text { margin-bottom: 0.5rem !important; }
        .facility-features, .luxury-features { margin: 0.5rem 0 !important; padding: 0.75rem !important; }
        .next-available { margin-top: 0.5rem !important; padding: 0.5rem !important; }
        .card-actions { margin-top: 0.75rem !important; }

        /* Visibility Improvements */
        .card h2 { color: #0f172a !important; font-weight: 800 !important; }
        .card .description { color: #334155 !important; font-weight: 500 !important; }
        .card .gst-text { color: #64748b !important; font-weight: 600 !important; }
        .btn-outline { border-width: 2px !important; font-weight: 700 !important; }

        /* Room grid base is in responsive.css, but we keep our specific gap/margin */

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7) !important;
            backdrop-filter: blur(6px) !important;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 5000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 15px;
        }

        .modal-overlay.active {
            display: flex !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .modal-card {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
            animation: modalPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin: auto;
            line-height: 1.3;
            max-height: 95vh;
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(30px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            color: #333;
            transition: all 0.3s;
            z-index: 100;
        }

        .modal-close:hover {
            color: white;
            transform: rotate(90deg);
        }

        .modal-img-container {
            position: relative;
            width: 100%;
            height: 150px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .room-img-modal {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-body {
            padding: 1rem 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            overflow: hidden;
        }

        .modal-title {
            font-size: 1.4rem;
            color: #111;
            margin: 0;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .modal-price-line {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .modal-divider {
            height: 1px;
            background: #eee;
            margin: 0.2rem 0;
            width: 100%;
        }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
            margin-top: 2px;
        }

        .facility-item {
            background: #f8f9fa;
            color: #444;
            padding: 6px 4px;
            border-radius: 6px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 4px;
            border: 1px solid #eee;
            font-weight: 500;
            text-align: center;
            justify-content: center;
            flex-direction: column;
        }

        .facility-item i {
            font-size: 0.9rem;
            color: var(--primary-color);
        }

        /* Help Modal Styles */


        .help-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 6000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .help-modal-overlay.active {
            display: flex;
            opacity: 1;
            visibility: visible;
        }

        .help-modal-card {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            position: relative;
            padding: 40px;
            animation: modalSlideUp 0.4s ease;
            margin: 20px;
        }

        @keyframes modalSlideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .help-modal-close {
            position: absolute !important;
            top: 20px !important;
            right: 20px !important;
            left: auto !important;
            background: none !important;
            border: none !important;
            box-shadow: none !important;
            font-size: 1.5rem !important;
            color: #999 !important;
            cursor: pointer;
            transition: color 0.3s;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 32px !important;
            height: 32px !important;
            padding: 0 !important;
            z-index: 10;
        }

        .help-modal-close:hover {
            color: #333 !important;
            background: none !important;
            box-shadow: none !important;
            transform: none !important;
        }

        .help-modal-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: #111;
            margin-bottom: 25px;
            margin-top: 0;
        }

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

        .custom-dropdown {
            position: relative;
            width: 100%;
        }

        .dropdown-selected {
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            background: #fafafa;
            transition: 0.3s;
        }

        .dropdown-selected:hover {
            border-color: #bbb;
        }

        .dropdown-selected span {
            color: #333;
            font-weight: 500;
        }

        .dropdown-selected i {
            color: #999;
            font-size: 1.2rem;
        }

        .dropdown-options {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            z-index: 10;
            max-height: 250px;
            overflow-y: auto;
            display: none;
        }

        .dropdown-options.active {
            display: block;
        }

        .dropdown-option {
            padding: 12px 16px;
            font-size: 0.95rem;
            color: #444;
            cursor: pointer;
            transition: background 0.2s;
            border-bottom: 1px solid #f5f5f5;
        }

        .dropdown-option:last-child {
            border-bottom: none;
        }

        .dropdown-option:hover {
            background: #fff8f3;
            color: var(--primary-color);
        }

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
            text-align: center !important;
            display: block !important;
            transform: none !important;
            box-shadow: 0 4px 14px rgba(var(--primary-rgb, 255, 122, 0), 0.35) !important;
            transition: background 0.2s ease, box-shadow 0.2s ease !important;
        }

        .help-send-btn:hover {
            filter: brightness(90%) !important;
            box-shadow: 0 4px 18px rgba(var(--primary-rgb, 255, 122, 0), 0.45) !important;
            transform: none !important;
        }

        .help-send-btn:focus,
        .help-send-btn:active {
            background: var(--primary-color) !important;
            transform: none !important;
            box-shadow: 0 4px 14px rgba(var(--primary-rgb, 255, 122, 0), 0.35) !important;
        }

        .help-modal-card button:active {
            transform: none !important;
            scale: 1 !important;
        }


        /* View Details button hover/active fix */
        .card-actions .btn-outline:hover,
        .card-actions .btn-outline:active {
            background: var(--primary-color) !important;
            color: #fff !important;
            border-color: var(--primary-color) !important;
        }

        /* Header Centering */
        .header-container {
            position: relative;
        }

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
    @include('partials.header', ['headerBackBtn' => ['url' => route('home'), 'label' => 'Dashboard'], 'showHelpBtn' => true])

    <main>
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <!-- Breadcrumbs -->
            <div class="breadcrumb" style="font-size: 1rem; margin-bottom: 1.5rem;">
                <a href="{{ route('home') }}"
                    style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Dashboard</a>
                <span style="color: #333; margin: 0 8px;">></span>
                <span style="color: var(--text-color); font-weight: 500;">Advance Rooms</span>
            </div>

            <div class="title-section" style="margin: 0rem 0 3.5rem 0; text-align: left;">
                <h1
                    style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.6rem; color: #222; letter-spacing: -1px;">
                    Advance Rooms</h1>
                <p style="color: #666; font-size: 1rem; font-weight: 400; line-height: 1.5; max-width: 600px;">Experience elevated hospitality in our Advance Rooms, specifically curated for guests seeking enhanced privacy and premium comfort during longer stays.</p>
            </div>

            @php
                $advanceRooms = [
                    ['no' => 101, 'type' => 'College Guest Room'],
                    ['no' => 102, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                    ['no' => 103, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                    ['no' => 104, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                    ['no' => 201, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                    ['no' => 203, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                    ['no' => 204, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                    ['no' => 205, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                    ['no' => 206, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                    ['no' => 207, 'type' => 'Premium Guest Room with Upgraded Interiors'],
                ];
            @endphp

            <!-- Room Grid -->
            <div class="rooms-grid">
                @foreach ($advanceRooms as $room)
                    <div class="card" data-name="{{ $room['type'] }} {{ $room['no'] }}">
                        <div class="card-image-wrapper">
                            <img src="{{ asset('assets/room1.JPG') }}"
                                alt="{{ $room['type'] }}">
                            @if(isset($bookedRooms[$room['type'] . ' ' . $room['no']]) || isset($bookedRooms[$room['no']]))
                                <span class="badge" style="background:#dc3545; color: white;">Booked</span>
                            @else
                                <span class="badge status-available">Available</span>
                            @endif
                            <span class="badge"
                                style="top: 1rem; left: auto; right: 1rem; background: var(--primary-color); color: white;">Premium</span>
                        </div>
                        <div class="card-content">
                            <div class="card-header">
                                <h2>Room {{ $room['no'] }}</h2>
                                <div class="rating"><i class="ph-fill ph-star"></i> 4.8</div>
                            </div>
                            <p class="description">{{ $room['type'] }}</p>

                            <div class="price-highlight"><span>₹2500</span> / day</div>
                            <p class="gst-text">+ {{ $gstRate }}% GST applicable</p>

                            <!-- Premium Features -->
                            <div class="room-highlights"
                                style="margin: 1rem 0; padding: 0.8rem; background: #fff8f3; border-radius: 12px; border: 1px dashed var(--primary-color);">
                                <h3
                                    style="font-size: 0.75rem; font-weight: 700; color: #555; margin-bottom: 0.6rem; text-transform: uppercase; letter-spacing: 0.8px;">
                                    Premium Features</h3>
                                <div
                                    style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.75rem; color: #666;">
                                    <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-wifi-high"
                                            style="color: var(--primary-color);"></i> WiFi</div>
                                    <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-wind"
                                            style="color: var(--primary-color);"></i> AC</div>
                                    <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-television"
                                            style="color: var(--primary-color);"></i> Smart TV</div>
                                    <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-snowflake"
                                            style="color: var(--primary-color);"></i> Mini Fridge</div>
                                    <div style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-bed"
                                            style="color: var(--primary-color);"></i> Premium Bedding</div>
                                </div>
                                <p style="font-size: 0.7rem; color: #999; margin-top: 0.6rem; font-style: italic;">Ideal for
                                    comfortable and extended stays</p>
                            </div>

                            @php 
                                $bookedInfo = $bookedRooms[$room['type'] . ' ' . $room['no']] ?? $bookedRooms[$room['no']] ?? null;
                            @endphp
                            @if($bookedInfo)
                                <div class="next-available" style="margin-top: 0.5rem; padding: 0.6rem; background: #fff1f2; border-radius: 10px; border: 1px solid #fee2e2; text-align: center;">
                                    <p style="font-size: 0.75rem; font-weight: 700; color: #991b1b; margin: 0;">
                                        <i class="ph-bold ph-clock-countdown"></i> Next Available:<br>
                                        {{ date('d M, Y', strtotime($bookedInfo['date'])) }} at {{ date('h:i A', strtotime($bookedInfo['time'])) }}
                                    </p>
                                </div>
                            @endif

                            <div class="card-actions" style="margin-top: 1rem;">
                                <a href="{{ route('room.details', ['id' => 'advance-room-' . $room['no']]) }}" class="btn btn-outline" style="flex: 1;">View Details</a>
                                @if($bookedInfo)
                                    <a href="javascript:void(0)" class="btn"
                                        style="background: #9ca3af; border-color: #9ca3af; cursor: not-allowed; opacity: 0.5; pointer-events: none;">Booked</a>
                                @else
                                    <a href="{{ route('booking.form.full', ['room' => $room['no']]) }}" class="btn">Book Now</a>
                                @endif
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

                <h3
                    style="font-size: 1rem; font-weight: 800; color: #111; margin: 0.25rem 0 0.5rem 0; display: flex; align-items: center; gap: 6px;">
                    Room Facilities
                </h3>
                <div class="facility-grid" id="modalFacilitiesContainer">
                    <!-- Dynamic Facilities -->
                </div>
            </div>

            <div class="modal-footer"
                style="padding: 1rem 1.25rem; background: #fff; border-top: 1px solid #eee; flex-shrink: 0;">
                <a id="modalBookNowBtn" href="#" class="btn"
                    style="width:100%; text-align: center; border-radius: 10px; font-weight: 700; font-size: 1rem; background: var(--primary-color); color: white; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; padding: 0.75rem;">
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
                        <select class="form-input" style="background: #fafafa !important;">
                            <option value="" disabled selected>Choose subject…</option>
                            <option>Are you a property owner who needs help?</option>
                            <option>Change booking</option>
                            <option>Cancel booking</option>
                            <option>I did not stay at the hotel</option>
                            <option>Hotel info</option>
                            <option>Partnership</option>
                            <option>Other</option>
                            <option>Check prices and availability</option>
                            <option>Group booking (for business clients)</option>
                            <option>Group booking (for travel agencies)</option>
                            <option>Request my personal data</option>
                            <option>Remove my personal data</option>
                            <option>Legal and law-related matters</option>
                        </select>
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
        window.showQuickRoomDetails = function (btn) {
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

        function openHelpModal() {
            document.getElementById('helpModal').classList.add('active');
        }

        function closeHelpModal() {
            document.getElementById('helpModal').classList.remove('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const detailsModal = document.getElementById('detailsModal');
            const helpModal = document.getElementById('helpModal');

            window.onclick = function (event) {
                if (event.target == detailsModal) closeModal('detailsModal');
                if (event.target == helpModal) closeHelpModal();
            }
        });
    </script>
</body>

</html>