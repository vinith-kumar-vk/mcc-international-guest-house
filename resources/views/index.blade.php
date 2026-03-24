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

    <!-- MAIN IMAGE SLIDER SECTION (Full screen Edge-to-Edge) -->
    <section class="main-image-slider" style="position: relative; width: 100%; height: 50vh; min-height: 450px; max-height: 650px; overflow: hidden; background: #000; margin-bottom: 2rem;">
        
        <!-- Slide 1 -->
        <div class="hero-slide active-slide">
            <img src="{{ asset('assets/mcc.png') }}" alt="MCC IGH Dashboard" style="width: 100%; height: 100%; object-fit: cover; pointer-events: none;">
            <div class="hero-layer" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.1) 70%); display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 0 5%; pointer-events: none;">
                <h2 class="slide-title" style="color: #ffffff; font-size: 3.5rem; font-weight: 800; margin-bottom: 0.8rem; text-shadow: 0 4px 12px rgba(0,0,0,0.6);">Welcome to MCC IGH</h2>
                <p class="slide-subtitle" style="color: #ffffff; font-size: 1.25rem; font-weight: 500; text-shadow: 0 2px 8px rgba(0,0,0,0.6);">Comfortable and secure guest house booking</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide">
            <img src="{{ asset('assets/mcc1.png') }}" alt="MCC IGH Premium" style="width: 100%; height: 100%; object-fit: cover; pointer-events: none;">
            <div class="hero-layer" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.1) 70%); display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 0 5%; pointer-events: none;">
                <h2 class="slide-title" style="color: #ffffff; font-size: 3.5rem; font-weight: 800; margin-bottom: 0.8rem; text-shadow: 0 4px 12px rgba(0,0,0,0.6);">Premium Stay Experience</h2>
                <p class="slide-subtitle" style="color: #ffffff; font-size: 1.25rem; font-weight: 500; text-shadow: 0 2px 8px rgba(0,0,0,0.6);">Book rooms easily with modern facilities</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide">
            <img src="{{ asset('assets/mcc2.png') }}" alt="MCC IGH Booking" style="width: 100%; height: 100%; object-fit: cover; pointer-events: none;">
            <div class="hero-layer" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.1) 70%); display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 0 5%; pointer-events: none;">
                <h2 class="slide-title" style="color: #ffffff; font-size: 3.5rem; font-weight: 800; margin-bottom: 0.8rem; text-shadow: 0 4px 12px rgba(0,0,0,0.6);">Simple & Fast Booking</h2>
                <p class="slide-subtitle" style="color: #ffffff; font-size: 1.25rem; font-weight: 500; text-shadow: 0 2px 8px rgba(0,0,0,0.6);">Plan your stay with ease and convenience</p>
            </div>
        </div>

        <!-- Minimalist Flow Controls -->
        <button class="hero-prev" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 10; background: transparent; border: none; padding: 10px; cursor: pointer; transition: all 0.3s ease;"><i class="ph-light ph-arrow-left" style="font-size: 3rem; color: #fff; filter: drop-shadow(0 2px 6px rgba(0,0,0,0.6)); transition: all 0.3s;"></i></button>
        <button class="hero-next" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); z-index: 10; background: transparent; border: none; padding: 10px; cursor: pointer; transition: all 0.3s ease;"><i class="ph-light ph-arrow-right" style="font-size: 3rem; color: #fff; filter: drop-shadow(0 2px 6px rgba(0,0,0,0.6)); transition: all 0.3s;"></i></button>
        
        <!-- Subtle Tracking Bands -->
        <div class="hero-dots" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 10;">
            <div class="hero-dot active" style="width: 35px; height: 3px; background: var(--primary-color); cursor: pointer; transition: 0.3s ease;"></div>
            <div class="hero-dot" style="width: 35px; height: 3px; background: rgba(255,255,255,0.4); cursor: pointer; transition: 0.3s ease;"></div>
            <div class="hero-dot" style="width: 35px; height: 3px; background: rgba(255,255,255,0.4); cursor: pointer; transition: 0.3s ease;"></div>
        </div>
    </section>

    <!-- Script & Styles for Slider -->
    <style>
        .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1s ease-in-out; z-index: 1; }
        .hero-slide.active-slide { opacity: 1; z-index: 2; }
        
        .hero-prev:hover i, .hero-next:hover i { color: var(--primary-color) !important; transform: scale(1.1); }
        .hero-prev:hover { transform: translateY(-50%) translateX(-4px); }
        .hero-next:hover { transform: translateY(-50%) translateX(4px); }
        
        /* High-fidelity Text Animation */
        .hero-slide .slide-title { transform: translateY(25px); opacity: 0; transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) 0.3s; }
        .hero-slide .slide-subtitle { transform: translateY(20px); opacity: 0; transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) 0.5s; }
        .hero-slide.active-slide .slide-title, .hero-slide.active-slide .slide-subtitle { transform: translateY(0); opacity: 1; }

        @media (max-width: 768px) {
            .main-image-slider { height: 380px !important; min-height: unset; margin-bottom: 1.5rem !important; }
            .hero-layer h2 { font-size: 2.2rem !important; margin-bottom: 0.5rem !important; }
            .hero-layer p { font-size: 1rem !important; }
            .hero-prev i, .hero-next i { font-size: 2.2rem !important; }
        }

        /* Premium Facilities Section Styles */
        .premium-facility-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 20px;
            padding: 3.5rem 2rem;
            box-shadow: 0 15px 40px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.03);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: hidden;
            max-width: 900px;
            margin: 4rem auto;
            opacity: 0;
            transform: translateY(30px);
        }
        .premium-facility-card.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .premium-facility-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }
        .facility-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #222;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
            letter-spacing: -0.5px;
        }
        .facility-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 4px;
            background: var(--primary-color);
            transform: translateX(-50%);
            transition: width 0.6s ease;
            border-radius: 2px;
        }
        .premium-facility-card:hover .facility-title::after {
            width: 80px;
        }
        .facility-divider {
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            margin: 1.5rem auto;
            border-radius: 5px;
            opacity: 0.6;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
            text-align: left;
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            transition: 0.3s;
        }
        .feature-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        .feature-item span {
            font-weight: 600;
            color: #444;
            font-size: 0.95rem;
        }
        .feature-item:hover {
            background: #fff4ed;
            transform: scale(1.05);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slider = document.querySelector('.main-image-slider');
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.hero-dot');
            const prev = document.querySelector('.hero-prev');
            const next = document.querySelector('.hero-next');
            let current = 0;
            let timer;
            let startX = 0;
            let isDragging = false;

            function renderSlide(index) {
                slides.forEach(s => s.classList.remove('active-slide'));
                dots.forEach(d => d.style.background = 'rgba(255,255,255,0.4)');
                
                slides[index].classList.add('active-slide');
                dots[index].style.background = 'var(--primary-color)';
                current = index;
            }

            function nextSlide() { renderSlide((current + 1) % slides.length); }
            function prevSlide() { renderSlide((current - 1 + slides.length) % slides.length); }

            function getTimer() { return setInterval(nextSlide, 4000); } // 4s slightly slower auto-slide
            function resetTimer() { clearInterval(timer); timer = getTimer(); }

            // Click Nav
            next.addEventListener('click', () => { nextSlide(); resetTimer(); });
            prev.addEventListener('click', () => { prevSlide(); resetTimer(); });

            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => { renderSlide(i); resetTimer(); });
            });

            // Pause on hover
            slider.addEventListener('mouseenter', () => clearInterval(timer));
            slider.addEventListener('mouseleave', () => { if(!isDragging) resetTimer(); });

            // Drag / Swipe Logic
            function dragStart(e) {
                isDragging = true;
                startX = e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
                clearInterval(timer);
                slider.style.cursor = 'grabbing';
            }
            function dragEnd(e) {
                if (!isDragging) return;
                isDragging = false;
                slider.style.cursor = 'default';
                
                let endX = e.type.includes('mouse') ? e.pageX : e.changedTouches[0].clientX;
                let diff = startX - endX;

                if (Math.abs(diff) > 50) {
                    if (diff > 0) nextSlide();
                    else prevSlide();
                }
                resetTimer();
            }

            slider.addEventListener('mousedown', dragStart);
            slider.addEventListener('mouseup', dragEnd);
            slider.addEventListener('mouseleave', (e) => { if(isDragging) dragEnd(e); });
            slider.addEventListener('touchstart', dragStart, {passive: true});
            slider.addEventListener('touchend', dragEnd);

            // Execute boot
            timer = getTimer();
        });
    </script>

    <main>

        <!-- HERO SECTION -->
        <section class="hero-section" style="text-align: center; padding: 2rem 20px 1.5rem; background: var(--bg-color); margin: 0; width: 100%; max-width: 100%;">
            <h1 class="welcome-animate" style="font-size: 3.5rem; font-weight: 850; color: var(--text-color); margin-bottom: 8px; letter-spacing: -2px; position: relative; display: inline-block;">Welcome to MCC IGH
                <span style="position: absolute; width: 40%; height: 5px; bottom: -8px; left: 30%; background-color: var(--primary-color); border-radius: 4px;"></span>
            </h1>
            <p class="welcome-animate" style="font-size: 1.25rem; font-weight: 500; color: var(--text-light); max-width: 800px; margin: 1.25rem auto 0; line-height: 1.6; animation-delay: 0.15s;">Book comfortable guest house rooms effortlessly and manage your professional stay with ease.</p>
        </section>

        <!-- EXPLORE OUR ROOMS AUTO-SLIDER -->
        <section class="explore-rooms-slider-section" style="width: 100%; max-width: 100%; margin: 20px auto 4rem auto; padding: 0 20px; position: relative; overflow: hidden;">
            <div class="title-section" style="text-align: center; margin-bottom: 2rem;">
                <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--text-color); letter-spacing: -1px;">Explore Our Rooms</h2>
            </div>

            <!-- Arrows -->
            <button id="sliderPrevBtn" class="btn btn-outline" style="position: absolute; left: 30px; top: 60%; transform: translateY(-50%); z-index: 10; width: 50px; height: 50px; border-radius: 50%; padding: 0; box-shadow: 0 6px 15px rgba(0,0,0,0.1); background: white;"><i class="ph-bold ph-caret-left" style="font-size: 1.6rem;"></i></button>
            <button id="sliderNextBtn" class="btn btn-outline" style="position: absolute; right: 30px; top: 60%; transform: translateY(-50%); z-index: 10; width: 50px; height: 50px; border-radius: 50%; padding: 0; box-shadow: 0 6px 15px rgba(0,0,0,0.1); background: white;"><i class="ph-bold ph-caret-right" style="font-size: 1.6rem;"></i></button>

            <!-- Container -->
            <div id="sliderViewport" style="overflow: hidden; width: 100%; margin: 0 auto; padding: 2rem 0;">
                <div id="sliderTrack" style="display: flex; gap: 2.5rem; transition: transform 0.4s ease-out; width: max-content; padding-left: 60px;">
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

        <!-- GUEST HOUSE DESCRIPTION (PREMIUM ENHANCED) -->
        <section class="description-section" style="padding: 0 20px;">
            <div class="premium-facility-card" id="facilityCard">
                <h2 class="facility-title">About Our Facilities</h2>
                <div class="facility-divider"></div>
                <div class="desc-content">
                    <p style="font-size: 1.15rem; line-height: 1.7; color: #555; max-width: 750px; margin: 0 auto;">Enjoy comfortable stays tailored perfectly to meet the demands of modern professionals. Our guest house comes equipped with all premium amenities aimed at making your experience relaxing and highly productive.</p>
                </div>

                <div class="feature-grid">
                    <div class="feature-item">
                        <i class="ph-fill ph-wifi-high"></i>
                        <span>High-Speed WiFi</span>
                    </div>
                    <div class="feature-item">
                        <i class="ph-fill ph-wind"></i>
                        <span>Smart AC Rooms</span>
                    </div>
                    <div class="feature-item">
                        <i class="ph-fill ph-headset"></i>
                        <span>24/7 Support</span>
                    </div>
                    <div class="feature-item">
                        <i class="ph-fill ph-shield-check"></i>
                        <span>Secure & Clean</span>
                    </div>
                </div>
            </div>
        </section>

        <script>
            // Simple Intersection Observer for the fade-in effect
            document.addEventListener('DOMContentLoaded', function() {
                const card = document.getElementById('facilityCard');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, { threshold: 0.1 });
                observer.observe(card);
            });
        </script>
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