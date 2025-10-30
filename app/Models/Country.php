<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Config;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $table = 'countries';
    protected $fillable = [
        'name',
        'phone_code',
        'is_active',
        'flag_code',
    ];
    protected $casts = [
        'name' => 'array',
    ];


    /* ============== Relationships ==============*/

    public function governorates(): HasMany
    {
        return $this->hasMany(Governorate::class, 'country_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'country_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'country_id');
    }

    /* ============== Scopes and Methods ==============*/

    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }


    public function getIsActiveAttribute($value)
    {
        if (Config::get('app.locale') == 'ar') {
            return $value == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
