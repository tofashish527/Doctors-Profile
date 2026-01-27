<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorEducation extends Model
{
    protected $table = 'doctor_educations';
    protected $fillable = [
        'banner_setting_id',
        'degree_title',
        'institution',
        'start_year',
        'end_year',
        'display_order'
    ];

    public function bannerSetting()
    {
        return $this->belongsTo(BannerSetting::class);
    }
}