@extends('layouts.admin')

@section('content')

{{-- 
    এই স্টাইলটি মূলত সাইডবারের সাথে কনটেন্টের পজিশন ঠিক রাখার জন্য।
    যদি আপনার layouts.admin ফাইলে ইতিমধ্যে মেইন স্ট্রাকচার ঠিক করা থাকে, 
    তবে নিচের <style> ট্যাগটি ডিলিট করে দিতে পারেন।
--}}
<style>
    /* মেইন কনটেন্ট র‍্যাপার */
    .main-content-wrapper {
        width: 100%;
        /* সাইডবার যদি 250px হয়, তাহলে এখানে margin-left: 250px দিন। 
           ফ্লেক্সবক্স লেআউট হলে এটার প্রয়োজন নেই। */
        padding-left: 200; 
        transition: all 0.3s;
    }

    /* টেবিল ডিজাইন ইমপ্রুভমেন্ট */
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 16px;
        letter-spacing: 0.5px;
    }
    .table td {
        font-weight: 600;
        font-size: 16px;
        letter-spacing: 0.5px;
    }
    .action-buttons .btn {
        margin-right: 5px;
    }
</style>

{{-- মেইন কনটেন্ট শুরু --}}
<div class="main-content-wrapper">
    <div class="container-fluid px-4 py-4">
        
        {{-- হেডার সেকশন --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary">Contact Info List</h2>
                <p class="text-muted small mb-0">Manage your contact details and working hours</p>
            </div>
            <a href="{{ route('admin.contact-info.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add New Info
            </a>
        </div>

        {{-- অ্যালার্ট মেসেজ --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 border-start border-success border-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- টেবিল কার্ড --}}
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact Information Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light text-secondary">
                            <tr>
                                {{-- <th scope="col" width="5%">ID</th> --}}
                                <th scope="col" width="25%">Address</th>
                                <th scope="col" width="15%">Phone</th>
                                <th scope="col" width="25%">Working Days</th>
                                <th scope="col" width="10%">Status</th>
                                <th scope="col" width="20%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contactInfos as $info)
                            <tr>
                                {{-- <td><span class="fw-bold text-secondary">#{{ $info->id }}</span></td> --}}
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt text-danger me-2"></i>
                                        <span>{{ Str::limit($info->address, 50) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <a href="tel:{{ $info->phone_number }}" class="text-decoration-none text-dark">
                                        <i class="bi bi-telephone text-success me-1"></i> {{ $info->phone_number }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($info->working_days as $day => $time)
                                            <span class="badge bg-light text-dark border" ">
                                                {{ substr($day, 0, 3) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill {{ $info->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $info->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ route('admin.contact-info.edit', $info) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.contact-info.destroy', $info) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-folder-x display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">No Contact Information Found</h5>
                                        <p class="text-muted small">Get started by adding new contact details.</p>
                                        <a href="{{ route('admin.contact-info.create') }}" class="btn btn-sm btn-primary mt-2">
                                            Create Now
                                        </a>
                                    </div>
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
@endsection