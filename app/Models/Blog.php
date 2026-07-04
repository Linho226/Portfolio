<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'summary',
        'content',
        'blog_category_id',
        'tags',
        'seo_title',
        'seo_description',
        'author_id',
        'published_at',
        'is_published',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function tagItems(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}