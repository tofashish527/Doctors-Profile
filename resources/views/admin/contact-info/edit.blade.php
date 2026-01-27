@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h1><i class="icon-edit me-2"></i>Edit Contact Info</h1>
    </div>

    <div class="card" style="border-radius: 10px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                        color: white; 
                                        border-radius: 10px 10px 0 0; 
                                        padding: 15px 25px;">
            <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">
                <i class="icon-map-pin me-2"></i>Edit Contact Information
            </h5>
        </div>
        <div class="card-body" style="padding: 25px;">
            <form action="{{ route('admin.contact-info.update', $contactInfo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #495057; margin-bottom: 8px;">
                                Address <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="address" 
                                   class="form-control @error('address') is-invalid @enderror" 
                                   style="border: 1px solid #ced4da; border-radius: 6px; padding: 10px 15px;"
                                   value="{{ old('address', $contactInfo->address) }}" 
                                   placeholder="Enter full address" 
                                   required>
                            @error('address')
                                <div class="invalid-feedback" style="display: block; font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #495057; margin-bottom: 8px;">
                                Phone Number <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="phone_number" 
                                   class="form-control @error('phone_number') is-invalid @enderror" 
                                   style="border: 1px solid #ced4da; border-radius: 6px; padding: 10px 15px;"
                                   value="{{ old('phone_number', $contactInfo->phone_number) }}" 
                                   placeholder="Enter phone number" 
                                   required>
                            @error('phone_number')
                                <div class="invalid-feedback" style="display: block; font-size: 13px;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" style="color: #495057; margin-bottom: 12px;">
                        Working Days & Hours <span class="text-danger">*</span>
                    </label>
                    <div class="card" style="border: 1px solid #e9ecef; border-radius: 8px;">
                        <div class="card-body" style="padding: 20px;">
                            @foreach($weekDays as $day)
                            @php
                                $isChecked = isset($contactInfo->working_days[$day]);
                                $openTime = $isChecked ? $contactInfo->working_days[$day]['open'] : '';
                                $closeTime = $isChecked ? $contactInfo->working_days[$day]['close'] : '';
                            @endphp
                            <div class="row mb-3 align-items-center" style="padding: 10px 0; border-bottom: 1px solid #f8f9fa;">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input day-checkbox" 
                                               type="checkbox" 
                                               name="working_days[{{ $day }}][enabled]" 
                                               id="day_{{ $day }}"
                                               {{ $isChecked ? 'checked' : '' }}
                                               onchange="toggleTimeInputs('{{ $day }}')"
                                               style="width: 16px; height: 16px; margin-top: 2px;">
                                        <label class="form-check-label fw-semibold" 
                                               for="day_{{ $day }}"
                                               style="color: #495057; font-size: 14px; margin-left: 5px;">
                                            {{ ucfirst($day) }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="time" 
                                           name="working_days[{{ $day }}][open]" 
                                           class="form-control time-input" 
                                           id="open_{{ $day }}"
                                           value="{{ $openTime }}"
                                           style="border: 1px solid #ced4da; border-radius: 6px; padding: 8px 12px; font-size: 14px;"
                                           {{ !$isChecked ? 'disabled' : '' }}>
                                </div>
                                <div class="col-md-1 text-center">
                                    <span style="color: #6c757d; font-size: 14px;">to</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="time" 
                                           name="working_days[{{ $day }}][close]" 
                                           class="form-control time-input" 
                                           id="close_{{ $day }}"
                                           value="{{ $closeTime }}"
                                           style="border: 1px solid #ced4da; border-radius: 6px; padding: 8px 12px; font-size: 14px;"
                                           {{ !$isChecked ? 'disabled' : '' }}>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @error('working_days')
                        <div class="text-danger small mt-2" style="font-size: 13px;">
                            <i class="icon-alert-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input me-3" 
                               type="checkbox" 
                               name="is_active" 
                               id="is_active" 
                               {{ $contactInfo->is_active ? 'checked' : '' }}
                               style="width: 16px; height: 16px; margin-top: 2px;">
                        <label class="form-check-label fw-semibold" 
                               for="is_active"
                               style="color: #495057; font-size: 14px;">
                            Active
                        </label>
                    </div>
                    <div class="text-muted small mt-2" style="margin-left: 35px; font-size: 12px;">
                        <i class="icon-info me-1"></i> When checked, this contact information will be visible on the website
                    </div>
                </div>

                <div class="d-flex gap-3" style="padding-top: 20px; border-top: 1px solid #eee;">
                    <button type="submit" 
                            class="btn btn-primary d-flex align-items-center"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                   border: none; 
                                   border-radius: 6px; 
                                   padding: 10px 20px; 
                                   font-size: 14px; 
                                   font-weight: 500;
                                   transition: all 0.3s;">
                        <i class="icon-save me-2" style="font-size: 16px;"></i>
                        Update Contact Info
                    </button>
                    <a href="{{ route('admin.contact-info.index') }}" 
                       class="btn btn-secondary d-flex align-items-center"
                       style="border: 1px solid #ddd; 
                              border-radius: 6px; 
                              padding: 10px 20px; 
                              font-size: 14px; 
                              font-weight: 500;
                              color: #666;
                              background: #fff;
                              transition: all 0.3s;">
                        <i class="icon-x me-2" style="font-size: 16px;"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleTimeInputs(day) {
    const checkbox = document.getElementById('day_' + day);
    const openInput = document.getElementById('open_' + day);
    const closeInput = document.getElementById('close_' + day);
    
    if (checkbox.checked) {
        openInput.disabled = false;
        closeInput.disabled = false;
        openInput.required = true;
        closeInput.required = true;
        openInput.style.backgroundColor = '#fff';
        closeInput.style.backgroundColor = '#fff';
        openInput.style.borderColor = '#ced4da';
        closeInput.style.borderColor = '#ced4da';
    } else {
        openInput.disabled = true;
        closeInput.disabled = true;
        openInput.required = false;
        closeInput.required = false;
        openInput.value = '';
        closeInput.value = '';
        openInput.style.backgroundColor = '#f8f9fa';
        closeInput.style.backgroundColor = '#f8f9fa';
        openInput.style.borderColor = '#e9ecef';
        closeInput.style.borderColor = '#e9ecef';
    }
}

// Initialize time inputs based on checkbox state
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all day checkboxes
    @foreach($weekDays as $day)
    @php
        $isChecked = isset($contactInfo->working_days[$day]);
    @endphp
    const day{{ $day }}Checkbox = document.getElementById('day_{{ $day }}');
    if (day{{ $day }}Checkbox) {
        // Set initial state
        if (day{{ $day }}Checkbox.checked) {
            document.getElementById('open_{{ $day }}').style.backgroundColor = '#fff';
            document.getElementById('close_{{ $day }}').style.backgroundColor = '#fff';
        } else {
            document.getElementById('open_{{ $day }}').style.backgroundColor = '#f8f9fa';
            document.getElementById('close_{{ $day }}').style.backgroundColor = '#f8f9fa';
        }
    }
    @endforeach
    
    // Add hover effects to buttons
    const submitBtn = document.querySelector('button[type="submit"]');
    const cancelBtn = document.querySelector('a.btn-secondary');
    
    if (submitBtn) {
        submitBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 12px rgba(102, 126, 234, 0.4)';
        });
        
        submitBtn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    }
    
    if (cancelBtn) {
        cancelBtn.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
            this.style.borderColor = '#ccc';
        });
        
        cancelBtn.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '#fff';
            this.style.borderColor = '#ddd';
        });
    }
    
    // Add card hover effect
    const card = document.querySelector('.card');
    if (card) {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.1)';
            this.style.transform = 'translateY(-5px)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
            this.style.transform = 'translateY(0)';
        });
    }
});
</script>

