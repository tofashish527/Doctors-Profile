@extends('layouts.app')

@section('title', 'Home - Doctor Profile')

@section('content')

    <!-- Hero Banner Section -->
    <section class="hero-banner">
        <div class="container">
            <!-- Main Content Container -->
            <div class="main-container">
                <!-- Left Column - Doctor Info -->
                <div class="doctor-left-column">
                    <!-- Doctor Card -->
                    <div class="doctor-card animate-fade-in-up">
                        <div class="doctor-image-container">
                            <img src="{{ $banner->doctor_image ? asset('storage/' . $banner->doctor_image) : 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                                 alt="{{ $banner->doctor_name }}" 
                                 class="doctor-image">
                            <div class="experience-badge">
                                <i class="fas fa-award"></i> 10+ Years Experience
                            </div>
                        </div>
                        <div class="doctor-info">
                            <h1 class="doctor-name">{{ $banner->doctor_name }}</h1>
                            <p class="doctor-degree">{{ $banner->doctor_degree }}</p>
                            <div class="specialization">{{ $banner->specialization }}</div>
                            <p class="doctor-bio">{{ $banner->bio }}</p>
                            <div class="doctor-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="mailto:{{ $contactInfo->email ?? 'info@hospital.com' }}"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons animate-fade-in-up animate-delay-1">
                        <a href="{{ route('contact') }}" class="btn-appointment">
                            <i class="fas fa-calendar-check"></i> Book Appointment
                        </a>
            
                    {{-- WATCH VIDEO BUTTON (FIXED) --}}
                    {{-- @if($banner->video_enabled) --}}

                    <button type="button" class="mt-2 w-36 action-buttons btn-appointment animate-fade-in-up animate-delay-1" onclick="openVideoModal()">
                        <i class="fas fa-play-circle"></i> Watch Video
                    </button>
                    {{-- @endif --}}
                    </div>
                </div>
                
                <!-- Right Column - Contact & Hours -->
                <div class="right-column">
                    <!-- Emergency Card -->
                    <div class="info-card emergency-card animate-fade-in-up">
                        <div class="card-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h5>Emergency Contact</h5>
                        <p class="mb-3">24/7 Emergency Medical Services Available</p>
                        <div class="emergency-phone">
                            <a href="tel:{{ $contactInfo->phone_number ?? '+880101234567' }}">
                                {{ $contactInfo->phone_number ?? '+880 1012 34567' }}
                            </a>
                        </div>
                    </div>
                    
                    <!-- Opening Hours Card -->
                    <!-- Opening Hours Card -->
<div class="info-card opening-hours animate-fade-in-up animate-delay-1">
    <div class="card-icon">
        <i class="fas fa-clock"></i>
    </div>
    
    @if($contactInfos->count() > 1)
        <!-- Multiple Locations - With Carousel -->
        <h5>Consultation Hours</h5>
        <p class="text-muted mb-3" style="font-size: 0.9rem;">
            <i class="fas fa-map-marker-alt me-1"></i> Multiple Locations Available
        </p>
        
        <div class="location-carousel">
            <!-- Location Info Slides -->
            <div class="location-slides">
                @foreach($contactInfos as $index => $info)
                <div class="location-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                    <div class="location-header">
                        <i class="fas fa-hospital-alt me-2"></i>
                        <strong>{{ $info->address }}</strong>
                    </div>
                    <div class="location-phone mb-3">
                        <i class="fas fa-phone me-2"></i>
                        <a href="tel:{{ $info->phone_number }}">{{ $info->phone_number }}</a>
                    </div>
                    <ul class="working-hours-list">
                        @if($info->working_days && is_array($info->working_days))
                            @foreach($info->working_days as $day => $hours)
                            <li>
                                <span>{{ $day }}</span>
                                <span>{{ date('h:i A', strtotime($hours['open'])) }} - {{ date('h:i A', strtotime($hours['close'])) }}</span>
                            </li>
                            @endforeach
                        @else
                            <li class="text-muted">
                                <span colspan="2">No schedule available</span>
                            </li>
                        @endif
                    </ul>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination Controls -->
            <div class="carousel-pagination">
                @foreach($contactInfos as $index => $info)
                <button class="pagination-dot {{ $index === 0 ? 'active' : '' }}" 
                        onclick="changeLocation({{ $index }})"
                        data-slide="{{ $index }}">
                    {{ $index + 1 }}
                </button>
                @endforeach
            </div>
            
            <!-- Navigation Arrows -->
            @if($contactInfos->count() > 1)
            <div class="carousel-nav">
                <button class="nav-btn prev-btn" onclick="prevLocation()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="nav-btn next-btn" onclick="nextLocation()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            @endif
        </div>
        
    @elseif($contactInfo)
        <!-- Single Location - Original Design -->
        <h5>Consultation Hours</h5>
        <p class="text-muted mb-3" style="font-size: 0.9rem;">
            <i class="fas fa-map-marker-alt me-1"></i> {{ $contactInfo->address }}
        </p>
        <p class="text-muted mb-3" style="font-size: 0.9rem;">
            <i class="fas fa-phone me-1"></i> {{ $contactInfo->phone_number }}
        </p>
        <ul>
            @if($contactInfo->working_days && is_array($contactInfo->working_days))
                @foreach($contactInfo->working_days as $day => $hours)
                <li>
                    <span>{{ $day }}</span>
                    <span>{{ date('h:i A', strtotime($hours['open'])) }} - {{ date('h:i A', strtotime($hours['close'])) }}</span>
                </li>
                @endforeach
            @else
                <li><span>Monday - Friday</span><span>9:00 AM - 7:00 PM</span></li>
                <li><span>Saturday</span><span>10:00 AM - 5:00 PM</span></li>
                <li><span>Sunday</span><span>Emergency Only</span></li>
            @endif
        </ul>
        
    @else
        <!-- No Contact Info -->
        <h5>Consultation Hours</h5>
        <p class="text-muted">Contact information will be available soon.</p>
    @endif
</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctor Details Section -->
    <section class="doctor-details-section">
        <div class="container">
            <--Professional-->
            <div class="professional-info animate-fade-in-up">
    <table class="info-table">
        <tbody>
            <tr>
                <td class="label">Specialization</td>
                <td class="value">{{ $banner->specialization }}</td>
            </tr>
            <tr>
                <td class="label">Qualifications</td>
                <td class="value">{{ $banner->doctor_degree }}</td>
            </tr>
            
            @if($banner->expertise && is_array($banner->expertise) && count($banner->expertise) > 0)
            <tr>
                <td class="label">Areas of Expertise</td>
                <td class="value">
                    <ul class="expertise-list">
                        @foreach($banner->expertise as $item)
                        <li><i class="fas fa-check-circle"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Biography Section -->
@if($banner->biography)
<div class="biography-section animate-fade-in-up animate-delay-1">
    <h3 class="section-heading">Professional Biography</h3>
    @foreach(explode("\n", $banner->biography) as $paragraph)
        @if(trim($paragraph))
        <p class="biography-text">{{ $paragraph }}</p>
        @endif
    @endforeach
</div>
@endif

<!-- Combined Timeline Section -->
@if($banner->educations->count() > 0 || $banner->experiences->count() > 0)
<div class="combined-timeline-section animate-fade-in-up animate-delay-2">
    <h3 class="section-heading">Education & Experience</h3>
    <div class="timeline-container">
        <!-- Education Column -->
        @if($banner->educations->count() > 0)
        <div class="timeline-column">
            <h4><i class="fas fa-graduation-cap me-2"></i>Education</h4>
            <div class="timeline-items">
                @foreach($banner->educations as $education)
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-year">{{ $education->start_year }}-{{ $education->end_year }}</div>
                    <div class="timeline-content">
                        <h5>{{ $education->degree_title }}</h5>
                        <p>{{ $education->institution }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Experience Column -->
        @if($banner->experiences->count() > 0)
        <div class="timeline-column">
            <h4><i class="fas fa-briefcase me-2"></i>Experience</h4>
            <div class="timeline-items">
                @foreach($banner->experiences as $experience)
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-year">
                        {{ $experience->start_year }}-{{ $experience->end_year ?? 'Present' }}
                    </div>
                    <div class="timeline-content">
                        <h5>{{ $experience->position }}</h5>
                        <p>{{ $experience->organization }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endif
            
            <!-- Awards Section -->
            <div class="awards-section animate-fade-in-up animate-delay-2">
                <h3 class="section-heading">Awards & Recognition</h3>
                <div class="awards-grid">
                    <div class="award-card">
                        <div class="award-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="award-content">
                            <h5>Excellence in Cardiology Award</h5>
                            <p>Cardiology Society of Bangladesh, 2022</p>
                        </div>
                    </div>
                    <div class="award-card">
                        <div class="award-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <div class="award-content">
                            <h5>Best Research Paper Award</h5>
                            <p>Asian Cardiology Conference, 2021</p>
                        </div>
                    </div>
                    <div class="award-card">
                        <div class="award-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="award-content">
                            <h5>Patient's Choice Award</h5>
                            <p>Healthcare Excellence Awards, 2020</p>
                        </div>
                    </div>
                    <div class="award-card">
                        <div class="award-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="award-content">
                            <h5>Young Cardiologist Award</h5>
                            <p>International Cardiac Society, 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   {{-- VIDEO MODAL (ONLY ONE – FIXED) --}}
<div class="video-modal" id="videoModal">
    <div class="video-modal-content">
        <button class="close-video" id="closeVideoBtn">
            <i class="fas fa-times"></i>
        </button>
        <video id="introVideo" controls>
            <source src="{{ asset('storage/' . $banner->intro_video) }}" type="video/mp4">
        </video>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
     // Video Modal Functions - Fixed Version
function openVideoModal() {
    console.log('Opening video modal...');
    
    const modal = document.getElementById('videoModal');
    const video = document.getElementById('introVideo');
    
    if (!modal) {
        console.error('Video modal not found!');
        alert('Video modal not found. Please check the console for errors.');
        return;
    }
    
    if (!video) {
        console.error('Video element not found!');
        return;
    }
    
    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Video source check
    console.log('Video source:', video.src);
    
    // Try to play video
    const playPromise = video.play();
    
    if (playPromise !== undefined) {
        playPromise.catch(error => {
            console.error('Video playback failed:', error);
            // Show error message to user
            const errorMsg = document.createElement('div');
            errorMsg.className = 'alert alert-warning mt-3';
            errorMsg.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Video playback failed. Please try again or contact support.';
            modal.querySelector('.video-modal-content').appendChild(errorMsg);
        });
    }
}

function closeVideoModal() {
    console.log('Closing video modal...');
    
    const modal = document.getElementById('videoModal');
    const video = document.getElementById('introVideo');
    
    if (modal && video) {
        modal.classList.remove('active');
        video.pause();
        video.currentTime = 0;
        document.body.style.overflow = '';
    }
}

// Debug: Button click event
document.addEventListener('DOMContentLoaded', function() {
    const videoBtn = document.querySelector('.btn-video');
    if (videoBtn) {
        videoBtn.addEventListener('click', function(e) {
            console.log('Video button clicked!');
            openVideoModal();
        });
    }
    
    // Close modal on ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeVideoModal();
        }
    });
    
    // Close on click outside
    const modal = document.getElementById('videoModal');
    if (modal) {
        modal.addEventListener('click', function(event) {
            if (event.target === this) {
                closeVideoModal();
            }
        });
    }
    
    // Close button
    const closeBtn = document.getElementById('closeVideoBtn');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeVideoModal);
    }
});
        
        // Animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-fade-in-up');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight - 100) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        }

        // Location Carousel Functions
