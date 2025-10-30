<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

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

    /*  ==================== Methods ==================== */
    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->where('is_active', 'active');
    }
    #[Scope]
    protected function inActive(Builder $query): Builder
    {
        return $query->where('is_active', 'inactive');
    }
}
