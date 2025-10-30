<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /* ============== Relationships ==============*/
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'city_id');
    }
}
