<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Config;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $table = 'governorates';
    protected $fillable = ['name', 'country_id', 'is_active'];
    protected $casts = [
        'name' => 'array',
    ];

    /* ============== Relationships ==============*/

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'governorate_id');
    }

    public function shippingPrice(): HasOne
    {
        return $this->hasOne(ShippingGovernorate::class, 'governorate_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'governorate_id');
    }

    public function getIsActiveAttribute($value)
    {
        if (Config::get('app.locale') == 'ar') {
            return $value == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
