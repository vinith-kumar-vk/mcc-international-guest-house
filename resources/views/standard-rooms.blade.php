<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standard Rooms - GH Booking System</title>
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
        .modal-work-desk-badge {
            position: absolute; top: 12px; left: 12px;
            background: #ffffff; color: var(--primary-color);
            padding: 5px 12px; border-radius: 20px;
            font-size: 0.7rem; font-weight: 700;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-transform: uppercase; letter-spacing: 0.5px;
            z-index: 10; display: flex; align-items: center; gap: 5px;
        }
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
        /* Removes default browser icon to allow our custom one to shine */
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
                <span style="color: var(--text-color); font-weight: 500;">Standard Rooms</span>
            </div>

            <div class="title-section" style="margin: 0rem 0 3.5rem 0; text-align: left;">
                <h1 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.6rem; color: #222; letter-spacing: -1px;">Standard Rooms</h1>
                <p style="color: #666; font-size: 1rem; font-weight: 400; line-height: 1.5; max-width: 600px;">Comfortable stays equipped with all essential amenities for your visit.</p>
            </div>

            <!-- Room Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
                @for ($i = 1; $i <= 8; $i++)
                <div class="card" data-name="Standard Room {{ $i }}" style="background: white; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 4px 15px rgba(0,0,0,0.04); transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.04)';">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Standard Room {{ $i }}">
                        <span class="badge status-available">Available</span>
                        <span class="badge" style="top: 1rem; left: auto; right: 1rem; background: #e0e0e0; color: #555;">Standard</span>
                    </div>
                    <div class="card-content">
                        <div class="card-header">
                            <h2>Room {{ $i }}</h2>
                            <div class="rating"><i class="ph-fill ph-star"></i> 4.5</div>
                        </div>
                        <p class="description">Comfortable stay with AC, WiFi, and dedicated workspace.</p>
                        
                        <div class="price-highlight" style="font-size: 1.2rem; color: var(--primary-color); font-weight: 700; margin-top: 1rem;">₹1400 <span style="font-size: 0.85rem; font-weight: 500; color: var(--text-light);">/ 12 hours</span></div>
                        <p class="gst-text">+ 5% GST applicable</p>
                        
                        <!-- Quick Schedule -->
                        <div class="datetime-row" style="margin-top: 1.5rem; background: #fbfbfb; padding: 1.15rem; border-radius: 10px; border: 1px solid #eeeeee;">
                            <div class="datetime-col">
                                <label>Clock In</label>
                                <input type="datetime-local">
                            </div>
                            <div class="datetime-col">
                                <label>Clock Out</label>
                                <input type="datetime-local">
                            </div>
                        </div>

                        <div class="card-actions" style="margin-top: 1.5rem; display:flex; gap: 0.8rem;">
                            <button class="btn btn-outline view-details-btn" style="flex: 1; padding: 0.7rem;" data-room="{{ $i }}" onclick="openDetailsModal({{ $i }})">View Details</button>
                            <a href="{{ route('booking.form.full', ['room' => $i]) }}" class="btn" style="flex: 1; padding: 0.7rem;">Book Now</a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </main>

    <!-- Details Modal -->
    <div class="modal-overlay" id="detailsModal">
        <div class="hotel-modal">
            <button class="hotel-modal-close" onclick="closeModal('detailsModal')"><i class="ph-bold ph-x"></i></button>
            <div class="hotel-modal-image-wrapper">
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Room">
            </div>
            
            <div class="hotel-modal-body">
                <div class="hotel-modal-header">
                    <h2 class="hotel-modal-title">Standard Room <span id="detailsRoomNo"></span></h2>
                    <div class="hotel-modal-price">
                        <span>₹1400</span> 
                        <span style="font-size:0.85rem; color: var(--text-light); font-weight: 500;">/ 12 hrs</span>
                    </div>
                    <p class="gst-text">+ 5% GST applicable</p>
                </div>
                
                <div class="hotel-modal-feature-grid">
                    <span class="feature-chip"><i class="ph-fill ph-bed"></i> Bed</span>
                    <span class="feature-chip"><i class="ph-fill ph-wind"></i> AC</span>
                    <span class="feature-chip"><i class="ph-fill ph-wifi-high"></i> WiFi</span>
                    <span class="feature-chip"><i class="ph-fill ph-desktop"></i> Work Desk</span>
                </div>

                <div class="hotel-modal-why">
                    <h4>Why choose this room?</h4>
                    <ul>
                        <li>Budget friendly</li>
                        <li>Short stay</li>
                        <li>Basic amenities</li>
                    </ul>
                </div>

                <p style="color:var(--text-light); margin-bottom:0; line-height:1.5; font-size: 0.95rem;">A clean, spacious room tailored for short to mid-length stays with fresh bedding and essential conveniences.</p>
            </div>
            
            <div class="hotel-modal-footer">
                <a id="modalBookNowBtn" href="#" class="btn" style="width:100%;">Proceed to Booking</a>
            </div>
        </div>
    </div>

    <script>
        function openDetailsModal(roomId) {
            document.getElementById('detailsRoomNo').innerText = roomId;
            // Link directly to full page booking form
            document.getElementById('modalBookNowBtn').href = "{{ route('booking.form.full') }}?room=" + roomId;
            document.getElementById('detailsModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        window.onclick = function(event) {
            const detailsModal = document.getElementById('detailsModal');
            if (event.target == detailsModal) detailsModal.classList.remove('active');
        }
    </script>
</body>
</html>
