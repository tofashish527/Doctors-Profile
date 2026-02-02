<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerSetting;
use App\Models\DoctorEducation;
use App\Models\DoctorExperience;
use App\Models\ContactInfo;
use App\Models\DoctorAward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerSettingController extends Controller
{
    public function index()
    {
        $banner = BannerSetting::first();
        
        if (!$banner) {
            $banner = BannerSetting::create([
                'doctor_name' => 'Dr. Your Name',
                'doctor_degree' => 'MBBS, FCPS',
                'specialization' => 'Your Specialization',
                'bio' => 'Your professional bio here.',
            ]);
        }
        
        $contactInfos = ContactInfo::where('is_active', true)->get();
        
        return view('admin.banner.index', compact('banner', 'contactInfos'));
    }

    public function update(Request $request)
    {
        $banner = BannerSetting::first();
        
        $request->validate([
            'doctor_name' => 'required|string|max:100',
            'doctor_degree' => 'required|string|max:150',
            'specialization' => 'required|string|max:100',
            'bio' => 'required|string|max:500',
            'biography' => 'nullable|string|max:5000',
            'expertise' => 'nullable|array|max:10',
            'expertise.*' => 'string|max:200',
            'video_enabled' => 'nullable'
        ]);

        $banner->update([
            'doctor_name' => $request->doctor_name,
            'doctor_degree' => $request->doctor_degree,
            'specialization' => $request->specialization,
            'bio' => $request->bio,
            'biography' => $request->biography,
            'expertise' => $request->expertise ?? [],
            'video_enabled' => $request->has('video_enabled')? true : false
        ]);

        return redirect()->back()->with('success', 'Doctor profile updated successfully!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'doctor_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $banner = BannerSetting::first();

        if ($banner->doctor_image && Storage::exists('public/' . $banner->doctor_image)) {
            Storage::delete('public/' . $banner->doctor_image);
        }

        $path = $request->file('doctor_image')->store('doctors', 'public');

        $banner->update(['doctor_image' => $path]);

        return redirect()->back()->with('success', 'Doctor image uploaded successfully!');
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'intro_video' => 'required|mimetypes:video/mp4,video/mpeg,video/x-msvideo,video/quicktime|max:102400'
        ]);

        $banner = BannerSetting::first();

        if ($banner->intro_video && Storage::exists('public/' . $banner->intro_video)) {
            Storage::delete('public/' . $banner->intro_video);
        }

        $path = $request->file('intro_video')->store('videos', 'public');

        $banner->update([
            'intro_video' => $path,
            'video_enabled' => true
        ]);

        return redirect()->back()->with('success', 'Introduction video uploaded successfully!');
    }

    public function deleteVideo()
    {
        $banner = BannerSetting::first();

        if ($banner->intro_video && Storage::exists('public/' . $banner->intro_video)) {
            Storage::delete('public/' . $banner->intro_video);
        }

        $banner->update([
            'intro_video' => null,
            'video_enabled' => false
        ]);

        return redirect()->back()->with('success', 'Video deleted successfully!');
    }

    public function educations()
{
    $banner = BannerSetting::first();
    $educations = $banner->educations()->orderBy('display_order')->get();
    return view('admin.banner.educations', compact('educations'));
}