<style>
/* Additional styling for better appearance */
.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.card {
    transition: all 0.3s ease;
}

.time-input:disabled {
    background-color: #f8f9fa;
    cursor: not-allowed;
    color: #6c757d;
}

.time-input:not(:disabled):focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Form validation styles */
.is-invalid {
    border-color: #dc3545;
}

.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .content-wrapper {
        padding: 15px;
    }
    
    .card-body {
        padding: 15px;
    }
    
    .row.mb-3 {
        margin-bottom: 15px !important;
    }
    
    .col-md-3, .col-md-4 {
        margin-bottom: 10px;
    }
    
    .col-md-1.text-center {
        margin: 10px 0;
    }
    
    .d-flex.gap-3 {
        flex-direction: column;
        gap: 10px !important;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

/* Animation for form elements */
.form-control, .form-check-input {
    transition: all 0.3s ease;
}

/* Breadcrumb styling */
.breadcrumb {
    padding: 0;
    margin-bottom: 20px;
    background: none;
    font-size: 14px;
}

.breadcrumb-item a {
    color: #667eea;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #6c757d;
}

/* Time input styling */
input[type="time"] {
    font-family: monospace;
}

/* Card header icon */
.card-header i {
    font-size: 18px;
    vertical-align: middle;
}
</style>
@endsection