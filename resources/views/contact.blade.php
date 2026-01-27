{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 50px 0;
        }
        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .location-card {
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
        }
        .location-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        .page-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            margin: -20px -20px 30px -20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container p-4">
            <div class="page-title text-center">
                <h1 class="display-4 fw-bold mb-2">
                    <i class="bi bi-envelope-heart"></i> Contact Us
                </h1>
                <p class="lead mb-0">We'd love to hear from you!</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Debug: Check if data is coming -->
            @if($contactInfos->isEmpty())
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> 
                    No contact information available. Please add contact info from admin panel.
                </div>
            @endif

            <div class="row">
                <!-- Left Side: Contact Information -->
                <div class="col-lg-5 mb-4">
                    <h3 class="mb-4 fw-bold">
                        <i class="bi bi-geo-alt-fill text-primary"></i> Our Locations
                    </h3>
                    
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
                                @forelse($info->working_days as $day => $time)
                                <li class="mb-2">
                                    <span class="badge bg-info text-dark me-2">{{ $day }}</span>
                                    <small class="text-muted">
                                        {{ date('h:i A', strtotime($time['open'])) }} - 
                                        {{ date('h:i A', strtotime($time['close'])) }}
                                    </small>
                                </li>
                                @empty
                                <li class="text-muted">No working hours set</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> No locations available at the moment.
                    </div>
                    @endforelse
                </div>

                <!-- Right Side: Contact Form -->
                <div class="col-lg-7">
                    <div class="card shadow-sm border-0">
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
                                            required 
                                            onchange="updateTimings()">
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

                                <!-- Timing Dropdown (Auto-populate) -->
                                <div class="mb-3" id="timingSection" style="display: none;">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-clock-fill text-info"></i> Preferred Timing 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="selected_timing" 
                                            id="timingSelect" 
                                            class="form-select @error('selected_timing') is-invalid @enderror">
                                        <option value="">-- First select a location --</option>
                                    </select>
                                    @error('selected_timing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle"></i> 
                                        Available timings for selected location
                                    </small>
                                </div>

                                <!-- Message Field -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-chat-left-text-fill text-secondary"></i> 
                                        Your Message <span class="text-muted">(Optional)</span>
                                    </label>
                                    <textarea name="message" 
                                              rows="5" 
                                              class="form-control @error('message') is-invalid @enderror"
                                              placeholder="Write your message here... (Max 1000 characters)">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateTimings() {
            const addressSelect = document.getElementById('addressSelect');
            const timingSection = document.getElementById('timingSection');
            const timingSelect = document.getElementById('timingSelect');
            
            // Get selected option
            const selectedOption = addressSelect.options[addressSelect.selectedIndex];
            const timingsData = selectedOption.getAttribute('data-timings');
            
            console.log('Selected Address:', selectedOption.value);
            console.log('Timings Data:', timingsData);
            
            if (timingsData && timingsData !== 'null' && timingsData !== '[]') {
                try {
                    const workingDays = JSON.parse(timingsData);
                    
                    // Clear previous options
                    timingSelect.innerHTML = '<option value="">-- Select your preferred timing --</option>';
                    
                    // Check if working days exist
                    if (Object.keys(workingDays).length > 0) {
                        // Add new options
                        for (const [day, time] of Object.entries(workingDays)) {
                            const openTime = formatTime(time.open);
                            const closeTime = formatTime(time.close);
                            
                            const option = document.createElement('option');
                            option.value = `${day} (${openTime} - ${closeTime})`;
                            option.textContent = `${day} (${openTime} - ${closeTime})`;
                            timingSelect.appendChild(option);
                        }
                        
                        // Show timing section
                        timingSection.style.display = 'block';
                        timingSelect.required = true;
                    } else {
                        // No working days
                        timingSection.style.display = 'none';
                        timingSelect.required = false;
                    }
                } catch (e) {
                    console.error('Error parsing timings:', e);
                    timingSection.style.display = 'none';
                }
            } else {
                // No address selected
                timingSection.style.display = 'none';
                timingSelect.required = false;
                timingSelect.innerHTML = '<option value="">-- First select a location --</option>';
            }
        }
        
        function formatTime(time24) {
            // Convert 24-hour format to 12-hour format
            const [hours, minutes] = time24.split(':');
            let hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            hour = hour % 12 || 12;
            return `${hour}:${minutes} ${ampm}`;
        }
        
        // On page load, restore timing if address was selected
        document.addEventListener('DOMContentLoaded', function() {
            const addressSelect = document.getElementById('addressSelect');
            if (addressSelect.value) {
                updateTimings();
            }
        });
    </script>
</body>
</html>
 --}}




@extends('layouts.app')

@section('title', 'Home Pharmacy')