let currentSlide = 0;
const totalSlides = {{ $contactInfos->count() }};

function changeLocation(slideIndex) {
    // Hide all slides
    const slides = document.querySelectorAll('.location-slide');
    const dots = document.querySelectorAll('.pagination-dot');
    
    slides.forEach((slide, index) => {
        if (index === slideIndex) {
            slide.classList.add('active');
        } else {
            slide.classList.remove('active');
        }
    });
    
    dots.forEach((dot, index) => {
        if (index === slideIndex) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
    
    currentSlide = slideIndex;
}

function nextLocation() {
    const nextSlide = (currentSlide + 1) % totalSlides;
    changeLocation(nextSlide);
}

function prevLocation() {
    const prevSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    changeLocation(prevSlide);
}

// Auto-rotate locations (optional - every 5 seconds)
// Uncomment if you want auto-rotation
// setInterval(() => {
//     if (totalSlides > 1) {
//         nextLocation();
//     }
// }, 5000);
        
        // Initialize animations and effects
        document.addEventListener('DOMContentLoaded', function() {
            // Initial animation check
            animateOnScroll();
            
            // Add scroll event listener for animations
            window.addEventListener('scroll', animateOnScroll);
            
            // Add hover effects to cards
            const cards = document.querySelectorAll('.doctor-card, .info-card, .award-card, .timeline-column');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                });
            });
        });
    </script>
@endsection

@push('styles')
 <style>
        :root {
            --primary-color: #1a5f7a;
            --secondary-color: #159895;
            --accent-color: #57c5b6;
            --light-color: #f8f9fa;
            --dark-color: #2c3e50;
            --text-color: #333333;
            --border-radius: 12px;
            --shadow: 0 10px 30px rgba(26, 95, 122, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Main Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, rgba(26, 95, 122, 0.98) 0%, rgba(21, 152, 149, 0.95) 100%);
            min-height: 90vh;
            display: flex;
            align-items: center;
            padding: 100px 0 60px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(87, 197, 182, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(26, 95, 122, 0.2) 0%, transparent 50%);
            z-index: 1;
        }
        
        /* Main Content Container */
        .main-container {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }
        
        /* Left Column - Doctor Info */
        .doctor-left-column {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        
        /* Doctor Card */
        .doctor-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(26, 95, 122, 0.15);
        }
        
        .doctor-image-container {
            position: relative;
            height: 400px;
            overflow: hidden;
        }
        
        .doctor-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .doctor-card:hover .doctor-image {
            transform: scale(1.03);
        }
        
        .experience-badge {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.95rem;
            box-shadow: 0 5px 20px rgba(21, 152, 149, 0.3);
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .doctor-info {
            padding: 40px;
        }
        
        .doctor-name {
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
            line-height: 1.2;
        }
        
        .doctor-degree {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 600;
            opacity: 0.9;
        }
        
        .specialization {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 8px 22px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 25px;
        }
        
        .doctor-bio {
            color: var(--text-color);
            line-height: 1.7;
            margin-bottom: 25px;
            opacity: 0.9;
        }
        
        .doctor-social {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        
        .doctor-social a {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid rgba(26, 95, 122, 0.1);
        }
        
        .doctor-social a:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(26, 95, 122, 0.2);
        }
        
        /* Action Buttons */
       .action-buttons {
    position: relative; /* Z-index only works with position relative, absolute, or fixed */
    z-index: 100;       /* A high number to force it to the front */
}

/* If there is a specific button class, ensure that also has z-index */
.btn-appointment, .btn-video {
    position: relative;
    z-index: 101;
}
        
        .btn-appointment {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 18px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 0.95rem;
        }
        
        .btn-appointment:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(26, 95, 122, 0.3);
            color: white;
        }
        
        .btn-video {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 16px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 0.95rem;
              opacity: 1 !important;
    visibility: visible !important;
    pointer-events: auto !important;
        }
        
        .btn-video:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(26, 95, 122, 0.2);
        }
        
        /* Right Column - Contact & Hours */
        .right-column {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        /* Info Cards */
        .info-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(26, 95, 122, 0.15);
        }
        
        .card-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .info-card h5 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
        }
        
        /* Emergency Card */
        .emergency-card {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }
        
        .emergency-card .card-icon {
            color: white;
        }
        
        .emergency-card h5 {
            color: white;
        }
        
        .emergency-phone {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 15px 0;
        }
        
        .emergency-phone a {
            color: white;
            text-decoration: none;
        }
        
        /* Opening Hours */
        .opening-hours ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .opening-hours li {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(26, 95, 122, 0.1);
            color: var(--text-color);
        }
        
        .opening-hours li:last-child {
            border-bottom: none;
        }
        
        /* Doctor Details Section */
        .doctor-details-section {
            padding: 80px 0;
            background: var(--light-color);
        }
        
        .section-heading {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
        
        /* Professional Information */
        .professional-info {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 50px;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-table tr {
            border-bottom: 1px solid rgba(26, 95, 122, 0.1);
        }
        
        .info-table tr:last-child {
            border-bottom: none;
        }
        
        .info-table td {
            padding: 25px 30px;
            vertical-align: top;
        }
        
        .info-table .label {
            font-weight: 600;
            color: var(--dark-color);
            width: 35%;
            background: rgba(26, 95, 122, 0.03);
        }
        
        .expertise-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .expertise-list li {
            padding: 8px 0;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .expertise-list li i {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }
        
        /* Combined Timeline Section */
        .combined-timeline-section {
            margin-bottom: 50px;
        }
        
        .timeline-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }
        
        .timeline-column {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
        }
        
        .timeline-column h4 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(26, 95, 122, 0.1);
        }
        
        .timeline-items {
            position: relative;
            padding-left: 25px;
        }
        
        .timeline-items::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            border-radius: 1px;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-left: 20px;
        }
        
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        
        .timeline-marker {
            position: absolute;
            left: 0;
            top: 5px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: white;
            border: 3px solid var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 95, 122, 0.1);
        }
        
        .timeline-year {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }
        
        .timeline-content h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .timeline-content p {
            color: var(--text-color);
            line-height: 1.6;
            margin-bottom: 0;
            opacity: 0.8;
            font-size: 0.95rem;
        }
        
        /* Awards Section - Fixed Grid */
        .awards-section {
            margin-bottom: 50px;
        }
        
        .awards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
        
        .award-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .award-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(26, 95, 122, 0.15);
        }
        
        .award-icon {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .award-icon i {
            font-size: 1.5rem;
        }
        
        .award-content h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .award-content p {
            color: var(--text-color);
            margin-bottom: 0;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        /* Biography Section */
        .biography-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 50px;
        }
        
        .biography-text {
            color: var(--text-color);
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 1.05rem;
            opacity: 0.9;
        }
        
        .biography-text:last-child {
            margin-bottom: 0;
        }
        
        /* Video Modal */
        .video-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .video-modal.active {
            display: flex;
            opacity: 1;
        }
        
        .video-modal-content {
            position: relative;
            width: 90%;
            max-width: 900px;
            background: #000;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        
        .video-modal.active .video-modal-content {
            transform: scale(1);
        }
        
        .video-modal-content video {
            width: 100%;
            height: auto;
            max-height: 75vh;
            display: block;
            border-radius: 15px;
        }
        
        .close-video {
            position: absolute;
            top: -60px;
            right: 0;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 10000;
            backdrop-filter: blur(5px);
        }
        
        .close-video:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
            transform: rotate(90deg);
        }

        /* Location Carousel Styles */
.location-carousel {
    position: relative;
}

.location-slides {
    position: relative;
    min-height: 300px;
}

.location-slide {
    display: none;
    animation: slideIn 0.5s ease;
}

.location-slide.active {
    display: block;
}

.location-header {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}

.location-phone {
    padding: 8px 15px;
    background: rgba(26, 95, 122, 0.05);
    border-radius: 6px;
    font-size: 0.9rem;
}

.location-phone a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
}

