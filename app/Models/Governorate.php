<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $table = 'governorates';
    protected $fillable = [
        'name',
        'country_id',
    ];
    protected $casts = [
        'name' => 'array',
    ];
}
