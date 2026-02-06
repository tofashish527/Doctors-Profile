@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <section class="contact-section py-5">
        <div class="container">
            <div class="main-container p-4">
                <!-- Page Title -->
                <div class="page-title text-center">
                    <h1 class="display-4 fw-bold mb-2">
                        <i class="bi bi-envelope-heart"></i> Contact Us
                    </h1>
                    <p class="lead mb-0">We'd love to hear from you!</p>
                </div>

                <!-- Success Alert -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row equal-height-row">
                    <!-- Left Side: Contact Information (Scrollable) -->
                    <div class="col-lg-5 mb-4">
                        <div class="locations-wrapper">
                            <h3 class="mb-4 fw-bold sticky-header">
                                <i class="bi bi-geo-alt-fill text-primary"></i> Our Locations
                            </h3>
                            
                            <div class="locations-scroll-container">
                                @forelse($contactInfos as $index => $info)
                                <div class="card location-card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="card-title text-primary fw-bold mb-0">
                                                <i class="bi bi-building"></i> Location {{ $index + 1 }}
                                            </h5>
                                            <span class="badge bg-success">Active</span>
                                        </div>
                                        
                                        <p class="mb-2">
                                            <i class="bi bi-geo-alt text-danger"></i> 
                                            <strong>Address:</strong><br>
                                            <span class="ms-4">{{ $info->address }}</span>
                                        </p>
                                        
                                        <p class="mb-3">
                                            <i class="bi bi-telephone-fill text-success"></i> 
                                            <strong>Phone:</strong> 
                                            <a href="tel:{{ $info->phone_number }}" class="text-decoration-none">
                                                {{ $info->phone_number }}
                                            </a>
                                        </p>
                                        
                                        <hr>
                                        
                                        <p class="mb-2 fw-bold">
                                            <i class="bi bi-clock-fill text-info"></i> Working Hours:
                                        </p>
                                        <ul class="list-unstyled ms-3">
                                            @if($info->working_days && is_array($info->working_days) && count($info->working_days) > 0)
                                                @foreach($info->working_days as $day => $time)
                                                <li class="mb-2">
                                                    <span class="badge bg-info text-dark me-2">{{ $day }}</span>
                                                    <small class="text-muted">
                                                        {{ date('h:i A', strtotime($time['open'])) }} - 
                                                        {{ date('h:i A', strtotime($time['close'])) }}
                                                    </small>
                                                </li>
                                                @endforeach
                                            @else
                                                <li class="text-muted">No working hours set</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i> No locations available at the moment.
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Contact Form -->
                    <div class="col-lg-7">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body p-4">
                                <h3 class="mb-4 fw-bold">
                                    <i class="bi bi-send-fill text-primary"></i> Send Us a Message
                                </h3>

                                @if($contactInfos->isEmpty())
                                    <div class="alert alert-warning">
                                        Contact form is currently unavailable. Please check back later.
                                    </div>
                                @else
                                <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                                    @csrf

                                    <!-- Name Field -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-person-fill text-primary"></i> Full Name 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               name="name" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" 
                                               placeholder="Enter your full name"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email & Phone Row -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="bi bi-envelope-fill text-success"></i> Email 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" 
                                                   name="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   value="{{ old('email') }}" 
                                                   placeholder="your@email.com"
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="bi bi-phone-fill text-warning"></i> Phone Number 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" 
                                                   name="phone_number" 
                                                   class="form-control @error('phone_number') is-invalid @enderror" 
                                                   value="{{ old('phone_number') }}" 
                                                   placeholder="+880 1XXX-XXXXXX"
                                                   required>
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address Dropdown -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-geo-alt-fill text-danger"></i> Choose Location 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="selected_address" 
                                                id="addressSelect" 
                                                class="form-select @error('selected_address') is-invalid @enderror" 
                                                onchange="updateTimings()"
                                                required>
                                            <option value="">-- Select a location --</option>
                                            @foreach($contactInfos as $info)
                                                <option value="{{ $info->address }}" 
                                                        data-timings='@json($info->working_days)'
                                                        data-phone="{{ $info->phone_number }}"
                                                        {{ old('selected_address') == $info->address ? 'selected' : '' }}>
                                                    {{ $info->address }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('selected_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Timing Dropdown - ALWAYS VISIBLE -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-clock-fill text-info"></i> Preferred Timing 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="selected_timing" 
                                                id="timingSelect" 
                                                class="form-select @error('selected_timing') is-invalid @enderror"
                                                required
                                                disabled>
                                        </select>
                                        @error('selected_timing')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted" id="timingHelp">
                                            <i class="bi bi-info-circle"></i> 
                                            Select a location to see available timings
                                        </small>
                                    </div>

                                    <!-- Message Field -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-chat-left-text-fill text-secondary"></i> 
                                            Your Message <span class="text-muted">(Optional)</span>
                                        </label>
                                        <textarea name="message" 
                                                  rows="4" 
                                                  class="form-control @error('message') is-invalid @enderror"
                                                  placeholder="Write your message here... (Max 1000 characters)">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Debug: Test Button (Remove in production) -->
                                    {{-- <button type="button" 
                                            class="btn btn-warning w-100 mb-2" 
                                            onclick="testDropdown()">
                                        🧪 Test Timing Dropdown
                                    </button> --}}

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-send-fill me-2"></i> Send Message
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .contact-section {
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .main-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .page-title {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px;
        margin: -20px -20px 30px -20px;
    }
    
    .equal-height-row {
        display: flex;
        flex-wrap: wrap;
    }
    
    .equal-height-row > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }
    
    .locations-wrapper {
        display: flex;
        flex-direction: column;
        height: 100%;
        max-height: 700px;
    }
    
    .sticky-header {
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
        padding: 15px 0;
        margin-bottom: 0 !important;
        border-bottom: 2px solid #e9ecef;
    }
    
    .locations-scroll-container {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 20px 5px 20px 0;
        margin-top: 10px;
    }
    
    .locations-scroll-container::-webkit-scrollbar {
        width: 8px;
    }
    
    .locations-scroll-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .locations-scroll-container::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 10px;
    }
    
    .locations-scroll-container::-webkit-scrollbar-thumb:hover {
        background: #764ba2;
    }
    
    .location-card {
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
        margin-right: 10px;
    }
    
    .location-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #667eea;
    }
    
    .col-lg-7 .card {
        max-height: 700px;
        overflow-y: auto;
    }
    
    #timingSelect:disabled {
        background-color: #f8f9fa;
        cursor: not-allowed;
        opacity: 0.7;
    }
    
    /* Force timing select to be visible */
    #timingSelect {
        display: block !important;
        visibility: visible !important;
    }
    
    @media (max-width: 991px) {
        .locations-wrapper {
            max-height: 500px;
            margin-bottom: 20px;
        }
        
        .col-lg-7 .card {
            max-height: none;
        }
    }
    
    @media (max-width: 576px) {
        .page-title {
            padding: 30px 20px;
        }
        
        .page-title h1 {
            font-size: 2rem;
        }
        
        .locations-wrapper {
            max-height: 400px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function updateTimings() {
        console.log('🔄 updateTimings() called');
        
        const addressSelect = document.getElementById('addressSelect');
        const timingSelect = document.getElementById('timingSelect');
        const timingHelp = document.getElementById('timingHelp');
        
        if (!addressSelect || !timingSelect) {
            console.error('❌ Elements not found!');
            return;
        }
        
        const selectedOption = addressSelect.options[addressSelect.selectedIndex];
        const selectedValue = selectedOption.value;
        
        console.log('📍 Selected:', selectedValue);
        
        // No address selected
        if (!selectedValue) {
            timingSelect.disabled = true;
            timingSelect.innerHTML = '<option value="">-- Please select a location first --</option>';
            timingHelp.innerHTML = '<i class="bi bi-info-circle"></i> Select a location to see available timings';
            console.log('⚠️ No address selected');
            return;
        }
        
        // Get timings data
        const timingsData = selectedOption.getAttribute('data-timings');
        console.log('📊 Raw data:', timingsData);
        
        try {
            const workingDays = JSON.parse(timingsData);
            console.log('✅ Parsed:', workingDays);
            
            // Clear options
            timingSelect.innerHTML = '<option value="">-- Select your preferred timing --</option>';
            
            let count = 0;
            
            // Add each day as option
            for (const [day, time] of Object.entries(workingDays)) {
                if (time && time.open && time.close) {
                    const openTime = formatTime(time.open);
                    const closeTime = formatTime(time.close);
                    const optionText = `${day} ${openTime} - ${closeTime}`;
                    
                    const option = document.createElement('option');
                    option.value = optionText;
                    option.textContent = optionText;
                    timingSelect.appendChild(option);
                    
                    count++;
                    console.log(`  ✓ Added: ${optionText}`);
                }
            }
            
            if (count > 0) {
                // Force enable and make visible
                timingSelect.disabled = false;
                timingSelect.removeAttribute('disabled');
                timingSelect.style.display = 'block';
                timingSelect.style.visibility = 'visible';
                timingSelect.style.backgroundColor = 'white';
                timingSelect.style.cursor = 'pointer';
                timingSelect.style.opacity = '1';
                
                timingHelp.innerHTML = `<i class="bi bi-check-circle text-success"></i> ${count} timing(s) available`;
                
                console.log(`✅ SUCCESS! ${count} options added`);
                console.log('🔍 Dropdown state:', {
                    disabled: timingSelect.disabled,
                    optionsCount: timingSelect.options.length,
                    display: timingSelect.style.display,
                    visibility: timingSelect.style.visibility
                });
            } else {
                timingSelect.disabled = true;
                timingHelp.innerHTML = '<i class="bi bi-exclamation-circle text-warning"></i> No timings available';
                console.log('⚠️ No valid timings');
            }
            
        } catch (e) {
            console.error('❌ Parse error:', e);
            timingSelect.disabled = true;
            timingSelect.innerHTML = '<option value="">-- Error loading timings --</option>';
        }
    }
    
    function formatTime(time24) {
        const [hours, minutes] = time24.split(':');
        let hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        hour = hour % 12 || 12;
        return `${String(hour).padStart(2, '0')}:${minutes} ${ampm}`;
    }
    
    // Test function to debug dropdown
    // function testDropdown() {
    //     const timingSelect = document.getElementById('timingSelect');
        
    //     console.log('🧪 === DROPDOWN TEST ===');
    //     console.log('Element:', timingSelect);
    //     console.log('Disabled:', timingSelect.disabled);
    //     console.log('Total options:', timingSelect.options.length);
    //     console.log('Options:');
        
    //     for (let i = 0; i < timingSelect.options.length; i++) {
    //         console.log(`  ${i}: ${timingSelect.options[i].text} (value: ${timingSelect.options[i].value})`);
    //     }
        
    //     console.log('HTML:', timingSelect.innerHTML);
    //     console.log('Computed style:', window.getComputedStyle(timingSelect));
        
    //     // Try to enable it manually
    //     timingSelect.disabled = false;
    //     timingSelect.removeAttribute('disabled');
        
    //     alert(`Dropdown has ${timingSelect.options.length} options.\nDisabled: ${timingSelect.disabled}\n\nCheck console for details.`);
    // }
    
    // Page load
    document.addEventListener('DOMContentLoaded', function() {
        console.log('✅ Page loaded');
        
        const addressSelect = document.getElementById('addressSelect');
        if (addressSelect && addressSelect.value) {
            console.log('🔄 Pre-selected address found, updating...');
            updateTimings();
        }
    });
</script>
@endpush