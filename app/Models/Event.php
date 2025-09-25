<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'status',
    ];
}
