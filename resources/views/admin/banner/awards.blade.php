@extends('layouts.admin')

@section('content')
<div class="content-wrapper pt-70">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3><i class="icon-award me-2"></i>Awards & Recognition Management</h3>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}">Doctor Profile</a></li>
                        <li class="breadcrumb-item active">Awards</li>
                    </ol>
                </nav>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAwardModal">
                <i class="icon-plus me-2"></i> Add Award
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
                            <th width="60">Rank</th>
                            <th width="80">Icon</th>
                            <th>Award Title</th>
                            <th>Organization</th>
                            <th width="100">Year</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($awards as $award)
                        <tr>
                            <td>
                                <span class="badge bg-primary">{{ $award->rank }}</span>
                            </td>
                            <td>
                                <i class="{{ $award->icon }}" style="font-size: 24px; color: #f39c12;"></i>
                            </td>
                            <td>{{ $award->title }}</td>
                            <td>{{ $award->organization }}</td>
                            <td>{{ $award->year }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editAwardModal{{ $award->id }}">
                                    <i class="icon-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.banner.deleteAward', $award) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this award?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="icon-trash-2"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal for each award -->
                        <div class="modal fade" id="editAwardModal{{ $award->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Edit Award</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.banner.updateAward', $award) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label">Award Title *</label>
                                                <input type="text" name="title" class="form-control" 
                                                       value="{{ $award->title }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Organization *</label>
                                                <input type="text" name="organization" class="form-control" 
                                                       value="{{ $award->organization }}" required>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Year *</label>
                                                    <input type="text" name="year" class="form-control" 
                                                           value="{{ $award->year }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Display Rank *</label>
                                                    <input type="number" name="rank" class="form-control" 
                                                           value="{{ $award->rank }}" min="1" required>
                                                    <small class="text-muted">Lower number = higher priority</small>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Icon *</label>
                                                <select name="icon" class="form-select" required>
                                                    @foreach($icons as $iconClass => $iconName)
                                                        <option value="{{ $iconClass }}" {{ $award->icon == $iconClass ? 'selected' : '' }}>
                                                            {{ $iconName }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                            <td colspan="6" class="text-center py-4">
                                <p class="text-muted">No awards added yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Award Modal -->
<div class="modal fade" id="addAwardModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Award</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.banner.storeAward') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Award Title *</label>
                        <input type="text" name="title" class="form-control" 
                               placeholder="e.g., Excellence in Cardiology Award" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Organization *</label>
                        <input type="text" name="organization" class="form-control" 
                               placeholder="e.g., Cardiology Society of Bangladesh" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Year *</label>
                            <input type="text" name="year" class="form-control" placeholder="2022" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Display Rank *</label>
                            <input type="number" name="rank" class="form-control" 
                                   placeholder="1" min="1" value="1" required>
                            <small class="text-muted">1 = First position</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon *</label>
                        <select name="icon" class="form-select" required>
                            @foreach($icons as $iconClass => $iconName)
                                <option value="{{ $iconClass }}">{{ $iconName }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Icon will be displayed with the award</small>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Award</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection