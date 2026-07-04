<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'icon',
        'level',
        'percentage',
        'color',
        'sort_order',
    ];
}
