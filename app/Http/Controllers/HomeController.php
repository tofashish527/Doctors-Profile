<?php

namespace App\Http\Controllers;

use App\Models\BannerSetting;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
    {
        $banner = BannerSetting::with(['educations', 'experiences','awards'])->first();
        
        // Get ALL active contact infos
        $contactInfos = ContactInfo::where('is_active', true)->get();
        
        // Get first contact for default display
        $contactInfo = $contactInfos->first();
        
        return view('home', compact('banner', 'contactInfo', 'contactInfos'));
    }
}