<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $table = 'cities';
    protected $fillable = [
        'name',
        'governorate_id',
    ];

    protected $casts = [
        'name' => 'array',
    ];
}
