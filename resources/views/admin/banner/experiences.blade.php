@extends('layouts.admin')

@section('content')
<div class="content-wrapper pt-70">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3><i class="icon-briefcase me-2"></i>Experience Management</h3>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}">Doctor Profile</a></li>
                        <li class="breadcrumb-item active">Experience</li>
                    </ol>
                </nav>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                <i class="icon-plus me-2"></i> Add Experience
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>Position</th>
                            <th>Organization</th>
                            <th width="150">Years</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($experiences as $index => $experience)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $experience->position }}</td>
                            <td>{{ $experience->organization }}</td>
                            <td>{{ $experience->start_year }} - {{ $experience->end_year ?? 'Present' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editExperienceModal{{ $experience->id }}">
                                    <i class="icon-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.banner.deleteExperience', $experience) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this experience?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="icon-trash-2"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal for each experience -->
                        <div class="modal fade" id="editExperienceModal{{ $experience->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Edit Experience</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.banner.updateExperience', $experience) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label">Position *</label>
                                                <input type="text" name="position" class="form-control" 
                                                       value="{{ $experience->position }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Organization *</label>
                                                <input type="text" name="organization" class="form-control" 
                                                       value="{{ $experience->organization }}" required>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Start Year *</label>
                                                    <input type="text" name="start_year" class="form-control" 
                                                           value="{{ $experience->start_year }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">End Year</label>
                                                    <input type="text" name="end_year" class="form-control" 
                                                           value="{{ $experience->end_year }}" placeholder="Leave empty for Present">
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <p class="text-muted">No experience records found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Experience Modal -->
<div class="modal fade" id="addExperienceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Experience</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.banner.storeExperience') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Position *</label>
                        <input type="text" name="position" class="form-control" 
                               placeholder="e.g., Chief Cardiologist" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Organization *</label>
                        <input type="text" name="organization" class="form-control" 
                               placeholder="e.g., Cardiac Care Center, Dhaka" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Start Year *</label>
                            <input type="text" name="start_year" class="form-control" placeholder="2018" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Year</label>
                            <input type="text" name="end_year" class="form-control" placeholder="Leave empty for Present">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Experience</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection