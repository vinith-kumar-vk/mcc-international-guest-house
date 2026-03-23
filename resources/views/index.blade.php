<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMIP Room Booking</title>
    <!-- Modern Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Phosphor Icons for Modern Aesthetics -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="header-logo">
        </div>
        <div class="header-center">
            <h1>MMIP Room Booking</h1>
        </div>
        <div class="header-right">
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleDropdown(event)">
                    <i class="ph-fill ph-user-circle"></i>
                </button>
                <div class="dropdown-menu" id="profileMenu">
                    @auth
                        <a href="#" class="dropdown-item logout">Logout</a>
                    @else
                        <a href="#" class="dropdown-item">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- SLIDER SECTION (Room Carousel) -->
        <div class="slider-section">
            <div class="title-section">
                <h2 style="font-size: 1.8rem; margin-bottom: 0.5rem;">Explore More Spaces</h2>
                <p>Browse through our collection of premium rooms</p>
            </div>
            <div class="slider-wrapper">
                <button class="slider-btn prev-btn" onclick="slideLeft()"><i class="ph-bold ph-caret-left"></i></button>
                <div class="slider-container" id="roomSlider">
                    <!-- Room 1 -->
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
                            <p class="description">Ideal for small team discussions and focused brainstorming sessions.</p>
                            <div class="amenities">
                                <span title="WiFi"><i class="ph ph-wifi-high"></i> WiFi</span>
                                <span title="Air Conditioning"><i class="ph ph-wind"></i> AC</span>
                            </div>
                            <div class="card-meta">
                                <div class="meta-item"><i class="ph-fill ph-users"></i> 5 Seats</div>
                            </div>
                            <div class="price-highlight">Starting from <span>₹500</span> / hour</div>
                            <div class="card-actions" style="margin-top: 1rem;">
                                <button class="btn btn-outline" style="width: 100%;" onclick="viewDetails('Meeting Room')">View Details</button>
                            </div>
                        </div>
                    </div>
                    <!-- Room 2 -->
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
                            <p class="description">A premium extended hall with professional A/V equipment.</p>
                            <div class="amenities">
                                <span title="WiFi"><i class="ph ph-wifi-high"></i> WiFi</span>
                                <span title="Projector"><i class="ph ph-projector-screen"></i> Projector</span>
                            </div>
                            <div class="card-meta">
                                <div class="meta-item"><i class="ph-fill ph-users"></i> 10 Seats</div>
                            </div>
                            <div class="price-highlight">Starting from <span>₹800</span> / hour</div>
                            <div class="card-actions" style="margin-top: 1rem;">
                                <button class="btn btn-outline" style="width: 100%;" onclick="viewDetails('Conference Hall')">View Details</button>
                            </div>
                        </div>
                    </div>
                    <!-- Room 3 -->
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
                            <p class="description">Spacious and well-lit workspace ideal for group training.</p>
                            <div class="amenities">
                                <span title="WiFi"><i class="ph ph-wifi-high"></i> WiFi</span>
                                <span title="Whiteboard"><i class="ph ph-presentation-chart"></i> Whiteboard</span>
                            </div>
                            <div class="card-meta">
                                <div class="meta-item"><i class="ph-fill ph-users"></i> 20 Seats</div>
                            </div>
                            <div class="price-highlight">Starting from <span>₹1000</span> / hour</div>
                            <div class="card-actions" style="margin-top: 1rem;">
                                <button class="btn btn-outline" style="width: 100%;" onclick="viewDetails('Training Room')">View Details</button>
                            </div>
                        </div>
                    </div>
                    <!-- Room 4 -->
                    <div class="card" data-name="Executive Suite" data-capacity="8" data-price="1200">
                        <div class="card-image-wrapper">
                            <img src="{{ asset('assets/meeting.png') }}" alt="Executive Suite">
                            <span class="badge status-available">Available</span>
                        </div>
                        <div class="card-content">
                            <div class="card-header">
                                <h2>Executive Suite</h2>
                                <div class="rating"><i class="ph-fill ph-star"></i> 5.0 <span>(32)</span></div>
                            </div>
                            <p class="description">Luxury suite designed for high-profile executive meetings.</p>
                            <div class="amenities">
                                <span title="WiFi"><i class="ph ph-wifi-high"></i> WiFi</span>
                                <span title="Refreshments"><i class="ph ph-coffee"></i> Coffee</span>
                            </div>
                            <div class="card-meta">
                                <div class="meta-item"><i class="ph-fill ph-users"></i> 8 Seats</div>
                            </div>
                            <div class="price-highlight">Starting from <span>₹1200</span> / hour</div>
                            <div class="card-actions" style="margin-top: 1rem;">
                                <button class="btn btn-outline" style="width: 100%;" onclick="viewDetails('Executive Suite')">View Details</button>
                            </div>
                        </div>
                    </div>
                    <!-- Room 5 -->
                    <div class="card" data-name="Innovation Lab" data-capacity="15" data-price="900">
                        <div class="card-image-wrapper">
                            <img src="{{ asset('assets/training.png') }}" alt="Innovation Lab">
                            <span class="badge status-available">Available</span>
                        </div>
                        <div class="card-content">
                            <div class="card-header">
                                <h2>Innovation Lab</h2>
                                <div class="rating"><i class="ph-fill ph-star"></i> 4.6 <span>(41)</span></div>
                            </div>
                            <p class="description">Creative environment equipped with modern tools for ideation.</p>
                            <div class="amenities">
                                <span title="WiFi"><i class="ph ph-wifi-high"></i> WiFi</span>
                                <span title="Smart Board"><i class="ph ph-presentation-chart"></i> Smart Board</span>
                            </div>
                            <div class="card-meta">
                                <div class="meta-item"><i class="ph-fill ph-users"></i> 15 Seats</div>
                            </div>
                            <div class="price-highlight">Starting from <span>₹900</span> / hour</div>
                            <div class="card-actions" style="margin-top: 1rem;">
                                <button class="btn btn-outline" style="width: 100%;" onclick="viewDetails('Innovation Lab')">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="slider-btn next-btn" onclick="slideRight()"><i class="ph-bold ph-caret-right"></i></button>
            </div>
        </div>

        <!-- GUEST HOUSE DESCRIPTION SECTION -->
        <div class="description-section">
            <h2>About Our Guest House Booking</h2>
            <div class="desc-content">
                <p>Enjoy comfortable stays tailored perfectly to meet the demands of modern professionals. Our guest house comes equipped with all premium amenities aimed at making your experience relaxing and highly productive.</p>
                <p>We believe in an easy booking process that respects your time. In just a few quick clicks, you can browse, confirm, and secure an accommodation that best matches your professional requirements.</p>
                <p>Furthermore, our environment is ideal for meetings, training sessions, and visitors. With modern setups and top-notch facilities, your team interactions and corporate visits will flow seamlessly.</p>
            </div>
        </div>

    </main>

    <!-- FOOTER SECTION -->
    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#"><i class="ph-bold ph-caret-right" style="font-size: 0.8rem;"></i> Home</a></li>
                    <li><a href="#"><i class="ph-bold ph-caret-right" style="font-size: 0.8rem;"></i> Spaces</a></li>
                    <li><a href="#"><i class="ph-bold ph-caret-right" style="font-size: 0.8rem;"></i> Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Contact Info</h4>
                <ul>
                    <li><i class="ph-fill ph-envelope-simple"></i> contact@mmip.example.com</li>
                    <li><i class="ph-fill ph-phone"></i> +91 98765 43210</li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Address</h4>
                <p><i class="ph-fill ph-map-pin" style="margin-top: 0.3rem;"></i> <span>123 Innovation Drive,<br>Tech Park Sector,<br>Chennai 600001</span></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Design and Developed by MCC-MRF Innovation Park</p>
        </div>
    </footer>

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

        function slideLeft() {
            const slider = document.getElementById('roomSlider');
            if (slider) {
                const card = slider.querySelector('.card');
                if (card) {
                    const cardWidth = card.offsetWidth + 32; // Includes 2rem (32px) gap
                    slider.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                }
            }
        }

        function slideRight() {
            const slider = document.getElementById('roomSlider');
            if (slider) {
                const card = slider.querySelector('.card');
                if (card) {
                    const cardWidth = card.offsetWidth + 32;
                    slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                }
            }
        }
    </script>
</body>

</html>