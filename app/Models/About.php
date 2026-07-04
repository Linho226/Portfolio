<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'profession',
        'short_description',
        'biography',
        'phone',
        'email',
        'address',
        'location',
        'is_available',
        'cv_path',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
        ];
    }
}
