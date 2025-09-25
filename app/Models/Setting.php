<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'email',
        'email_support',
        'phone',
        'address',
        'logo',
        'favicon',
        'facebook',
        'x',
        'instagram',
        'linkedin',
        'youtube',
        'tiktok',
        'pinterest',
        'reddit',
    ];
}
