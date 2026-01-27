<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BannerSetting extends Model
{
    protected $fillable = [
        'doctor_name',
        'doctor_degree',
        'specialization',
        'bio',
        'biography',
        'expertise',
        'doctor_image',
        'intro_video',
        'video_enabled'
    ];

    protected $casts = [
        'video_enabled' => 'boolean',
        'expertise' => 'array'
    ];

    // Relationships
    public function educations()
    {
        return $this->hasMany(DoctorEducation::class)->orderBy('display_order');
    }

    public function experiences()
    {
        return $this->hasMany(DoctorExperience::class)->orderBy('display_order');
    }

    // Helper methods
    public function getImageUrlAttribute()
    {
        if ($this->doctor_image) {
            return asset('storage/' . $this->doctor_image);
        }
        return asset('images/default-doctor.jpg');
    }

    public function getVideoUrlAttribute()
    {
        if ($this->intro_video) {
            return asset('storage/' . $this->intro_video);
        }
        return null;
    }

    public function shouldShowVideoAttribute()
    {
        return $this->intro_video && $this->video_enabled;
    }
}