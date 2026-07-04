<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = ['visited_date', 'total_views', 'unique_visitors'];

    protected $casts = ['visited_date' => 'date'];
}
