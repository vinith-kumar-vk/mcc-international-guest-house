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
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        /* =============================================================
           GLOBAL RESET & BASE
        ============================================================= */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { width: 100%; overflow-x: hidden; }

        /* =============================================================
           HERO SLIDER OVERLAYS & NAV (Base is in responsive.css)
        ============================================================= */
        .hero-prev, .hero-next {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 50px; height: 50px; background: #fff;
            border: 1px solid #eee;
            border-radius: 50%; color: var(--primary-color); font-size: 1.5rem; cursor: pointer;
            z-index: 10; display: flex; align-items: center; justify-content: center;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .hero-prev { left: 30px; }
        .hero-next { right: 30px; }
        .hero-prev:hover, .hero-next:hover { 
            background: #fff; 
            color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-50%) scale(1.08); 
            box-shadow: 0 8px 25px rgba(255,122,0,0.25);
        }

        .hero-dot {
            background-color: rgba(255, 255, 255, 0.4) !important;
        }

        .hero-dot.active {
            background-color: var(--primary-color) !important;
        }

        /* =============================================================
           HERO WELCOME SECTION (Base is in responsive.css)
        ============================================================= */
        .hero-section { text-align: center; padding: 1rem 1.5rem 0.5rem; background: #f8fafc; }
        .welcome-title {
            font-size: 3rem;
            font-weight: 800;
            color: #1e293b;
            letter-spacing: -1px;
            position: relative;
            display: inline-block;
            margin-bottom: 8px;
        }
        .welcome-subtitle {
            font-size: 1.15rem;
            font-weight: 500;
            color: #64748b;
            max-width: 700px;
            margin: 1.25rem auto 0;
            line-height: 1.6;
        }

        /* =============================================================
           PREMIUM FACILITY CARD (Base is in responsive.css)
        ============================================================= */
        /*  FACILITY SECTION  */
        .premium-facility-card {
            background: linear-gradient(135deg, #fff, #fbfbfb);
            border-radius: 24px; padding: 3rem 2.5rem;
            box-shadow: 0 10px 50px rgba(0,0,0,0.04);
            border: 1px solid #f1f1f1;
            transition: all 0.5s cubic-bezier(0.165,0.84,0.44,1);
            max-width: 900px; margin: 1.5rem auto;
            opacity: 0; transform: translateY(30px);
            text-align: center;
        }
        .premium-facility-card.visible { opacity: 1; transform: translateY(0); }
        .premium-facility-card:hover { transform: translateY(-5px); box-shadow: 0 15px 60px rgba(0,0,0,0.08); }
        .facility-title {
            font-size: 2rem; font-weight: 800; color: #111;
            margin-bottom: 0.5rem; display: inline-block; letter-spacing: -0.5px;
        }
        .facility-divider {
            width: 50px; height: 3px; background: var(--primary-color);
            margin: 1.25rem auto; border-radius: 5px; opacity: 0.8;
        }
        .feature-grid {
            display: grid; 
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem; 
            margin-top: 2rem;
            width: 100%;
        }
        @media (max-width: 900px) {
            .feature-grid { grid-template-columns: repeat(2, 1fr); }
            .premium-facility-card { padding: 2.5rem 1.5rem; }
        }
        @media (max-width: 650px) {
            .feature-grid { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
            .premium-facility-card { padding: 2rem 1.25rem; margin: 1rem auto; }
            .facility-title { font-size: 1.6rem; }
        }
        .feature-item {
            display: flex; align-items: center; gap: 15px;
            padding: 1.25rem 1.5rem; background: white; border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02); 
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            text-align: left;
        }

        /* Visibility Improvements for Room Categories */
        /* Slider Card Consistency */
        .slider-card {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            min-height: 480px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
            border: 1px solid #edf2f7 !important;
            transition: all 0.3s ease !important;
        }
        .slider-card .card-content {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            padding: 1.5rem !important;
        }
        .slider-card h2 {
            color: #0f172a !important;
            font-weight: 800 !important;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }
        .slider-card .description {
            color: #334155 !important;
            font-weight: 500 !important;
            line-height: 1.6 !important;
            min-height: 90px !important;
            margin-bottom: 1.5rem !important;
        }
        .slider-card .card-btn-wrapper {
            margin-top: auto !important;
        }

        /* Category Card Alignment */
        .premium-card {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            min-height: 520px !important;
        }
        .premium-card .card-content {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
        }
        .premium-card .description {
            min-height: 80px !important;
        }
        .premium-card .card-btn-wrapper {
            margin-top: auto !important;
        }

        .feature-item i { font-size: 1.8rem; color: var(--primary-color); flex-shrink: 0; }
        .feature-item span { font-weight: 700; color: #2d3748; font-size: 0.95rem; line-height: 1.2; }
        .feature-item:hover { background: #fff8f3; border-color: rgba(255,122,0,0.2); transform: translateY(-3px); box-shadow: 0 8px 25px rgba(255,122,0,0.08); }
        
        /* Optimization for Slider Lag */
        .hero-slide {
            will-change: opacity;
            transform: translateZ(0);
        }
        .slider-card {
            transform: translateZ(0); 
            backface-visibility: hidden;
        }
    </style>
    @include('partials.dynamic-styles')
</head>

<body>
    @include('partials.header', ['showHelpBtn' => true])

    <!-- MAIN IMAGE SLIDER SECTION -->
    <section class="main-image-slider">
        <!-- Slide 1 -->
        <div class="hero-slide active-slide">
            <img src="{{ asset('assets/standard/banner.JPG') }}" alt="MCC IGH Home" style="width:100%;height:100%;object-fit:cover;pointer-events:none;" loading="eager">
            <div class="hero-layer" style="position:absolute;inset:0;pointer-events:none;">
                <h2 class="slide-title">Welcome to MCC IGH</h2>
                <p class="slide-subtitle">Comfortable and secure guest house booking</p>
                <a href="#explore-rooms" class="btn btn-primary banner-cta" style="pointer-events: auto;">BOOK NOW</a>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="hero-slide">
            <img src="{{ asset('assets/mcc1.png') }}" alt="MCC IGH Premium" style="width:100%;height:100%;object-fit:cover;pointer-events:none;">
            <div class="hero-layer" style="position:absolute;inset:0;pointer-events:none;">
                <h2 class="slide-title">Premium Stay Experience</h2>
                <p class="slide-subtitle">Book rooms easily with modern facilities</p>
                <a href="#explore-rooms" class="btn btn-primary banner-cta" style="pointer-events: auto;">BOOK NOW</a>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="hero-slide">
            <img src="{{ asset('assets/mcc2.png') }}" alt="MCC IGH Booking" style="width:100%;height:100%;object-fit:cover;pointer-events:none;">
            <div class="hero-layer" style="position:absolute;inset:0;pointer-events:none;">
                <h2 class="slide-title">Simple &amp; Fast Booking</h2>
                <p class="slide-subtitle">Plan your stay with ease and convenience</p>
                <a href="#explore-rooms" class="btn btn-primary banner-cta" style="pointer-events: auto;">BOOK NOW</a>
            </div>
        </div>
        <!-- Slide 4 -->
        <div class="hero-slide">
            <img src="{{ asset('assets/standard/banner2.jpg') }}" alt="MCC IGH Modern" style="width:100%;height:100%;object-fit:cover;pointer-events:none;">
            <div class="hero-layer" style="position:absolute;inset:0;pointer-events:none;">
                <h2 class="slide-title">Modern Amenities</h2>
                <p class="slide-subtitle">Experience comfort with state-of-the-art facilities</p>
                <a href="#explore-rooms" class="btn btn-primary banner-cta" style="pointer-events: auto;">BOOK NOW</a>
            </div>
        </div>
        <!-- Slide 5 -->
        <div class="hero-slide">
            <img src="{{ asset('assets/standard/banner1.JPG') }}" alt="MCC IGH Serene" style="width:100%;height:100%;object-fit:cover;pointer-events:none;">
            <div class="hero-layer" style="position:absolute;inset:0;pointer-events:none;">
                <h2 class="slide-title">Serene Environment</h2>
                <p class="slide-subtitle">Enjoy a peaceful and quiet stay at the campus</p>
                <a href="#explore-rooms" class="btn btn-primary banner-cta" style="pointer-events: auto;">BOOK NOW</a>
            </div>
        </div>
        <!-- Nav Arrows -->
        <div class="hero-slider-arrow left"><button class="hero-prev"><i class="ph-bold ph-caret-left"></i></button></div>
        <div class="hero-slider-arrow right"><button class="hero-next"><i class="ph-bold ph-caret-right"></i></button></div>
        <!-- Dots -->
        <div class="hero-dots" style="position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:8px;z-index:10;">
            <div class="hero-dot active" style="width:30px;height:4px;border-radius:2px;cursor:pointer;transition:all 0.3s ease;"></div>
            <div class="hero-dot" style="width:30px;height:4px;border-radius:2px;cursor:pointer;transition:all 0.3s ease;"></div>
            <div class="hero-dot" style="width:30px;height:4px;border-radius:2px;cursor:pointer;transition:all 0.3s ease;"></div>
            <div class="hero-dot" style="width:30px;height:4px;border-radius:2px;cursor:pointer;transition:all 0.3s ease;"></div>
            <div class="hero-dot" style="width:30px;height:4px;border-radius:2px;cursor:pointer;transition:all 0.3s ease;"></div>
        </div>
    </section>

    <!-- Slider Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slider = document.querySelector('.main-image-slider');
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.hero-dot');
            const prev = document.querySelector('.hero-prev');
            const next = document.querySelector('.hero-next');
            let current = 0;
            let timer;
            let isDragging = false;
            let isHovered = false;
            let startX = 0;

            function renderSlide(index) {
                if (index < 0 || index >= slides.length) return;
                slides.forEach(s => s.classList.remove('active-slide'));
                dots.forEach(d => d.classList.remove('active'));
                
                slides[index].classList.add('active-slide');
                if (dots[index]) dots[index].classList.add('active');
                current = index;
            }

            function nextSlide() { renderSlide((current + 1) % slides.length); }
            function prevSlide() { renderSlide((current - 1 + slides.length) % slides.length); }

            function startTimer() {
                stopTimer();
                timer = setInterval(() => {
                    if (!isHovered && !isDragging) {
                        nextSlide();
                    }
                }, 4000);
            }

            function stopTimer() {
                if (timer) clearInterval(timer);
            }

            // Click Nav
            next.addEventListener('click', () => { 
                nextSlide(); 
                startTimer(); 
            });
            prev.addEventListener('click', () => { 
                prevSlide(); 
                startTimer(); 
            });

            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => { 
                    renderSlide(i); 
                    startTimer(); 
                });
            });

            // Pause on hover
            slider.addEventListener('mouseenter', () => {
                isHovered = true;
                stopTimer();
            });
            slider.addEventListener('mouseleave', () => {
                isHovered = false;
                if (!isDragging) startTimer();
            });

            // Drag / Swipe Logic
            function dragStart(e) {
                isDragging = true;
                startX = e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
                stopTimer();
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
                startTimer();
            }

            slider.addEventListener('mousedown', dragStart);
            slider.addEventListener('mouseup', dragEnd);
            slider.addEventListener('mouseleave', (e) => { if(isDragging) dragEnd(e); });
            slider.addEventListener('touchstart', dragStart, {passive: true});
            slider.addEventListener('touchend', dragEnd);

            // Execute boot
            startTimer();
        });
    </script>

    <main>

        <!-- EXPLORE OUR ROOMS SLIDER -->
        <section id="explore-rooms" class="explore-rooms-section">
            <div class="slider-master-container">
                <div class="title-section" style="text-align: center; margin-bottom: 1.75rem; padding: 0 1rem;">
                    <h2 style="font-size: clamp(1.6rem, 4vw, 2.2rem); font-weight: 800; color: var(--text-color); letter-spacing: -0.5px; margin-bottom: 0.4rem;">Room Categories</h2>
                    <p style="color: #64748b; font-size: 0.95rem; font-weight: 400;">Choose from our range of professionally equipped rooms and halls</p>
                </div>

                <div class="slider-outer-frame">
                    <button type="button" id="roomPrevBtn" class="room-nav-btn left" aria-label="Previous">‹</button>
                    
                    <div id="cardsCarousel" class="cards-container" style="align-items: stretch;">
                        @php
                            $roomCards = [
                                ['badge' => 'Standard', 'badgeClass' => 'standard-badge', 'image' => asset('assets/standard/standardroom.JPG'), 'title' => 'Standard Rooms', 'desc' => 'Thoughtfully designed for efficiency and comfort, our Standard Rooms provide a restful haven for short-term visitors with essential modern amenities.', 'route' => 'standard.rooms', 'btnText' => 'EXPLORE STANDARD'],
                                ['badge' => 'Premium', 'badgeClass' => 'premium-badge', 'image' => asset('assets/room1.JPG'), 'title' => 'Advance Rooms', 'desc' => 'Experience elevated hospitality in our Advance Rooms, specifically curated for guests seeking enhanced privacy and premium comfort during longer stays.', 'route' => 'advance.rooms', 'btnText' => 'EXPLORE ADVANCE'],
                                ['badge' => 'Conference', 'badgeClass' => 'conference-badge', 'image' => asset('assets/standard/conference.JPG'), 'title' => 'Conference Room', 'desc' => 'A versatile venue designed for large-scale gatherings and corporate events with high-definition projection and professional acoustics.', 'route' => 'conference.rooms', 'btnText' => 'EXPLORE HALLS'],
                                ['badge' => 'Glass Room', 'badgeClass' => 'conference-badge', 'image' => asset('assets/standard/glass.JPG'), 'title' => 'Glass Room', 'desc' => 'Inspire creativity in our modern Glass Room, designed for collaborative brainstorming and focused team sessions with ample natural light.', 'route' => 'conference.rooms', 'btnText' => 'EXPLORE HALLS'],
                                ['badge' => 'Suite', 'badgeClass' => 'suite-badge', 'image' => asset('assets/suite.JPG'), 'title' => 'Suite Room', 'desc' => 'Our flagship Suite Room offers the pinnacle of luxury, featuring a grand king-size bed and premium toiletries for ultimate relaxation.', 'route' => 'conference.rooms', 'btnText' => 'EXPLORE SUITE'],
                            ];
                        @endphp

                        @for ($i = 0; $i < 2; $i++)
                            @foreach ($roomCards as $card)
                                <div class="card slider-card" style="display: flex; flex-direction: column; height: 100%; min-width: 320px;">
                                    <div class="card-image-wrapper" style="height: 160px; flex-shrink: 0;">
                                        <span class="badge {{ $card['badgeClass'] }}" style="position: absolute; top: 1rem; left: 1rem; z-index: 5;">{{ $card['badge'] }}</span>
                                        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}">
                                    </div>
                                    <div class="card-content" style="flex: 1; display: flex; flex-direction: column; padding: 1.25rem;">
                                        <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; color: #0f172a;">{{ $card['title'] }}</h2>
                                        <p class="description" style="font-size: 0.9rem; color: #475569; line-height: 1.6; margin-bottom: 1rem; flex: none; min-height: 90px;">{!! $card['desc'] !!}</p>
                                        @php $gstRate = \App\Models\Setting::where('key', 'gst_rate')->value('value') ?? 5; @endphp
                                        <p class="gst-text" style="font-size: 0.8rem; color: #94a3b8; margin-top: auto; margin-bottom: 1rem;">+ {{ $gstRate }}% GST applicable</p>
                                        <div class="card-btn-wrapper" style="margin-top: 0;">
                                            <a href="{{ route($card['route']) }}" class="btn btn-outline" style="width: 100%; text-align: center; justify-content: center; text-transform: uppercase; font-weight: 700;">{{ $card['btnText'] }}</a>
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
                
                let speed = 1.0; // 1px per frame (perfectly smooth on 60fps)
                let isHovered = false;
                let isManualPaused = false;
                let scrollPos = container.scrollLeft;
                let manualPauseTimer = null;

                function autoScroll() {
                    if (!isHovered && !isManualPaused) {
                        scrollPos += speed;
                        if (scrollPos >= container.scrollWidth / 2) {
                            scrollPos = 0;
                        }
                        container.scrollLeft = scrollPos;
                    }
                    requestAnimationFrame(autoScroll);
                }

                autoScroll();

                function triggerManualPause() {
                    isManualPaused = true;
                    if (manualPauseTimer) clearTimeout(manualPauseTimer);
                    manualPauseTimer = setTimeout(() => {
                        isManualPaused = false;
                        // Synchronize scrollPos with actual scrollLeft when resuming
                        scrollPos = container.scrollLeft;
                    }, 4000); // 4s manual override after interaction
                }

                leftArrow.onclick = (e) => {
                    e.preventDefault();
                    triggerManualPause();
                    container.scrollBy({ left: -320, behavior: 'smooth' });
                };

                rightArrow.onclick = (e) => {
                    e.preventDefault();
                    triggerManualPause();
                    container.scrollBy({ left: 320, behavior: 'smooth' });
                };

                // Track hover state
                container.addEventListener('mouseenter', () => {
                    isHovered = true;
                });
                
                container.addEventListener('mouseleave', () => {
                    isHovered = false;
                    // Sync position on leave to ensure smooth pickup
                    scrollPos = container.scrollLeft;
                });

                // Periodic sync to handle manual browser scrolling or touch
                container.addEventListener('scroll', () => {
                    if (isHovered || isManualPaused) {
                        scrollPos = container.scrollLeft;
                    }
                });
            });
        </script>
        <!-- ROOM CATEGORIES QUICK REFERENCE -->
        <section style="max-width: 1100px;">
            <div class="title-section" style="text-align: center; margin-bottom: 1.5rem;">
                <h2 style="font-size: clamp(1.4rem, 4vw, 1.9rem); font-weight: 800; color: var(--text-color); letter-spacing: -0.5px; margin-bottom: 0.3rem;">Pricing Overview</h2>
                <p style="color: #64748b; font-size: 0.9rem;">Quick reference for room rates and availability</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; align-items: stretch;">
                <!-- Standard Rooms Info -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <h3 style="color: var(--primary-color); font-size: 1.2rem; margin-bottom: 1rem; font-weight: 700;">STANDARD ROOMS</h3>
                    <ul style="list-style: none; padding: 0; color: var(--text-light); font-size: 0.95rem; line-height: 1.8;">
                        <li><i class="ph-fill ph-tag" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>₹1400 / 12 hrs</strong> <span class="gst-text" style="display: inline; font-size: 0.75rem;">(+ {{ $gstRate }}% GST)</span></li>
                        <li><i class="ph-fill ph-clock" style="color: var(--primary-color); margin-right: 8px;"></i> Ideal for short stay</li>
                        <li><i class="ph-fill ph-check-circle" style="color: var(--primary-color); margin-right: 8px;"></i> Basic amenities (AC, WiFi, Work Desk)</li>
                        <li><i class="ph-fill ph-door" style="color: var(--primary-color); margin-right: 8px;"></i> Rooms 1 – 8</li>
                    </ul>
                </div>
                <!-- Advance Rooms Info -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <h3 style="color: var(--primary-color); font-size: 1.2rem; margin-bottom: 1rem; font-weight: 700;">ADVANCE ROOMS</h3>
                    <ul style="list-style: none; padding: 0; color: var(--text-light); font-size: 0.95rem; line-height: 1.8;">
                        <li><i class="ph-fill ph-tag" style="color: var(--primary-color); margin-right: 8px;"></i> <strong>₹2500 / day</strong> <span class="gst-text" style="display: inline; font-size: 0.75rem;">(+ {{ $gstRate }}% GST)</span></li>
                        <li><i class="ph-fill ph-shield-star" style="color: var(--primary-color); margin-right: 8px;"></i> Premium stay experience</li>
                        <li><i class="ph-fill ph-star" style="color: var(--primary-color); margin-right: 8px;"></i> Better interiors + privacy</li>
                        <li><i class="ph-fill ph-door" style="color: var(--primary-color); margin-right: 8px;"></i> Rooms 101–104, 201–207</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- CATEGORY SELECTION -->
        <section style="max-width: 1350px;">
            <div class="title-section" style="text-align: center; margin-bottom: 1.75rem;">
                <h2 style="font-size: clamp(1.4rem, 4vw, 1.9rem); font-weight: 800; color: var(--text-color); letter-spacing: -0.5px; margin-bottom: 0.3rem;">Browse All Rooms</h2>
                <p style="color: #64748b; font-size: 0.9rem;">Select a category to explore availability and book your stay</p>
            </div>
            <div class="dashboard-rooms-grid" style="align-items: stretch;">

                <!-- Standard Rooms -->
                <div class="card premium-card">
                    <div class="card-image-wrapper" style="height: 160px;">
                        <img src="{{ asset('assets/standard/standardroom.JPG') }}" alt="Standard Rooms" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge standard-badge" style="position: absolute; top: 1rem; left: 1rem; z-index: 5;">Standard</span>
                    </div>
                    <div class="card-content">
                        <h2>Standard Rooms</h2>
                        <p class="description">Thoughtfully designed for efficiency and comfort, our Standard Rooms provide a restful haven for short-term visitors with essential modern amenities.</p>
                        <p class="gst-text">+ {{ $gstRate }}% GST applicable</p>
                        <div class="card-btn-wrapper">
                            <a href="{{ route('standard.rooms') }}" class="btn btn-outline view-details-btn" style="width: 100%; text-align: center; justify-content: center;">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Advance Rooms -->
                <div class="card premium-card">
                    <div class="card-image-wrapper" style="height: 160px;">
                        <img src="{{ asset('assets/room1.JPG') }}" alt="Advance Rooms" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge premium-badge" style="position: absolute; top: 1rem; left: 1rem; z-index: 5;">Premium</span>
                    </div>
                    <div class="card-content">
                        <h2>Advance Rooms</h2>
                        <p class="description">Experience elevated hospitality in our Advance Rooms, specifically curated for guests seeking enhanced privacy and premium comfort during longer stays.</p>
                        <p class="gst-text">+ {{ $gstRate }}% GST applicable</p>
                        <div class="card-btn-wrapper">
                            <a href="{{ route('advance.rooms') }}" class="btn btn-outline view-details-btn" style="width: 100%; text-align: center; justify-content: center;">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Conference / Glass Rooms -->
                <div class="card premium-card">
                    <div class="card-image-wrapper" style="height: 160px;">
                        <img src="{{ asset('assets/standard/conference.JPG') }}" alt="Conference Rooms" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge conference-badge" style="position: absolute; top: 1rem; left: 1rem; z-index: 5;">Conference</span>
                    </div>
                    <div class="card-content">
                        <h2>Conference & Glass Rooms</h2>
                        <p class="description">A versatile and professionally equipped venue designed for large-scale gatherings, corporate events, and interactive workshops with HD projection.</p>
                        <p class="gst-text">+ {{ $gstRate }}% GST applicable</p>
                        <div class="card-btn-wrapper">
                            <a href="{{ route('conference.rooms') }}" class="btn btn-outline view-details-btn" style="width: 100%; text-align: center; justify-content: center;">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ABOUT FACILITIES -->
        <section class="description-section">
            <div class="premium-facility-card" id="facilityCard">
                <h2 class="facility-title">About Our Facilities</h2>
                <div class="facility-divider"></div>
                <div class="desc-content">
                    <p style="font-size: 1.15rem; line-height: 1.7; color: #555; max-width: 750px; margin: 0 auto;">Experience a refined stay tailored to the needs of modern professionals and distinguished guests. At MCC IGH, we combine traditional hospitality with premium modern amenities, ensuring every moment of your visit is both relaxing and highly productive.</p>
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

    @include('partials.footer')

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
                    <p class="gst-text">+ {{ $gstRate }}% GST applicable</p>
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

    @include('partials.help-modal')


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