@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')

<div class="container-fluid p-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0">Contact Messages</h2>
            <p class="text-muted small mb-0">View and manage all incoming messages</p>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 border-start border-success border-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-primary">Messages List</h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th width="8%" class="ps-4">Status</th>
                            <th width="15%">Name</th>
                            <th width="20%">Email</th>
                            <th width="12%">Phone</th>
                            <th width="20%">Location</th>
                            <th width="10%">Date</th>
                            <th width="15%" class="text-center pe-4">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($messages as $msg)
                            <tr class="{{ !$msg->is_read ? 'table-primary' : '' }}">
                                <td class="ps-4">
                                    <span class="badge {{ !$msg->is_read ? 'bg-primary' : 'bg-secondary' }}">
                                        {{ !$msg->is_read ? 'New' : 'Read' }}
                                    </span>
                                </td>

                                <td>{{ $msg->name }}</td>

                                <td class="text-break">
                                    {{ $msg->email }}
                                </td>

                                <td>{{ $msg->phone_number }}</td>

                                <td class="text-break">
                                    {{ Str::limit($msg->selected_address, 40) }}
                                </td>

                                <td>{{ $msg->created_at->format('M d, Y') }}</td>

                                <td class="text-center pe-4 action-buttons">
                                    <a href="{{ route('admin.messages.show', $msg) }}"
                                       class="btn btn-sm btn-outline-success" title="View">
                                        <i class="bi bi-eye">Read</i>
                                    </a>

                                    <form action="{{ route('admin.messages.destroy', $msg) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash">Delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-envelope-x display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">No Messages Found</h5>
                                        <p class="text-muted small">All incoming messages will appear here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($messages->hasPages())
            <div class="p-3 border-top">
                {{ $messages->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection