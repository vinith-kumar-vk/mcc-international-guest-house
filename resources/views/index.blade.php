<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC IGH</title>
    <!-- Modern Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Phosphor Icons for Modern Aesthetics -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
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
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleDropdown(event)">
                    <i class="ph-fill ph-user-circle"></i>
                </button>
                <div class="dropdown-menu" id="profileMenu">
                    @auth
                        <a href="#" class="dropdown-item logout">Logout</a>
                    @else
                        <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- HERO SECTION -->
        <section class="hero-section" style="text-align: center; padding: 2.5rem 1rem; background: var(--bg-color); margin-bottom: 1.5rem;">
            <h1 class="welcome-animate" style="font-size: 3rem; font-weight: 800; color: var(--text-color); margin-bottom: 1rem; letter-spacing: -1.5px; position: relative; display: inline-block;">Welcome to MCC IGH
                <span style="position: absolute; width: 35%; height: 5px; bottom: -8px; left: 32.5%; background-color: var(--primary-color); border-radius: 4px;"></span>
            </h1>
            <p class="welcome-animate" style="font-size: 1.15rem; font-weight: 500; color: var(--text-light); max-width: 650px; margin: 1.5rem auto 0; line-height: 1.6; animation-delay: 0.15s;">Book comfortable guest house rooms effortlessly and manage your professional stay with ease.</p>
        </section>

        <!-- EXPLORE OUR ROOMS AUTO-SLIDER -->
        <section class="explore-rooms-slider-section" style="max-width: 1250px; margin: 0 auto 3.5rem auto; padding: 0 1rem; position: relative;">
            <div class="title-section" style="text-align: center; margin-bottom: 2.5rem;">
                <h2 style="font-size: 2.2rem; font-weight: 700; color: var(--text-color);">Explore Our Rooms</h2>
            </div>

            <!-- Arrows -->
            <button id="sliderPrevBtn" class="btn btn-outline" style="position: absolute; left: 0px; top: 60%; transform: translateY(-50%); z-index: 10; width: 45px; height: 45px; border-radius: 50%; padding: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.1); background: white;"><i class="ph-bold ph-caret-left" style="font-size: 1.5rem;"></i></button>
            <button id="sliderNextBtn" class="btn btn-outline" style="position: absolute; right: 0px; top: 60%; transform: translateY(-50%); z-index: 10; width: 45px; height: 45px; border-radius: 50%; padding: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.1); background: white;"><i class="ph-bold ph-caret-right" style="font-size: 1.5rem;"></i></button>

            <!-- Container -->
            <div id="sliderViewport" style="overflow: hidden; width: calc(100% - 70px); margin: 0 auto; padding: 2rem 0;">
                <div id="sliderTrack" style="display: flex; gap: 2.5rem; transition: transform 0.4s ease-out; width: max-content;">
                    <!-- Card 1 -->
                    <div class="card premium-card" style="width: 320px; flex-shrink: 0;">
                        <div class="card-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Standard Rooms" style="height: 220px; object-fit: cover;">
                        </div>
                        <div class="card-content">
                            <h2>Standard Rooms</h2>
                            <p class="description">Comfortable accommodations designed for short and efficient stays.</p>
                            <a href="{{ route('standard.rooms') }}" class="btn btn-outline" style="width: 100%; text-align: center; display: inline-block; text-decoration: none;">Explore Standard</a>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="card premium-card" style="width: 320px; flex-shrink: 0;">
                        <div class="card-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Advance Rooms" style="height: 220px; object-fit: cover;">
                        </div>
                        <div class="card-content">
                            <h2>Advance Rooms</h2>
                            <p class="description">Premium guest rooms tailored for extended comfort and specific reservations.</p>
                            <a href="{{ route('advance.rooms') }}" class="btn btn-outline" style="width: 100%; text-align: center; display: inline-block; text-decoration: none;">Explore Advance</a>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="card premium-card" style="width: 320px; flex-shrink: 0;">
                        <div class="card-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Conference Hall" style="height: 220px; object-fit: cover;">
                        </div>
                        <div class="card-content">
                            <h2>Conference Hall</h2>
                            <p class="description">Dedicated interactive halls for large meetings and corporate events.</p>
                            <a href="{{ route('conference.rooms') }}" class="btn btn-outline" style="width: 100%; text-align: center; display: inline-block; text-decoration: none;">Explore Halls</a>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="card premium-card" style="width: 320px; flex-shrink: 0;">
                        <div class="card-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Glass Room" style="height: 220px; object-fit: cover;">
                        </div>
                        <div class="card-content">
                            <h2>Glass Room</h2>
                            <p class="description">Premium transparent facility for collaborative interactive sessions.</p>
                            <a href="{{ route('conference.rooms') }}" class="btn btn-outline" style="width: 100%; text-align: center; display: inline-block; text-decoration: none;">Explore Halls</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const track = document.getElementById('sliderTrack');
                    const cards = Array.from(track.children);
                    
                    // Clone cards to create infinite scroll illusion
                    cards.forEach(card => {
                        let clone = card.cloneNode(true);
                        track.appendChild(clone);
                    });
                    
                    let position = 0;
                    let animationFrameId;
                    let speed = 0.4; // Exceedingly smooth, much slower scroll speed (linear velocity)
                    let isHovered = false;
                    
                    function animate() {
                        if (!isHovered) {
                            position -= speed;
                            // Reset position when halfway through duplicated track
                            if (Math.abs(position) >= track.scrollWidth / 2) {
                                position = 0;
                            }
                            track.style.transform = `translateX(${position}px)`;
                        }
                        animationFrameId = requestAnimationFrame(animate);
                    }
                    
                    // Start animation
                    animationFrameId = requestAnimationFrame(animate);
                    
                    // Stop on hover
                    const viewport = document.getElementById('sliderViewport');
                    viewport.addEventListener('mouseenter', () => isHovered = true);
                    viewport.addEventListener('mouseleave', () => isHovered = false);
                    
                    // Manual controls
                    document.getElementById('sliderPrevBtn').addEventListener('click', () => {
                        position += 320 + 32; // card width + gap
                        if (position > 0) position = -(track.scrollWidth / 2) + Math.abs(position);
                        track.style.transform = `translateX(${position}px)`;
                    });
                    
                    document.getElementById('sliderNextBtn').addEventListener('click', () => {
                        position -= 320 + 32;
                        if (Math.abs(position) >= track.scrollWidth / 2) position = 0;
                        track.style.transform = `translateX(${position}px)`;
                    });
                });
            </script>
        </section>

        <!-- CATEGORY SELECTION -->
        <section style="max-width: 1250px; margin: 0 auto; padding: 0 1rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem;">
                <!-- Standard Rooms -->
                <div class="card premium-card">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Standard Rooms" style="height: 220px; object-fit: cover;">
                    </div>
                    <div class="card-content">
                        <h2>Standard Rooms</h2>
                        <p class="description" style="margin-top: 0.5rem; margin-bottom: 1.5rem;">Comfortable accommodations designed for short and efficient stays with essential amenities.</p>
                        <a href="{{ route('standard.rooms') }}" class="btn btn-outline" style="width: 100%; text-align: center; display: inline-block; text-decoration: none;">Explore Standard</a>
                    </div>
                </div>

                <!-- Advance Rooms -->
                <div class="card premium-card">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Advance Rooms" style="height: 220px; object-fit: cover;">
                    </div>
                    <div class="card-content">
                        <h2>Advance Rooms</h2>
                        <p class="description" style="margin-top: 0.5rem; margin-bottom: 1.5rem;">Premium guest rooms tailored for extended comfort, delegates, and specific reservations.</p>
                        <a href="{{ route('advance.rooms') }}" class="btn btn-outline" style="width: 100%; text-align: center; display: inline-block; text-decoration: none;">Explore Advance</a>
                    </div>
                </div>

                <!-- Conference / Glass Rooms -->
                <div class="card premium-card">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Conference Rooms" style="height: 220px; object-fit: cover;">
                    </div>
                    <div class="card-content">
                        <h2>Conference / Glass Rooms</h2>
                        <p class="description" style="margin-top: 0.5rem; margin-bottom: 1.5rem;">Dedicated interactive halls for large meetings, corporate events, and collaborative sessions.</p>
                        <a href="{{ route('conference.rooms') }}" class="btn btn-outline" style="width: 100%; text-align: center; display: inline-block; text-decoration: none;">Explore Halls</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- GUEST HOUSE DESCRIPTION -->
        <section class="description-section" style="margin-top: 4rem; max-width: 800px; margin-left: auto; margin-right: auto; text-align: center;">
            <h2 style="font-size: 1.8rem; margin-bottom: 1rem;">About Our Facilities</h2>
            <div class="desc-content">
                <p>Enjoy comfortable stays tailored perfectly to meet the demands of modern professionals. Our guest house comes equipped with all premium amenities aimed at making your experience relaxing and highly productive.</p>
            </div>
        </section>
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
    </script>
</body>

</html>