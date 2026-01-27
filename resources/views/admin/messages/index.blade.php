@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="main-content">
    <div class="main-content-inner">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-semibold">Contact Messages</h3>
            <ul class="flex items-center gap-2 text-sm text-gray-500">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><span>›</span></li>
                <li>Messages</li>
            </ul>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-lg font-bold">Status</th>
                        <th class="px-6 py-3 text-left text-lg font-bold">Name</th>
                        <th class="px-6 py-3 text-left text-lg font-bold">Email</th>
                        <th class="px-6 py-3 text-left text-lg font-bold">Phone</th>
                        <th class="px-6 py-3 text-left text-lg font-bold">Location</th>
                        <th class="px-6 py-3 text-left text-lg font-bold">Date</th>
                        <th class="px-6 py-3 text-center text-lg font-bold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($messages as $msg)
                        <tr class="{{ !$msg->is_read ? 'bg-blue-50' : '' }}">
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-white text-sm {{ !$msg->is_read ? 'bg-blue-500' : 'bg-gray-400' }}">
                                    {{ !$msg->is_read ? 'New' : 'Read' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium">{{ $msg->name }}</td>
                            <td class="px-6 py-4">{{ $msg->email }}</td>
                            <td class="px-6 py-4">{{ $msg->phone_number }}</td>
                            <td class="px-6 py-4">{{ $msg->selected_address }}</td>
                            <td class="px-6 py-4">{{ $msg->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="inline-block px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                    View
                                </a>
                                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No messages found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $messages->links('pagination::bootstrap-4') }}
        </div>

    </div>
</div>

<style>
    /* ================= Responsive Main Content ================= */
    .main-content {
        margin-left: 280px; /* sidebar space */
        padding: 30px;
    }

    @media (max-width: 991px) {
        .main-content {
            margin-left: 0;
            padding: 15px;
        }
    }
</style>
@endsection
