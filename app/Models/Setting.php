<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    public array $translatable = [
        'site_name',
        'site_address',
        'site_desc',
        'meta_description'
    ];
    public $timestamps = false;
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
