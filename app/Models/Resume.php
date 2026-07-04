<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'file_path',
        'version',
        'is_active',
        'uploaded_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'uploaded_at' => 'datetime',
        ];
    }
}
