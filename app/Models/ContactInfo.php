<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'address',
        'phone_number',
        'working_days',
        'is_active'
    ];

    protected $casts = [
        'working_days' => 'array',
        'is_active' => 'boolean'
    ];

    public function messages()
    {
        return $this->hasMany(ContactMessage::class);
    }
}