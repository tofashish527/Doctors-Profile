@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-cog me-2"></i>Site Settings
        </h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Settings Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                
                <!-- Logo Settings Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-image me-2"></i>Logo
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Site Logo</label>
                            @if($settings->logo)
                            <div class="mb-2 position-relative d-inline-block">
                                <img src="{{ asset('storage/' . $settings->logo) }}" 
                                     alt="Logo" 
                                     class="img-thumbnail"
                                     style="max-height: 120px;">
                                <button type="button" 
                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                        onclick="deleteLogo()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endif
                            <input type="file" 
                                   class="form-control @error('logo') is-invalid @enderror" 
                                   name="logo" 
                                   accept="image/*">
                            <small class="text-muted">Recommended: SVG, PNG (Max: 2MB)</small>
                            @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-address-book me-2"></i>Contact Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Emergency Contact -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-phone-alt me-1"></i>Emergency Phone
                                </label>
                                <input type="text" 
                                       class="form-control @error('emergency_phone') is-invalid @enderror" 
                                       name="emergency_phone" 
                                       value="{{ old('emergency_phone', $settings->emergency_phone) }}"
                                       placeholder="002 010612457410">
                                @error('emergency_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt me-1"></i>Location
                                </label>
                                <input type="text" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       name="location" 
                                       value="{{ old('location', $settings->location) }}"
                                       placeholder="Brooklyn, New York">
                                @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Working Hours -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-clock me-1"></i>Working Hours
                                </label>
                                <input type="text" 
                                       class="form-control @error('working_hours') is-invalid @enderror" 
                                       name="working_hours" 
                                       value="{{ old('working_hours', $settings->working_hours) }}"
                                       placeholder="Mon-Fri: 8am – 7pm">
                                <small class="text-muted">Example: Mon-Fri: 8am – 7pm</small>
                                @error('working_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                
                <!-- Social Media Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-share-alt me-2"></i>Social Media Links
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- Facebook -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fab fa-facebook text-primary me-2"></i>Facebook
                            </label>
                            <input type="url" 
                                   class="form-control @error('facebook_url') is-invalid @enderror" 
                                   name="facebook_url" 
                                   value="{{ old('facebook_url', $settings->facebook_url) }}"
                                   placeholder="https://facebook.com/...">
                            @error('facebook_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Twitter -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fab fa-twitter text-info me-2"></i>Twitter
                            </label>
                            <input type="url" 
                                   class="form-control @error('twitter_url') is-invalid @enderror" 
                                   name="twitter_url" 
                                   value="{{ old('twitter_url', $settings->twitter_url) }}"
                                   placeholder="https://twitter.com/...">
                            @error('twitter_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- LinkedIn -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fab fa-linkedin text-primary me-2"></i>LinkedIn
                            </label>
                            <input type="url" 
                                   class="form-control @error('linkedin_url') is-invalid @enderror" 
                                   name="linkedin_url" 
                                   value="{{ old('linkedin_url', $settings->linkedin_url) }}"
                                   placeholder="https://linkedin.com/...">
                            @error('linkedin_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Instagram -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fab fa-instagram text-danger me-2"></i>Instagram
                            </label>
                            <input type="url" 
                                   class="form-control @error('instagram_url') is-invalid @enderror" 
                                   name="instagram_url" 
                                   value="{{ old('instagram_url', $settings->instagram_url) }}"
                                   placeholder="https://instagram.com/...">
                            @error('instagram_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- YouTube -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fab fa-youtube text-danger me-2"></i>YouTube
                            </label>
                            <input type="url" 
                                   class="form-control @error('youtube_url') is-invalid @enderror" 
                                   name="youtube_url" 
                                   value="{{ old('youtube_url', $settings->youtube_url) }}"
                                   placeholder="https://youtube.com/...">
                            @error('youtube_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card shadow">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-save me-2"></i>Save Settings
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Delete Logo Function
function deleteLogo() {
    if (!confirm('Are you sure you want to delete this logo?')) {
        return;
    }
    
    fetch('{{ route("admin.settings.delete-logo") }}', {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        alert('Error deleting logo');
        console.error(error);
    });
}
</script>
@endpush
@endsection