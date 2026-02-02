@extends('layouts.admin')

@section('content')
<div class="content-wrapper pt-70">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3><i class="icon-book-open me-2"></i>Education Management</h3>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}">Doctor Profile</a></li>
                        <li class="breadcrumb-item active">Education</li>
                    </ol>
                </nav>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                <i class="icon-plus me-2"></i> Add Education
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
                            <th>Degree</th>
                            <th>Institution</th>
                            <th width="150">Years</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($educations as $index => $education)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $education->degree_title }}</td>
                            <td>{{ $education->institution }}</td>
                            <td>{{ $education->start_year }} - {{ $education->end_year }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editEducationModal{{ $education->id }}">
                                    <i class="icon-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.banner.deleteEducation', $education) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this education?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="icon-trash-2"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal for each education -->
                        <div class="modal fade" id="editEducationModal{{ $education->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Edit Education</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.banner.updateEducation', $education) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label">Degree Title *</label>
                                                <input type="text" name="degree_title" class="form-control" 
                                                       value="{{ $education->degree_title }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Institution *</label>
                                                <input type="text" name="institution" class="form-control" 
                                                       value="{{ $education->institution }}" required>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Start Year *</label>
                                                    <input type="text" name="start_year" class="form-control" 
                                                           value="{{ $education->start_year }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">End Year *</label>
                                                    <input type="text" name="end_year" class="form-control" 
                                                           value="{{ $education->end_year }}" required>
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
                                <p class="text-muted">No education records found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Education Modal -->
<div class="modal fade" id="addEducationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Education</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.banner.storeEducation') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Degree Title *</label>
                        <input type="text" name="degree_title" class="form-control" 
                               placeholder="e.g., Doctor of Medicine (MD)" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Institution *</label>
                        <input type="text" name="institution" class="form-control" 
                               placeholder="e.g., Harvard Medical School, USA" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Start Year *</label>
                            <input type="text" name="start_year" class="form-control" placeholder="2010" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Year *</label>
                            <input type="text" name="end_year" class="form-control" placeholder="2014" required>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Education</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection