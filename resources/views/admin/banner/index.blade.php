@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h1><i class="icon-user me-2"></i>Doctor Profile Settings</h1>
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Doctor Profile</li>
            </ol>
        </nav>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" 
             style="border-radius: 8px; border: none; background: linear-gradient(135deg, #4CAF50, #45a049); color: white;">
            <i class="icon-check-circle me-2" style="font-size: 18px;"></i>
            <div class="flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" 
             style="border-radius: 8px; border: none; background: linear-gradient(135deg, #f44336, #d32f2f); color: white;">
            <i class="icon-alert-circle me-2" style="font-size: 18px;"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2" style="padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Grid Layout -->
    <div class="row">
        <!-- Left Column - Personal Info & Media -->
        <div class="col-lg-8">
            <!-- Basic Information Card -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div class="card-header" style="background: linear-gradient(135deg, #2c3e50, #34495e); 
                                              color: white; 
                                              border-radius: 12px 12px 0 0; 
                                              padding: 20px 25px;">
                    <div class="d-flex align-items-center">
                        <i class="icon-user me-3" style="font-size: 22px;"></i>
                        <div>
                            <h5 class="mb-0" style="font-size: 17px; font-weight: 600;">Basic Information</h5>
                            <small class="opacity-75">Personal details and professional information</small>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 25px;">
                    <form action="{{ route('admin.banner.update') }}" method="POST" id="basicInfoForm">
                        @csrf
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #2c3e50; margin-bottom: 8px; font-size: 14px;">
                                    <i class="icon-user me-1"></i> Doctor Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="doctor_name" class="form-control" 
                                       style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 14px;"
                                       value="{{ old('doctor_name', $banner->doctor_name) }}" 
                                       placeholder="Dr. Md. Ahsan Rahman" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="color: #2c3e50; margin-bottom: 8px; font-size: 14px;">
                                    <i class="icon-award me-1"></i> Degree <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="doctor_degree" class="form-control" 
                                       style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 14px;"
                                       value="{{ old('doctor_degree', $banner->doctor_degree) }}" 
                                       placeholder="MBBS, FCPS (Cardiology)" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #2c3e50; margin-bottom: 8px; font-size: 14px;">
                                <i class="icon-briefcase me-1"></i> Specialization <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="specialization" class="form-control" 
                                   style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 14px;"
                                   value="{{ old('specialization', $banner->specialization) }}" 
                                   placeholder="Consultant Cardiologist" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #2c3e50; margin-bottom: 8px; font-size: 14px;">
                                <i class="icon-file-text me-1"></i> Short Bio (for Banner) <span class="text-danger">*</span>
                            </label>
                            <textarea name="bio" rows="3" class="form-control" 
                                      style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 14px;"
                                      placeholder="1-2 lines for homepage banner..." 
                                      required>{{ old('bio', $banner->bio) }}</textarea>
                            <div class="text-muted mt-1" style="font-size: 12px;">
                                <i class="icon-info me-1"></i> Maximum 500 characters. This will show on the homepage banner.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #2c3e50; margin-bottom: 8px; font-size: 14px;">
                                <i class="icon-file me-1"></i> Full Professional Biography
                            </label>
                            <textarea name="biography" rows="8" class="form-control" 
                                      style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px; font-size: 14px;"
                                      placeholder="Write detailed professional biography here...">{{ old('biography', $banner->biography) }}</textarea>
                            <div class="text-muted mt-1" style="font-size: 12px;">
                                <i class="icon-info me-1"></i> Multiple paragraphs supported. Use line breaks for new paragraphs.
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" name="video_enabled" 
                                       id="videoEnabled" style="width: 50px; height: 26px; cursor: pointer;"
                                       {{ $banner->video_enabled ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="videoEnabled" style="color: #2c3e50; cursor: pointer;">
                                    <i class="icon-video me-1"></i> Enable Introduction Video Display
                                </label>
                            </div>
                        </div>

                        <div class="text-end pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4" 
                                    style="background: linear-gradient(135deg, #3498db, #2980b9); border: none; border-radius: 8px; padding: 10px 25px; font-weight: 500;">
                                <i class="icon-save me-2"></i> Save Basic Information
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Expertise & Details Section -->
            <div class="row">
                <!-- Expertise Card -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div class="card-header" style="background: linear-gradient(135deg, #27ae60, #229954); 
                                                      color: white; 
                                                      border-radius: 12px 12px 0 0; 
                                                      padding: 18px 20px;">
                            <div class="d-flex align-items-center">
                                <i class="icon-award me-2" style="font-size: 20px;"></i>
                                <div>
                                    <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Areas of Expertise</h5>
                                    <small class="opacity-75">Max 10 specializations</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 20px;">
    <form action="{{ route('admin.banner.updateExpertise') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color: #2c3e50; margin-bottom: 8px; font-size: 14px;">
                Add New Expertise
            </label>
            <div class="input-group">
                <input type="text" id="expertiseInput" class="form-control" 
                       style="border: 1px solid #e0e0e0; border-radius: 8px 0 0 8px; padding: 10px 15px; font-size: 14px;"
                       placeholder="e.g., Cardiac Imaging">
                <button type="button" class="btn btn-success" onclick="addExpertise()" 
                        style="border: none; border-radius: 0 8px 8px 0; padding: 10px 20px;">
                    <i class="icon-plus me-1"></i> Add
                </button>
            </div>
        </div>

        <div id="expertiseList" class="mb-3" style="max-height: 200px; overflow-y: auto;">
            @if($banner->expertise && is_array($banner->expertise) && count($banner->expertise) > 0)
                @foreach($banner->expertise as $index => $item)
                <div class="expertise-item alert alert-light d-flex justify-content-between align-items-center mb-2"
                     style="border: 1px solid #e8f5e9; background-color: #f1f8e9; border-radius: 8px; padding: 10px 15px;">
                    <span><i class="icon-check-circle text-success me-2"></i> {{ $item }}</span>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeExpertise({{ $index }})"
                            style="border: none; padding: 2px 8px; border-radius: 4px;">
                        <i class="icon-trash-2" style="font-size: 14px;"></i>
                    </button>
                </div>
                @endforeach
            @else
                <div class="text-center py-3">
                    <i class="icon-info text-muted mb-2" style="font-size: 24px;"></i>
                    <p class="text-muted mb-0" style="font-size: 14px;">No expertise added yet</p>
                </div>
            @endif
        </div>

        <input type="hidden" name="expertise" id="expertiseData" value='{{ json_encode($banner->expertise ?? []) }}'>
        
        <div class="text-end">
            <button type="submit" class="btn btn-success px-3" 
                    style="background: linear-gradient(135deg, #27ae60, #229954); border: none; border-radius: 8px; padding: 8px 20px; font-weight: 500;">
                <i class="icon-save me-1"></i> Save Expertise
            </button>
        </div>
    </form>
</div>
                    </div>
                </div>

                <!-- Video Toggle Card - Display Only -->
<div class="col-md-6 mb-4">
    <div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <div class="card-header" style="background: linear-gradient(135deg, #9b59b6, #8e44ad); 
                                      color: white; 
                                      border-radius: 12px 12px 0 0; 
                                      padding: 18px 20px;">
            <div class="d-flex align-items-center">
                <i class="icon-settings me-2" style="font-size: 20px;"></i>
                <div>
                    <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Video Settings</h5>
                    <small class="opacity-75">Introduction video control</small>
                </div>
            </div>
        </div>
        <div class="card-body" style="padding: 20px;">
            <div class="text-center">
                <div class="mb-3">
                    <i class="icon-video" style="font-size: 48px; color: #9b59b6;"></i>
                </div>
                <h6 class="fw-semibold mb-3" style="color: #2c3e50;">Video Display Status</h6>
                <p class="text-muted mb-4" style="font-size: 14px; line-height: 1.5;">
                    The video display is currently <strong>{{ $banner->video_enabled ? 'Enabled' : 'Disabled' }}</strong>.
                    You can toggle this setting in the Basic Information section above.
                </p>
                
                <div class="alert {{ $banner->video_enabled ? 'alert-success' : 'alert-secondary' }} mb-0"
                     style="border-radius: 8px; padding: 12px;">
                    <i class="icon-{{ $banner->video_enabled ? 'check-circle' : 'x-circle' }} me-2"></i>
                    <strong>{{ $banner->video_enabled ? 'Video Enabled' : 'Video Disabled' }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>

            <!-- Education & Experience Row -->
            <div class="row">
                <!-- Education Card -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div class="card-header" style="background: linear-gradient(135deg, #3498db, #2980b9); 
                                                      color: white; 
                                                      border-radius: 12px 12px 0 0; 
                                                      padding: 18px 20px;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="icon-book-open me-2" style="font-size: 20px;"></i>
                                    <div>
                                        <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Education</h5>
                                        <small class="opacity-75">Academic background</small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addEducationModal"
                                        style="border: none; border-radius: 6px; padding: 5px 15px; font-size: 13px;">
                                    <i class="icon-plus me-1"></i> Add New
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        @forelse($banner->educations as $education)
                                        <tr style="border-bottom: 1px solid #f1f1f1;">
                                            <td style="padding: 12px 0;">
                                                <div class="d-flex">
                                                    <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #3498db, #2980b9); 
                                                                            border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="icon-graduation-cap text-white" style="font-size: 18px;"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1" style="font-size: 14px; font-weight: 600; color: #2c3e50;">
                                                            {{ $education->degree_title }}
                                                        </h6>
                                                        <p class="mb-1" style="font-size: 13px; color: #666;">
                                                            {{ $education->institution }}
                                                        </p>
                                                        <small class="text-muted" style="font-size: 12px;">
                                                            {{ $education->start_year }} - {{ $education->end_year }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end" style="padding: 12px 0; width: 80px;">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-warning" 
                                                            onclick="editEducation({{ $education->id }}, '{{ addslashes($education->degree_title) }}', '{{ addslashes($education->institution) }}', '{{ $education->start_year }}', '{{ $education->end_year }}')"
                                                            style="border: 1px solid #f39c12; color: #f39c12; padding: 4px 10px; border-radius: 4px;">
                                                        <i class="icon-edit" style="font-size: 12px;"></i>
                                                    </button>
                                                    <form action="{{ route('admin.banner.deleteEducation', $education) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Delete this education?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger ms-1"
                                                                style="border: 1px solid #e74c3c; color: #e74c3c; padding: 4px 10px; border-radius: 4px;">
                                                            <i class="icon-trash-2" style="font-size: 12px;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4">
                                                <i class="icon-book-open text-muted mb-2" style="font-size: 32px;"></i>
                                                <p class="text-muted mb-0" style="font-size: 14px;">No education added yet</p>
                                                <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addEducationModal"
                                                        style="background: linear-gradient(135deg, #3498db, #2980b9); border: none; border-radius: 6px; padding: 6px 15px; font-size: 13px;">
                                                    <i class="icon-plus me-1"></i> Add Education
                                                </button>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Experience Card -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div class="card-header" style="background: linear-gradient(135deg, #e67e22, #d35400); 
                                                      color: white; 
                                                      border-radius: 12px 12px 0 0; 
                                                      padding: 18px 20px;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="icon-briefcase me-2" style="font-size: 20px;"></i>
                                    <div>
                                        <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Experience</h5>
                                        <small class="opacity-75">Professional career</small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addExperienceModal"
                                        style="border: none; border-radius: 6px; padding: 5px 15px; font-size: 13px;">
                                    <i class="icon-plus me-1"></i> Add New
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        @forelse($banner->experiences as $experience)
                                        <tr style="border-bottom: 1px solid #f1f1f1;">
                                            <td style="padding: 12px 0;">
                                                <div class="d-flex">
                                                    <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #e67e22, #d35400); 
                                                                            border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="icon-briefcase text-white" style="font-size: 18px;"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1" style="font-size: 14px; font-weight: 600; color: #2c3e50;">
                                                            {{ $experience->position }}
                                                        </h6>
                                                        <p class="mb-1" style="font-size: 13px; color: #666;">
                                                            {{ $experience->organization }}
                                                        </p>
                                                        <small class="text-muted" style="font-size: 12px;">
                                                            {{ $experience->start_year }} - {{ $experience->end_year ?? 'Present' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end" style="padding: 12px 0; width: 80px;">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-warning" 
                                                            onclick="editExperience({{ $experience->id }}, '{{ addslashes($experience->position) }}', '{{ addslashes($experience->organization) }}', '{{ $experience->start_year }}', '{{ $experience->end_year ?? '' }}')"
                                                            style="border: 1px solid #f39c12; color: #f39c12; padding: 4px 10px; border-radius: 4px;">
                                                        <i class="icon-edit" style="font-size: 12px;"></i>
                                                    </button>
                                                    <form action="{{ route('admin.banner.deleteExperience', $experience) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Delete this experience?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger ms-1"
                                                                style="border: 1px solid #e74c3c; color: #e74c3c; padding: 4px 10px; border-radius: 4px;">
                                                            <i class="icon-trash-2" style="font-size: 12px;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4">
                                                <i class="icon-briefcase text-muted mb-2" style="font-size: 32px;"></i>
                                                <p class="text-muted mb-0" style="font-size: 14px;">No experience added yet</p>
                                                <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addExperienceModal"
                                                        style="background: linear-gradient(135deg, #e67e22, #d35400); border: none; border-radius: 6px; padding: 6px 15px; font-size: 13px;">
                                                    <i class="icon-plus me-1"></i> Add Experience
                                                </button>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Media Uploads -->
        <div class="col-lg-4">
            <!-- Profile Photo Card -->
            <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div class="card-header" style="background: linear-gradient(135deg, #1abc9c, #16a085); 
                                              color: white; 
                                              border-radius: 12px 12px 0 0; 
                                              padding: 20px 25px;">
                    <div class="d-flex align-items-center">
                        <i class="icon-camera me-3" style="font-size: 22px;"></i>
                        <div>
                            <h5 class="mb-0" style="font-size: 17px; font-weight: 600;">Profile Photo</h5>
                            <small class="opacity-75">Professional doctor image</small>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 25px;">
                    <div class="text-center mb-4">
                        @php
                            $imageUrl = $banner->doctor_image ? asset('storage/' . $banner->doctor_image) : 'https://via.placeholder.com/300x400.png?text=No+Image';
                        @endphp
                        <div class="position-relative d-inline-block">
                            <img src="{{ $imageUrl }}" 
                                 class="img-fluid rounded" 
                                 style="width: 100%; max-width: 280px; height: 300px; object-fit: cover; border: 3px solid #e0e0e0;"
                                 id="doctorImagePreview"
                                 onerror="this.src='https://via.placeholder.com/300x400.png?text=Image+Not+Found'">
                            <div class="position-absolute bottom-0 end-0 m-2">
                                <span class="badge" style="background: linear-gradient(135deg, #1abc9c, #16a085); font-size: 11px;">
                                    Current Photo
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.banner.uploadImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #2c3e50; margin-bottom: 8px; font-size: 14px;">
                                <i class="icon-upload me-1"></i> Upload New Photo
                            </label>
                            <input type="file" name="doctor_image" class="form-control" 
                                   style="border: 2px dashed #1abc9c; border-radius: 8px; padding: 12px; font-size: 14px; background-color: #f8f9fa;"
                                   accept="image/jpeg,image/jpg,image/png" required
                                   onchange="previewImage(event)">
                            <div class="text-muted mt-2" style="font-size: 12px;">
                                <i class="icon-info me-1"></i> 
                                Supported formats: JPG, JPEG, PNG | Max size: 2MB<br>
                                Recommended: Professional photo with white coat or clinic background
                            </div>
                        </div>
                        <button type="submit" class="btn w-100" 
                                style="background: linear-gradient(135deg, #1abc9c, #16a085); border: none; border-radius: 8px; padding: 12px; font-weight: 500; color: white;">
                            <i class="icon-upload me-2"></i> Upload Photo
                        </button>
                    </form>
                </div>
            </div>

            <!-- Introduction Video Card -->
            <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div class="card-header" style="background: linear-gradient(135deg, #9b59b6, #8e44ad); 
                                              color: white; 
                                              border-radius: 12px 12px 0 0; 
                                              padding: 20px 25px;">
                    <div class="d-flex align-items-center">
                        <i class="icon-video me-3" style="font-size: 22px;"></i>
                        <div>
                            <h5 class="mb-0" style="font-size: 17px; font-weight: 600;">Introduction Video</h5>
                            <small class="opacity-75">Doctor's introduction video</small>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 25px;">
                    @if($banner->intro_video)
                        <div class="mb-4">
                            <div class="position-relative" style="border-radius: 10px; overflow: hidden; background: #000; min-height: 180px;">
                                <video controls 
                                       style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px;">
                                    <source src="{{ asset('storage/' . $banner->intro_video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge" style="background: rgba(0,0,0,0.7); font-size: 11px;">
                                        Current Video
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-warning mb-4" 
                             style="border-radius: 8px; border: none; background: #fff3cd; color: #856404; padding: 12px;">
                            <div class="d-flex align-items-start">
                                <i class="icon-alert-triangle me-2" style="font-size: 16px; margin-top: 2px;"></i>
                                <div style="font-size: 13px;">
                                    <strong>Note:</strong> Uploading a new video will replace the current one.
                                </div>
                            </div>
                        </div>
                        
                        <form action="{{ route('admin.banner.deleteVideo') }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this video?')"
                              class="mb-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100"
                                    style="border: 1px solid #e74c3c; color: #e74c3c; border-radius: 8px; padding: 10px; font-weight: 500;">
                                <i class="icon-trash-2 me-2"></i> Delete Current Video
                            </button>
                        </form>
                    @else
                        <div class="text-center mb-4">
                            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #f1f1f1, #e1e1e1); 
                                       border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <i class="icon-video" style="font-size: 40px; color: #9b59b6;"></i>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 14px;">No video uploaded yet</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.banner.uploadVideo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: #2c3e50; margin-bottom: 8px; font-size: 14px;">
                                <i class="icon-upload me-1"></i> Upload New Video
                            </label>
                            <input type="file" name="intro_video" class="form-control" 
                                   style="border: 2px dashed #9b59b6; border-radius: 8px; padding: 12px; font-size: 14px; background-color: #f8f9fa;"
                                   accept="video/mp4,video/mpeg,video/quicktime,video/x-msvideo" {{ !$banner->intro_video ? 'required' : '' }}>
                            <div class="text-muted mt-2" style="font-size: 12px;">
                                <i class="icon-info me-1"></i> 
                                Supported formats: MP4, MPEG, AVI, MOV | Max size: 100MB<br>
                                Keep video duration under 3-5 minutes for best user experience
                            </div>
                        </div>
                        <button type="submit" class="btn w-100" 
                                style="background: linear-gradient(135deg, #9b59b6, #8e44ad); border: none; border-radius: 8px; padding: 12px; font-weight: 500; color: white;">
                            <i class="icon-upload me-2"></i> {{ $banner->intro_video ? 'Replace Video' : 'Upload Video' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Education Modal -->
<div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 12px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #3498db, #2980b9); 
                                          color: white; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title" id="addEducationModalLabel" style="font-weight: 600;">
                    <i class="icon-book-open me-2"></i> Add Education
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <form action="{{ route('admin.banner.storeEducation') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Degree Title <span class="text-danger">*</span></label>
                        <input type="text" name="degree_title" class="form-control" 
                               style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px;"
                               placeholder="e.g., Doctor of Medicine (MD)" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Institution <span class="text-danger">*</span></label>
                        <input type="text" name="institution" class="form-control" 
                               style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px;"
                               placeholder="e.g., Harvard Medical School, USA" required>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Start Year <span class="text-danger">*</span></label>
                            <input type="text" name="start_year" class="form-control" 
                                   style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px;"
                                   placeholder="2010" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">End Year <span class="text-danger">*</span></label>
                            <input type="text" name="end_year" class="form-control" 
                                   style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px;"
                                   placeholder="2014" required>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal"
                                style="border: 1px solid #ddd; border-radius: 8px; padding: 8px 20px;">Cancel</button>
                        <button type="submit" class="btn btn-primary"
                                style="background: linear-gradient(135deg, #3498db, #2980b9); border: none; border-radius: 8px; padding: 8px 25px;">
                            <i class="icon-plus me-1"></i> Add Education
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Experience Modal -->
<div class="modal fade" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 12px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #e67e22, #d35400); 
                                          color: white; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title" id="addExperienceModalLabel" style="font-weight: 600;">
                    <i class="icon-briefcase me-2"></i> Add Experience
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <form action="{{ route('admin.banner.storeExperience') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Position <span class="text-danger">*</span></label>
                        <input type="text" name="position" class="form-control" 
                               style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px;"
                               placeholder="e.g., Chief Cardiologist" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Organization <span class="text-danger">*</span></label>
                        <input type="text" name="organization" class="form-control" 
                               style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px;"
                               placeholder="e.g., Cardiac Care Center, Dhaka" required>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Start Year <span class="text-danger">*</span></label>
                            <input type="text" name="start_year" class="form-control" 
                                   style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px;"
                                   placeholder="2018" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">End Year (leave empty for "Present")</label>
                            <input type="text" name="end_year" class="form-control" 
                                   style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px 15px;"
                                   placeholder="Leave empty for Present">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal"
                                style="border: 1px solid #ddd; border-radius: 8px; padding: 8px 20px;">Cancel</button>
                        <button type="submit" class="btn btn-primary"
                                style="background: linear-gradient(135deg, #e67e22, #d35400); border: none; border-radius: 8px; padding: 8px 25px;">
                            <i class="icon-plus me-1"></i> Add Experience
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Functions (Keep Original Functions) -->
<script>
// Expertise Management
let expertiseArray = {!! json_encode($banner->expertise ?? []) !!};

function addExpertise() {
    const input = document.getElementById('expertiseInput');
    const value = input.value.trim();
    
    if (!value) {
        alert('Please enter an expertise area');
        return;
    }
    
    if (expertiseArray.length >= 10) {
        alert('Maximum 10 expertise areas allowed');
        return;
    }
    
    expertiseArray.push(value);
    updateExpertiseDisplay();
    input.value = '';
}

function removeExpertise(index) {
    expertiseArray.splice(index, 1);
    updateExpertiseDisplay();
}

function updateExpertiseDisplay() {
    const listDiv = document.getElementById('expertiseList');
    const dataInput = document.getElementById('expertiseData');
    
    if (expertiseArray.length === 0) {
        listDiv.innerHTML = `
            <div class="text-center py-3">
                <i class="icon-info text-muted mb-2" style="font-size: 24px;"></i>
                <p class="text-muted mb-0" style="font-size: 14px;">No expertise added yet</p>
            </div>
        `;
    } else {
        let html = '';
        expertiseArray.forEach((item, index) => {
            html += `
                <div class="expertise-item alert alert-light d-flex justify-content-between align-items-center mb-2"
                     style="border: 1px solid #e8f5e9; background-color: #f1f8e9; border-radius: 8px; padding: 10px 15px;">
                    <span><i class="icon-check-circle text-success me-2"></i> ${item}</span>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeExpertise(${index})"
                            style="border: none; padding: 2px 8px; border-radius: 4px;">
                        <i class="icon-trash-2" style="font-size: 14px;"></i>
                    </button>
                </div>
            `;
        });
        listDiv.innerHTML = html;
    }
    
    dataInput.value = JSON.stringify(expertiseArray);
}

// Image Preview
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('doctorImagePreview');
        preview.src = reader.result;
        preview.style.border = '3px solid #1abc9c';
        preview.style.transition = 'all 0.3s ease';
    }
    reader.readAsDataURL(event.target.files[0]);
}

// Edit Education
function editEducation(id, degree, institution, start, end) {
    const newDegree = prompt('Degree Title:', degree);
    if (!newDegree) return;
    
    const newInstitution = prompt('Institution:', institution);
    if (!newInstitution) return;
    
    const newStart = prompt('Start Year:', start);
    if (!newStart) return;
    
    const newEnd = prompt('End Year:', end);
    if (!newEnd) return;
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/doctor-profile/education/' + id;
    
    const csrfToken = '{{ csrf_token() }}';
    
    form.innerHTML = `
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="degree_title" value="${newDegree}">
        <input type="hidden" name="institution" value="${newInstitution}">
        <input type="hidden" name="start_year" value="${newStart}">
        <input type="hidden" name="end_year" value="${newEnd}">
    `;
    
    document.body.appendChild(form);
    form.submit();
}

// Edit Experience
function editExperience(id, position, organization, start, end) {
    const newPosition = prompt('Position:', position);
    if (!newPosition) return;
    
    const newOrganization = prompt('Organization:', organization);
    if (!newOrganization) return;
    
    const newStart = prompt('Start Year:', start);
    if (!newStart) return;
    
    const newEnd = prompt('End Year (leave empty for Present):', end || '');
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/doctor-profile/experience/' + id;
    
    const csrfToken = '{{ csrf_token() }}';
    
    form.innerHTML = `
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="position" value="${newPosition}">
        <input type="hidden" name="organization" value="${newOrganization}">
        <input type="hidden" name="start_year" value="${newStart}">
        <input type="hidden" name="end_year" value="${newEnd}">
    `;
    
    document.body.appendChild(form);
    form.submit();
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.12)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 20px rgba(0,0,0,0.08)';
        });
    });
});
</script>

<style>
/* Global Styles */
.form-control:focus, .form-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    outline: none;
}

.form-check-input:checked {
    background-color: #3498db;
    border-color: #3498db;
}

.form-switch .form-check-input {
    cursor: pointer;
    background-color: #e9ecef;
    border-color: #adb5bd;
}

.form-switch .form-check-input:checked {
    background-color: #3498db;
    border-color: #3498db;
}

/* Badge Styles */
.badge {
    padding: 4px 8px;
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Alert Styles */
.alert {
    border: none;
    border-radius: 8px;
    padding: 12px 16px;
}

/* Button Hover Effects */
.btn-primary:hover, .btn-success:hover, .btn-warning:hover, .btn-info:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .content-wrapper {
        padding: 15px;
    }
    
    .card-body {
        padding: 20px !important;
    }
    
    .modal-dialog {
        margin: 10px;
    }
    
    .row.g-3 {
        margin-left: -8px;
        margin-right: -8px;
    }
    
    .row.g-3 > [class*="col-"] {
        padding-left: 8px;
        padding-right: 8px;
    }
}

/* Table Styles */
.table-hover tbody tr:hover {
    background-color: rgba(52, 152, 219, 0.05);
}

.table td, .table th {
    vertical-align: middle;
}

/* Custom Scrollbar for Expertise List */
#expertiseList::-webkit-scrollbar {
    width: 6px;
}

#expertiseList::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

#expertiseList::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

#expertiseList::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}

/* Modal Styles */
.modal-content {
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

.modal-header {
    border-bottom: none;
    padding: 20px 25px;
}

.modal-body {
    padding: 25px;
}

.btn-close-white {
    filter: invert(1) grayscale(100%) brightness(200%);
}

/* Input File Custom Style */
input[type="file"]::file-selector-button {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    margin-right: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

input[type="file"]::file-selector-button:hover {
    background: linear-gradient(135deg, #2980b9, #21618c);
}

/* Expertise Items */
.expertise-item {
    transition: all 0.3s ease;
}

.expertise-item:hover {
    background-color: #e8f5e9 !important;
    transform: translateX(5px);
}

/* Video Container */
.video-container {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
}

.video-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.3));
    z-index: 1;
    border-radius: 10px;
}

.video-container video {
    position: relative;
    z-index: 0;
}

/* Status Indicators */
.status-indicator {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 8px;
}

.status-active {
    background-color: #2ecc71;
}

.status-inactive {
    background-color: #e74c3c;
}
</style>
@endsection