.location-phone a:hover {
    color: var(--secondary-color);
}

.working-hours-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.working-hours-list li {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid rgba(26, 95, 122, 0.1);
    color: var(--text-color);
}

.working-hours-list li:last-child {
    border-bottom: none;
}

/* Carousel Pagination */
.carousel-pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(26, 95, 122, 0.1);
}

.pagination-dot {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(26, 95, 122, 0.1);
    border: 2px solid transparent;
    color: var(--primary-color);
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pagination-dot:hover {
    background: rgba(26, 95, 122, 0.2);
    transform: scale(1.1);
}

.pagination-dot.active {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    border-color: var(--primary-color);
    box-shadow: 0 4px 12px rgba(26, 95, 122, 0.3);
}

/* Navigation Arrows */
.carousel-nav {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}

.nav-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.nav-btn:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.1);
}

/* Slide Animation */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .location-header {
        font-size: 0.85rem;
        padding: 10px 15px;
    }
    
    .pagination-dot {
        width: 32px;
        height: 32px;
        font-size: 0.85rem;
    }
    
    .nav-btn {
        width: 36px;
        height: 36px;
    }
}

@media (max-width: 576px) {
    .carousel-nav {
        position: absolute;
        width: 100%;
        top: 50%;
        transform: translateY(-50%);
        padding: 0 10px;
        pointer-events: none;
    }
    
    .nav-btn {
        pointer-events: all;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
}
        
        /* Responsive Styles */
        @media (max-width: 1200px) {
            .main-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .right-column {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }
        
        @media (max-width: 992px) {
            .hero-banner {
                padding: 80px 0 40px;
                min-height: auto;
            }
            
            .doctor-image-container {
                height: 350px;
            }
            
            .timeline-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .awards-grid {
                grid-template-columns: 1fr;
            }
            
            .doctor-name {
                font-size: 2rem;
            }
            
            .section-heading {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-banner {
                padding: 60px 0 30px;
            }
            
            .doctor-image-container {
                height: 300px;
            }
            
            .doctor-info {
                padding: 30px;
            }
            
            .right-column {
                grid-template-columns: 1fr;
            }
            
            .doctor-name {
                font-size: 1.8rem;
            }
            
            .info-card {
                padding: 25px;
            }
            
            .btn-appointment,
            .btn-video {
                padding: 16px 25px;
            }
            
            .info-table td {
                padding: 20px;
            }
            
            .biography-section {
                padding: 30px;
            }
            
            .timeline-column {
                padding: 25px;
            }
        }
        
        @media (max-width: 576px) {
            .doctor-image-container {
                height: 250px;
            }
            
            .doctor-info {
                padding: 25px;
            }
            
            .doctor-name {
                font-size: 1.6rem;
            }
            
            .experience-badge {
                padding: 10px 20px;
                font-size: 0.9rem;
                bottom: 15px;
                right: 15px;
            }
            
            .section-heading {
                font-size: 1.6rem;
            }
            
            .info-table td {
                padding: 15px;
                display: block;
                width: 100%;
            }
            
            .info-table .label {
                width: 100%;
                background: none;
                border-bottom: 1px solid rgba(26, 95, 122, 0.1);
                padding-bottom: 10px;
                margin-bottom: 10px;
            }
            
            .video-modal-content {
                width: 95%;
            }
            
            .close-video {
                top: -70px;
                right: 10px;
            }
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .animate-delay-1 {
            animation-delay: 0.2s;
        }
        
        .animate-delay-2 {
            animation-delay: 0.4s;
        }
    </style>
@endpush