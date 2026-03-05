<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Booking Demo</title>
    <!-- Modern Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Phosphor Icons for Modern Aesthetics -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <h1>Space Booking Demo</h1>
    </header>

    <main>
        <!-- Booking Progress Indicator -->
        <div class="progress-container">
            <div class="step active">
                <div class="step-num">1</div> Select Space
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-num">2</div> Enter Details
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-num">3</div> Confirm Payment
            </div>
        </div>

        <div class="title-section">
            <h2>Available Spaces</h2>
            <p>Find and book the perfect room for your needs</p>
        </div>

        <!-- Filters Area -->
        <div class="filters">
            <div class="filter-group">
                <i class="ph ph-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Search spaces..." oninput="filterSpaces()">
            </div>
            <div class="filter-group">
                <i class="ph ph-users"></i>
                <select id="capacityFilter" onchange="filterSpaces()">
                    <option value="all">Any Capacity</option>
                    <option value="5">Up to 5 people</option>
                    <option value="10">Up to 10 people</option>
                    <option value="20">Up to 20 people</option>
                </select>
            </div>
            <div class="filter-group">
                <i class="ph ph-money"></i>
                <select id="priceFilter" onchange="filterSpaces()">
                    <option value="all">Any Price</option>
                    <option value="500">Under ₹800</option>
                    <option value="800">Under ₹1000</option>
                    <option value="1000">₹1000 & above</option>
                </select>
            </div>
        </div>

        <!-- Room Cards Container -->
        <div class="cards-container" id="spacesContainer">

            <!-- Room 1: Meeting Room -->
            <div class="card" data-name="Meeting Room" data-capacity="5" data-price="500">
                <div class="card-image-wrapper">
                    <img src="{{ asset('assets/meeting.png') }}" alt="Meeting Room">
                    <span class="badge status-available">Available</span>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h2>Meeting Room</h2>
                        <div class="rating"><i class="ph-fill ph-star"></i> 4.8 <span>(124)</span></div>
                    </div>
                    <p class="description">Ideal for small team discussions, 1-on-1s, and focused brainstorming
                        sessions.</p>

                    <div class="amenities">
                        <span title="WiFi"><i class="ph ph-wifi-high"></i> WiFi</span>
                        <span title="Air Conditioning"><i class="ph ph-wind"></i> AC</span>
                        <span title="Whiteboard"><i class="ph ph-presentation-chart"></i> Whiteboard</span>
                    </div>

                    <div class="card-meta">
                        <div class="meta-item"><i class="ph-fill ph-users"></i> 5 Seats</div>
                        <div class="meta-item slots-left"><i class="ph-fill ph-clock"></i> 4 Slots Left</div>
                    </div>

                    <div class="price-highlight">Starting from <span>₹500</span> / hour</div>

                    <div class="datetime-picker">
                        <div class="dt-input">
                            <label>Date</label>
                            <input type="date" class="card-date" required>
                        </div>
                        <div class="dt-input-group">
                            <div class="dt-input">
                                <label>Start</label>
                                <input type="time" class="card-start" required>
                            </div>
                            <div class="dt-input">
                                <label>End</label>
                                <input type="time" class="card-end" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-actions">
                        <button class="btn btn-outline" onclick="viewDetails('Meeting Room')">View Details</button>
                        <button class="btn" onclick="openBookingPopup(this)">Book Now</button>
                    </div>
                </div>
            </div>

            <!-- Room 2: Conference Hall -->
            <div class="card" data-name="Conference Hall" data-capacity="10" data-price="800">
                <div class="card-image-wrapper">
                    <img src="{{ asset('assets/conference.png') }}" alt="Conference Hall">
                    <span class="badge status-few">2 Slots Left</span>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h2>Conference Hall</h2>
                        <div class="rating"><i class="ph-fill ph-star"></i> 4.9 <span>(89)</span></div>
                    </div>
                    <p class="description">A premium extended hall with professional A/V equipment for corporate
                        meetings.</p>

                    <div class="amenities">
                        <span title="WiFi"><i class="ph ph-wifi-high"></i> WiFi</span>
                        <span title="Projector"><i class="ph ph-projector-screen"></i> Projector</span>
                        <span title="AC"><i class="ph ph-wind"></i> AC</span>
                    </div>

                    <div class="card-meta">
                        <div class="meta-item"><i class="ph-fill ph-users"></i> 10 Seats</div>
                        <div class="meta-item slots-left warning"><i class="ph-fill ph-clock-countdown"></i> Limited
                            slots</div>
                    </div>

                    <div class="price-highlight">Starting from <span>₹800</span> / hour</div>

                    <div class="datetime-picker">
                        <div class="dt-input">
                            <label>Date</label>
                            <input type="date" class="card-date" required>
                        </div>
                        <div class="dt-input-group">
                            <div class="dt-input">
                                <label>Start</label>
                                <input type="time" class="card-start" required>
                            </div>
                            <div class="dt-input">
                                <label>End</label>
                                <input type="time" class="card-end" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-actions">
                        <button class="btn btn-outline" onclick="viewDetails('Conference Hall')">View Details</button>
                        <button class="btn" onclick="openBookingPopup(this)">Book Now</button>
                    </div>
                </div>
            </div>

            <!-- Room 3: Training Room -->
            <div class="card" data-name="Training Room" data-capacity="20" data-price="1000">
                <div class="card-image-wrapper">
                    <img src="{{ asset('assets/training.png') }}" alt="Training Room">
                    <span class="badge status-booked">Fully Booked</span>
                </div>
                <div class="card-content">
                    <div class="card-header">
                        <h2>Training Room</h2>
                        <div class="rating"><i class="ph-fill ph-star"></i> 4.7 <span>(56)</span></div>
                    </div>
                    <p class="description">Spacious and well-lit workspace ideal for workshops, seminars, and group
                        training.</p>

                    <div class="amenities">
                        <span title="WiFi"><i class="ph ph-wifi-high"></i> WiFi</span>
                        <span title="Whiteboard"><i class="ph ph-presentation-chart"></i> Whiteboard</span>
                        <span title="Projector"><i class="ph ph-projector-screen"></i> Projector</span>
                        <span title="Mic"><i class="ph ph-microphone"></i> Audio</span>
                    </div>

                    <div class="card-meta">
                        <div class="meta-item"><i class="ph-fill ph-users"></i> 20 Seats</div>
                        <div class="meta-item slots-left danger"><i class="ph-fill ph-x-circle"></i> Not available today
                        </div>
                    </div>

                    <div class="price-highlight">Starting from <span>₹1000</span> / hour</div>

                    <div class="datetime-picker">
                        <div class="dt-input">
                            <label>Date</label>
                            <input type="date" class="card-date" required>
                        </div>
                        <div class="dt-input-group">
                            <div class="dt-input">
                                <label>Start</label>
                                <input type="time" class="card-start" required>
                            </div>
                            <div class="dt-input">
                                <label>End</label>
                                <input type="time" class="card-end" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-actions">
                        <button class="btn btn-outline" onclick="viewDetails('Training Room')">View Details</button>
                        <button class="btn" onclick="openBookingPopup(this)">Book Now</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal confirmation overlay -->
    <div class="modal-overlay" id="bookingModal">
        <div class="modal">
            <div class="modal-header">
                <h3>Confirm Space Booking</h3>
                <button class="close-btn" onclick="closeModal()"><i class="ph ph-x"></i></button>
            </div>
            <div class="modal-body">
                <div class="confirmation-details">
                    <p><strong>Space:</strong> <span id="modalRoomName"></span></p>
                    <p><strong>Date:</strong> <span id="modalDate"></span></p>
                    <p><strong>Time:</strong> <span id="modalTime"></span></p>
                    <p><strong>Rate:</strong> ₹<span id="modalPrice"></span> / hr</p>
                </div>
                <div class="modal-warning" id="modalWarning" style="display:none;"></div>
                <p>Are you sure you want to proceed to the details page with this schedule?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="closeModal()">Cancel</button>
                <button class="btn" id="confirmProceedBtn" onclick="confirmProceed()">Confirm & Proceed</button>
            </div>
        </div>
    </div>

    <!-- Success Modal popup overlay after coming back from payment -->
    <div class="modal-overlay" id="successModal">
        <div class="modal">
            <div class="modal-body success-modal">
                <div class="status-icon"><i class="ph-fill ph-check-circle"></i></div>
                <h3 style="margin-bottom: 0.5rem; font-size:1.5rem;">Booking Confirmed!</h3>
                <p style="color: var(--text-light); margin-bottom: 1.5rem;">Your space has been successfully booked.
                    We've sent the details to your email.</p>
                <button class="btn" onclick="closeModal()">Awesome, thanks!</button>
            </div>
        </div>
    </div>

    <!-- Alert Toast (View Details dummy action) -->
    <div class="toast" id="toast"></div>

    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', initIndexPage);
    </script>
</body>

</html>