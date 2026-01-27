<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorExperience extends Model
{
    protected $fillable = [
        'banner_setting_id',
        'position',
        'organization',
        'start_year',
        'end_year',
        'display_order'
    ];

    public function bannerSetting()
    {
        return $this->belongsTo(BannerSetting::class);
    }

    // Helper to display year range
    public function getYearRangeAttribute()
    {
        return $this->start_year . '-' . ($this->end_year ?? 'Present');
    }
}