@section('content')
    {{-- <!-- আপনার কন্টেন্ট এখানে -->
    <section class="slider slider-5" id="slider-5">
        <!-- স্লাইডার কন্টেন্ট -->
    </section> --}}
    
    <section class="shop shop-3" id="shop-1">
        {{-- <!-- শপ সেকশন --> --}}
         <div class="container">
        <div class="main-container p-4">
            <div class="page-title text-center">
                <h1 class="display-4 fw-bold mb-2">
                    <i class="bi bi-envelope-heart"></i> Contact Us
                </h1>
                <p class="lead mb-0">We'd love to hear from you!</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Debug: Check if data is coming -->
            @if($contactInfos->isEmpty())
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> 
                    No contact information available. Please add contact info from admin panel.
                </div>
            @endif

            <div class="row">
                <!-- Left Side: Contact Information -->
                <div class="col-lg-5 mb-4">
                    <h3 class="mb-4 fw-bold">
                        <i class="bi bi-geo-alt-fill text-primary"></i> Our Locations
                    </h3>
                    
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
                                @forelse($info->working_days as $day => $time)
                                <li class="mb-2">
                                    <span class="badge bg-info text-dark me-2">{{ $day }}</span>
                                    <small class="text-muted">
                                        {{ date('h:i A', strtotime($time['open'])) }} - 
                                        {{ date('h:i A', strtotime($time['close'])) }}
                                    </small>
                                </li>
                                @empty
                                <li class="text-muted">No working hours set</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> No locations available at the moment.
                    </div>
                    @endforelse
                </div>

                <!-- Right Side: Contact Form -->
                <div class="col-lg-7">
                    <div class="card shadow-sm border-0">
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
                                            required 
                                            onchange="updateTimings()">
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

                                <!-- Timing Dropdown (Auto-populate) -->
                                <div class="mb-3" id="timingSection" style="display: none;">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-clock-fill text-info"></i> Preferred Timing 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="selected_timing" 
                                            id="timingSelect" 
                                            class="form-select @error('selected_timing') is-invalid @enderror">
                                        <option value="">-- First select a location --</option>
                                    </select>
                                    @error('selected_timing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle"></i> 
                                        Available timings for selected location
                                    </small>
                                </div>

                                <!-- Message Field -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-chat-left-text-fill text-secondary"></i> 
                                        Your Message <span class="text-muted">(Optional)</span>
                                    </label>
                                    <textarea name="message" 
                                              rows="5" 
                                              class="form-control @error('message') is-invalid @enderror"
                                              placeholder="Write your message here... (Max 1000 characters)">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

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
    
    <!-- অন্যান্য সেকশন -->
@endsection

@push('styles')
   <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 50px 0;
        }
        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .location-card {
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
        }
        .location-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        .page-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            margin: -20px -20px 30px -20px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@push('scripts')
   <script>
        function updateTimings() {
            const addressSelect = document.getElementById('addressSelect');
            const timingSection = document.getElementById('timingSection');
            const timingSelect = document.getElementById('timingSelect');
            
            // Get selected option
            const selectedOption = addressSelect.options[addressSelect.selectedIndex];
            const timingsData = selectedOption.getAttribute('data-timings');
            
            console.log('Selected Address:', selectedOption.value);
            console.log('Timings Data:', timingsData);
            
            if (timingsData && timingsData !== 'null' && timingsData !== '[]') {
                try {
                    const workingDays = JSON.parse(timingsData);
                    
                    // Clear previous options
                    timingSelect.innerHTML = '<option value="">-- Select your preferred timing --</option>';
                    
                    // Check if working days exist
                    if (Object.keys(workingDays).length > 0) {
                        // Add new options
                        for (const [day, time] of Object.entries(workingDays)) {
                            const openTime = formatTime(time.open);
                            const closeTime = formatTime(time.close);
                            
                            const option = document.createElement('option');
                            option.value = `${day} (${openTime} - ${closeTime})`;
                            option.textContent = `${day} (${openTime} - ${closeTime})`;
                            timingSelect.appendChild(option);
                        }
                        
                        // Show timing section
                        timingSection.style.display = 'block';
                        timingSelect.required = true;
                    } else {
                        // No working days
                        timingSection.style.display = 'none';
                        timingSelect.required = false;
                    }
                } catch (e) {
                    console.error('Error parsing timings:', e);
                    timingSection.style.display = 'none';
                }
            } else {
                // No address selected
                timingSection.style.display = 'none';
                timingSelect.required = false;
                timingSelect.innerHTML = '<option value="">-- First select a location --</option>';
            }
        }
        
        function formatTime(time24) {
            // Convert 24-hour format to 12-hour format
            const [hours, minutes] = time24.split(':');
            let hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            hour = hour % 12 || 12;
            return `${hour}:${minutes} ${ampm}`;
        }
        
        // On page load, restore timing if address was selected
        document.addEventListener('DOMContentLoaded', function() {
            const addressSelect = document.getElementById('addressSelect');
            if (addressSelect.value) {
                updateTimings();
            }
        });
    </script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush