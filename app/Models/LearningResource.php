<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningResource extends Model
{
    protected $fillable = [
        'title',
        'type',
        'url',
        'description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
