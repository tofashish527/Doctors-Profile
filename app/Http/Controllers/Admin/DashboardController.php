<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $unreadMessages = ContactMessage::where('is_read', false)
            ->latest()
            ->take(5)
            ->get();
            
        $totalUnread = ContactMessage::where('is_read', false)->count();
        $totalMessages = ContactMessage::count();
        
        return view('admin.dashboard', compact('unreadMessages', 'totalUnread', 'totalMessages'));
    }
}