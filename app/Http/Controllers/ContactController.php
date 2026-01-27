<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfos = ContactInfo::where('is_active', true)->get();
        
        return view('contact', compact( 'contactInfos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|string|max:20',
            'selected_address' => 'required|string',
            'selected_timing' => 'required|string',
            'message' => 'nullable|string|max:1000',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'selected_address' => $request->selected_address,
            'selected_timing' => $request->selected_timing,
            'message' => $request->message,
        ];

        // Database e save
        ContactMessage::create($data);

        // Get admin email from database
        // $admin = User::where('is_admin', true)->first();
        
        // // Mail pathanor try kora
        // try {
        //     // Admin ke mail pathao
        //     if ($admin) {
        //         Mail::to($admin->email)->send(new ContactMail($data));
        //     }
            
        //     // Apnar fixed email eo pathao
        //     Mail::to('2011nujum@gmail.com')->send(new ContactMail($data));
            
        // } catch (\Exception $e) {
        //     //\Log::error("Mail Error: " . $e->getMessage());
        //     // Mail na gele o database e save hobe
        // }

        // if ($request->ajax()) {
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Your message has been sent successfully!'
        //     ]);
        // }

        
    // মেইল পাঠানো (এখানে আপনার নিজের ইমেইল এড্রেস দিন যেখানে আপনি মেসেজটি পেতে চান)
    try {
        Mail::to('2011nujum@gmail.com')->send(new ContactMail($data));
    } catch (\Exception $e) {
        //\Log::error("Mail Error: " . $e->getMessage());
        // মেইল না গেলেও ডাটাবেসে সেভ হবে, আপনি চাইলে লগ চেক করতে পারেন
    }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}