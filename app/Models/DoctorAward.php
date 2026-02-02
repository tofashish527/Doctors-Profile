<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorAward extends Model
{
    protected $fillable = [
        'banner_setting_id',
        'title',
        'organization',
        'year',
        'icon',
        'rank'
    ];

    public function bannerSetting()
    {
        return $this->belongsTo(BannerSetting::class);
    }
}