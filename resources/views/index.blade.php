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
        <div class="header-right" style="display: flex; align-items: center; gap: 20px;">
            <button class="help-btn" onclick="openHelpModal()">Help</button>
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleDropdown(event)">
                    <i class="ph-fill ph-user-circle" style="color: var(--primary-color);"></i>
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
        <div class="hero-slider-arrow left">
            <button class="hero-prev"><i class="ph-bold ph-caret-left"></i></button>
        </div>
        <div class="hero-slider-arrow right">
            <button class="hero-next"><i class="ph-bold ph-caret-right"></i></button>
        </div>
        
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
            position: absolute !important; top: 20px !important; right: 20px !important; left: auto !important;
            background: none !important; border: none !important; box-shadow: none !important;
            font-size: 1.5rem !important; color: #999 !important; cursor: pointer; transition: color 0.3s;
            display: flex !important; align-items: center !important; justify-content: center !important;
            width: 32px !important; height: 32px !important; padding: 0 !important;
            z-index: 10;
        }
        .help-modal-close:hover { color: #333 !important; background: none !important; box-shadow: none !important; transform: none !important; }
        .help-modal-title { text-align: center; font-size: 1.8rem; font-weight: 700; color: #111; margin-bottom: 25px; margin-top: 0; }
        .help-form { display: flex; flex-direction: column; gap: 20px; }
        .help-form-row { display: flex; gap: 20px; }
        .help-input-group { display: flex; flex-direction: column; gap: 8px; flex: 1; }
        .help-input-group.full-width { width: 100%; }
        .help-input-group label { font-size: 0.85rem; font-weight: 700; color: #444; text-transform: uppercase; letter-spacing: 0.5px; }
        .help-input-group input, .help-input-group textarea {
            padding: 14px 16px !important; border: 1px solid #ddd !important; border-radius: 8px !important;
            font-family: inherit; font-size: 1rem !important; transition: all 0.3s; background: #fafafa !important;
            width: 100%;
        }
        .help-input-group input:focus, .help-input-group textarea:focus {
            border-color: var(--primary-color) !important; outline: none !important; background: #fff !important; box-shadow: 0 0 0 4px rgba(255, 122, 0, 0.1) !important;
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
            background: var(--primary-color) !important; color: white !important; border: none !important; padding: 16px !important;
            border-radius: 40px !important; font-size: 1.1rem !important; font-weight: 700 !important; cursor: pointer;
            transition: all 0.3s; box-shadow: 0 4px 12px rgba(255, 122, 0, 0.2) !important;
            width: 100% !important; text-align: center !important;
        }
        .help-send-btn:hover { background: var(--primary-hover) !important; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(255, 122, 0, 0.3) !important; }
        
        @media (max-width: 600px) {
            .help-form-row { flex-direction: column; gap: 20px; }
            .help-modal-card { padding: 30px 20px; }
        }

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
        .dashboard-rooms-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;
            max-width: 1250px; margin: 0 auto;
        }
        @media (max-width: 1024px) { .dashboard-rooms-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .dashboard-rooms-grid { grid-template-columns: 1fr; } }
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

        <!-- EXPLORE OUR ROOMS RE-INTEGRATED SLIDER -->
        <section class="explore-rooms-section">
            <div class="slider-master-container">
                <div class="title-section" style="text-align: center; margin-bottom: 2rem;">
                    <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--text-color); letter-spacing: -1px;">Explore Our Rooms</h2>
                </div>

                <div class="slider-outer-frame">
                    <button type="button" id="roomPrevBtn" class="room-nav-btn left" aria-label="Previous">‹</button>
                    
                    <div id="cardsCarousel" class="cards-container">
                        @php
                            $roomCards = [
                                ['badge' => 'Standard', 'badgeClass' => 'standard-badge', 'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90', 'title' => 'Standard Rooms', 'desc' => 'Comfortable accommodations designed for short and efficient stays.', 'route' => 'standard.rooms', 'btnText' => 'Explore Standard'],
                                ['badge' => 'Premium', 'badgeClass' => 'premium-badge', 'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90', 'title' => 'Advance Rooms', 'desc' => 'Premium guest rooms tailored for extended comfort and privacy.', 'route' => 'advance.rooms', 'btnText' => 'Explore Advance'],
                                ['badge' => 'Conference', 'badgeClass' => 'conference-badge', 'image' => 'https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90', 'title' => 'Conference Hall', 'desc' => 'Dedicated interactive halls for large meetings and events.', 'route' => 'conference.rooms', 'btnText' => 'Explore Halls'],
                                ['badge' => 'Conference', 'badgeClass' => 'conference-badge', 'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90', 'title' => 'Glass Room', 'desc' => 'Premium transparent facility for collaborative sessions.', 'route' => 'conference.rooms', 'btnText' => 'Explore Halls'],
                                ['badge' => 'Suite', 'badgeClass' => 'suite-badge', 'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90', 'title' => 'Suite Room', 'desc' => 'Luxury stay with premium comfort and privacy. <strong>Room No: 202</strong>', 'route' => 'advance.rooms', 'btnText' => 'Explore Suite'],
                            ];
                        @endphp

                        @for ($i = 0; $i < 2; $i++)
                            @foreach ($roomCards as $card)
                                <div class="card slider-card">
                                    <div class="card-image-wrapper">
                                        <span class="badge {{ $card['badgeClass'] }}" style="position: absolute; top: 1rem; left: 1rem; z-index: 5;">{{ $card['badge'] }}</span>
                                        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}">
                                    </div>
                                    <div class="card-content">
                                        <h2>{{ $card['title'] }}</h2>
                                        <p class="description">{!! $card['desc'] !!}</p>
                                        <p class="gst-text">+ 5% GST applicable</p>
                                        <div style="margin-top: 1rem;">
                                            <a href="{{ route($card['route']) }}" class="btn btn-outline" style="width: 100%; text-align: center;">{{ $card['btnText'] }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endfor
                    </div>

                    <button type="button" id="roomNextBtn" class="room-nav-btn right" aria-label="Next">›</button>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.getElementById('cardsCarousel');
                const leftArrow = document.getElementById('roomPrevBtn');
                const rightArrow = document.getElementById('roomNextBtn');
                
                let speed = 0.65; // Consistent speed
                let isHovered = false;
                let scrollPos = 0;

                function autoScroll() {
                    if (!isHovered) {
                        scrollPos += speed;
                        if (scrollPos >= container.scrollWidth / 2) {
                            scrollPos = 0;
                        }
                        container.scrollLeft = scrollPos;
                    }
                    requestAnimationFrame(autoScroll);
                }

                autoScroll();

                let manualPauseTimer = null;

                function manualPause() {
                    isHovered = true;
                    if (manualPauseTimer) clearTimeout(manualPauseTimer);
                    manualPauseTimer = setTimeout(() => {
                        isHovered = false;
                        scrollPos = container.scrollLeft;
                    }, 2500); // 2.5s manual override
                }

                leftArrow.onclick = (e) => {
                    e.preventDefault();
                    manualPause();
                    container.scrollBy({ left: -320, behavior: 'smooth' });
                };

                rightArrow.onclick = (e) => {
                    e.preventDefault();
                    manualPause();
                    container.scrollBy({ left: 320, behavior: 'smooth' });
                };

                container.addEventListener('mouseenter', () => isHovered = true);
                container.addEventListener('mouseleave', () => {
                    isHovered = false;
                    scrollPos = container.scrollLeft;
                });
            });
        </script>
        <!-- ROOM CATEGORIES COMPARISON -->
        <section style="max-width: 1250px; margin: 0 auto 3rem; padding: 0 1rem;">
            <div class="title-section" style="text-align: center; margin-bottom: 2rem;">
                <h2 style="font-size: 2rem; font-weight: 800; color: var(--text-color);">Room Categories</h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <!-- Standard Rooms Info -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <h3 style="color: var(--primary-color); font-size: 1.2rem; margin-bottom: 1rem; font-weight: 700;">STANDARD ROOMS</h3>
                    <ul style="list-style: none; padding: 0; color: var(--text-light); font-size: 0.95rem; line-height: 1.8;">
                        <li><i class="ph-fill ph-tag" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>₹1400 / 12 hrs</strong></li>
                        <li><i class="ph-fill ph-clock" style="color: var(--primary-color); margin-right: 8px;"></i> Ideal for short stay</li>
                        <li><i class="ph-fill ph-check-circle" style="color: var(--primary-color); margin-right: 8px;"></i> Basic amenities (AC, WiFi, Work Desk)</li>
                        <li><i class="ph-fill ph-door" style="color: var(--primary-color); margin-right: 8px;"></i> Rooms 1 – 8</li>
                    </ul>
                </div>
                <!-- Advance Rooms Info -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <h3 style="color: var(--primary-color); font-size: 1.2rem; margin-bottom: 1rem; font-weight: 700;">ADVANCE ROOMS</h3>
                    <ul style="list-style: none; padding: 0; color: var(--text-light); font-size: 0.95rem; line-height: 1.8;">
                        <li><i class="ph-fill ph-tag" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>₹2500 / day</strong> <span class="gst-text" style="display: inline; font-size: 0.75rem;">(+ 5% GST)</span></li>
                        <li><i class="ph-fill ph-shield-star" style="color: var(--primary-color); margin-right: 8px;"></i> Premium stay experience</li>
                        <li><i class="ph-fill ph-star" style="color: var(--primary-color); margin-right: 8px;"></i> Better interiors + privacy</li>
                        <li><i class="ph-fill ph-door" style="color: var(--primary-color); margin-right: 8px;"></i> Rooms 101–104, 201–207</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- CATEGORY SELECTION (TIGHTER BALANCED) -->
        <section style="max-width: 1350px; margin: 0 auto 5rem; padding: 0 1.25rem;">
            <div class="dashboard-rooms-grid">
                <!-- Standard Rooms -->
                <div class="card premium-card" style="display: flex; flex-direction: column; height: 100%;">
                    <div class="card-image-wrapper" style="height: 160px;">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Standard Rooms" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge" style="background: #e5e7eb; color: #333; position: absolute; top: 1rem; left: 1rem; z-index: 5;">Standard</span>
                    </div>
                    <div class="card-content" style="padding: 1.25rem; flex: 1; display: flex; flex-direction: column;">
                        <h2 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.5rem;">Standard Rooms</h2>
                        <p class="description" style="color: #666; font-size: 0.9rem; line-height: 1.5; margin-bottom: 0.25rem;">Comfortable accommodations designed for short and efficient stays with essential amenities.</p>
                        <p class="gst-text" style="font-size: 0.8rem; color: #888; margin-bottom: 0.75rem;">+ 5% GST applicable</p>
                        <div style="margin-top: auto;">
                            <a href="{{ route('standard.rooms') }}" class="btn btn-outline view-details-btn" style="width: 100%; text-align: center; justify-content: center;">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Advance Rooms -->
                <div class="card premium-card" style="display: flex; flex-direction: column; height: 100%;">
                    <div class="card-image-wrapper" style="height: 160px;">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Advance Rooms" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge" style="background: var(--primary-color); color: white; position: absolute; top: 1rem; left: 1rem; z-index: 5;">Premium</span>
                    </div>
                    <div class="card-content" style="padding: 1.25rem; flex: 1; display: flex; flex-direction: column;">
                        <h2 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.5rem;">Advance Rooms</h2>
                        <p class="description" style="color: #666; font-size: 0.9rem; line-height: 1.5; margin-bottom: 0.25rem;">Premium guest rooms tailored for extended comfort, delegates, and specific reservations.</p>
                        <p class="gst-text" style="font-size: 0.8rem; color: #888; margin-bottom: 0.75rem;">+ 5% GST applicable</p>
                        <div style="margin-top: auto;">
                            <a href="{{ route('advance.rooms') }}" class="btn btn-outline view-details-btn" style="width: 100%; text-align: center; justify-content: center;">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="card premium-card" style="display: flex; flex-direction: column; height: 100%;">
                    <div class="card-image-wrapper" style="height: 160px;">
                        <img src="https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=90" alt="Conference Rooms" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge" style="background: #3b82f6; color: white; position: absolute; top: 1rem; left: 1rem; z-index: 5;">Conference</span>
                    </div>
                    <div class="card-content" style="padding: 1.25rem; flex: 1; display: flex; flex-direction: column;">
                        <h2 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.5rem;">Conference / Glass Rooms</h2>
                        <p class="description" style="color: #666; font-size: 0.9rem; line-height: 1.5; margin-bottom: 0.25rem;">Dedicated interactive halls for large meetings, corporate events, and collaborative sessions.</p>
                        <p class="gst-text" style="font-size: 0.8rem; color: #888; margin-bottom: 0.75rem;">+ 5% GST applicable</p>
                        <div style="margin-top: auto;">
                            <a href="{{ route('conference.rooms') }}" class="btn btn-outline view-details-btn" style="width: 100%; text-align: center; justify-content: center;">View Details</a>
                        </div>
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
        <style>
            /* ── Footer-scoped enhancements ── */
            .main-footer {
                background: linear-gradient(180deg, #fff7f0 0%, #f3f4f6 100%) !important;
                border-top: 3px solid #ff6a00 !important;
                color: #444 !important;
            }
            .main-footer .footer-column h4 {
                color: #222 !important;
            }
            .main-footer .footer-column ul li,
            .main-footer .footer-column ul li a,
            .main-footer .footer-column p,
            .main-footer .footer-contact-link {
                color: #555 !important;
            }
            .main-footer .footer-column ul li a:hover,
            .main-footer .footer-contact-link:hover {
                color: #ff6a00 !important;
            }
            .main-footer .footer-content {
                padding: 2rem 2rem 1.5rem !important;
            }
            .main-footer .footer-column h4 {
                font-weight: 700 !important;
                margin-bottom: 0.8rem !important;
                padding-bottom: 0.5rem !important;
                position: relative;
                display: inline-block;
            }
            .main-footer .footer-column h4::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 30px;
                height: 2px;
                background: var(--primary-color);
                border-radius: 2px;
            }
            /* Quick Links hover */
            .main-footer .footer-column ul { list-style: none; padding: 0; margin: 0; }
            .main-footer .footer-column ul li { margin-bottom: 0.4rem; }
            .main-footer .footer-column ul li a {
                transition: color 0.3s ease, transform 0.2s ease;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                text-decoration: none;
            }
            .main-footer .footer-column ul li a:hover {
                color: var(--primary-color) !important;
                transform: translateX(2px);
            }
            /* Contact links */
            .main-footer .footer-contact-link {
                color: inherit;
                text-decoration: none;
                transition: color 0.3s ease;
            }
            .main-footer .footer-contact-link:hover {
                color: var(--primary-color) !important;
            }
            .main-footer .footer-column ul li i {
                width: 18px;
                text-align: center;
                flex-shrink: 0;
            }
            /* Social icons */
            .footer-social-icons {
                display: flex;
                gap: 10px;
                margin-top: 1rem;
            }
            .footer-social-icons a {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: rgba(0,0,0,0.06);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #888;
                font-size: 1rem;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            .footer-social-icons a:hover {
                background: var(--primary-color) !important;
                color: #fff !important;
                transform: translateY(-2px);
            }
            /* Address line spacing */
            .main-footer .footer-address-text {
                line-height: 1.8;
            }
            /* Footer bottom bar */
            .main-footer .footer-bottom {
                border-top: 1px solid rgba(0,0,0,0.06) !important;
                padding: 1rem 2rem !important;
                background: rgba(0,0,0,0.03) !important;
                text-align: center;
                color: #888 !important;
            }
            /* Mobile responsive */
            @media (max-width: 768px) {
                .main-footer .footer-content {
                    flex-direction: column !important;
                    text-align: center !important;
                    gap: 2rem !important;
                }
                .main-footer .footer-column {
                    width: 100% !important;
                    text-align: center;
                }
                .main-footer .footer-column h4 {
                    display: block;
                }
                .main-footer .footer-column h4::after {
                    left: 50%;
                    transform: translateX(-50%);
                }
                .main-footer .footer-column ul li a {
                    justify-content: center;
                }
                .main-footer .footer-column p {
                    justify-content: center;
                }
                .footer-social-icons {
                    justify-content: center;
                }
                .main-footer .footer-column ul li {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 6px;
                }
                .main-footer .footer-bottom {
                    font-size: 0.8rem !important;
                    padding: 0.8rem 1rem !important;
                }
            }
        </style>
        <div class="footer-content">
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="javascript:void(0)" onclick="document.querySelector('.main-image-slider').scrollIntoView({behavior:'smooth'})"><i class="ph-bold ph-caret-right" style="font-size: 0.8rem;"></i> Home</a></li>
                    <li><a href="javascript:void(0)" onclick="document.querySelector('.explore-rooms-section').scrollIntoView({behavior:'smooth'})"><i class="ph-bold ph-caret-right" style="font-size: 0.8rem;"></i> Spaces</a></li>
                    <li><a href="javascript:void(0)" onclick="openHelpModal()"><i class="ph-bold ph-caret-right" style="font-size: 0.8rem;"></i> Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Contact Info</h4>
                <ul>
                    <li><i class="ph-fill ph-envelope-simple"></i> <a href="mailto:contact@mmip.example.com" class="footer-contact-link">contact@mmip.example.com</a></li>
                    <li><i class="ph-fill ph-phone"></i> <a href="tel:+919876543210" class="footer-contact-link">+91 98765 43210</a></li>
                </ul>
                <div class="footer-social-icons">
                    <a href="https://wa.me/919876543210" target="_blank" rel="noopener" title="WhatsApp"><i class="ph-bold ph-whatsapp-logo"></i></a>
                    <a href="mailto:contact@mmip.example.com" title="Email"><i class="ph-bold ph-envelope-simple"></i></a>
                    <a href="tel:+919876543210" title="Call"><i class="ph-bold ph-phone"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h4>Address</h4>
                <p><i class="ph-fill ph-map-pin" style="margin-top: 0.3rem;"></i> <span class="footer-address-text">MCC MRF Innovation Park,<br>Madras Christian College,<br>Tambaram East,<br>Chennai - 600059,<br>Tamil Nadu, India</span></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 MCC-MRF Innovation Park. All rights reserved.</p>
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
                    <p class="gst-text">+ 5% GST applicable</p>
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

    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', initIndexPage);

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

        window.onclick = function(event) {
            const helpModal = document.getElementById('helpModal');
            if (event.target == helpModal) {
                closeHelpModal();
            }

            const dropdownOptions = document.getElementById('helpDropdownOptions');
            const dropdownSelected = document.querySelector('.dropdown-selected');
            if (dropdownOptions && dropdownSelected && !dropdownSelected.contains(event.target)) {
                dropdownOptions.classList.remove('active');
            }
        }

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