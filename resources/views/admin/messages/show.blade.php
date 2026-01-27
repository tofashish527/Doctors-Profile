@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Messages
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-envelope-open"></i> Message Details
            </h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Name:</strong> {{ $message->name }}
                </div>
                <div class="col-md-6">
                    <strong>Date:</strong> {{ $message->created_at->format('F d, Y - h:i A') }}
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Email:</strong> 
                    <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                </div>
                <div class="col-md-6">
                    <strong>Phone:</strong> 
                    <a href="tel:{{ $message->phone_number }}">{{ $message->phone_number }}</a>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Location:</strong> {{ $message->selected_address }}
                </div>
                <div class="col-md-6">
                    <strong>Preferred Timing:</strong> {{ $message->selected_timing }}
                </div>
            </div>
            
            @if($message->message)
            <hr>
            <div class="mb-3">
                <strong>Message:</strong>
                <div class="alert alert-light mt-2">
                    {{ $message->message }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection