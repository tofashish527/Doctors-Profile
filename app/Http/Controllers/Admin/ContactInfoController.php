<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contactInfos = ContactInfo::latest()->get();
        return view('admin.contact-info.index', compact('contactInfos'));
    }

    public function create()
    {
        $weekDays = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        return view('admin.contact-info.create', compact('weekDays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'working_days' => 'required|array',
        ]);

        // Process working days
        $workingDays = [];
        foreach ($request->working_days as $day => $times) {
            if (isset($times['enabled'])) {
                $workingDays[$day] = [
                    'open' => $times['open'],
                    'close' => $times['close']
                ];
            }
        }

        ContactInfo::create([
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'working_days' => $workingDays,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact info added successfully!');
    }

    public function edit(ContactInfo $contactInfo)
    {
        $weekDays = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        return view('admin.contact-info.edit', compact('contactInfo', 'weekDays'));
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'working_days' => 'required|array',
        ]);

        $workingDays = [];
        foreach ($request->working_days as $day => $times) {
            if (isset($times['enabled'])) {
                $workingDays[$day] = [
                    'open' => $times['open'],
                    'close' => $times['close']
                ];
            }
        }

        $contactInfo->update([
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'working_days' => $workingDays,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact info updated successfully!');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();
        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact info deleted successfully!');
    }
}