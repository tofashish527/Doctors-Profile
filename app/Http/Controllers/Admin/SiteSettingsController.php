<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingsController extends Controller
{
    /**
     * Display the site settings form
     */
    public function index()
    {
        $settings = SiteSetting::getSettings();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the site settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Logo Validation
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            
            // Contact Information
            'emergency_phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            
            // Working Hours
            'working_hours' => 'nullable|string|max:100',
            
            // Social Media
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        $settings = SiteSetting::getSettings();

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Update settings
        $settings->update($validated);

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Site settings updated successfully!');
    }

    /**
     * Delete logo
     */
    public function deleteLogo()
    {
        $settings = SiteSetting::getSettings();

        if ($settings->logo) {
            Storage::disk('public')->delete($settings->logo);
            $settings->update(['logo' => null]);
        }

        return response()->json(['success' => true]);
    }
}