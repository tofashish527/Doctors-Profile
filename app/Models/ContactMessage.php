<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'selected_address',
        'selected_timing',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];
}