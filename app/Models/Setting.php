<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'description',
        'email',
        'phone',
        'address',
        'primary_color',
        'secondary_color',
        'seo_meta_title',
        'seo_meta_description',
        'google_analytics_id',
    ];
}
