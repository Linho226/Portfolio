<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'phone',
        'message',
        'sent_at',
        'is_read',
        'is_replied',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'replied_at' => 'datetime',
            'is_read' => 'boolean',
            'is_replied' => 'boolean',
        ];
    }
}
