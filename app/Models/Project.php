<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'short_description',
        'full_description',
        'technologies',
        'project_date',
        'category',
        'github_url',
        'demo_url',
        'client',
        'duration',
        'status',
        'videos',
        'is_featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'videos' => 'array',
            'project_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }
}
