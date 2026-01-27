@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    {{-- <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <h1 class="text-xl font-bold">Admin Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">{{ auth()->user()->email }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav> --}}

    <div class="max-w-7xl mx-auto px-4 py-8 mt-150">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h2>
            <p class="text-gray-600">Email: {{ auth()->user()->email }}</p>
            
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-100 p-6 rounded-lg">
                    <h3 class="font-bold text-lg mb-2">Dashboard Stats</h3>
                    <p class="text-gray-600">Coming soon...</p>
                </div>
                <div class="bg-green-100 p-6 rounded-lg">
                    <h3 class="font-bold text-lg mb-2">Quick Actions</h3>
                    <p class="text-gray-600">CRUD operations will be here</p>
                </div>
                <div class="bg-purple-100 p-6 rounded-lg">
                    <h3 class="font-bold text-lg mb-2">Recent Activity</h3>
                    <p class="text-gray-600">Activity log coming soon</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Messages</h5>
                    <h2>{{ $totalMessages }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Unread Messages</h5>
                    <h2>{{ $totalUnread }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Messages -->
    @if($totalUnread > 0)
    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h5 class="mb-0">
                <i class="bi bi-bell-fill"></i> Recent Unread Messages
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @foreach($unreadMessages as $msg)
                <a href="{{ route('admin.messages.show', $msg) }}" 
                   class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-1">{{ $msg->name }}</h6>
                            <p class="mb-1 small text-muted">
                                <i class="bi bi-envelope"></i> {{ $msg->email }} | 
                                <i class="bi bi-phone"></i> {{ $msg->phone_number }}
                            </p>
                            <p class="mb-0 small">
                                <i class="bi bi-geo-alt"></i> {{ $msg->selected_address }}
                            </p>
                        </div>
                        <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</body>
</html>
@endsection