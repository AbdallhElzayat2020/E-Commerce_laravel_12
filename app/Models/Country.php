<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;
    public array $translatable = ['name'];

    protected $table = 'countries';
    protected $fillable = [
        'name',
    ];
    protected $casts = [
        'name' => 'array',
    ];
}
