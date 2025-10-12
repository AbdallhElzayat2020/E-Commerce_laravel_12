<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $table = 'settings';
    public array $translatable = [
        'site_name',
        'site_address',
        'site_desc',
        'meta_description'
    ];

    public $timestamps = false;

    protected $fillable = [
        'site_name',
        'site_desc',
        'site_phone',
        'site_address',
        'site_email',
        'email_support',
        'facebook_url',
        'x_url',
        'youtube_url',
        'meta_description',
        'logo',
        'favicon',
        'site_copyright',
        'promotion_video_url',
    ];

    public function getLogoAttribute()
    {
        return 'uploads/settings/' . $this->attributes['logo'];
    }

    public function getFaviconAttribute()
    {
        return 'uploads/settings/' . $this->attributes['favicon'];
    }
}
