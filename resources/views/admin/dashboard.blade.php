@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    .dashboard-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .dashboard-card .card-body {
        padding: 1.75rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.2;
    }
    
    .unread-message-item {
        border-left: 4px solid #ffc107;
        transition: all 0.2s ease;
    }
    
    .unread-message-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
        transform: translateX(5px);
    }
    
    .welcome-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    
    .welcome-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%239C92AC' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.1;
    }
</style>

<div class="main-content-wrapper">
    <div class="container-fluid px-4 py-4">

        <!-- Welcome Header -->
        <div class="welcome-header mb-4 p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="fw-bold mb-2">Welcome to Admin Portal, {{ auth()->user()->name }}!</h4>
                    <p class="mb-0 opacity-75">You have <strong>{{ $totalUnread }}</strong> unread messages waiting for your attention.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="bg-white text-dark rounded-3 p-3 d-inline-block shadow-sm">
                        <small class="text-muted d-block">Logged in as</small>
                        <strong>{{ auth()->user()->email }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase opacity-75 mb-2">Total Messages</h6>
                                <h2 class="stat-number mb-0">{{ $totalMessages }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-25 rounded-circle p-3">
                                <i class="bi bi-envelope display-6"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.messages.index') }}" class="text-white text-decoration-none small d-block mt-3">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card shadow-sm border-0 bg-warning text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase opacity-75 mb-2">Unread Messages</h6>
                                <h2 class="stat-number mb-0">{{ $totalUnread }}</h2>
                            </div>
                            <div class="bg-dark bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-bell display-6"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="text-dark text-decoration-none small d-block mt-3">
                            View Unread <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card shadow-sm border-0 bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase opacity-75 mb-2">Read Messages</h6>
                                <h2 class="stat-number mb-0">{{ $totalMessages - $totalUnread }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-25 rounded-circle p-3">
                                <i class="bi bi-envelope-open display-6"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.messages.index', ['status' => 'read']) }}" class="text-white text-decoration-none small d-block mt-3">
                            View Read <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card shadow-sm border-0 bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase opacity-75 mb-2">Today's Messages</h6>
                                <h2 class="stat-number mb-0">{{ $todayMessages ?? '0' }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-25 rounded-circle p-3">
                                <i class="bi bi-calendar-day display-6"></i>
                            </div>
                        </div>
                        <span class="text-white text-decoration-none small d-block mt-3">
                            Updated just now
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Unread Messages -->
        @if($totalUnread > 0)
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-bell-fill text-warning me-2"></i> Recent Unread Messages
                        <span class="badge bg-warning text-dark ms-2">{{ $unreadMessages->count() }}</span>
                    </h5>
                    <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="btn btn-sm btn-outline-warning">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($unreadMessages->take(5) as $msg)
                    <a href="{{ route('admin.messages.show', $msg) }}" 
                       class="list-group-item list-group-item-action border-0 py-3 px-4 unread-message-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-1">
                                    <h6 class="mb-0 fw-bold me-2">{{ $msg->name }}</h6>
                                    <small class="badge bg-warning text-dark">New</small>
                                </div>
                                <p class="mb-1 text-muted small">
                                    <i class="bi bi-envelope me-1"></i> {{ $msg->email }} 
                                    <span class="mx-2">•</span>
                                    <i class="bi bi-phone me-1"></i> {{ $msg->phone_number }}
                                </p>
                                <p class="mb-0 text-muted small">
                                    <i class="bi bi-geo-alt me-1"></i> 
                                    {{ Str::limit($msg->selected_address, 60) }}
                                </p>
                            </div>
                            <div class="text-end">
                                <small class="text-muted d-block">{{ $msg->created_at->format('M d, Y') }}</small>
                                <small class="text-primary">{{ $msg->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    
                    @if($unreadMessages->count() > 5)
                    <div class="list-group-item text-center py-3 bg-light">
                        <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="text-decoration-none">
                            <i class="bi bi-chevron-down me-1"></i> Show {{ $unreadMessages->count() - 5 }} more unread messages
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @else
        <!-- No Unread Messages -->
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success display-4"></i>
                </div>
                <h4 class="text-success mb-2">All Caught Up!</h4>
                <p class="text-muted mb-0">You have no unread messages at the moment.</p>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-envelope me-1"></i> View All Messages
                </a>
            </div>
        </div>
        @endif

        <!-- Quick Links -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="mb-3 text-muted text-uppercase">Quick Actions</h6>
                        <div class="row">
                            <div class="col-md-3 col-6 mb-3">
                                <a href="{{ route('admin.messages.index') }}" class="text-decoration-none">
                                    <div class="border rounded-3 p-3 text-center h-100">
                                        <i class="bi bi-envelope display-6 text-primary mb-2"></i>
                                        <h6>All Messages</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="text-decoration-none">
                                    <div class="border rounded-3 p-3 text-center h-100">
                                        <i class="bi bi-bell display-6 text-warning mb-2"></i>
                                        <h6>Unread</h6>
                                    </div>
                                </a>
                            </div>
                            {{-- <div class="col-md-3 col-6 mb-3">
                                <a href="{{ route('admin.messages.create') }}" class="text-decoration-none">
                                    <div class="border rounded-3 p-3 text-center h-100">
                                        <i class="bi bi-plus-circle display-6 text-success mb-2"></i>
                                        <h6>Add New</h6>
                                    </div>
                                </a>
                            </div> --}}
                            <div class="col-md-3 col-6 mb-3">
                                <a href="{{ route('admin.logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                   class="text-decoration-none">
                                    <div class="border rounded-3 p-3 text-center h-100">
                                        <i class="bi bi-box-arrow-right display-6 text-danger mb-2"></i>
                                        <h6>Logout</h6>
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection