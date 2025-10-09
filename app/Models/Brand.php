<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use HasTranslations, Sluggable;

    public array $translatable = ['name', 'description'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table = 'brands';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'status',
    ];


    /*  ================== Relations ==================*/
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id');
    }


    /****************** Scopes *******************/
    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    #[Scope]
    protected function inActive(Builder $query): Builder
    {
        return $query->where('status', 'inactive');;
    }

    /*  ================== Methods ================= =*/
    public function getCreatedAtAttribute(): string
    {
        return date('d/m/y H:i', strtotime($this->attributes['created_at']));
    }

    public function getLogoAttribute($logo): string
    {
        return 'uploads/brands/' . $logo;
    }
}
