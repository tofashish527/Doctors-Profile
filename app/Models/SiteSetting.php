<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'emergency_phone',
        'location',
        'working_hours',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'youtube_url',
    ];

    /**
     * Get the first (and only) site settings record
     * Creates one if it doesn't exist
     */
    public static function getSettings()
    {
        $settings = self::first();
        
        if (!$settings) {
            $settings = self::create([
                'emergency_phone' => '002 010612457410',
                'location' => 'Brooklyn, New York',
                'working_hours' => 'Mon-Fri: 8am – 7pm',
            ]);
        }
        
        return $settings;
    }
}