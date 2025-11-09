<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use Sluggable, HasTranslations, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public array $translatable = ['name'];

    protected $casts = [
        'name' => 'array',
    ];

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'parent_id',
        'icon',
        'status',
    ];

    /* ================== Relations ================== */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /* ================== Scopes ================== */
    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->whereStatus('active');
    }

    #[Scope]
    protected function inActive(Builder $query): Builder
    {
        return $query->whereStatus('inactive');
    }

    /*  ================== Methods ==================*/

    public function getCreatedAtAttribute(): string
    {
        return date('d/m/y H:i', strtotime($this->attributes['created_at']));
    }

    public function getIconAttribute($icon): string
    {
        return asset('uploads/categories/' . $icon);
    }
}
