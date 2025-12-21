<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Config;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations, HasFactory, Sluggable;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table = 'products';

    protected $fillable = [
        'name',
        'small_desc',
        'desc',
        'status',
        'sku',
        'available_for',
        'views',
        'has_variants',
        'price',
        'has_discount',
        'discount',
        'start_discount',
        'end_discount',
        'manage_stock',
        'quantity',
        'available_in_stock',
        'brand_id',
        'category_id',
        'description',
        'small_description',
        'slug',
    ];

    public array $translatable = ['name', 'small_desc', 'desc'];

    /* ================== Relations ================== */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productPreviews(): HasMany
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /* ================== Methods & functions ==================*/
    public function isSimple(): bool
    {
        return !$this->has_variants;
    }

    public function getCreatedAtAttribute($value): string
    {
        return date('d/m/y H:i', strtotime($value));
    }

    public function getUpdatedAtAttribute($value): string
    {
        return date('d/m/y H:i', strtotime($value));
    }

    public function hasVariantsTranslated()
    {
        if (Config::get('app.locale') === 'ar') {
            return $this->has_variants == 1 ? 'يوجد متغيرات' : 'لا يوجد متغيرات';
        }
        return $this->has_variants == 1 ? 'Has Variants' : 'No Variants';
    }

    public function getStatusTranslated()
    {
        if (Config::get('app.locale') === 'ar') {
            return $this->status == 'active' ? 'نشط' : 'غير نشط';
        }
        return $this->status == 'active' ? 'Active' : 'Inactive';
    }

    public function getPriceAfterDiscount()
    {
        if ($this->has_discount && $this->discount > 0) {
            return $this->price - $this->discount;
        }
        return $this->price;
    }

    public function getVariantPriceAfterDiscount($variantPrice)
    {
        if ($this->has_discount && $this->discount > 0) {
            return $variantPrice - $this->discount;
        }
        return $variantPrice;
    }

    public function priceAttribute()
    {
        return $this->has_variants == 0 ? number_format($this->price, 2) : __("dashboard.has_variants");
    }

    public function quantityAttribute()
    {
        return $this->has_variants == 0 ? $this->quantity : __("dashboard.has_variants");
    }

    public function discountPercentage()
    {
        if ($this->variants()->exists() || !$this->discount || $this->price == 0) {
            return '🔥';
        }

        // calculate percentage
        return round(($this->discount / $this->price) * 100, 2) . '%';
    }

    /** ================== Scopes ================== */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
