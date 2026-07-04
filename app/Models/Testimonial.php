<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'photo',
        'name',
        'profession',
        'company',
        'comment',
        'rating',
        'testimonial_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'testimonial_date' => 'date',
            'is_active' => 'boolean',
        ];
    }
}