public function experiences()
{
    $banner = BannerSetting::first();
    $experiences = $banner->experiences()->orderBy('display_order')->get();
    return view('admin.banner.experiences', compact('experiences'));
}
    // Education Methods
    public function storeEducation(Request $request)
    {
        $request->validate([
            'degree_title' => 'required|string|max:200',
            'institution' => 'required|string|max:200',
            'start_year' => 'required|string|max:10',
            'end_year' => 'required|string|max:10',
        ]);

        $banner = BannerSetting::first();
        
        $maxOrder = $banner->educations()->max('display_order') ?? 0;

        DoctorEducation::create([
            'banner_setting_id' => $banner->id,
            'degree_title' => $request->degree_title,
            'institution' => $request->institution,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'display_order' => $maxOrder + 1
        ]);

        return redirect()->back()->with('success', 'Education added successfully!');
    }

    public function updateEducation(Request $request, DoctorEducation $education)
    {
        $request->validate([
            'degree_title' => 'required|string|max:200',
            'institution' => 'required|string|max:200',
            'start_year' => 'required|string|max:10',
            'end_year' => 'required|string|max:10',
        ]);

        $education->update($request->only(['degree_title', 'institution', 'start_year', 'end_year']));

        return redirect()->back()->with('success', 'Education updated successfully!');
    }

    public function deleteEducation(DoctorEducation $education)
    {
        $education->delete();
        return redirect()->back()->with('success', 'Education deleted successfully!');
    }

    // Experience Methods
    public function storeExperience(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:200',
            'organization' => 'required|string|max:200',
            'start_year' => 'required|string|max:10',
            'end_year' => 'nullable|string|max:10',
        ]);

        $banner = BannerSetting::first();
        
        $maxOrder = $banner->experiences()->max('display_order') ?? 0;

        DoctorExperience::create([
            'banner_setting_id' => $banner->id,
            'position' => $request->position,
            'organization' => $request->organization,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'display_order' => $maxOrder + 1
        ]);

        return redirect()->back()->with('success', 'Experience added successfully!');
    }
public function updateExpertise(Request $request)
{
    $banner = BannerSetting::first();
    
    // Parse the JSON data from hidden input
    $expertiseData = $request->input('expertise');
    
    // If it's a string (JSON), decode it
    if (is_string($expertiseData)) {
        $expertiseData = json_decode($expertiseData, true);
    }
    
    // Validate
    $validated = validator()->make(['expertise' => $expertiseData], [
        'expertise' => 'nullable|array|max:10',
        'expertise.*' => 'string|max:200',
    ])->validate();

    $banner->update([
        'expertise' => $expertiseData ?? [],
    ]);

    return redirect()->back()->with('success', 'Expertise updated successfully!');
}

    public function deleteExperience(DoctorExperience $experience)
    {
        $experience->delete();
        return redirect()->back()->with('success', 'Experience deleted successfully!');
    }

    // Awards page
public function awards()
{
    $banner = BannerSetting::first();
    $awards = $banner->awards()->orderBy('rank')->get();
    
    // Available icons
    $icons = [
        'fas fa-award' => 'Award',
        'fas fa-medal' => 'Medal',
        'fas fa-trophy' => 'Trophy',
        'fas fa-star' => 'Star',
        'fas fa-certificate' => 'Certificate',
        'fas fa-ribbon' => 'Ribbon',
        'fas fa-crown' => 'Crown',
    ];
    
    return view('admin.banner.awards', compact('awards', 'icons'));
}

// Store award
public function storeAward(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:200',
        'organization' => 'required|string|max:200',
        'year' => 'required|string|max:10',
        'icon' => 'required|string|max:50',
        'rank' => 'required|integer|min:1',
    ]);

    $banner = BannerSetting::first();

    DoctorAward::create([
        'banner_setting_id' => $banner->id,
        'title' => $request->title,
        'organization' => $request->organization,
        'year' => $request->year,
        'icon' => $request->icon,
        'rank' => $request->rank,
    ]);

    return redirect()->back()->with('success', 'Award added successfully!');
}

// Update award
public function updateAward(Request $request, DoctorAward $award)
{
    $request->validate([
        'title' => 'required|string|max:200',
        'organization' => 'required|string|max:200',
        'year' => 'required|string|max:10',
        'icon' => 'required|string|max:50',
        'rank' => 'required|integer|min:1',
    ]);

    $award->update($request->only(['title', 'organization', 'year', 'icon', 'rank']));

    return redirect()->back()->with('success', 'Award updated successfully!');
}

// Delete award
public function deleteAward(DoctorAward $award)
{
    $award->delete();
    return redirect()->back()->with('success', 'Award deleted successfully!');
}
}