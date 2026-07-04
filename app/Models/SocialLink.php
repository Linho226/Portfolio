<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'facebook',
        'linkedin',
        'github',
        'tiktok',
        'instagram',
        'twitter',
        'youtube',
    ];
}
